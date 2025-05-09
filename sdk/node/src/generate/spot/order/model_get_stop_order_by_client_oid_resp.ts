// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { GetStopOrderByClientOidData } from './model_get_stop_order_by_client_oid_data';
import { Type, instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetStopOrderByClientOidResp implements Response<RestResponse> {
    /**
     * the return code
     */
    @Type(() => GetStopOrderByClientOidData)
    data: Array<GetStopOrderByClientOidData>;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.data = null;
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
        return JSON.stringify(instanceToPlain(this.data));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): GetStopOrderByClientOidResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetStopOrderByClientOidResp {
        return plainToClassFromExist(new GetStopOrderByClientOidResp(), { data: jsonObject });
    }
}
