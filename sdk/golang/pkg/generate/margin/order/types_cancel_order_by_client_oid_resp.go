// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// CancelOrderByClientOidResp struct for CancelOrderByClientOidResp
type CancelOrderByClientOidResp struct {
	// common response
	CommonResponse *types.RestResponse
	// Client Order Id, unique identifier created by the user
	ClientOid string `json:"clientOid,omitempty"`
}

// NewCancelOrderByClientOidResp instantiates a new CancelOrderByClientOidResp object
// This constructor will assign default values to properties that have it defined
func NewCancelOrderByClientOidResp(clientOid string) *CancelOrderByClientOidResp {
	this := CancelOrderByClientOidResp{}
	this.ClientOid = clientOid
	return &this
}

// NewCancelOrderByClientOidRespWithDefaults instantiates a new CancelOrderByClientOidResp object
// This constructor will only assign default values to properties that have it defined,
func NewCancelOrderByClientOidRespWithDefaults() *CancelOrderByClientOidResp {
	this := CancelOrderByClientOidResp{}
	return &this
}

func (o *CancelOrderByClientOidResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["clientOid"] = o.ClientOid
	return toSerialize
}

func (o *CancelOrderByClientOidResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
