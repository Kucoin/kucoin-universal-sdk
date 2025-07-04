// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package spotprivate

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// StopOrderEvent struct for StopOrderEvent
type StopOrderEvent struct {
	// common response
	CommonResponse *types.WsMessage
	// Order created time (milliseconds)
	CreatedAt int64 `json:"createdAt,omitempty"`
	// The unique order id generated by the trading system
	OrderId string `json:"orderId,omitempty"`
	// Price
	OrderPrice string `json:"orderPrice,omitempty"`
	// User-specified order type
	OrderType string `json:"orderType,omitempty"`
	// buy or sell
	Side string `json:"side,omitempty"`
	// User-specified order size
	Size string `json:"size,omitempty"`
	// Order type
	Stop string `json:"stop,omitempty"`
	// Stop Price
	StopPrice string `json:"stopPrice,omitempty"`
	// symbol
	Symbol string `json:"symbol,omitempty"`
	// The type of trading: TRADE (Spot), MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
	TradeType string `json:"tradeType,omitempty"`
	// Push time (nanoseconds)
	Ts int64 `json:"ts,omitempty"`
	// Order Type
	Type string `json:"type,omitempty"`
}

// NewStopOrderEvent instantiates a new StopOrderEvent object
// This constructor will assign default values to properties that have it defined
func NewStopOrderEvent(createdAt int64, orderId string, orderPrice string, orderType string, side string, size string, stop string, stopPrice string, symbol string, tradeType string, ts int64, Type_ string) *StopOrderEvent {
	this := StopOrderEvent{}
	this.CreatedAt = createdAt
	this.OrderId = orderId
	this.OrderPrice = orderPrice
	this.OrderType = orderType
	this.Side = side
	this.Size = size
	this.Stop = stop
	this.StopPrice = stopPrice
	this.Symbol = symbol
	this.TradeType = tradeType
	this.Ts = ts
	this.Type = Type_
	return &this
}

// NewStopOrderEventWithDefaults instantiates a new StopOrderEvent object
// This constructor will only assign default values to properties that have it defined,
func NewStopOrderEventWithDefaults() *StopOrderEvent {
	this := StopOrderEvent{}
	return &this
}

func (o *StopOrderEvent) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["createdAt"] = o.CreatedAt
	toSerialize["orderId"] = o.OrderId
	toSerialize["orderPrice"] = o.OrderPrice
	toSerialize["orderType"] = o.OrderType
	toSerialize["side"] = o.Side
	toSerialize["size"] = o.Size
	toSerialize["stop"] = o.Stop
	toSerialize["stopPrice"] = o.StopPrice
	toSerialize["symbol"] = o.Symbol
	toSerialize["tradeType"] = o.TradeType
	toSerialize["ts"] = o.Ts
	toSerialize["type"] = o.Type
	return toSerialize
}

type StopOrderEventCallback func(topic string, subject string, data *StopOrderEvent) error

type StopOrderEventCallbackWrapper struct {
	callback StopOrderEventCallback
}

func (w *StopOrderEventCallbackWrapper) OnMessage(msg *types.WsMessage) error {
	obj := &StopOrderEvent{}
	err := json.Unmarshal(msg.RawData, obj)
	if err != nil {
		return err
	}
	obj.CommonResponse = msg
	return w.callback(msg.Topic, msg.Subject, obj)
}
