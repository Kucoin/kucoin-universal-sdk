// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

// CancelAllOrdersReq struct for CancelAllOrdersReq
type CancelAllOrdersReq struct {
	// Cancel all limit orders for a specific contract only,  If not specified, all the limit orders will be deleted, Please refer to [Get Symbol endpoint: symbol](apidog://link/endpoint/3470220)
	Symbol *string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// NewCancelAllOrdersReq instantiates a new CancelAllOrdersReq object
// This constructor will assign default values to properties that have it defined
func NewCancelAllOrdersReq() *CancelAllOrdersReq {
	this := CancelAllOrdersReq{}
	return &this
}

// NewCancelAllOrdersReqWithDefaults instantiates a new CancelAllOrdersReq object
// This constructor will only assign default values to properties that have it defined,
func NewCancelAllOrdersReqWithDefaults() *CancelAllOrdersReq {
	this := CancelAllOrdersReq{}
	return &this
}

func (o *CancelAllOrdersReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	return toSerialize
}

type CancelAllOrdersReqBuilder struct {
	obj *CancelAllOrdersReq
}

func NewCancelAllOrdersReqBuilder() *CancelAllOrdersReqBuilder {
	return &CancelAllOrdersReqBuilder{obj: NewCancelAllOrdersReqWithDefaults()}
}

// Cancel all limit orders for a specific contract only,  If not specified, all the limit orders will be deleted, Please refer to [Get Symbol endpoint: symbol](apidog://link/endpoint/3470220)
func (builder *CancelAllOrdersReqBuilder) SetSymbol(value string) *CancelAllOrdersReqBuilder {
	builder.obj.Symbol = &value
	return builder
}

func (builder *CancelAllOrdersReqBuilder) Build() *CancelAllOrdersReq {
	return builder.obj
}
