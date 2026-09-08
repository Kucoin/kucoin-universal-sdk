// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package affiliate

import (
	"encoding/json"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// GetCommissionData is ported from the Java UTA SDK model.
type GetCommissionData struct {
	SiteType        string `json:"siteType,omitempty" url:"siteType,omitempty"`
	RebateType      int64  `json:"rebateType,omitempty" url:"rebateType,omitempty"`
	PayoutTime      int64  `json:"payoutTime,omitempty" url:"payoutTime,omitempty"`
	PeriodStartTime int64  `json:"periodStartTime,omitempty" url:"periodStartTime,omitempty"`
	PeriodEndTime   int64  `json:"periodEndTime,omitempty" url:"periodEndTime,omitempty"`
	Status          int64  `json:"status,omitempty" url:"status,omitempty"`
	TakerVolume     string `json:"takerVolume,omitempty" url:"takerVolume,omitempty"`
	MakerVolume     string `json:"makerVolume,omitempty" url:"makerVolume,omitempty"`
	Commission      string `json:"commission,omitempty" url:"commission,omitempty"`
	Currency        string `json:"currency,omitempty" url:"currency,omitempty"`
	KuminingVolume  string `json:"kuminingVolume,omitempty" url:"kuminingVolume,omitempty"`
	DataType        string `json:"dataType,omitempty" url:"dataType,omitempty"`
}

// GetCommissionReq is ported from the Java UTA SDK model.
type GetCommissionReq struct {
	SiteType      string `json:"siteType,omitempty" url:"siteType,omitempty"`
	RebateType    int64  `json:"rebateType,omitempty" url:"rebateType,omitempty"`
	RebateStartAt int64  `json:"rebateStartAt,omitempty" url:"rebateStartAt,omitempty"`
	RebateEndAt   int64  `json:"rebateEndAt,omitempty" url:"rebateEndAt,omitempty"`
	Page          int64  `json:"page,omitempty" url:"page,omitempty"`
	PageSize      int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	DataType      string `json:"dataType,omitempty" url:"dataType,omitempty"`
}

// GetCommissionResp is ported from the Java UTA SDK model.
type GetCommissionResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	CurrentPage    int64               `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize       int64               `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64               `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64               `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	Items          []GetCommissionData `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetCommissionResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetInvitedItems is ported from the Java UTA SDK model.
type GetInvitedItems struct {
	Uid                   string `json:"uid,omitempty" url:"uid,omitempty"`
	Country               string `json:"country,omitempty" url:"country,omitempty"`
	Currency              string `json:"currency,omitempty" url:"currency,omitempty"`
	NickName              string `json:"nickName,omitempty" url:"nickName,omitempty"`
	Past7dFees            string `json:"past7dFees,omitempty" url:"past7dFees,omitempty"`
	CashbackRate          string `json:"cashbackRate,omitempty" url:"cashbackRate,omitempty"`
	CompletedKyc          bool   `json:"completedKyc,omitempty" url:"completedKyc,omitempty"`
	ReferralCode          string `json:"referralCode,omitempty" url:"referralCode,omitempty"`
	TotalCommission       string `json:"totalCommission,omitempty" url:"totalCommission,omitempty"`
	MyCommissionRate      string `json:"myCommissionRate,omitempty" url:"myCommissionRate,omitempty"`
	Past7dCommission      string `json:"past7dCommission,omitempty" url:"past7dCommission,omitempty"`
	RegistrationTime      int64  `json:"registrationTime,omitempty" url:"registrationTime,omitempty"`
	CompletedFirstTrade   bool   `json:"completedFirstTrade,omitempty" url:"completedFirstTrade,omitempty"`
	CompletedFirstDeposit bool   `json:"completedFirstDeposit,omitempty" url:"completedFirstDeposit,omitempty"`
}

// GetInvitedReq is ported from the Java UTA SDK model.
type GetInvitedReq struct {
	UserType            string `json:"userType,omitempty" url:"userType,omitempty"`
	ReferralCode        string `json:"referralCode,omitempty" url:"referralCode,omitempty"`
	Uid                 string `json:"uid,omitempty" url:"uid,omitempty"`
	RegistrationEndAt   int64  `json:"registrationEndAt,omitempty" url:"registrationEndAt,omitempty"`
	RegistrationStartAt int64  `json:"registrationStartAt,omitempty" url:"registrationStartAt,omitempty"`
	Page                int64  `json:"page,omitempty" url:"page,omitempty"`
	PageSize            int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetInvitedResp is ported from the Java UTA SDK model.
type GetInvitedResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Items          []GetInvitedItems   `json:"items,omitempty" url:"items,omitempty"`
	PageSize       int64               `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64               `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64               `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	CurrentPage    int64               `json:"currentPage,omitempty" url:"currentPage,omitempty"`
}

