// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class CancelAllOrdersFailedSymbols implements Serializable<CancelAllOrdersFailedSymbols> {
    /**
     * symbol
     */
    symbol?: string;
    /**
     * error message
     */
    error?: string;

    fromJson(input: string): CancelAllOrdersFailedSymbols {
        const jsonObject = JSON.parse(input);
        return plainToInstance(CancelAllOrdersFailedSymbols, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): CancelAllOrdersFailedSymbols {
        return plainToInstance(CancelAllOrdersFailedSymbols, jsonObject);
    }
}