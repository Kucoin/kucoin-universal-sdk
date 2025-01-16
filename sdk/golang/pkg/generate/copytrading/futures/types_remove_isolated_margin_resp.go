// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package futures

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// RemoveIsolatedMarginResp struct for RemoveIsolatedMarginResp
type RemoveIsolatedMarginResp struct {
	// common response
	CommonResponse *types.RestResponse
	// The size of the position deposited. If it is USDT-margin, it represents the amount of USDT. If it is coin-margin, this value represents the number of coins
	Data string `json:"data,omitempty"`
}

// NewRemoveIsolatedMarginResp instantiates a new RemoveIsolatedMarginResp object
// This constructor will assign default values to properties that have it defined
func NewRemoveIsolatedMarginResp(data string) *RemoveIsolatedMarginResp {
	this := RemoveIsolatedMarginResp{}
	this.Data = data
	return &this
}

// NewRemoveIsolatedMarginRespWithDefaults instantiates a new RemoveIsolatedMarginResp object
// This constructor will only assign default values to properties that have it defined,
func NewRemoveIsolatedMarginRespWithDefaults() *RemoveIsolatedMarginResp {
	this := RemoveIsolatedMarginResp{}
	return &this
}

func (o *RemoveIsolatedMarginResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["data"] = o.Data
	return toSerialize
}

func (o *RemoveIsolatedMarginResp) UnmarshalJSON(b []byte) error {
	err := json.Unmarshal(b, &o.Data)
	return err
}

func (o *RemoveIsolatedMarginResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}