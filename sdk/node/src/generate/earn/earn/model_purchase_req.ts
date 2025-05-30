// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class PurchaseReq implements Serializable {
    /**
     * Product ID
     */
    productId: string;

    /**
     * Subscription amount
     */
    amount: string;

    /**
     * MAIN (funding account), TRADE (spot trading account)
     */
    accountType: PurchaseReq.AccountTypeEnum;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.productId = null;
        // @ts-ignore
        this.amount = null;
        // @ts-ignore
        this.accountType = null;
    }
    /**
     * Creates a new instance of the `PurchaseReq` class.
     * The builder pattern allows step-by-step construction of a `PurchaseReq` object.
     */
    static builder(): PurchaseReqBuilder {
        return new PurchaseReqBuilder(new PurchaseReq());
    }

    /**
     * Creates a new instance of the `PurchaseReq` class with the given data.
     */
    static create(data: {
        /**
         * Product ID
         */
        productId: string;
        /**
         * Subscription amount
         */
        amount: string;
        /**
         * MAIN (funding account), TRADE (spot trading account)
         */
        accountType: PurchaseReq.AccountTypeEnum;
    }): PurchaseReq {
        let obj = new PurchaseReq();
        obj.productId = data.productId;
        obj.amount = data.amount;
        obj.accountType = data.accountType;
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
    static fromJson(input: string): PurchaseReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): PurchaseReq {
        return plainToClassFromExist(new PurchaseReq(), jsonObject);
    }
}

export namespace PurchaseReq {
    export enum AccountTypeEnum {
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

export class PurchaseReqBuilder {
    constructor(readonly obj: PurchaseReq) {
        this.obj = obj;
    }
    /**
     * Product ID
     */
    setProductId(value: string): PurchaseReqBuilder {
        this.obj.productId = value;
        return this;
    }

    /**
     * Subscription amount
     */
    setAmount(value: string): PurchaseReqBuilder {
        this.obj.amount = value;
        return this;
    }

    /**
     * MAIN (funding account), TRADE (spot trading account)
     */
    setAccountType(value: PurchaseReq.AccountTypeEnum): PurchaseReqBuilder {
        this.obj.accountType = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): PurchaseReq {
        return this.obj;
    }
}
