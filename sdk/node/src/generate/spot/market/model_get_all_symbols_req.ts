// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetAllSymbolsReq implements Serializable<GetAllSymbolsReq> {
    /**
     * [The trading market](https://www.kucoin.com/docs-new/api-222921786)
     */
    market?: string;

    /**
     * Creates a new instance of the `GetAllSymbolsReq` class.
     * The builder pattern allows step-by-step construction of a `GetAllSymbolsReq` object.
     */
    static builder(): GetAllSymbolsReqBuilder {
        return new GetAllSymbolsReqBuilder();
    }

    /**
     * Creates a new instance of the `GetAllSymbolsReq` class with the given data.
     */
    static create(data: {
        /**
         * [The trading market](https://www.kucoin.com/docs-new/api-222921786)
         */
        market?: string;
    }): GetAllSymbolsReq {
        let obj = new GetAllSymbolsReq();
        obj.market = data.market;
        return obj;
    }

    fromJson(input: string): GetAllSymbolsReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetAllSymbolsReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetAllSymbolsReq {
        return plainToInstance(GetAllSymbolsReq, jsonObject);
    }
}

export class GetAllSymbolsReqBuilder {
    obj: GetAllSymbolsReq = new GetAllSymbolsReq();
    /**
     * [The trading market](https://www.kucoin.com/docs-new/api-222921786)
     */
    setMarket(value: string): GetAllSymbolsReqBuilder {
        this.obj.market = value;
        return this;
    }

    build(): GetAllSymbolsReq {
        return this.obj;
    }
}