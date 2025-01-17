// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetTradeHistoryItems implements Serializable<GetTradeHistoryItems> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Trade ID
     */
    tradeId?: string;
    /**
     * Order ID
     */
    orderId?: string;
    /**
     * Transaction side
     */
    side?: GetTradeHistoryItems.SideEnum;
    /**
     * Liquidity- taker or maker
     */
    liquidity?: GetTradeHistoryItems.LiquidityEnum;
    /**
     * Whether to force processing as a taker
     */
    forceTaker?: boolean;
    /**
     * Filled price
     */
    price?: string;
    /**
     * Filled amount
     */
    size?: number;
    /**
     * Order value
     */
    value?: string;
    /**
     * Opening transaction fee
     */
    openFeePay?: string;
    /**
     * Closing transaction fee
     */
    closeFeePay?: string;
    /**
     * A mark to the stop order type
     */
    stop?: string;
    /**
     * Fee Rate
     */
    feeRate?: string;
    /**
     * Fixed fees(Deprecated field, no actual use of the value field)
     */
    fixFee?: string;
    /**
     * Charging currency
     */
    feeCurrency?: string;
    /**
     * trade time in nanosecond
     */
    tradeTime?: number;
    /**
     * Deprecated field, no actual use of the value field
     */
    subTradeType?: string;
    /**
     * Margin mode: ISOLATED (isolated), CROSS (cross margin).
     */
    marginMode?: GetTradeHistoryItems.MarginModeEnum;
    /**
     * Settle Currency
     */
    settleCurrency?: string;
    /**
     * Order Type
     */
    displayType?: GetTradeHistoryItems.DisplayTypeEnum;
    /**
     *
     */
    fee?: string;
    /**
     * Order type
     */
    orderType?: GetTradeHistoryItems.OrderTypeEnum;
    /**
     * Trade type (trade, liquid, adl or settlement)
     */
    tradeType?: GetTradeHistoryItems.TradeTypeEnum;
    /**
     * Time the order created
     */
    createdAt?: number;

    fromJson(input: string): GetTradeHistoryItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetTradeHistoryItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetTradeHistoryItems {
        return plainToInstance(GetTradeHistoryItems, jsonObject);
    }
}

export namespace GetTradeHistoryItems {
    export enum SideEnum {
        /**
         * buy
         */
        BUY = <any>'buy',
        /**
         * sell
         */
        SELL = <any>'sell',
    }
    export enum LiquidityEnum {
        /**
         * taker
         */
        TAKER = <any>'taker',
        /**
         * maker
         */
        MAKER = <any>'maker',
    }
    export enum MarginModeEnum {
        /**
         * Isolated Margin
         */
        ISOLATED = <any>'ISOLATED',
        /**
         * Cross Margin
         */
        CROSS = <any>'CROSS',
    }
    export enum DisplayTypeEnum {
        /**
         * Limit order
         */
        LIMIT = <any>'limit',
        /**
         * Market order
         */
        MARKET = <any>'market',
        /**
         * Stop limit order
         */
        LIMIT_STOP = <any>'limit_stop',
        /**
         * Stop Market order
         */
        MARKET_STOP = <any>'market_stop',
    }
    export enum OrderTypeEnum {
        /**
         * market
         */
        MARKET = <any>'market',
        /**
         * limit
         */
        LIMIT = <any>'limit',
    }
    export enum TradeTypeEnum {
        /**
         * trade
         */
        TRADE = <any>'trade',
        /**
         * liquid
         */
        LIQUID = <any>'liquid',
        /**
         * adl
         */
        ADL = <any>'adl',
        /**
         * settlement
         */
        SETTLEMENT = <any>'settlement',
    }
}