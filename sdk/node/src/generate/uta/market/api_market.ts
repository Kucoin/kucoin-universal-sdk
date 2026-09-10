import { Transport } from '@internal/interfaces/transport';
import { UtaApiBase, UtaRecord, UtaRequestData, UtaRestResponse } from '../common';

export type UtaFlexibleNumber = string | number;
export type UtaObjectOrList = UtaRecord | UtaRecord[];

export type GetAnnouncementsReq = UtaRequestData;
export type GetHistoryFundingRateReq = UtaRequestData;
export type GetIndexPriceReq = UtaRequestData;
export type GetKlinesReq = UtaRequestData;
export type GetOpenInterestReq = UtaRequestData;
export type GetOrderBookReq = UtaRequestData;
export type GetPositionTiersReq = UtaRequestData;
export type GetTickerReq = UtaRequestData;
export type GetTradeReq = UtaRequestData;
export type GetOEScurrencyReq = UtaRequestData;
export type GetServiceStatusReq = UtaRequestData;
export type GetCallAuctionInfoReq = UtaRequestData;
export type GetCurrenciesReq = UtaRequestData;
export type GetCurrencyReq = UtaRequestData;
export type GetMaxOrderQuantityReq = UtaRequestData;
export type GetFiatPriceReq = UtaRequestData;
export type GetSymbolReq = UtaRequestData;
export type GetCurrentFundingRatesReq = UtaRequestData;
export type GetInterestRateIndexReq = UtaRequestData;

export interface GetIndexPriceItem extends UtaRecord {
    symbol?: string;
    indexPrice?: UtaFlexibleNumber;
    time?: UtaFlexibleNumber;
}

export interface GetCallAuctionInfoData extends UtaRecord {
    symbol?: string;
    estimatedPrice?: string;
    estimatedSize?: string;
    sellOrderRangeLowPrice?: string;
    sellOrderRangeHighPrice?: string;
    buyOrderRangeLowPrice?: string;
    buyOrderRangeHighPrice?: string;
    time?: UtaFlexibleNumber;
}

export interface GetCurrenciesData extends UtaRecord {
    currency?: string;
    name?: string;
    chain?: string;
    chainName?: string;
}

export type KlineRow = Array<string | number | boolean | null>;

export type GetAnnouncementsResp = UtaRestResponse<UtaRecord>;
export type GetBorrowableCurrenciesResp = UtaRestResponse<UtaObjectOrList>;
export type GetCollateralRatioResp = UtaRestResponse<UtaObjectOrList>;
export type GetHistoryFundingRateResp = UtaRestResponse<UtaObjectOrList>;
export type GetIndexPriceResp = UtaRestResponse<{ items?: GetIndexPriceItem[] } | GetIndexPriceItem[]>;
export type GetKlinesResp = UtaRestResponse<KlineRow[]>;
export type GetOpenInterestResp = UtaRestResponse<UtaObjectOrList>;
export type GetOrderBookResp = UtaRestResponse<UtaRecord>;
export type GetPositionTiersResp = UtaRestResponse<UtaObjectOrList>;
export type GetTickerResp = UtaRestResponse<UtaObjectOrList>;
export type GetTradeResp = UtaRestResponse<UtaObjectOrList>;
export type GetOEScurrencyResp = UtaRestResponse<UtaObjectOrList>;
export type GetServiceStatusResp = UtaRestResponse<UtaObjectOrList>;
export type GetKYCRegionsResp = UtaRestResponse<UtaObjectOrList>;
export type GetClientIPAddressResp = UtaRestResponse<UtaRecord>;
export type GetCallAuctionInfoResp = UtaRestResponse<GetCallAuctionInfoData>;
export type GetCurrenciesResp = UtaRestResponse<GetCurrenciesData[]>;
export type GetCurrencyResp = UtaRestResponse<UtaObjectOrList>;
export type GetMaxOrderQuantityResp = UtaRestResponse<UtaRecord>;
export type GetFiatPriceResp = UtaRestResponse<UtaObjectOrList>;
export type GetSymbolResp = UtaRestResponse<UtaObjectOrList>;
export type GetTradeStatisticsResp = UtaRestResponse<UtaObjectOrList>;
export type GetCurrentFundingRatesResp = UtaRestResponse<UtaObjectOrList>;
export type GetInterestRateIndexResp = UtaRestResponse<UtaObjectOrList>;

