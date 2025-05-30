// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// BatchAddOrdersOldResp struct for BatchAddOrdersOldResp
type BatchAddOrdersOldResp struct {
	// common response
	CommonResponse *types.RestResponse
	Data           []BatchAddOrdersOldData `json:"data,omitempty"`
}

// NewBatchAddOrdersOldResp instantiates a new BatchAddOrdersOldResp object
// This constructor will assign default values to properties that have it defined
func NewBatchAddOrdersOldResp(data []BatchAddOrdersOldData) *BatchAddOrdersOldResp {
	this := BatchAddOrdersOldResp{}
	this.Data = data
	return &this
}

// NewBatchAddOrdersOldRespWithDefaults instantiates a new BatchAddOrdersOldResp object
// This constructor will only assign default values to properties that have it defined,
func NewBatchAddOrdersOldRespWithDefaults() *BatchAddOrdersOldResp {
	this := BatchAddOrdersOldResp{}
	return &this
}

func (o *BatchAddOrdersOldResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["data"] = o.Data
	return toSerialize
}

func (o *BatchAddOrdersOldResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
