// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package futures

// AddTPSLOrderReq struct for AddTPSLOrderReq
type AddTPSLOrderReq struct {
	// Unique order id created by users to identify their orders, the maximum length cannot exceed 40, e.g. UUID, Only allows numbers, characters, underline(_), and separator(-)
	ClientOid string `json:"clientOid,omitempty"`
	// specify if the order is to 'buy' or 'sell'
	Side string `json:"side,omitempty"`
	// Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
	Symbol string `json:"symbol,omitempty"`
	// Used to calculate the margin to be frozen for the order. If you are to close the position, this parameter is not required.
	Leverage int32 `json:"leverage,omitempty"`
	// specify if the order is an 'limit' order or 'market' order
	Type string `json:"type,omitempty"`
	// remark for the order, length cannot exceed 100 utf8 characters
	Remark *string `json:"remark,omitempty"`
	// Either 'TP', 'IP' or 'MP'
	StopPriceType *string `json:"stopPriceType,omitempty"`
	// A mark to reduce the position size only. Set to false by default. Need to set the position size when reduceOnly is true. If set to true, only the orders reducing the position size will be executed. If the reduce-only order size exceeds the position size, the extra size will be canceled.
	ReduceOnly *bool `json:"reduceOnly,omitempty"`
	// A mark to close the position. Set to false by default. If closeOrder is set to true, the system will close the position and the position size will become 0. Side, Size and Leverage fields can be left empty and the system will determine the side and size automatically.
	CloseOrder *bool `json:"closeOrder,omitempty"`
	// A mark to forcely hold the funds for an order, even though it's an order to reduce the position size. This helps the order stay on the order book and not get canceled when the position size changes. Set to false by default. The system will forcely freeze certain amount of funds for this order, including orders whose direction is opposite to the current positions. This feature is to ensure that the order won’t be canceled by the matching engine in such a circumstance that not enough funds are frozen for the order.
	ForceHold *bool `json:"forceHold,omitempty"`
	// Margin mode: ISOLATED, CROSS, default: ISOLATED
	MarginMode *string `json:"marginMode,omitempty"`
	// Required for type is 'limit' order, indicating the operating price
	Price *string `json:"price,omitempty"`
	// Order size (Lot), must be a positive integer. The quantity unit of coin-swap contracts is size(lot), and other units are not supported.
	Size int32 `json:"size,omitempty"`
	// Optional for type is 'limit' order, [Time in force](https://www.kucoin.com/docs-new/doc-338146) is a special strategy used during trading, default is GTC
	TimeInForce *string `json:"timeInForce,omitempty"`
	// Optional for type is 'limit' order,  post only flag, invalid when timeInForce is IOC. When postOnly is true, not allowed choose hidden or iceberg. The post-only flag ensures that the trader always pays the maker fee and provides liquidity to the order book. If any part of the order is going to pay taker fee, the order will be fully rejected.
	PostOnly *bool `json:"postOnly,omitempty"`
	// Optional for type is 'limit' order, orders not displaying in order book. When hidden chose, not allowed choose postOnly.
	Hidden *bool `json:"hidden,omitempty"`
	// Optional for type is 'limit' order, Only visible portion of the order is displayed in the order book. When iceberg chose, not allowed choose postOnly.
	Iceberg *bool `json:"iceberg,omitempty"`
	// Optional for type is 'limit' order, The maximum visible size of an iceberg order. please place order in size (lots), The units of qty (base currency) and valueQty (value) are not supported.
	VisibleSize *string `json:"visibleSize,omitempty"`
	// Take profit price
	TriggerStopUpPrice *string `json:"triggerStopUpPrice,omitempty"`
	// Stop loss price
	TriggerStopDownPrice *string `json:"triggerStopDownPrice,omitempty"`
}

// NewAddTPSLOrderReq instantiates a new AddTPSLOrderReq object
// This constructor will assign default values to properties that have it defined
func NewAddTPSLOrderReq(clientOid string, side string, symbol string, leverage int32, Type_ string, size int32) *AddTPSLOrderReq {
	this := AddTPSLOrderReq{}
	this.ClientOid = clientOid
	this.Side = side
	this.Symbol = symbol
	this.Leverage = leverage
	this.Type = Type_
	var reduceOnly bool = false
	this.ReduceOnly = &reduceOnly
	var closeOrder bool = false
	this.CloseOrder = &closeOrder
	var forceHold bool = false
	this.ForceHold = &forceHold
	var marginMode string = "ISOLATED"
	this.MarginMode = &marginMode
	this.Size = size
	var timeInForce string = "GTC"
	this.TimeInForce = &timeInForce
	var postOnly bool = false
	this.PostOnly = &postOnly
	var hidden bool = false
	this.Hidden = &hidden
	var iceberg bool = false
	this.Iceberg = &iceberg
	return &this
}

