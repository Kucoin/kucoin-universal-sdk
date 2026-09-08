// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package account

import (
	"encoding/json"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// AddSubAccountApiReq is ported from the Java UTA SDK model.
type AddSubAccountApiReq struct {
	SubName     string `json:"subName,omitempty" url:"subName,omitempty"`
	Passphrase  string `json:"passphrase,omitempty" url:"passphrase,omitempty"`
	Remark      string `json:"remark,omitempty" url:"remark,omitempty"`
	Permission  string `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist string `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
	Expire      string `json:"expire,omitempty" url:"expire,omitempty"`
}

// AddSubAccountApiResp is ported from the Java UTA SDK model.
type AddSubAccountApiResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	SubName        string              `json:"subName,omitempty" url:"subName,omitempty"`
	Remark         string              `json:"remark,omitempty" url:"remark,omitempty"`
	ApiKey         string              `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	ApiSecret      string              `json:"apiSecret,omitempty" url:"apiSecret,omitempty"`
	ApiVersion     int64               `json:"apiVersion,omitempty" url:"apiVersion,omitempty"`
	Passphrase     string              `json:"passphrase,omitempty" url:"passphrase,omitempty"`
	Permission     string              `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist    string              `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
	CreatedAt      int64               `json:"createdAt,omitempty" url:"createdAt,omitempty"`
}

func (o *AddSubAccountApiResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// AddSubAccountReq is ported from the Java UTA SDK model.
type AddSubAccountReq struct {
	Password string `json:"password,omitempty" url:"password,omitempty"`
	Remarks  string `json:"remarks,omitempty" url:"remarks,omitempty"`
	SubName  string `json:"subName,omitempty" url:"subName,omitempty"`
	Access   string `json:"access,omitempty" url:"access,omitempty"`
}

// AddSubAccountResp is ported from the Java UTA SDK model.
type AddSubAccountResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Uid            int64               `json:"uid,omitempty" url:"uid,omitempty"`
	SubName        string              `json:"subName,omitempty" url:"subName,omitempty"`
	Remarks        string              `json:"remarks,omitempty" url:"remarks,omitempty"`
	Access         string              `json:"access,omitempty" url:"access,omitempty"`
}

func (o *AddSubAccountResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ApiUaV1SubAccountAddTradeTypePostRequest is ported from the Java UTA SDK model.
type ApiUaV1SubAccountAddTradeTypePostRequest struct {
	SubUid    int64  `json:"subUid,omitempty" url:"subUid,omitempty"`
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
}

// ApiUaV1SubAccountAddTradeTypeResponse is ported from the Java UTA SDK model.
type ApiUaV1SubAccountAddTradeTypeResponse struct {
	Code string `json:"code,omitempty" url:"code,omitempty"`
	Data string `json:"data,omitempty" url:"data,omitempty"`
}

// CancelWithdrawalReq is ported from the Java UTA SDK model.
type CancelWithdrawalReq struct {
	WithdrawId string `json:"withdrawId,omitempty" url:"withdrawId,omitempty"`
}

// CancelWithdrawalResp is ported from the Java UTA SDK model.
type CancelWithdrawalResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	WithdrawId     string              `json:"withdrawId,omitempty" url:"withdrawId,omitempty"`
}

func (o *CancelWithdrawalResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// DeleteSubAccountApiReq is ported from the Java UTA SDK model.
type DeleteSubAccountApiReq struct {
	ApiKey     string `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	SubName    string `json:"subName,omitempty" url:"subName,omitempty"`
	Passphrase string `json:"passphrase,omitempty" url:"passphrase,omitempty"`
}

// DeleteSubAccountApiResp is ported from the Java UTA SDK model.
type DeleteSubAccountApiResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	SubName        string              `json:"subName,omitempty" url:"subName,omitempty"`
	ApiKey         string              `json:"apiKey,omitempty" url:"apiKey,omitempty"`
}

func (o *DeleteSubAccountApiResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// FlexTransferReq is ported from the Java UTA SDK model.
type FlexTransferReq struct {
	ClientOid       string `json:"clientOid,omitempty" url:"clientOid,omitempty"`
	TransferType    string `json:"transferType,omitempty" url:"transferType,omitempty"`
	Currency        string `json:"currency,omitempty" url:"currency,omitempty"`
	Amount          string `json:"amount,omitempty" url:"amount,omitempty"`
	FromUid         string `json:"fromUid,omitempty" url:"fromUid,omitempty"`
	FromAccountType string `json:"fromAccountType,omitempty" url:"fromAccountType,omitempty"`
	FromAccountTag  string `json:"fromAccountTag,omitempty" url:"fromAccountTag,omitempty"`
	ToUid           string `json:"toUid,omitempty" url:"toUid,omitempty"`
	ToAccountType   string `json:"toAccountType,omitempty" url:"toAccountType,omitempty"`
	ToAccountTag    string `json:"toAccountTag,omitempty" url:"toAccountTag,omitempty"`
}

// FlexTransferResp is ported from the Java UTA SDK model.
type FlexTransferResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	OrderId        string              `json:"orderId,omitempty" url:"orderId,omitempty"`
	ClientOid      string              `json:"clientOid,omitempty" url:"clientOid,omitempty"`
}

