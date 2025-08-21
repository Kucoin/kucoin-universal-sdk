import { WebSocketMessageCallback, WebSocketService } from '@internal/interfaces/websocket';
import { ClientOption } from '@model/client_option';
import { DomainType, MessageType } from '@model/constant';

import { DefaultTransport } from './default_transport';
import { TopicManager } from './default_ws_callback';
import { DefaultWsTokenProvider } from './default_ws_token_provider';
import { WebSocketClient } from './default_ws_client';
import { WebSocketClientOption, WebSocketEvent } from '@src/model';

import { SubInfo } from '@internal/util/sub';
import { WsMessage } from '@model/common';
import { randomUUID } from 'crypto';
import { EventEmitter } from 'events';
import { logger } from '@src/common';
import { DefaultWebsocketMetaProvider } from '@internal/infra/default_ws_meta_provider';

/**
 * DefaultWsService implements the WebSocket service interface for handling real-time data communication.
 * It manages WebSocket connections, subscriptions, and message handling with automatic reconnection support.
 */
export class DefaultWsService implements WebSocketService {
    private readonly wsOption: WebSocketClientOption;
    private readonly privateChannel: boolean;
    private readonly tokenTransport: DefaultTransport;
    private topicManager: TopicManager;
    private client: WebSocketClient;
    private readonly eventEmitter: EventEmitter;

    constructor(
        option: ClientOption,
        domain: DomainType,
        privateChannel: boolean,
        versionString: string,
    ) {
        if (!option.webSocketClientOption) {
            throw new Error('WebSocketClientOption is undefined');
        }
        this.wsOption = option.webSocketClientOption;
        this.privateChannel = privateChannel;
        this.tokenTransport = new DefaultTransport(option, versionString);
        this.topicManager = new TopicManager();
        this.eventEmitter = new EventEmitter();
        this.eventEmitter.on('event', (event: WebSocketEvent, msg: string) => {
            if (this.wsOption.eventCallback) {
                try {
                    this.wsOption.eventCallback(event, msg);
                } catch (e) {
                    logger.error(`call event callback error, event: ${event}`, e);
                }
            }
        });
        this.client = new WebSocketClient(
            new DefaultWebsocketMetaProvider(
                new DefaultWsTokenProvider(this.tokenTransport, domain, privateChannel),
            ),
            this.wsOption,
        );
        this.client.on('event', (event: WebSocketEvent, msg: string) => {
            this.eventEmitter.emit('event', event, msg);
        });
        this.client.on('message', (message: WsMessage) => {
            this.processMessages(message);
        });
        this.client.on('reconnected', () => {
            this.recovery();
        });
    }

    start(): Promise<void> {
        return this.client.start();
    }

    stop(): Promise<void> {
        return Promise.all([this.tokenTransport.close(), this.client.stop()]).then();
    }

    subscribe(prefix: string, args: string[], callback: WebSocketMessageCallback): Promise<string> {
        // Create subscription info with prefix, args, and callback
        const subInfo = new SubInfo(prefix, args || [], callback);
        const subId = subInfo.toId();

        // Get callback manager for the prefix and attempt to add subscription
        const callbackManager = this.topicManager.getCallbackManager(prefix);
        const created = callbackManager.add(subInfo);

        // Check if already subscribed
        if (!created) {
            logger.warn(`Already subscribed: ${subId}`);
            return Promise.reject(new Error('Already subscribed'));
        }

        // Create subscription message
        const subEvent = new WsMessage();
        subEvent.id = subId;
        subEvent.type = MessageType.SubscribeMessage;
        subEvent.topic = subInfo.subTopic();
        subEvent.privateChannel = this.privateChannel;
        subEvent.response = true;

        return this.client
            .write(subEvent.id, subEvent, this.wsOption.writeTimeout)
            .then(() => {
                logger.info(`subscribed id: ${subId}`);
                return subId;
            })
            .catch((err) => {
                // Clean up on failure
                const callbackManager = this.topicManager.getCallbackManager(subInfo.prefix);
                callbackManager.remove(subId);
                logger.error(`subscribe id: ${subId}, error`, err);
                throw err;
            });
    }

    unsubscribe(id: string): Promise<void> {
        return new Promise((resolve, reject) => {
            const subInfo = SubInfo.fromId(id);
            const callbackManager = this.topicManager.getCallbackManager(subInfo.prefix);

            const subEvent = new WsMessage();

            subEvent.id = randomUUID().toString();
            subEvent.type = MessageType.UnsubscribeMessage;
            subEvent.topic = subInfo.subTopic();
            subEvent.privateChannel = this.privateChannel;
            subEvent.response = true;

            this.client
                .write(subEvent.id, subEvent, this.wsOption.writeTimeout)
                .then(() => {
                    callbackManager.remove(id);
                    logger.info(`unsubscribe id: ${id}`);
                    resolve();
                })
                .catch((e) => {
                    logger.error(`unsubscribe id: ${id}, error`, e);
                    reject(e);
                });
        });
    }

    private processMessages(message: WsMessage) {
        const callbackManager = this.topicManager.getCallbackManager(message.topic);
        if (!callbackManager) {
            logger.warn(`Unknown topic: ${message.topic}`);
            return;
        }

        const callback = callbackManager.get(message.topic);
        if (!callback) {
            logger.warn(`Unknown callback for topic: ${message.topic}`);
            return;
        }

        try {
            callback.onMessage(message);
        } catch (err) {
            logger.error('Error processing callback', err);
            this.eventEmitter.emit('event', WebSocketEvent.EventCallbackError, String(err));
        }
    }

    private recovery(): void {
        logger.info('WebSocket client reconnected, resubscribe...');

        const oldTopicManager = this.topicManager;
        this.topicManager = new TopicManager();

        oldTopicManager.range((key, value) => {
            for (const sub of value.getSubInfo()) {
                if (sub.callback) {
                    this.subscribe(sub.prefix, sub.args, sub.callback)
                        .then((id) => {
                            logger.info(`Resubscribe success, id:${id}`);
                            this.eventEmitter.emit('event', WebSocketEvent.EventReSubscribeOK, id);
                        })
                        .catch((err) => {
                            logger.info(`Resubscribe error, id:${sub.toId()}, err:${err}`);
                            this.eventEmitter.emit(
                                'event',
                                WebSocketEvent.EventReSubscribeError,
                                err.toString(),
                            );
                        });
                }
            }
            return true;
        });
    }
}
