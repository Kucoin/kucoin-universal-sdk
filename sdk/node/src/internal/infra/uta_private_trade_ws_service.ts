import { createHmac, randomUUID } from 'crypto';
import WebSocket from 'ws';
import { logger } from '@src/common';
import { KcSigner } from '@internal/infra/default_signer';
import { ClientOption } from '@model/client_option';
import { DEFAULT_WEBSOCKET_CLIENT_OPTION, WebSocketClientOption } from '@model/websocket_option';

export interface UtaTradeWsResponse<T = Record<string, unknown>> {
    code: string | number;
    msg?: string;
    id?: string;
    op?: string;
    data?: T;
    inTime?: string | number;
    outTime?: string | number;
    userRateLimit?: Record<string, string | number>;
    rateLimit?: Record<string, string | number>;
}

interface DirectTradeMessage extends UtaTradeWsResponse {
    sessionId?: string;
    timestamp?: string | number;
    message?: string;
    type?: string;
    [key: string]: unknown;
}

interface PendingTradeRequest {
    operation: string;
    resolve: (response: UtaTradeWsResponse) => void;
    reject: (error: Error) => void;
    timer: ReturnType<typeof setTimeout>;
}

const PRIVATE_TRADE_ENDPOINT = 'wss://wsapi.kucoin.com/v1/private';

/** Direct authenticated UTA trading WebSocket transport (`uta.order`, `uta.cancel`, `uta.amend`). */
export class UtaPrivateTradeWsService {
    private readonly option: WebSocketClientOption;
    private readonly signer: KcSigner;
    private readonly apiKey: string;
    private readonly apiSecret: string;
    private socket?: WebSocket;
    private started = false;
    private connected = false;
    private reconnectAttempts = 0;
    private reconnectTimer?: ReturnType<typeof setTimeout>;
    private pending = new Map<string, PendingTradeRequest>();

