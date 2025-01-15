// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { IndexPriceEventCallback, IndexPriceEventCallbackWrapper } from './model_index_price_event';
import { MarkPriceEventCallback, MarkPriceEventCallbackWrapper } from './model_mark_price_event';
import { WebSocketService } from '@internal/interfaces/websocket';

export interface MarginPublicWS {
    /**
     * indexPrice Index Price
     * Subscribe to this topic to get the index price for the margin trading. The following ticker symbols are supported: List of currently supported symbol.
     * push frequency: once every 1s
     */
    indexPrice(symbol: Array<string>, callback: IndexPriceEventCallback): Promise<string>;

    /**
     * markPrice Mark Price
     * Subscribe to this topic to get the mark price for margin trading.The following ticker symbols are supported: List of currently supported symbol
     * push frequency: once every 1s
     */
    markPrice(symbol: Array<string>, callback: MarkPriceEventCallback): Promise<string>;

    /**
     * Unsubscribe from topics
     */
    unSubscribe(id: string): Promise<void>;

    /**
     * Start websocket
     */
    start(): Promise<void>;

    /**
     * Stop websocket
     */
    stop(): Promise<void>;
}

export class MarginPublicWSImpl implements MarginPublicWS {
    private wsService: WebSocketService;

    constructor(wsService: WebSocketService) {
        this.wsService = wsService;
    }

    indexPrice(symbol: Array<string>, callback: IndexPriceEventCallback): Promise<string> {
        let topicPrefix = '/indicator/index';

        let args: string[] = symbol;

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new IndexPriceEventCallbackWrapper(callback),
        );
    }

    markPrice(symbol: Array<string>, callback: MarkPriceEventCallback): Promise<string> {
        let topicPrefix = '/indicator/markPrice';

        let args: string[] = symbol;

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new MarkPriceEventCallbackWrapper(callback),
        );
    }

    unSubscribe(id: string): Promise<void> {
        return this.wsService.unsubscribe(id);
    }

    start(): Promise<void> {
        return this.wsService.start();
    }

    stop(): Promise<void> {
        return this.wsService.stop();
    }
}