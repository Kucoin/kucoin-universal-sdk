// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class SubAccountTransferReq implements Serializable<SubAccountTransferReq> {
    /**
     * Unique order id created by users to identify their orders, e.g. UUID, with a maximum length of 128 bits
     */
    clientOid?: string;
    /**
     * currency
     */
    currency?: string;
    /**
     * Transfer amount, the amount is a positive integer multiple of the currency precision.
     */
    amount?: string;
    /**
     * OUT — the master user to sub user IN — the sub user to the master user.
     */
    direction?: SubAccountTransferReq.DirectionEnum;
    /**
     * Account type：MAIN、TRADE、CONTRACT、MARGIN
     */
    accountType?: SubAccountTransferReq.AccountTypeEnum =
        SubAccountTransferReq.AccountTypeEnum.MAIN;
    /**
     * Sub Account type：MAIN、TRADE、CONTRACT、MARGIN
     */
    subAccountType?: SubAccountTransferReq.SubAccountTypeEnum =
        SubAccountTransferReq.SubAccountTypeEnum.MAIN;
    /**
     * the user ID of a sub-account.
     */
    subUserId?: string;

    /**
     * Creates a new instance of the `SubAccountTransferReq` class.
     * The builder pattern allows step-by-step construction of a `SubAccountTransferReq` object.
     */
    static builder(): SubAccountTransferReqBuilder {
        return new SubAccountTransferReqBuilder();
    }

    /**
     * Creates a new instance of the `SubAccountTransferReq` class with the given data.
     */
    static create(data: {
        /**
         * Unique order id created by users to identify their orders, e.g. UUID, with a maximum length of 128 bits
         */
        clientOid?: string;
        /**
         * currency
         */
        currency?: string;
        /**
         * Transfer amount, the amount is a positive integer multiple of the currency precision.
         */
        amount?: string;
        /**
         * OUT — the master user to sub user IN — the sub user to the master user.
         */
        direction?: SubAccountTransferReq.DirectionEnum;
        /**
         * Account type：MAIN、TRADE、CONTRACT、MARGIN
         */
        accountType?: SubAccountTransferReq.AccountTypeEnum;
        /**
         * Sub Account type：MAIN、TRADE、CONTRACT、MARGIN
         */
        subAccountType?: SubAccountTransferReq.SubAccountTypeEnum;
        /**
         * the user ID of a sub-account.
         */
        subUserId?: string;
    }): SubAccountTransferReq {
        let obj = new SubAccountTransferReq();
        obj.clientOid = data.clientOid;
        obj.currency = data.currency;
        obj.amount = data.amount;
        obj.direction = data.direction;
        obj.accountType = data.accountType;
        obj.subAccountType = data.subAccountType;
        obj.subUserId = data.subUserId;
        return obj;
    }

    fromJson(input: string): SubAccountTransferReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(SubAccountTransferReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): SubAccountTransferReq {
        return plainToInstance(SubAccountTransferReq, jsonObject);
    }
}

export namespace SubAccountTransferReq {
    export enum DirectionEnum {
        /**
         *
         */
        IN = <any>'IN',
        /**
         *
         */
        OUT = <any>'OUT',
    }
    export enum AccountTypeEnum {
        /**
         * Funding account
         */
        MAIN = <any>'MAIN',
        /**
         * Spot account
         */
        TRADE = <any>'TRADE',
        /**
         * Margin account
         */
        MARGIN = <any>'MARGIN',
        /**
         * Futures account
         */
        CONTRACT = <any>'CONTRACT',
        /**
         * Option account
         */
        OPTION = <any>'OPTION',
    }
    export enum SubAccountTypeEnum {
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
        MARGIN = <any>'MARGIN',
        /**
         *
         */
        CONTRACT = <any>'CONTRACT',
    }
}

export class SubAccountTransferReqBuilder {
    obj: SubAccountTransferReq = new SubAccountTransferReq();
    /**
     * Unique order id created by users to identify their orders, e.g. UUID, with a maximum length of 128 bits
     */
    setClientOid(value: string): SubAccountTransferReqBuilder {
        this.obj.clientOid = value;
        return this;
    }

    /**
     * currency
     */
    setCurrency(value: string): SubAccountTransferReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Transfer amount, the amount is a positive integer multiple of the currency precision.
     */
    setAmount(value: string): SubAccountTransferReqBuilder {
        this.obj.amount = value;
        return this;
    }

    /**
     * OUT — the master user to sub user IN — the sub user to the master user.
     */
    setDirection(value: SubAccountTransferReq.DirectionEnum): SubAccountTransferReqBuilder {
        this.obj.direction = value;
        return this;
    }

    /**
     * Account type：MAIN、TRADE、CONTRACT、MARGIN
     */
    setAccountType(value: SubAccountTransferReq.AccountTypeEnum): SubAccountTransferReqBuilder {
        this.obj.accountType = value;
        return this;
    }

    /**
     * Sub Account type：MAIN、TRADE、CONTRACT、MARGIN
     */
    setSubAccountType(
        value: SubAccountTransferReq.SubAccountTypeEnum,
    ): SubAccountTransferReqBuilder {
        this.obj.subAccountType = value;
        return this;
    }

    /**
     * the user ID of a sub-account.
     */
    setSubUserId(value: string): SubAccountTransferReqBuilder {
        this.obj.subUserId = value;
        return this;
    }

    build(): SubAccountTransferReq {
        return this.obj;
    }
}