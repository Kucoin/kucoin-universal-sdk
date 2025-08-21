import { ClientOption } from '@model/client_option';
import { WebSocketClientOption, WebSocketEvent } from '@model/websocket_option';
import { WebSocketClient } from './default_ws_client';
import { DefaultWebsocketUnifiedMetaProvider } from './default_ws_unified_meta_provider';
import { UnifiedWsArgs, UnifiedWsMessage } from '@model/unified_ws';
import { logger } from '@src/common';
import { randomUUID } from 'crypto';

export class DefaultWebSocketUnifiedService {
    private readonly option: WebSocketClientOption;
    private readonly client: WebSocketClient;
    private readonly futureMap: Map<
        string,
        { resolve: (v: UnifiedWsMessage) => void; reject: (e: any) => void }
    >;

    constructor(opt: ClientOption, sdkVersion: string) {
        if (!opt.unifiedWsEndpoint) {
            throw new Error('Missing unified WebSocket endpoint');
        }
        if (!opt.webSocketClientOption) {
            throw new Error('Missing WebSocketClientOption');
        }
        this.option = opt.webSocketClientOption;
        this.futureMap = new Map();
        this.client = new WebSocketClient(
            new DefaultWebsocketUnifiedMetaProvider(opt),
            this.option,
        );

        this.client.on('event', (ev: WebSocketEvent, msg: string) => this.notifyEvent(ev, msg));
        this.client.on('message', (wsMessage: UnifiedWsMessage) => {
            const fut = this.futureMap.get(wsMessage.id);
            if (fut) {
                this.futureMap.delete(wsMessage.id);
                try {
                    fut.resolve(wsMessage);
                } catch (e) {
                    logger.warn('Future already resolved', e);
                }
            }
        });
        this.client.on('reconnected', () => {
            // nothing to do for unified
        });
    }

    private notifyEvent(ev: any, msg: string) {
        if (this.option.eventCallback) {
            try {
                this.option.eventCallback(ev, msg);
            } catch (e) {
                logger.error('exception when notify event', e as any);
            }
        }
    }

    start() {
        return this.client.start();
    }

    stop() {
        return this.client.stop();
    }

    call(args: UnifiedWsArgs): Promise<UnifiedWsMessage> {
        if (!args.id) {
            args.id = randomUUID();
        }
        if (!args.op) {
            throw new Error('Missing required field: op');
        }

        return new Promise<UnifiedWsMessage>((resolve, reject) => {
            if (this.futureMap.has(args.id!)) {
                reject(new Error(`Duplicate request id: ${args.id}`));
                return;
            }
            this.futureMap.set(args.id!, { resolve, reject });

            logger.info(`Calling unified WebSocket API, id=${args.id}, op=${args.op}`);

            this.client
                .write(args.id!, args, this.option.writeTimeout)
                .then(() => {
                    logger.info(`Unified WebSocket API call sent, id=${args.id}, op=${args.op}`);
                })
                .catch((ex) => {
                    this.futureMap.delete(args.id!);
                    logger.error(
                        `Unified WebSocket API call failed, id=${args.id}, op=${args.op}, err=${ex}`,
                    );
                    reject(ex);
                });
        });
    }
}
