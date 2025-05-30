// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class CancelAllOrdersV1Req implements Serializable {
    /**
     * To cancel all limit orders for a specific contract only, unless otherwise specified, all limit orders will be deleted. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `CancelAllOrdersV1Req` class.
     * The builder pattern allows step-by-step construction of a `CancelAllOrdersV1Req` object.
     */
    static builder(): CancelAllOrdersV1ReqBuilder {
        return new CancelAllOrdersV1ReqBuilder(new CancelAllOrdersV1Req());
    }

    /**
     * Creates a new instance of the `CancelAllOrdersV1Req` class with the given data.
     */
    static create(data: {
        /**
         * To cancel all limit orders for a specific contract only, unless otherwise specified, all limit orders will be deleted. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
    }): CancelAllOrdersV1Req {
        let obj = new CancelAllOrdersV1Req();
        obj.symbol = data.symbol;
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
    static fromJson(input: string): CancelAllOrdersV1Req {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): CancelAllOrdersV1Req {
        return plainToClassFromExist(new CancelAllOrdersV1Req(), jsonObject);
    }
}

export class CancelAllOrdersV1ReqBuilder {
    constructor(readonly obj: CancelAllOrdersV1Req) {
        this.obj = obj;
    }
    /**
     * To cancel all limit orders for a specific contract only, unless otherwise specified, all limit orders will be deleted. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): CancelAllOrdersV1ReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): CancelAllOrdersV1Req {
        return this.obj;
    }
}
