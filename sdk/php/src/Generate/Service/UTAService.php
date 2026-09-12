<?php

namespace KuCoin\UniversalSDK\Generate\Service;

use KuCoin\UniversalSDK\Generate\Uta\Account\AccountApi;
use KuCoin\UniversalSDK\Generate\Uta\Affiliate\AffiliateApi;
use KuCoin\UniversalSDK\Generate\Uta\Market\MarketApi;
use KuCoin\UniversalSDK\Generate\Uta\Order\OrderApi;
use KuCoin\UniversalSDK\Generate\Uta\Positions\PositionsApi;
use KuCoin\UniversalSDK\Generate\Uta\VIPLending\VIPLendingApi;

interface UTAService
{
    public function getAccountApi(): AccountApi;
    public function getAffiliateApi(): AffiliateApi;
    public function getMarketApi(): MarketApi;
    public function getOrderApi(): OrderApi;
    public function getPositionsApi(): PositionsApi;
    public function getVIPLendingApi(): VIPLendingApi;
}
