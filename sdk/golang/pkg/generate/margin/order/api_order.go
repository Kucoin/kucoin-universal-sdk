// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type OrderAPI interface {

	// AddOrder Add Order
	// Description: Place order in the Cross-margin or Isolated-margin trading system. You can place two major types of order: Limit and market. Orders can only be placed if your account has sufficient funds. Once an order is placed, your funds will be put on hold for the duration of the order. The amount of funds on hold depends on the order type and parameters specified.
	// Documentation: https://www.kucoin.com/docs-new/api-3470204
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 2       |
	// +-----------------------+---------+
	AddOrder(req *AddOrderReq, ctx context.Context) (*AddOrderResp, error)

	// AddOrderTest Add Order Test
	// Description:  Order test endpoint: This endpoint’s request and return parameters are identical to the order endpoint, and can be used to verify whether the signature is correct, among other operations. After placing an order, the order will not enter the matching system, and the order cannot be queried.
	// Documentation: https://www.kucoin.com/docs-new/api-3470205
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 2       |
	// +-----------------------+---------+
	AddOrderTest(req *AddOrderTestReq, ctx context.Context) (*AddOrderTestResp, error)

	// CancelOrderByOrderId Cancel Order By OrderId
	// Description: This endpoint can be used to cancel a margin order by orderId. This endpoint only sends cancellation requests. The results of the requests must be obtained by checking the order status or subscribing to Websocket.
	// Documentation: https://www.kucoin.com/docs-new/api-3470195
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 2       |
	// +-----------------------+---------+
	CancelOrderByOrderId(req *CancelOrderByOrderIdReq, ctx context.Context) (*CancelOrderByOrderIdResp, error)

	// CancelOrderByClientOid Cancel Order By ClientOid
	// Description: This endpoint can be used to cancel a margin order by clientOid. This endpoint only sends cancellation requests. The results of the requests must be obtained by checking the order status or subscribing to Websocket.
	// Documentation: https://www.kucoin.com/docs-new/api-3470201
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 2       |
	// +-----------------------+---------+
	CancelOrderByClientOid(req *CancelOrderByClientOidReq, ctx context.Context) (*CancelOrderByClientOidResp, error)

	// CancelAllOrdersBySymbol Cancel All Orders By Symbol
	// Description: This interface can cancel all open Margin orders by symbol. This endpoint only sends cancellation requests. The results of the requests must be obtained by checking the order status or subscribing to Websocket.
	// Documentation: https://www.kucoin.com/docs-new/api-3470197
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	CancelAllOrdersBySymbol(req *CancelAllOrdersBySymbolReq, ctx context.Context) (*CancelAllOrdersBySymbolResp, error)

	// GetSymbolsWithOpenOrder Get Symbols With Open Order
	// Description: This interface can query all Margin symbols that have active orders.
	// Documentation: https://www.kucoin.com/docs-new/api-3470196
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 4       |
	// +-----------------------+---------+
	GetSymbolsWithOpenOrder(req *GetSymbolsWithOpenOrderReq, ctx context.Context) (*GetSymbolsWithOpenOrderResp, error)

	// GetOpenOrders Get Open Orders
	// Description: This interface is to obtain all Margin active order lists, and the return value of the active order interface is the paged data of all uncompleted order lists. The returned data is sorted in descending order according to the latest update time of the order.  After the user successfully places an order, the order is in the Active state, and the user can use inOrderBook to determine whether the order has entered the order. Canceled or fully filled orders are marked as completed Done status.
	// Documentation: https://www.kucoin.com/docs-new/api-3470198
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 4       |
	// +-----------------------+---------+
	GetOpenOrders(req *GetOpenOrdersReq, ctx context.Context) (*GetOpenOrdersResp, error)

	// GetClosedOrders Get Closed Orders
	// Description: This interface is to obtain all Margin closed order lists, and the return value of the active order interface is the paged data of all uncompleted order lists. The returned data is sorted in descending order according to the latest update time of the order.  After the user successfully places an order, the order is in the Active state, and the user can use inOrderBook to determine whether the order has entered the order. Canceled or fully filled orders are marked as completed Done status.
	// Documentation: https://www.kucoin.com/docs-new/api-3470199
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 10      |
	// +-----------------------+---------+
	GetClosedOrders(req *GetClosedOrdersReq, ctx context.Context) (*GetClosedOrdersResp, error)

	// GetTradeHistory Get Trade History
	// Description: This endpoint can be used to obtain a list of the latest Margin transaction details.  The returned data is sorted in descending order according to the latest update time of the order.
	// Documentation: https://www.kucoin.com/docs-new/api-3470200
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error)

	// GetOrderByOrderId Get Order By OrderId
	// Description: This endpoint can be used to obtain information for a single Margin order using the order ID.  After the user successfully places an order, the order is in the Active state, and the user can use inOrderBook to determine whether the order has entered the order. Canceled or fully filled orders are marked as completed Done status.
	// Documentation: https://www.kucoin.com/docs-new/api-3470202
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	GetOrderByOrderId(req *GetOrderByOrderIdReq, ctx context.Context) (*GetOrderByOrderIdResp, error)

	// GetOrderByClientOid Get Order By ClientOid
	// Description: This endpoint can be used to obtain information for a single Margin order using the client order ID.  After the user successfully places an order, the order is in the Active state, and the user can use inOrderBook to determine whether the order has entered the order. Canceled or fully filled orders are marked as completed Done status.
	// Documentation: https://www.kucoin.com/docs-new/api-3470203
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	GetOrderByClientOid(req *GetOrderByClientOidReq, ctx context.Context) (*GetOrderByClientOidResp, error)

	// AddOrderV1 Add Order - V1
	// Description: Place order in the Cross-margin or Isolated-margin trading system. You can place two major types of order: Limit and market. Orders can only be placed if your account has sufficient funds. Once an order is placed, your funds will be put on hold for the duration of the order. The amount of funds on hold depends on the order type and parameters specified.
	// Documentation: https://www.kucoin.com/docs-new/api-3470312
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	// Deprecated
	AddOrderV1(req *AddOrderV1Req, ctx context.Context) (*AddOrderV1Resp, error)

	// AddOrderTestV1 Add Order Test - V1
	// Description: Order test endpoint: This endpoint’s request and return parameters are identical to the order endpoint, and can be used to verify whether the signature is correct, among other operations. After placing an order, the order will not enter the matching system, and the order cannot be queried.
	// Documentation: https://www.kucoin.com/docs-new/api-3470313
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 5       |
	// +-----------------------+---------+
	// Deprecated
	AddOrderTestV1(req *AddOrderTestV1Req, ctx context.Context) (*AddOrderTestV1Resp, error)
}

