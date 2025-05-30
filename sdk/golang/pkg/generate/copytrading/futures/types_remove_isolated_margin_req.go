// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package futures

// RemoveIsolatedMarginReq struct for RemoveIsolatedMarginReq
type RemoveIsolatedMarginReq struct {
	// Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
	Symbol string `json:"symbol,omitempty"`
	// The size of the position that can be deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
	WithdrawAmount float64 `json:"withdrawAmount,omitempty"`
}

// NewRemoveIsolatedMarginReq instantiates a new RemoveIsolatedMarginReq object
// This constructor will assign default values to properties that have it defined
func NewRemoveIsolatedMarginReq(symbol string, withdrawAmount float64) *RemoveIsolatedMarginReq {
	this := RemoveIsolatedMarginReq{}
	this.Symbol = symbol
	this.WithdrawAmount = withdrawAmount
	return &this
}

// NewRemoveIsolatedMarginReqWithDefaults instantiates a new RemoveIsolatedMarginReq object
// This constructor will only assign default values to properties that have it defined,
func NewRemoveIsolatedMarginReqWithDefaults() *RemoveIsolatedMarginReq {
	this := RemoveIsolatedMarginReq{}
	return &this
}

func (o *RemoveIsolatedMarginReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["withdrawAmount"] = o.WithdrawAmount
	return toSerialize
}

type RemoveIsolatedMarginReqBuilder struct {
	obj *RemoveIsolatedMarginReq
}

func NewRemoveIsolatedMarginReqBuilder() *RemoveIsolatedMarginReqBuilder {
	return &RemoveIsolatedMarginReqBuilder{obj: NewRemoveIsolatedMarginReqWithDefaults()}
}

// Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
func (builder *RemoveIsolatedMarginReqBuilder) SetSymbol(value string) *RemoveIsolatedMarginReqBuilder {
	builder.obj.Symbol = value
	return builder
}

// The size of the position that can be deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
func (builder *RemoveIsolatedMarginReqBuilder) SetWithdrawAmount(value float64) *RemoveIsolatedMarginReqBuilder {
	builder.obj.WithdrawAmount = value
	return builder
}

func (builder *RemoveIsolatedMarginReqBuilder) Build() *RemoveIsolatedMarginReq {
	return builder.obj
}
