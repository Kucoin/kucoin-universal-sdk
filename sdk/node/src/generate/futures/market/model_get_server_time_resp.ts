// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetServerTimeResp implements Response<GetServerTimeResp, RestResponse> {
    /**
     * ServerTime(millisecond)
     */
    data?: number;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetServerTimeResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetServerTimeResp, { data: jsonObject });
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this.data));
    }

    fromObject(jsonObject: Object): GetServerTimeResp {
        return plainToInstance(GetServerTimeResp, { data: jsonObject });
    }
}