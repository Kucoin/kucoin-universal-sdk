// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetCrossMarginRiskLimitData implements Serializable {
    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol: string;

    /**
     * Maximum amount of open position(Unit is **lots**)
     */
    maxOpenSize: number;

    /**
     * Maximum value of open position(Unit is **quoteCcy**)
     */
    maxOpenValue: string;

    /**
     * Margin amount used for max position calculation.
     */
    totalMargin: string;

    /**
     * Price used for max position calculation. Defaults to latest transaction price
     */
    price: string;

    /**
     * Leverage used for max position calculation.
     */
    leverage: string;

    /**
     * Maintenance Margin Rate
     */
    mmr: string;

    /**
     * Initial Margin Rate
     */
    imr: string;

    /**
     * Margin Currency
     */
    currency: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.maxOpenSize = null;
        // @ts-ignore
        this.maxOpenValue = null;
        // @ts-ignore
        this.totalMargin = null;
        // @ts-ignore
        this.price = null;
        // @ts-ignore
        this.leverage = null;
        // @ts-ignore
        this.mmr = null;
        // @ts-ignore
        this.imr = null;
        // @ts-ignore
        this.currency = null;
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
    static fromJson(input: string): GetCrossMarginRiskLimitData {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetCrossMarginRiskLimitData {
        return plainToClassFromExist(new GetCrossMarginRiskLimitData(), jsonObject);
    }
}
