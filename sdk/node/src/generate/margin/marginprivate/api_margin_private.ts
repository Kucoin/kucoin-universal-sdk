// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import {
    CrossMarginPositionEventCallbackWrapper,
    CrossMarginPositionEventCallback,
} from './model_cross_margin_position_event';
import {
    IsolatedMarginPositionEventCallback,
    IsolatedMarginPositionEventCallbackWrapper,
} from './model_isolated_margin_position_event';
import { WebSocketService } from '@internal/interfaces/websocket';

export interface MarginPrivateWS {
    /**
     * crossMarginPosition Get Cross Margin Position change
     * The system will push the change event when the position status changes, or push the current debt message periodically when there is a liability.
     * push frequency: once every 4s
     */
    crossMarginPosition(callback: CrossMarginPositionEventCallback): Promise<string>;

    /**
     * isolatedMarginPosition Get Isolated Margin Position change
     * The system will push the change event when the position status changes, or push the current debt message periodically when there is a liability.
     * push frequency: real time
     */
    isolatedMarginPosition(
        symbol: string,
        callback: IsolatedMarginPositionEventCallback,
    ): Promise<string>;

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

export class MarginPrivateWSImpl implements MarginPrivateWS {
    private wsService: WebSocketService;

    constructor(wsService: WebSocketService) {
        this.wsService = wsService;
    }

    crossMarginPosition(callback: CrossMarginPositionEventCallback): Promise<string> {
        let topicPrefix = '/margin/position';

        let args: string[] = [];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new CrossMarginPositionEventCallbackWrapper(callback),
        );
    }

    isolatedMarginPosition(
        symbol: string,
        callback: IsolatedMarginPositionEventCallback,
    ): Promise<string> {
        let topicPrefix = '/margin/isolatedPosition';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new IsolatedMarginPositionEventCallbackWrapper(callback),
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
