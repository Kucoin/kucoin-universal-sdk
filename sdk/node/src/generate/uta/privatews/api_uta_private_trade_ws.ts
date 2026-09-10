import {
    UtaPrivateTradeWsService,
    UtaTradeWsResponse,
} from '@internal/infra/uta_private_trade_ws_service';
import {
    AmendOrderReq,
    CancelOrderReq,
    OrderModifyApiResponse,
    PlaceOrderReq,
} from '../order/api_order';

export type UtaPlaceOrderWsResponse = UtaTradeWsResponse<OrderModifyApiResponse>;
export type UtaCancelOrderWsResponse = UtaTradeWsResponse<OrderModifyApiResponse>;
export type UtaAmendOrderWsResponse = UtaTradeWsResponse<OrderModifyApiResponse>;

/** Direct UTA WebSocket trade API. Requests can create, cancel, or amend real orders. */
export interface UtaPrivateTradeWS {
    start(): Promise<void>;
    placeOrder(request: PlaceOrderReq): Promise<UtaPlaceOrderWsResponse>;
    cancelOrder(request: CancelOrderReq): Promise<UtaCancelOrderWsResponse>;
    amendOrder(request: AmendOrderReq): Promise<UtaAmendOrderWsResponse>;
    stop(): Promise<void>;
}

export class UtaPrivateTradeWSImpl implements UtaPrivateTradeWS {
    constructor(private readonly wsService: UtaPrivateTradeWsService) {}

    start(): Promise<void> {
        return this.wsService.start();
    }

    placeOrder(request: PlaceOrderReq): Promise<UtaPlaceOrderWsResponse> {
        return this.wsService.placeOrder(request) as Promise<UtaPlaceOrderWsResponse>;
    }

    cancelOrder(request: CancelOrderReq): Promise<UtaCancelOrderWsResponse> {
        return this.wsService.cancelOrder(request) as Promise<UtaCancelOrderWsResponse>;
    }

    amendOrder(request: AmendOrderReq): Promise<UtaAmendOrderWsResponse> {
        return this.wsService.amendOrder(request) as Promise<UtaAmendOrderWsResponse>;
    }

    stop(): Promise<void> {
        return this.wsService.stop();
    }
}
