
package com.kucoin.universal.sdk.generate.uta.account;
import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class AccountApiImpl implements AccountApi {
    private final Transport transport;

    public AccountApiImpl(Transport transport)
    {
        this.transport = transport;
    }

    public  GetInterestHistoryResp getInterestHistory(GetInterestHistoryReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/interest-history", req, GetInterestHistoryResp.class, false);
    }

    public  GetBorrowingRatesAndLimitsResp getBorrowingRatesAndLimits(GetBorrowingRatesAndLimitsReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/interest-limits", req, GetBorrowingRatesAndLimitsResp.class, false);
    }

    public  GetAccountModeResp getAccountMode(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/mode", null, GetAccountModeResp.class, false);
    }

    public  SetAccountModeResp setAccountMode(SetAccountModeReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/account/mode", req, SetAccountModeResp.class, false);
    }

    public  GetOESCustodyQuotaResp getOESCustodyQuota(GetOESCustodyQuotaReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/oes/custody-quota", req, GetOESCustodyQuotaResp.class, false);
    }

    public  SetSubAccountTransferPermissionResp setSubAccountTransferPermission(SetSubAccountTransferPermissionReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/sub-account/canTransferOut", req, SetSubAccountTransferPermissionResp.class, false);
    }

    public  GetAccountResp getAccount(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/unified/account/balance", null, GetAccountResp.class, false);
    }

    public  GetLeverageResp getLeverage(GetLeverageReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/unified/account/leverage", req, GetLeverageResp.class, false);
    }

    public  ModifyMarginCrossLeverageResp modifyMarginCrossLeverage(ModifyMarginCrossLeverageReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/unified/account/modify-leverage-margin-cross", req, ModifyMarginCrossLeverageResp.class, false);
    }

    public  ModifyLeverageResp modifyLeverage(ModifyLeverageReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/unified/account/modify-leverage", req, ModifyLeverageResp.class, false);
    }

    public  GetAccountOverviewResp getAccountOverview(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/unified/account/overview", null, GetAccountOverviewResp.class, false);
    }

    public  GetApikeyInfoResp getApikeyInfo(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/user/api-key", null, GetApikeyInfoResp.class, false);
    }

    public  AddSubAccountApiResp addSubAccountApi(AddSubAccountApiReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/user/create-sub-api-key", req, AddSubAccountApiResp.class, false);
    }

    public  GetFeeRateResp getFeeRate(GetFeeRateReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/user/fee-rate", req, GetFeeRateResp.class, false);
    }

    public  ModifySubAccountApiResp modifySubAccountApi(ModifySubAccountApiReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/user/modify-sub-api-key", req, ModifySubAccountApiResp.class, false);
    }

    public  DeleteSubAccountApiResp deleteSubAccountApi(DeleteSubAccountApiReq req){
        return this.transport.call("spot", false, "DELETE", "/api/ua/v2/user/sub-api-key", req, DeleteSubAccountApiResp.class, false);
    }

    public  GetSubAccountApiListResp getSubAccountApiList(GetSubAccountApiListReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/user/sub-api-key", req, GetSubAccountApiListResp.class, false);
    }

    public  AddSubAccountResp addSubAccount(AddSubAccountReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/user/sub/create-sub-account", req, AddSubAccountResp.class, false);
    }

    public  GetAccountLedgerResp getAccountLedger(GetAccountLedgerReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/ledger", req, GetAccountLedgerResp.class, false);
    }

    public  GetClassicAccountBalanceResp getClassicAccountBalance(GetClassicAccountBalanceReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/balance", req, GetClassicAccountBalanceResp.class, false);
    }

    public  GetDepositAddressResp getDepositAddress(GetDepositAddressReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/asset/deposit/address", req, GetDepositAddressResp.class, false);
    }

    public  GetDepositHistoryResp getDepositHistory(GetDepositHistoryReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/asset/deposit/history", req, GetDepositHistoryResp.class, false);
    }

    public  GetSubAccountBalanceResp getSubAccountBalance(GetSubAccountBalanceReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/sub-account/balance", req, GetSubAccountBalanceResp.class, false);
    }

    public  GetTransferQuotaResp getTransferQuota(GetTransferQuotaReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/transfer-quota", req, GetTransferQuotaResp.class, false);
    }

    public  GetWithdrawalQuotasResp getWithdrawalQuotas(GetWithdrawalQuotasReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/withdrawals/quotas", req, GetWithdrawalQuotasResp.class, false);
    }

    public  GetWithdrawalHistoryResp getWithdrawalHistory(GetWithdrawalHistoryReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/asset/withdrawal/history", req, GetWithdrawalHistoryResp.class, false);
    }

    public  GetAllRateLimitResp getAllRateLimit(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/rate-limit/query-all", null, GetAllRateLimitResp.class, false);
    }

    public  GetRateLimitCapResp getRateLimitCap(){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/rate-limit/query-cap", null, GetRateLimitCapResp.class, false);
    }

    public  GetSubAccountListResp getSubAccountList(GetSubAccountListReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/user/sub-account-list", req, GetSubAccountListResp.class, false);
    }

    public  GetRateLimitResp getRateLimit(GetRateLimitReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/rate-limit/query", req, GetRateLimitResp.class, false);
    }

    public  SetRateLimitResp setRateLimit(SetRateLimitReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/rate-limit/set", req, SetRateLimitResp.class, false);
    }

    public  FlexTransferResp flexTransfer(FlexTransferReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/account/transfer", req, FlexTransferResp.class, false);
    }

    public  SetKcsFeeDeductionResp setKcsFeeDeduction(SetKcsFeeDeductionReq req){
        return this.transport.call("spot", false, "GET", "/api/ua/v2/account/fee/kcs-deduct", req, SetKcsFeeDeductionResp.class, false);
    }

    public  CancelWithdrawalResp cancelWithdrawal(CancelWithdrawalReq req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/asset/withdraw/cancel", req, CancelWithdrawalResp.class, false);
    }

    public  WithdrawalV3Resp withdrawalV3(WithdrawalV3Req req){
        return this.transport.call("spot", false, "POST", "/api/ua/v2/asset/withdrawal", req, WithdrawalV3Resp.class, false);
    }

}
