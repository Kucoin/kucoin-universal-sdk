// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { GetSpotLedgerItems } from './model_get_spot_ledger_items';
import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetSpotLedgerResp implements Response<GetSpotLedgerResp, RestResponse> {
    /**
     * current page
     */
    currentPage?: number;
    /**
     * page size
     */
    pageSize?: number;
    /**
     * total number
     */
    totalNum?: number;
    /**
     * total page
     */
    totalPage?: number;
    /**
     *
     */
    @Type(() => GetSpotLedgerItems)
    items?: Array<GetSpotLedgerItems>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetSpotLedgerResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetSpotLedgerResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetSpotLedgerResp {
        return plainToInstance(GetSpotLedgerResp, jsonObject);
    }
}