// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetKlinesReq implements Serializable<GetKlinesReq> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol, indexSymbol, premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Type of candlestick patterns(minute)
     */
    granularity?: GetKlinesReq.GranularityEnum;
    /**
     * Start time (milisecond)
     */
    from?: number;
    /**
     * End time (milisecond)
     */
    to?: number;

    /**
     * Creates a new instance of the `GetKlinesReq` class.
     * The builder pattern allows step-by-step construction of a `GetKlinesReq` object.
     */
    static builder(): GetKlinesReqBuilder {
        return new GetKlinesReqBuilder();
    }

    /**
     * Creates a new instance of the `GetKlinesReq` class with the given data.
     */
    static create(data: {
        /**
         * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol, indexSymbol, premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
        /**
         * Type of candlestick patterns(minute)
         */
        granularity?: GetKlinesReq.GranularityEnum;
        /**
         * Start time (milisecond)
         */
        from?: number;
        /**
         * End time (milisecond)
         */
        to?: number;
    }): GetKlinesReq {
        let obj = new GetKlinesReq();
        obj.symbol = data.symbol;
        obj.granularity = data.granularity;
        obj.from = data.from;
        obj.to = data.to;
        return obj;
    }

    fromJson(input: string): GetKlinesReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetKlinesReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetKlinesReq {
        return plainToInstance(GetKlinesReq, jsonObject);
    }
}

export namespace GetKlinesReq {
    export enum GranularityEnum {
        /**
         * 1min
         */
        _1 = <any>1,
        /**
         * 5min
         */
        _5 = <any>5,
        /**
         * 15min
         */
        _15 = <any>15,
        /**
         * 30min
         */
        _30 = <any>30,
        /**
         * 1hour
         */
        _60 = <any>60,
        /**
         * 2hour
         */
        _120 = <any>120,
        /**
         * 4hour
         */
        _240 = <any>240,
        /**
         * 8hour
         */
        _480 = <any>480,
        /**
         * 12hour
         */
        _720 = <any>720,
        /**
         * 1day
         */
        _1440 = <any>1440,
        /**
         * 1week
         */
        _10080 = <any>10080,
    }
}

export class GetKlinesReqBuilder {
    obj: GetKlinesReq = new GetKlinesReq();
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol, indexSymbol, premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): GetKlinesReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * Type of candlestick patterns(minute)
     */
    setGranularity(value: GetKlinesReq.GranularityEnum): GetKlinesReqBuilder {
        this.obj.granularity = value;
        return this;
    }

    /**
     * Start time (milisecond)
     */
    setFrom(value: number): GetKlinesReqBuilder {
        this.obj.from = value;
        return this;
    }

    /**
     * End time (milisecond)
     */
    setTo(value: number): GetKlinesReqBuilder {
        this.obj.to = value;
        return this;
    }

    build(): GetKlinesReq {
        return this.obj;
    }
}