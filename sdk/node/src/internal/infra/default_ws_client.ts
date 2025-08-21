import { EventEmitter } from 'events';
import { MessageType } from '@model/constant';
import { WebSocketClientOption, WebSocketEvent } from '@model/websocket_option';
import {
    WebsocketMetaProvider,
    WebsocketTransport,
    WebsocketTransportEvents,
    WsParsedMessage,
} from '@internal/interfaces/websocket';
import { logger } from '@src/common';
import { TimeoutError, withTimeout } from '@internal/util/util';
import { WebSocketBootstrap } from '@internal/infra/websocket_bootstrap';
import WebSocket from 'ws';

enum ConnectionState {
    DISCONNECTED = 0,
    CONNECTING = 1,
    CONNECTED = 2,
}

interface WriteMsg {
    msg: any;
    resolve: (value: void) => void;
    reject: (reason?: any) => void;
}

// WebSocketClient class, used to manage WebSocket connection and its related operations
export class WebSocketClient extends EventEmitter implements WebsocketTransport {
    private options: WebSocketClientOption;
    private state: ConnectionState;
    private keepAliveInterval: any;
    private shutdown: boolean;
    private reconnecting = false;
    private metaProvider: WebsocketMetaProvider;

    private ackEvents: Map<string, WriteMsg>;
    private socket: WebSocket | null = null;

    constructor(metaProvider: WebsocketMetaProvider, options: WebSocketClientOption) {
        super();
        this.options = options;
        this.state = ConnectionState.DISCONNECTED;
        this.metaProvider = metaProvider;
        this.shutdown = false;
        this.ackEvents = new Map();
    }

    start(): Promise<void> {
        if (this.state != ConnectionState.DISCONNECTED) {
            logger.warn('WebSocket client is already connected.');
            return Promise.resolve();
        }
        this.state = ConnectionState.CONNECTING;
        return this.dial()
            .then(() => {
                this.state = ConnectionState.CONNECTED;
                this.keepAliveInterval = setInterval(
                    () => this.keepAlive(),
                    this.metaProvider.pingInterval(),
                );
                this.emit('event', WebSocketEvent.EventConnected, '');
            })
            .catch((err) => {
                this.state = ConnectionState.DISCONNECTED;
                logger.error('Failed to start webSocket client:', err);
                throw err;
            });
    }

    stop(): Promise<void> {
        this.shutdown = true;
        logger.info('shutting down websocket client...');
        return this.close().finally(() => {
            this.emit('event', WebSocketEvent.EventClientShutdown, '');
        });
    }

    write(id: string, ms: any, timeout: number): Promise<void> {
        if (this.state != ConnectionState.CONNECTED || this.shutdown) {
            return Promise.reject(new Error('Not connected or shutting down'));
        }

        return withTimeout<void>((resolve, reject) => {
            try {
                this.ackEvents.set(id, {
                    msg: ms,
                    resolve: resolve,
                    reject: reject,
                });

                this.socket!.send(ms);
            } catch (error) {
                logger.error('Failed to send message:', error);
                this.ackEvents.delete(id);
                reject(error);
            }
        }, timeout).catch((err) => {
            if (err instanceof TimeoutError) {
                logger.error('Send message timeout, id:', id);
                this.ackEvents.delete(id);
                throw err;
            }
        });
    }

    on<K extends keyof WebsocketTransportEvents>(
        event: K,
        listener: WebsocketTransportEvents[K],
    ): this {
        return super.on(event, listener);
    }

    emit<K extends keyof WebsocketTransportEvents>(
        event: K,
        ...args: Parameters<WebsocketTransportEvents[K]>
    ): boolean {
        return super.emit(event, ...args);
    }

    private close(): Promise<void> {
        logger.info('closing websocket client...');

        // clear intervals
        if (this.keepAliveInterval) {
            clearInterval(this.keepAliveInterval);
            this.keepAliveInterval = null;
        }

        // clear acks
        this.ackEvents.forEach((writeMsg) => {
            writeMsg.reject(new Error('WebSocket connection closed'));
        });
        this.ackEvents.clear();

        // set stats
        this.state = ConnectionState.DISCONNECTED;
        this.emit('event', WebSocketEvent.EventDisconnected, '');

        // delete worker
        if (this.socket) {
            this.socket.close();
            this.socket.terminate();
            this.socket = null;
        }

        return Promise.resolve();
    }

