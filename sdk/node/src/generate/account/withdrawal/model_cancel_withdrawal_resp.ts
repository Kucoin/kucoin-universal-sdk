// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class CancelWithdrawalResp implements Response<CancelWithdrawalResp, RestResponse> {
    /**
     *
     */
    data?: string;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): CancelWithdrawalResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(CancelWithdrawalResp, { data: jsonObject });
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this.data));
    }

    fromObject(jsonObject: Object): CancelWithdrawalResp {
        return plainToInstance(CancelWithdrawalResp, { data: jsonObject });
    }
}