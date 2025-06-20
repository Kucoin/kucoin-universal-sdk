// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package positions

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// BatchSwitchMarginModeResp struct for BatchSwitchMarginModeResp
type BatchSwitchMarginModeResp struct {
	// common response
	CommonResponse *types.RestResponse
	// Target Margin Model, Symbols that failed to be modified will also be included
	MarginMode map[string]string `json:"marginMode,omitempty"`
	// Symbol which modification failed
	Errors []BatchSwitchMarginModeErrors `json:"errors,omitempty"`
}

// NewBatchSwitchMarginModeResp instantiates a new BatchSwitchMarginModeResp object
// This constructor will assign default values to properties that have it defined
func NewBatchSwitchMarginModeResp(marginMode map[string]string, errors []BatchSwitchMarginModeErrors) *BatchSwitchMarginModeResp {
	this := BatchSwitchMarginModeResp{}
	this.MarginMode = marginMode
	this.Errors = errors
	return &this
}

// NewBatchSwitchMarginModeRespWithDefaults instantiates a new BatchSwitchMarginModeResp object
// This constructor will only assign default values to properties that have it defined,
func NewBatchSwitchMarginModeRespWithDefaults() *BatchSwitchMarginModeResp {
	this := BatchSwitchMarginModeResp{}
	return &this
}

func (o *BatchSwitchMarginModeResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["marginMode"] = o.MarginMode
	toSerialize["errors"] = o.Errors
	return toSerialize
}

func (o *BatchSwitchMarginModeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
