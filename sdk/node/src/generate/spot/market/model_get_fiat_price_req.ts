// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetFiatPriceReq implements Serializable<GetFiatPriceReq> {
    /**
     * Ticker symbol of a base currency,eg.USD,EUR. Default is USD
     */
    base?: string = 'USD';
    /**
     * Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
     */
    currencies?: string;

    /**
     * Creates a new instance of the `GetFiatPriceReq` class.
     * The builder pattern allows step-by-step construction of a `GetFiatPriceReq` object.
     */
    static builder(): GetFiatPriceReqBuilder {
        return new GetFiatPriceReqBuilder();
    }

    /**
     * Creates a new instance of the `GetFiatPriceReq` class with the given data.
     */
    static create(data: {
        /**
         * Ticker symbol of a base currency,eg.USD,EUR. Default is USD
         */
        base?: string;
        /**
         * Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
         */
        currencies?: string;
    }): GetFiatPriceReq {
        let obj = new GetFiatPriceReq();
        obj.base = data.base;
        obj.currencies = data.currencies;
        return obj;
    }

    fromJson(input: string): GetFiatPriceReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetFiatPriceReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetFiatPriceReq {
        return plainToInstance(GetFiatPriceReq, jsonObject);
    }
}

export class GetFiatPriceReqBuilder {
    obj: GetFiatPriceReq = new GetFiatPriceReq();
    /**
     * Ticker symbol of a base currency,eg.USD,EUR. Default is USD
     */
    setBase(value: string): GetFiatPriceReqBuilder {
        this.obj.base = value;
        return this;
    }

    /**
     * Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
     */
    setCurrencies(value: string): GetFiatPriceReqBuilder {
        this.obj.currencies = value;
        return this;
    }

    build(): GetFiatPriceReq {
        return this.obj;
    }
}