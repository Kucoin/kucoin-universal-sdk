// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetMarginRiskLimitReq implements Serializable<GetMarginRiskLimitReq> {
    /**
     * true-isolated, false-cross
     */
    isIsolated?: boolean;
    /**
     * currency, This field is only required for cross margin
     */
    currency?: string;
    /**
     * symbol, This field is only required for isolated margin
     */
    symbol?: string;

    /**
     * Creates a new instance of the `GetMarginRiskLimitReq` class.
     * The builder pattern allows step-by-step construction of a `GetMarginRiskLimitReq` object.
     */
    static builder(): GetMarginRiskLimitReqBuilder {
        return new GetMarginRiskLimitReqBuilder();
    }

    /**
     * Creates a new instance of the `GetMarginRiskLimitReq` class with the given data.
     */
    static create(data: {
        /**
         * true-isolated, false-cross
         */
        isIsolated?: boolean;
        /**
         * currency, This field is only required for cross margin
         */
        currency?: string;
        /**
         * symbol, This field is only required for isolated margin
         */
        symbol?: string;
    }): GetMarginRiskLimitReq {
        let obj = new GetMarginRiskLimitReq();
        obj.isIsolated = data.isIsolated;
        obj.currency = data.currency;
        obj.symbol = data.symbol;
        return obj;
    }

    fromJson(input: string): GetMarginRiskLimitReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetMarginRiskLimitReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetMarginRiskLimitReq {
        return plainToInstance(GetMarginRiskLimitReq, jsonObject);
    }
}

export class GetMarginRiskLimitReqBuilder {
    obj: GetMarginRiskLimitReq = new GetMarginRiskLimitReq();
    /**
     * true-isolated, false-cross
     */
    setIsIsolated(value: boolean): GetMarginRiskLimitReqBuilder {
        this.obj.isIsolated = value;
        return this;
    }

    /**
     * currency, This field is only required for cross margin
     */
    setCurrency(value: string): GetMarginRiskLimitReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * symbol, This field is only required for isolated margin
     */
    setSymbol(value: string): GetMarginRiskLimitReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    build(): GetMarginRiskLimitReq {
        return this.obj;
    }
}