    // dial connects to the WebSocket server
    private dial(): Promise<void> {
        return this.metaProvider.buildUri().then((wsUrl) => {
            // Create a new websocket
            this.socket = new WebSocket(wsUrl);

            const webSocketBootstrap = new WebSocketBootstrap(
                this.metaProvider.handshakes(),
                this.onMessage,
            );

            this.socket.on('message', (message) => {
                webSocketBootstrap.onMessage(this.socket, message.toString());
            });

            this.socket.on('error', (err) => {
                this.reconnect(0, err.message);
            });
            this.socket.on('close', (code, reason) => {
                this.reconnect(code, reason.toString());
            });

            // TODO
            return webSocketBootstrap.getReadyPromise();
        });
    }

    // receive message callback
    private onMessage(message: string): void {
        let m: WsParsedMessage = this.metaProvider.parseMessage(message);
        switch (m.type) {
            case MessageType.Message:
                this.emit('message', m.message);
                if (m.ack) {
                    this.handleAckEvent(m.id);
                }

                break;
            case MessageType.PongMessage: {
                this.emit('event', WebSocketEvent.EventPongReceived, '');
                this.handleAckEvent(m.id);
                break;
            }
            case MessageType.AckMessage: {
                this.handleAckEvent(m.id);
                break;
            }
            case MessageType.ErrorMessage: {
                const errorMsg = m.message.toString();
                this.emit('event', WebSocketEvent.EventErrorReceived, String(errorMsg));
                this.handleAckEvent(m.id, new Error(errorMsg));
                break;
            }
            default:
                logger.warn('Unknown message type:', m.type);
        }
    }

    private handleAckEvent(id?: string, err?: Error): void {
        if (id == null) {
            logger.warn('Unknown ack event id: ', id);
            return;
        }

        const data = this.ackEvents.get(id);
        if (!data) {
            logger.warn('Unknown ack event id: ', id);
            return;
        }
        this.ackEvents.delete(id);
        if (err) {
            data.reject(err);
        } else {
            data.resolve();
        }
    }

    private keepAlive(): void {
        const pingMsg = this.metaProvider.pingMessage();
        this.write(pingMsg[0], pingMsg[1], this.metaProvider.pingTimeout())
            .catch((e) => {
                logger.error('keepalive ping error:', e);
            })
            .then(() => {
                logger.debug('send ping success');
            });
    }

    private reconnect(code: number, reason: string): Promise<void> {
        if (!this.shutdown) {
            logger.warn(`WebSocket closed with code ${code}: ${reason}`);
        }

        if (this.reconnecting) {
            return Promise.resolve();
        }

        this.reconnecting = true;

        return Promise.resolve()
            .then(() => {
                return this.close();
            })
            .then(() => {
                if (!this.shutdown && this.options.reconnect) {
                    this.emit('event', WebSocketEvent.EventTryReconnect, '');

                    const maxAttempts =
                        this.options.reconnectAttempts == -1
                            ? Number.MAX_VALUE
                            : this.options.reconnectAttempts;

                    return Promise.resolve().then(async () => {
                        for (let i = 0; i < maxAttempts; i++) {
                            logger.warn(`reconnecting... ${i}/${maxAttempts}`);
                            await new Promise((resolve) => {
                                setTimeout(resolve, this.options.reconnectInterval);
                            });
                            try {
                                await this.start();
                                logger.info('Successfully reconnected to WebSocket server');
                                this.emit('reconnected');
                                return;
                            } catch (e) {
                                logger.error(`reconnecting fail:`, e);
                            }
                        }
                        this.emit(
                            'event',
                            WebSocketEvent.EventClientFail,
                            'Failed to reconnect after all attempts',
                        );
                        logger.error('Failed to reconnect after all attempts.');
                    });
                }
            })
            .finally(async () => {
                this.reconnecting = false;
            });
    }
}
