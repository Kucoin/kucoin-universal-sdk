// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import 'reflect-metadata';
import { Serializable } from '@internal/interfaces/serializable';

export class GetCurrencyReq implements Serializable<GetCurrencyReq> {
    /**
     * Path parameter, Currency
     */
    @Reflect.metadata('path', 'currency')
    currency?: string;
    /**
     * Support for querying the chain of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    chain?: string;

    /**
     * Creates a new instance of the `GetCurrencyReq` class.
     * The builder pattern allows step-by-step construction of a `GetCurrencyReq` object.
     */
    static builder(): GetCurrencyReqBuilder {
        return new GetCurrencyReqBuilder();
    }

    /**
     * Creates a new instance of the `GetCurrencyReq` class with the given data.
     */
    static create(data: {
        /**
         * Path parameter, Currency
         */
        currency?: string;
        /**
         * Support for querying the chain of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20. This only apply for multi-chain currency, and there is no need for single chain currency.
         */
        chain?: string;
    }): GetCurrencyReq {
        let obj = new GetCurrencyReq();
        obj.currency = data.currency;
        obj.chain = data.chain;
        return obj;
    }

    fromJson(input: string): GetCurrencyReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetCurrencyReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetCurrencyReq {
        return plainToInstance(GetCurrencyReq, jsonObject);
    }
}

export class GetCurrencyReqBuilder {
    obj: GetCurrencyReq = new GetCurrencyReq();
    /**
     * Path parameter, Currency
     */
    setCurrency(value: string): GetCurrencyReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Support for querying the chain of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    setChain(value: string): GetCurrencyReqBuilder {
        this.obj.chain = value;
        return this;
    }

    build(): GetCurrencyReq {
        return this.obj;
    }
}