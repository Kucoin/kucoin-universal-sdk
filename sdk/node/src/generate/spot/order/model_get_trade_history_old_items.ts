// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetTradeHistoryOldItems implements Serializable {
    /**
     * symbol
     */
    symbol?: string;

    /**
     *
     */
    tradeId?: string;

    /**
     * The unique order id generated by the trading system
     */
    orderId?: string;

    /**
     * Counterparty order ID
     */
    counterOrderId?: string;

    /**
     * Buy or sell
     */
    side?: string;

    /**
     * Liquidity type: taker or maker
     */
    liquidity?: string;

    /**
     *
     */
    forceTaker?: boolean;

    /**
     * Order Price
     */
    price?: string;

    /**
     * Order Size
     */
    size?: string;

    /**
     * Order Funds
     */
    funds?: string;

    /**
     * [Handling fees](https://www.kucoin.com/docs-new/api-5327739)
     */
    fee?: string;

    /**
     * Fee rate
     */
    feeRate?: string;

    /**
     * Currency used to calculate trading fee
     */
    feeCurrency?: string;

    /**
     * Take Profit and Stop Loss type, currently HFT does not support the Take Profit and Stop Loss type, so it is empty
     */
    stop?: string;

    /**
     * Trade type, redundancy param
     */
    tradeType?: string;

    /**
     * Specify if the order is a \'limit\' order or \'market\' order.
     */
    type?: string;

    /**
     *
     */
    createdAt?: number;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Convert the object to a JSON string.
     */
    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): GetTradeHistoryOldItems {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetTradeHistoryOldItems {
        return plainToClassFromExist(new GetTradeHistoryOldItems(), jsonObject);
    }
}
