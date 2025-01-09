// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import 'reflect-metadata';
import { Serializable } from '@internal/interfaces/serializable';

export class GetMarkPriceDetailReq implements Serializable<GetMarkPriceDetailReq> {
    /**
     * symbol
     */
    @Reflect.metadata('path', 'symbol')
    symbol?: string;

    /**
     * Creates a new instance of the `GetMarkPriceDetailReq` class.
     * The builder pattern allows step-by-step construction of a `GetMarkPriceDetailReq` object.
     */
    static builder(): GetMarkPriceDetailReqBuilder {
        return new GetMarkPriceDetailReqBuilder();
    }

    /**
     * Creates a new instance of the `GetMarkPriceDetailReq` class with the given data.
     */
    static create(data: {
        /**
         * symbol
         */
        symbol?: string;
    }): GetMarkPriceDetailReq {
        let obj = new GetMarkPriceDetailReq();
        obj.symbol = data.symbol;
        return obj;
    }

    fromJson(input: string): GetMarkPriceDetailReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetMarkPriceDetailReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetMarkPriceDetailReq {
        return plainToInstance(GetMarkPriceDetailReq, jsonObject);
    }
}

export class GetMarkPriceDetailReqBuilder {
    obj: GetMarkPriceDetailReq = new GetMarkPriceDetailReq();
    /**
     * symbol
     */
    setSymbol(value: string): GetMarkPriceDetailReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    build(): GetMarkPriceDetailReq {
        return this.obj;
    }
}