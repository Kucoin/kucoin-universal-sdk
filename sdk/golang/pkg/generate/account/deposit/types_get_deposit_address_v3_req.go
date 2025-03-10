// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package deposit

// GetDepositAddressV3Req struct for GetDepositAddressV3Req
type GetDepositAddressV3Req struct {
	// currency
	Currency *string `json:"currency,omitempty" url:"currency,omitempty"`
	// Deposit amount. This parameter is only used when applying for invoices on the Lightning Network. This parameter is invalid if it is not passed through the Lightning Network.
	Amount *string `json:"amount,omitempty" url:"amount,omitempty"`
	// The chain Id of currency.
	Chain *string `json:"chain,omitempty" url:"chain,omitempty"`
}

// NewGetDepositAddressV3Req instantiates a new GetDepositAddressV3Req object
// This constructor will assign default values to properties that have it defined
func NewGetDepositAddressV3Req() *GetDepositAddressV3Req {
	this := GetDepositAddressV3Req{}
	return &this
}

// NewGetDepositAddressV3ReqWithDefaults instantiates a new GetDepositAddressV3Req object
// This constructor will only assign default values to properties that have it defined,
func NewGetDepositAddressV3ReqWithDefaults() *GetDepositAddressV3Req {
	this := GetDepositAddressV3Req{}
	return &this
}

func (o *GetDepositAddressV3Req) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["amount"] = o.Amount
	toSerialize["chain"] = o.Chain
	return toSerialize
}

type GetDepositAddressV3ReqBuilder struct {
	obj *GetDepositAddressV3Req
}

func NewGetDepositAddressV3ReqBuilder() *GetDepositAddressV3ReqBuilder {
	return &GetDepositAddressV3ReqBuilder{obj: NewGetDepositAddressV3ReqWithDefaults()}
}

// currency
func (builder *GetDepositAddressV3ReqBuilder) SetCurrency(value string) *GetDepositAddressV3ReqBuilder {
	builder.obj.Currency = &value
	return builder
}

// Deposit amount. This parameter is only used when applying for invoices on the Lightning Network. This parameter is invalid if it is not passed through the Lightning Network.
func (builder *GetDepositAddressV3ReqBuilder) SetAmount(value string) *GetDepositAddressV3ReqBuilder {
	builder.obj.Amount = &value
	return builder
}

// The chain Id of currency.
func (builder *GetDepositAddressV3ReqBuilder) SetChain(value string) *GetDepositAddressV3ReqBuilder {
	builder.obj.Chain = &value
	return builder
}

func (builder *GetDepositAddressV3ReqBuilder) Build() *GetDepositAddressV3Req {
	return builder.obj
}
