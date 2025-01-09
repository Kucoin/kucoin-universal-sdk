// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { GetPublicTokenInstanceServers } from './model_get_public_token_instance_servers';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetPublicTokenResp implements Response<GetPublicTokenResp, RestResponse> {
    /**
     * The token required to establish a websocket connection
     */
    token?: string;
    /**
     *
     */
    @Type(() => GetPublicTokenInstanceServers)
    instanceServers?: Array<GetPublicTokenInstanceServers>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetPublicTokenResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetPublicTokenResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetPublicTokenResp {
        return plainToInstance(GetPublicTokenResp, jsonObject);
    }
}