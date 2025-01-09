// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetStopOrderListItems implements Serializable<GetStopOrderListItems> {
    /**
     * Order ID
     */
    id?: string;
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     */
    symbol?: string;
    /**
     * Order type, market order or limit order
     */
    type?: string;
    /**
     * Transaction side
     */
    side?: string;
    /**
     * Order price
     */
    price?: string;
    /**
     * Order quantity
     */
    size?: number;
    /**
     * Order value
     */
    value?: string;
    /**
     * Executed size of funds
     */
    dealValue?: string;
    /**
     * Executed quantity
     */
    dealSize?: number;
    /**
     * self trade prevention
     */
    stp?: string;
    /**
     * Stop order type (stop limit or stop market)
     */
    stop?: string;
    /**
     * Trigger price type of stop orders
     */
    stopPriceType?: string;
    /**
     * Mark to show whether the stop order is triggered
     */
    stopTriggered?: boolean;
    /**
     * Trigger price of stop orders
     */
    stopPrice?: string;
    /**
     * Time in force policy type
     */
    timeInForce?: string;
    /**
     * Mark of post only
     */
    postOnly?: boolean;
    /**
     * Mark of the hidden order
     */
    hidden?: boolean;
    /**
     * Mark of the iceberg order
     */
    iceberg?: boolean;
    /**
     * Leverage of the order
     */
    leverage?: string;
    /**
     * A mark to forcely hold the funds for an order
     */
    forceHold?: boolean;
    /**
     * A mark to close the position
     */
    closeOrder?: boolean;
    /**
     * Visible size of the iceberg order
     */
    visibleSize?: number;
    /**
     * Unique order id created by users to identify their orders
     */
    clientOid?: string;
    /**
     * Remark of the order
     */
    remark?: string;
    /**
     * tag order source
     */
    tags?: string;
    /**
     * Mark of the active orders
     */
    isActive?: boolean;
    /**
     * Mark of the canceled orders
     */
    cancelExist?: boolean;
    /**
     * Time the order created
     */
    createdAt?: number;
    /**
     * last update time
     */
    updatedAt?: number;
    /**
     * End time
     */
    endAt?: number;
    /**
     * Order create time in nanosecond
     */
    orderTime?: number;
    /**
     * settlement currency
     */
    settleCurrency?: string;
    /**
     * Margin mode: ISOLATED (isolated), CROSS (cross margin).
     */
    marginMode?: string;
    /**
     * Average transaction price, forward contract average transaction price = sum (transaction value) / sum (transaction quantity), reverse contract average transaction price = sum (transaction quantity) / sum (transaction value). Transaction quantity = lots * multiplier
     */
    avgDealPrice?: string;
    /**
     * Value of the executed orders
     */
    filledSize?: number;
    /**
     * Executed order quantity
     */
    filledValue?: string;
    /**
     * order status: “open” or “done”
     */
    status?: string;
    /**
     * A mark to reduce the position size only
     */
    reduceOnly?: boolean;

    fromJson(input: string): GetStopOrderListItems {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetStopOrderListItems, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetStopOrderListItems {
        return plainToInstance(GetStopOrderListItems, jsonObject);
    }
}