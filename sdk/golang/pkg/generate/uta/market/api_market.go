// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package market

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type MarketAPI interface {
	GetAnnouncements(req *GetAnnouncementsReq, ctx context.Context) (*GetAnnouncementsResp, error)
	GetBorrowableCurrencies(ctx context.Context) (*GetBorrowableCurrenciesResp, error)
	GetCollateralRatio(ctx context.Context) (*GetCollateralRatioResp, error)
	GetHistoryFundingRate(req *GetHistoryFundingRateReq, ctx context.Context) (*GetHistoryFundingRateResp, error)
	GetIndexPrice(req *GetIndexPriceReq, ctx context.Context) (*GetIndexPriceResp, error)
	GetKlines(req *GetKlinesReq, ctx context.Context) (*GetKlinesResp, error)
	GetOpenInterest(req *GetOpenInterestReq, ctx context.Context) (*GetOpenInterestResp, error)
	GetOrderBook(req *GetOrderBookReq, ctx context.Context) (*GetOrderBookResp, error)
	GetPositionTiers(req *GetPositionTiersReq, ctx context.Context) (*GetPositionTiersResp, error)
	GetTicker(req *GetTickerReq, ctx context.Context) (*GetTickerResp, error)
	GetTrade(req *GetTradeReq, ctx context.Context) (*GetTradeResp, error)
	GetOEScurrency(req *GetOEScurrencyReq, ctx context.Context) (*GetOEScurrencyResp, error)
	GetServiceStatus(req *GetServiceStatusReq, ctx context.Context) (*GetServiceStatusResp, error)
	GetKYCRegions(ctx context.Context) (*GetKYCRegionsResp, error)
	GetClientIPAddress(ctx context.Context) (*GetClientIPAddressResp, error)
	GetCallAuctionInfo(req *GetCallAuctionInfoReq, ctx context.Context) (*GetCallAuctionInfoResp, error)
	GetCurrencies(req *GetCurrenciesReq, ctx context.Context) (*GetCurrenciesResp, error)
	GetCurrency(req *GetCurrencyReq, ctx context.Context) (*GetCurrencyResp, error)
	GetMaxOrderQuantity(req *GetMaxOrderQuantityReq, ctx context.Context) (*GetMaxOrderQuantityResp, error)
	GetFiatPrice(req *GetFiatPriceReq, ctx context.Context) (*GetFiatPriceResp, error)
	GetSymbol(req *GetSymbolReq, ctx context.Context) (*GetSymbolResp, error)
	GetTradeStatistics(ctx context.Context) (*GetTradeStatisticsResp, error)
	GetCurrentFundingRates(req *GetCurrentFundingRatesReq, ctx context.Context) (*GetCurrentFundingRatesResp, error)
	GetInterestRateIndex(req *GetInterestRateIndexReq, ctx context.Context) (*GetInterestRateIndexResp, error)
}

type MarketAPIImpl struct {
	transport interfaces.Transport
}

func NewMarketAPIImp(transport interfaces.Transport) *MarketAPIImpl {
	return &MarketAPIImpl{transport: transport}
}

func (impl *MarketAPIImpl) GetAnnouncements(req *GetAnnouncementsReq, ctx context.Context) (*GetAnnouncementsResp, error) {
	resp := &GetAnnouncementsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/announcement", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetBorrowableCurrencies(ctx context.Context) (*GetBorrowableCurrenciesResp, error) {
	resp := &GetBorrowableCurrenciesResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/borrowable-currency", nil, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetCollateralRatio(ctx context.Context) (*GetCollateralRatioResp, error) {
	resp := &GetCollateralRatioResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/collateral-discount-ratio", nil, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetHistoryFundingRate(req *GetHistoryFundingRateReq, ctx context.Context) (*GetHistoryFundingRateResp, error) {
	resp := &GetHistoryFundingRateResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/funding-rate-history", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetIndexPrice(req *GetIndexPriceReq, ctx context.Context) (*GetIndexPriceResp, error) {
	resp := &GetIndexPriceResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/index-price", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetKlines(req *GetKlinesReq, ctx context.Context) (*GetKlinesResp, error) {
	resp := &GetKlinesResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/kline", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetOpenInterest(req *GetOpenInterestReq, ctx context.Context) (*GetOpenInterestResp, error) {
	resp := &GetOpenInterestResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/open-interest", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetOrderBook(req *GetOrderBookReq, ctx context.Context) (*GetOrderBookResp, error) {
	resp := &GetOrderBookResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/orderbook", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetPositionTiers(req *GetPositionTiersReq, ctx context.Context) (*GetPositionTiersResp, error) {
	resp := &GetPositionTiersResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/position-tiers", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetTicker(req *GetTickerReq, ctx context.Context) (*GetTickerResp, error) {
	resp := &GetTickerResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/ticker", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetTrade(req *GetTradeReq, ctx context.Context) (*GetTradeResp, error) {
	resp := &GetTradeResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/trade", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetOEScurrency(req *GetOEScurrencyReq, ctx context.Context) (*GetOEScurrencyResp, error) {
	resp := &GetOEScurrencyResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/oes/currency", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetServiceStatus(req *GetServiceStatusReq, ctx context.Context) (*GetServiceStatusResp, error) {
	resp := &GetServiceStatusResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/server/status", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetKYCRegions(ctx context.Context) (*GetKYCRegionsResp, error) {
	resp := &GetKYCRegionsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/kyc-region", nil, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetClientIPAddress(ctx context.Context) (*GetClientIPAddressResp, error) {
	resp := &GetClientIPAddressResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/user/my-ip", nil, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetCallAuctionInfo(req *GetCallAuctionInfoReq, ctx context.Context) (*GetCallAuctionInfoResp, error) {
	resp := &GetCallAuctionInfoResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/call-auction-info", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetCurrencies(req *GetCurrenciesReq, ctx context.Context) (*GetCurrenciesResp, error) {
	resp := &GetCurrenciesResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/asset/currencies", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetCurrency(req *GetCurrencyReq, ctx context.Context) (*GetCurrencyResp, error) {
	resp := &GetCurrencyResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/currency", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetMaxOrderQuantity(req *GetMaxOrderQuantityReq, ctx context.Context) (*GetMaxOrderQuantityResp, error) {
	resp := &GetMaxOrderQuantityResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/order/max-order-quantity", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetFiatPrice(req *GetFiatPriceReq, ctx context.Context) (*GetFiatPriceResp, error) {
	resp := &GetFiatPriceResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/fiat-price", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetSymbol(req *GetSymbolReq, ctx context.Context) (*GetSymbolResp, error) {
	resp := &GetSymbolResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/instrument", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetTradeStatistics(ctx context.Context) (*GetTradeStatisticsResp, error) {
	resp := &GetTradeStatisticsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/trade-statistics", nil, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetCurrentFundingRates(req *GetCurrentFundingRatesReq, ctx context.Context) (*GetCurrentFundingRatesResp, error) {
	resp := &GetCurrentFundingRatesResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/funding-rate", req, resp, false)
	return resp, err
}

func (impl *MarketAPIImpl) GetInterestRateIndex(req *GetInterestRateIndexReq, ctx context.Context) (*GetInterestRateIndexResp, error) {
	resp := &GetInterestRateIndexResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/market/interest-rate-index", req, resp, false)
	return resp, err
}
