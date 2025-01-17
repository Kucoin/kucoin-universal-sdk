// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetSpotAccountDetailResp implements Response<GetSpotAccountDetailResp, RestResponse> {
    /**
     * The currency of the account
     */
    currency?: string;
    /**
     * Total funds in the account
     */
    balance?: string;
    /**
     * Funds available to withdraw or trade
     */
    available?: string;
    /**
     * Funds on hold (not available for use)
     */
    holds?: string;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetSpotAccountDetailResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetSpotAccountDetailResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetSpotAccountDetailResp {
        return plainToInstance(GetSpotAccountDetailResp, jsonObject);
    }
}