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
	// /api/v3/hf/margin/order

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderRespModel(t *testing.T) {
	// AddOrder
	// Add Order
	// /api/v3/hf/margin/order

	data := "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671663e02188630007e21c9c\",\n        \"clientOid\": \"5c52e11203aa677f33e1493fb\",\n        \"borrowSize\": \"10.2\",\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestReqModel(t *testing.T) {
	// AddOrderTest
	// Add Order Test
	// /api/v3/hf/margin/order/test

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderTestReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestRespModel(t *testing.T) {
	// AddOrderTest
	// Add Order Test
	// /api/v3/hf/margin/order/test

	data := "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"5bd6e9286d99522a52e458de\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"borrowSize\": 10.2,\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderTestResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdReqModel(t *testing.T) {
	// CancelOrderByOrderId
	// Cancel Order By OrderId
	// /api/v3/hf/margin/orders/{orderId}

	data := "{\"orderId\": \"671663e02188630007e21c9c\", \"symbol\": \"BTC-USDT\"}"
	req := &CancelOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByOrderIdRespModel(t *testing.T) {
	// CancelOrderByOrderId
	// Cancel Order By OrderId
	// /api/v3/hf/margin/orders/{orderId}

	data := "{\"code\":\"200000\",\"data\":{\"orderId\":\"671663e02188630007e21c9c\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByOrderIdResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidReqModel(t *testing.T) {
	// CancelOrderByClientOid
	// Cancel Order By ClientOid
	// /api/v3/hf/margin/orders/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e11203aa677f33e1493fb\", \"symbol\": \"BTC-USDT\"}"
	req := &CancelOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelOrderByClientOidRespModel(t *testing.T) {
	// CancelOrderByClientOid
	// Cancel Order By ClientOid
	// /api/v3/hf/margin/orders/client-order/{clientOid}

	data := "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e1493fb\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &CancelOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelAllOrdersBySymbolReqModel(t *testing.T) {
	// CancelAllOrdersBySymbol
	// Cancel All Orders By Symbol
	// /api/v3/hf/margin/orders

	data := "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}"
	req := &CancelAllOrdersBySymbolReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderCancelAllOrdersBySymbolRespModel(t *testing.T) {
	// CancelAllOrdersBySymbol
	// Cancel All Orders By Symbol
	// /api/v3/hf/margin/orders

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

func TestOrderGetSymbolsWithOpenOrderReqModel(t *testing.T) {
	// GetSymbolsWithOpenOrder
	// Get Symbols With Open Order
	// /api/v3/hf/margin/order/active/symbols

	data := "{\"tradeType\": \"MARGIN_TRADE\"}"
	req := &GetSymbolsWithOpenOrderReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetSymbolsWithOpenOrderRespModel(t *testing.T) {
	// GetSymbolsWithOpenOrder
	// Get Symbols With Open Order
	// /api/v3/hf/margin/order/active/symbols

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbolSize\": 1,\n        \"symbols\": [\n            \"BTC-USDT\"\n        ]\n    }\n}"
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
	// /api/v3/hf/margin/orders/active

	data := "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}"
	req := &GetOpenOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOpenOrdersRespModel(t *testing.T) {
	// GetOpenOrders
	// Get Open Orders
	// /api/v3/hf/margin/orders/active

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"671667306afcdb000723107f\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"stop\": null,\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": null,\n            \"tags\": null,\n            \"cancelExist\": false,\n            \"tradeType\": \"MARGIN_TRADE\",\n            \"inOrderBook\": true,\n            \"active\": true,\n            \"tax\": \"0\",\n            \"createdAt\": 1729521456248,\n            \"lastUpdatedAt\": 1729521460940\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOpenOrdersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetClosedOrdersReqModel(t *testing.T) {
	// GetClosedOrders
	// Get Closed Orders
	// /api/v3/hf/margin/orders/done

	data := "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
	req := &GetClosedOrdersReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetClosedOrdersRespModel(t *testing.T) {
	// GetClosedOrders
	// Get Closed Orders
	// /api/v3/hf/margin/orders/done

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 136112949351,\n        \"items\": [\n            {\n                \"id\": \"6716491f6afcdb00078365c8\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0\",\n                \"cancelledSize\": \"0.00001\",\n                \"cancelledFunds\": \"0.5\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"stop\": null,\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": null,\n                \"tags\": null,\n                \"cancelExist\": true,\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729513759162,\n                \"lastUpdatedAt\": 1729521126597\n            }\n        ]\n    }\n}"
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
	// /api/v3/hf/margin/fills

	data := "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
	req := &GetTradeHistoryReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetTradeHistoryRespModel(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v3/hf/margin/fills

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 137891621991,\n                \"symbol\": \"BTC-USDT\",\n                \"tradeId\": 11040911994273793,\n                \"orderId\": \"671868085584bc0007d85f46\",\n                \"counterOrderId\": \"67186805b7cbdf00071621f9\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"67141.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.671416\",\n                \"fee\": \"0.000671416\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"tax\": \"0\",\n                \"taxRate\": \"0\",\n                \"type\": \"limit\",\n                \"createdAt\": 1729652744998\n            }\n        ],\n        \"lastId\": 137891621991\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetTradeHistoryResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdReqModel(t *testing.T) {
	// GetOrderByOrderId
	// Get Order By OrderId
	// /api/v3/hf/margin/orders/{orderId}

	data := "{\"orderId\": \"671667306afcdb000723107f\", \"symbol\": \"BTC-USDT\"}"
	req := &GetOrderByOrderIdReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByOrderIdRespModel(t *testing.T) {
	// GetOrderByOrderId
	// Get Order By OrderId
	// /api/v3/hf/margin/orders/{orderId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}"
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
	// /api/v3/hf/margin/orders/client-order/{clientOid}

	data := "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}"
	req := &GetOrderByClientOidReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderGetOrderByClientOidRespModel(t *testing.T) {
	// GetOrderByClientOid
	// Get Order By ClientOid
	// /api/v3/hf/margin/orders/client-order/{clientOid}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetOrderByClientOidResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderV1ReqModel(t *testing.T) {
	// AddOrderV1
	// Add Order - V1
	// /api/v1/margin/order

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderV1Req{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderV1RespModel(t *testing.T) {
	// AddOrderV1
	// Add Order - V1
	// /api/v1/margin/order

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderV1Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestV1ReqModel(t *testing.T) {
	// AddOrderTestV1
	// Add Order Test - V1
	// /api/v1/margin/order/test

	data := "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}"
	req := &AddOrderTestV1Req{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestOrderAddOrderTestV1RespModel(t *testing.T) {
	// AddOrderTestV1
	// Add Order Test - V1
	// /api/v1/margin/order/test

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddOrderTestV1Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}
