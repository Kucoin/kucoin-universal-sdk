// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package deposit

// GetDepositAddressV2Req struct for GetDepositAddressV2Req
type GetDepositAddressV2Req struct {
	// currency
	Currency *string `json:"currency,omitempty" url:"currency,omitempty"`
	// Chain ID of currency
	Chain *string `json:"chain,omitempty" url:"chain,omitempty"`
}

// NewGetDepositAddressV2Req instantiates a new GetDepositAddressV2Req object
// This constructor will assign default values to properties that have it defined
func NewGetDepositAddressV2Req() *GetDepositAddressV2Req {
	this := GetDepositAddressV2Req{}
	return &this
}

// NewGetDepositAddressV2ReqWithDefaults instantiates a new GetDepositAddressV2Req object
// This constructor will only assign default values to properties that have it defined,
func NewGetDepositAddressV2ReqWithDefaults() *GetDepositAddressV2Req {
	this := GetDepositAddressV2Req{}
	return &this
}

func (o *GetDepositAddressV2Req) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["chain"] = o.Chain
	return toSerialize
}

type GetDepositAddressV2ReqBuilder struct {
	obj *GetDepositAddressV2Req
}

func NewGetDepositAddressV2ReqBuilder() *GetDepositAddressV2ReqBuilder {
	return &GetDepositAddressV2ReqBuilder{obj: NewGetDepositAddressV2ReqWithDefaults()}
}

// currency
func (builder *GetDepositAddressV2ReqBuilder) SetCurrency(value string) *GetDepositAddressV2ReqBuilder {
	builder.obj.Currency = &value
	return builder
}

// Chain ID of currency
func (builder *GetDepositAddressV2ReqBuilder) SetChain(value string) *GetDepositAddressV2ReqBuilder {
	builder.obj.Chain = &value
	return builder
}

func (builder *GetDepositAddressV2ReqBuilder) Build() *GetDepositAddressV2Req {
	return builder.obj
}
