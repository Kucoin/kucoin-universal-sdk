// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetDepositAddressV3Req implements Serializable<GetDepositAddressV3Req> {
    /**
     * currency
     */
    currency?: string;
    /**
     * Deposit amount. This parameter is only used when applying for invoices on the Lightning Network. This parameter is invalid if it is not passed through the Lightning Network.
     */
    amount?: string;
    /**
     * The chain Id of currency.
     */
    chain?: string;

    /**
     * Creates a new instance of the `GetDepositAddressV3Req` class.
     * The builder pattern allows step-by-step construction of a `GetDepositAddressV3Req` object.
     */
    static builder(): GetDepositAddressV3ReqBuilder {
        return new GetDepositAddressV3ReqBuilder();
    }

    /**
     * Creates a new instance of the `GetDepositAddressV3Req` class with the given data.
     */
    static create(data: {
        /**
         * currency
         */
        currency?: string;
        /**
         * Deposit amount. This parameter is only used when applying for invoices on the Lightning Network. This parameter is invalid if it is not passed through the Lightning Network.
         */
        amount?: string;
        /**
         * The chain Id of currency.
         */
        chain?: string;
    }): GetDepositAddressV3Req {
        let obj = new GetDepositAddressV3Req();
        obj.currency = data.currency;
        obj.amount = data.amount;
        obj.chain = data.chain;
        return obj;
    }

    fromJson(input: string): GetDepositAddressV3Req {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetDepositAddressV3Req, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetDepositAddressV3Req {
        return plainToInstance(GetDepositAddressV3Req, jsonObject);
    }
}

export class GetDepositAddressV3ReqBuilder {
    obj: GetDepositAddressV3Req = new GetDepositAddressV3Req();
    /**
     * currency
     */
    setCurrency(value: string): GetDepositAddressV3ReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Deposit amount. This parameter is only used when applying for invoices on the Lightning Network. This parameter is invalid if it is not passed through the Lightning Network.
     */
    setAmount(value: string): GetDepositAddressV3ReqBuilder {
        this.obj.amount = value;
        return this;
    }

    /**
     * The chain Id of currency.
     */
    setChain(value: string): GetDepositAddressV3ReqBuilder {
        this.obj.chain = value;
        return this;
    }

    build(): GetDepositAddressV3Req {
        return this.obj;
    }
}