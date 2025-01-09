// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class ModifyIsolatedMarginRiskLimtReq
    implements Serializable<ModifyIsolatedMarginRiskLimtReq>
{
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * level
     */
    level?: number;

    /**
     * Creates a new instance of the `ModifyIsolatedMarginRiskLimtReq` class.
     * The builder pattern allows step-by-step construction of a `ModifyIsolatedMarginRiskLimtReq` object.
     */
    static builder(): ModifyIsolatedMarginRiskLimtReqBuilder {
        return new ModifyIsolatedMarginRiskLimtReqBuilder();
    }

    /**
     * Creates a new instance of the `ModifyIsolatedMarginRiskLimtReq` class with the given data.
     */
    static create(data: {
        /**
         * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
         */
        symbol?: string;
        /**
         * level
         */
        level?: number;
    }): ModifyIsolatedMarginRiskLimtReq {
        let obj = new ModifyIsolatedMarginRiskLimtReq();
        obj.symbol = data.symbol;
        obj.level = data.level;
        return obj;
    }

    fromJson(input: string): ModifyIsolatedMarginRiskLimtReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(ModifyIsolatedMarginRiskLimtReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): ModifyIsolatedMarginRiskLimtReq {
        return plainToInstance(ModifyIsolatedMarginRiskLimtReq, jsonObject);
    }
}

export class ModifyIsolatedMarginRiskLimtReqBuilder {
    obj: ModifyIsolatedMarginRiskLimtReq = new ModifyIsolatedMarginRiskLimtReq();
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    setSymbol(value: string): ModifyIsolatedMarginRiskLimtReqBuilder {
        this.obj.symbol = value;
        return this;
    }

    /**
     * level
     */
    setLevel(value: number): ModifyIsolatedMarginRiskLimtReqBuilder {
        this.obj.level = value;
        return this;
    }

    build(): ModifyIsolatedMarginRiskLimtReq {
        return this.obj;
    }
}