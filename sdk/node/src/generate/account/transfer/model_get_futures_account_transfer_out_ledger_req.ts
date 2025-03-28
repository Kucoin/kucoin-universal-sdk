// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetFuturesAccountTransferOutLedgerReq implements Serializable {
    /**
     * currency
     */
    currency?: string;

    /**
     * Status PROCESSING, SUCCESS, FAILURE
     */
    type?: GetFuturesAccountTransferOutLedgerReq.TypeEnum;

    /**
     * Status List PROCESSING, SUCCESS, FAILURE
     */
    tag?: Array<string>;

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
     * pageSize; the default pageSize is 50
     */
    pageSize?: number = 50;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `GetFuturesAccountTransferOutLedgerReq` class.
     * The builder pattern allows step-by-step construction of a `GetFuturesAccountTransferOutLedgerReq` object.
     */
    static builder(): GetFuturesAccountTransferOutLedgerReqBuilder {
        return new GetFuturesAccountTransferOutLedgerReqBuilder(
            new GetFuturesAccountTransferOutLedgerReq(),
        );
    }

    /**
     * Creates a new instance of the `GetFuturesAccountTransferOutLedgerReq` class with the given data.
     */
    static create(data: {
        /**
         * currency
         */
        currency?: string;
        /**
         * Status PROCESSING, SUCCESS, FAILURE
         */
        type?: GetFuturesAccountTransferOutLedgerReq.TypeEnum;
        /**
         * Status List PROCESSING, SUCCESS, FAILURE
         */
        tag?: Array<string>;
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
         * pageSize; the default pageSize is 50
         */
        pageSize?: number;
    }): GetFuturesAccountTransferOutLedgerReq {
        let obj = new GetFuturesAccountTransferOutLedgerReq();
        obj.currency = data.currency;
        obj.type = data.type;
        obj.tag = data.tag;
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
    static fromJson(input: string): GetFuturesAccountTransferOutLedgerReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetFuturesAccountTransferOutLedgerReq {
        return plainToClassFromExist(new GetFuturesAccountTransferOutLedgerReq(), jsonObject);
    }
}

export namespace GetFuturesAccountTransferOutLedgerReq {
    export enum TypeEnum {
        /**
         *
         */
        MAIN = <any>'MAIN',
        /**
         *
         */
        TRADE = <any>'TRADE',
        /**
         *
         */
        MARGIN = <any>'MARGIN',
        /**
         *
         */
        ISOLATED = <any>'ISOLATED',
    }
}

export class GetFuturesAccountTransferOutLedgerReqBuilder {
    constructor(readonly obj: GetFuturesAccountTransferOutLedgerReq) {
        this.obj = obj;
    }
    /**
     * currency
     */
    setCurrency(value: string): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Status PROCESSING, SUCCESS, FAILURE
     */
    setType(
        value: GetFuturesAccountTransferOutLedgerReq.TypeEnum,
    ): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.type = value;
        return this;
    }

    /**
     * Status List PROCESSING, SUCCESS, FAILURE
     */
    setTag(value: Array<string>): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.tag = value;
        return this;
    }

    /**
     * Start time (milliseconds)
     */
    setStartAt(value: number): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.startAt = value;
        return this;
    }

    /**
     * End time (milliseconds)
     */
    setEndAt(value: number): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.endAt = value;
        return this;
    }

    /**
     * Current request page. The default currentPage is 1
     */
    setCurrentPage(value: number): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.currentPage = value;
        return this;
    }

    /**
     * pageSize; the default pageSize is 50
     */
    setPageSize(value: number): GetFuturesAccountTransferOutLedgerReqBuilder {
        this.obj.pageSize = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): GetFuturesAccountTransferOutLedgerReq {
        return this.obj;
    }
}
