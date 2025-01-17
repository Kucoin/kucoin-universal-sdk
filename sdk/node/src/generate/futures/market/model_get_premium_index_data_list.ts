// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetPremiumIndexDataList implements Serializable<GetPremiumIndexDataList> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Granularity(milisecond)
     */
    granularity?: number;
    /**
     * Timestamp(milisecond)
     */
    timePoint?: number;
    /**
     * Premium index
     */
    value?: number;

    fromJson(input: string): GetPremiumIndexDataList {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetPremiumIndexDataList, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetPremiumIndexDataList {
        return plainToInstance(GetPremiumIndexDataList, jsonObject);
    }
}