    constructor(clientOption: ClientOption) {
        if (!clientOption.key || !clientOption.secret || !clientOption.passphrase) {
            throw new Error('UTA private trade WebSocket requires key, secret, and passphrase');
        }
        this.option = { ...DEFAULT_WEBSOCKET_CLIENT_OPTION, ...clientOption.webSocketClientOption };
        this.apiKey = clientOption.key;
        this.apiSecret = clientOption.secret;
        this.signer = new KcSigner(
            clientOption.key,
            clientOption.secret,
            clientOption.passphrase,
            clientOption.brokerName,
            clientOption.brokerPartner,
            clientOption.brokerKey,
        );
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

    async placeOrder(args: Record<string, unknown>): Promise<UtaTradeWsResponse> {
        return this.request('uta.order', this.orderArguments(args));
    }

    async cancelOrder(args: Record<string, unknown>): Promise<UtaTradeWsResponse> {
        if (this.blank(args.orderId) && this.blank(args.clientOid)) {
            throw new Error('either orderId or clientOid must be provided');
        }
        return this.request('uta.cancel', this.compact(args));
    }

    async amendOrder(args: Record<string, unknown>): Promise<UtaTradeWsResponse> {
        if (this.blank(args.orderId) && this.blank(args.clientOid)) {
            throw new Error('either orderId or clientOid must be provided');
        }
        return this.request('uta.amend', this.orderArguments(args));
    }

    async stop(): Promise<void> {
        this.started = false;
        this.connected = false;
        if (this.reconnectTimer) {
            clearTimeout(this.reconnectTimer);
            this.reconnectTimer = undefined;
        }
        this.failPending(new Error('UTA private trade WebSocket stopped'));
        const socket = this.socket;
        this.socket = undefined;
        if (socket && socket.readyState === WebSocket.OPEN) {
            await new Promise<void>((resolve) => {
                socket.once('close', () => resolve());
                socket.close(1000, 'shutdown');
            });
        }
    }

    private async request(operation: string, args: Record<string, unknown>): Promise<UtaTradeWsResponse> {
        if (!this.connected || !this.socket || this.socket.readyState !== WebSocket.OPEN) {
            throw new Error('UTA private trade WebSocket is not connected; call start() first');
        }
        const id = randomUUID();
        return new Promise<UtaTradeWsResponse>((resolve, reject) => {
            const timer = setTimeout(() => {
                this.pending.delete(id);
                reject(new Error(`${operation} response timed out`));
            }, this.option.writeTimeout);
            this.pending.set(id, { operation, resolve, reject, timer });
            this.socket!.send(JSON.stringify({ id, op: operation, args }), (error) => {
                if (!error) {
                    return;
                }
                const pending = this.pending.get(id);
                if (pending) {
                    clearTimeout(pending.timer);
                    this.pending.delete(id);
                    pending.reject(error);
                }
            });
        });
    }

    private async dial(): Promise<void> {
        const headers = this.signer.headers('');
        const query = new URLSearchParams({
            apikey: this.apiKey,
            timestamp: headers['KC-API-TIMESTAMP'],
            sign: this.hmac(`${this.apiKey}${headers['KC-API-TIMESTAMP']}`),
            passphrase: headers['KC-API-PASSPHRASE'],
        });
        const endpoint = `${PRIVATE_TRADE_ENDPOINT}?${query.toString()}`;

        await new Promise<void>((resolve, reject) => {
            let settled = false;
            const finish = (error?: Error) => {
                if (settled) {
                    return;
                }
                settled = true;
                clearTimeout(timeout);
                error ? reject(error) : resolve();
            };
            const timeout = setTimeout(() => {
                finish(new Error('welcome not received before dial timeout'));
                this.socket?.close(1000, 'dial timeout');
            }, this.option.dialTimeout);
            const socket = new WebSocket(endpoint);
            this.socket = socket;
            socket.on('message', (raw) => {
                const rawText = raw.toString();
                const message = this.parseMessage(rawText);
                if (!message) {
                    return;
                }
                if (this.isAuthChallenge(message)) {
                    socket.send(this.hmac(rawText));
                    return;
                }
                if (this.isWelcome(message)) {
                    this.connected = true;
                    this.reconnectAttempts = 0;
                    finish();
                    return;
                }
                this.handleMessage(message);
            });
            socket.on('error', (error) => {
                if (!this.connected) {
                    finish(new Error(`WebSocket connection failed: ${error.message}`));
                }
            });
            socket.on('close', (code, reason) => {
                const error = new Error(`closed ${code}: ${reason.toString()}`);
                if (!this.connected) {
                    finish(error);
                }
                this.handleDisconnect(error);
            });
        });
    }

    private handleMessage(message: DirectTradeMessage): void {
        if (!message.id) {
            return;
        }
        const pending = this.pending.get(message.id);
        if (!pending) {
            return;
        }
        clearTimeout(pending.timer);
        this.pending.delete(message.id);
        if (String(message.code) === '200000') {
            pending.resolve(message);
        } else {
            pending.reject(new Error(`${pending.operation} failed: ${JSON.stringify(message)}`));
        }
    }

    private handleDisconnect(error: Error): void {
        const wasConnected = this.connected;
        this.connected = false;
        this.failPending(error);
        if (!wasConnected || !this.started || !this.option.reconnect) {
            return;
        }
        if (
            this.option.reconnectAttempts >= 0 &&
            this.reconnectAttempts >= this.option.reconnectAttempts
        ) {
            return;
        }
        this.reconnectAttempts += 1;
        this.reconnectTimer = setTimeout(() => {
            this.dial().catch((dialError) => logger.warn('UTA private trade reconnect failed', dialError));
        }, this.option.reconnectInterval);
    }

    private orderArguments(args: Record<string, unknown>): Record<string, unknown> {
        const compact = this.compact(args);
        // The server rejects tp/sl trigger *type* without its matching trigger price. Auto-generated
        // request objects often leave those optional fields blank, so omit the orphaned type safely.
        if (this.blank(compact.tpTriggerPrice)) {
            delete compact.tpTriggerPrice;
            delete compact.tpTriggerPriceType;
        }
        if (this.blank(compact.slTriggerPrice)) {
            delete compact.slTriggerPrice;
            delete compact.slTriggerPriceType;
        }
        return compact;
    }

    private compact(args: Record<string, unknown>): Record<string, unknown> {
        return Object.fromEntries(
            Object.entries(args).filter(([, value]) => value !== undefined && value !== null && value !== ''),
        );
    }

    private blank(value: unknown): boolean {
        return value === undefined || value === null || (typeof value === 'string' && value.trim() === '');
    }

    private hmac(value: string): string {
        return createHmac('sha256', this.apiSecret).update(value).digest('base64');
    }

    private isWelcome(message: DirectTradeMessage): boolean {
        return (
            String(message.data ?? '').toLowerCase() === 'welcome' ||
            message.message?.toLowerCase() === 'welcome' ||
            message.type?.toLowerCase() === 'welcome' ||
            message.op?.toLowerCase() === 'welcome'
        );
    }

    private isAuthChallenge(message: DirectTradeMessage): boolean {
        return !!message.sessionId && message.timestamp !== undefined && message.data === undefined;
    }

    private parseMessage(raw: string): DirectTradeMessage | undefined {
        try {
            return JSON.parse(raw) as DirectTradeMessage;
        } catch (error) {
            logger.warn(`Unable to decode UTA private trade WebSocket message: ${raw}`);
            return undefined;
        }
    }

    private failPending(error: Error): void {
        for (const [id, pending] of this.pending) {
            clearTimeout(pending.timer);
            pending.reject(error);
            this.pending.delete(id);
        }
    }
}
