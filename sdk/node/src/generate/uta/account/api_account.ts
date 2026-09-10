import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type UtaFlexibleNumber = string | number;
export type UtaObjectOrList = UtaRecord | UtaRecord[];

export type GetInterestHistoryReq = UtaRequestData;
export type GetBorrowingRatesAndLimitsReq = UtaRequestData;
export type SetAccountModeReq = UtaRequestData;
export type GetOESCustodyQuotaReq = UtaRequestData;
export type SetSubAccountTransferPermissionReq = UtaRequestData;
export type GetLeverageReq = UtaRequestData;
export type ModifyMarginCrossLeverageReq = UtaRequestData;
export type ModifyLeverageReq = UtaRequestData;
export type AddSubAccountApiReq = UtaRequestData;
export type GetFeeRateReq = UtaRequestData;
export type ModifySubAccountApiReq = UtaRequestData;
export type DeleteSubAccountApiReq = UtaRequestData;
export type GetSubAccountApiListReq = UtaRequestData;
export type AddSubAccountReq = UtaRequestData;
export type GetAccountLedgerReq = UtaRequestData;
export type GetClassicAccountBalanceReq = UtaRequestData;
export type GetDepositAddressReq = UtaRequestData;
export type GetDepositHistoryReq = UtaRequestData;
export type GetSubAccountBalanceReq = UtaRequestData;
export type GetTransferQuotaReq = UtaRequestData;
export type GetWithdrawalQuotasReq = UtaRequestData;
export type GetWithdrawalHistoryReq = UtaRequestData;
export type GetSubAccountListReq = UtaRequestData;
export type GetRateLimitReq = UtaRequestData;
export type SetRateLimitReq = UtaRequestData;
export type FlexTransferReq = UtaRequestData;
export type SetKcsFeeDeductionReq = UtaRequestData;
export type CancelWithdrawalReq = UtaRequestData;
export type WithdrawalV3Req = UtaRequestData;

export interface GetLeverageData extends UtaRecord {
    symbol?: string;
    currency?: string;
    leverage?: UtaFlexibleNumber;
    marginMode?: string;
}

export interface GetAccountLedgerItem extends UtaRecord {
    id?: string;
    currency?: string;
    amount?: string;
    balance?: string;
    businessType?: string;
    direction?: string;
    createdAt?: UtaFlexibleNumber;
}

export interface GetDepositAddressData extends UtaRecord {
    address?: string;
    memo?: string;
    chain?: string;
    currency?: string;
    chainName?: string;
    toAccountType?: string;
}

export interface GetSubAccountListItem extends UtaRecord {
    userId?: string;
    uid?: UtaFlexibleNumber;
    subName?: string;
    status?: UtaFlexibleNumber;
    type?: UtaFlexibleNumber;
}

export type GetInterestHistoryResp = UtaRestResponse<UtaObjectOrList>;
export type GetBorrowingRatesAndLimitsResp = UtaRestResponse<UtaObjectOrList>;
export type GetAccountModeResp = UtaRestResponse<UtaRecord>;
export type SetAccountModeResp = UtaRestResponse<UtaRecord>;
export type GetOESCustodyQuotaResp = UtaRestResponse<UtaObjectOrList>;
export type SetSubAccountTransferPermissionResp = UtaRestResponse<UtaRecord>;
export type GetAccountResp = UtaRestResponse<UtaObjectOrList>;
export type GetLeverageResp = UtaRestResponse<GetLeverageData[]>;
export type ModifyMarginCrossLeverageResp = UtaRestResponse<UtaRecord>;
export type ModifyLeverageResp = UtaRestResponse<UtaRecord>;
export type GetAccountOverviewResp = UtaRestResponse<UtaRecord>;
export type GetApikeyInfoResp = UtaRestResponse<UtaRecord>;
export type AddSubAccountApiResp = UtaRestResponse<UtaRecord>;
export type GetFeeRateResp = UtaRestResponse<UtaObjectOrList>;
export type ModifySubAccountApiResp = UtaRestResponse<UtaRecord>;
export type DeleteSubAccountApiResp = UtaRestResponse<UtaRecord>;
export type GetSubAccountApiListResp = UtaRestResponse<UtaObjectOrList>;
export type AddSubAccountResp = UtaRestResponse<UtaRecord>;
export type GetAccountLedgerResp = UtaRestResponse<GetAccountLedgerItem[]>;
export type GetClassicAccountBalanceResp = UtaRestResponse<UtaObjectOrList>;
export type GetDepositAddressResp = UtaRestResponse<GetDepositAddressData[]>;
export type GetDepositHistoryResp = UtaRestResponse<UtaObjectOrList>;
export type GetSubAccountBalanceResp = UtaRestResponse<UtaObjectOrList>;
export type GetTransferQuotaResp = UtaRestResponse<UtaObjectOrList>;
export type GetWithdrawalQuotasResp = UtaRestResponse<UtaObjectOrList>;
export type GetWithdrawalHistoryResp = UtaRestResponse<UtaObjectOrList>;
export type GetAllRateLimitResp = UtaRestResponse<UtaObjectOrList>;
export type GetRateLimitCapResp = UtaRestResponse<UtaRecord>;
export type GetSubAccountListResp = UtaRestResponse<{
    currentPage?: UtaFlexibleNumber;
    pageSize?: UtaFlexibleNumber;
    totalNum?: UtaFlexibleNumber;
    totalPage?: UtaFlexibleNumber;
    items?: GetSubAccountListItem[];
}>;
export type GetRateLimitResp = UtaRestResponse<UtaObjectOrList>;
export type SetRateLimitResp = UtaRestResponse<UtaRecord>;
export type FlexTransferResp = UtaRestResponse<UtaRecord>;
export type SetKcsFeeDeductionResp = UtaRestResponse<UtaRecord>;
export type CancelWithdrawalResp = UtaRestResponse<UtaRecord>;
export type WithdrawalV3Resp = UtaRestResponse<UtaRecord>;

