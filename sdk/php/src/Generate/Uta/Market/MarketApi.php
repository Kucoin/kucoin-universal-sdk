<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Market;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * @method UtaResponse getAnnouncements($request = null)
 * @method UtaResponse getBorrowableCurrencies()
 * @method UtaResponse getCollateralRatio()
 * @method UtaResponse getHistoryFundingRate($request = null)
 * @method UtaResponse getIndexPrice($request = null)
 * @method UtaResponse getKlines($request = null)
 * @method UtaResponse getOpenInterest($request = null)
 * @method UtaResponse getOrderBook($request = null)
 * @method UtaResponse getPositionTiers($request = null)
 * @method UtaResponse getTicker($request = null)
 * @method UtaResponse getTrade($request = null)
 * @method UtaResponse getOEScurrency($request = null)
 * @method UtaResponse getServiceStatus($request = null)
 * @method UtaResponse getKYCRegions()
 * @method UtaResponse getClientIPAddress()
 * @method UtaResponse getCallAuctionInfo($request = null)
 * @method UtaResponse getCurrencies($request = null)
 * @method UtaResponse getCurrency($request = null)
 * @method UtaResponse getMaxOrderQuantity($request = null)
 * @method UtaResponse getFiatPrice($request = null)
 * @method UtaResponse getSymbol($request = null)
 * @method UtaResponse getTradeStatistics()
 * @method UtaResponse getCurrentFundingRates($request = null)
 * @method UtaResponse getInterestRateIndex($request = null)
 */
interface MarketApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
