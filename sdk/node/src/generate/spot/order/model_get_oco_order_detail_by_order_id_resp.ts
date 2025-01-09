// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { GetOcoOrderDetailByOrderIdOrders } from './model_get_oco_order_detail_by_order_id_orders';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/response';

export class GetOcoOrderDetailByOrderIdResp
    implements Response<GetOcoOrderDetailByOrderIdResp, RestResponse>
{
    /**
     * The unique order id generated by the trading system,which can be used later for further actions such as canceling the order.
     */
    orderId?: string;
    /**
     * symbol
     */
    symbol?: string;
    /**
     * Client Order Id
     */
    clientOid?: string;
    /**
     * Order placement time, milliseconds
     */
    orderTime?: number;
    /**
     * Order status: NEW: New, DONE: Completed, TRIGGERED: Triggered, CANCELLED: Cancelled
     */
    status?: string;
    /**
     *
     */
    @Type(() => GetOcoOrderDetailByOrderIdOrders)
    orders?: Array<GetOcoOrderDetailByOrderIdOrders>;

    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    fromJson(input: string): GetOcoOrderDetailByOrderIdResp {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetOcoOrderDetailByOrderIdResp, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetOcoOrderDetailByOrderIdResp {
        return plainToInstance(GetOcoOrderDetailByOrderIdResp, jsonObject);
    }
}