<?php
namespace KuCoin\UniversalSDK\Generate\Service;

use KuCoin\UniversalSDK\Generate\Uta\Account\AccountApi;
use KuCoin\UniversalSDK\Generate\Uta\Account\AccountApiImpl;
use KuCoin\UniversalSDK\Generate\Uta\Affiliate\AffiliateApi;
use KuCoin\UniversalSDK\Generate\Uta\Affiliate\AffiliateApiImpl;
use KuCoin\UniversalSDK\Generate\Uta\Market\MarketApi;
use KuCoin\UniversalSDK\Generate\Uta\Market\MarketApiImpl;
use KuCoin\UniversalSDK\Generate\Uta\Order\OrderApi;
use KuCoin\UniversalSDK\Generate\Uta\Order\OrderApiImpl;
use KuCoin\UniversalSDK\Generate\Uta\Positions\PositionsApi;
use KuCoin\UniversalSDK\Generate\Uta\Positions\PositionsApiImpl;
use KuCoin\UniversalSDK\Generate\Uta\VIPLending\VIPLendingApi;
use KuCoin\UniversalSDK\Generate\Uta\VIPLending\VIPLendingApiImpl;

class UTAServiceImpl implements UTAService
{
    private $transport;
    private $account;
    private $affiliate;
    private $market;
    private $order;
    private $positions;
    private $vipLending;

    public function __construct($transport)
    {
        $this->transport = $transport;
        $this->account = new AccountApiImpl($transport);
        $this->affiliate = new AffiliateApiImpl($transport);
        $this->market = new MarketApiImpl($transport);
        $this->order = new OrderApiImpl($transport);
        $this->positions = new PositionsApiImpl($transport);
        $this->vipLending = new VIPLendingApiImpl($transport);
    }

    public function getAccountApi(): AccountApi
    {
        return $this->account;
    }

    public function getAffiliateApi(): AffiliateApi
    {
        return $this->affiliate;
    }

    public function getMarketApi(): MarketApi
    {
        return $this->market;
    }

    public function getOrderApi(): OrderApi
    {
        return $this->order;
    }

    public function getPositionsApi(): PositionsApi
    {
        return $this->positions;
    }

    public function getVIPLendingApi(): VIPLendingApi
    {
        return $this->vipLending;
    }
}