/** UTA public market REST APIs. */
export interface MarketAPI {
    getAnnouncements(req: GetAnnouncementsReq): Promise<GetAnnouncementsResp>;
    getBorrowableCurrencies(): Promise<GetBorrowableCurrenciesResp>;
    getCollateralRatio(): Promise<GetCollateralRatioResp>;
    getHistoryFundingRate(req: GetHistoryFundingRateReq): Promise<GetHistoryFundingRateResp>;
    getIndexPrice(req: GetIndexPriceReq): Promise<GetIndexPriceResp>;
    getKlines(req: GetKlinesReq): Promise<GetKlinesResp>;
    getOpenInterest(req: GetOpenInterestReq): Promise<GetOpenInterestResp>;
    getOrderBook(req: GetOrderBookReq): Promise<GetOrderBookResp>;
    getPositionTiers(req: GetPositionTiersReq): Promise<GetPositionTiersResp>;
    getTicker(req: GetTickerReq): Promise<GetTickerResp>;
    getTrade(req: GetTradeReq): Promise<GetTradeResp>;
    getOEScurrency(req: GetOEScurrencyReq): Promise<GetOEScurrencyResp>;
    getServiceStatus(req: GetServiceStatusReq): Promise<GetServiceStatusResp>;
    getKYCRegions(): Promise<GetKYCRegionsResp>;
    getClientIPAddress(): Promise<GetClientIPAddressResp>;
    getCallAuctionInfo(req: GetCallAuctionInfoReq): Promise<GetCallAuctionInfoResp>;
    getCurrencies(req: GetCurrenciesReq): Promise<GetCurrenciesResp>;
    getCurrency(req: GetCurrencyReq): Promise<GetCurrencyResp>;
    getMaxOrderQuantity(req: GetMaxOrderQuantityReq): Promise<GetMaxOrderQuantityResp>;
    getFiatPrice(req: GetFiatPriceReq): Promise<GetFiatPriceResp>;
    getSymbol(req: GetSymbolReq): Promise<GetSymbolResp>;
    getTradeStatistics(): Promise<GetTradeStatisticsResp>;
    getCurrentFundingRates(req: GetCurrentFundingRatesReq): Promise<GetCurrentFundingRatesResp>;
    getInterestRateIndex(req: GetInterestRateIndexReq): Promise<GetInterestRateIndexResp>;
}

export class MarketAPIImpl extends UtaApiBase implements MarketAPI {
    constructor(transport: Transport) {
        super(transport);
    }

    getAnnouncements(req: GetAnnouncementsReq) { return this.call('GET', '/api/ua/v2/market/announcement', req); }
    getBorrowableCurrencies() { return this.call('GET', '/api/ua/v2/market/borrowable-currency'); }
    getCollateralRatio() { return this.call('GET', '/api/ua/v2/market/collateral-discount-ratio'); }
    getHistoryFundingRate(req: GetHistoryFundingRateReq) { return this.call('GET', '/api/ua/v2/market/funding-rate-history', req); }
    getIndexPrice(req: GetIndexPriceReq) { return this.call('GET', '/api/ua/v2/market/index-price', req); }
    getKlines(req: GetKlinesReq) { return this.call('GET', '/api/ua/v2/market/kline', req); }
    getOpenInterest(req: GetOpenInterestReq) { return this.call('GET', '/api/ua/v2/market/open-interest', req); }
    getOrderBook(req: GetOrderBookReq) { return this.call('GET', '/api/ua/v2/market/orderbook', req); }
    getPositionTiers(req: GetPositionTiersReq) { return this.call('GET', '/api/ua/v2/market/position-tiers', req); }
    getTicker(req: GetTickerReq) { return this.call('GET', '/api/ua/v2/market/ticker', req); }
    getTrade(req: GetTradeReq) { return this.call('GET', '/api/ua/v2/market/trade', req); }
    getOEScurrency(req: GetOEScurrencyReq) { return this.call('GET', '/api/ua/v2/oes/currency', req); }
    getServiceStatus(req: GetServiceStatusReq) { return this.call('GET', '/api/ua/v2/server/status', req); }
    getKYCRegions() { return this.call('GET', '/api/ua/v2/user/kyc-region'); }
    getClientIPAddress() { return this.call('GET', '/api/ua/v2/user/my-ip'); }
    getCallAuctionInfo(req: GetCallAuctionInfoReq) { return this.call('GET', '/api/ua/v2/market/call-auction-info', req); }
    getCurrencies(req: GetCurrenciesReq) { return this.call('GET', '/api/ua/v2/asset/currencies', req); }
    getCurrency(req: GetCurrencyReq) { return this.call('GET', '/api/ua/v2/market/currency', req); }
    getMaxOrderQuantity(req: GetMaxOrderQuantityReq) { return this.call('GET', '/api/ua/v2/order/max-order-quantity', req); }
    getFiatPrice(req: GetFiatPriceReq) { return this.call('GET', '/api/ua/v2/market/fiat-price', req); }
    getSymbol(req: GetSymbolReq) { return this.call('GET', '/api/ua/v2/market/instrument', req); }
    getTradeStatistics() { return this.call('GET', '/api/ua/v2/trade-statistics'); }
    getCurrentFundingRates(req: GetCurrentFundingRatesReq) { return this.call('GET', '/api/ua/v2/market/funding-rate', req); }
    getInterestRateIndex(req: GetInterestRateIndexReq) { return this.call('GET', '/api/ua/v2/market/interest-rate-index', req); }
}
