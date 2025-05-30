// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package ndbroker

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// GetWithdrawDetailResp struct for GetWithdrawDetailResp
type GetWithdrawDetailResp struct {
	// common response
	CommonResponse *types.RestResponse
	// Withdrawal ID
	Id string `json:"id,omitempty"`
	// Chain ID of currency
	Chain string `json:"chain,omitempty"`
	// Wallet Transaction ID
	WalletTxId string `json:"walletTxId,omitempty"`
	// UID
	Uid int32 `json:"uid,omitempty"`
	// Update Time (milliseconds)
	UpdatedAt int64 `json:"updatedAt,omitempty"`
	// Amount
	Amount string `json:"amount,omitempty"`
	// Memo
	Memo string `json:"memo,omitempty"`
	// Fee
	Fee string `json:"fee,omitempty"`
	// Address
	Address string `json:"address,omitempty"`
	// Remark
	Remark string `json:"remark,omitempty"`
	// Is Internal (true or false)
	IsInner bool `json:"isInner,omitempty"`
	// Currency
	Currency string `json:"currency,omitempty"`
	// Status (PROCESSING, WALLET_PROCESSING, REVIEW, SUCCESS, FAILURE)
	Status string `json:"status,omitempty"`
	// Creation Time (milliseconds)
	CreatedAt int64 `json:"createdAt,omitempty"`
}

// NewGetWithdrawDetailResp instantiates a new GetWithdrawDetailResp object
// This constructor will assign default values to properties that have it defined
func NewGetWithdrawDetailResp(id string, chain string, walletTxId string, uid int32, updatedAt int64, amount string, memo string, fee string, address string, remark string, isInner bool, currency string, status string, createdAt int64) *GetWithdrawDetailResp {
	this := GetWithdrawDetailResp{}
	this.Id = id
	this.Chain = chain
	this.WalletTxId = walletTxId
	this.Uid = uid
	this.UpdatedAt = updatedAt
	this.Amount = amount
	this.Memo = memo
	this.Fee = fee
	this.Address = address
	this.Remark = remark
	this.IsInner = isInner
	this.Currency = currency
	this.Status = status
	this.CreatedAt = createdAt
	return &this
}

// NewGetWithdrawDetailRespWithDefaults instantiates a new GetWithdrawDetailResp object
// This constructor will only assign default values to properties that have it defined,
func NewGetWithdrawDetailRespWithDefaults() *GetWithdrawDetailResp {
	this := GetWithdrawDetailResp{}
	return &this
}

func (o *GetWithdrawDetailResp) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["id"] = o.Id
	toSerialize["chain"] = o.Chain
	toSerialize["walletTxId"] = o.WalletTxId
	toSerialize["uid"] = o.Uid
	toSerialize["updatedAt"] = o.UpdatedAt
	toSerialize["amount"] = o.Amount
	toSerialize["memo"] = o.Memo
	toSerialize["fee"] = o.Fee
	toSerialize["address"] = o.Address
	toSerialize["remark"] = o.Remark
	toSerialize["isInner"] = o.IsInner
	toSerialize["currency"] = o.Currency
	toSerialize["status"] = o.Status
	toSerialize["createdAt"] = o.CreatedAt
	return toSerialize
}

func (o *GetWithdrawDetailResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
