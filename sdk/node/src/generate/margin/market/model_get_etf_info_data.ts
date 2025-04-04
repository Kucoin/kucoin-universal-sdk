// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetETFInfoData implements Serializable {
    /**
     * ETF Currency
     */
    currency: string;

    /**
     * Net worth
     */
    netAsset: string;

    /**
     * Target leverage
     */
    targetLeverage: string;

    /**
     * Actual leverage
     */
    actualLeverage: string;

    /**
     * The amount of currency issued
     */
    issuedSize: string;

    /**
     * Basket information
     */
    basket: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.currency = null;
        // @ts-ignore
        this.netAsset = null;
        // @ts-ignore
        this.targetLeverage = null;
        // @ts-ignore
        this.actualLeverage = null;
        // @ts-ignore
        this.issuedSize = null;
        // @ts-ignore
        this.basket = null;
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
    static fromJson(input: string): GetETFInfoData {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetETFInfoData {
        return plainToClassFromExist(new GetETFInfoData(), jsonObject);
    }
}