type OrderAPIImpl struct {
	transport interfaces.Transport
}

func NewOrderAPIImp(transport interfaces.Transport) *OrderAPIImpl {
	return &OrderAPIImpl{transport: transport}
}

func (impl *OrderAPIImpl) AddOrder(req *AddOrderReq, ctx context.Context) (*AddOrderResp, error) {
	resp := &AddOrderResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/hf/margin/order", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) AddOrderTest(req *AddOrderTestReq, ctx context.Context) (*AddOrderTestResp, error) {
	resp := &AddOrderTestResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/hf/margin/order/test", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) CancelOrderByOrderId(req *CancelOrderByOrderIdReq, ctx context.Context) (*CancelOrderByOrderIdResp, error) {
	resp := &CancelOrderByOrderIdResp{}
	err := impl.transport.Call(ctx, "spot", false, "Delete", "/api/v3/hf/margin/orders/{orderId}", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) CancelOrderByClientOid(req *CancelOrderByClientOidReq, ctx context.Context) (*CancelOrderByClientOidResp, error) {
	resp := &CancelOrderByClientOidResp{}
	err := impl.transport.Call(ctx, "spot", false, "Delete", "/api/v3/hf/margin/orders/client-order/{clientOid}", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) CancelAllOrdersBySymbol(req *CancelAllOrdersBySymbolReq, ctx context.Context) (*CancelAllOrdersBySymbolResp, error) {
	resp := &CancelAllOrdersBySymbolResp{}
	err := impl.transport.Call(ctx, "spot", false, "Delete", "/api/v3/hf/margin/orders", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetSymbolsWithOpenOrder(req *GetSymbolsWithOpenOrderReq, ctx context.Context) (*GetSymbolsWithOpenOrderResp, error) {
	resp := &GetSymbolsWithOpenOrderResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/order/active/symbols", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOpenOrders(req *GetOpenOrdersReq, ctx context.Context) (*GetOpenOrdersResp, error) {
	resp := &GetOpenOrdersResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/orders/active", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetClosedOrders(req *GetClosedOrdersReq, ctx context.Context) (*GetClosedOrdersResp, error) {
	resp := &GetClosedOrdersResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/orders/done", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error) {
	resp := &GetTradeHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/fills", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOrderByOrderId(req *GetOrderByOrderIdReq, ctx context.Context) (*GetOrderByOrderIdResp, error) {
	resp := &GetOrderByOrderIdResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/orders/{orderId}", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOrderByClientOid(req *GetOrderByClientOidReq, ctx context.Context) (*GetOrderByClientOidResp, error) {
	resp := &GetOrderByClientOidResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/hf/margin/orders/client-order/{clientOid}", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) AddOrderV1(req *AddOrderV1Req, ctx context.Context) (*AddOrderV1Resp, error) {
	resp := &AddOrderV1Resp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v1/margin/order", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) AddOrderTestV1(req *AddOrderTestV1Req, ctx context.Context) (*AddOrderTestV1Resp, error) {
	resp := &AddOrderTestV1Resp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v1/margin/order/test", req, resp, false)
	return resp, err
}
