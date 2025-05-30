// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetOrderByClientOidResp implements Response<RestResponse> {
    /**
     * The unique order id generated by the trading system
     */
    id: string;

    /**
     * symbol
     */
    symbol: string;

    /**
     *
     */
    opType: string;

    /**
     * Specify if the order is an \'limit\' order or \'market\' order.
     */
    type: GetOrderByClientOidResp.TypeEnum;

    /**
     * Buy or sell
     */
    side: GetOrderByClientOidResp.SideEnum;

    /**
     * Order price
     */
    price: string;

    /**
     * Order size
     */
    size: string;

    /**
     * Order Funds
     */
    funds: string;

    /**
     * Number of filled transactions
     */
    dealSize: string;

    /**
     * Funds of filled transactions
     */
    dealFunds: string;

    /**
     * [Handling fees](https://www.kucoin.com/docs-new/api-5327739)
     */
    fee: string;

    /**
     * currency used to calculate trading fee
     */
    feeCurrency: string;

    /**
     * [Self Trade Prevention](https://www.kucoin.com/docs-new/api-5176570)
     */
    stp?: GetOrderByClientOidResp.StpEnum;

    /**
     * Time in force
     */
    timeInForce: GetOrderByClientOidResp.TimeInForceEnum;

    /**
     * Whether its a postOnly order.
     */
    postOnly: boolean;

    /**
     * Whether its a hidden order.
     */
    hidden: boolean;

    /**
     * Whether its a iceberg order.
     */
    iceberg: boolean;

    /**
     * Visible size of iceberg order in order book.
     */
    visibleSize: string;

    /**
     * A GTT timeInForce that expires in n seconds
     */
    cancelAfter: number;

    /**
     *
     */
    channel: string;

    /**
     * Client Order Id，unique identifier created by the user
     */
    clientOid: string;

    /**
     * Order placement remarks
     */
    remark?: string;

    /**
     * Order tag
     */
    tags?: string;

    /**
     * Whether there is a cancellation record for the order.
     */
    cancelExist: boolean;

    /**
     *
     */
    createdAt: number;

    /**
     *
     */
    lastUpdatedAt: number;

    /**
     * Trade type, redundancy param
     */
    tradeType: string;

    /**
     * Whether to enter the orderbook: true: enter the orderbook; false: not enter the orderbook
     */
    inOrderBook: boolean;

    /**
     * Number of canceled transactions
     */
    cancelledSize: string;

    /**
     * Funds of canceled transactions
     */
    cancelledFunds: string;

    /**
     * Number of remain transactions
     */
    remainSize: string;

    /**
     * Funds of remain transactions
     */
    remainFunds: string;

    /**
     * Users in some regions need query this field
     */
    tax: string;

    /**
     * Order status: true-The status of the order isactive; false-The status of the order is done
     */
    active: boolean;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.id = null;
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.opType = null;
        // @ts-ignore
        this.type = null;
        // @ts-ignore
        this.side = null;
        // @ts-ignore
        this.price = null;
        // @ts-ignore
        this.size = null;
        // @ts-ignore
        this.funds = null;
        // @ts-ignore
        this.dealSize = null;
        // @ts-ignore
        this.dealFunds = null;
        // @ts-ignore
        this.fee = null;
        // @ts-ignore
        this.feeCurrency = null;
        // @ts-ignore
        this.timeInForce = null;
        // @ts-ignore
        this.postOnly = null;
        // @ts-ignore
        this.hidden = null;
        // @ts-ignore
        this.iceberg = null;
        // @ts-ignore
        this.visibleSize = null;
        // @ts-ignore
        this.cancelAfter = null;
        // @ts-ignore
        this.channel = null;
        // @ts-ignore
        this.clientOid = null;
        // @ts-ignore
        this.cancelExist = null;
        // @ts-ignore
        this.createdAt = null;
        // @ts-ignore
        this.lastUpdatedAt = null;
        // @ts-ignore
        this.tradeType = null;
        // @ts-ignore
        this.inOrderBook = null;
        // @ts-ignore
        this.cancelledSize = null;
        // @ts-ignore
        this.cancelledFunds = null;
        // @ts-ignore
        this.remainSize = null;
        // @ts-ignore
        this.remainFunds = null;
        // @ts-ignore
        this.tax = null;
        // @ts-ignore
        this.active = null;
    }
    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
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
    static fromJson(input: string): GetOrderByClientOidResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetOrderByClientOidResp {
        return plainToClassFromExist(new GetOrderByClientOidResp(), jsonObject);
    }
}

export namespace GetOrderByClientOidResp {
    export enum TypeEnum {
        /**
         *
         */
        LIMIT = <any>'limit',
        /**
         *
         */
        MARKET = <any>'market',
    }
    export enum SideEnum {
        /**
         *
         */
        BUY = <any>'buy',
        /**
         *
         */
        SELL = <any>'sell',
    }
    export enum StpEnum {
        /**
         *
         */
        DC = <any>'DC',
        /**
         *
         */
        CO = <any>'CO',
        /**
         *
         */
        CN = <any>'CN',
        /**
         *
         */
        CB = <any>'CB',
    }
    export enum TimeInForceEnum {
        /**
         *
         */
        GTC = <any>'GTC',
        /**
         *
         */
        GTT = <any>'GTT',
        /**
         *
         */
        IOC = <any>'IOC',
        /**
         *
         */
        FOK = <any>'FOK',
    }
}
