import { ClientOption } from '@model/client_option';
import { UnifiedWsMessage } from '@model/unified_ws';
import * as crypto from 'crypto';
import { KcSigner } from '@internal/infra/default_signer';
import { CodeSuccess, MessageType } from '@src/model';
import {
    WebsocketHandshake,
    WebsocketMetaProvider,
    WsParsedMessage,
} from '@internal/interfaces/websocket';

export class DefaultWebsocketUnifiedMetaProvider implements WebsocketMetaProvider {
    private readonly opt: ClientOption;
    private pingIntervalMs = 10000;
    private pingTimeoutMs = 5000;

    constructor(opt: ClientOption) {
        this.opt = opt;
    }

    handshakes(): WebsocketHandshake[] {
        return [
            // step1: sign auth message
            {
                invoke: (socket: any, text: string) => {
                    const m = JSON.parse(text);
                    if (m.code && m.code !== CodeSuccess) {
                        throw new Error('expected auth success, but get: ' + text);
                    }
                    const sig = KcSigner.sign(Buffer.from(text), Buffer.from(this.opt.secret!));
                    socket.send(sig);
                },
            },
            // step2: receive welcome message
            {
                invoke: (_socket: any, text: string) => {
                    const m = JSON.parse(text);
                    const data = m.data;
                    this.pingIntervalMs = m.pingInterval || this.pingIntervalMs;
                    this.pingTimeoutMs = m.pingTimeout || this.pingTimeoutMs;
                    if (data !== MessageType.WelcomeMessage) {
                        throw new Error('expected welcome message, but get: ' + text);
                    }
                },
            },
        ];
    }

    parseMessage(text: string): WsParsedMessage {
        const m = JSON.parse(text) as UnifiedWsMessage;
        let type = 'message';
        let ack = false;
        if (m.op === MessageType.PongMessage) {
            type = MessageType.PongMessage;
        } else {
            type = MessageType.Message;
            ack = true;
        }
        return { type, id: m.id, message: m, ack };
    }

    async buildUri(): Promise<string> {
        if (
            !this.opt.unifiedWsEndpoint ||
            !this.opt.key ||
            !this.opt.secret ||
            !this.opt.passphrase
        ) {
            throw new Error('Unified WebSocket requires endpoint and credentials');
        }
        const timestamp = Date.now();
        const sign = KcSigner.signString(`${this.opt.key}${timestamp}`, this.opt.secret);
        const pass = KcSigner.signString(this.opt.passphrase, this.opt.secret);
        const params = new URLSearchParams({
            apikey: this.opt.key,
            sign: sign,
            passphrase: pass,
            timestamp: String(timestamp),
        });
        return `${this.opt.unifiedWsEndpoint}/v1/private?${params.toString()}`;
    }

    pingInterval(): number {
        return this.pingIntervalMs;
    }

    pingTimeout(): number {
        return this.pingTimeoutMs;
    }

    pingMessage(): [string, any] {
        const id = crypto.randomUUID();
        return [id, { id, op: MessageType.PingMessage, timestamp: Date.now().toString() }];
    }

    close(): Promise<void> {
        return Promise.resolve();
    }
}
