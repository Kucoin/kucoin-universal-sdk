import { WsMessage } from '@model/common';
import { MessageType } from '@model/constant';
import { DefaultWsTokenProvider } from './default_ws_token_provider';
import {
    WebsocketHandshake,
    WebsocketMetaProvider,
    WsParsedMessage,
    WsToken,
    WsTokenProvider,
} from '@internal/interfaces/websocket';
import { logger } from '@src/common';

export class DefaultWebsocketMetaProvider implements WebsocketMetaProvider {
    private tokenProvider: WsTokenProvider;
    private token: WsToken | null = null;

    constructor(tokenProvider: WsTokenProvider) {
        this.tokenProvider = tokenProvider;
    }

    handshakes(): WebsocketHandshake[] {
        return [
            {
                invoke: (_socket, text: string) => {
                    const m = JSON.parse(text);
                    if (m.type !== MessageType.WelcomeMessage) {
                        throw new Error('unexpected message: ' + text);
                    }
                    logger.info('receive welcome message: {}', text);
                },
            },
        ];
    }

    parseMessage(text: string): WsParsedMessage {
        const m = JSON.parse(text) as WsMessage;
        return { type: m.type, id: m.id, message: m, ack: false };
    }

    async buildUri(): Promise<string> {
        const tokens = await this.tokenProvider.getToken();
        this.token = this.randomEndpoint(tokens);
        const queryParams = new URLSearchParams({
            connectId: Date.now().toString(),
            token: this.token.token,
        });
        return `${this.token.endpoint}?${queryParams.toString()}`;
    }

    pingInterval(): number {
        return this.token!.pingInterval;
    }

    pingTimeout(): number {
        return this.token!.pingTimeout;
    }

    pingMessage(): [string, any] {
        const pingMsg = new WsMessage();
        pingMsg.id = Date.now().toString();
        pingMsg.type = MessageType.PingMessage;
        return [pingMsg.id, pingMsg];
    }

    close(): Promise<void> {
        return this.tokenProvider.close();
    }

    private randomEndpoint(tokens: WsToken[]): WsToken {
        if (!tokens.length) {
            throw new Error('Tokens list is empty');
        }
        return tokens[Math.floor(Math.random() * tokens.length)];
    }
}