func (o *GetInvitedResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetKuminingData is ported from the Java UTA SDK model.
type GetKuminingData struct {
	Uid       string `json:"uid,omitempty" url:"uid,omitempty"`
	PayTime   int64  `json:"payTime,omitempty" url:"payTime,omitempty"`
	GoodsName string `json:"goodsName,omitempty" url:"goodsName,omitempty"`
	Amount    string `json:"amount,omitempty" url:"amount,omitempty"`
	Currency  string `json:"currency,omitempty" url:"currency,omitempty"`
	LastId    string `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// GetKuminingReq is ported from the Java UTA SDK model.
type GetKuminingReq struct {
	Uid       string `json:"uid,omitempty" url:"uid,omitempty"`
	StartAt   int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt     int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId    string `json:"lastId,omitempty" url:"lastId,omitempty"`
	Direction string `json:"direction,omitempty" url:"direction,omitempty"`
	PageSize  int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetKuminingResp is ported from the Java UTA SDK model.
type GetKuminingResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           []GetKuminingData   `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetKuminingResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetKuminingResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetTradeHistoryItems is ported from the Java UTA SDK model.
type GetTradeHistoryItems struct {
	TradeTime     int64  `json:"tradeTime,omitempty" url:"tradeTime,omitempty"`
	TradeType     string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	TradeCurrency string `json:"tradeCurrency,omitempty" url:"tradeCurrency,omitempty"`
	TradeAmount   string `json:"tradeAmount,omitempty" url:"tradeAmount,omitempty"`
	TradeAmountU  string `json:"tradeAmountU,omitempty" url:"tradeAmountU,omitempty"`
	FeeU          string `json:"feeU,omitempty" url:"feeU,omitempty"`
	Commission    string `json:"commission,omitempty" url:"commission,omitempty"`
	Currency      string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetTradeHistoryReq is ported from the Java UTA SDK model.
type GetTradeHistoryReq struct {
	Uid          string `json:"uid,omitempty" url:"uid,omitempty"`
	TradeType    string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	TradeStartAt int64  `json:"tradeStartAt,omitempty" url:"tradeStartAt,omitempty"`
	TradeEndAt   int64  `json:"tradeEndAt,omitempty" url:"tradeEndAt,omitempty"`
	Page         int64  `json:"page,omitempty" url:"page,omitempty"`
	PageSize     int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetTradeHistoryResp is ported from the Java UTA SDK model.
type GetTradeHistoryResp struct {
	CommonResponse *types.RestResponse    `json:"-"`
	CurrentPage    int64                  `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize       int64                  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64                  `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64                  `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	Items          []GetTradeHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetTradeHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTransactionData is ported from the Java UTA SDK model.
type GetTransactionData struct {
	Uid           string `json:"uid,omitempty" url:"uid,omitempty"`
	TradeTime     int64  `json:"tradeTime,omitempty" url:"tradeTime,omitempty"`
	TradeType     string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	TradeCurrency string `json:"tradeCurrency,omitempty" url:"tradeCurrency,omitempty"`
	TradeAmount   string `json:"tradeAmount,omitempty" url:"tradeAmount,omitempty"`
	TradeAmountU  string `json:"tradeAmountU,omitempty" url:"tradeAmountU,omitempty"`
	FeeU          string `json:"feeU,omitempty" url:"feeU,omitempty"`
	Commission    string `json:"commission,omitempty" url:"commission,omitempty"`
	Currency      string `json:"currency,omitempty" url:"currency,omitempty"`
	LastId        string `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// GetTransactionReq is ported from the Java UTA SDK model.
type GetTransactionReq struct {
	Uid          string `json:"uid,omitempty" url:"uid,omitempty"`
	TradeType    string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	TradeStartAt int64  `json:"tradeStartAt,omitempty" url:"tradeStartAt,omitempty"`
	TradeEndAt   int64  `json:"tradeEndAt,omitempty" url:"tradeEndAt,omitempty"`
	LastId       int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
	Direction    string `json:"direction,omitempty" url:"direction,omitempty"`
	PageSize     int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetTransactionResp is ported from the Java UTA SDK model.
type GetTransactionResp struct {
	CommonResponse *types.RestResponse  `json:"-"`
	Data           []GetTransactionData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetTransactionResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetTransactionResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}
