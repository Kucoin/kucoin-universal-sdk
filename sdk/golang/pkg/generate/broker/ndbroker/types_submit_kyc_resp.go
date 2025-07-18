// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package ndbroker

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// SubmitKYCResp struct for SubmitKYCResp
type SubmitKYCResp struct {
	// common response
	CommonResponse *types.RestResponse
	Data           *string `json:"data,omitempty"`
}

// NewSubmitKYCResp instantiates a new SubmitKYCResp object
// This constructor will assign default values to properties that have it defined
func NewSubmitKYCResp() *SubmitKYCResp {
	this := SubmitKYCResp{}
	return &this
}

// NewSubmitKYCRespWithDefaults instantiates a new SubmitKYCResp object
// This constructor will only assign default values to properties that have it defined,
func NewSubmitKYCRespWithDefaults() *SubmitKYCResp {
	this := SubmitKYCResp{}
	return &this
}

func (o *SubmitKYCResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["data"] = o.Data
	return toSerialize
}

func (o *SubmitKYCResp) UnmarshalJSON(b []byte) error {
	err := json.Unmarshal(b, &o.Data)
	return err
}

func (o *SubmitKYCResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
