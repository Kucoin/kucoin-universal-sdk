// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package account

// GetMarginHFLedgerReq struct for GetMarginHFLedgerReq
type GetMarginHFLedgerReq struct {
	// Currency optional; more than one can be selected; separate using commas; select no more than 10 currencies; the default will be to query for all currencies if left empty
	Currency *string `json:"currency,omitempty" url:"currency,omitempty"`
	// direction: in, out
	Direction *string `json:"direction,omitempty" url:"direction,omitempty"`
	// Transaction type: TRANSFER- transfer funds, MARGIN_EXCHANGE-cross margin trade, ISOLATED_EXCHANGE-isolated margin trade, LIQUIDATION-liquidation, ASSERT_RETURN-forced liquidation asset return
	BizType *string `json:"bizType,omitempty" url:"bizType,omitempty"`
	// The ID of the last set of data from the previous data batch. By default, the latest information is given.
	LastId *int64 `json:"lastId,omitempty" url:"lastId,omitempty"`
	// Default100, Max200
	Limit *int32 `json:"limit,omitempty" url:"limit,omitempty"`
	// Start time (milliseconds)
	StartAt *int64 `json:"startAt,omitempty" url:"startAt,omitempty"`
	// End time (milliseconds)
	EndAt *int64 `json:"endAt,omitempty" url:"endAt,omitempty"`
}

// NewGetMarginHFLedgerReq instantiates a new GetMarginHFLedgerReq object
// This constructor will assign default values to properties that have it defined
func NewGetMarginHFLedgerReq() *GetMarginHFLedgerReq {
	this := GetMarginHFLedgerReq{}
	var limit int32 = 100
	this.Limit = &limit
	return &this
}

// NewGetMarginHFLedgerReqWithDefaults instantiates a new GetMarginHFLedgerReq object
// This constructor will only assign default values to properties that have it defined,
func NewGetMarginHFLedgerReqWithDefaults() *GetMarginHFLedgerReq {
	this := GetMarginHFLedgerReq{}
	var limit int32 = 100
	this.Limit = &limit
	return &this
}

func (o *GetMarginHFLedgerReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["direction"] = o.Direction
	toSerialize["bizType"] = o.BizType
	toSerialize["lastId"] = o.LastId
	toSerialize["limit"] = o.Limit
	toSerialize["startAt"] = o.StartAt
	toSerialize["endAt"] = o.EndAt
	return toSerialize
}

type GetMarginHFLedgerReqBuilder struct {
	obj *GetMarginHFLedgerReq
}

func NewGetMarginHFLedgerReqBuilder() *GetMarginHFLedgerReqBuilder {
	return &GetMarginHFLedgerReqBuilder{obj: NewGetMarginHFLedgerReqWithDefaults()}
}

// Currency optional; more than one can be selected; separate using commas; select no more than 10 currencies; the default will be to query for all currencies if left empty
func (builder *GetMarginHFLedgerReqBuilder) SetCurrency(value string) *GetMarginHFLedgerReqBuilder {
	builder.obj.Currency = &value
	return builder
}

// direction: in, out
func (builder *GetMarginHFLedgerReqBuilder) SetDirection(value string) *GetMarginHFLedgerReqBuilder {
	builder.obj.Direction = &value
	return builder
}

// Transaction type: TRANSFER- transfer funds, MARGIN_EXCHANGE-cross margin trade, ISOLATED_EXCHANGE-isolated margin trade, LIQUIDATION-liquidation, ASSERT_RETURN-forced liquidation asset return
func (builder *GetMarginHFLedgerReqBuilder) SetBizType(value string) *GetMarginHFLedgerReqBuilder {
	builder.obj.BizType = &value
	return builder
}

// The ID of the last set of data from the previous data batch. By default, the latest information is given.
func (builder *GetMarginHFLedgerReqBuilder) SetLastId(value int64) *GetMarginHFLedgerReqBuilder {
	builder.obj.LastId = &value
	return builder
}

// Default100, Max200
func (builder *GetMarginHFLedgerReqBuilder) SetLimit(value int32) *GetMarginHFLedgerReqBuilder {
	builder.obj.Limit = &value
	return builder
}

// Start time (milliseconds)
func (builder *GetMarginHFLedgerReqBuilder) SetStartAt(value int64) *GetMarginHFLedgerReqBuilder {
	builder.obj.StartAt = &value
	return builder
}

// End time (milliseconds)
func (builder *GetMarginHFLedgerReqBuilder) SetEndAt(value int64) *GetMarginHFLedgerReqBuilder {
	builder.obj.EndAt = &value
	return builder
}

func (builder *GetMarginHFLedgerReqBuilder) Build() *GetMarginHFLedgerReq {
	return builder.obj
}
