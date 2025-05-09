// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package order

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// AddOrderTestV1Resp struct for AddOrderTestV1Resp
type AddOrderTestV1Resp struct {
	// common response
	CommonResponse *types.RestResponse
	// The unique order ID generated by the trading system, which can be used later for further actions such as canceling the order.
	OrderId string `json:"orderId,omitempty"`
	// Borrow order ID. The field is returned only after placing the order under the mode of Auto-Borrow.
	LoanApplyId string `json:"loanApplyId,omitempty"`
	// Borrowed amount. The field is returned only after placing the order under the mode of Auto-Borrow.
	BorrowSize string `json:"borrowSize,omitempty"`
	// This return value is invalid
	ClientOid string `json:"clientOid,omitempty"`
}

// NewAddOrderTestV1Resp instantiates a new AddOrderTestV1Resp object
// This constructor will assign default values to properties that have it defined
func NewAddOrderTestV1Resp(orderId string, loanApplyId string, borrowSize string, clientOid string) *AddOrderTestV1Resp {
	this := AddOrderTestV1Resp{}
	this.OrderId = orderId
	this.LoanApplyId = loanApplyId
	this.BorrowSize = borrowSize
	this.ClientOid = clientOid
	return &this
}

// NewAddOrderTestV1RespWithDefaults instantiates a new AddOrderTestV1Resp object
// This constructor will only assign default values to properties that have it defined,
func NewAddOrderTestV1RespWithDefaults() *AddOrderTestV1Resp {
	this := AddOrderTestV1Resp{}
	return &this
}

func (o *AddOrderTestV1Resp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["orderId"] = o.OrderId
	toSerialize["loanApplyId"] = o.LoanApplyId
	toSerialize["borrowSize"] = o.BorrowSize
	toSerialize["clientOid"] = o.ClientOid
	return toSerialize
}

func (o *AddOrderTestV1Resp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
