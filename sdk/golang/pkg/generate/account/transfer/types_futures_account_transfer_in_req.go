// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package transfer

// FuturesAccountTransferInReq struct for FuturesAccountTransferInReq
type FuturesAccountTransferInReq struct {
	// Currency, including XBT, USDT...
	Currency string `json:"currency,omitempty"`
	// Amount to be transferred in
	Amount float64 `json:"amount,omitempty"`
	// Payment account type, including MAIN, TRADE
	PayAccountType string `json:"payAccountType,omitempty"`
}

// NewFuturesAccountTransferInReq instantiates a new FuturesAccountTransferInReq object
// This constructor will assign default values to properties that have it defined
func NewFuturesAccountTransferInReq(currency string, amount float64, payAccountType string) *FuturesAccountTransferInReq {
	this := FuturesAccountTransferInReq{}
	this.Currency = currency
	this.Amount = amount
	this.PayAccountType = payAccountType
	return &this
}

// NewFuturesAccountTransferInReqWithDefaults instantiates a new FuturesAccountTransferInReq object
// This constructor will only assign default values to properties that have it defined,
func NewFuturesAccountTransferInReqWithDefaults() *FuturesAccountTransferInReq {
	this := FuturesAccountTransferInReq{}
	return &this
}

func (o *FuturesAccountTransferInReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["amount"] = o.Amount
	toSerialize["payAccountType"] = o.PayAccountType
	return toSerialize
}

type FuturesAccountTransferInReqBuilder struct {
	obj *FuturesAccountTransferInReq
}

func NewFuturesAccountTransferInReqBuilder() *FuturesAccountTransferInReqBuilder {
	return &FuturesAccountTransferInReqBuilder{obj: NewFuturesAccountTransferInReqWithDefaults()}
}

// Currency, including XBT, USDT...
func (builder *FuturesAccountTransferInReqBuilder) SetCurrency(value string) *FuturesAccountTransferInReqBuilder {
	builder.obj.Currency = value
	return builder
}

// Amount to be transferred in
func (builder *FuturesAccountTransferInReqBuilder) SetAmount(value float64) *FuturesAccountTransferInReqBuilder {
	builder.obj.Amount = value
	return builder
}

// Payment account type, including MAIN, TRADE
func (builder *FuturesAccountTransferInReqBuilder) SetPayAccountType(value string) *FuturesAccountTransferInReqBuilder {
	builder.obj.PayAccountType = value
	return builder
}

func (builder *FuturesAccountTransferInReqBuilder) Build() *FuturesAccountTransferInReq {
	return builder.obj
}
