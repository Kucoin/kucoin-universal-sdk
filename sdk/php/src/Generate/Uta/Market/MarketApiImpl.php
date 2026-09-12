<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Market;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class MarketApiImpl extends MappedUtaApi implements MarketApi
{
    protected const ENDPOINTS = [
        'getAnnouncements' => ['GET', '/api/ua/v2/market/announcement'],
        'getBorrowableCurrencies' => ['GET', '/api/ua/v2/market/borrowable-currency'],
        'getCollateralRatio' => ['GET', '/api/ua/v2/market/collateral-discount-ratio'],
        'getHistoryFundingRate' => ['GET', '/api/ua/v2/market/funding-rate-history'],
        'getIndexPrice' => ['GET', '/api/ua/v2/market/index-price'],
        'getKlines' => ['GET', '/api/ua/v2/market/kline'],
        'getOpenInterest' => ['GET', '/api/ua/v2/market/open-interest'],
        'getOrderBook' => ['GET', '/api/ua/v2/market/orderbook'],
        'getPositionTiers' => ['GET', '/api/ua/v2/market/position-tiers'],
        'getTicker' => ['GET', '/api/ua/v2/market/ticker'],
        'getTrade' => ['GET', '/api/ua/v2/market/trade'],
        'getOEScurrency' => ['GET', '/api/ua/v2/oes/currency'],
        'getServiceStatus' => ['GET', '/api/ua/v2/server/status'],
        'getKYCRegions' => ['GET', '/api/ua/v2/user/kyc-region'],
        'getClientIPAddress' => ['GET', '/api/ua/v2/user/my-ip'],
        'getCallAuctionInfo' => ['GET', '/api/ua/v2/market/call-auction-info'],
        'getCurrencies' => ['GET', '/api/ua/v2/asset/currencies'],
        'getCurrency' => ['GET', '/api/ua/v2/market/currency'],
        'getMaxOrderQuantity' => ['GET', '/api/ua/v2/order/max-order-quantity'],
        'getFiatPrice' => ['GET', '/api/ua/v2/market/fiat-price'],
        'getSymbol' => ['GET', '/api/ua/v2/market/instrument'],
        'getTradeStatistics' => ['GET', '/api/ua/v2/trade-statistics'],
        'getCurrentFundingRates' => ['GET', '/api/ua/v2/market/funding-rate'],
        'getInterestRateIndex' => ['GET', '/api/ua/v2/market/interest-rate-index'],
    ];
}
