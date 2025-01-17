// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class ModifySubAccountApiResp implements Response<ModifySubAccountApiResp, RestResponse> {
    /**
     * Sub-Account UID
     */
    uid?: string;
    /**
     * apikey remarks
     */
    label?: string;
    /**
     * apiKey
     */
    apiKey?: string;
    /**
     * apiVersion
     */
    apiVersion?: number;
    /**
     * [Permissions](https://www.kucoin.com/docs-new/doc-338144) group list
     */
    permissions?: Array<string>;
    /**
     * IP whitelist list
     */
    ipWhitelist?: Array<string>;
    /**
     * Creation time, unix timestamp (milliseconds)
     */
    createdAt?: number;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): ModifySubAccountApiResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(ModifySubAccountApiResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): ModifySubAccountApiResp {
        return plainToInstance(ModifySubAccountApiResp, jsonObject);
    }
}