// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetPositionDetailsReq implements Serializable {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `GetPositionDetailsReq` class.
     * The builder pattern allows step-by-step construction of a `GetPositionDetailsReq` object.
     */
    static builder(): GetPositionDetailsReqBuilder {
        return new GetPositionDetailsReqBuilder(new GetPositionDetailsReq());
    }

    /**
     * Creates a new instance of the `GetPositionDetailsReq` class with the given data.
     */
    static create(data: {
        /**
         * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
    }): GetPositionDetailsReq {
        let obj = new GetPositionDetailsReq();
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
    static fromJson(input: string): GetPositionDetailsReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetPositionDetailsReq {
        return plainToClassFromExist(new GetPositionDetailsReq(), jsonObject);
    }
}

export class GetPositionDetailsReqBuilder {
    constructor(readonly obj: GetPositionDetailsReq) {
        this.obj = obj;
    }
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): GetPositionDetailsReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): GetPositionDetailsReq {
        return this.obj;
    }
}
