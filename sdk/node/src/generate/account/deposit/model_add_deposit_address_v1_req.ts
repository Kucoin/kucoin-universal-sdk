// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class AddDepositAddressV1Req implements Serializable<AddDepositAddressV1Req> {
    /**
     * currency
     */
    currency?: string;
    /**
     * The chainId of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    chain?: string = 'eth';

    /**
     * Creates a new instance of the `AddDepositAddressV1Req` class.
     * The builder pattern allows step-by-step construction of a `AddDepositAddressV1Req` object.
     */
    static builder(): AddDepositAddressV1ReqBuilder {
        return new AddDepositAddressV1ReqBuilder();
    }

    /**
     * Creates a new instance of the `AddDepositAddressV1Req` class with the given data.
     */
    static create(data: {
        /**
         * currency
         */
        currency?: string;
        /**
         * The chainId of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency.
         */
        chain?: string;
    }): AddDepositAddressV1Req {
        let obj = new AddDepositAddressV1Req();
        obj.currency = data.currency;
        obj.chain = data.chain;
        return obj;
    }

    fromJson(input: string): AddDepositAddressV1Req {
        const jsonObject = JSON.parse(input);
        return plainToInstance(AddDepositAddressV1Req, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): AddDepositAddressV1Req {
        return plainToInstance(AddDepositAddressV1Req, jsonObject);
    }
}

export class AddDepositAddressV1ReqBuilder {
    obj: AddDepositAddressV1Req = new AddDepositAddressV1Req();
    /**
     * currency
     */
    setCurrency(value: string): AddDepositAddressV1ReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * The chainId of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    setChain(value: string): AddDepositAddressV1ReqBuilder {
        this.obj.chain = value;
        return this;
    }

    build(): AddDepositAddressV1Req {
        return this.obj;
    }
}