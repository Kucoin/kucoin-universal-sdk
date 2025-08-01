// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class BatchSwitchMarginModeErrors implements Serializable {
    /**
     * Error code
     */
    code?: string;

    /**
     * Error message
     */
    msg?: string;

    /**
     * Symbol
     */
    symbol?: string;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Convert the object to a JSON string.
     */
    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): BatchSwitchMarginModeErrors {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): BatchSwitchMarginModeErrors {
        return plainToClassFromExist(new BatchSwitchMarginModeErrors(), jsonObject);
    }
}
