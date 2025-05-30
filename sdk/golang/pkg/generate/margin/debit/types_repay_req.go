// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package debit

// RepayReq struct for RepayReq
type RepayReq struct {
	// currency
	Currency string `json:"currency,omitempty"`
	// Borrow amount
	Size float64 `json:"size,omitempty"`
	// symbol, mandatory for isolated margin account
	Symbol *string `json:"symbol,omitempty"`
	// true-isolated, false-cross; default is false
	IsIsolated *bool `json:"isIsolated,omitempty"`
	// true: high frequency borrowing, false: low frequency borrowing; default false
	IsHf *bool `json:"isHf,omitempty"`
}

// NewRepayReq instantiates a new RepayReq object
// This constructor will assign default values to properties that have it defined
func NewRepayReq(currency string, size float64) *RepayReq {
	this := RepayReq{}
	this.Currency = currency
	this.Size = size
	var isIsolated bool = false
	this.IsIsolated = &isIsolated
	var isHf bool = false
	this.IsHf = &isHf
	return &this
}

// NewRepayReqWithDefaults instantiates a new RepayReq object
// This constructor will only assign default values to properties that have it defined,
func NewRepayReqWithDefaults() *RepayReq {
	this := RepayReq{}
	var isIsolated bool = false
	this.IsIsolated = &isIsolated
	var isHf bool = false
	this.IsHf = &isHf
	return &this
}

func (o *RepayReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["size"] = o.Size
	toSerialize["symbol"] = o.Symbol
	toSerialize["isIsolated"] = o.IsIsolated
	toSerialize["isHf"] = o.IsHf
	return toSerialize
}

type RepayReqBuilder struct {
	obj *RepayReq
}

func NewRepayReqBuilder() *RepayReqBuilder {
	return &RepayReqBuilder{obj: NewRepayReqWithDefaults()}
}

// currency
func (builder *RepayReqBuilder) SetCurrency(value string) *RepayReqBuilder {
	builder.obj.Currency = value
	return builder
}

// Borrow amount
func (builder *RepayReqBuilder) SetSize(value float64) *RepayReqBuilder {
	builder.obj.Size = value
	return builder
}

// symbol, mandatory for isolated margin account
func (builder *RepayReqBuilder) SetSymbol(value string) *RepayReqBuilder {
	builder.obj.Symbol = &value
	return builder
}

// true-isolated, false-cross; default is false
func (builder *RepayReqBuilder) SetIsIsolated(value bool) *RepayReqBuilder {
	builder.obj.IsIsolated = &value
	return builder
}

// true: high frequency borrowing, false: low frequency borrowing; default false
func (builder *RepayReqBuilder) SetIsHf(value bool) *RepayReqBuilder {
	builder.obj.IsHf = &value
	return builder
}

func (builder *RepayReqBuilder) Build() *RepayReq {
	return builder.obj
}
