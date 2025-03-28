// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetRecentTradeHistoryOldData implements Serializable {
    /**
     *
     */
    symbol: string;

    /**
     *
     */
    tradeId: string;

    /**
     *
     */
    orderId: string;

    /**
     *
     */
    counterOrderId: string;

    /**
     *
     */
    side: string;

    /**
     *
     */
    liquidity: string;

    /**
     *
     */
    forceTaker: boolean;

    /**
     *
     */
    price: string;

    /**
     *
     */
    size: string;

    /**
     *
     */
    funds: string;

    /**
     *
     */
    fee: string;

    /**
     *
     */
    feeRate: string;

    /**
     *
     */
    feeCurrency: string;

    /**
     *
     */
    stop: string;

    /**
     *
     */
    tradeType: string;

    /**
     *
     */
    type: string;

    /**
     *
     */
    createdAt: number;

    /**
     *
     */
    tax?: string;

    /**
     *
     */
    taxCurrency?: string;

    /**
     *
     */
    taxRate?: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.tradeId = null;
        // @ts-ignore
        this.orderId = null;
        // @ts-ignore
        this.counterOrderId = null;
        // @ts-ignore
        this.side = null;
        // @ts-ignore
        this.liquidity = null;
        // @ts-ignore
        this.forceTaker = null;
        // @ts-ignore
        this.price = null;
        // @ts-ignore
        this.size = null;
        // @ts-ignore
        this.funds = null;
        // @ts-ignore
        this.fee = null;
        // @ts-ignore
        this.feeRate = null;
        // @ts-ignore
        this.feeCurrency = null;
        // @ts-ignore
        this.stop = null;
        // @ts-ignore
        this.tradeType = null;
        // @ts-ignore
        this.type = null;
        // @ts-ignore
        this.createdAt = null;
    }
    /**
     * Convert the object to a JSON string.
     */
    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): GetRecentTradeHistoryOldData {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetRecentTradeHistoryOldData {
        return plainToClassFromExist(new GetRecentTradeHistoryOldData(), jsonObject);
    }
}
