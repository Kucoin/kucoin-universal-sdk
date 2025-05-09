// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

// GetStopOrderByClientOidData struct for GetStopOrderByClientOidData
type GetStopOrderByClientOidData struct {
	// Order ID, the ID of an order.
	Id *string `json:"id,omitempty"`
	// Symbol name
	Symbol *string `json:"symbol,omitempty"`
	// User ID
	UserId *string `json:"userId,omitempty"`
	// Order status, include NEW, TRIGGERED
	Status *string `json:"status,omitempty"`
	// Order type
	Type *string `json:"type,omitempty"`
	// transaction direction,include buy and sell
	Side *string `json:"side,omitempty"`
	// order price
	Price *string `json:"price,omitempty"`
	// order quantity
	Size *string `json:"size,omitempty"`
	// order funds
	Funds *string `json:"funds,omitempty"`
	Stp   *string `json:"stp,omitempty"`
	// time InForce,include GTC,GTT,IOC,FOK
	TimeInForce *string `json:"timeInForce,omitempty"`
	// cancel orders after n seconds，requires timeInForce to be GTT
	CancelAfter *int64 `json:"cancelAfter,omitempty"`
	// postOnly
	PostOnly *bool `json:"postOnly,omitempty"`
	// hidden order
	Hidden *bool `json:"hidden,omitempty"`
	// Iceberg order
	Iceberg *bool `json:"iceberg,omitempty"`
	// displayed quantity for iceberg order
	VisibleSize *string `json:"visibleSize,omitempty"`
	// order source
	Channel *string `json:"channel,omitempty"`
	// user-entered order unique mark
	ClientOid *string `json:"clientOid,omitempty"`
	// Remarks at stop order creation
	Remark *string `json:"remark,omitempty"`
	// tag order source
	Tags *string `json:"tags,omitempty"`
	// domainId, e.g: kucoin
	DomainId *string `json:"domainId,omitempty"`
	// trade source: USER（Order by user）, MARGIN_SYSTEM（Order by margin system）
	TradeSource *string `json:"tradeSource,omitempty"`
	// The type of trading : TRADE（Spot）, MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
	TradeType *string `json:"tradeType,omitempty"`
	// The currency of the fee
	FeeCurrency *string `json:"feeCurrency,omitempty"`
	// Fee Rate of taker
	TakerFeeRate *string `json:"takerFeeRate,omitempty"`
	// Fee Rate of maker
	MakerFeeRate *string `json:"makerFeeRate,omitempty"`
	// order creation time
	CreatedAt *int64 `json:"createdAt,omitempty"`
	// Stop order type, include loss and entry
	Stop *string `json:"stop,omitempty"`
	// The trigger time of the stop order
	StopTriggerTime *int64 `json:"stopTriggerTime,omitempty"`
	// stop price
	StopPrice *string `json:"stopPrice,omitempty"`
	// Time of place a stop order, accurate to nanoseconds
	OrderTime *int64 `json:"orderTime,omitempty"`
}

// NewGetStopOrderByClientOidData instantiates a new GetStopOrderByClientOidData object
// This constructor will assign default values to properties that have it defined
func NewGetStopOrderByClientOidData() *GetStopOrderByClientOidData {
	this := GetStopOrderByClientOidData{}
	return &this
}

// NewGetStopOrderByClientOidDataWithDefaults instantiates a new GetStopOrderByClientOidData object
// This constructor will only assign default values to properties that have it defined,
func NewGetStopOrderByClientOidDataWithDefaults() *GetStopOrderByClientOidData {
	this := GetStopOrderByClientOidData{}
	return &this
}

func (o *GetStopOrderByClientOidData) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["id"] = o.Id
	toSerialize["symbol"] = o.Symbol
	toSerialize["userId"] = o.UserId
	toSerialize["status"] = o.Status
	toSerialize["type"] = o.Type
	toSerialize["side"] = o.Side
	toSerialize["price"] = o.Price
	toSerialize["size"] = o.Size
	toSerialize["funds"] = o.Funds
	toSerialize["stp"] = o.Stp
	toSerialize["timeInForce"] = o.TimeInForce
	toSerialize["cancelAfter"] = o.CancelAfter
	toSerialize["postOnly"] = o.PostOnly
	toSerialize["hidden"] = o.Hidden
	toSerialize["iceberg"] = o.Iceberg
	toSerialize["visibleSize"] = o.VisibleSize
	toSerialize["channel"] = o.Channel
	toSerialize["clientOid"] = o.ClientOid
	toSerialize["remark"] = o.Remark
	toSerialize["tags"] = o.Tags
	toSerialize["domainId"] = o.DomainId
	toSerialize["tradeSource"] = o.TradeSource
	toSerialize["tradeType"] = o.TradeType
	toSerialize["feeCurrency"] = o.FeeCurrency
	toSerialize["takerFeeRate"] = o.TakerFeeRate
	toSerialize["makerFeeRate"] = o.MakerFeeRate
	toSerialize["createdAt"] = o.CreatedAt
	toSerialize["stop"] = o.Stop
	toSerialize["stopTriggerTime"] = o.StopTriggerTime
	toSerialize["stopPrice"] = o.StopPrice
	toSerialize["orderTime"] = o.OrderTime
	return toSerialize
}
