// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

// BatchAddOrdersOldData struct for BatchAddOrdersOldData
type BatchAddOrdersOldData struct {
	Symbol      string `json:"symbol,omitempty"`
	Type        string `json:"type,omitempty"`
	Side        string `json:"side,omitempty"`
	Price       string `json:"price,omitempty"`
	Size        string `json:"size,omitempty"`
	Funds       string `json:"funds,omitempty"`
	Stp         string `json:"stp,omitempty"`
	Stop        string `json:"stop,omitempty"`
	StopPrice   string `json:"stopPrice,omitempty"`
	TimeInForce string `json:"timeInForce,omitempty"`
	CancelAfter int32  `json:"cancelAfter,omitempty"`
	PostOnly    bool   `json:"postOnly,omitempty"`
	Hidden      bool   `json:"hidden,omitempty"`
	Iceberge    bool   `json:"iceberge,omitempty"`
	Iceberg     bool   `json:"iceberg,omitempty"`
	VisibleSize string `json:"visibleSize,omitempty"`
	Channel     string `json:"channel,omitempty"`
	Id          string `json:"id,omitempty"`
	Status      string `json:"status,omitempty"`
	FailMsg     string `json:"failMsg,omitempty"`
	ClientOid   string `json:"clientOid,omitempty"`
}

// NewBatchAddOrdersOldData instantiates a new BatchAddOrdersOldData object
// This constructor will assign default values to properties that have it defined
func NewBatchAddOrdersOldData(symbol string, Type_ string, side string, price string, size string, funds string, stp string, stop string, stopPrice string, timeInForce string, cancelAfter int32, postOnly bool, hidden bool, iceberge bool, iceberg bool, visibleSize string, channel string, id string, status string, failMsg string, clientOid string) *BatchAddOrdersOldData {
	this := BatchAddOrdersOldData{}
	this.Symbol = symbol
	this.Type = Type_
	this.Side = side
	this.Price = price
	this.Size = size
	this.Funds = funds
	this.Stp = stp
	this.Stop = stop
	this.StopPrice = stopPrice
	this.TimeInForce = timeInForce
	this.CancelAfter = cancelAfter
	this.PostOnly = postOnly
	this.Hidden = hidden
	this.Iceberge = iceberge
	this.Iceberg = iceberg
	this.VisibleSize = visibleSize
	this.Channel = channel
	this.Id = id
	this.Status = status
	this.FailMsg = failMsg
	this.ClientOid = clientOid
	return &this
}

// NewBatchAddOrdersOldDataWithDefaults instantiates a new BatchAddOrdersOldData object
// This constructor will only assign default values to properties that have it defined,
func NewBatchAddOrdersOldDataWithDefaults() *BatchAddOrdersOldData {
	this := BatchAddOrdersOldData{}
	return &this
}

func (o *BatchAddOrdersOldData) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["type"] = o.Type
	toSerialize["side"] = o.Side
	toSerialize["price"] = o.Price
	toSerialize["size"] = o.Size
	toSerialize["funds"] = o.Funds
	toSerialize["stp"] = o.Stp
	toSerialize["stop"] = o.Stop
	toSerialize["stopPrice"] = o.StopPrice
	toSerialize["timeInForce"] = o.TimeInForce
	toSerialize["cancelAfter"] = o.CancelAfter
	toSerialize["postOnly"] = o.PostOnly
	toSerialize["hidden"] = o.Hidden
	toSerialize["iceberge"] = o.Iceberge
	toSerialize["iceberg"] = o.Iceberg
	toSerialize["visibleSize"] = o.VisibleSize
	toSerialize["channel"] = o.Channel
	toSerialize["id"] = o.Id
	toSerialize["status"] = o.Status
	toSerialize["failMsg"] = o.FailMsg
	toSerialize["clientOid"] = o.ClientOid
	return toSerialize
}
