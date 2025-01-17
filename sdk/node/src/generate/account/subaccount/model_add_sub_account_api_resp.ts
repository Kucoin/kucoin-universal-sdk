// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class AddSubAccountApiResp implements Response<AddSubAccountApiResp, RestResponse> {
    /**
     * Sub-account name
     */
    subName?: string;
    /**
     * Remarks
     */
    remark?: string;
    /**
     * API Key
     */
    apiKey?: string;
    /**
     * API Secret Key
     */
    apiSecret?: string;
    /**
     * API Version
     */
    apiVersion?: number;
    /**
     * Password
     */
    passphrase?: string;
    /**
     * [Permissions](https://www.kucoin.com/docs-new/doc-338144)
     */
    permission?: string;
    /**
     * IP whitelist
     */
    ipWhitelist?: string;
    /**
     * Time of the event
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

    fromJson(input: string): AddSubAccountApiResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(AddSubAccountApiResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): AddSubAccountApiResp {
        return plainToInstance(AddSubAccountApiResp, jsonObject);
    }
}