func (o *FlexTransferResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetAccountAccounts is ported from the Java UTA SDK model.
type GetAccountAccounts struct {
	Currencies []GetAccountAccountsCurrencies `json:"currencies,omitempty" url:"currencies,omitempty"`
}

// GetAccountAccountsCurrencies is ported from the Java UTA SDK model.
type GetAccountAccountsCurrencies struct {
	Currency         string `json:"currency,omitempty" url:"currency,omitempty"`
	Equity           string `json:"equity,omitempty" url:"equity,omitempty"`
	Hold             string `json:"hold,omitempty" url:"hold,omitempty"`
	Balance          string `json:"balance,omitempty" url:"balance,omitempty"`
	Available        string `json:"available,omitempty" url:"available,omitempty"`
	Liability        string `json:"liability,omitempty" url:"liability,omitempty"`
	PotentialBorrow  string `json:"potentialBorrow,omitempty" url:"potentialBorrow,omitempty"`
	CollateralStatus string `json:"collateralStatus,omitempty" url:"collateralStatus,omitempty"`
}

// GetAccountLedgerItems is ported from the Java UTA SDK model.
type GetAccountLedgerItems struct {
	AccountType  string `json:"accountType,omitempty" url:"accountType,omitempty"`
	Id           string `json:"id,omitempty" url:"id,omitempty"`
	Currency     string `json:"currency,omitempty" url:"currency,omitempty"`
	Direction    string `json:"direction,omitempty" url:"direction,omitempty"`
	BusinessType string `json:"businessType,omitempty" url:"businessType,omitempty"`
	Amount       string `json:"amount,omitempty" url:"amount,omitempty"`
	Balance      string `json:"balance,omitempty" url:"balance,omitempty"`
	Fee          string `json:"fee,omitempty" url:"fee,omitempty"`
	Tax          string `json:"tax,omitempty" url:"tax,omitempty"`
	Remark       string `json:"remark,omitempty" url:"remark,omitempty"`
	Ts           int64  `json:"ts,omitempty" url:"ts,omitempty"`
}

// GetAccountLedgerReq is ported from the Java UTA SDK model.
type GetAccountLedgerReq struct {
	AccountType  string `json:"accountType,omitempty" url:"accountType,omitempty"`
	BusinessType string `json:"businessType,omitempty" url:"businessType,omitempty"`
	Currency     string `json:"currency,omitempty" url:"currency,omitempty"`
	Direction    string `json:"direction,omitempty" url:"direction,omitempty"`
	StartAt      int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt        int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	PageSize     int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	LastId       int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// GetAccountLedgerResp is ported from the Java UTA SDK model.
type GetAccountLedgerResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Value          any                 `json:"value,omitempty"`
}

func (o *GetAccountLedgerResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON mirrors the Java delegating creator: the API may return either
// an array or an object directly in the data field.
func (o *GetAccountLedgerResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Value)
}

// GetAccountModeResp is ported from the Java UTA SDK model.
type GetAccountModeResp struct {
	CommonResponse    *types.RestResponse `json:"-"`
	SelfAccountMode   string              `json:"selfAccountMode,omitempty" url:"selfAccountMode,omitempty"`
	UnifiedSubAccount []int32             `json:"unifiedSubAccount,omitempty" url:"unifiedSubAccount,omitempty"`
	ClassicSubAccount []int32             `json:"classicSubAccount,omitempty" url:"classicSubAccount,omitempty"`
}

func (o *GetAccountModeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetAccountOverviewResp is ported from the Java UTA SDK model.
type GetAccountOverviewResp struct {
	CommonResponse  *types.RestResponse `json:"-"`
	AccountType     string              `json:"accountType,omitempty" url:"accountType,omitempty"`
	RiskRatio       string              `json:"riskRatio,omitempty" url:"riskRatio,omitempty"`
	Equity          string              `json:"equity,omitempty" url:"equity,omitempty"`
	AdjustedEquity  string              `json:"adjustedEquity,omitempty" url:"adjustedEquity,omitempty"`
	Liability       string              `json:"liability,omitempty" url:"liability,omitempty"`
	AvailableMargin string              `json:"availableMargin,omitempty" url:"availableMargin,omitempty"`
	Im              string              `json:"im,omitempty" url:"im,omitempty"`
	Mm              string              `json:"mm,omitempty" url:"mm,omitempty"`
}

func (o *GetAccountOverviewResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetAccountResp is ported from the Java UTA SDK model.
type GetAccountResp struct {
	CommonResponse *types.RestResponse  `json:"-"`
	AccountType    string               `json:"accountType,omitempty" url:"accountType,omitempty"`
	Ts             int64                `json:"ts,omitempty" url:"ts,omitempty"`
	Accounts       []GetAccountAccounts `json:"accounts,omitempty" url:"accounts,omitempty"`
}

func (o *GetAccountResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetAllRateLimitList is ported from the Java UTA SDK model.
type GetAllRateLimitList struct {
	Uid  string `json:"uid,omitempty" url:"uid,omitempty"`
	Rate int64  `json:"rate,omitempty" url:"rate,omitempty"`
}

// GetAllRateLimitResp is ported from the Java UTA SDK model.
type GetAllRateLimitResp struct {
	CommonResponse *types.RestResponse   `json:"-"`
	List           []GetAllRateLimitList `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetAllRateLimitResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetApikeyInfoResp is ported from the Java UTA SDK model.
type GetApikeyInfoResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Uid            int64               `json:"uid,omitempty" url:"uid,omitempty"`
	ParentUid      int64               `json:"parentUid,omitempty" url:"parentUid,omitempty"`
	Region         string              `json:"region,omitempty" url:"region,omitempty"`
	KycStatus      int64               `json:"kycStatus,omitempty" url:"kycStatus,omitempty"`
	SubName        string              `json:"subName,omitempty" url:"subName,omitempty"`
	Remark         string              `json:"remark,omitempty" url:"remark,omitempty"`
	ApiKey         string              `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	ApiVersion     int64               `json:"apiVersion,omitempty" url:"apiVersion,omitempty"`
	Permission     string              `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist    string              `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
	IsMaster       bool                `json:"isMaster,omitempty" url:"isMaster,omitempty"`
	CreatedAt      int64               `json:"createdAt,omitempty" url:"createdAt,omitempty"`
	ExpiredAt      int64               `json:"expiredAt,omitempty" url:"expiredAt,omitempty"`
	ThirdPartyApp  string              `json:"thirdPartyApp,omitempty" url:"thirdPartyApp,omitempty"`
	SiteType       string              `json:"siteType,omitempty" url:"siteType,omitempty"`
}

func (o *GetApikeyInfoResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetBorrowingRatesAndLimitsReq is ported from the Java UTA SDK model.
type GetBorrowingRatesAndLimitsReq struct {
	Currency string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetBorrowingRatesAndLimitsResp is ported from the Java UTA SDK model.
type GetBorrowingRatesAndLimitsResp struct {
	CommonResponse          *types.RestResponse `json:"-"`
	CurrentRateHourly       string              `json:"currentRateHourly,omitempty" url:"currentRateHourly,omitempty"`
	CurrentRateDaily        string              `json:"currentRateDaily,omitempty" url:"currentRateDaily,omitempty"`
	BorrowLimitTotal        string              `json:"borrowLimitTotal,omitempty" url:"borrowLimitTotal,omitempty"`
	BorrowLimitTotalHold    string              `json:"borrowLimitTotalHold,omitempty" url:"borrowLimitTotalHold,omitempty"`
	BorrowLimitHold         string              `json:"borrowLimitHold,omitempty" url:"borrowLimitHold,omitempty"`
	InterestFreeBorrowLimit string              `json:"interestFreeBorrowLimit,omitempty" url:"interestFreeBorrowLimit,omitempty"`
}

func (o *GetBorrowingRatesAndLimitsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetClassicAccountBalanceAccounts is ported from the Java UTA SDK model.
type GetClassicAccountBalanceAccounts struct {
	AccountSubtype string                                       `json:"accountSubtype,omitempty" url:"accountSubtype,omitempty"`
	AccountSubType string                                       `json:"accountSubType,omitempty" url:"accountSubType,omitempty"`
	RiskRatio      string                                       `json:"riskRatio,omitempty" url:"riskRatio,omitempty"`
	Currencies     []GetClassicAccountBalanceAccountsCurrencies `json:"currencies,omitempty" url:"currencies,omitempty"`
}

// GetClassicAccountBalanceAccountsCurrencies is ported from the Java UTA SDK model.
type GetClassicAccountBalanceAccountsCurrencies struct {
	Currency                 string `json:"currency,omitempty" url:"currency,omitempty"`
	Locked                   string `json:"locked,omitempty" url:"locked,omitempty"`
	Available                string `json:"available,omitempty" url:"available,omitempty"`
	Balance                  string `json:"balance,omitempty" url:"balance,omitempty"`
	Equity                   string `json:"equity,omitempty" url:"equity,omitempty"`
	CrossOrderMargin         string `json:"crossOrderMargin,omitempty" url:"crossOrderMargin,omitempty"`
	CrossPosMargin           string `json:"crossPosMargin,omitempty" url:"crossPosMargin,omitempty"`
	CrossUnPnl               string `json:"crossUnPnl,omitempty" url:"crossUnPnl,omitempty"`
	IsolatedFundingFeeMargin string `json:"isolatedFundingFeeMargin,omitempty" url:"isolatedFundingFeeMargin,omitempty"`
	IsolatedOrderMargin      string `json:"isolatedOrderMargin,omitempty" url:"isolatedOrderMargin,omitempty"`
	IsolatedPosMargin        string `json:"isolatedPosMargin,omitempty" url:"isolatedPosMargin,omitempty"`
	IsolatedUnPnl            string `json:"isolatedUnPnl,omitempty" url:"isolatedUnPnl,omitempty"`
	TotalCrossMargin         string `json:"totalCrossMargin,omitempty" url:"totalCrossMargin,omitempty"`
	Liability                string `json:"liability,omitempty" url:"liability,omitempty"`
}

// GetClassicAccountBalanceReq is ported from the Java UTA SDK model.
type GetClassicAccountBalanceReq struct {
	AccountSubtype string `json:"accountSubtype,omitempty" url:"accountSubtype,omitempty"`
	AccountType    string `json:"accountType,omitempty" url:"accountType,omitempty"`
	Currency       string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetClassicAccountBalanceResp is ported from the Java UTA SDK model.
type GetClassicAccountBalanceResp struct {
	CommonResponse *types.RestResponse                `json:"-"`
	AccountType    string                             `json:"accountType,omitempty" url:"accountType,omitempty"`
	Ts             int64                              `json:"ts,omitempty" url:"ts,omitempty"`
	Accounts       []GetClassicAccountBalanceAccounts `json:"accounts,omitempty" url:"accounts,omitempty"`
}

func (o *GetClassicAccountBalanceResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetDepositAddressData is ported from the Java UTA SDK model.
type GetDepositAddressData struct {
	Currency        string `json:"currency,omitempty" url:"currency,omitempty"`
	Chain           string `json:"chain,omitempty" url:"chain,omitempty"`
	ChainName       string `json:"chainName,omitempty" url:"chainName,omitempty"`
	Address         string `json:"address,omitempty" url:"address,omitempty"`
	Memo            string `json:"memo,omitempty" url:"memo,omitempty"`
	Remark          string `json:"remark,omitempty" url:"remark,omitempty"`
	ToAccountType   string `json:"toAccountType,omitempty" url:"toAccountType,omitempty"`
	ContractAddress string `json:"contractAddress,omitempty" url:"contractAddress,omitempty"`
	ExpirationDate  int64  `json:"expirationDate,omitempty" url:"expirationDate,omitempty"`
}

// GetDepositAddressReq is ported from the Java UTA SDK model.
type GetDepositAddressReq struct {
	Chain    string `json:"chain,omitempty" url:"chain,omitempty"`
	Currency string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetDepositAddressResp is ported from the Java UTA SDK model.
type GetDepositAddressResp struct {
	CommonResponse *types.RestResponse     `json:"-"`
	Data           []GetDepositAddressData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetDepositAddressResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

func (o *GetDepositAddressResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetDepositHistoryItems is ported from the Java UTA SDK model.
type GetDepositHistoryItems struct {
	Id              string `json:"id,omitempty" url:"id,omitempty"`
	Currency        string `json:"currency,omitempty" url:"currency,omitempty"`
	Chain           string `json:"chain,omitempty" url:"chain,omitempty"`
	Status          string `json:"status,omitempty" url:"status,omitempty"`
	Address         string `json:"address,omitempty" url:"address,omitempty"`
	Memo            string `json:"memo,omitempty" url:"memo,omitempty"`
	IsInner         bool   `json:"isInner,omitempty" url:"isInner,omitempty"`
	Amount          string `json:"amount,omitempty" url:"amount,omitempty"`
	Fee             string `json:"fee,omitempty" url:"fee,omitempty"`
	WalletTxId      string `json:"walletTxId,omitempty" url:"walletTxId,omitempty"`
	CreatedAt       int64  `json:"createdAt,omitempty" url:"createdAt,omitempty"`
	UpdatedAt       int64  `json:"updatedAt,omitempty" url:"updatedAt,omitempty"`
	Remark          string `json:"remark,omitempty" url:"remark,omitempty"`
	Arrears         bool   `json:"arrears,omitempty" url:"arrears,omitempty"`
	Url             string `json:"url,omitempty" url:"url,omitempty"`
	StatusRemark    string `json:"statusRemark,omitempty" url:"statusRemark,omitempty"`
	PreConfirms     int64  `json:"preConfirms,omitempty" url:"preConfirms,omitempty"`
	Confirms        int64  `json:"confirms,omitempty" url:"confirms,omitempty"`
	CurrentConfirms int64  `json:"currentConfirms,omitempty" url:"currentConfirms,omitempty"`
}

// GetDepositHistoryReq is ported from the Java UTA SDK model.
type GetDepositHistoryReq struct {
	Currency    string `json:"currency,omitempty" url:"currency,omitempty"`
	Id          string `json:"id,omitempty" url:"id,omitempty"`
	Status      string `json:"status,omitempty" url:"status,omitempty"`
	StartAt     int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt       int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	CurrentPage int64  `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize    int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetDepositHistoryResp is ported from the Java UTA SDK model.
type GetDepositHistoryResp struct {
	CommonResponse *types.RestResponse      `json:"-"`
	CurrentPage    int64                    `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize       int64                    `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64                    `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64                    `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	Items          []GetDepositHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetDepositHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetFeeRateList is ported from the Java UTA SDK model.
type GetFeeRateList struct {
	Symbol       string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TakerFeeRate string `json:"takerFeeRate,omitempty" url:"takerFeeRate,omitempty"`
	MakerFeeRate string `json:"makerFeeRate,omitempty" url:"makerFeeRate,omitempty"`
}

// GetFeeRateReq is ported from the Java UTA SDK model.
type GetFeeRateReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetFeeRateResp is ported from the Java UTA SDK model.
type GetFeeRateResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	List           []GetFeeRateList    `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetFeeRateResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetInterestHistoryItems is ported from the Java UTA SDK model.
type GetInterestHistoryItems struct {
	Liability             string `json:"liability,omitempty" url:"liability,omitempty"`
	Interest              string `json:"interest,omitempty" url:"interest,omitempty"`
	HourlyInterestRate    string `json:"hourlyInterestRate,omitempty" url:"hourlyInterestRate,omitempty"`
	Currency              string `json:"currency,omitempty" url:"currency,omitempty"`
	Ts                    int64  `json:"ts,omitempty" url:"ts,omitempty"`
	InterestFreeLiability string `json:"interestFreeLiability,omitempty" url:"interestFreeLiability,omitempty"`
}

// GetInterestHistoryReq is ported from the Java UTA SDK model.
type GetInterestHistoryReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
	Currency    string `json:"currency,omitempty" url:"currency,omitempty"`
	StartTime   int64  `json:"startTime,omitempty" url:"startTime,omitempty"`
	EndTime     int64  `json:"endTime,omitempty" url:"endTime,omitempty"`
	Page        int64  `json:"page,omitempty" url:"page,omitempty"`
	Size        int64  `json:"size,omitempty" url:"size,omitempty"`
}

// GetInterestHistoryResp is ported from the Java UTA SDK model.
type GetInterestHistoryResp struct {
	CommonResponse *types.RestResponse       `json:"-"`
	Items          []GetInterestHistoryItems `json:"items,omitempty" url:"items,omitempty"`
	LastId         int64                     `json:"lastId,omitempty" url:"lastId,omitempty"`
}

func (o *GetInterestHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetLeverageData is ported from the Java UTA SDK model.
type GetLeverageData struct {
	Currency   string `json:"currency,omitempty" url:"currency,omitempty"`
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Leverage   string `json:"leverage,omitempty" url:"leverage,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// GetLeverageReq is ported from the Java UTA SDK model.
type GetLeverageReq struct {
	Currency   string `json:"currency,omitempty" url:"currency,omitempty"`
	Symbol     string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType  string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	MarginMode string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
}

// GetLeverageResp is ported from the Java UTA SDK model.
type GetLeverageResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           []GetLeverageData   `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetLeverageResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON handles this endpoint's array-shaped data payload while keeping
// the public response API as GetLeverageResp{Data: ...}.
func (o *GetLeverageResp) UnmarshalJSON(data []byte) error {
	var items []GetLeverageData
	if err := json.Unmarshal(data, &items); err != nil {
		return err
	}
	o.Data = items
	return nil
}

// GetOESCustodyQuotaData is ported from the Java UTA SDK model.
type GetOESCustodyQuotaData struct {
	Custodian    string `json:"custodian,omitempty" url:"custodian,omitempty"`
	Currency     string `json:"currency,omitempty" url:"currency,omitempty"`
	CustodyQuota string `json:"custodyQuota,omitempty" url:"custodyQuota,omitempty"`
}

// GetOESCustodyQuotaReq is ported from the Java UTA SDK model.
type GetOESCustodyQuotaReq struct {
	Custodian string `json:"custodian,omitempty" url:"custodian,omitempty"`
	Currency  string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetOESCustodyQuotaResp is ported from the Java UTA SDK model.
type GetOESCustodyQuotaResp struct {
	CommonResponse *types.RestResponse      `json:"-"`
	Data           []GetOESCustodyQuotaData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetOESCustodyQuotaResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

func (o *GetOESCustodyQuotaResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetRateLimitCapResp is ported from the Java UTA SDK model.
type GetRateLimitCapResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	VipLevel       int64               `json:"vipLevel,omitempty" url:"vipLevel,omitempty"`
	MainRateLimit  int64               `json:"mainRateLimit,omitempty" url:"mainRateLimit,omitempty"`
	SubRateLimit   int64               `json:"subRateLimit,omitempty" url:"subRateLimit,omitempty"`
	AllocatedQuota int64               `json:"allocatedQuota,omitempty" url:"allocatedQuota,omitempty"`
	RemainingQuota int64               `json:"remainingQuota,omitempty" url:"remainingQuota,omitempty"`
	DefaultQuota   int64               `json:"defaultQuota,omitempty" url:"defaultQuota,omitempty"`
}

func (o *GetRateLimitCapResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetRateLimitList is ported from the Java UTA SDK model.
type GetRateLimitList struct {
	Uid  string `json:"uid,omitempty" url:"uid,omitempty"`
	Rate int64  `json:"rate,omitempty" url:"rate,omitempty"`
}

// GetRateLimitReq is ported from the Java UTA SDK model.
type GetRateLimitReq struct {
	Uids string `json:"uids,omitempty" url:"uids,omitempty"`
}

// GetRateLimitResp is ported from the Java UTA SDK model.
type GetRateLimitResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	List           []GetRateLimitList  `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetRateLimitResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetSubAccountApiListData is ported from the Java UTA SDK model.
type GetSubAccountApiListData struct {
	SubName     string `json:"subName,omitempty" url:"subName,omitempty"`
	Remark      string `json:"remark,omitempty" url:"remark,omitempty"`
	ApiKey      string `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	ApiVersion  int64  `json:"apiVersion,omitempty" url:"apiVersion,omitempty"`
	Permission  string `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist string `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
	CreatedAt   int64  `json:"createdAt,omitempty" url:"createdAt,omitempty"`
	Uid         int64  `json:"uid,omitempty" url:"uid,omitempty"`
	IsMaster    bool   `json:"isMaster,omitempty" url:"isMaster,omitempty"`
}

// GetSubAccountApiListReq is ported from the Java UTA SDK model.
type GetSubAccountApiListReq struct {
	ApiKey  string `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	SubName string `json:"subName,omitempty" url:"subName,omitempty"`
}

// GetSubAccountApiListResp is ported from the Java UTA SDK model.
type GetSubAccountApiListResp struct {
	CommonResponse *types.RestResponse        `json:"-"`
	Data           []GetSubAccountApiListData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetSubAccountApiListResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

func (o *GetSubAccountApiListResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetSubAccountBalanceReq is ported from the Java UTA SDK model.
type GetSubAccountBalanceReq struct {
	Uid      string `json:"uid,omitempty" url:"uid,omitempty"`
	PageSize int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	LastId   int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// GetSubAccountBalanceResp is ported from the Java UTA SDK model.
type GetSubAccountBalanceResp struct {
	CommonResponse *types.RestResponse            `json:"-"`
	Ts             int64                          `json:"ts,omitempty" url:"ts,omitempty"`
	UserList       []GetSubAccountBalanceUserList `json:"userList,omitempty" url:"userList,omitempty"`
}

func (o *GetSubAccountBalanceResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetSubAccountBalanceUserList is ported from the Java UTA SDK model.
type GetSubAccountBalanceUserList struct {
	Uid      int64                                  `json:"uid,omitempty" url:"uid,omitempty"`
	Accounts []GetSubAccountBalanceUserListAccounts `json:"accounts,omitempty" url:"accounts,omitempty"`
}

// GetSubAccountBalanceUserListAccounts is ported from the Java UTA SDK model.
type GetSubAccountBalanceUserListAccounts struct {
	AccountType    string                                           `json:"accountType,omitempty" url:"accountType,omitempty"`
	SubAccountType string                                           `json:"subAccountType,omitempty" url:"subAccountType,omitempty"`
	Currencies     []GetSubAccountBalanceUserListAccountsCurrencies `json:"currencies,omitempty" url:"currencies,omitempty"`
}

// GetSubAccountBalanceUserListAccountsCurrencies is ported from the Java UTA SDK model.
type GetSubAccountBalanceUserListAccountsCurrencies struct {
	Currency           string `json:"currency,omitempty" url:"currency,omitempty"`
	Locked             string `json:"locked,omitempty" url:"locked,omitempty"`
	Available          string `json:"available,omitempty" url:"available,omitempty"`
	Balance            string `json:"balance,omitempty" url:"balance,omitempty"`
	Equity             string `json:"equity,omitempty" url:"equity,omitempty"`
	Liability          string `json:"liability,omitempty" url:"liability,omitempty"`
	LiabilityInterest  string `json:"liabilityInterest,omitempty" url:"liabilityInterest,omitempty"`
	LiabilityPrincipal string `json:"liabilityPrincipal,omitempty" url:"liabilityPrincipal,omitempty"`
	UnrealisedPnl      string `json:"unrealisedPnl,omitempty" url:"unrealisedPnl,omitempty"`
}

// GetSubAccountListItems is ported from the Java UTA SDK model.
type GetSubAccountListItems struct {
	UserId           string   `json:"userId,omitempty" url:"userId,omitempty"`
	Uid              int64    `json:"uid,omitempty" url:"uid,omitempty"`
	SubName          string   `json:"subName,omitempty" url:"subName,omitempty"`
	Status           int64    `json:"status,omitempty" url:"status,omitempty"`
	Type             int64    `json:"type,omitempty" url:"type,omitempty"`
	Access           string   `json:"access,omitempty" url:"access,omitempty"`
	CreatedAt        int64    `json:"createdAt,omitempty" url:"createdAt,omitempty"`
	Remarks          string   `json:"remarks,omitempty" url:"remarks,omitempty"`
	TradeTypes       []string `json:"tradeTypes,omitempty" url:"tradeTypes,omitempty"`
	OpenedTradeTypes []string `json:"openedTradeTypes,omitempty" url:"openedTradeTypes,omitempty"`
	HostedStatus     int64    `json:"hostedStatus,omitempty" url:"hostedStatus,omitempty"`
}

// GetSubAccountListReq is ported from the Java UTA SDK model.
type GetSubAccountListReq struct {
	CurrentPage int64 `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize    int64 `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetSubAccountListResp is ported from the Java UTA SDK model.
type GetSubAccountListResp struct {
	CommonResponse *types.RestResponse      `json:"-"`
	CurrentPage    int64                    `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize       int64                    `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64                    `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64                    `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	Items          []GetSubAccountListItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetSubAccountListResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTransferQuotaReq is ported from the Java UTA SDK model.
type GetTransferQuotaReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
	Currency    string `json:"currency,omitempty" url:"currency,omitempty"`
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetTransferQuotaResp is ported from the Java UTA SDK model.
type GetTransferQuotaResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	AccountType    string              `json:"accountType,omitempty" url:"accountType,omitempty"`
	Currency       string              `json:"currency,omitempty" url:"currency,omitempty"`
	Transferable   string              `json:"transferable,omitempty" url:"transferable,omitempty"`
}

func (o *GetTransferQuotaResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetWithdrawalHistoryItems is ported from the Java UTA SDK model.
type GetWithdrawalHistoryItems struct {
	Id               string `json:"id,omitempty" url:"id,omitempty"`
	Currency         string `json:"currency,omitempty" url:"currency,omitempty"`
	Chain            string `json:"chain,omitempty" url:"chain,omitempty"`
	Status           string `json:"status,omitempty" url:"status,omitempty"`
	Address          string `json:"address,omitempty" url:"address,omitempty"`
	Memo             string `json:"memo,omitempty" url:"memo,omitempty"`
	IsInner          bool   `json:"isInner,omitempty" url:"isInner,omitempty"`
	Amount           string `json:"amount,omitempty" url:"amount,omitempty"`
	Fee              string `json:"fee,omitempty" url:"fee,omitempty"`
	FailureReason    string `json:"failureReason,omitempty" url:"failureReason,omitempty"`
	FailureReasonMsg string `json:"failureReasonMsg,omitempty" url:"failureReasonMsg,omitempty"`
	WalletTxId       string `json:"walletTxId,omitempty" url:"walletTxId,omitempty"`
	CreatedAt        int64  `json:"createdAt,omitempty" url:"createdAt,omitempty"`
	UpdatedAt        int64  `json:"updatedAt,omitempty" url:"updatedAt,omitempty"`
	Remark           string `json:"remark,omitempty" url:"remark,omitempty"`
	SubStatus        string `json:"subStatus,omitempty" url:"subStatus,omitempty"`
}

// GetWithdrawalHistoryReq is ported from the Java UTA SDK model.
type GetWithdrawalHistoryReq struct {
	Currency    string `json:"currency,omitempty" url:"currency,omitempty"`
	Id          string `json:"id,omitempty" url:"id,omitempty"`
	Status      string `json:"status,omitempty" url:"status,omitempty"`
	StartAt     int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt       int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	CurrentPage int64  `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize    int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetWithdrawalHistoryResp is ported from the Java UTA SDK model.
type GetWithdrawalHistoryResp struct {
	CommonResponse *types.RestResponse         `json:"-"`
	CurrentPage    int64                       `json:"currentPage,omitempty" url:"currentPage,omitempty"`
	PageSize       int64                       `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	TotalNum       int64                       `json:"totalNum,omitempty" url:"totalNum,omitempty"`
	TotalPage      int64                       `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	Items          []GetWithdrawalHistoryItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *GetWithdrawalHistoryResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetWithdrawalQuotasReq is ported from the Java UTA SDK model.
type GetWithdrawalQuotasReq struct {
	Chain        string `json:"chain,omitempty" url:"chain,omitempty"`
	Currency     string `json:"currency,omitempty" url:"currency,omitempty"`
	IsInner      bool   `json:"isInner,omitempty" url:"isInner,omitempty"`
	WithdrawType string `json:"withdrawType,omitempty" url:"withdrawType,omitempty"`
}

// GetWithdrawalQuotasResp is ported from the Java UTA SDK model.
type GetWithdrawalQuotasResp struct {
	CommonResponse           *types.RestResponse `json:"-"`
	Currency                 string              `json:"currency,omitempty" url:"currency,omitempty"`
	Chain                    string              `json:"chain,omitempty" url:"chain,omitempty"`
	ChainName                string              `json:"chainName,omitempty" url:"chainName,omitempty"`
	IsWithdrawEnabled        bool                `json:"isWithdrawEnabled,omitempty" url:"isWithdrawEnabled,omitempty"`
	Reason                   string              `json:"reason,omitempty" url:"reason,omitempty"`
	AvailableWithdrawAmount  string              `json:"availableWithdrawAmount,omitempty" url:"availableWithdrawAmount,omitempty"`
	RemainingQuotaAmount     string              `json:"remainingQuotaAmount,omitempty" url:"remainingQuotaAmount,omitempty"`
	LockedAmount             string              `json:"lockedAmount,omitempty" url:"lockedAmount,omitempty"`
	WithdrawMinSize          string              `json:"withdrawMinSize,omitempty" url:"withdrawMinSize,omitempty"`
	MinWithdrawFee           string              `json:"minWithdrawFee,omitempty" url:"minWithdrawFee,omitempty"`
	MinInnerWithdrawFee      string              `json:"minInnerWithdrawFee,omitempty" url:"minInnerWithdrawFee,omitempty"`
	Precision                int64               `json:"precision,omitempty" url:"precision,omitempty"`
	QuotaCurrency            string              `json:"quotaCurrency,omitempty" url:"quotaCurrency,omitempty"`
	LimitQuotaCurrencyAmount string              `json:"limitQuotaCurrencyAmount,omitempty" url:"limitQuotaCurrencyAmount,omitempty"`
	UsedQuotaCurrencyAmount  string              `json:"usedQuotaCurrencyAmount,omitempty" url:"usedQuotaCurrencyAmount,omitempty"`
	LimitBTCAmount           string              `json:"limitBTCAmount,omitempty" url:"limitBTCAmount,omitempty"`
	UsedBTCAmount            string              `json:"usedBTCAmount,omitempty" url:"usedBTCAmount,omitempty"`
}

func (o *GetWithdrawalQuotasResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ModifyLeverageReq is ported from the Java UTA SDK model.
type ModifyLeverageReq struct {
	Symbol   string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Leverage string `json:"leverage,omitempty" url:"leverage,omitempty"`
}

// ModifyLeverageResp is ported from the Java UTA SDK model.
type ModifyLeverageResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Code           string              `json:"code,omitempty" url:"code,omitempty"`
	Leverage       string              `json:"leverage,omitempty" url:"leverage,omitempty"`
}

func (o *ModifyLeverageResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ModifyMarginCrossLeverageReq is ported from the Java UTA SDK model.
type ModifyMarginCrossLeverageReq struct {
	Currency string `json:"currency,omitempty" url:"currency,omitempty"`
	Leverage string `json:"leverage,omitempty" url:"leverage,omitempty"`
}

// ModifyMarginCrossLeverageResp is ported from the Java UTA SDK model.
type ModifyMarginCrossLeverageResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Currency       string              `json:"currency,omitempty" url:"currency,omitempty"`
	Leverage       string              `json:"leverage,omitempty" url:"leverage,omitempty"`
}

func (o *ModifyMarginCrossLeverageResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// ModifySubAccountApiReq is ported from the Java UTA SDK model.
type ModifySubAccountApiReq struct {
	SubName     string `json:"subName,omitempty" url:"subName,omitempty"`
	ApiKey      string `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	Passphrase  string `json:"passphrase,omitempty" url:"passphrase,omitempty"`
	Permission  string `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist string `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
	Expire      string `json:"expire,omitempty" url:"expire,omitempty"`
}

// ModifySubAccountApiResp is ported from the Java UTA SDK model.
type ModifySubAccountApiResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	SubName        string              `json:"subName,omitempty" url:"subName,omitempty"`
	ApiKey         string              `json:"apiKey,omitempty" url:"apiKey,omitempty"`
	Permission     string              `json:"permission,omitempty" url:"permission,omitempty"`
	IpWhitelist    string              `json:"ipWhitelist,omitempty" url:"ipWhitelist,omitempty"`
}

func (o *ModifySubAccountApiResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// SetAccountModeReq is ported from the Java UTA SDK model.
type SetAccountModeReq struct {
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
}

// SetAccountModeResp is ported from the Java UTA SDK model.
type SetAccountModeResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           string              `json:"data,omitempty" url:"data,omitempty"`
}

func (o *SetAccountModeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

func (o *SetAccountModeResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// SetKcsFeeDeductionReq is ported from the Java UTA SDK model.
type SetKcsFeeDeductionReq struct {
	Enabled bool `json:"enabled,omitempty" url:"enabled,omitempty"`
}

// SetKcsFeeDeductionResp is ported from the Java UTA SDK model.
type SetKcsFeeDeductionResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Enabled        bool                `json:"enabled,omitempty" url:"enabled,omitempty"`
}

func (o *SetKcsFeeDeductionResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// SetRateLimitItems is ported from the Java UTA SDK model.
type SetRateLimitItems struct {
	Uid  string `json:"uid,omitempty" url:"uid,omitempty"`
	Rate int64  `json:"rate,omitempty" url:"rate,omitempty"`
	Code string `json:"code,omitempty" url:"code,omitempty"`
	Msg  string `json:"msg,omitempty" url:"msg,omitempty"`
}

// SetRateLimitList is ported from the Java UTA SDK model.
type SetRateLimitList struct {
	Uid  string `json:"uid,omitempty" url:"uid,omitempty"`
	Rate int64  `json:"rate,omitempty" url:"rate,omitempty"`
}

// SetRateLimitReq is ported from the Java UTA SDK model.
type SetRateLimitReq struct {
	List []SetRateLimitList `json:"list,omitempty" url:"list,omitempty"`
}

// SetRateLimitResp is ported from the Java UTA SDK model.
type SetRateLimitResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Items          []SetRateLimitItems `json:"items,omitempty" url:"items,omitempty"`
}

func (o *SetRateLimitResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// SetSubAccountTransferPermissionData is ported from the Java UTA SDK model.
type SetSubAccountTransferPermissionData struct {
	SubUid   string `json:"subUid,omitempty" url:"subUid,omitempty"`
	SubToSub bool   `json:"subToSub,omitempty" url:"subToSub,omitempty"`
}

// SetSubAccountTransferPermissionReq is ported from the Java UTA SDK model.
type SetSubAccountTransferPermissionReq struct {
	SubUids  string `json:"subUids,omitempty" url:"subUids,omitempty"`
	SubToSub bool   `json:"subToSub,omitempty" url:"subToSub,omitempty"`
}

// SetSubAccountTransferPermissionResp is ported from the Java UTA SDK model.
type SetSubAccountTransferPermissionResp struct {
	CommonResponse *types.RestResponse                   `json:"-"`
	Data           []SetSubAccountTransferPermissionData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *SetSubAccountTransferPermissionResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

func (o *SetSubAccountTransferPermissionResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// WithdrawalV3Req is ported from the Java UTA SDK model.
type WithdrawalV3Req struct {
	Currency      string `json:"currency,omitempty" url:"currency,omitempty"`
	Chain         string `json:"chain,omitempty" url:"chain,omitempty"`
	Amount        string `json:"amount,omitempty" url:"amount,omitempty"`
	ToAddress     string `json:"toAddress,omitempty" url:"toAddress,omitempty"`
	Memo          string `json:"memo,omitempty" url:"memo,omitempty"`
	Remark        string `json:"remark,omitempty" url:"remark,omitempty"`
	IsInner       bool   `json:"isInner,omitempty" url:"isInner,omitempty"`
	WithdrawType  string `json:"withdrawType,omitempty" url:"withdrawType,omitempty"`
	FeeDeductType string `json:"feeDeductType,omitempty" url:"feeDeductType,omitempty"`
}

// WithdrawalV3Resp is ported from the Java UTA SDK model.
type WithdrawalV3Resp struct {
	CommonResponse *types.RestResponse `json:"-"`
	WithdrawalId   string              `json:"withdrawalId,omitempty" url:"withdrawalId,omitempty"`
}

func (o *WithdrawalV3Resp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}
