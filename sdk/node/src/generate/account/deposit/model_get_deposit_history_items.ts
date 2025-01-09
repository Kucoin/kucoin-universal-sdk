// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetDepositHistoryItems implements Serializable<GetDepositHistoryItems> {
    /**
     * Currency
     */
    currency?: string;
    /**
     * The chainName of currency
     */
    chain?: string;
    /**
     * Status
     */
    status?: GetDepositHistoryItems.StatusEnum;
    /**
     * Deposit address
     */
    address?: string;
    /**
     * Address remark. If there’s no remark, it is empty.
     */
    memo?: string;
    /**
     * Internal deposit or not
     */
    isInner?: boolean;
    /**
     * Deposit amount
     */
    amount?: string;
    /**
     * Fees charged for deposit
     */
    fee?: string;
    /**
     * Wallet Txid
     */
    walletTxId?: string;
    /**
     * Creation time of the database record
     */
    createdAt?: number;
    /**
     * Update time of the database record
     */
    updatedAt?: number;
    /**
     * remark
     */
    remark?: string;
    /**
     * Whether there is any debt.A quick rollback will cause the deposit to fail. If the deposit fails, you will need to repay the balance.
     */
    arrears?: boolean;

    fromJson(input: string): GetDepositHistoryItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetDepositHistoryItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetDepositHistoryItems {
        return plainToInstance(GetDepositHistoryItems, jsonObject);
    }
}

export namespace GetDepositHistoryItems {
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