// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package order

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type OrderAPI interface {
	BatchCancelOrdersBySymbol(req *BatchCancelOrdersBySymbolReq, ctx context.Context) (*BatchCancelOrdersBySymbolResp, error)
	BatchCancelOrdersById(req *BatchCancelOrdersByIdReq, ctx context.Context) (*BatchCancelOrdersByIdResp, error)
	CancelOrder(req *CancelOrderReq, ctx context.Context) (*CancelOrderResp, error)
	GetOrderDetails(req *GetOrderDetailsReq, ctx context.Context) (*GetOrderDetailsResp, error)
	GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error)
	GetOrderHistory(req *GetOrderHistoryReq, ctx context.Context) (*GetOrderHistoryResp, error)
	GetOpenOrderList(req *GetOpenOrderListReq, ctx context.Context) (*GetOpenOrderListResp, error)
	PlaceOrder(req *PlaceOrderReq, ctx context.Context) (*PlaceOrderResp, error)
	AmendOrder(req *AmendOrderReq, ctx context.Context) (*AmendOrderResp, error)
}

type OrderAPIImpl struct {
	transport interfaces.Transport
}

func NewOrderAPIImp(transport interfaces.Transport) *OrderAPIImpl {
	return &OrderAPIImpl{transport: transport}
}

func (impl *OrderAPIImpl) BatchCancelOrdersBySymbol(req *BatchCancelOrdersBySymbolReq, ctx context.Context) (*BatchCancelOrdersBySymbolResp, error) {
	resp := &BatchCancelOrdersBySymbolResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/order/cancel-all", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) BatchCancelOrdersById(req *BatchCancelOrdersByIdReq, ctx context.Context) (*BatchCancelOrdersByIdResp, error) {
	resp := &BatchCancelOrdersByIdResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/order/cancel-batch", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) CancelOrder(req *CancelOrderReq, ctx context.Context) (*CancelOrderResp, error) {
	resp := &CancelOrderResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/order/cancel", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOrderDetails(req *GetOrderDetailsReq, ctx context.Context) (*GetOrderDetailsResp, error) {
	resp := &GetOrderDetailsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/order/detail", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error) {
	resp := &GetTradeHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/order/execution", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOrderHistory(req *GetOrderHistoryReq, ctx context.Context) (*GetOrderHistoryResp, error) {
	resp := &GetOrderHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/order/history", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) GetOpenOrderList(req *GetOpenOrderListReq, ctx context.Context) (*GetOpenOrderListResp, error) {
	resp := &GetOpenOrderListResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/order/open-list", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) PlaceOrder(req *PlaceOrderReq, ctx context.Context) (*PlaceOrderResp, error) {
	resp := &PlaceOrderResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/order/place", req, resp, false)
	return resp, err
}

func (impl *OrderAPIImpl) AmendOrder(req *AmendOrderReq, ctx context.Context) (*AmendOrderResp, error) {
	resp := &AmendOrderResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/order/amend", req, resp, false)
	return resp, err
}
