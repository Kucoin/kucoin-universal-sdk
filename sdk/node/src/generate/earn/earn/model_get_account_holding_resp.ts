// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { GetAccountHoldingItems } from './model_get_account_holding_items';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetAccountHoldingResp implements Response<GetAccountHoldingResp, RestResponse> {
    /**
     * total number
     */
    totalNum?: number;
    /**
     *
     */
    @Type(() => GetAccountHoldingItems)
    items?: Array<GetAccountHoldingItems>;
    /**
     * current page
     */
    currentPage?: number;
    /**
     * page size
     */
    pageSize?: number;
    /**
     * total page
     */
    totalPage?: number;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetAccountHoldingResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetAccountHoldingResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetAccountHoldingResp {
        return plainToInstance(GetAccountHoldingResp, jsonObject);
    }
}