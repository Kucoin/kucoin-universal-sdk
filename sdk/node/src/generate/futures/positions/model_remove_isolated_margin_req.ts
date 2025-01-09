// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class RemoveIsolatedMarginReq implements Serializable<RemoveIsolatedMarginReq> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * The size of the position that can be deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
     */
    withdrawAmount?: string;

    /**
     * Creates a new instance of the `RemoveIsolatedMarginReq` class.
     * The builder pattern allows step-by-step construction of a `RemoveIsolatedMarginReq` object.
     */
    static builder(): RemoveIsolatedMarginReqBuilder {
        return new RemoveIsolatedMarginReqBuilder();
    }

    /**
     * Creates a new instance of the `RemoveIsolatedMarginReq` class with the given data.
     */
    static create(data: {
        /**
         * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
        /**
         * The size of the position that can be deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
         */
        withdrawAmount?: string;
    }): RemoveIsolatedMarginReq {
        let obj = new RemoveIsolatedMarginReq();
        obj.symbol = data.symbol;
        obj.withdrawAmount = data.withdrawAmount;
        return obj;
    }

    fromJson(input: string): RemoveIsolatedMarginReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(RemoveIsolatedMarginReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): RemoveIsolatedMarginReq {
        return plainToInstance(RemoveIsolatedMarginReq, jsonObject);
    }
}

export class RemoveIsolatedMarginReqBuilder {
    obj: RemoveIsolatedMarginReq = new RemoveIsolatedMarginReq();
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): RemoveIsolatedMarginReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * The size of the position that can be deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
     */
    setWithdrawAmount(value: string): RemoveIsolatedMarginReqBuilder {
        this.obj.withdrawAmount = value;
        return this;
    }

    build(): RemoveIsolatedMarginReq {
        return this.obj;
    }
}