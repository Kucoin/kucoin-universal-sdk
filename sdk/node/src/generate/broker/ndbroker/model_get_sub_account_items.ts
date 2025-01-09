// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetSubAccountItems implements Serializable<GetSubAccountItems> {
    /**
     * Sub-account name
     */
    accountName?: string;
    /**
     * Sub-account UID
     */
    uid?: string;
    /**
     * Creation time, unix timestamp (milliseconds)
     */
    createdAt?: number;
    /**
     * Sub-account VIP level
     */
    level?: number;

    fromJson(input: string): GetSubAccountItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetSubAccountItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetSubAccountItems {
        return plainToInstance(GetSubAccountItems, jsonObject);
    }
}