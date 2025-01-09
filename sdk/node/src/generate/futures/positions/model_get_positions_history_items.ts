// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetPositionsHistoryItems implements Serializable<GetPositionsHistoryItems> {
    /**
     * Close ID
     */
    closeId?: string;
    /**
     * User ID
     */
    userId?: string;
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Currency used to settle trades
     */
    settleCurrency?: string;
    /**
     * Leverage applied to the order
     */
    leverage?: string;
    /**
     * Type of closure
     */
    type?: string;
    /**
     * Net profit and loss (after deducting fees and funding costs)
     */
    pnl?: string;
    /**
     * Accumulated realised gross profit value
     */
    realisedGrossCost?: string;
    /**
     * Accumulated realised profit withdrawn from the position
     */
    withdrawPnl?: string;
    /**
     * Accumulated trading fees
     */
    tradeFee?: string;
    /**
     * Accumulated funding fees
     */
    fundingFee?: string;
    /**
     * Time when the position was opened
     */
    openTime?: number;
    /**
     * Time when the position was closed (default sorted in descending order)
     */
    closeTime?: number;
    /**
     * Opening price of the position
     */
    openPrice?: string;
    /**
     * Closing price of the position
     */
    closePrice?: string;
    /**
     * Margin Mode: CROSS，ISOLATED
     */
    marginMode?: GetPositionsHistoryItems.MarginModeEnum;

    fromJson(input: string): GetPositionsHistoryItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetPositionsHistoryItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetPositionsHistoryItems {
        return plainToInstance(GetPositionsHistoryItems, jsonObject);
    }
}

export namespace GetPositionsHistoryItems {
    export enum MarginModeEnum {
        /**
         * cross margin
         */
        CROSS = <any>'CROSS',
        /**
         * isolated margin
         */
        ISOLATED = <any>'ISOLATED',
    }
}