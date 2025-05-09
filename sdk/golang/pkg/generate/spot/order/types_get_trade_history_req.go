// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

// GetTradeHistoryReq struct for GetTradeHistoryReq
type GetTradeHistoryReq struct {
	// symbol
	Symbol *string `json:"symbol,omitempty" url:"symbol,omitempty"`
	// The unique order id generated by the trading system (If orderId is specified，please ignore the other query parameters)
	OrderId *string `json:"orderId,omitempty" url:"orderId,omitempty"`
	// specify if the order is to 'buy' or 'sell'
	Side *string `json:"side,omitempty" url:"side,omitempty"`
	// specify if the order is an 'limit' order or 'market' order.
	Type *string `json:"type,omitempty" url:"type,omitempty"`
	// The id of the last set of data from the previous batch of data. By default, the latest information is given. lastId is used to filter data and paginate. If lastId is not entered, the default is a maximum of 100 returned data items. The return results include lastId，which can be used as a query parameter to look up new data from the next page.
	LastId *int64 `json:"lastId,omitempty" url:"lastId,omitempty"`
	// Default20，Max100
	Limit *int32 `json:"limit,omitempty" url:"limit,omitempty"`
	// Start time (milisecond)
	StartAt *int64 `json:"startAt,omitempty" url:"startAt,omitempty"`
	// End time (milisecond)
	EndAt *int64 `json:"endAt,omitempty" url:"endAt,omitempty"`
}

// NewGetTradeHistoryReq instantiates a new GetTradeHistoryReq object
// This constructor will assign default values to properties that have it defined
func NewGetTradeHistoryReq() *GetTradeHistoryReq {
	this := GetTradeHistoryReq{}
	var limit int32 = 20
	this.Limit = &limit
	return &this
}

// NewGetTradeHistoryReqWithDefaults instantiates a new GetTradeHistoryReq object
// This constructor will only assign default values to properties that have it defined,
func NewGetTradeHistoryReqWithDefaults() *GetTradeHistoryReq {
	this := GetTradeHistoryReq{}
	var limit int32 = 20
	this.Limit = &limit
	return &this
}

func (o *GetTradeHistoryReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["orderId"] = o.OrderId
	toSerialize["side"] = o.Side
	toSerialize["type"] = o.Type
	toSerialize["lastId"] = o.LastId
	toSerialize["limit"] = o.Limit
	toSerialize["startAt"] = o.StartAt
	toSerialize["endAt"] = o.EndAt
	return toSerialize
}

type GetTradeHistoryReqBuilder struct {
	obj *GetTradeHistoryReq
}

func NewGetTradeHistoryReqBuilder() *GetTradeHistoryReqBuilder {
	return &GetTradeHistoryReqBuilder{obj: NewGetTradeHistoryReqWithDefaults()}
}

// symbol
func (builder *GetTradeHistoryReqBuilder) SetSymbol(value string) *GetTradeHistoryReqBuilder {
	builder.obj.Symbol = &value
	return builder
}

// The unique order id generated by the trading system (If orderId is specified，please ignore the other query parameters)
func (builder *GetTradeHistoryReqBuilder) SetOrderId(value string) *GetTradeHistoryReqBuilder {
	builder.obj.OrderId = &value
	return builder
}

// specify if the order is to 'buy' or 'sell'
func (builder *GetTradeHistoryReqBuilder) SetSide(value string) *GetTradeHistoryReqBuilder {
	builder.obj.Side = &value
	return builder
}

// specify if the order is an 'limit' order or 'market' order.
func (builder *GetTradeHistoryReqBuilder) SetType(value string) *GetTradeHistoryReqBuilder {
	builder.obj.Type = &value
	return builder
}

// The id of the last set of data from the previous batch of data. By default, the latest information is given. lastId is used to filter data and paginate. If lastId is not entered, the default is a maximum of 100 returned data items. The return results include lastId，which can be used as a query parameter to look up new data from the next page.
func (builder *GetTradeHistoryReqBuilder) SetLastId(value int64) *GetTradeHistoryReqBuilder {
	builder.obj.LastId = &value
	return builder
}

// Default20，Max100
func (builder *GetTradeHistoryReqBuilder) SetLimit(value int32) *GetTradeHistoryReqBuilder {
	builder.obj.Limit = &value
	return builder
}

// Start time (milisecond)
func (builder *GetTradeHistoryReqBuilder) SetStartAt(value int64) *GetTradeHistoryReqBuilder {
	builder.obj.StartAt = &value
	return builder
}

// End time (milisecond)
func (builder *GetTradeHistoryReqBuilder) SetEndAt(value int64) *GetTradeHistoryReqBuilder {
	builder.obj.EndAt = &value
	return builder
}

func (builder *GetTradeHistoryReqBuilder) Build() *GetTradeHistoryReq {
	return builder.obj
}
