// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetMarkPriceListData implements Serializable {
    /**
     * symbol
     */
    symbol: string;

    /**
     * Timestamp (milliseconds)
     */
    timePoint: number;

    /**
     * Mark price
     */
    value: number;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.timePoint = null;
        // @ts-ignore
        this.value = null;
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
    static fromJson(input: string): GetMarkPriceListData {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetMarkPriceListData {
        return plainToClassFromExist(new GetMarkPriceListData(), jsonObject);
    }
}
