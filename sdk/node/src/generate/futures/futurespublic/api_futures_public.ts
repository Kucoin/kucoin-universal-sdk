// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import {
    OrderbookLevel5EventCallbackWrapper,
    OrderbookLevel5EventCallback,
} from './model_orderbook_level5_event';
import { KlinesEventCallbackWrapper, KlinesEventCallback } from './model_klines_event';
import { TickerV2EventCallbackWrapper, TickerV2EventCallback } from './model_ticker_v2_event';
import {
    SymbolSnapshotEventCallback,
    SymbolSnapshotEventCallbackWrapper,
} from './model_symbol_snapshot_event';
import {
    OrderbookIncrementEventCallback,
    OrderbookIncrementEventCallbackWrapper,
} from './model_orderbook_increment_event';
import { TickerV1EventCallbackWrapper, TickerV1EventCallback } from './model_ticker_v1_event';
import {
    OrderbookLevel50EventCallback,
    OrderbookLevel50EventCallbackWrapper,
} from './model_orderbook_level50_event';
import { ExecutionEventCallbackWrapper, ExecutionEventCallback } from './model_execution_event';
import { InstrumentEventCallbackWrapper, InstrumentEventCallback } from './model_instrument_event';
import {
    AnnouncementEventCallback,
    AnnouncementEventCallbackWrapper,
} from './model_announcement_event';
import { WebSocketService } from '@internal/interfaces/websocket';

export interface FuturesPublicWS {
    /**
     * announcement announcement
     * Subscribe this topic to get Funding Fee Settlement.
     * push frequency: Settlement is made every 8 hours, real-time push
     */
    announcement(symbol: string, callback: AnnouncementEventCallback): Promise<string>;

    /**
     * execution Match execution data.
     * For each order executed, the system will send you the match messages in the format as following.
     * push frequency: real-time
     */
    execution(symbol: string, callback: ExecutionEventCallback): Promise<string>;

    /**
     * instrument instrument
     * Subscribe this topic to get the mark Price, index Price or funding fee Rate
     * push frequency: mark.index.price 1s, funding.rate 1min
     */
    instrument(symbol: string, callback: InstrumentEventCallback): Promise<string>;

    /**
     * klines Klines
     * Subscribe to this topic to get K-Line data.
     * push frequency: 1s
     */
    klines(symbol: string, type: string, callback: KlinesEventCallback): Promise<string>;

    /**
     * orderbookIncrement Orderbook - Increment
     * The system will return the increment change orderbook data (all depth). If there is no change in the market, data will not be pushed.
     * push frequency: real-time
     */
    orderbookIncrement(symbol: string, callback: OrderbookIncrementEventCallback): Promise<string>;

    /**
     * orderbookLevel50 Orderbook - Level50
     * The depth50 market data.
     * push frequency: 100ms
     */
    orderbookLevel50(symbol: string, callback: OrderbookLevel50EventCallback): Promise<string>;

    /**
     * orderbookLevel5 Orderbook - Level5
     * The system will return the 5 best ask/bid orders data. If there is no change in the market, data will not be pushed
     * push frequency: 100ms
     */
    orderbookLevel5(symbol: string, callback: OrderbookLevel5EventCallback): Promise<string>;

    /**
     * symbolSnapshot Symbol Snapshot
     * Get symbol snapshot.
     * push frequency: 5000ms
     */
    symbolSnapshot(symbol: string, callback: SymbolSnapshotEventCallback): Promise<string>;

    /**
     * tickerV1 Get Ticker(not recommended)
     * Subscribe to this topic to get real-time pushes on BBO changes. It is not recommended to use this topic any more. For real-time ticker information, please subscribe /contractMarket/tickerV2:{symbol}.
     * push frequency: real-time
     */
    tickerV1(symbol: string, callback: TickerV1EventCallback): Promise<string>;

    /**
     * tickerV2 Get Ticker V2
     * Subscribe to this topic to get real-time pushes of BBO changes. After subscription, when there are changes in the order book (not necessarily ask1/bid1 changes), the system will push the real-time ticker symbol information to you.
     * push frequency: real-time
     */
    tickerV2(symbol: string, callback: TickerV2EventCallback): Promise<string>;

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

export class FuturesPublicWSImpl implements FuturesPublicWS {
    private wsService: WebSocketService;

    constructor(wsService: WebSocketService) {
        this.wsService = wsService;
    }

    announcement(symbol: string, callback: AnnouncementEventCallback): Promise<string> {
        let topicPrefix = '/contract/announcement';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new AnnouncementEventCallbackWrapper(callback),
        );
    }

    execution(symbol: string, callback: ExecutionEventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/execution';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new ExecutionEventCallbackWrapper(callback),
        );
    }

    instrument(symbol: string, callback: InstrumentEventCallback): Promise<string> {
        let topicPrefix = '/contract/instrument';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new InstrumentEventCallbackWrapper(callback),
        );
    }

    klines(symbol: string, type: string, callback: KlinesEventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/limitCandle';

        let args: string[] = [[symbol, type].join('_')];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new KlinesEventCallbackWrapper(callback),
        );
    }

    orderbookIncrement(symbol: string, callback: OrderbookIncrementEventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/level2';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new OrderbookIncrementEventCallbackWrapper(callback),
        );
    }

    orderbookLevel50(symbol: string, callback: OrderbookLevel50EventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/level2Depth50';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new OrderbookLevel50EventCallbackWrapper(callback),
        );
    }

    orderbookLevel5(symbol: string, callback: OrderbookLevel5EventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/level2Depth5';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new OrderbookLevel5EventCallbackWrapper(callback),
        );
    }

    symbolSnapshot(symbol: string, callback: SymbolSnapshotEventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/snapshot';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new SymbolSnapshotEventCallbackWrapper(callback),
        );
    }

    tickerV1(symbol: string, callback: TickerV1EventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/ticker';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new TickerV1EventCallbackWrapper(callback),
        );
    }

    tickerV2(symbol: string, callback: TickerV2EventCallback): Promise<string> {
        let topicPrefix = '/contractMarket/tickerV2';

        let args: string[] = [symbol];

        return this.wsService.subscribe(
            topicPrefix,
            args,
            new TickerV2EventCallbackWrapper(callback),
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
