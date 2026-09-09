import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type UtaFlexibleNumber = string | number;

export interface PlaceOrderReq extends UtaRequestData {
    tradeType?: string;
    clientOid?: string;
    symbol?: string;
    triggerDirection?: string;
    triggerPriceType?: string;
    triggerPrice?: string;
    side?: string;
    orderType?: string;
    size?: string;
    sizeUnit?: string;
    price?: string;
    timeInForce?: string;
    postOnly?: boolean;
    reduceOnly?: boolean;
    stp?: string;
    tags?: string;
    cancelAfter?: number;
    positionSide?: string;
    marginMode?: string;
    tpTriggerPriceType?: string;
    tpTriggerPrice?: string;
    slTriggerPriceType?: string;
    slTriggerPrice?: string;
    closeOrder?: boolean;
}

export interface CancelOrderReq extends UtaRequestData {
    tradeType?: string;
    symbol?: string;
    orderId?: string;
    clientOid?: string;
}

export interface AmendOrderReq extends UtaRequestData {
    tradeType?: string;
    symbol?: string;
    orderId?: string;
    clientOid?: string;
    newPrice?: string;
    newSize?: string;
    price?: string;
    size?: string;
    tpTriggerPriceType?: string;
    tpTriggerPrice?: string;
    slTriggerPriceType?: string;
    slTriggerPrice?: string;
}

export type BatchCancelOrdersBySymbolReq = UtaRequestData;
export type BatchCancelOrdersByIdReq = UtaRequestData;
export type GetOrderDetailsReq = UtaRequestData;
export type GetTradeHistoryReq = UtaRequestData;
export type GetOrderHistoryReq = UtaRequestData;
export type GetOpenOrderListReq = UtaRequestData;

export interface OrderModifyApiResponse extends UtaRecord {
    orderId?: string;
    clientOid?: string;
    tradeType?: string;
    ts?: UtaFlexibleNumber;
}

export interface GetOrderHistoryItem extends UtaRecord {
    orderId?: string;
    clientOid?: string;
    symbol?: string;
    tradeType?: string;
    status?: UtaFlexibleNumber;
    side?: string;
    orderType?: string;
}

export type BatchCancelOrdersBySymbolResp = UtaRestResponse<OrderModifyApiResponse | OrderModifyApiResponse[]>;
export type BatchCancelOrdersByIdResp = UtaRestResponse<OrderModifyApiResponse | OrderModifyApiResponse[]>;
export type CancelOrderResp = UtaRestResponse<OrderModifyApiResponse>;
export type GetOrderDetailsResp = UtaRestResponse<UtaRecord>;
export type GetTradeHistoryResp = UtaRestResponse<UtaRecord | GetOrderHistoryItem[]>;
export type GetOrderHistoryResp = UtaRestResponse<{
    items?: GetOrderHistoryItem[];
    currentPage?: UtaFlexibleNumber;
    pageSize?: UtaFlexibleNumber;
    totalNum?: UtaFlexibleNumber;
    totalPage?: UtaFlexibleNumber;
}>;
export type GetOpenOrderListResp = UtaRestResponse<UtaRecord | GetOrderHistoryItem[]>;
export type PlaceOrderResp = UtaRestResponse<OrderModifyApiResponse>;
export type AmendOrderResp = UtaRestResponse<OrderModifyApiResponse>;

/** UTA unified order REST APIs. */
export interface OrderAPI {
    batchCancelOrdersBySymbol(req: BatchCancelOrdersBySymbolReq): Promise<BatchCancelOrdersBySymbolResp>;
    batchCancelOrdersById(req: BatchCancelOrdersByIdReq): Promise<BatchCancelOrdersByIdResp>;
    cancelOrder(req: CancelOrderReq): Promise<CancelOrderResp>;
    getOrderDetails(req: GetOrderDetailsReq): Promise<GetOrderDetailsResp>;
    getTradeHistory(req: GetTradeHistoryReq): Promise<GetTradeHistoryResp>;
    getOrderHistory(req: GetOrderHistoryReq): Promise<GetOrderHistoryResp>;
    getOpenOrderList(req: GetOpenOrderListReq): Promise<GetOpenOrderListResp>;
    placeOrder(req: PlaceOrderReq): Promise<PlaceOrderResp>;
    amendOrder(req: AmendOrderReq): Promise<AmendOrderResp>;
}

export class OrderAPIImpl extends UtaApiBase implements OrderAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    batchCancelOrdersBySymbol(req: BatchCancelOrdersBySymbolReq) { return this.call('POST', '/api/ua/v2/unified/order/cancel-all', req); }
    batchCancelOrdersById(req: BatchCancelOrdersByIdReq) { return this.call('POST', '/api/ua/v2/unified/order/cancel-batch', req); }
    cancelOrder(req: CancelOrderReq) { return this.call('POST', '/api/ua/v2/unified/order/cancel', req); }
    getOrderDetails(req: GetOrderDetailsReq) { return this.call('GET', '/api/ua/v2/unified/order/detail', req); }
    getTradeHistory(req: GetTradeHistoryReq) { return this.call('GET', '/api/ua/v2/unified/order/execution', req); }
    getOrderHistory(req: GetOrderHistoryReq) { return this.call('GET', '/api/ua/v2/unified/order/history', req); }
    getOpenOrderList(req: GetOpenOrderListReq) { return this.call('GET', '/api/ua/v2/unified/order/open-list', req); }
    placeOrder(req: PlaceOrderReq) { return this.call('POST', '/api/ua/v2/unified/order/place', req); }
    amendOrder(req: AmendOrderReq) { return this.call('POST', '/api/ua/v2/unified/order/amend', req); }
}
