// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package market

// GetFiatPriceReq struct for GetFiatPriceReq
type GetFiatPriceReq struct {
	// Ticker symbol of a base currency, e.g. USD, EUR. Default is USD
	Base *string `json:"base,omitempty" url:"base,omitempty"`
	// Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
	Currencies *string `json:"currencies,omitempty" url:"currencies,omitempty"`
}

// NewGetFiatPriceReq instantiates a new GetFiatPriceReq object
// This constructor will assign default values to properties that have it defined
func NewGetFiatPriceReq() *GetFiatPriceReq {
	this := GetFiatPriceReq{}
	var base string = "USD"
	this.Base = &base
	return &this
}

// NewGetFiatPriceReqWithDefaults instantiates a new GetFiatPriceReq object
// This constructor will only assign default values to properties that have it defined,
func NewGetFiatPriceReqWithDefaults() *GetFiatPriceReq {
	this := GetFiatPriceReq{}
	var base string = "USD"
	this.Base = &base
	return &this
}

func (o *GetFiatPriceReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["base"] = o.Base
	toSerialize["currencies"] = o.Currencies
	return toSerialize
}

type GetFiatPriceReqBuilder struct {
	obj *GetFiatPriceReq
}

func NewGetFiatPriceReqBuilder() *GetFiatPriceReqBuilder {
	return &GetFiatPriceReqBuilder{obj: NewGetFiatPriceReqWithDefaults()}
}

// Ticker symbol of a base currency, e.g. USD, EUR. Default is USD
func (builder *GetFiatPriceReqBuilder) SetBase(value string) *GetFiatPriceReqBuilder {
	builder.obj.Base = &value
	return builder
}

// Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
func (builder *GetFiatPriceReqBuilder) SetCurrencies(value string) *GetFiatPriceReqBuilder {
	builder.obj.Currencies = &value
	return builder
}

func (builder *GetFiatPriceReqBuilder) Build() *GetFiatPriceReq {
	return builder.obj
}
