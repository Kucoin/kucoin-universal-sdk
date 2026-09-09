import { randomUUID } from 'crypto';
import WebSocket from 'ws';
import { logger } from '@src/common';
import { KcSigner } from '@internal/infra/default_signer';
import { ClientOption } from '@model/client_option';
import {
    DEFAULT_WEBSOCKET_CLIENT_OPTION,
    WebSocketClientOption,
    WebSocketEvent,
} from '@model/websocket_option';

export type UtaWsPrimitive = string | number | boolean | null;
export type UtaWsValue = UtaWsPrimitive | UtaWsValue[] | { [key: string]: UtaWsValue };

export interface UtaPushEvent<T = Record<string, UtaWsValue>> {
    T: string;
    P?: string | number;
    t?: string;
    d: T;
}

export type UtaPushCallback<T = Record<string, UtaWsValue>> = (
    event: UtaPushEvent<T>,
) => void | Promise<void>;

export type UtaPushTradeType = 'SPOT' | 'FUTURES';

export interface UtaPushSubscription {
    channel: string;
    callback: UtaPushCallback;
    symbols?: string[];
    symbol?: string;
    tradeType?: string;
    accountType?: string;
    parameters?: Record<string, UtaWsValue>;
}

interface PendingAck {
    resolve: () => void;
    reject: (reason: Error) => void;
    timer: ReturnType<typeof setTimeout>;
}

interface DirectWsMessage {
    id?: string;
    action?: string;
    channel?: string;
    result?: boolean | string;
    message?: string;
    op?: string;
    type?: string;
    pingInterval?: number;
    pingTimeout?: number;
    T?: string;
    d?: Record<string, UtaWsValue>;
    [key: string]: unknown;
}

const PUBLIC_PUSH_ENDPOINT: Record<UtaPushTradeType, string> = {
    SPOT: 'wss://x-push-spot.kucoin.com',
    FUTURES: 'wss://x-push-futures.kucoin.com',
};
const PRIVATE_PUSH_ENDPOINT = 'wss://wsapi-push.kucoin.com';
const PRIVATE_AUTH_PLAINTEXT = 'POST/api/websocket/users/verify';
const DEFAULT_PING_INTERVAL = 18_000;
const DEFAULT_PING_TIMEOUT = 10_000;

/**
 * WebSocket transport for the direct UTA public and private push protocols.
 *
 * The UTA endpoints do not use the legacy token handshake, so this intentionally has a separate
 * implementation from DefaultWsService.
 */
export class UtaPushWsService {
    private readonly option: WebSocketClientOption;
    private readonly privateChannel: boolean;
    private readonly endpoint: string;
    private readonly tradeType?: UtaPushTradeType;
    private readonly signer?: KcSigner;
    private socket?: WebSocket;
    private started = false;
    private connected = false;
    private reconnectAttempts = 0;
    private reconnectTimer?: ReturnType<typeof setTimeout>;
    private pingTimer?: ReturnType<typeof setTimeout>;
    private pongTimer?: ReturnType<typeof setTimeout>;
    private pendingPingId?: string;
    private pingInterval = DEFAULT_PING_INTERVAL;
    private pingTimeout = DEFAULT_PING_TIMEOUT;
    private pendingAcks = new Map<string, PendingAck>();
    private subscriptions = new Map<string, UtaPushSubscription>();

    static public(option: ClientOption, tradeType: UtaPushTradeType): UtaPushWsService {
        return new UtaPushWsService(option, false, tradeType);
    }

    static private(option: ClientOption): UtaPushWsService {
        return new UtaPushWsService(option, true);
    }

    private constructor(option: ClientOption, privateChannel: boolean, tradeType?: UtaPushTradeType) {
        this.option = { ...DEFAULT_WEBSOCKET_CLIENT_OPTION, ...option.webSocketClientOption };
        this.privateChannel = privateChannel;
        this.tradeType = tradeType;
        this.endpoint = privateChannel ? PRIVATE_PUSH_ENDPOINT : PUBLIC_PUSH_ENDPOINT[tradeType!];

        if (privateChannel) {
            if (!option.key || !option.secret || !option.passphrase) {
                throw new Error('UTA private WebSocket requires key, secret, and passphrase');
            }
            this.signer = new KcSigner(
                option.key,
                option.secret,
                option.passphrase,
                option.brokerName,
                option.brokerPartner,
                option.brokerKey,
            );
        }
    }

