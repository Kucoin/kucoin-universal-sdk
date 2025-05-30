// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetTradeHistoryReq implements Serializable {
    /**
     * List fills for a specific order only (if you specify orderId, other parameters can be ignored)
     */
    orderId?: string;

    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;

    /**
     * Order side
     */
    side?: GetTradeHistoryReq.SideEnum;

    /**
     * Order Type
     */
    type?: GetTradeHistoryReq.TypeEnum;

    /**
     * Transaction type: trade, adl, liquid, settlement. Supports querying multiple types at the same time, separated by commas. Query all types when empty
     */
    tradeTypes?: string;

    /**
     * Start time (milliseconds)
     */
    startAt?: number;

    /**
     * End time (milliseconds)
     */
    endAt?: number;

    /**
     * Current request page. The default currentPage is 1
     */
    currentPage?: number = 1;

    /**
     * pageSize, The default pageSize is 50; the maximum cannot exceed 1000
     */
    pageSize?: number = 50;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `GetTradeHistoryReq` class.
     * The builder pattern allows step-by-step construction of a `GetTradeHistoryReq` object.
     */
    static builder(): GetTradeHistoryReqBuilder {
        return new GetTradeHistoryReqBuilder(new GetTradeHistoryReq());
    }

    /**
     * Creates a new instance of the `GetTradeHistoryReq` class with the given data.
     */
    static create(data: {
        /**
         * List fills for a specific order only (if you specify orderId, other parameters can be ignored)
         */
        orderId?: string;
        /**
         * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
        /**
         * Order side
         */
        side?: GetTradeHistoryReq.SideEnum;
        /**
         * Order Type
         */
        type?: GetTradeHistoryReq.TypeEnum;
        /**
         * Transaction type: trade, adl, liquid, settlement. Supports querying multiple types at the same time, separated by commas. Query all types when empty
         */
        tradeTypes?: string;
        /**
         * Start time (milliseconds)
         */
        startAt?: number;
        /**
         * End time (milliseconds)
         */
        endAt?: number;
        /**
         * Current request page. The default currentPage is 1
         */
        currentPage?: number;
        /**
         * pageSize, The default pageSize is 50; the maximum cannot exceed 1000
         */
        pageSize?: number;
    }): GetTradeHistoryReq {
        let obj = new GetTradeHistoryReq();
        obj.orderId = data.orderId;
        obj.symbol = data.symbol;
        obj.side = data.side;
        obj.type = data.type;
        obj.tradeTypes = data.tradeTypes;
        obj.startAt = data.startAt;
        obj.endAt = data.endAt;
        if (data.currentPage) {
            obj.currentPage = data.currentPage;
        } else {
            obj.currentPage = 1;
        }
        if (data.pageSize) {
            obj.pageSize = data.pageSize;
        } else {
            obj.pageSize = 50;
        }
        return obj;
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
    static fromJson(input: string): GetTradeHistoryReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetTradeHistoryReq {
        return plainToClassFromExist(new GetTradeHistoryReq(), jsonObject);
    }
}

export namespace GetTradeHistoryReq {
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
    export enum TypeEnum {
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
}

export class GetTradeHistoryReqBuilder {
    constructor(readonly obj: GetTradeHistoryReq) {
        this.obj = obj;
    }
    /**
     * List fills for a specific order only (if you specify orderId, other parameters can be ignored)
     */
    setOrderId(value: string): GetTradeHistoryReqBuilder {
        this.obj.orderId = value;
        return this;
    }

    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): GetTradeHistoryReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * Order side
     */
    setSide(value: GetTradeHistoryReq.SideEnum): GetTradeHistoryReqBuilder {
        this.obj.side = value;
        return this;
    }

    /**
     * Order Type
     */
    setType(value: GetTradeHistoryReq.TypeEnum): GetTradeHistoryReqBuilder {
        this.obj.type = value;
        return this;
    }

    /**
     * Transaction type: trade, adl, liquid, settlement. Supports querying multiple types at the same time, separated by commas. Query all types when empty
     */
    setTradeTypes(value: string): GetTradeHistoryReqBuilder {
        this.obj.tradeTypes = value;
        return this;
    }

    /**
     * Start time (milliseconds)
     */
    setStartAt(value: number): GetTradeHistoryReqBuilder {
        this.obj.startAt = value;
        return this;
    }

    /**
     * End time (milliseconds)
     */
    setEndAt(value: number): GetTradeHistoryReqBuilder {
        this.obj.endAt = value;
        return this;
    }

    /**
     * Current request page. The default currentPage is 1
     */
    setCurrentPage(value: number): GetTradeHistoryReqBuilder {
        this.obj.currentPage = value;
        return this;
    }

    /**
     * pageSize, The default pageSize is 50; the maximum cannot exceed 1000
     */
    setPageSize(value: number): GetTradeHistoryReqBuilder {
        this.obj.pageSize = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): GetTradeHistoryReq {
        return this.obj;
    }
}
