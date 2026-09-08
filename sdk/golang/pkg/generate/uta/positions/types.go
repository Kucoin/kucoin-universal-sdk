// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package positions

import (
	"encoding/json"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// ApiChangeMarginModeRequest is ported from the Java UTA SDK model.
type ApiChangeMarginModeRequest struct {
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// ApiChangeMarginModeResponse is ported from the Java UTA SDK model.
type ApiChangeMarginModeResponse struct {
	Ts    int64                   `json:"ts,omitempty" url:"ts,omitempty"`
	Items []ApiChangeMarginModeVo `json:"items,omitempty" url:"items,omitempty"`
}

// ApiChangeMarginModeVo is ported from the Java UTA SDK model.
type ApiChangeMarginModeVo struct {
	Msg        string `json:"msg,omitempty" url:"msg,omitempty"`
	Code       string `json:"code,omitempty" url:"code,omitempty"`
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// ApiModifyMarginResponse is ported from the Java UTA SDK model.
type ApiModifyMarginResponse struct {
	Ts int64 `json:"ts,omitempty" url:"ts,omitempty"`
}

// GenericResultApiChangeMarginModeResponse is ported from the Java UTA SDK model.
type GenericResultApiChangeMarginModeResponse struct {
	Msg  string                      `json:"msg,omitempty" url:"msg,omitempty"`
	Code string                      `json:"code,omitempty" url:"code,omitempty"`
	Data ApiChangeMarginModeResponse `json:"data,omitempty" url:"data,omitempty"`
}

// GenericResultApiModifyMarginResponse is ported from the Java UTA SDK model.
type GenericResultApiModifyMarginResponse struct {
	Msg  string                  `json:"msg,omitempty" url:"msg,omitempty"`
	Code string                  `json:"code,omitempty" url:"code,omitempty"`
	Data ApiModifyMarginResponse `json:"data,omitempty" url:"data,omitempty"`
}

// GetMarginModeItems is ported from the Java UTA SDK model.
type GetMarginModeItems struct {
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// GetMarginModeReq is ported from the Java UTA SDK model.
type GetMarginModeReq struct {
	Symbol string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetMarginModeResp is ported from the Java UTA SDK model.
type GetMarginModeResp struct {
	CommonResponse *types.RestResponse  `json:"-"`
	Ts             int64                `json:"ts,omitempty" url:"ts,omitempty"`
	Items          []GetMarginModeItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetMarginModeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetPositionListData is ported from the Java UTA SDK model.
type GetPositionListData struct {
	Symbol            string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Id                string `json:"id,omitempty" url:"id,omitempty"`
	MarginMode        string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Size              string `json:"size,omitempty" url:"size,omitempty"`
	EntryPrice        string `json:"entryPrice,omitempty" url:"entryPrice,omitempty"`
	PositionValue     string `json:"positionValue,omitempty" url:"positionValue,omitempty"`
	PositionMargin    string `json:"positionMargin,omitempty" url:"positionMargin,omitempty"`
	MarkPrice         string `json:"markPrice,omitempty" url:"markPrice,omitempty"`
	Leverage          string `json:"leverage,omitempty" url:"leverage,omitempty"`
	UnrealizedPnL     string `json:"unrealizedPnL,omitempty" url:"unrealizedPnL,omitempty"`
	RealizedPnL       string `json:"realizedPnL,omitempty" url:"realizedPnL,omitempty"`
	InitialMargin     string `json:"initialMargin,omitempty" url:"initialMargin,omitempty"`
	Mmr               string `json:"mmr,omitempty" url:"mmr,omitempty"`
	MaintenanceMargin string `json:"maintenanceMargin,omitempty" url:"maintenanceMargin,omitempty"`
	CreationTime      int64  `json:"creationTime,omitempty" url:"creationTime,omitempty"`
	LiquidationPrice  string `json:"liquidationPrice,omitempty" url:"liquidationPrice,omitempty"`
	RiskRatio         string `json:"riskRatio,omitempty" url:"riskRatio,omitempty"`
	AdlPercentage     string `json:"adlPercentage,omitempty" url:"adlPercentage,omitempty"`
	UpdateTime        int64  `json:"updateTime,omitempty" url:"updateTime,omitempty"`
}

// GetPositionListReq is ported from the Java UTA SDK model.
type GetPositionListReq struct {
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	PageNumber string `json:"pageNumber,omitempty" url:"pageNumber,omitempty"`
	PageSize   string `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetPositionListResp is ported from the Java UTA SDK model.
type GetPositionListResp struct {
	CommonResponse *types.RestResponse   `json:"-"`
	Data           []GetPositionListData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetPositionListResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetPositionListResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetPositionsHistoryItems is ported from the Java UTA SDK model.
type GetPositionsHistoryItems struct {
	CloseId       string `json:"closeId,omitempty" url:"closeId,omitempty"`
	Symbol        string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode    string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Side          string `json:"side,omitempty" url:"side,omitempty"`
	EntryPrice    string `json:"entryPrice,omitempty" url:"entryPrice,omitempty"`
	ClosePrice    string `json:"closePrice,omitempty" url:"closePrice,omitempty"`
	AvgClosePrice string `json:"avgClosePrice,omitempty" url:"avgClosePrice,omitempty"`
	MaxSize       string `json:"maxSize,omitempty" url:"maxSize,omitempty"`
	Leverage      string `json:"leverage,omitempty" url:"leverage,omitempty"`
	RealizedPnL   string `json:"realizedPnL,omitempty" url:"realizedPnL,omitempty"`
	Fee           string `json:"fee,omitempty" url:"fee,omitempty"`
	Tax           string `json:"tax,omitempty" url:"tax,omitempty"`
	FundingFee    string `json:"fundingFee,omitempty" url:"fundingFee,omitempty"`
	CreationTime  int64  `json:"creationTime,omitempty" url:"creationTime,omitempty"`
	ClosingTime   int64  `json:"closingTime,omitempty" url:"closingTime,omitempty"`
}

// GetPositionsHistoryReq is ported from the Java UTA SDK model.
type GetPositionsHistoryReq struct {
	Symbol   string `json:"symbol,omitempty" url:"symbol,omitempty"`
	StartAt  int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt    int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId   int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
	PageSize int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetPositionsHistoryResp is ported from the Java UTA SDK model.
type GetPositionsHistoryResp struct {
	CommonResponse *types.RestResponse        `json:"-"`
	Items          []GetPositionsHistoryItems `json:"items,omitempty" url:"items,omitempty"`
	LastId         int64                      `json:"lastId,omitempty" url:"lastId,omitempty"`
}

func (o *GetPositionsHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetPrivateFundingFeeHistoryItems is ported from the Java UTA SDK model.
type GetPrivateFundingFeeHistoryItems struct {
	Symbol         string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode     string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	FundingRate    string `json:"fundingRate,omitempty" url:"fundingRate,omitempty"`
	MarkPrice      string `json:"markPrice,omitempty" url:"markPrice,omitempty"`
	Size           string `json:"size,omitempty" url:"size,omitempty"`
	PositionValue  string `json:"positionValue,omitempty" url:"positionValue,omitempty"`
	FundingFee     string `json:"fundingFee,omitempty" url:"fundingFee,omitempty"`
	SettleCurrency string `json:"settleCurrency,omitempty" url:"settleCurrency,omitempty"`
	SettlementTime int64  `json:"settlementTime,omitempty" url:"settlementTime,omitempty"`
}

// GetPrivateFundingFeeHistoryReq is ported from the Java UTA SDK model.
type GetPrivateFundingFeeHistoryReq struct {
	Symbol   string `json:"symbol,omitempty" url:"symbol,omitempty"`
	StartAt  int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt    int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId   int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
	PageSize int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetPrivateFundingFeeHistoryResp is ported from the Java UTA SDK model.
type GetPrivateFundingFeeHistoryResp struct {
	CommonResponse *types.RestResponse                `json:"-"`
	LastId         int64                              `json:"lastId,omitempty" url:"lastId,omitempty"`
	Items          []GetPrivateFundingFeeHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetPrivateFundingFeeHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ModifyIsolatedFuturesMarginReq is ported from the Java UTA SDK model.
type ModifyIsolatedFuturesMarginReq struct {
	Type      string  `json:"type,omitempty" url:"type,omitempty"`
	Amount    float64 `json:"amount,omitempty" url:"amount,omitempty"`
	Symbol    string  `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType string  `json:"tradeType,omitempty" url:"tradeType,omitempty"`
}

// ModifyIsolatedFuturesMarginResp is ported from the Java UTA SDK model.
type ModifyIsolatedFuturesMarginResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Ts             int64               `json:"ts,omitempty" url:"ts,omitempty"`
}

func (o *ModifyIsolatedFuturesMarginResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ModifyMarginModeItems is ported from the Java UTA SDK model.
type ModifyMarginModeItems struct {
	Msg        string `json:"msg,omitempty" url:"msg,omitempty"`
	Code       string `json:"code,omitempty" url:"code,omitempty"`
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// ModifyMarginModeReq is ported from the Java UTA SDK model.
type ModifyMarginModeReq struct {
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// ModifyMarginModeResp is ported from the Java UTA SDK model.
type ModifyMarginModeResp struct {
	CommonResponse *types.RestResponse     `json:"-"`
	Ts             int64                   `json:"ts,omitempty" url:"ts,omitempty"`
	Items          []ModifyMarginModeItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *ModifyMarginModeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
