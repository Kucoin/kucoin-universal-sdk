// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package fundingfees

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// GetCurrentFundingRateResp struct for GetCurrentFundingRateResp
type GetCurrentFundingRateResp struct {
	// common response
	CommonResponse *types.RestResponse
	// Funding Rate Symbol
	Symbol string `json:"symbol,omitempty"`
	// Granularity (milliseconds)
	Granularity int32 `json:"granularity,omitempty"`
	// The funding rate settlement time point of the previous cycle (milliseconds) Before going live, the system will pre-generate the first funding rate record to ensure the billing cycle can start immediately after the contract is launched.  The timePoint field represents the time the funding rate data was generated, not the actual time it takes effect or is settled.  The first actual settlement will occur at the designated settlement time (00:00 / 08:00 / 14:00) after the contract goes live.
	TimePoint int64 `json:"timePoint,omitempty"`
	// Current cycle funding rate
	Value float64 `json:"value,omitempty"`
	// Predicted funding rate
	PredictedValue float64 `json:"predictedValue,omitempty"`
	// Maximum Funding Rate
	FundingRateCap float64 `json:"fundingRateCap,omitempty"`
	// Minimum Funding Rate
	FundingRateFloor float64 `json:"fundingRateFloor,omitempty"`
	// Indicates whether the current funding fee is charged within this cycle
	Period int32 `json:"period,omitempty"`
	// Indicates the next funding fee settlement time point, which can be used to synchronize periodic settlement timing.
	FundingTime int64 `json:"fundingTime,omitempty"`
}

// NewGetCurrentFundingRateResp instantiates a new GetCurrentFundingRateResp object
// This constructor will assign default values to properties that have it defined
func NewGetCurrentFundingRateResp(symbol string, granularity int32, timePoint int64, value float64, predictedValue float64, fundingRateCap float64, fundingRateFloor float64, period int32, fundingTime int64) *GetCurrentFundingRateResp {
	this := GetCurrentFundingRateResp{}
	this.Symbol = symbol
	this.Granularity = granularity
	this.TimePoint = timePoint
	this.Value = value
	this.PredictedValue = predictedValue
	this.FundingRateCap = fundingRateCap
	this.FundingRateFloor = fundingRateFloor
	this.Period = period
	this.FundingTime = fundingTime
	return &this
}

// NewGetCurrentFundingRateRespWithDefaults instantiates a new GetCurrentFundingRateResp object
// This constructor will only assign default values to properties that have it defined,
func NewGetCurrentFundingRateRespWithDefaults() *GetCurrentFundingRateResp {
	this := GetCurrentFundingRateResp{}
	return &this
}

func (o *GetCurrentFundingRateResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["granularity"] = o.Granularity
	toSerialize["timePoint"] = o.TimePoint
	toSerialize["value"] = o.Value
	toSerialize["predictedValue"] = o.PredictedValue
	toSerialize["fundingRateCap"] = o.FundingRateCap
	toSerialize["fundingRateFloor"] = o.FundingRateFloor
	toSerialize["period"] = o.Period
	toSerialize["fundingTime"] = o.FundingTime
	return toSerialize
}

func (o *GetCurrentFundingRateResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
