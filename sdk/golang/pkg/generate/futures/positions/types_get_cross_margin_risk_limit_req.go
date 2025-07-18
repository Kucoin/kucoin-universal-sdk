// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package positions

// GetCrossMarginRiskLimitReq struct for GetCrossMarginRiskLimitReq
type GetCrossMarginRiskLimitReq struct {
	// Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220), (You may add up to 50 symbols. Use a halfwidth comma to each IP)
	Symbol *string `json:"symbol,omitempty" url:"symbol,omitempty"`
	// The position opening amount, in the contract's settlement currency. Defaults to 10,000 in margin currency for max position calculation. For USDT/USDC, it's 10,000 USD; for others, it's 10,000 divided by the token's USDT price.
	TotalMargin *string `json:"totalMargin,omitempty" url:"totalMargin,omitempty"`
	// Calculates the max position size at the specified leverage. Defaults to the symbol’s max cross leverage.
	Leverage *int32 `json:"leverage,omitempty" url:"leverage,omitempty"`
}

// NewGetCrossMarginRiskLimitReq instantiates a new GetCrossMarginRiskLimitReq object
// This constructor will assign default values to properties that have it defined
func NewGetCrossMarginRiskLimitReq() *GetCrossMarginRiskLimitReq {
	this := GetCrossMarginRiskLimitReq{}
	return &this
}

// NewGetCrossMarginRiskLimitReqWithDefaults instantiates a new GetCrossMarginRiskLimitReq object
// This constructor will only assign default values to properties that have it defined,
func NewGetCrossMarginRiskLimitReqWithDefaults() *GetCrossMarginRiskLimitReq {
	this := GetCrossMarginRiskLimitReq{}
	return &this
}

func (o *GetCrossMarginRiskLimitReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["totalMargin"] = o.TotalMargin
	toSerialize["leverage"] = o.Leverage
	return toSerialize
}

type GetCrossMarginRiskLimitReqBuilder struct {
	obj *GetCrossMarginRiskLimitReq
}

func NewGetCrossMarginRiskLimitReqBuilder() *GetCrossMarginRiskLimitReqBuilder {
	return &GetCrossMarginRiskLimitReqBuilder{obj: NewGetCrossMarginRiskLimitReqWithDefaults()}
}

// Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220), (You may add up to 50 symbols. Use a halfwidth comma to each IP)
func (builder *GetCrossMarginRiskLimitReqBuilder) SetSymbol(value string) *GetCrossMarginRiskLimitReqBuilder {
	builder.obj.Symbol = &value
	return builder
}

// The position opening amount, in the contract's settlement currency. Defaults to 10,000 in margin currency for max position calculation. For USDT/USDC, it's 10,000 USD; for others, it's 10,000 divided by the token's USDT price.
func (builder *GetCrossMarginRiskLimitReqBuilder) SetTotalMargin(value string) *GetCrossMarginRiskLimitReqBuilder {
	builder.obj.TotalMargin = &value
	return builder
}

// Calculates the max position size at the specified leverage. Defaults to the symbol’s max cross leverage.
func (builder *GetCrossMarginRiskLimitReqBuilder) SetLeverage(value int32) *GetCrossMarginRiskLimitReqBuilder {
	builder.obj.Leverage = &value
	return builder
}

func (builder *GetCrossMarginRiskLimitReqBuilder) Build() *GetCrossMarginRiskLimitReq {
	return builder.obj
}
