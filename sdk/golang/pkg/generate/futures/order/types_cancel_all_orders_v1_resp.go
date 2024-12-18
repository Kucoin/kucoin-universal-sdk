// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// CancelAllOrdersV1Resp struct for CancelAllOrdersV1Resp
type CancelAllOrdersV1Resp struct {
	// common response
	CommonResponse *types.RestResponse
	// Unique ID of the cancelled order
	CancelledOrderIds []string `json:"cancelledOrderIds,omitempty"`
}

// NewCancelAllOrdersV1Resp instantiates a new CancelAllOrdersV1Resp object
// This constructor will assign default values to properties that have it defined
func NewCancelAllOrdersV1Resp(cancelledOrderIds []string) *CancelAllOrdersV1Resp {
	this := CancelAllOrdersV1Resp{}
	this.CancelledOrderIds = cancelledOrderIds
	return &this
}

// NewCancelAllOrdersV1RespWithDefaults instantiates a new CancelAllOrdersV1Resp object
// This constructor will only assign default values to properties that have it defined,
func NewCancelAllOrdersV1RespWithDefaults() *CancelAllOrdersV1Resp {
	this := CancelAllOrdersV1Resp{}
	return &this
}

func (o *CancelAllOrdersV1Resp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["cancelledOrderIds"] = o.CancelledOrderIds
	return toSerialize
}

func (o *CancelAllOrdersV1Resp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}