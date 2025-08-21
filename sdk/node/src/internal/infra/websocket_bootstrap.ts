import { logger } from '@src/common';
import { WebsocketHandshake } from '@internal/interfaces/websocket';

export class WebSocketBootstrap {
    private handshakes: WebsocketHandshake[];
    private idx = 0;
    private connected = false;
    private readyResolve!: () => void;
    private readyReject!: (e: any) => void;
    private readonly readyPromise: Promise<void>;
    private readonly messageHandler: (text: string) => void;

    constructor(handshakes: WebsocketHandshake[], messageHandler: (text: string) => void) {
        this.handshakes = handshakes;
        this.messageHandler = messageHandler;
        this.readyPromise = new Promise<void>((resolve, reject) => {
            this.readyResolve = resolve;
            this.readyReject = reject;
        });
    }

    getReadyPromise(): Promise<void> {
        return this.readyPromise;
    }

    onMessage(socket: any, txt: string): void {
        if (this.connected) {
            this.messageHandler(txt);
            return;
        }
        try {
            if (this.idx < this.handshakes.length) {
                const h = this.handshakes[this.idx++];
                h.invoke(socket, txt);
                if (this.idx >= this.handshakes.length) {
                    this.connected = true;
                    logger.info('websocket handshake done');
                    this.readyResolve();
                }
            } else {
                // No handshakes; mark ready
                this.connected = true;
                this.readyResolve();
                this.messageHandler(txt);
            }
        } catch (e) {
            this.readyReject(e);
        }
    }
}
