// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class AddIsolatedMarginReq implements Serializable<AddIsolatedMarginReq> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Margin amount (min. margin amount≥0.00001667XBT）
     */
    margin?: number;
    /**
     * A unique ID generated by the user, to ensure the operation is processed by the system only once, The maximum length cannot exceed 36
     */
    bizNo?: string;

    /**
     * Creates a new instance of the `AddIsolatedMarginReq` class.
     * The builder pattern allows step-by-step construction of a `AddIsolatedMarginReq` object.
     */
    static builder(): AddIsolatedMarginReqBuilder {
        return new AddIsolatedMarginReqBuilder();
    }

    /**
     * Creates a new instance of the `AddIsolatedMarginReq` class with the given data.
     */
    static create(data: {
        /**
         * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
        /**
         * Margin amount (min. margin amount≥0.00001667XBT）
         */
        margin?: number;
        /**
         * A unique ID generated by the user, to ensure the operation is processed by the system only once, The maximum length cannot exceed 36
         */
        bizNo?: string;
    }): AddIsolatedMarginReq {
        let obj = new AddIsolatedMarginReq();
        obj.symbol = data.symbol;
        obj.margin = data.margin;
        obj.bizNo = data.bizNo;
        return obj;
    }

    fromJson(input: string): AddIsolatedMarginReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(AddIsolatedMarginReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): AddIsolatedMarginReq {
        return plainToInstance(AddIsolatedMarginReq, jsonObject);
    }
}

export class AddIsolatedMarginReqBuilder {
    obj: AddIsolatedMarginReq = new AddIsolatedMarginReq();
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): AddIsolatedMarginReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * Margin amount (min. margin amount≥0.00001667XBT）
     */
    setMargin(value: number): AddIsolatedMarginReqBuilder {
        this.obj.margin = value;
        return this;
    }

    /**
     * A unique ID generated by the user, to ensure the operation is processed by the system only once, The maximum length cannot exceed 36
     */
    setBizNo(value: string): AddIsolatedMarginReqBuilder {
        this.obj.bizNo = value;
        return this;
    }

    build(): AddIsolatedMarginReq {
        return this.obj;
    }
}