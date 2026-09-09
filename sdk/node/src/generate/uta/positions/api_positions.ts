import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type UtaFlexibleNumber = string | number;
export type GetPrivateFundingFeeHistoryReq = UtaRequestData;
export type GetPositionsHistoryReq = UtaRequestData;
export type GetMarginModeReq = UtaRequestData;
export type GetPositionListReq = UtaRequestData;
export type ModifyMarginModeReq = UtaRequestData;
export type ModifyIsolatedFuturesMarginReq = UtaRequestData;

export interface PositionData extends UtaRecord {
    symbol?: string;
    id?: string;
    marginMode?: string;
    size?: string;
    entryPrice?: string;
    markPrice?: string;
    leverage?: UtaFlexibleNumber;
    updateTime?: UtaFlexibleNumber;
}

export type GetPrivateFundingFeeHistoryResp = UtaRestResponse<UtaRecord | UtaRecord[]>;
export type GetPositionsHistoryResp = UtaRestResponse<PositionData[]>;
export type GetMarginModeResp = UtaRestResponse<UtaRecord>;
export type GetPositionListResp = UtaRestResponse<PositionData[]>;
export type ModifyMarginModeResp = UtaRestResponse<UtaRecord>;
export type ModifyIsolatedFuturesMarginResp = UtaRestResponse<UtaRecord>;

/** UTA futures position REST APIs. */
export interface PositionsAPI {
    getPrivateFundingFeeHistory(req: GetPrivateFundingFeeHistoryReq): Promise<GetPrivateFundingFeeHistoryResp>;
    getPositionsHistory(req: GetPositionsHistoryReq): Promise<GetPositionsHistoryResp>;
    getMarginMode(req: GetMarginModeReq): Promise<GetMarginModeResp>;
    getPositionList(req: GetPositionListReq): Promise<GetPositionListResp>;
    modifyMarginMode(req: ModifyMarginModeReq): Promise<ModifyMarginModeResp>;
    modifyIsolatedFuturesMargin(req: ModifyIsolatedFuturesMarginReq): Promise<ModifyIsolatedFuturesMarginResp>;
}

export class PositionsAPIImpl extends UtaApiBase implements PositionsAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    getPrivateFundingFeeHistory(req: GetPrivateFundingFeeHistoryReq) { return this.call('GET', '/api/ua/v2/position/funding-history', req); }
    getPositionsHistory(req: GetPositionsHistoryReq) { return this.call('GET', '/api/ua/v2/position/history', req); }
    getMarginMode(req: GetMarginModeReq) { return this.call('GET', '/api/ua/v2/unified/position/margin-mode', req); }
    getPositionList(req: GetPositionListReq) { return this.call('GET', '/api/ua/v2/unified/position/open-list', req); }
    modifyMarginMode(req: ModifyMarginModeReq) { return this.call('POST', '/api/ua/v2/unified/position/margin-mode', req); }
    modifyIsolatedFuturesMargin(req: ModifyIsolatedFuturesMarginReq) { return this.call('POST', '/api/ua/v2/unified/position/modify-margin', req); }
}
