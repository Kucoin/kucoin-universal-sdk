// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class RepayReq implements Serializable<RepayReq> {
    /**
     * currency
     */
    currency?: string;
    /**
     * Borrow amount
     */
    size?: number;
    /**
     * symbol, mandatory for isolated margin account
     */
    symbol?: string;
    /**
     * true-isolated, false-cross; default is false
     */
    isIsolated?: boolean = false;
    /**
     * true: high frequency borrowing, false: low frequency borrowing; default false
     */
    isHf?: boolean = false;

    /**
     * Creates a new instance of the `RepayReq` class.
     * The builder pattern allows step-by-step construction of a `RepayReq` object.
     */
    static builder(): RepayReqBuilder {
        return new RepayReqBuilder();
    }

    /**
     * Creates a new instance of the `RepayReq` class with the given data.
     */
    static create(data: {
        /**
         * currency
         */
        currency?: string;
        /**
         * Borrow amount
         */
        size?: number;
        /**
         * symbol, mandatory for isolated margin account
         */
        symbol?: string;
        /**
         * true-isolated, false-cross; default is false
         */
        isIsolated?: boolean;
        /**
         * true: high frequency borrowing, false: low frequency borrowing; default false
         */
        isHf?: boolean;
    }): RepayReq {
        let obj = new RepayReq();
        obj.currency = data.currency;
        obj.size = data.size;
        obj.symbol = data.symbol;
        obj.isIsolated = data.isIsolated;
        obj.isHf = data.isHf;
        return obj;
    }

    fromJson(input: string): RepayReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(RepayReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): RepayReq {
        return plainToInstance(RepayReq, jsonObject);
    }
}

export class RepayReqBuilder {
    obj: RepayReq = new RepayReq();
    /**
     * currency
     */
    setCurrency(value: string): RepayReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Borrow amount
     */
    setSize(value: number): RepayReqBuilder {
        this.obj.size = value;
        return this;
    }

    /**
     * symbol, mandatory for isolated margin account
     */
    setSymbol(value: string): RepayReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * true-isolated, false-cross; default is false
     */
    setIsIsolated(value: boolean): RepayReqBuilder {
        this.obj.isIsolated = value;
        return this;
    }

    /**
     * true: high frequency borrowing, false: low frequency borrowing; default false
     */
    setIsHf(value: boolean): RepayReqBuilder {
        this.obj.isHf = value;
        return this;
    }

    build(): RepayReq {
        return this.obj;
    }
}