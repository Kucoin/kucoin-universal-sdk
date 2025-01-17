// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetTradeHistoryOldItems implements Serializable<GetTradeHistoryOldItems> {
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
     * Counterparty order Id
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
     * Order price
     */
    price?: string;
    /**
     * Order size
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
     * currency used to calculate trading fee
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
     * Specify if the order is an \'limit\' order or \'market\' order.
     */
    type?: string;
    /**
     *
     */
    createdAt?: number;

    fromJson(input: string): GetTradeHistoryOldItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetTradeHistoryOldItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetTradeHistoryOldItems {
        return plainToInstance(GetTradeHistoryOldItems, jsonObject);
    }
}