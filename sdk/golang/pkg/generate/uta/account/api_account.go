// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package account

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type AccountAPI interface {
	GetInterestHistory(req *GetInterestHistoryReq, ctx context.Context) (*GetInterestHistoryResp, error)
	GetBorrowingRatesAndLimits(req *GetBorrowingRatesAndLimitsReq, ctx context.Context) (*GetBorrowingRatesAndLimitsResp, error)
	GetAccountMode(ctx context.Context) (*GetAccountModeResp, error)
	SetAccountMode(req *SetAccountModeReq, ctx context.Context) (*SetAccountModeResp, error)
	GetOESCustodyQuota(req *GetOESCustodyQuotaReq, ctx context.Context) (*GetOESCustodyQuotaResp, error)
	SetSubAccountTransferPermission(req *SetSubAccountTransferPermissionReq, ctx context.Context) (*SetSubAccountTransferPermissionResp, error)
	GetAccount(ctx context.Context) (*GetAccountResp, error)
	GetLeverage(req *GetLeverageReq, ctx context.Context) (*GetLeverageResp, error)
	ModifyMarginCrossLeverage(req *ModifyMarginCrossLeverageReq, ctx context.Context) (*ModifyMarginCrossLeverageResp, error)
	ModifyLeverage(req *ModifyLeverageReq, ctx context.Context) (*ModifyLeverageResp, error)
	GetAccountOverview(ctx context.Context) (*GetAccountOverviewResp, error)
	GetApikeyInfo(ctx context.Context) (*GetApikeyInfoResp, error)
	AddSubAccountApi(req *AddSubAccountApiReq, ctx context.Context) (*AddSubAccountApiResp, error)
	GetFeeRate(req *GetFeeRateReq, ctx context.Context) (*GetFeeRateResp, error)
	ModifySubAccountApi(req *ModifySubAccountApiReq, ctx context.Context) (*ModifySubAccountApiResp, error)
	DeleteSubAccountApi(req *DeleteSubAccountApiReq, ctx context.Context) (*DeleteSubAccountApiResp, error)
	GetSubAccountApiList(req *GetSubAccountApiListReq, ctx context.Context) (*GetSubAccountApiListResp, error)
	AddSubAccount(req *AddSubAccountReq, ctx context.Context) (*AddSubAccountResp, error)
	GetAccountLedger(req *GetAccountLedgerReq, ctx context.Context) (*GetAccountLedgerResp, error)
	GetClassicAccountBalance(req *GetClassicAccountBalanceReq, ctx context.Context) (*GetClassicAccountBalanceResp, error)
	GetDepositAddress(req *GetDepositAddressReq, ctx context.Context) (*GetDepositAddressResp, error)
	GetDepositHistory(req *GetDepositHistoryReq, ctx context.Context) (*GetDepositHistoryResp, error)
	GetSubAccountBalance(req *GetSubAccountBalanceReq, ctx context.Context) (*GetSubAccountBalanceResp, error)
	GetTransferQuota(req *GetTransferQuotaReq, ctx context.Context) (*GetTransferQuotaResp, error)
	GetWithdrawalQuotas(req *GetWithdrawalQuotasReq, ctx context.Context) (*GetWithdrawalQuotasResp, error)
	GetWithdrawalHistory(req *GetWithdrawalHistoryReq, ctx context.Context) (*GetWithdrawalHistoryResp, error)
	GetAllRateLimit(ctx context.Context) (*GetAllRateLimitResp, error)
	GetRateLimitCap(ctx context.Context) (*GetRateLimitCapResp, error)
	GetSubAccountList(req *GetSubAccountListReq, ctx context.Context) (*GetSubAccountListResp, error)
	GetRateLimit(req *GetRateLimitReq, ctx context.Context) (*GetRateLimitResp, error)
	SetRateLimit(req *SetRateLimitReq, ctx context.Context) (*SetRateLimitResp, error)
	FlexTransfer(req *FlexTransferReq, ctx context.Context) (*FlexTransferResp, error)
	SetKcsFeeDeduction(req *SetKcsFeeDeductionReq, ctx context.Context) (*SetKcsFeeDeductionResp, error)
	CancelWithdrawal(req *CancelWithdrawalReq, ctx context.Context) (*CancelWithdrawalResp, error)
	WithdrawalV3(req *WithdrawalV3Req, ctx context.Context) (*WithdrawalV3Resp, error)
}

type AccountAPIImpl struct {
	transport interfaces.Transport
}

func NewAccountAPIImp(transport interfaces.Transport) *AccountAPIImpl {
	return &AccountAPIImpl{transport: transport}
}

