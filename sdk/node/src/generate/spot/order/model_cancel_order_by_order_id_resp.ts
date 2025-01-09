// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class CancelOrderByOrderIdResp implements Response<CancelOrderByOrderIdResp, RestResponse> {
    /**
     * order id
     */
    orderId?: string;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): CancelOrderByOrderIdResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(CancelOrderByOrderIdResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): CancelOrderByOrderIdResp {
        return plainToInstance(CancelOrderByOrderIdResp, jsonObject);
    }
}