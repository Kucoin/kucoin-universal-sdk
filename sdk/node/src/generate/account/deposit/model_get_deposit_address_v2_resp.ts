// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { GetDepositAddressV2Data } from './model_get_deposit_address_v2_data';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetDepositAddressV2Resp implements Response<GetDepositAddressV2Resp, RestResponse> {
    /**
     *
     */
    @Type(() => GetDepositAddressV2Data)
    data?: Array<GetDepositAddressV2Data>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetDepositAddressV2Resp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetDepositAddressV2Resp, { data: jsonObject });
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this.data));
    }

    fromObject(jsonObject: Object): GetDepositAddressV2Resp {
        return plainToInstance(GetDepositAddressV2Resp, { data: jsonObject });
    }
}