func (impl *AccountAPIImpl) GetInterestHistory(req *GetInterestHistoryReq, ctx context.Context) (*GetInterestHistoryResp, error) {
	resp := &GetInterestHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/interest-history", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetBorrowingRatesAndLimits(req *GetBorrowingRatesAndLimitsReq, ctx context.Context) (*GetBorrowingRatesAndLimitsResp, error) {
	resp := &GetBorrowingRatesAndLimitsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/interest-limits", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetAccountMode(ctx context.Context) (*GetAccountModeResp, error) {
	resp := &GetAccountModeResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/mode", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) SetAccountMode(req *SetAccountModeReq, ctx context.Context) (*SetAccountModeResp, error) {
	resp := &SetAccountModeResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/account/mode", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetOESCustodyQuota(req *GetOESCustodyQuotaReq, ctx context.Context) (*GetOESCustodyQuotaResp, error) {
	resp := &GetOESCustodyQuotaResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/oes/custody-quota", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) SetSubAccountTransferPermission(req *SetSubAccountTransferPermissionReq, ctx context.Context) (*SetSubAccountTransferPermissionResp, error) {
	resp := &SetSubAccountTransferPermissionResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/sub-account/canTransferOut", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetAccount(ctx context.Context) (*GetAccountResp, error) {
	resp := &GetAccountResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/account/balance", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetLeverage(req *GetLeverageReq, ctx context.Context) (*GetLeverageResp, error) {
	resp := &GetLeverageResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/account/leverage", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) ModifyMarginCrossLeverage(req *ModifyMarginCrossLeverageReq, ctx context.Context) (*ModifyMarginCrossLeverageResp, error) {
	resp := &ModifyMarginCrossLeverageResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/account/modify-leverage-margin-cross", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) ModifyLeverage(req *ModifyLeverageReq, ctx context.Context) (*ModifyLeverageResp, error) {
	resp := &ModifyLeverageResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/account/modify-leverage", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetAccountOverview(ctx context.Context) (*GetAccountOverviewResp, error) {
	resp := &GetAccountOverviewResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/account/overview", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetApikeyInfo(ctx context.Context) (*GetApikeyInfoResp, error) {
	resp := &GetApikeyInfoResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/api-key", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) AddSubAccountApi(req *AddSubAccountApiReq, ctx context.Context) (*AddSubAccountApiResp, error) {
	resp := &AddSubAccountApiResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/user/create-sub-api-key", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetFeeRate(req *GetFeeRateReq, ctx context.Context) (*GetFeeRateResp, error) {
	resp := &GetFeeRateResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/fee-rate", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) ModifySubAccountApi(req *ModifySubAccountApiReq, ctx context.Context) (*ModifySubAccountApiResp, error) {
	resp := &ModifySubAccountApiResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/user/modify-sub-api-key", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) DeleteSubAccountApi(req *DeleteSubAccountApiReq, ctx context.Context) (*DeleteSubAccountApiResp, error) {
	resp := &DeleteSubAccountApiResp{}
	err := impl.transport.Call(ctx, "spot", false, "Delete", "/api/ua/v2/user/sub-api-key", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetSubAccountApiList(req *GetSubAccountApiListReq, ctx context.Context) (*GetSubAccountApiListResp, error) {
	resp := &GetSubAccountApiListResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/sub-api-key", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) AddSubAccount(req *AddSubAccountReq, ctx context.Context) (*AddSubAccountResp, error) {
	resp := &AddSubAccountResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/user/sub/create-sub-account", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetAccountLedger(req *GetAccountLedgerReq, ctx context.Context) (*GetAccountLedgerResp, error) {
	resp := &GetAccountLedgerResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/ledger", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetClassicAccountBalance(req *GetClassicAccountBalanceReq, ctx context.Context) (*GetClassicAccountBalanceResp, error) {
	resp := &GetClassicAccountBalanceResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/balance", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetDepositAddress(req *GetDepositAddressReq, ctx context.Context) (*GetDepositAddressResp, error) {
	resp := &GetDepositAddressResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/asset/deposit/address", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetDepositHistory(req *GetDepositHistoryReq, ctx context.Context) (*GetDepositHistoryResp, error) {
	resp := &GetDepositHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/asset/deposit/history", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetSubAccountBalance(req *GetSubAccountBalanceReq, ctx context.Context) (*GetSubAccountBalanceResp, error) {
	resp := &GetSubAccountBalanceResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/sub-account/balance", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetTransferQuota(req *GetTransferQuotaReq, ctx context.Context) (*GetTransferQuotaResp, error) {
	resp := &GetTransferQuotaResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/transfer-quota", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetWithdrawalQuotas(req *GetWithdrawalQuotasReq, ctx context.Context) (*GetWithdrawalQuotasResp, error) {
	resp := &GetWithdrawalQuotasResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/withdrawals/quotas", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetWithdrawalHistory(req *GetWithdrawalHistoryReq, ctx context.Context) (*GetWithdrawalHistoryResp, error) {
	resp := &GetWithdrawalHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/asset/withdrawal/history", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetAllRateLimit(ctx context.Context) (*GetAllRateLimitResp, error) {
	resp := &GetAllRateLimitResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/rate-limit/query-all", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetRateLimitCap(ctx context.Context) (*GetRateLimitCapResp, error) {
	resp := &GetRateLimitCapResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/rate-limit/query-cap", nil, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetSubAccountList(req *GetSubAccountListReq, ctx context.Context) (*GetSubAccountListResp, error) {
	resp := &GetSubAccountListResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/sub-account-list", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) GetRateLimit(req *GetRateLimitReq, ctx context.Context) (*GetRateLimitResp, error) {
	resp := &GetRateLimitResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/rate-limit/query", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) SetRateLimit(req *SetRateLimitReq, ctx context.Context) (*SetRateLimitResp, error) {
	resp := &SetRateLimitResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/rate-limit/set", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) FlexTransfer(req *FlexTransferReq, ctx context.Context) (*FlexTransferResp, error) {
	resp := &FlexTransferResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/account/transfer", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) SetKcsFeeDeduction(req *SetKcsFeeDeductionReq, ctx context.Context) (*SetKcsFeeDeductionResp, error) {
	resp := &SetKcsFeeDeductionResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/account/fee/kcs-deduct", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) CancelWithdrawal(req *CancelWithdrawalReq, ctx context.Context) (*CancelWithdrawalResp, error) {
	resp := &CancelWithdrawalResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/asset/withdraw/cancel", req, resp, false)
	return resp, err
}

func (impl *AccountAPIImpl) WithdrawalV3(req *WithdrawalV3Req, ctx context.Context) (*WithdrawalV3Resp, error) {
	resp := &WithdrawalV3Resp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/asset/withdrawal", req, resp, false)
	return resp, err
}
