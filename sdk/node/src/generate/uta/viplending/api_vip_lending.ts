import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type GetAccountsReq = UtaRequestData;
export type GetDiscountRateConfigsReq = UtaRequestData;
export type GetLoanInfoReq = UtaRequestData;
export type GetAccountsResp = UtaRestResponse<UtaRecord | UtaRecord[]>;
export type GetDiscountRateConfigsResp = UtaRestResponse<UtaRecord | UtaRecord[]>;
export type GetLoanInfoResp = UtaRestResponse<UtaRecord | UtaRecord[]>;

/** UTA VIP lending REST APIs. */
export interface VIPLendingAPI {
    getAccounts(req: GetAccountsReq): Promise<GetAccountsResp>;
    getDiscountRateConfigs(req: GetDiscountRateConfigsReq): Promise<GetDiscountRateConfigsResp>;
    getLoanInfo(req: GetLoanInfoReq): Promise<GetLoanInfoResp>;
}

export class VIPLendingAPIImpl extends UtaApiBase implements VIPLendingAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    getAccounts(req: GetAccountsReq) { return this.call('GET', '/api/ua/v2/otc-loan/account', req); }
    getDiscountRateConfigs(req: GetDiscountRateConfigsReq) { return this.call('GET', '/api/ua/v2/otc-loan/discount-rate', req); }
    getLoanInfo(req: GetLoanInfoReq) { return this.call('GET', '/api/ua/v2/otc-loan/loan', req); }
}