// NewAddTPSLOrderReqWithDefaults instantiates a new AddTPSLOrderReq object
// This constructor will only assign default values to properties that have it defined,
func NewAddTPSLOrderReqWithDefaults() *AddTPSLOrderReq {
	this := AddTPSLOrderReq{}
	var Type_ string = "limit"
	this.Type = Type_
	var reduceOnly bool = false
	this.ReduceOnly = &reduceOnly
	var closeOrder bool = false
	this.CloseOrder = &closeOrder
	var forceHold bool = false
	this.ForceHold = &forceHold
	var marginMode string = "ISOLATED"
	this.MarginMode = &marginMode
	var timeInForce string = "GTC"
	this.TimeInForce = &timeInForce
	var postOnly bool = false
	this.PostOnly = &postOnly
	var hidden bool = false
	this.Hidden = &hidden
	var iceberg bool = false
	this.Iceberg = &iceberg
	return &this
}

func (o *AddTPSLOrderReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["clientOid"] = o.ClientOid
	toSerialize["side"] = o.Side
	toSerialize["symbol"] = o.Symbol
	toSerialize["leverage"] = o.Leverage
	toSerialize["type"] = o.Type
	toSerialize["remark"] = o.Remark
	toSerialize["stopPriceType"] = o.StopPriceType
	toSerialize["reduceOnly"] = o.ReduceOnly
	toSerialize["closeOrder"] = o.CloseOrder
	toSerialize["forceHold"] = o.ForceHold
	toSerialize["marginMode"] = o.MarginMode
	toSerialize["price"] = o.Price
	toSerialize["size"] = o.Size
	toSerialize["timeInForce"] = o.TimeInForce
	toSerialize["postOnly"] = o.PostOnly
	toSerialize["hidden"] = o.Hidden
	toSerialize["iceberg"] = o.Iceberg
	toSerialize["visibleSize"] = o.VisibleSize
	toSerialize["triggerStopUpPrice"] = o.TriggerStopUpPrice
	toSerialize["triggerStopDownPrice"] = o.TriggerStopDownPrice
	return toSerialize
}

type AddTPSLOrderReqBuilder struct {
	obj *AddTPSLOrderReq
}

func NewAddTPSLOrderReqBuilder() *AddTPSLOrderReqBuilder {
	return &AddTPSLOrderReqBuilder{obj: NewAddTPSLOrderReqWithDefaults()}
}

// Unique order id created by users to identify their orders, the maximum length cannot exceed 40, e.g. UUID, Only allows numbers, characters, underline(_), and separator(-)
func (builder *AddTPSLOrderReqBuilder) SetClientOid(value string) *AddTPSLOrderReqBuilder {
	builder.obj.ClientOid = value
	return builder
}

// specify if the order is to 'buy' or 'sell'
func (builder *AddTPSLOrderReqBuilder) SetSide(value string) *AddTPSLOrderReqBuilder {
	builder.obj.Side = value
	return builder
}

// Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
func (builder *AddTPSLOrderReqBuilder) SetSymbol(value string) *AddTPSLOrderReqBuilder {
	builder.obj.Symbol = value
	return builder
}

// Used to calculate the margin to be frozen for the order. If you are to close the position, this parameter is not required.
func (builder *AddTPSLOrderReqBuilder) SetLeverage(value int32) *AddTPSLOrderReqBuilder {
	builder.obj.Leverage = value
	return builder
}

// specify if the order is an 'limit' order or 'market' order
func (builder *AddTPSLOrderReqBuilder) SetType(value string) *AddTPSLOrderReqBuilder {
	builder.obj.Type = value
	return builder
}

// remark for the order, length cannot exceed 100 utf8 characters
func (builder *AddTPSLOrderReqBuilder) SetRemark(value string) *AddTPSLOrderReqBuilder {
	builder.obj.Remark = &value
	return builder
}

