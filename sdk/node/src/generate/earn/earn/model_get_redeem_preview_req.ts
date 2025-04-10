// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetRedeemPreviewReq implements Serializable {
    /**
     * Holding ID
     */
    orderId?: string;

    /**
     * Account type: MAIN (funding account), TRADE (spot trading account). This parameter is valid only when orderId=ETH2
     */
    fromAccountType?: GetRedeemPreviewReq.FromAccountTypeEnum;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `GetRedeemPreviewReq` class.
     * The builder pattern allows step-by-step construction of a `GetRedeemPreviewReq` object.
     */
    static builder(): GetRedeemPreviewReqBuilder {
        return new GetRedeemPreviewReqBuilder(new GetRedeemPreviewReq());
    }

    /**
     * Creates a new instance of the `GetRedeemPreviewReq` class with the given data.
     */
    static create(data: {
        /**
         * Holding ID
         */
        orderId?: string;
        /**
         * Account type: MAIN (funding account), TRADE (spot trading account). This parameter is valid only when orderId=ETH2
         */
        fromAccountType?: GetRedeemPreviewReq.FromAccountTypeEnum;
    }): GetRedeemPreviewReq {
        let obj = new GetRedeemPreviewReq();
        obj.orderId = data.orderId;
        obj.fromAccountType = data.fromAccountType;
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
    static fromJson(input: string): GetRedeemPreviewReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetRedeemPreviewReq {
        return plainToClassFromExist(new GetRedeemPreviewReq(), jsonObject);
    }
}

export namespace GetRedeemPreviewReq {
    export enum FromAccountTypeEnum {
        /**
         *
         */
        MAIN = <any>'MAIN',
        /**
         *
         */
        TRADE = <any>'TRADE',
    }
}

export class GetRedeemPreviewReqBuilder {
    constructor(readonly obj: GetRedeemPreviewReq) {
        this.obj = obj;
    }
    /**
     * Holding ID
     */
    setOrderId(value: string): GetRedeemPreviewReqBuilder {
        this.obj.orderId = value;
        return this;
    }

    /**
     * Account type: MAIN (funding account), TRADE (spot trading account). This parameter is valid only when orderId=ETH2
     */
    setFromAccountType(value: GetRedeemPreviewReq.FromAccountTypeEnum): GetRedeemPreviewReqBuilder {
        this.obj.fromAccountType = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): GetRedeemPreviewReq {
        return this.obj;
    }
}
