// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package ndbroker

// GetDepositListReq struct for GetDepositListReq
type GetDepositListReq struct {
	// currency
	Currency *string `json:"currency,omitempty" url:"currency,omitempty"`
	// Status. Available value: PROCESSING, SUCCESS, FAILURE
	Status *string `json:"status,omitempty" url:"status,omitempty"`
	// hash
	Hash *string `json:"hash,omitempty" url:"hash,omitempty"`
	// Start time (milliseconds)
	StartTimestamp *int64 `json:"startTimestamp,omitempty" url:"startTimestamp,omitempty"`
	// End time (milliseconds); default sorting in descending order
	EndTimestamp *int64 `json:"endTimestamp,omitempty" url:"endTimestamp,omitempty"`
	// Maximum number of returned items, maximum 1000, default 1000
	Limit *int32 `json:"limit,omitempty" url:"limit,omitempty"`
}

// NewGetDepositListReq instantiates a new GetDepositListReq object
// This constructor will assign default values to properties that have it defined
func NewGetDepositListReq() *GetDepositListReq {
	this := GetDepositListReq{}
	var limit int32 = 1000
	this.Limit = &limit
	return &this
}

// NewGetDepositListReqWithDefaults instantiates a new GetDepositListReq object
// This constructor will only assign default values to properties that have it defined,
func NewGetDepositListReqWithDefaults() *GetDepositListReq {
	this := GetDepositListReq{}
	var limit int32 = 1000
	this.Limit = &limit
	return &this
}

func (o *GetDepositListReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["status"] = o.Status
	toSerialize["hash"] = o.Hash
	toSerialize["startTimestamp"] = o.StartTimestamp
	toSerialize["endTimestamp"] = o.EndTimestamp
	toSerialize["limit"] = o.Limit
	return toSerialize
}

type GetDepositListReqBuilder struct {
	obj *GetDepositListReq
}

func NewGetDepositListReqBuilder() *GetDepositListReqBuilder {
	return &GetDepositListReqBuilder{obj: NewGetDepositListReqWithDefaults()}
}

// currency
func (builder *GetDepositListReqBuilder) SetCurrency(value string) *GetDepositListReqBuilder {
	builder.obj.Currency = &value
	return builder
}

// Status. Available value: PROCESSING, SUCCESS, FAILURE
func (builder *GetDepositListReqBuilder) SetStatus(value string) *GetDepositListReqBuilder {
	builder.obj.Status = &value
	return builder
}

// hash
func (builder *GetDepositListReqBuilder) SetHash(value string) *GetDepositListReqBuilder {
	builder.obj.Hash = &value
	return builder
}

// Start time (milliseconds)
func (builder *GetDepositListReqBuilder) SetStartTimestamp(value int64) *GetDepositListReqBuilder {
	builder.obj.StartTimestamp = &value
	return builder
}

// End time (milliseconds); default sorting in descending order
func (builder *GetDepositListReqBuilder) SetEndTimestamp(value int64) *GetDepositListReqBuilder {
	builder.obj.EndTimestamp = &value
	return builder
}

// Maximum number of returned items, maximum 1000, default 1000
func (builder *GetDepositListReqBuilder) SetLimit(value int32) *GetDepositListReqBuilder {
	builder.obj.Limit = &value
	return builder
}

func (builder *GetDepositListReqBuilder) Build() *GetDepositListReq {
	return builder.obj
}