// Either 'TP', 'IP' or 'MP'
func (builder *AddTPSLOrderReqBuilder) SetStopPriceType(value string) *AddTPSLOrderReqBuilder {
	builder.obj.StopPriceType = &value
	return builder
}

// A mark to reduce the position size only. Set to false by default. Need to set the position size when reduceOnly is true. If set to true, only the orders reducing the position size will be executed. If the reduce-only order size exceeds the position size, the extra size will be canceled.
func (builder *AddTPSLOrderReqBuilder) SetReduceOnly(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.ReduceOnly = &value
	return builder
}

// A mark to close the position. Set to false by default. If closeOrder is set to true, the system will close the position and the position size will become 0. Side, Size and Leverage fields can be left empty and the system will determine the side and size automatically.
func (builder *AddTPSLOrderReqBuilder) SetCloseOrder(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.CloseOrder = &value
	return builder
}

// A mark to forcely hold the funds for an order, even though it's an order to reduce the position size. This helps the order stay on the order book and not get canceled when the position size changes. Set to false by default. The system will forcely freeze certain amount of funds for this order, including orders whose direction is opposite to the current positions. This feature is to ensure that the order won’t be canceled by the matching engine in such a circumstance that not enough funds are frozen for the order.
func (builder *AddTPSLOrderReqBuilder) SetForceHold(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.ForceHold = &value
	return builder
}

// Margin mode: ISOLATED, CROSS, default: ISOLATED
func (builder *AddTPSLOrderReqBuilder) SetMarginMode(value string) *AddTPSLOrderReqBuilder {
	builder.obj.MarginMode = &value
	return builder
}

// Required for type is 'limit' order, indicating the operating price
func (builder *AddTPSLOrderReqBuilder) SetPrice(value string) *AddTPSLOrderReqBuilder {
	builder.obj.Price = &value
	return builder
}

// Order size (Lot), must be a positive integer. The quantity unit of coin-swap contracts is size(lot), and other units are not supported.
func (builder *AddTPSLOrderReqBuilder) SetSize(value int32) *AddTPSLOrderReqBuilder {
	builder.obj.Size = value
	return builder
}

// Optional for type is 'limit' order, [Time in force](https://www.kucoin.com/docs-new/doc-338146) is a special strategy used during trading, default is GTC
func (builder *AddTPSLOrderReqBuilder) SetTimeInForce(value string) *AddTPSLOrderReqBuilder {
	builder.obj.TimeInForce = &value
	return builder
}

// Optional for type is 'limit' order,  post only flag, invalid when timeInForce is IOC. When postOnly is true, not allowed choose hidden or iceberg. The post-only flag ensures that the trader always pays the maker fee and provides liquidity to the order book. If any part of the order is going to pay taker fee, the order will be fully rejected.
func (builder *AddTPSLOrderReqBuilder) SetPostOnly(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.PostOnly = &value
	return builder
}

// Optional for type is 'limit' order, orders not displaying in order book. When hidden chose, not allowed choose postOnly.
func (builder *AddTPSLOrderReqBuilder) SetHidden(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.Hidden = &value
	return builder
}

// Optional for type is 'limit' order, Only visible portion of the order is displayed in the order book. When iceberg chose, not allowed choose postOnly.
func (builder *AddTPSLOrderReqBuilder) SetIceberg(value bool) *AddTPSLOrderReqBuilder {
	builder.obj.Iceberg = &value
	return builder
}

// Optional for type is 'limit' order, The maximum visible size of an iceberg order. please place order in size (lots), The units of qty (base currency) and valueQty (value) are not supported.
func (builder *AddTPSLOrderReqBuilder) SetVisibleSize(value string) *AddTPSLOrderReqBuilder {
	builder.obj.VisibleSize = &value
	return builder
}

// Take profit price
func (builder *AddTPSLOrderReqBuilder) SetTriggerStopUpPrice(value string) *AddTPSLOrderReqBuilder {
	builder.obj.TriggerStopUpPrice = &value
	return builder
}

// Stop loss price
func (builder *AddTPSLOrderReqBuilder) SetTriggerStopDownPrice(value string) *AddTPSLOrderReqBuilder {
	builder.obj.TriggerStopDownPrice = &value
	return builder
}

func (builder *AddTPSLOrderReqBuilder) Build() *AddTPSLOrderReq {
	return builder.obj
}