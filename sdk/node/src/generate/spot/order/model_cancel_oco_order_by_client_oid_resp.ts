// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class CancelOcoOrderByClientOidResp
    implements Response<CancelOcoOrderByClientOidResp, RestResponse>
{
    /**
     * List of two order IDs related to the canceled OCO order
     */
    cancelledOrderIds?: Array<string>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): CancelOcoOrderByClientOidResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(CancelOcoOrderByClientOidResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): CancelOcoOrderByClientOidResp {
        return plainToInstance(CancelOcoOrderByClientOidResp, jsonObject);
    }
}