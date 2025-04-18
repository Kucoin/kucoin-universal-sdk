// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { GetAllTickersTicker } from './model_get_all_tickers_ticker';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetAllTickersResp implements Response<RestResponse> {
    /**
     * timestamp
     */
    time: number;

    /**
     *
     */
    @Type(() => GetAllTickersTicker)
    ticker: Array<GetAllTickersTicker>;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.time = null;
        // @ts-ignore
        this.ticker = null;
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
    static fromJson(input: string): GetAllTickersResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetAllTickersResp {
        return plainToClassFromExist(new GetAllTickersResp(), jsonObject);
    }
}
