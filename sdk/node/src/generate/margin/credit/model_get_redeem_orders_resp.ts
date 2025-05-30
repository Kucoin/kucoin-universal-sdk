// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { GetRedeemOrdersItems } from './model_get_redeem_orders_items';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetRedeemOrdersResp implements Response<RestResponse> {
    /**
     * Current Page
     */
    currentPage: number;

    /**
     * Page Size
     */
    pageSize: number;

    /**
     * Total Number
     */
    totalNum: number;

    /**
     * Total Pages
     */
    totalPage: number;

    /**
     *
     */
    @Type(() => GetRedeemOrdersItems)
    items: Array<GetRedeemOrdersItems>;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.currentPage = null;
        // @ts-ignore
        this.pageSize = null;
        // @ts-ignore
        this.totalNum = null;
        // @ts-ignore
        this.totalPage = null;
        // @ts-ignore
        this.items = null;
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
    static fromJson(input: string): GetRedeemOrdersResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetRedeemOrdersResp {
        return plainToClassFromExist(new GetRedeemOrdersResp(), jsonObject);
    }
}