    async start(): Promise<void> {
        if (this.started && this.connected) {
            return;
        }
        this.started = true;
        try {
            await this.dial();
        } catch (error) {
            this.started = false;
            if (this.reconnectTimer) {
                clearTimeout(this.reconnectTimer);
                this.reconnectTimer = undefined;
            }
            throw error;
        }
    }

    async stop(): Promise<void> {
        this.started = false;
        this.connected = false;
        this.clearTimers();
        this.rejectPending(new Error('UTA WebSocket stopped'));
        const socket = this.socket;
        this.socket = undefined;
        if (socket && socket.readyState === WebSocket.OPEN) {
            await new Promise<void>((resolve) => {
                socket.once('close', () => resolve());
                socket.close(1000, 'shutdown');
            });
        }
        this.notify(WebSocketEvent.EventClientShutdown, 'UTA');
    }

    async subscribe(subscription: UtaPushSubscription): Promise<string> {
        if (!this.connected) {
            throw new Error('UTA WebSocket is not connected; call start() first');
        }
        if (!subscription.callback) {
            throw new Error('subscription callback must not be empty');
        }
        this.validateSubscription(subscription);

        const id = randomUUID();
        this.subscriptions.set(id, subscription);
        try {
            await this.sendSubscription(id, 'SUBSCRIBE', subscription);
            return id;
        } catch (error) {
            this.subscriptions.delete(id);
            throw error;
        }
    }

    async unsubscribe(id: string): Promise<void> {
        const subscription = this.subscriptions.get(id);
        if (!subscription) {
            throw new Error(`unknown UTA subscription: ${id}`);
        }
        if (this.connected) {
            await this.sendSubscription(id, 'UNSUBSCRIBE', subscription);
        }
        this.subscriptions.delete(id);
    }

    private async dial(): Promise<void> {
        this.clearTimers();
        await new Promise<void>((resolve, reject) => {
            let settled = false;
            const timeout = setTimeout(() => {
                finish(new Error('welcome not received before dial timeout'));
                this.socket?.close(1000, 'dial timeout');
            }, this.option.dialTimeout);
            const finish = (error?: Error) => {
                if (settled) {
                    return;
                }
                settled = true;
                clearTimeout(timeout);
                if (error) {
                    reject(error);
                } else {
                    resolve();
                }
            };

            const socket = new WebSocket(this.endpoint);
            this.socket = socket;
            socket.on('message', (raw) => {
                const message = this.parseMessage(raw.toString());
                if (!message) {
                    return;
                }
                if (this.isWelcome(message)) {
                    this.pingInterval = this.positiveNumber(message.pingInterval, DEFAULT_PING_INTERVAL);
                    this.pingTimeout = this.positiveNumber(message.pingTimeout, DEFAULT_PING_TIMEOUT);
                    this.afterWelcome()
                        .then(() => finish())
                        .catch((error) => finish(this.toError(error)));
                    return;
                }
                this.handleMessage(message);
            });
            socket.on('error', (error) => {
                if (!this.connected) {
                    finish(new Error(`WebSocket connection failed: ${error.message}`));
                }
                this.notify(WebSocketEvent.EventErrorReceived, error.message);
            });
            socket.on('close', (code, reason) => {
                const detail = `closed ${code}: ${reason.toString()}`;
                if (!this.connected) {
                    finish(new Error(detail));
                }
                this.handleDisconnect(detail);
            });
        });
    }

    private async afterWelcome(): Promise<void> {
        if (this.privateChannel) {
            await this.authenticate();
        }
        this.connected = true;
        this.reconnectAttempts = 0;
        this.schedulePing();
        this.notify(WebSocketEvent.EventConnected, this.privateChannel ? 'UTA_PRIVATE' : 'UTA_PUBLIC');
        for (const [id, subscription] of this.subscriptions) {
            await this.sendSubscription(id, 'SUBSCRIBE', subscription);
            this.notify(WebSocketEvent.EventReSubscribeOK, id);
        }
    }

