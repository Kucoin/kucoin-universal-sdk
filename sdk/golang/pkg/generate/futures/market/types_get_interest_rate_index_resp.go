// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package market

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// GetInterestRateIndexResp struct for GetInterestRateIndexResp
type GetInterestRateIndexResp struct {
	// common response
	CommonResponse *types.RestResponse
	DataList       []GetInterestRateIndexDataList `json:"dataList,omitempty"`
	// Whether there are more pages
	HasMore bool `json:"hasMore,omitempty"`
}

// NewGetInterestRateIndexResp instantiates a new GetInterestRateIndexResp object
// This constructor will assign default values to properties that have it defined
func NewGetInterestRateIndexResp(dataList []GetInterestRateIndexDataList, hasMore bool) *GetInterestRateIndexResp {
	this := GetInterestRateIndexResp{}
	this.DataList = dataList
	this.HasMore = hasMore
	return &this
}

// NewGetInterestRateIndexRespWithDefaults instantiates a new GetInterestRateIndexResp object
// This constructor will only assign default values to properties that have it defined,
func NewGetInterestRateIndexRespWithDefaults() *GetInterestRateIndexResp {
	this := GetInterestRateIndexResp{}
	return &this
}

func (o *GetInterestRateIndexResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["dataList"] = o.DataList
	toSerialize["hasMore"] = o.HasMore
	return toSerialize
}

func (o *GetInterestRateIndexResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
