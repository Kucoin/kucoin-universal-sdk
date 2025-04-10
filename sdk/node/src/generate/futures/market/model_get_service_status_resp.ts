// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetServiceStatusResp implements Response<RestResponse> {
    /**
     *
     */
    msg: string;

    /**
     * Status of service: open: normal transaction; close: Stop Trading/Maintenance; cancelonly: can only cancel the order but not place order
     */
    status: GetServiceStatusResp.StatusEnum;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.msg = null;
        // @ts-ignore
        this.status = null;
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
    static fromJson(input: string): GetServiceStatusResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetServiceStatusResp {
        return plainToClassFromExist(new GetServiceStatusResp(), jsonObject);
    }
}

export namespace GetServiceStatusResp {
    export enum StatusEnum {
        /**
         * normal transaction
         */
        OPEN = <any>'open',
        /**
         * Stop Trading/Maintenance
         */
        CLOSE = <any>'close',
        /**
         * can only cancel the order but not place order
         */
        CANCELONLY = <any>'cancelonly',
    }
}
