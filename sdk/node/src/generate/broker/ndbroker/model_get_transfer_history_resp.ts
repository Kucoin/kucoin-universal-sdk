// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetTransferHistoryResp implements Response<RestResponse> {
    /**
     * Transfer Order ID
     */
    orderId: string;

    /**
     * Currency
     */
    currency: string;

    /**
     * Transfer Amount
     */
    amount: string;

    /**
     * UID of the user transferring out
     */
    fromUid: number;

    /**
     * From Account Type: Account Type: MAIN, TRADE, CONTRACT, MARGIN, ISOLATED
     */
    fromAccountType: GetTransferHistoryResp.FromAccountTypeEnum;

    /**
     * Trading pair (required if the account type is ISOLATED), e.g., BTC-USDT
     */
    fromAccountTag: string;

    /**
     * UID of the user transferring in
     */
    toUid: number;

    /**
     * Account Type: Account Type: MAIN, TRADE, CONTRACT, MARGIN, ISOLATED
     */
    toAccountType: GetTransferHistoryResp.ToAccountTypeEnum;

    /**
     * To Trading pair (required if the account type is ISOLATED), e.g., BTC-USDT
     */
    toAccountTag: string;

    /**
     * Status: PROCESSING (processing), SUCCESS (successful), FAILURE (failed)
     */
    status: GetTransferHistoryResp.StatusEnum;

    /**
     * Failure Reason
     */
    reason: string;

    /**
     * Creation Time (Unix timestamp in milliseconds)
     */
    createdAt: number;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.orderId = null;
        // @ts-ignore
        this.currency = null;
        // @ts-ignore
        this.amount = null;
        // @ts-ignore
        this.fromUid = null;
        // @ts-ignore
        this.fromAccountType = null;
        // @ts-ignore
        this.fromAccountTag = null;
        // @ts-ignore
        this.toUid = null;
        // @ts-ignore
        this.toAccountType = null;
        // @ts-ignore
        this.toAccountTag = null;
        // @ts-ignore
        this.status = null;
        // @ts-ignore
        this.reason = null;
        // @ts-ignore
        this.createdAt = null;
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
    static fromJson(input: string): GetTransferHistoryResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetTransferHistoryResp {
        return plainToClassFromExist(new GetTransferHistoryResp(), jsonObject);
    }
}

export namespace GetTransferHistoryResp {
    export enum FromAccountTypeEnum {
        /**
         *
         */
        MAIN = <any>'MAIN',
        /**
         *
         */
        TRADE = <any>'TRADE',
        /**
         *
         */
        CONTRACT = <any>'CONTRACT',
        /**
         *
         */
        MARGIN = <any>'MARGIN',
        /**
         *
         */
        ISOLATED = <any>'ISOLATED',
    }
    export enum ToAccountTypeEnum {
        /**
         *
         */
        MAIN = <any>'MAIN',
        /**
         *
         */
        TRADE = <any>'TRADE',
        /**
         *
         */
        CONTRACT = <any>'CONTRACT',
        /**
         *
         */
        MARGIN = <any>'MARGIN',
        /**
         *
         */
        ISOLATED = <any>'ISOLATED',
    }
    export enum StatusEnum {
        /**
         *
         */
        PROCESSING = <any>'PROCESSING',
        /**
         *
         */
        SUCCESS = <any>'SUCCESS',
        /**
         *
         */
        FAILURE = <any>'FAILURE',
    }
}
