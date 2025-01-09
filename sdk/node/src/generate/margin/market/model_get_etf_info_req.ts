// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetETFInfoReq implements Serializable<GetETFInfoReq> {
    /**
     * ETF Currency, if empty query all currencies
     */
    currency?: string;

    /**
     * Creates a new instance of the `GetETFInfoReq` class.
     * The builder pattern allows step-by-step construction of a `GetETFInfoReq` object.
     */
    static builder(): GetETFInfoReqBuilder {
        return new GetETFInfoReqBuilder();
    }

    /**
     * Creates a new instance of the `GetETFInfoReq` class with the given data.
     */
    static create(data: {
        /**
         * ETF Currency, if empty query all currencies
         */
        currency?: string;
    }): GetETFInfoReq {
        let obj = new GetETFInfoReq();
        obj.currency = data.currency;
        return obj;
    }

    fromJson(input: string): GetETFInfoReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetETFInfoReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetETFInfoReq {
        return plainToInstance(GetETFInfoReq, jsonObject);
    }
}

export class GetETFInfoReqBuilder {
    obj: GetETFInfoReq = new GetETFInfoReq();
    /**
     * ETF Currency, if empty query all currencies
     */
    setCurrency(value: string): GetETFInfoReqBuilder {
        this.obj.currency = value;
        return this;
    }

    build(): GetETFInfoReq {
        return this.obj;
    }
}