/** UTA account, asset, transfer, rate-limit, and sub-account REST APIs. */
export interface AccountAPI {
    getInterestHistory(req: GetInterestHistoryReq): Promise<GetInterestHistoryResp>;
    getBorrowingRatesAndLimits(req: GetBorrowingRatesAndLimitsReq): Promise<GetBorrowingRatesAndLimitsResp>;
    getAccountMode(): Promise<GetAccountModeResp>;
    setAccountMode(req: SetAccountModeReq): Promise<SetAccountModeResp>;
    getOESCustodyQuota(req: GetOESCustodyQuotaReq): Promise<GetOESCustodyQuotaResp>;
    setSubAccountTransferPermission(req: SetSubAccountTransferPermissionReq): Promise<SetSubAccountTransferPermissionResp>;
    getAccount(): Promise<GetAccountResp>;
    getLeverage(req: GetLeverageReq): Promise<GetLeverageResp>;
    modifyMarginCrossLeverage(req: ModifyMarginCrossLeverageReq): Promise<ModifyMarginCrossLeverageResp>;
    modifyLeverage(req: ModifyLeverageReq): Promise<ModifyLeverageResp>;
    getAccountOverview(): Promise<GetAccountOverviewResp>;
    getApikeyInfo(): Promise<GetApikeyInfoResp>;
    addSubAccountApi(req: AddSubAccountApiReq): Promise<AddSubAccountApiResp>;
    getFeeRate(req: GetFeeRateReq): Promise<GetFeeRateResp>;
    modifySubAccountApi(req: ModifySubAccountApiReq): Promise<ModifySubAccountApiResp>;
    deleteSubAccountApi(req: DeleteSubAccountApiReq): Promise<DeleteSubAccountApiResp>;
    getSubAccountApiList(req: GetSubAccountApiListReq): Promise<GetSubAccountApiListResp>;
    addSubAccount(req: AddSubAccountReq): Promise<AddSubAccountResp>;
    getAccountLedger(req: GetAccountLedgerReq): Promise<GetAccountLedgerResp>;
    getClassicAccountBalance(req: GetClassicAccountBalanceReq): Promise<GetClassicAccountBalanceResp>;
    getDepositAddress(req: GetDepositAddressReq): Promise<GetDepositAddressResp>;
    getDepositHistory(req: GetDepositHistoryReq): Promise<GetDepositHistoryResp>;
    getSubAccountBalance(req: GetSubAccountBalanceReq): Promise<GetSubAccountBalanceResp>;
    getTransferQuota(req: GetTransferQuotaReq): Promise<GetTransferQuotaResp>;
    getWithdrawalQuotas(req: GetWithdrawalQuotasReq): Promise<GetWithdrawalQuotasResp>;
    getWithdrawalHistory(req: GetWithdrawalHistoryReq): Promise<GetWithdrawalHistoryResp>;
    getAllRateLimit(): Promise<GetAllRateLimitResp>;
    getRateLimitCap(): Promise<GetRateLimitCapResp>;
    getSubAccountList(req: GetSubAccountListReq): Promise<GetSubAccountListResp>;
    getRateLimit(req: GetRateLimitReq): Promise<GetRateLimitResp>;
    setRateLimit(req: SetRateLimitReq): Promise<SetRateLimitResp>;
    flexTransfer(req: FlexTransferReq): Promise<FlexTransferResp>;
    setKcsFeeDeduction(req: SetKcsFeeDeductionReq): Promise<SetKcsFeeDeductionResp>;
    cancelWithdrawal(req: CancelWithdrawalReq): Promise<CancelWithdrawalResp>;
    withdrawalV3(req: WithdrawalV3Req): Promise<WithdrawalV3Resp>;
}

