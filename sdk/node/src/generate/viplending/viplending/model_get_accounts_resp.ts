// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { GetAccountsData } from './model_get_accounts_data';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetAccountsResp implements Response<GetAccountsResp, RestResponse> {
    /**
     *
     */
    @Type(() => GetAccountsData)
    data?: Array<GetAccountsData>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetAccountsResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetAccountsResp, { data: jsonObject });
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this.data));
    }

    fromObject(jsonObject: Object): GetAccountsResp {
        return plainToInstance(GetAccountsResp, { data: jsonObject });
    }
}