// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package credit

// ModifyPurchaseReq struct for ModifyPurchaseReq
type ModifyPurchaseReq struct {
	// Currency
	Currency string `json:"currency,omitempty"`
	// Modified purchase interest rate
	InterestRate string `json:"interestRate,omitempty"`
	// Purchase order ID
	PurchaseOrderNo string `json:"purchaseOrderNo,omitempty"`
}

// NewModifyPurchaseReq instantiates a new ModifyPurchaseReq object
// This constructor will assign default values to properties that have it defined
func NewModifyPurchaseReq(currency string, interestRate string, purchaseOrderNo string) *ModifyPurchaseReq {
	this := ModifyPurchaseReq{}
	this.Currency = currency
	this.InterestRate = interestRate
	this.PurchaseOrderNo = purchaseOrderNo
	return &this
}

// NewModifyPurchaseReqWithDefaults instantiates a new ModifyPurchaseReq object
// This constructor will only assign default values to properties that have it defined,
func NewModifyPurchaseReqWithDefaults() *ModifyPurchaseReq {
	this := ModifyPurchaseReq{}
	return &this
}

func (o *ModifyPurchaseReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["interestRate"] = o.InterestRate
	toSerialize["purchaseOrderNo"] = o.PurchaseOrderNo
	return toSerialize
}

type ModifyPurchaseReqBuilder struct {
	obj *ModifyPurchaseReq
}

func NewModifyPurchaseReqBuilder() *ModifyPurchaseReqBuilder {
	return &ModifyPurchaseReqBuilder{obj: NewModifyPurchaseReqWithDefaults()}
}

// Currency
func (builder *ModifyPurchaseReqBuilder) SetCurrency(value string) *ModifyPurchaseReqBuilder {
	builder.obj.Currency = value
	return builder
}

// Modified purchase interest rate
func (builder *ModifyPurchaseReqBuilder) SetInterestRate(value string) *ModifyPurchaseReqBuilder {
	builder.obj.InterestRate = value
	return builder
}

// Purchase order ID
func (builder *ModifyPurchaseReqBuilder) SetPurchaseOrderNo(value string) *ModifyPurchaseReqBuilder {
	builder.obj.PurchaseOrderNo = value
	return builder
}

func (builder *ModifyPurchaseReqBuilder) Build() *ModifyPurchaseReq {
	return builder.obj
}