export class AccountAPIImpl extends UtaApiBase implements AccountAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    getInterestHistory(req: GetInterestHistoryReq) { return this.call('GET', '/api/ua/v2/account/interest-history', req); }
    getBorrowingRatesAndLimits(req: GetBorrowingRatesAndLimitsReq) { return this.call('GET', '/api/ua/v2/account/interest-limits', req); }
    getAccountMode() { return this.call('GET', '/api/ua/v2/account/mode'); }
    setAccountMode(req: SetAccountModeReq) { return this.call('POST', '/api/ua/v2/account/mode', req); }
    getOESCustodyQuota(req: GetOESCustodyQuotaReq) { return this.call('GET', '/api/ua/v2/oes/custody-quota', req); }
    setSubAccountTransferPermission(req: SetSubAccountTransferPermissionReq) { return this.call('POST', '/api/ua/v2/sub-account/canTransferOut', req); }
    getAccount() { return this.call('GET', '/api/ua/v2/unified/account/balance'); }
    getLeverage(req: GetLeverageReq) { return this.call('GET', '/api/ua/v2/unified/account/leverage', req); }
    modifyMarginCrossLeverage(req: ModifyMarginCrossLeverageReq) { return this.call('POST', '/api/ua/v2/unified/account/modify-leverage-margin-cross', req); }
    modifyLeverage(req: ModifyLeverageReq) { return this.call('POST', '/api/ua/v2/unified/account/modify-leverage', req); }
    getAccountOverview() { return this.call('GET', '/api/ua/v2/unified/account/overview'); }
    getApikeyInfo() { return this.call('GET', '/api/ua/v2/user/api-key'); }
    addSubAccountApi(req: AddSubAccountApiReq) { return this.call('POST', '/api/ua/v2/user/create-sub-api-key', req); }
    getFeeRate(req: GetFeeRateReq) { return this.call('GET', '/api/ua/v2/user/fee-rate', req); }
    modifySubAccountApi(req: ModifySubAccountApiReq) { return this.call('POST', '/api/ua/v2/user/modify-sub-api-key', req); }
    deleteSubAccountApi(req: DeleteSubAccountApiReq) { return this.call('DELETE', '/api/ua/v2/user/sub-api-key', req); }
    getSubAccountApiList(req: GetSubAccountApiListReq) { return this.call('GET', '/api/ua/v2/user/sub-api-key', req); }
    addSubAccount(req: AddSubAccountReq) { return this.call('POST', '/api/ua/v2/user/sub/create-sub-account', req); }
    getAccountLedger(req: GetAccountLedgerReq) { return this.call('GET', '/api/ua/v2/account/ledger', req); }
    getClassicAccountBalance(req: GetClassicAccountBalanceReq) { return this.call('GET', '/api/ua/v2/account/balance', req); }
    getDepositAddress(req: GetDepositAddressReq) { return this.call('GET', '/api/ua/v2/asset/deposit/address', req); }
    getDepositHistory(req: GetDepositHistoryReq) { return this.call('GET', '/api/ua/v2/asset/deposit/history', req); }
    getSubAccountBalance(req: GetSubAccountBalanceReq) { return this.call('GET', '/api/ua/v2/sub-account/balance', req); }
    getTransferQuota(req: GetTransferQuotaReq) { return this.call('GET', '/api/ua/v2/account/transfer-quota', req); }
    getWithdrawalQuotas(req: GetWithdrawalQuotasReq) { return this.call('GET', '/api/ua/v2/withdrawals/quotas', req); }
    getWithdrawalHistory(req: GetWithdrawalHistoryReq) { return this.call('GET', '/api/ua/v2/asset/withdrawal/history', req); }
    getAllRateLimit() { return this.call('GET', '/api/ua/v2/rate-limit/query-all'); }
    getRateLimitCap() { return this.call('GET', '/api/ua/v2/rate-limit/query-cap'); }
    getSubAccountList(req: GetSubAccountListReq) { return this.call('GET', '/api/ua/v2/user/sub-account-list', req); }
    getRateLimit(req: GetRateLimitReq) { return this.call('GET', '/api/ua/v2/rate-limit/query', req); }
    setRateLimit(req: SetRateLimitReq) { return this.call('POST', '/api/ua/v2/rate-limit/set', req); }
    flexTransfer(req: FlexTransferReq) { return this.call('POST', '/api/ua/v2/account/transfer', req); }
    setKcsFeeDeduction(req: SetKcsFeeDeductionReq) { return this.call('GET', '/api/ua/v2/account/fee/kcs-deduct', req); }
    cancelWithdrawal(req: CancelWithdrawalReq) { return this.call('POST', '/api/ua/v2/asset/withdraw/cancel', req); }
    withdrawalV3(req: WithdrawalV3Req) { return this.call('POST', '/api/ua/v2/asset/withdrawal', req); }
}
