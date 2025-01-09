// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetFuturesAccountTransferOutLedgerItems
    implements Serializable<GetFuturesAccountTransferOutLedgerItems>
{
    /**
     * Transfer order ID
     */
    applyId?: string;
    /**
     * Currency
     */
    currency?: string;
    /**
     * Receive account tx remark
     */
    recRemark?: string;
    /**
     * Receive system
     */
    recSystem?: string;
    /**
     * Status PROCESSING, SUCCESS, FAILURE
     */
    status?: GetFuturesAccountTransferOutLedgerItems.StatusEnum;
    /**
     * Transaction amount
     */
    amount?: string;
    /**
     * Reason caused the failure
     */
    reason?: string;
    /**
     * Offset
     */
    offset?: number;
    /**
     * Request application time
     */
    createdAt?: number;
    /**
     * User remark
     */
    remark?: string;

    fromJson(input: string): GetFuturesAccountTransferOutLedgerItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetFuturesAccountTransferOutLedgerItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetFuturesAccountTransferOutLedgerItems {
        return plainToInstance(GetFuturesAccountTransferOutLedgerItems, jsonObject);
    }
}

export namespace GetFuturesAccountTransferOutLedgerItems {
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