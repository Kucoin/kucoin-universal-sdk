import {
    UtaPushCallback,
    UtaPushEvent,
    UtaPushSubscription,
    UtaPushWsService,
    UtaWsValue,
} from '@internal/infra/uta_push_ws_service';
import { PushTradeType } from '@model/push_trade_type';

export enum KlineInterval {
    MIN_1 = '1min',
    MIN_3 = '3min',
    MIN_5 = '5min',
    MIN_15 = '15min',
    MIN_30 = '30min',
    HOUR_1 = '1hour',
    HOUR_2 = '2hour',
    HOUR_4 = '4hour',
    HOUR_6 = '6hour',
    HOUR_8 = '8hour',
    HOUR_12 = '12hour',
    DAY_1 = '1day',
    WEEK_1 = '1week',
    MONTH_1 = '1month',
}

export enum OrderbookDepth {
    BEST_1 = '1',
    BEST_5 = '5',
    BEST_50 = '50',
    INCREMENT = 'increment',
    INCREMENT_10MS = 'increment@10ms',
}

export enum OrderbookRpiFilter {
    NONE_RPI_ONLY = 0,
    INCLUDE_RPI = 1,
}

export type UtaPublicEvent<T extends Record<string, UtaWsValue> = Record<string, UtaWsValue>> =
    UtaPushEvent<T>;
export type TickerEvent = UtaPublicEvent;
export type KlineEvent = UtaPublicEvent;
export type TradeEvent = UtaPublicEvent;
export type OrderbookEvent = UtaPublicEvent;
export type MarkPriceEvent = UtaPublicEvent;
export type FundingFeeEvent = UtaPublicEvent;
export type FundingFeeAllSymbolsEvent = UtaPushEvent<Record<string, UtaWsValue>[]>;
export type CallAuctionInfoEvent = UtaPublicEvent;
export type UtaPublicEventCallback<T extends Record<string, UtaWsValue> = Record<string, UtaWsValue>> =
    (event: UtaPublicEvent<T>) => void | Promise<void>;

/** Direct UTA public push WebSocket API. One instance represents Spot or Futures. */
export interface UtaPublicWS {
    ticker(symbols: string | string[], callback: UtaPublicEventCallback): Promise<string>;
    kline(
        symbol: string,
        interval: KlineInterval | string,
        callback: UtaPublicEventCallback,
    ): Promise<string>;
    trade(symbol: string, callback: UtaPublicEventCallback): Promise<string>;
    orderbook(
        symbol: string,
        depth: OrderbookDepth | string,
        callback: UtaPublicEventCallback,
    ): Promise<string>;
    orderbook(
        symbol: string,
        depth: OrderbookDepth | string,
        rpiFilter: OrderbookRpiFilter,
        callback: UtaPublicEventCallback,
    ): Promise<string>;
    markPrice(symbol: string, callback: UtaPublicEventCallback): Promise<string>;
    fundingFee(symbols: string | string[], callback: UtaPublicEventCallback): Promise<string>;
    fundingFeeAllSymbols(callback: UtaPublicEventCallback): Promise<string>;
    callAuctionInfo(symbol: string, callback: UtaPublicEventCallback): Promise<string>;
    unSubscribe(id: string): Promise<void>;
    start(): Promise<void>;
    stop(): Promise<void>;
}

export class UtaPublicWSImpl implements UtaPublicWS {
    constructor(
        private readonly wsService: UtaPushWsService,
        private readonly tradeType: PushTradeType,
    ) {}

    ticker(symbols: string | string[], callback: UtaPublicEventCallback): Promise<string> {
        return this.subscribe('ticker', symbols, callback);
    }

    kline(
        symbol: string,
        interval: KlineInterval | string,
        callback: UtaPublicEventCallback,
    ): Promise<string> {
        if (this.tradeType === PushTradeType.FUTURES && interval === KlineInterval.HOUR_6) {
            return Promise.reject(new Error('6hour Kline is not supported for FUTURES'));
        }
        return this.subscribe('kline', symbol, callback, { interval });
    }

    trade(symbol: string, callback: UtaPublicEventCallback): Promise<string> {
        return this.subscribe('trade', symbol, callback);
    }

    orderbook(
        symbol: string,
        depth: OrderbookDepth | string,
        rpiFilterOrCallback: OrderbookRpiFilter | UtaPublicEventCallback,
        callback?: UtaPublicEventCallback,
    ): Promise<string> {
        const rpiFilter =
            typeof rpiFilterOrCallback === 'function'
                ? OrderbookRpiFilter.NONE_RPI_ONLY
                : rpiFilterOrCallback;
        const handler =
            typeof rpiFilterOrCallback === 'function' ? rpiFilterOrCallback : callback;
        if (!handler) {
            return Promise.reject(new Error('orderbook callback must not be empty'));
        }
        if (rpiFilter === OrderbookRpiFilter.INCLUDE_RPI && this.tradeType !== PushTradeType.FUTURES) {
            return Promise.reject(new Error('rpiFilter=1 is supported only for FUTURES'));
        }
        if (
            rpiFilter === OrderbookRpiFilter.INCLUDE_RPI &&
            depth !== OrderbookDepth.BEST_5 &&
            depth !== OrderbookDepth.BEST_50
        ) {
            return Promise.reject(new Error('rpiFilter=1 supports only depth 5 or 50'));
        }
        return this.subscribe('obu', symbol, handler, { depth, rpiFilter });
    }

    markPrice(symbol: string, callback: UtaPublicEventCallback): Promise<string> {
        this.requireFutures('mark-price');
        return this.subscribe('mark-price', symbol, callback, undefined, false);
    }

    fundingFee(symbols: string | string[], callback: UtaPublicEventCallback): Promise<string> {
        this.requireFutures('funding-fee');
        return this.subscribe('funding-fee', symbols, callback, undefined, false);
    }

    fundingFeeAllSymbols(callback: UtaPublicEventCallback): Promise<string> {
        this.requireFutures('funding-fee-all-symbols');
        return this.wsService.subscribe({ channel: 'funding-fee-all-symbols', callback });
    }

    callAuctionInfo(symbol: string, callback: UtaPublicEventCallback): Promise<string> {
        if (this.tradeType !== PushTradeType.SPOT) {
            return Promise.reject(new Error('callAuctionInfo is available only from the SPOT endpoint'));
        }
        return this.subscribe('callAuctionInfo', symbol, callback, undefined, false);
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

    private subscribe(
        channel: string,
        symbols: string | string[],
        callback: UtaPublicEventCallback,
        parameters?: Record<string, UtaWsValue>,
        includeTradeType = true,
    ): Promise<string> {
        const symbolList = Array.isArray(symbols) ? symbols : [symbols];
        const subscription: UtaPushSubscription = {
            channel,
            symbols: symbolList,
            parameters,
            callback: callback as UtaPushCallback,
        };
        if (includeTradeType) {
            subscription.tradeType = this.tradeType;
        }
        return this.wsService.subscribe(subscription);
    }

    private requireFutures(channel: string): void {
        if (this.tradeType !== PushTradeType.FUTURES) {
            throw new Error(`${channel} is available only from the FUTURES endpoint`);
        }
    }
}
