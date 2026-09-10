import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type GetInvitedReq = UtaRequestData;
export type GetKuminingReq = UtaRequestData;
export type GetCommissionReq = UtaRequestData;
export type GetTransactionReq = UtaRequestData;
export type GetTradeHistoryReq = UtaRequestData;

export type UtaFlexibleNumber = string | number;

export interface GetCommissionItem extends UtaRecord {
    siteType?: string;
    rebateType?: UtaFlexibleNumber;
    payoutTime?: UtaFlexibleNumber;
    periodStartTime?: UtaFlexibleNumber;
    periodEndTime?: UtaFlexibleNumber;
    status?: UtaFlexibleNumber;
    commission?: string;
    currency?: string;
    dataType?: string;
}

export interface GetCommissionData extends UtaRecord {
    currentPage?: UtaFlexibleNumber;
    pageSize?: UtaFlexibleNumber;
    totalNum?: UtaFlexibleNumber;
    totalPage?: UtaFlexibleNumber;
    items?: GetCommissionItem[];
}

export interface GetTransactionData extends UtaRecord {
    tradeTime?: UtaFlexibleNumber;
    tradeType?: string;
    tradeCurrency?: string;
    tradeAmount?: string;
    tradeAmountU?: string;
    feeU?: string;
    commission?: string;
    currency?: string;
    uid?: UtaFlexibleNumber;
    lastId?: string;
}

export interface GetKuminingData extends UtaRecord {
    payTime?: UtaFlexibleNumber;
    goodsName?: string;
    amount?: string;
    currency?: string;
    uid?: UtaFlexibleNumber;
    lastId?: string;
}

export type GetInvitedResp = UtaRestResponse<UtaRecord>;
export type GetKuminingResp = UtaRestResponse<GetKuminingData[]>;
export type GetCommissionResp = UtaRestResponse<GetCommissionData>;
export type GetTransactionResp = UtaRestResponse<GetTransactionData[]>;
export type GetTradeHistoryResp = UtaRestResponse<GetTransactionData[]>;

/** UTA affiliate REST APIs. */
export interface AffiliateAPI {
    getInvited(req: GetInvitedReq): Promise<GetInvitedResp>;
    getKumining(req: GetKuminingReq): Promise<GetKuminingResp>;
    getCommission(req: GetCommissionReq): Promise<GetCommissionResp>;
    getTransaction(req: GetTransactionReq): Promise<GetTransactionResp>;
    getTradeHistory(req: GetTradeHistoryReq): Promise<GetTradeHistoryResp>;
}

export class AffiliateAPIImpl extends UtaApiBase implements AffiliateAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    getInvited(req: GetInvitedReq) { return this.call('GET', '/api/ua/v2/affiliate/queryInvitees', req); }
    getKumining(req: GetKuminingReq) { return this.call('GET', '/api/ua/v2/affiliate/queryKumining', req); }
    getCommission(req: GetCommissionReq) { return this.call('GET', '/api/ua/v2/affiliate/queryMyCommission', req); }
    getTransaction(req: GetTransactionReq) { return this.call('GET', '/api/ua/v2/affiliate/queryTransactionByTime', req); }
    getTradeHistory(req: GetTradeHistoryReq) { return this.call('GET', '/api/ua/v2/affiliate/queryTransactionByUid', req); }
}
