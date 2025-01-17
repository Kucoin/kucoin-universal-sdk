// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetMarkPriceResp implements Response<GetMarkPriceResp, RestResponse> {
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Granularity (milisecond)
     */
    granularity?: number;
    /**
     * Time point (milisecond)
     */
    timePoint?: number;
    /**
     * Mark price
     */
    value?: number;
    /**
     * Index price
     */
    indexPrice?: number;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetMarkPriceResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetMarkPriceResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetMarkPriceResp {
        return plainToInstance(GetMarkPriceResp, jsonObject);
    }
}