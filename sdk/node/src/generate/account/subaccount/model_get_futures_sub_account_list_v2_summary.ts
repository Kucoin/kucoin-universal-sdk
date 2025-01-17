// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetFuturesSubAccountListV2Summary
    implements Serializable<GetFuturesSubAccountListV2Summary>
{
    /**
     * Total Account Equity
     */
    accountEquityTotal?: number;
    /**
     * Total unrealisedPNL
     */
    unrealisedPNLTotal?: number;
    /**
     * Total Margin Balance
     */
    marginBalanceTotal?: number;
    /**
     * Total Position margin
     */
    positionMarginTotal?: number;
    /**
     *
     */
    orderMarginTotal?: number;
    /**
     * Total frozen funds for withdrawal and out-transfer
     */
    frozenFundsTotal?: number;
    /**
     * total available balance
     */
    availableBalanceTotal?: number;
    /**
     *
     */
    currency?: string;

    fromJson(input: string): GetFuturesSubAccountListV2Summary {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetFuturesSubAccountListV2Summary, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetFuturesSubAccountListV2Summary {
        return plainToInstance(GetFuturesSubAccountListV2Summary, jsonObject);
    }
}