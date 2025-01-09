// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { GetIsolatedMarginAccountAssets } from './model_get_isolated_margin_account_assets';
import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetIsolatedMarginAccountResp
    implements Response<GetIsolatedMarginAccountResp, RestResponse>
{
    /**
     * Total Assets in Quote Currency
     */
    totalAssetOfQuoteCurrency?: string;
    /**
     * Total Liability in Quote Currency
     */
    totalLiabilityOfQuoteCurrency?: string;
    /**
     * timestamp
     */
    timestamp?: number;
    /**
     *
     */
    @Type(() => GetIsolatedMarginAccountAssets)
    assets?: Array<GetIsolatedMarginAccountAssets>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetIsolatedMarginAccountResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetIsolatedMarginAccountResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetIsolatedMarginAccountResp {
        return plainToInstance(GetIsolatedMarginAccountResp, jsonObject);
    }
}