    private async authenticate(): Promise<void> {
        const headers = this.signer!.headers(PRIVATE_AUTH_PLAINTEXT);
        await this.sendAndAwaitAck(randomUUID(), {
            op: 'auth',
            'kc-api-key': headers['KC-API-KEY'],
            'kc-api-sign': headers['KC-API-SIGN'],
            'kc-api-timestamp': headers['KC-API-TIMESTAMP'],
            'kc-api-passphrase': headers['KC-API-PASSPHRASE'],
        });
    }

    private async sendSubscription(
        id: string,
        action: 'SUBSCRIBE' | 'UNSUBSCRIBE',
        subscription: UtaPushSubscription,
    ): Promise<void> {
        const message: Record<string, unknown> = {
            action,
            channel: subscription.channel,
        };
        if (subscription.tradeType) {
            message.tradeType = subscription.tradeType;
        }
        if (subscription.accountType) {
            message.accountType = subscription.accountType;
        }
        if (subscription.symbol) {
            message.symbol = subscription.symbol;
        } else if (subscription.symbols?.length === 1) {
            message.symbol = subscription.symbols[0];
        } else if (subscription.symbols?.length) {
            message.symbols = subscription.symbols;
        }
        Object.assign(message, subscription.parameters);
        await this.sendAndAwaitAck(id, message);
    }

    private sendAndAwaitAck(id: string, message: Record<string, unknown>): Promise<void> {
        const socket = this.socket;
        if (!socket || socket.readyState !== WebSocket.OPEN) {
            return Promise.reject(new Error('UTA WebSocket is not open'));
        }
        return new Promise<void>((resolve, reject) => {
            const timer = setTimeout(() => {
                this.pendingAcks.delete(id);
                reject(new Error(`UTA WebSocket request timed out: ${id}`));
            }, this.option.writeTimeout);
            this.pendingAcks.set(id, { resolve, reject, timer });
            socket.send(JSON.stringify({ id, ...message }), (error) => {
                if (!error) {
                    return;
                }
                const pending = this.pendingAcks.get(id);
                if (pending) {
                    clearTimeout(pending.timer);
                    this.pendingAcks.delete(id);
                    pending.reject(error);
                }
            });
        });
    }

    private handleMessage(message: DirectWsMessage): void {
        if (this.isPong(message)) {
            this.pendingPingId = undefined;
            if (this.pongTimer) {
                clearTimeout(this.pongTimer);
                this.pongTimer = undefined;
            }
            this.notify(WebSocketEvent.EventPongReceived, JSON.stringify(message));
            return;
        }

        if (message.id && message.result !== undefined) {
            const pending = this.pendingAcks.get(message.id);
            if (pending) {
                clearTimeout(pending.timer);
                this.pendingAcks.delete(message.id);
                if (message.result === true || message.result === 'true') {
                    pending.resolve();
                } else {
                    pending.reject(new Error(JSON.stringify(message)));
                }
            }
            return;
        }

        if (message.T && message.d !== undefined) {
            this.notify(WebSocketEvent.EventMessageReceived, JSON.stringify(message));
            this.dispatch(message as UtaPushEvent);
        }
    }

    private dispatch(event: UtaPushEvent): void {
        const incomingChannel = event.T.startsWith('execution.lite.')
            ? 'execution.lite'
            : event.T.split('.')[0];
        for (const subscription of this.subscriptions.values()) {
            if (!this.matches(subscription, incomingChannel, event)) {
                continue;
            }
            try {
                Promise.resolve(subscription.callback(event)).catch((error) => {
                    this.notify(WebSocketEvent.EventCallbackError, this.toError(error).message);
                });
            } catch (error) {
                this.notify(WebSocketEvent.EventCallbackError, this.toError(error).message);
            }
        }
    }

    private matches(
        subscription: UtaPushSubscription,
        incomingChannel: string,
        event: UtaPushEvent,
    ): boolean {
        const channelMatches =
            subscription.channel === incomingChannel ||
            (subscription.channel === 'orderAll' && incomingChannel === 'order') ||
            (subscription.channel === 'positionAll' && incomingChannel === 'position');
        if (!channelMatches) {
            return false;
        }
        if (subscription.accountType && event.T !== `balance.${subscription.accountType}`) {
            return false;
        }
        const symbol = (event.d as Record<string, UtaWsValue>).s;
        const expectedSymbols = subscription.symbol ? [subscription.symbol] : subscription.symbols;
        return !expectedSymbols?.length || expectedSymbols.includes(String(symbol));
    }

