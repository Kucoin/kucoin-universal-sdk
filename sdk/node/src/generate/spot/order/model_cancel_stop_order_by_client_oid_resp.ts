// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class CancelStopOrderByClientOidResp
    implements Response<CancelStopOrderByClientOidResp, RestResponse>
{
    /**
     * Client Order Id，unique identifier created by the user
     */
    clientOid?: string;
    /**
     * Unique ID of the cancelled order
     */
    cancelledOrderId?: string;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): CancelStopOrderByClientOidResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(CancelStopOrderByClientOidResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): CancelStopOrderByClientOidResp {
        return plainToInstance(CancelStopOrderByClientOidResp, jsonObject);
    }
}