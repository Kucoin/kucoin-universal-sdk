package spot_test

import (
	"context"
	"encoding/json"
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/extension/interceptor"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"os"
	"testing"
)

var orderApi order.OrderAPI

func init() {
	key := os.Getenv("API_KEY")
	secret := os.Getenv("API_SECRET")
	passphrase := os.Getenv("API_PASSPHRASE")

	defaultLogger := logger.NewDefaultLogger()
	logger.SetLogger(defaultLogger)

	httpOptionBuilder := types.NewTransportOptionBuilder().
		SetKeepAlive(true).
		AddInterceptors(interceptor.NewLoggingInterceptor(false, defaultLogger))

	option := types.NewClientOptionBuilder().
		WithKey(key).
		WithSecret(secret).
		WithPassphrase(passphrase).
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithTransportOption(httpOptionBuilder.Build()).
		Build()

	client := api.NewClient(option)

	orderApi = client.RestService().GetSpotService().GetOrderAPI()
}

func TestOrderGetTradeHistoryOldReq(t *testing.T) {
	// GetTradeHistoryOld
	// Get Trade History - Old
	// /api/v1/fills

	builder := order.NewGetTradeHistoryOldReqBuilder()
	builder.SetSymbol("DOGE-USDT").SetSide("buy").SetType("limit").SetTradeType("TRADE").
		SetStartAt(1733068800000).SetEndAt(1733155200000)
	req := builder.Build()

	resp, err := orderApi.GetTradeHistoryOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetTradeHistoryReq(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v1/hf/fills

	builder := order.NewGetTradeHistoryReqBuilder()
	builder.SetSymbol("DOGE-USDT").SetSide("buy")
	req := builder.Build()

	resp, err := orderApi.GetTradeHistory(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetOpenOrdersReq(t *testing.T) {
	// GetOpenOrders
	// Get Open Orders
	// /api/v1/hf/orders/active

	builder := order.NewGetOpenOrdersReqBuilder()
	builder.SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.GetOpenOrders(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetSymbolsWithOpenOrderReq(t *testing.T) {
	// GetSymbolsWithOpenOrder
	// Get Symbols With Open Order
	// /api/v1/hf/orders/active/symbols

	resp, err := orderApi.GetSymbolsWithOpenOrder(context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderModifyOrderReq(t *testing.T) {
	// ModifyOrder
	// Modify Order
	// /api/v1/hf/orders/alter

	builder := order.NewModifyOrderReqBuilder()
	builder.SetClientOid("fd6b206b-a150-4b41-9941-1d6ec86f3b47").SetSymbol("BTC-USDT").
		SetOrderId("67404795f1bf40000709c5a2").SetNewPrice("100").SetNewSize("0.1")
	req := builder.Build()

	resp, err := orderApi.ModifyOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelAllOrdersReq(t *testing.T) {
	// CancelAllOrders
	// Cancel All Orders
	// /api/v1/hf/orders/cancelAll

	resp, err := orderApi.CancelAllOrders(context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelPartialOrderReq(t *testing.T) {
	// CancelPartialOrder
	// Cancel Partial Order
	// /api/v1/hf/orders/cancel/{orderId}

	builder := order.NewCancelPartialOrderReqBuilder()
	builder.SetOrderId("674049dcc5ba740007098c67").SetSymbol("BTC-USDT").SetCancelSize("0.05")
	req := builder.Build()

	resp, err := orderApi.CancelPartialOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelOrderByClientOidReq(t *testing.T) {
	// CancelOrderByClientOid
	// Cancel Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	builder := order.NewCancelOrderByClientOidReqBuilder()
	builder.SetClientOid("37776e54-6436-42fd-8d69-52ea3970f843").SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.CancelOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetOrderByClientOidReq(t *testing.T) {
	// GetOrderByClientOid
	// Get Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	builder := order.NewGetOrderByClientOidReqBuilder()
	builder.SetSymbol("BTC-USDT").SetClientOid("e6a9e64c-f8b6-47f1-80ea-be2ce6b8b0a2")
	req := builder.Build()

	resp, err := orderApi.GetOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderSetDCPReq(t *testing.T) {
	// SetDCP
	// Set DCP
	// /api/v1/hf/orders/dead-cancel-all

	builder := order.NewSetDCPReqBuilder()
	builder.SetTimeout(5.0).SetSymbols("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.SetDCP(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetDCPReq(t *testing.T) {
	// GetDCP
	// Get DCP
	// /api/v1/hf/orders/dead-cancel-all/query

	resp, err := orderApi.GetDCP(context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelAllOrdersBySymbolReq(t *testing.T) {
	// CancelAllOrdersBySymbol
	// Cancel All Orders By Symbol
	// /api/v1/hf/orders

	builder := order.NewCancelAllOrdersBySymbolReqBuilder()
	builder.SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.CancelAllOrdersBySymbol(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetOpenOrdersByPageReq(t *testing.T) {
	// GetOpenOrdersByPage
	// Get Open Orders By Page
	// /api/v1/hf/orders/active/page

	builder := order.NewGetOpenOrdersByPageReqBuilder()
	builder.SetSymbol("BTC-USDT").SetPageNum(1).SetPageSize(50)
	req := builder.Build()

	resp, err := orderApi.GetOpenOrdersByPage(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetClosedOrdersReq(t *testing.T) {
	// GetClosedOrders
	// Get Closed Orders
	// /api/v1/hf/orders/done

	builder := order.NewGetClosedOrdersReqBuilder()
	builder.SetSymbol("BTC-USDT").SetSide("buy").SetType("limit")
	req := builder.Build()

	resp, err := orderApi.GetClosedOrders(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchAddOrdersReq(t *testing.T) {
	// BatchAddOrders
	// Batch Add Orders
	// /api/v1/hf/orders/multi

	order1 := order.NewBatchAddOrdersOrderListBuilder().SetType("limit").SetSymbol("BTC-USDT").
		SetRemark("sdk_test").SetType("limit").SetPrice("50").SetSize("0.1").SetSide("buy").Build()
	order2 := order.NewBatchAddOrdersOrderListBuilder().SetType("limit").SetSymbol("BTC-USDT").
		SetRemark("sdk_test").SetType("limit").SetPrice("50").SetSize("0.1").SetSide("buy").Build()

	builder := order.NewBatchAddOrdersReqBuilder()
	builder.SetOrderList([]order.BatchAddOrdersOrderList{*order1, *order2})
	req := builder.Build()

	resp, err := orderApi.BatchAddOrders(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchAddOrdersSyncReq(t *testing.T) {
	// BatchAddOrdersSync
	// Batch Add Orders Sync
	// /api/v1/hf/orders/multi/sync
	order1 := order.NewBatchAddOrdersSyncOrderListBuilder().SetType("limit").SetSymbol("BTC-USDT").
		SetRemark("sdk_test").SetType("limit").SetPrice("50").SetSize("0.1").SetSide("buy").Build()
	order2 := order.NewBatchAddOrdersSyncOrderListBuilder().SetType("limit").SetSymbol("BTC-USDT").
		SetRemark("sdk_test").SetType("limit").SetPrice("50").SetSize("0.1").SetSide("buy").Build()
	builder := order.NewBatchAddOrdersSyncReqBuilder()
	builder.SetOrderList([]order.BatchAddOrdersSyncOrderList{*order1, *order2})
	req := builder.Build()

	resp, err := orderApi.BatchAddOrdersSync(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelOrderByOrderIdReq(t *testing.T) {
	// CancelOrderByOrderId
	// Cancel Order By OrderId
	// /api/v1/hf/orders/{orderId}

	builder := order.NewCancelOrderByOrderIdReqBuilder()
	builder.SetOrderId("67d8dbb38c961a0007628179").SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.CancelOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetOrderByOrderIdReq(t *testing.T) {
	// GetOrderByOrderId
	// Get Order By OrderId
	// /api/v1/hf/orders/{orderId}

	builder := order.NewGetOrderByOrderIdReqBuilder()
	builder.SetSymbol("BTC-USDT").SetOrderId("67d8dbb38c961a0007628179")
	req := builder.Build()

	resp, err := orderApi.GetOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderAddOrderReq(t *testing.T) {
	// AddOrder
	// Add Order
	// /api/v1/hf/orders

	builder := order.NewAddOrderReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").SetType("limit").
		SetRemark("sdk_test").SetPrice("100").SetSize("0.1")
	req := builder.Build()

	resp, err := orderApi.AddOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelOrderByClientOidSyncReq(t *testing.T) {
	// CancelOrderByClientOidSync
	// Cancel Order By ClientOid Sync
	// /api/v1/hf/orders/sync/client-order/{clientOid}

	builder := order.NewCancelOrderByClientOidSyncReqBuilder()
	builder.SetClientOid("0977165e-05e1-4d65-9d8c-c0ef35331de7").SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.CancelOrderByClientOidSync(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelOrderByOrderIdSyncReq(t *testing.T) {
	// CancelOrderByOrderIdSync
	// Cancel Order By OrderId Sync
	// /api/v1/hf/orders/sync/{orderId}

	builder := order.NewCancelOrderByOrderIdSyncReqBuilder()
	builder.SetOrderId("67404d4f67cdc90007dee92f").SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.CancelOrderByOrderIdSync(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderAddOrderSyncReq(t *testing.T) {
	// AddOrderSync
	// Add Order Sync
	// /api/v1/hf/orders/sync

	builder := order.NewAddOrderSyncReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1")
	req := builder.Build()

	resp, err := orderApi.AddOrderSync(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderAddOrderTestReq(t *testing.T) {
	// AddOrderTest
	// Add Order Test
	// /api/v1/hf/orders/test

	builder := order.NewAddOrderTestReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").SetType("limit").
		SetRemark("sdk_test").SetPrice("100").SetSize("0.1")
	req := builder.Build()

	resp, err := orderApi.AddOrderTest(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetRecentTradeHistoryOldReq(t *testing.T) {
	// GetRecentTradeHistoryOld
	// Get Recent Trade History - Old
	// /api/v1/limit/fills
	resp, err := orderApi.GetRecentTradeHistoryOld(context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetRecentOrdersListOldReq(t *testing.T) {
	// GetRecentOrdersListOld
	// Get Recent Orders List - Old
	// /api/v1/limit/orders
	resp, err := orderApi.GetRecentOrdersListOld(context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

// TODO rate limit
func TestOrderCancelOrderByClientOidOldReq(t *testing.T) {
	// CancelOrderByClientOidOld
	// Cancel Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	builder := order.NewCancelOrderByClientOidOldReqBuilder()
	builder.SetClientOid("5d1962d9-5010-4d59-8872-75264c86c95e")
	req := builder.Build()

	resp, err := orderApi.CancelOrderByClientOidOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOrderByClientOidOldReq(t *testing.T) {
	// GetOrderByClientOidOld
	// Get Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	builder := order.NewGetOrderByClientOidOldReqBuilder()
	builder.SetClientOid("674d80d664640c00078351c0")
	req := builder.Build()

	resp, err := orderApi.GetOrderByClientOidOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchCancelOrderOldReq(t *testing.T) {
	// BatchCancelOrderOld
	// Batch Cancel Order - Old
	// /api/v1/orders

	builder := order.NewBatchCancelOrderOldReqBuilder()
	builder.SetSymbol("BTC-USDT").SetTradeType("TRADE")
	req := builder.Build()

	resp, err := orderApi.BatchCancelOrderOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOrdersListOldReq(t *testing.T) {
	// GetOrdersListOld
	// Get Orders List - Old
	// /api/v1/orders

	builder := order.NewGetOrdersListOldReqBuilder()
	builder.SetSymbol("DOGE-USDT").SetStatus("done").
		SetSide("buy").SetType("limit").SetTradeType("TRADE").
		SetStartAt(1733068800000).SetEndAt(1733155200000)
	req := builder.Build()

	resp, err := orderApi.GetOrdersListOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchAddOrdersOldReq(t *testing.T) {
	// BatchAddOrdersOld
	// Batch Add Orders - Old
	// /api/v1/orders/multi
	order1 := order.NewBatchAddOrdersOldOrderListBuilder().SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1").Build()
	order2 := order.NewBatchAddOrdersOldOrderListBuilder().SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1").Build()

	builder := order.NewBatchAddOrdersOldReqBuilder()
	req := builder.SetOrderList([]order.BatchAddOrdersOldOrderList{*order1, *order2}).SetSymbol("BTC-USDT").Build()

	v, _ := json.Marshal(req)
	fmt.Println(string(v))

	resp, err := orderApi.BatchAddOrdersOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelOrderByOrderIdOldReq(t *testing.T) {
	// CancelOrderByOrderIdOld
	// Cancel Order By OrderId - Old
	// /api/v1/orders/{orderId}

	builder := order.NewCancelOrderByOrderIdOldReqBuilder()
	builder.SetOrderId("674e6ed5725fc60007502ef0")

	req := builder.Build()

	resp, err := orderApi.CancelOrderByOrderIdOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOrderByOrderIdOldReq(t *testing.T) {
	// GetOrderByOrderIdOld
	// Get Order By OrderId - Old
	// /api/v1/orders/{orderId}

	builder := order.NewGetOrderByOrderIdOldReqBuilder()
	builder.SetOrderId("674e6cbfe21c740007ccb253")
	req := builder.Build()

	resp, err := orderApi.GetOrderByOrderIdOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderAddOrderOldReq(t *testing.T) {
	// AddOrderOld
	// Add Order - Old
	// /api/v1/orders

	builder := order.NewAddOrderOldReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1")
	req := builder.Build()

	resp, err := orderApi.AddOrderOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderAddOrderTestOldReq(t *testing.T) {
	// AddOrderTestOld
	// Add Order Test - Old
	// /api/v1/orders/test

	builder := order.NewAddOrderTestOldReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1")
	req := builder.Build()

	resp, err := orderApi.AddOrderTestOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchCancelStopOrderReq(t *testing.T) {
	// BatchCancelStopOrder
	// Batch Cancel Stop Orders
	// /api/v1/stop-order/cancel

	builder := order.NewBatchCancelStopOrderReqBuilder()
	builder.SetSymbol("BTC-USDT").SetTradeType("TRADE").SetOrderIds("674e7ab5812d4000078520eb,674e7ab5b487ed0007a3e297")
	req := builder.Build()

	resp, err := orderApi.BatchCancelStopOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelStopOrderByClientOidReq(t *testing.T) {
	// CancelStopOrderByClientOid
	// Cancel Stop Order By ClientOid
	// /api/v1/stop-order/cancelOrderByClientOid

	builder := order.NewCancelStopOrderByClientOidReqBuilder()
	builder.SetSymbol("BTC-USDT").SetClientOid("c455af40-3136-45de-a30b-49ea7db1ff37")
	req := builder.Build()

	resp, err := orderApi.CancelStopOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetStopOrdersListReq(t *testing.T) {
	// GetStopOrdersList
	// Get Stop Orders List
	// /api/v1/stop-order

	builder := order.NewGetStopOrdersListReqBuilder()
	builder.SetSymbol("BTC-USDT").SetSide("buy")
	req := builder.Build()

	resp, err := orderApi.GetStopOrdersList(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelStopOrderByOrderIdReq(t *testing.T) {
	// CancelStopOrderByOrderId
	// Cancel Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	builder := order.NewCancelStopOrderByOrderIdReqBuilder()
	builder.SetOrderId("vs93gpqedv5rr8pm003rmlp5")
	req := builder.Build()

	resp, err := orderApi.CancelStopOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetStopOrderByOrderIdReq(t *testing.T) {
	// GetStopOrderByOrderId
	// Get Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	builder := order.NewGetStopOrderByOrderIdReqBuilder()
	builder.SetOrderId("vs93gpqeehb39p83003toeiv")
	req := builder.Build()

	resp, err := orderApi.GetStopOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderAddStopOrderReq(t *testing.T) {
	// AddStopOrder
	// Add Stop Order
	// /api/v1/stop-order

	builder := order.NewAddStopOrderReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").SetSymbol("BTC-USDT").
		SetType("limit").SetRemark("sdk_test").SetPrice("100").SetSize("0.1").SetStopPrice("8000")
	req := builder.Build()

	resp, err := orderApi.AddStopOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetStopOrderByClientOidReq(t *testing.T) {
	// GetStopOrderByClientOid
	// Get Stop Order By ClientOid
	// /api/v1/stop-order/queryOrderByClientOid

	builder := order.NewGetStopOrderByClientOidReqBuilder()
	builder.SetClientOid("c455af40-3136-45de-a30b-49ea7db1ff37")
	req := builder.Build()

	resp, err := orderApi.GetStopOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderCancelOcoOrderByClientOidReq(t *testing.T) {
	// CancelOcoOrderByClientOid
	// Cancel OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	builder := order.NewCancelOcoOrderByClientOidReqBuilder()
	builder.SetClientOid("93bc608d-ffda-42b1-abd7-1b15ca1bf9e3")
	req := builder.Build()

	resp, err := orderApi.CancelOcoOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOcoOrderByClientOidReq(t *testing.T) {
	// GetOcoOrderByClientOid
	// Get OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	builder := order.NewGetOcoOrderByClientOidReqBuilder()
	builder.SetClientOid("5d568639-444f-43c1-a5ea-65f2cd6ef734")
	req := builder.Build()

	resp, err := orderApi.GetOcoOrderByClientOid(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOcoOrderDetailByOrderIdReq(t *testing.T) {
	// GetOcoOrderDetailByOrderId
	// Get OCO Order Detail By OrderId
	// /api/v3/oco/order/details/{orderId}

	builder := order.NewGetOcoOrderDetailByOrderIdReqBuilder()
	builder.SetOrderId("674ea71f688dea0007c81db5")
	req := builder.Build()

	resp, err := orderApi.GetOcoOrderDetailByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderCancelOcoOrderByOrderIdReq(t *testing.T) {
	// CancelOcoOrderByOrderId
	// Cancel OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	builder := order.NewCancelOcoOrderByOrderIdReqBuilder()
	builder.SetOrderId("674ea71f688dea0007c81db5")
	req := builder.Build()

	resp, err := orderApi.CancelOcoOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderGetOcoOrderByOrderIdReq(t *testing.T) {
	// GetOcoOrderByOrderId
	// Get OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	builder := order.NewGetOcoOrderByOrderIdReqBuilder()
	builder.SetOrderId("674ea7a534e5030007dc4199")
	req := builder.Build()

	resp, err := orderApi.GetOcoOrderByOrderId(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
func TestOrderAddOcoOrderReq(t *testing.T) {
	// AddOcoOrder
	// Add OCO Order
	// /api/v3/oco/order

	builder := order.NewAddOcoOrderReqBuilder()
	builder.SetClientOid(uuid.NewString()).SetSide("buy").
		SetSymbol("BTC-USDT").SetRemark("sdk_test").
		SetPrice("94000").SetSize("0.001").SetStopPrice("98000").SetLimitPrice("96000").
		SetTradeType("TRADE")
	req := builder.Build()

	resp, err := orderApi.AddOcoOrder(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderBatchCancelOcoOrdersReq(t *testing.T) {
	// BatchCancelOcoOrders
	// Batch Cancel OCO Order
	// /api/v3/oco/orders

	builder := order.NewBatchCancelOcoOrdersReqBuilder()
	builder.SetOrderIds("674ea64072cf2800072f3aeb").SetSymbol("BTC-USDT")
	req := builder.Build()

	resp, err := orderApi.BatchCancelOcoOrders(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestOrderGetOcoOrderListReq(t *testing.T) {
	// GetOcoOrderList
	// Get OCO Order List
	// /api/v3/oco/orders

	builder := order.NewGetOcoOrderListReqBuilder()
	builder.SetSymbol("BTC-USDT").SetOrderIds("674ea64072cf2800072f3aeb")
	req := builder.Build()

	resp, err := orderApi.GetOcoOrderList(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
