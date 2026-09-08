// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package viplending

import (
	"encoding/json"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// GetAccountsData is ported from the Java UTA SDK model.
type GetAccountsData struct {
	Uid          string `json:"uid,omitempty" url:"uid,omitempty"`
	MarginCcy    string `json:"marginCcy,omitempty" url:"marginCcy,omitempty"`
	MarginQty    string `json:"marginQty,omitempty" url:"marginQty,omitempty"`
	MarginFactor string `json:"marginFactor,omitempty" url:"marginFactor,omitempty"`
	AccountType  string `json:"accountType,omitempty" url:"accountType,omitempty"`
	IsParent     bool   `json:"isParent,omitempty" url:"isParent,omitempty"`
}

// GetAccountsReq is ported from the Java UTA SDK model.
type GetAccountsReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
}

// GetAccountsResp is ported from the Java UTA SDK model.
type GetAccountsResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           []GetAccountsData   `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetAccountsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetAccountsResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetDiscountRateConfigsData is ported from the Java UTA SDK model.
type GetDiscountRateConfigsData struct {
	Currency   string                                 `json:"currency,omitempty" url:"currency,omitempty"`
	UsdtLevels []GetDiscountRateConfigsDataUsdtLevels `json:"usdtLevels,omitempty" url:"usdtLevels,omitempty"`
}

// GetDiscountRateConfigsDataUsdtLevels is ported from the Java UTA SDK model.
type GetDiscountRateConfigsDataUsdtLevels struct {
	Left         int64  `json:"left,omitempty" url:"left,omitempty"`
	Right        int64  `json:"right,omitempty" url:"right,omitempty"`
	DiscountRate string `json:"discountRate,omitempty" url:"discountRate,omitempty"`
}

// GetDiscountRateConfigsReq is ported from the Java UTA SDK model.
type GetDiscountRateConfigsReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
}

// GetDiscountRateConfigsResp is ported from the Java UTA SDK model.
type GetDiscountRateConfigsResp struct {
	CommonResponse *types.RestResponse          `json:"-"`
	Data           []GetDiscountRateConfigsData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetDiscountRateConfigsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetDiscountRateConfigsResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetLoanInfoLtv is ported from the Java UTA SDK model.
type GetLoanInfoLtv struct {
	TransferLtv           string `json:"transferLtv,omitempty" url:"transferLtv,omitempty"`
	OnlyClosePosLtv       string `json:"onlyClosePosLtv,omitempty" url:"onlyClosePosLtv,omitempty"`
	DelayedLiquidationLtv string `json:"delayedLiquidationLtv,omitempty" url:"delayedLiquidationLtv,omitempty"`
	InstantLiquidationLtv string `json:"instantLiquidationLtv,omitempty" url:"instantLiquidationLtv,omitempty"`
	CurrentLtv            string `json:"currentLtv,omitempty" url:"currentLtv,omitempty"`
}

// GetLoanInfoMargins is ported from the Java UTA SDK model.
type GetLoanInfoMargins struct {
	MarginCcy    string `json:"marginCcy,omitempty" url:"marginCcy,omitempty"`
	MarginQty    string `json:"marginQty,omitempty" url:"marginQty,omitempty"`
	MarginFactor string `json:"marginFactor,omitempty" url:"marginFactor,omitempty"`
}

// GetLoanInfoOrders is ported from the Java UTA SDK model.
type GetLoanInfoOrders struct {
	OrderId   string `json:"orderId,omitempty" url:"orderId,omitempty"`
	Principal string `json:"principal,omitempty" url:"principal,omitempty"`
	Interest  string `json:"interest,omitempty" url:"interest,omitempty"`
	Currency  string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetLoanInfoReq is ported from the Java UTA SDK model.
type GetLoanInfoReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
}

// GetLoanInfoResp is ported from the Java UTA SDK model.
type GetLoanInfoResp struct {
	CommonResponse       *types.RestResponse  `json:"-"`
	ParentUid            string               `json:"parentUid,omitempty" url:"parentUid,omitempty"`
	Orders               []GetLoanInfoOrders  `json:"orders,omitempty" url:"orders,omitempty"`
	Ltv                  GetLoanInfoLtv       `json:"ltv,omitempty" url:"ltv,omitempty"`
	TotalMarginAmount    string               `json:"totalMarginAmount,omitempty" url:"totalMarginAmount,omitempty"`
	TransferMarginAmount string               `json:"transferMarginAmount,omitempty" url:"transferMarginAmount,omitempty"`
	Margins              []GetLoanInfoMargins `json:"margins,omitempty" url:"margins,omitempty"`
}

func (o *GetLoanInfoResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
