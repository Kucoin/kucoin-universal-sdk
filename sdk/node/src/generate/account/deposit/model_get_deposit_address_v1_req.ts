// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetDepositAddressV1Req implements Serializable<GetDepositAddressV1Req> {
    /**
     * currency
     */
    currency?: string;
    /**
     * The chainId of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    chain?: string = 'eth';

    /**
     * Creates a new instance of the `GetDepositAddressV1Req` class.
     * The builder pattern allows step-by-step construction of a `GetDepositAddressV1Req` object.
     */
    static builder(): GetDepositAddressV1ReqBuilder {
        return new GetDepositAddressV1ReqBuilder();
    }

    /**
     * Creates a new instance of the `GetDepositAddressV1Req` class with the given data.
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
    }): GetDepositAddressV1Req {
        let obj = new GetDepositAddressV1Req();
        obj.currency = data.currency;
        obj.chain = data.chain;
        return obj;
    }

    fromJson(input: string): GetDepositAddressV1Req {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetDepositAddressV1Req, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetDepositAddressV1Req {
        return plainToInstance(GetDepositAddressV1Req, jsonObject);
    }
}

export class GetDepositAddressV1ReqBuilder {
    obj: GetDepositAddressV1Req = new GetDepositAddressV1Req();
    /**
     * currency
     */
    setCurrency(value: string): GetDepositAddressV1ReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * The chainId of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency.
     */
    setChain(value: string): GetDepositAddressV1ReqBuilder {
        this.obj.chain = value;
        return this;
    }

    build(): GetDepositAddressV1Req {
        return this.obj;
    }
}