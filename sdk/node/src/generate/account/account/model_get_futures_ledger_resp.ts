// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { GetFuturesLedgerDataList } from './model_get_futures_ledger_data_list';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetFuturesLedgerResp implements Response<RestResponse> {
    /**
     *
     */
    @Type(() => GetFuturesLedgerDataList)
    dataList: Array<GetFuturesLedgerDataList>;

    /**
     * Is it the last page? If it is false, it means it is the last page, and if it is true, it means you need to move to the next page.
     */
    hasMore: boolean;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.dataList = null;
        // @ts-ignore
        this.hasMore = null;
    }
    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    /**
     * Convert the object to a JSON string.
     */
    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): GetFuturesLedgerResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetFuturesLedgerResp {
        return plainToClassFromExist(new GetFuturesLedgerResp(), jsonObject);
    }
}
