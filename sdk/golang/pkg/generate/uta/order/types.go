// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package order

import "github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"

// AmendOrderReq is ported from the Java UTA SDK model.
type AmendOrderReq struct {
	Symbol             string  `json:"symbol,omitempty" url:"symbol,omitempty"`
	NewSize            float64 `json:"newSize,omitempty" url:"newSize,omitempty"`
	OrderId            string  `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid          string  `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	NewPrice           float64 `json:"newPrice,omitempty" url:"newPrice,omitempty"`
	SizeUnit           string  `json:"sizeUnit,omitempty" url:"sizeUnit,omitempty"`
	CxlOnFail          bool    `json:"cxlOnFail,omitempty" url:"cxlOnFail,omitempty"`
	SlTriggerPrice     float64 `json:"slTriggerPrice,omitempty" url:"slTriggerPrice,omitempty"`
	TpTriggerPrice     float64 `json:"tpTriggerPrice,omitempty" url:"tpTriggerPrice,omitempty"`
	SlTriggerPriceType string  `json:"slTriggerPriceType,omitempty" url:"slTriggerPriceType,omitempty"`
	TpTriggerPriceType string  `json:"tpTriggerPriceType,omitempty" url:"tpTriggerPriceType,omitempty"`
}

// AmendOrderResp is ported from the Java UTA SDK model.
type AmendOrderResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	OrderId        string              `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid      string              `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