    private schedulePing(): void {
        if (!this.started || !this.connected) {
            return;
        }
        this.pingTimer = setTimeout(() => {
            if (!this.socket || this.socket.readyState !== WebSocket.OPEN) {
                return;
            }
            const id = randomUUID();
            this.pendingPingId = id;
            this.socket.send(JSON.stringify({ id, op: 'ping', timestamp: Date.now() }));
            this.pongTimer = setTimeout(() => {
                if (this.pendingPingId === id) {
                    this.socket?.close(4000, 'pong timeout');
                }
            }, this.pingTimeout);
            this.schedulePing();
        }, this.pingInterval);
    }

    private handleDisconnect(detail: string): void {
        const wasConnected = this.connected;
        this.connected = false;
        this.clearTimers();
        this.rejectPending(new Error(detail));
        if (wasConnected) {
            this.notify(WebSocketEvent.EventDisconnected, detail);
        }
        if (!this.started || !this.option.reconnect) {
            return;
        }
        if (
            this.option.reconnectAttempts >= 0 &&
            this.reconnectAttempts >= this.option.reconnectAttempts
        ) {
            this.notify(WebSocketEvent.EventClientFail, detail);
            return;
        }
        this.reconnectAttempts += 1;
        this.notify(WebSocketEvent.EventTryReconnect, detail);
        this.reconnectTimer = setTimeout(() => {
            this.dial().catch((error) => logger.warn('UTA WebSocket reconnect failed', error));
        }, this.option.reconnectInterval);
    }

    private validateSubscription(subscription: UtaPushSubscription): void {
        if (!subscription.channel) {
            throw new Error('subscription channel must not be empty');
        }
        const channelsWithoutSymbol = new Set([
            'funding-fee-all-symbols',
            'execution',
            'execution.lite',
            'orderAll',
            'balance',
            'positionAll',
            'leverage',
            'lw',
        ]);
        if (
            !subscription.symbol &&
            !subscription.symbols?.length &&
            !channelsWithoutSymbol.has(subscription.channel)
        ) {
            throw new Error(`${subscription.channel} requires a symbol or symbols`);
        }
    }

    private parseMessage(raw: string): DirectWsMessage | undefined {
        try {
            return JSON.parse(raw) as DirectWsMessage;
        } catch (error) {
            this.notify(WebSocketEvent.EventErrorReceived, `invalid UTA WebSocket message: ${raw}`);
            return undefined;
        }
    }

    private isWelcome(message: DirectWsMessage): boolean {
        return (
            message.message?.toLowerCase() === 'welcome' ||
            message.op?.toLowerCase() === 'welcome' ||
            message.type?.toLowerCase() === 'welcome'
        );
    }

    private isPong(message: DirectWsMessage): boolean {
        return message.op?.toLowerCase() === 'pong' || message.type?.toLowerCase() === 'pong';
    }

    private clearTimers(): void {
        for (const timer of [this.reconnectTimer, this.pingTimer, this.pongTimer]) {
            if (timer) {
                clearTimeout(timer);
            }
        }
        this.reconnectTimer = undefined;
        this.pingTimer = undefined;
        this.pongTimer = undefined;
        this.pendingPingId = undefined;
    }

    private rejectPending(error: Error): void {
        for (const [id, pending] of this.pendingAcks) {
            clearTimeout(pending.timer);
            pending.reject(error);
            this.pendingAcks.delete(id);
        }
    }

    private positiveNumber(value: unknown, fallback: number): number {
        return typeof value === 'number' && value > 0 ? value : fallback;
    }

    private notify(event: WebSocketEvent, message: string): void {
        try {
            this.option.eventCallback?.(event, message);
        } catch (error) {
            logger.warn(`UTA WebSocket event callback failed: ${this.toError(error).message}`);
        }
    }

    private toError(error: unknown): Error {
        return error instanceof Error ? error : new Error(String(error));
    }
}
