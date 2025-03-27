package order

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestOrderAddOrderReqModel(t *testing.T) {
	// AddOrder
	// Add Order
	// /api/v1/hf/orders

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderRespModel(t *testing.T) {
	// AddOrder
	// Add Order
	// /api/v1/hf/orders

	data := "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderSyncReqModel(t *testing.T) {
	// AddOrderSync
	// Add Order Sync
	// /api/v1/hf/orders/sync

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}"
	req := &AddOrderSyncReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderSyncRespModel(t *testing.T) {
	// AddOrderSync
	// Add Order Sync
	// /api/v1/hf/orders/sync

	data := "{\"code\":\"200000\",\"data\":{\"orderId\":\"67111a7cb7cbdf000703e1f6\",\"clientOid\":\"5c52e11203aa677f33e493f\",\"orderTime\":1729174140586,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729174140588}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderSyncResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestReqModel(t *testing.T) {
	// AddOrderTest
	// Add Order Test
	// /api/v1/hf/orders/test

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}"
	req := &AddOrderTestReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestRespModel(t *testing.T) {
	// AddOrderTest
	// Add Order Test
	// /api/v1/hf/orders/test

	data := "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderTestResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersReqModel(t *testing.T) {
	// BatchAddOrders
	// Batch Add Orders
	// /api/v1/hf/orders/multi

	data := "{\"orderList\": [{\"clientOid\": \"client order id 12\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 13\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}"
	req := &BatchAddOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersRespModel(t *testing.T) {
	// BatchAddOrders
	// Batch Add Orders
	// /api/v1/hf/orders/multi

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"orderId\": \"6710d8336afcdb0007319c27\",\n            \"clientOid\": \"client order id 12\",\n            \"success\": true\n        },\n        {\n            \"success\": false,\n            \"failMsg\": \"The order funds should more then 0.1 USDT.\"\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchAddOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersSyncReqModel(t *testing.T) {
	// BatchAddOrdersSync
	// Batch Add Orders Sync
	// /api/v1/hf/orders/multi/sync

	data := "{\"orderList\": [{\"clientOid\": \"client order id 13\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 14\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}"
	req := &BatchAddOrdersSyncReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersSyncRespModel(t *testing.T) {
	// BatchAddOrdersSync
	// Batch Add Orders Sync
	// /api/v1/hf/orders/multi/sync

	data := "{\"code\":\"200000\",\"data\":[{\"orderId\":\"6711195e5584bc0007bd5aef\",\"clientOid\":\"client order id 13\",\"orderTime\":1729173854299,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729173854326,\"success\":true},{\"success\":false,\"failMsg\":\"The order funds should more then 0.1 USDT.\"}]}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchAddOrdersSyncResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdReqModel(t *testing.T) {
	// CancelOrderByOrderId
	// Cancel Order By OrderId
	// /api/v1/hf/orders/{orderId}

	data := "{\"orderId\": \"671124f9365ccb00073debd4\", \"symbol\": \"BTC-USDT\"}"
	req := &CancelOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdRespModel(t *testing.T) {
	// CancelOrderByOrderId
	// Cancel Order By OrderId
	// /api/v1/hf/orders/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671124f9365ccb00073debd4\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdSyncReqModel(t *testing.T) {
	// CancelOrderByOrderIdSync
	// Cancel Order By OrderId Sync
	// /api/v1/hf/orders/sync/{orderId}

	data := "{\"symbol\": \"BTC-USDT\", \"orderId\": \"671128ee365ccb0007534d45\"}"
	req := &CancelOrderByOrderIdSyncReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdSyncRespModel(t *testing.T) {
	// CancelOrderByOrderIdSync
	// Cancel Order By OrderId Sync
	// /api/v1/hf/orders/sync/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671128ee365ccb0007534d45\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByOrderIdSyncResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidReqModel(t *testing.T) {
	// CancelOrderByClientOid
	// Cancel Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}"
	req := &CancelOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidRespModel(t *testing.T) {
	// CancelOrderByClientOid
	// Cancel Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	data := "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidSyncReqModel(t *testing.T) {
	// CancelOrderByClientOidSync
	// Cancel Order By ClientOid Sync
	// /api/v1/hf/orders/sync/client-order/{clientOid}

	data := "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}"
	req := &CancelOrderByClientOidSyncReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidSyncRespModel(t *testing.T) {
	// CancelOrderByClientOidSync
	// Cancel Order By ClientOid Sync
	// /api/v1/hf/orders/sync/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByClientOidSyncResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelPartialOrderReqModel(t *testing.T) {
	// CancelPartialOrder
	// Cancel Partial Order
	// /api/v1/hf/orders/cancel/{orderId}

	data := "{\"orderId\": \"6711f73c1ef16c000717bb31\", \"symbol\": \"BTC-USDT\", \"cancelSize\": \"0.00001\"}"
	req := &CancelPartialOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelPartialOrderRespModel(t *testing.T) {
	// CancelPartialOrder
	// Cancel Partial Order
	// /api/v1/hf/orders/cancel/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"6711f73c1ef16c000717bb31\",\n        \"cancelSize\": \"0.00001\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelPartialOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelAllOrdersBySymbolReqModel(t *testing.T) {
	// CancelAllOrdersBySymbol
	// Cancel All Orders By Symbol
	// /api/v1/hf/orders

	data := "{\"symbol\": \"BTC-USDT\"}"
	req := &CancelAllOrdersBySymbolReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelAllOrdersBySymbolRespModel(t *testing.T) {
	// CancelAllOrdersBySymbol
	// Cancel All Orders By Symbol
	// /api/v1/hf/orders

	data := "{\"code\":\"200000\",\"data\":\"success\"}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelAllOrdersBySymbolResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelAllOrdersReqModel(t *testing.T) {
	// CancelAllOrders
	// Cancel All Orders
	// /api/v1/hf/orders/cancelAll

}

func TestOrderCancelAllOrdersRespModel(t *testing.T) {
	// CancelAllOrders
	// Cancel All Orders
	// /api/v1/hf/orders/cancelAll

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"succeedSymbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ],\n        \"failedSymbols\": []\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelAllOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderModifyOrderReqModel(t *testing.T) {
	// ModifyOrder
	// Modify Order
	// /api/v1/hf/orders/alter

	data := "{\"symbol\": \"BTC-USDT\", \"orderId\": \"670fd33bf9406e0007ab3945\", \"newPrice\": \"30000\", \"newSize\": \"0.0001\"}"
	req := &ModifyOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderModifyOrderRespModel(t *testing.T) {
	// ModifyOrder
	// Modify Order
	// /api/v1/hf/orders/alter

	data := "{\"code\":\"200000\",\"data\":{\"newOrderId\":\"67112258f9406e0007408827\",\"clientOid\":\"client order id 12\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &ModifyOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdReqModel(t *testing.T) {
	// GetOrderByOrderId
	// Get Order By OrderId
	// /api/v1/hf/orders/{orderId}

	data := "{\"symbol\": \"BTC-USDT\", \"orderId\": \"6717422bd51c29000775ea03\"}"
	req := &GetOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdRespModel(t *testing.T) {
	// GetOrderByOrderId
	// Get Order By OrderId
	// /api/v1/hf/orders/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByClientOidReqModel(t *testing.T) {
	// GetOrderByClientOid
	// Get Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	data := "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}"
	req := &GetOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByClientOidRespModel(t *testing.T) {
	// GetOrderByClientOid
	// Get Order By ClientOid
	// /api/v1/hf/orders/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetSymbolsWithOpenOrderReqModel(t *testing.T) {
	// GetSymbolsWithOpenOrder
	// Get Symbols With Open Order
	// /api/v1/hf/orders/active/symbols

}

func TestOrderGetSymbolsWithOpenOrderRespModel(t *testing.T) {
	// GetSymbolsWithOpenOrder
	// Get Symbols With Open Order
	// /api/v1/hf/orders/active/symbols

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSymbolsWithOpenOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOpenOrdersReqModel(t *testing.T) {
	// GetOpenOrders
	// Get Open Orders
	// /api/v1/hf/orders/active

	data := "{\"symbol\": \"BTC-USDT\"}"
	req := &GetOpenOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOpenOrdersRespModel(t *testing.T) {
	// GetOpenOrders
	// Get Open Orders
	// /api/v1/hf/orders/active

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"67120bbef094e200070976f6\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": \"order remarks\",\n            \"tags\": \"order tags\",\n            \"cancelExist\": false,\n            \"tradeType\": \"TRADE\",\n            \"inOrderBook\": true,\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"tax\": \"0\",\n            \"active\": true,\n            \"createdAt\": 1729235902748,\n            \"lastUpdatedAt\": 1729235909862\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOpenOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOpenOrdersByPageReqModel(t *testing.T) {
	// GetOpenOrdersByPage
	// Get Open Orders By Page
	// /api/v1/hf/orders/active/page

	data := "{\"symbol\": \"BTC-USDT\", \"pageNum\": 1, \"pageSize\": 20}"
	req := &GetOpenOrdersByPageReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOpenOrdersByPageRespModel(t *testing.T) {
	// GetOpenOrdersByPage
	// Get Open Orders By Page
	// /api/v1/hf/orders/active/page

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 20,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"67c1437ea5226600071cc080\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"createdAt\": 1740718974367,\n                \"lastUpdatedAt\": 1741867658590,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": true,\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"remainSize\": \"0.00001\",\n                \"remainFunds\": \"0.5\",\n                \"tax\": \"0\",\n                \"active\": true\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOpenOrdersByPageResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetClosedOrdersReqModel(t *testing.T) {
	// GetClosedOrders
	// Get Closed Orders
	// /api/v1/hf/orders/done

	data := "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
	req := &GetClosedOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetClosedOrdersRespModel(t *testing.T) {
	// GetClosedOrders
	// Get Closed Orders
	// /api/v1/hf/orders/done

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 19814995255305,\n        \"items\": [\n            {\n                \"id\": \"6717422bd51c29000775ea03\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"70000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.7\",\n                \"dealSize\": \"0.00001\",\n                \"dealFunds\": \"0.677176\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0.022824\",\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"fee\": \"0.000677176\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515444,\n                \"lastUpdatedAt\": 1729577515481\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetClosedOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetTradeHistoryReqModel(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v1/hf/fills

	data := "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
	req := &GetTradeHistoryReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetTradeHistoryRespModel(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v1/hf/fills

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 19814995255305,\n                \"orderId\": \"6717422bd51c29000775ea03\",\n                \"counterOrderId\": \"67174228135f9e000709da8c\",\n                \"tradeId\": 11029373945659392,\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"type\": \"limit\",\n                \"forceTaker\": false,\n                \"price\": \"67717.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.677176\",\n                \"fee\": \"0.000677176\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"taxRate\": \"0\",\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515473\n            }\n        ],\n        \"lastId\": 19814995255305\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetTradeHistoryResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetDCPReqModel(t *testing.T) {
	// GetDCP
	// Get DCP
	// /api/v1/hf/orders/dead-cancel-all/query

}

func TestOrderGetDCPRespModel(t *testing.T) {
	// GetDCP
	// Get DCP
	// /api/v1/hf/orders/dead-cancel-all/query

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timeout\": 5,\n        \"symbols\": \"BTC-USDT,ETH-USDT\",\n        \"currentTime\": 1729241305,\n        \"triggerTime\": 1729241308\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetDCPResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderSetDCPReqModel(t *testing.T) {
	// SetDCP
	// Set DCP
	// /api/v1/hf/orders/dead-cancel-all

	data := "{\"timeout\": 5, \"symbols\": \"BTC-USDT,ETH-USDT\"}"
	req := &SetDCPReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderSetDCPRespModel(t *testing.T) {
	// SetDCP
	// Set DCP
	// /api/v1/hf/orders/dead-cancel-all

	data := "{\"code\":\"200000\",\"data\":{\"currentTime\":1729656588,\"triggerTime\":1729656593}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &SetDCPResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddStopOrderReqModel(t *testing.T) {
	// AddStopOrder
	// Add Stop Order
	// /api/v1/stop-order

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"stopPrice\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddStopOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddStopOrderRespModel(t *testing.T) {
	// AddStopOrder
	// Add Stop Order
	// /api/v1/stop-order

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"670fd33bf9406e0007ab3945\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddStopOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelStopOrderByClientOidReqModel(t *testing.T) {
	// CancelStopOrderByClientOid
	// Cancel Stop Order By ClientOid
	// /api/v1/stop-order/cancelOrderByClientOid

	data := "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"689ff597f4414061aa819cc414836abd\"}"
	req := &CancelStopOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelStopOrderByClientOidRespModel(t *testing.T) {
	// CancelStopOrderByClientOid
	// Cancel Stop Order By ClientOid
	// /api/v1/stop-order/cancelOrderByClientOid

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"vs8hoo8ksc8mario0035a74n\",\n        \"clientOid\": \"689ff597f4414061aa819cc414836abd\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelStopOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelStopOrderByOrderIdReqModel(t *testing.T) {
	// CancelStopOrderByOrderId
	// Cancel Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	data := "{\"orderId\": \"671124f9365ccb00073debd4\"}"
	req := &CancelStopOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelStopOrderByOrderIdRespModel(t *testing.T) {
	// CancelStopOrderByOrderId
	// Cancel Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelStopOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelStopOrderReqModel(t *testing.T) {
	// BatchCancelStopOrder
	// Batch Cancel Stop Orders
	// /api/v1/stop-order/cancel

	data := "{\"symbol\": \"example_string_default_value\", \"tradeType\": \"example_string_default_value\", \"orderIds\": \"example_string_default_value\"}"
	req := &BatchCancelStopOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelStopOrderRespModel(t *testing.T) {
	// BatchCancelStopOrder
	// Batch Cancel Stop Orders
	// /api/v1/stop-order/cancel

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchCancelStopOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrdersListReqModel(t *testing.T) {
	// GetStopOrdersList
	// Get Stop Orders List
	// /api/v1/stop-order

	data := "{\"symbol\": \"example_string_default_value\", \"side\": \"example_string_default_value\", \"type\": \"limit\", \"tradeType\": \"example_string_default_value\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"stop\": \"example_string_default_value\"}"
	req := &GetStopOrdersListReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrdersListRespModel(t *testing.T) {
	// GetStopOrdersList
	// Get Stop Orders List
	// /api/v1/stop-order

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 2,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"vs93gptvr9t2fsql003l8k5p\",\n                \"symbol\": \"BTC-USDT\",\n                \"userId\": \"633559791e1cbc0001f319bc\",\n                \"status\": \"NEW\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000.00000000000000000000\",\n                \"size\": \"0.00001000000000000000\",\n                \"funds\": null,\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": -1,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f222233e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"relatedNo\": null,\n                \"orderTime\": 1740626554883000024,\n                \"domainId\": \"kucoin\",\n                \"tradeSource\": \"USER\",\n                \"tradeType\": \"TRADE\",\n                \"feeCurrency\": \"USDT\",\n                \"takerFeeRate\": \"0.00100000000000000000\",\n                \"makerFeeRate\": \"0.00100000000000000000\",\n                \"createdAt\": 1740626554884,\n                \"stop\": \"loss\",\n                \"stopTriggerTime\": null,\n                \"stopPrice\": \"60000.00000000000000000000\",\n                \"limitPrice\": null,\n                \"pop\": null,\n                \"activateCondition\": null\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetStopOrdersListResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrderByOrderIdReqModel(t *testing.T) {
	// GetStopOrderByOrderId
	// Get Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	data := "{\"orderId\": \"example_string_default_value\"}"
	req := &GetStopOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrderByOrderIdRespModel(t *testing.T) {
	// GetStopOrderByOrderId
	// Get Stop Order By OrderId
	// /api/v1/stop-order/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"vs8hoo8q2ceshiue003b67c0\",\n        \"symbol\": \"KCS-USDT\",\n        \"userId\": \"60fe4956c43cbc0006562c2c\",\n        \"status\": \"NEW\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"0.01000000000000000000\",\n        \"size\": \"0.01000000000000000000\",\n        \"funds\": null,\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"cancelAfter\": -1,\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": null,\n        \"channel\": \"API\",\n        \"clientOid\": \"40e0eb9efe6311eb8e58acde48001122\",\n        \"remark\": null,\n        \"tags\": null,\n        \"orderTime\": 1629098781127530200,\n        \"domainId\": \"kucoin\",\n        \"tradeSource\": \"USER\",\n        \"tradeType\": \"TRADE\",\n        \"feeCurrency\": \"USDT\",\n        \"takerFeeRate\": \"0.00200000000000000000\",\n        \"makerFeeRate\": \"0.00200000000000000000\",\n        \"createdAt\": 1629098781128,\n        \"stop\": \"loss\",\n        \"stopTriggerTime\": null,\n        \"stopPrice\": \"10.00000000000000000000\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetStopOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrderByClientOidReqModel(t *testing.T) {
	// GetStopOrderByClientOid
	// Get Stop Order By ClientOid
	// /api/v1/stop-order/queryOrderByClientOid

	data := "{\"clientOid\": \"example_string_default_value\", \"symbol\": \"example_string_default_value\"}"
	req := &GetStopOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetStopOrderByClientOidRespModel(t *testing.T) {
	// GetStopOrderByClientOid
	// Get Stop Order By ClientOid
	// /api/v1/stop-order/queryOrderByClientOid

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"vs8hoo8os561f5np0032vngj\",\n            \"symbol\": \"KCS-USDT\",\n            \"userId\": \"60fe4956c43cbc0006562c2c\",\n            \"status\": \"NEW\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"0.01000000000000000000\",\n            \"size\": \"0.01000000000000000000\",\n            \"funds\": null,\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"cancelAfter\": -1,\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": null,\n            \"channel\": \"API\",\n            \"clientOid\": \"2b700942b5db41cebe578cff48960e09\",\n            \"remark\": null,\n            \"tags\": null,\n            \"orderTime\": 1629020492834532600,\n            \"domainId\": \"kucoin\",\n            \"tradeSource\": \"USER\",\n            \"tradeType\": \"TRADE\",\n            \"feeCurrency\": \"USDT\",\n            \"takerFeeRate\": \"0.00200000000000000000\",\n            \"makerFeeRate\": \"0.00200000000000000000\",\n            \"createdAt\": 1629020492837,\n            \"stop\": \"loss\",\n            \"stopTriggerTime\": null,\n            \"stopPrice\": \"1.00000000000000000000\"\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetStopOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOcoOrderReqModel(t *testing.T) {
	// AddOcoOrder
	// Add OCO Order
	// /api/v3/oco/order

	data := "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"94000\", \"size\": \"0.1\", \"clientOid\": \"5c52e11203aa67f1e493fb\", \"stopPrice\": \"98000\", \"limitPrice\": \"96000\", \"remark\": \"this is remark\", \"tradeType\": \"TRADE\"}"
	req := &AddOcoOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOcoOrderRespModel(t *testing.T) {
	// AddOcoOrder
	// Add OCO Order
	// /api/v3/oco/order

	data := "{\"code\":\"200000\",\"data\":{\"orderId\":\"674c316e688dea0007c7b986\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOcoOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOcoOrderByOrderIdReqModel(t *testing.T) {
	// CancelOcoOrderByOrderId
	// Cancel OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	data := "{\"orderId\": \"674c316e688dea0007c7b986\"}"
	req := &CancelOcoOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOcoOrderByOrderIdRespModel(t *testing.T) {
	// CancelOcoOrderByOrderId
	// Cancel OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6kkmkk57003gok16\",\n            \"vs93gpqc6kkmkk57003gok17\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOcoOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOcoOrderByClientOidReqModel(t *testing.T) {
	// CancelOcoOrderByClientOid
	// Cancel OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e11203aa67f1e493fb\"}"
	req := &CancelOcoOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOcoOrderByClientOidRespModel(t *testing.T) {
	// CancelOcoOrderByClientOid
	// Cancel OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6r0mkk57003gok3h\",\n            \"vs93gpqc6r0mkk57003gok3i\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOcoOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelOcoOrdersReqModel(t *testing.T) {
	// BatchCancelOcoOrders
	// Batch Cancel OCO Order
	// /api/v3/oco/orders

	data := "{\"orderIds\": \"674c388172cf2800072ee746,674c38bdfd8300000795167e\", \"symbol\": \"BTC-USDT\"}"
	req := &BatchCancelOcoOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelOcoOrdersRespModel(t *testing.T) {
	// BatchCancelOcoOrders
	// Batch Cancel OCO Order
	// /api/v3/oco/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc750mkk57003gok6i\",\n            \"vs93gpqc750mkk57003gok6j\",\n            \"vs93gpqc75c39p83003tnriu\",\n            \"vs93gpqc75c39p83003tnriv\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchCancelOcoOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderByOrderIdReqModel(t *testing.T) {
	// GetOcoOrderByOrderId
	// Get OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	data := "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}"
	req := &GetOcoOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderByOrderIdRespModel(t *testing.T) {
	// GetOcoOrderByOrderId
	// Get OCO Order By OrderId
	// /api/v3/oco/order/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOcoOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderByClientOidReqModel(t *testing.T) {
	// GetOcoOrderByClientOid
	// Get OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e1203aa6f3g7f1e493fb\"}"
	req := &GetOcoOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderByClientOidRespModel(t *testing.T) {
	// GetOcoOrderByClientOid
	// Get OCO Order By ClientOid
	// /api/v3/oco/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n        \"orderTime\": 1733049594803,\n        \"status\": \"NEW\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOcoOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderDetailByOrderIdReqModel(t *testing.T) {
	// GetOcoOrderDetailByOrderId
	// Get OCO Order Detail By OrderId
	// /api/v3/oco/order/details/{orderId}

	data := "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}"
	req := &GetOcoOrderDetailByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderDetailByOrderIdRespModel(t *testing.T) {
	// GetOcoOrderDetailByOrderId
	// Get OCO Order Detail By OrderId
	// /api/v3/oco/order/details/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\",\n        \"orders\": [\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelj\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"94000.00000000000000000000\",\n                \"stopPrice\": \"94000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            },\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelk\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"96000.00000000000000000000\",\n                \"stopPrice\": \"98000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOcoOrderDetailByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderListReqModel(t *testing.T) {
	// GetOcoOrderList
	// Get OCO Order List
	// /api/v3/oco/orders

	data := "{\"symbol\": \"BTC-USDT\", \"startAt\": 123456, \"endAt\": 123456, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"currentPage\": 1}"
	req := &GetOcoOrderListReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOcoOrderListRespModel(t *testing.T) {
	// GetOcoOrderList
	// Get OCO Order List
	// /api/v3/oco/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n                \"symbol\": \"BTC-USDT\",\n                \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n                \"orderTime\": 1733049594803,\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOcoOrderListResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderOldReqModel(t *testing.T) {
	// AddOrderOld
	// Add Order - Old
	// /api/v1/orders

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderOldRespModel(t *testing.T) {
	// AddOrderOld
	// Add Order - Old
	// /api/v1/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8635b38d120007709c0f\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestOldReqModel(t *testing.T) {
	// AddOrderTestOld
	// Add Order Test - Old
	// /api/v1/orders/test

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderTestOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestOldRespModel(t *testing.T) {
	// AddOrderTestOld
	// Add Order Test - Old
	// /api/v1/orders/test

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8776291d9e00074f1edf\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderTestOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersOldReqModel(t *testing.T) {
	// BatchAddOrdersOld
	// Batch Add Orders - Old
	// /api/v1/orders/multi

	data := "{\"symbol\": \"BTC-USDT\", \"orderList\": [{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"50000\", \"size\": \"0.0001\"}, {\"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"49999\", \"size\": \"0.0001\"}]}"
	req := &BatchAddOrdersOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchAddOrdersOldRespModel(t *testing.T) {
	// BatchAddOrdersOld
	// Batch Add Orders - Old
	// /api/v1/orders/multi

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"data\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dfef434f0007efc431\",\n                \"status\": \"success\",\n                \"failMsg\": null,\n                \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"\n            },\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"49999\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dffb378b00077b9c20\",\n                \"status\": \"fail\",\n                \"failMsg\": \"Balance insufficient!\",\n                \"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\"\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchAddOrdersOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdOldReqModel(t *testing.T) {
	// CancelOrderByOrderIdOld
	// Cancel Order By OrderId - Old
	// /api/v1/orders/{orderId}

	data := "{\"orderId\": \"674a97dfef434f0007efc431\"}"
	req := &CancelOrderByOrderIdOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdOldRespModel(t *testing.T) {
	// CancelOrderByOrderIdOld
	// Cancel Order By OrderId - Old
	// /api/v1/orders/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a97dfef434f0007efc431\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByOrderIdOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidOldReqModel(t *testing.T) {
	// CancelOrderByClientOidOld
	// Cancel Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e11203aa677f331e493fb\"}"
	req := &CancelOrderByClientOidOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidOldRespModel(t *testing.T) {
	// CancelOrderByClientOidOld
	// Cancel Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"67c3252a63d25e0007f91de9\",\n        \"clientOid\": \"5c52e11203aa677f331e493fb\",\n        \"cancelledOcoOrderIds\": null\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByClientOidOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelOrderOldReqModel(t *testing.T) {
	// BatchCancelOrderOld
	// Batch Cancel Order - Old
	// /api/v1/orders

	data := "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"TRADE\"}"
	req := &BatchCancelOrderOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderBatchCancelOrderOldRespModel(t *testing.T) {
	// BatchCancelOrderOld
	// Batch Cancel Order - Old
	// /api/v1/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a8635b38d120007709c0f\",\n            \"674a8630439c100007d3bce1\"\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &BatchCancelOrderOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrdersListOldReqModel(t *testing.T) {
	// GetOrdersListOld
	// Get Orders List - Old
	// /api/v1/orders

	data := "{\"symbol\": \"BTC-USDT\", \"status\": \"active\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"pageSize\": 50}"
	req := &GetOrdersListOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrdersListOldRespModel(t *testing.T) {
	// GetOrdersListOld
	// Get Orders List - Old
	// /api/v1/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"674a9a872033a50007e2790d\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0\",\n                \"dealFunds\": \"0\",\n                \"dealSize\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"isActive\": false,\n                \"cancelExist\": true,\n                \"createdAt\": 1732942471752,\n                \"tradeType\": \"TRADE\"\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrdersListOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetRecentOrdersListOldReqModel(t *testing.T) {
	// GetRecentOrdersListOld
	// Get Recent Orders List - Old
	// /api/v1/limit/orders

}

func TestOrderGetRecentOrdersListOldRespModel(t *testing.T) {
	// GetRecentOrdersListOld
	// Get Recent Orders List - Old
	// /api/v1/limit/orders

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"674a9a872033a50007e2790d\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0\",\n            \"dealFunds\": \"0\",\n            \"dealSize\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n            \"remark\": \"order remarks\",\n            \"tags\": null,\n            \"isActive\": false,\n            \"cancelExist\": true,\n            \"createdAt\": 1732942471752,\n            \"tradeType\": \"TRADE\"\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetRecentOrdersListOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdOldReqModel(t *testing.T) {
	// GetOrderByOrderIdOld
	// Get Order By OrderId - Old
	// /api/v1/orders/{orderId}

	data := "{\"orderId\": \"674a97dfef434f0007efc431\"}"
	req := &GetOrderByOrderIdOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdOldRespModel(t *testing.T) {
	// GetOrderByOrderIdOld
	// Get Order By OrderId - Old
	// /api/v1/orders/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrderByOrderIdOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByClientOidOldReqModel(t *testing.T) {
	// GetOrderByClientOidOld
	// Get Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	data := "{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"}"
	req := &GetOrderByClientOidOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByClientOidOldRespModel(t *testing.T) {
	// GetOrderByClientOidOld
	// Get Order By ClientOid - Old
	// /api/v1/order/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrderByClientOidOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetTradeHistoryOldReqModel(t *testing.T) {
	// GetTradeHistoryOld
	// Get Trade History - Old
	// /api/v1/fills

	data := "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}"
	req := &GetTradeHistoryOldReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetTradeHistoryOldRespModel(t *testing.T) {
	// GetTradeHistoryOld
	// Get Trade History - Old
	// /api/v1/fills

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"symbol\": \"DOGE-USDT\",\n                \"tradeId\": \"10862827223795713\",\n                \"orderId\": \"6745698ef4f1200007c561a8\",\n                \"counterOrderId\": \"6745695ef15b270007ac5076\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"0.40739\",\n                \"size\": \"10\",\n                \"funds\": \"4.0739\",\n                \"fee\": \"0.0040739\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"type\": \"market\",\n                \"createdAt\": 1732602254928\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetTradeHistoryOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetRecentTradeHistoryOldReqModel(t *testing.T) {
	// GetRecentTradeHistoryOld
	// Get Recent Trade History - Old
	// /api/v1/limit/fills

}

func TestOrderGetRecentTradeHistoryOldRespModel(t *testing.T) {
	// GetRecentTradeHistoryOld
	// Get Recent Trade History - Old
	// /api/v1/limit/fills

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"tradeId\": \"11732720444522497\",\n            \"orderId\": \"674aab24754b1e00077dbc69\",\n            \"counterOrderId\": \"674aab1fb26bfb0007a18b67\",\n            \"side\": \"buy\",\n            \"liquidity\": \"taker\",\n            \"forceTaker\": false,\n            \"price\": \"96999.6\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.969996\",\n            \"fee\": \"0.000969996\",\n            \"feeRate\": \"0.001\",\n            \"feeCurrency\": \"USDT\",\n            \"stop\": \"\",\n            \"tradeType\": \"TRADE\",\n            \"type\": \"limit\",\n            \"createdAt\": 1732946724082\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetRecentTradeHistoryOldResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}