func (o *AmendOrderResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// BatchCancelOrdersByIdCancelOrderList is ported from the Java UTA SDK model.
type BatchCancelOrdersByIdCancelOrderList struct {
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

// BatchCancelOrdersByIdItems is ported from the Java UTA SDK model.
type BatchCancelOrdersByIdItems struct {
	Code      string `json:"code,omitempty" url:"code,omitempty"`
	Msg       string `json:"msg,omitempty" url:"msg,omitempty"`
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Ts        int64  `json:"ts,omitempty" url:"ts,omitempty"`
}

// BatchCancelOrdersByIdReq is ported from the Java UTA SDK model.
type BatchCancelOrdersByIdReq struct {
	TradeType       string                                 `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	CancelOrderList []BatchCancelOrdersByIdCancelOrderList `json:"cancelOrderList,omitempty" url:"cancelOrderList,omitempty"`
}

// BatchCancelOrdersByIdResp is ported from the Java UTA SDK model.
type BatchCancelOrdersByIdResp struct {
	CommonResponse *types.RestResponse          `json:"-"`
	TradeType      string                       `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Items          []BatchCancelOrdersByIdItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *BatchCancelOrdersByIdResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// BatchCancelOrdersBySymbolItems is ported from the Java UTA SDK model.
type BatchCancelOrdersBySymbolItems struct {
	OrderId string `json:"orderId,omitempty" url:"orderId,omitempty"`
}

// BatchCancelOrdersBySymbolReq is ported from the Java UTA SDK model.
type BatchCancelOrdersBySymbolReq struct {
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType   string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	MarginMode  string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	OrderFilter string `json:"orderFilter,omitempty" url:"orderFilter,omitempty"`
}

// BatchCancelOrdersBySymbolResp is ported from the Java UTA SDK model.
type BatchCancelOrdersBySymbolResp struct {
	CommonResponse *types.RestResponse              `json:"-"`
	TradeType      string                           `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Ts             int64                            `json:"ts,omitempty" url:"ts,omitempty"`
	Items          []BatchCancelOrdersBySymbolItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *BatchCancelOrdersBySymbolResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// CancelOrderReq is ported from the Java UTA SDK model.
type CancelOrderReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

// CancelOrderResp is ported from the Java UTA SDK model.
type CancelOrderResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	OrderId        string              `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid      string              `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Ts             int64               `json:"ts,omitempty" url:"ts,omitempty"`
}

func (o *CancelOrderResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetOpenOrderListItems is ported from the Java UTA SDK model.
type GetOpenOrderListItems struct {
	OrderId            string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid          string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Status             int64  `json:"status,omitempty" url:"status,omitempty"`
	FilledSize         string `json:"filledSize,omitempty" url:"filledSize,omitempty"`
	AvgPrice           string `json:"avgPrice,omitempty" url:"avgPrice,omitempty"`
	Fee                string `json:"fee,omitempty" url:"fee,omitempty"`
	FeeCurrency        string `json:"feeCurrency,omitempty" url:"feeCurrency,omitempty"`
	Tax                string `json:"tax,omitempty" url:"tax,omitempty"`
	TradeId            string `json:"tradeId,omitempty" url:"tradeId,omitempty"`
	Symbol             string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Side               string `json:"side,omitempty" url:"side,omitempty"`
	PositionSide       string `json:"positionSide,omitempty" url:"positionSide,omitempty"`
	OrderType          string `json:"orderType,omitempty" url:"orderType,omitempty"`
	Size               string `json:"size,omitempty" url:"size,omitempty"`
	SizeUnit           string `json:"sizeUnit,omitempty" url:"sizeUnit,omitempty"`
	Price              string `json:"price,omitempty" url:"price,omitempty"`
	ReduceOnly         bool   `json:"reduceOnly,omitempty" url:"reduceOnly,omitempty"`
	MarginMode         string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Stp                string `json:"stp,omitempty" url:"stp,omitempty"`
	TimeInForce        string `json:"timeInForce,omitempty" url:"timeInForce,omitempty"`
	CancelAfter        int64  `json:"cancelAfter,omitempty" url:"cancelAfter,omitempty"`
	CancelSize         string `json:"cancelSize,omitempty" url:"cancelSize,omitempty"`
	TriggerDirection   string `json:"triggerDirection,omitempty" url:"triggerDirection,omitempty"`
	TriggerPrice       string `json:"triggerPrice,omitempty" url:"triggerPrice,omitempty"`
	TriggerPriceType   string `json:"triggerPriceType,omitempty" url:"triggerPriceType,omitempty"`
	TpTriggerPrice     string `json:"tpTriggerPrice,omitempty" url:"tpTriggerPrice,omitempty"`
	TpTriggerPriceType string `json:"tpTriggerPriceType,omitempty" url:"tpTriggerPriceType,omitempty"`
	SlTriggerPrice     string `json:"slTriggerPrice,omitempty" url:"slTriggerPrice,omitempty"`
	SlTriggerPriceType string `json:"slTriggerPriceType,omitempty" url:"slTriggerPriceType,omitempty"`
	PostOnly           bool   `json:"postOnly,omitempty" url:"postOnly,omitempty"`
	Tags               string `json:"tags,omitempty" url:"tags,omitempty"`
	TriggerOrderId     string `json:"triggerOrderId,omitempty" url:"triggerOrderId,omitempty"`
	OrderTime          int64  `json:"orderTime,omitempty" url:"orderTime,omitempty"`
	UpdatedTime        int64  `json:"updatedTime,omitempty" url:"updatedTime,omitempty"`
}

// GetOpenOrderListReq is ported from the Java UTA SDK model.
type GetOpenOrderListReq struct {
	TradeType   string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderFilter string `json:"orderFilter,omitempty" url:"orderFilter,omitempty"`
	PageNumber  string `json:"pageNumber,omitempty" url:"pageNumber,omitempty"`
	PageSize    string `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetOpenOrderListResp is ported from the Java UTA SDK model.
type GetOpenOrderListResp struct {
	CommonResponse *types.RestResponse     `json:"-"`
	PageNumber     int64                   `json:"pageNumber,omitempty" url:"pageNumber,omitempty"`
	TradeType      string                  `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Items          []GetOpenOrderListItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetOpenOrderListResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetOrderDetailsReq is ported from the Java UTA SDK model.
type GetOrderDetailsReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

// GetOrderDetailsResp is ported from the Java UTA SDK model.
type GetOrderDetailsResp struct {
	CommonResponse     *types.RestResponse `json:"-"`
	TradeType          string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	OrderId            string              `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid          string              `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Status             int64               `json:"status,omitempty" url:"status,omitempty"`
	FilledSize         string              `json:"filledSize,omitempty" url:"filledSize,omitempty"`
	AvgPrice           string              `json:"avgPrice,omitempty" url:"avgPrice,omitempty"`
	Fee                string              `json:"fee,omitempty" url:"fee,omitempty"`
	FeeCurrency        string              `json:"feeCurrency,omitempty" url:"feeCurrency,omitempty"`
	Tax                string              `json:"tax,omitempty" url:"tax,omitempty"`
	TradeId            string              `json:"tradeId,omitempty" url:"tradeId,omitempty"`
	Symbol             string              `json:"symbol,omitempty" url:"symbol,omitempty"`
	Side               string              `json:"side,omitempty" url:"side,omitempty"`
	PositionSide       string              `json:"positionSide,omitempty" url:"positionSide,omitempty"`
	OrderType          string              `json:"orderType,omitempty" url:"orderType,omitempty"`
	Size               string              `json:"size,omitempty" url:"size,omitempty"`
	SizeUnit           string              `json:"sizeUnit,omitempty" url:"sizeUnit,omitempty"`
	Price              string              `json:"price,omitempty" url:"price,omitempty"`
	ReduceOnly         bool                `json:"reduceOnly,omitempty" url:"reduceOnly,omitempty"`
	MarginMode         string              `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Stp                string              `json:"stp,omitempty" url:"stp,omitempty"`
	TimeInForce        string              `json:"timeInForce,omitempty" url:"timeInForce,omitempty"`
	CancelReason       string              `json:"cancelReason,omitempty" url:"cancelReason,omitempty"`
	CancelSize         string              `json:"cancelSize,omitempty" url:"cancelSize,omitempty"`
	CancelAfter        int64               `json:"cancelAfter,omitempty" url:"cancelAfter,omitempty"`
	TriggerDirection   string              `json:"triggerDirection,omitempty" url:"triggerDirection,omitempty"`
	TriggerPrice       string              `json:"triggerPrice,omitempty" url:"triggerPrice,omitempty"`
	TriggerPriceType   string              `json:"triggerPriceType,omitempty" url:"triggerPriceType,omitempty"`
	TpTriggerPrice     string              `json:"tpTriggerPrice,omitempty" url:"tpTriggerPrice,omitempty"`
	TpTriggerPriceType string              `json:"tpTriggerPriceType,omitempty" url:"tpTriggerPriceType,omitempty"`
	TpOrderPrice       string              `json:"tpOrderPrice,omitempty" url:"tpOrderPrice,omitempty"`
	SlTriggerPrice     string              `json:"slTriggerPrice,omitempty" url:"slTriggerPrice,omitempty"`
	SlTriggerPriceType string              `json:"slTriggerPriceType,omitempty" url:"slTriggerPriceType,omitempty"`
	SlOrderPrice       string              `json:"slOrderPrice,omitempty" url:"slOrderPrice,omitempty"`
	PostOnly           bool                `json:"postOnly,omitempty" url:"postOnly,omitempty"`
	Tags               string              `json:"tags,omitempty" url:"tags,omitempty"`
	TriggerOrderId     string              `json:"triggerOrderId,omitempty" url:"triggerOrderId,omitempty"`
	OrderTime          int64               `json:"orderTime,omitempty" url:"orderTime,omitempty"`
	UpdatedTime        int64               `json:"updatedTime,omitempty" url:"updatedTime,omitempty"`
}

func (o *GetOrderDetailsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetOrderHistoryItems is ported from the Java UTA SDK model.
type GetOrderHistoryItems struct {
	OrderId            string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid          string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Status             int64  `json:"status,omitempty" url:"status,omitempty"`
	FilledSize         string `json:"filledSize,omitempty" url:"filledSize,omitempty"`
	AvgPrice           string `json:"avgPrice,omitempty" url:"avgPrice,omitempty"`
	Fee                string `json:"fee,omitempty" url:"fee,omitempty"`
	FeeCurrency        string `json:"feeCurrency,omitempty" url:"feeCurrency,omitempty"`
	Tax                string `json:"tax,omitempty" url:"tax,omitempty"`
	TradeId            string `json:"tradeId,omitempty" url:"tradeId,omitempty"`
	Symbol             string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderType          string `json:"orderType,omitempty" url:"orderType,omitempty"`
	Side               string `json:"side,omitempty" url:"side,omitempty"`
	PositionSide       string `json:"positionSide,omitempty" url:"positionSide,omitempty"`
	Size               string `json:"size,omitempty" url:"size,omitempty"`
	SizeUnit           string `json:"sizeUnit,omitempty" url:"sizeUnit,omitempty"`
	Price              string `json:"price,omitempty" url:"price,omitempty"`
	ReduceOnly         bool   `json:"reduceOnly,omitempty" url:"reduceOnly,omitempty"`
	MarginMode         string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Stp                string `json:"stp,omitempty" url:"stp,omitempty"`
	TimeInForce        string `json:"timeInForce,omitempty" url:"timeInForce,omitempty"`
	CancelReason       string `json:"cancelReason,omitempty" url:"cancelReason,omitempty"`
	CancelAfter        int64  `json:"cancelAfter,omitempty" url:"cancelAfter,omitempty"`
	TriggerDirection   string `json:"triggerDirection,omitempty" url:"triggerDirection,omitempty"`
	TriggerPrice       string `json:"triggerPrice,omitempty" url:"triggerPrice,omitempty"`
	TriggerPriceType   string `json:"triggerPriceType,omitempty" url:"triggerPriceType,omitempty"`
	TpTriggerPrice     string `json:"tpTriggerPrice,omitempty" url:"tpTriggerPrice,omitempty"`
	TpTriggerPriceType string `json:"tpTriggerPriceType,omitempty" url:"tpTriggerPriceType,omitempty"`
	SlTriggerPrice     string `json:"slTriggerPrice,omitempty" url:"slTriggerPrice,omitempty"`
	SlTriggerPriceType string `json:"slTriggerPriceType,omitempty" url:"slTriggerPriceType,omitempty"`
	PostOnly           bool   `json:"postOnly,omitempty" url:"postOnly,omitempty"`
	Tags               string `json:"tags,omitempty" url:"tags,omitempty"`
	TriggerOrderId     string `json:"triggerOrderId,omitempty" url:"triggerOrderId,omitempty"`
	OrderTime          int64  `json:"orderTime,omitempty" url:"orderTime,omitempty"`
	UpdatedTime        int64  `json:"updatedTime,omitempty" url:"updatedTime,omitempty"`
}

// GetOrderHistoryReq is ported from the Java UTA SDK model.
type GetOrderHistoryReq struct {
	TradeType   string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Side        string `json:"side,omitempty" url:"side,omitempty"`
	OrderFilter string `json:"orderFilter,omitempty" url:"orderFilter,omitempty"`
	StartAt     string `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt       string `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId      int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
	PageSize    int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetOrderHistoryResp is ported from the Java UTA SDK model.
type GetOrderHistoryResp struct {
	CommonResponse *types.RestResponse    `json:"-"`
	LastId         int64                  `json:"lastId,omitempty" url:"lastId,omitempty"`
	TradeType      string                 `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Items          []GetOrderHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetOrderHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTradeHistoryItems is ported from the Java UTA SDK model.
type GetTradeHistoryItems struct {
	Symbol        string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderId       string `json:"orderId,omitempty" url:"orderId,omitempty"`
	OrderType     string `json:"orderType,omitempty" url:"orderType,omitempty"`
	Side          string `json:"side,omitempty" url:"side,omitempty"`
	PositionSide  string `json:"positionSide,omitempty" url:"positionSide,omitempty"`
	FillType      string `json:"fillType,omitempty" url:"fillType,omitempty"`
	TradeId       string `json:"tradeId,omitempty" url:"tradeId,omitempty"`
	Size          string `json:"size,omitempty" url:"size,omitempty"`
	Value         string `json:"value,omitempty" url:"value,omitempty"`
	Price         string `json:"price,omitempty" url:"price,omitempty"`
	ExecutionTime int64  `json:"executionTime,omitempty" url:"executionTime,omitempty"`
	Fee           string `json:"fee,omitempty" url:"fee,omitempty"`
	FeeCurrency   string `json:"feeCurrency,omitempty" url:"feeCurrency,omitempty"`
	LiquidityRole string `json:"liquidityRole,omitempty" url:"liquidityRole,omitempty"`
	MarginMode    string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Tax           string `json:"tax,omitempty" url:"tax,omitempty"`
}

// GetTradeHistoryReq is ported from the Java UTA SDK model.
type GetTradeHistoryReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	Side      string `json:"side,omitempty" url:"side,omitempty"`
	StartAt   string `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt     string `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId    string `json:"lastId,omitempty" url:"lastId,omitempty"`
	PageSize  int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	FillType  string `json:"fillType,omitempty" url:"fillType,omitempty"`
}

// GetTradeHistoryResp is ported from the Java UTA SDK model.
type GetTradeHistoryResp struct {
	CommonResponse *types.RestResponse    `json:"-"`
	LastId         int64                  `json:"lastId,omitempty" url:"lastId,omitempty"`
	TradeType      string                 `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Items          []GetTradeHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetTradeHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// OrderModifyApiResponse is ported from the Java UTA SDK model.
type OrderModifyApiResponse struct {
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

// PlaceOrderReq is ported from the Java UTA SDK model.
type PlaceOrderReq struct {
	TradeType          string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	ClientOid          string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Symbol             string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TriggerDirection   string `json:"triggerDirection,omitempty" url:"triggerDirection,omitempty"`
	TriggerPriceType   string `json:"triggerPriceType,omitempty" url:"triggerPriceType,omitempty"`
	TriggerPrice       string `json:"triggerPrice,omitempty" url:"triggerPrice,omitempty"`
	Side               string `json:"side,omitempty" url:"side,omitempty"`
	OrderType          string `json:"orderType,omitempty" url:"orderType,omitempty"`
	Size               string `json:"size,omitempty" url:"size,omitempty"`
	SizeUnit           string `json:"sizeUnit,omitempty" url:"sizeUnit,omitempty"`
	Price              string `json:"price,omitempty" url:"price,omitempty"`
	TimeInForce        string `json:"timeInForce,omitempty" url:"timeInForce,omitempty"`
	PostOnly           bool   `json:"postOnly" url:"postOnly"`
	ReduceOnly         bool   `json:"reduceOnly" url:"reduceOnly"`
	Stp                string `json:"stp,omitempty" url:"stp,omitempty"`
	Tags               string `json:"tags,omitempty" url:"tags,omitempty"`
	CancelAfter        int64  `json:"cancelAfter,omitempty" url:"cancelAfter,omitempty"`
	PositionSide       string `json:"positionSide,omitempty" url:"positionSide,omitempty"`
	MarginMode         string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	TpTriggerPriceType string `json:"tpTriggerPriceType,omitempty" url:"tpTriggerPriceType,omitempty"`
	TpTriggerPrice     string `json:"tpTriggerPrice,omitempty" url:"tpTriggerPrice,omitempty"`
	SlTriggerPriceType string `json:"slTriggerPriceType,omitempty" url:"slTriggerPriceType,omitempty"`
	SlTriggerPrice     string `json:"slTriggerPrice,omitempty" url:"slTriggerPrice,omitempty"`
	CloseOrder         bool   `json:"closeOrder" url:"closeOrder"`
}

// PlaceOrderResp is ported from the Java UTA SDK model.
type PlaceOrderResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	OrderId        string              `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid      string              `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	Ts             int64               `json:"ts,omitempty" url:"ts,omitempty"`
}

func (o *PlaceOrderResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
