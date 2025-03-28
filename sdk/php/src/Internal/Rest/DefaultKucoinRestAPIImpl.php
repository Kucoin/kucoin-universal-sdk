<?php

namespace KuCoin\UniversalSDK\Internal\Rest;

use Exception;
use KuCoin\UniversalSDK\Api\KucoinRestService;
use KuCoin\UniversalSDK\Generate\Service\AccountService;
use KuCoin\UniversalSDK\Generate\Service\AccountServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\AffiliateService;
use KuCoin\UniversalSDK\Generate\Service\AffiliateServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\BrokerService;
use KuCoin\UniversalSDK\Generate\Service\BrokerServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\CopyTradingService;
use KuCoin\UniversalSDK\Generate\Service\CopyTradingServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\EarnService;
use KuCoin\UniversalSDK\Generate\Service\EarnServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\FuturesService;
use KuCoin\UniversalSDK\Generate\Service\FuturesServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\MarginService;
use KuCoin\UniversalSDK\Generate\Service\MarginServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\SpotService;
use KuCoin\UniversalSDK\Generate\Service\SpotServiceImpl;
use KuCoin\UniversalSDK\Generate\Service\VIPLendingService;
use KuCoin\UniversalSDK\Generate\Service\VIPLendingServiceImpl;
use KuCoin\UniversalSDK\Generate\Version;
use KuCoin\UniversalSDK\Internal\Infra\DefaultTransport;
use KuCoin\UniversalSDK\Model\ClientOption;

class DefaultKucoinRestAPIImpl implements KucoinRestService
{
    private $accountService;
    private $affiliateService;
    private $brokerService;
    private $copyTradingService;
    private $earnService;
    private $futuresService;
    private $marginService;
    private $spotService;
    private $vipLendingService;

    public function __construct(ClientOption $option)
    {
        if ($option->transportOption == null) {
            throw new Exception("no transport option provided");
        }
        $transport = new DefaultTransport($option, Version::SDK_VERSION);
        $this->accountService = new AccountServiceImpl($transport);
        $this->affiliateService = new AffiliateServiceImpl($transport);
        $this->brokerService = new BrokerServiceImpl($transport);
        $this->copyTradingService = new CopyTradingServiceImpl($transport);
        $this->earnService = new EarnServiceImpl($transport);
        $this->futuresService = new FuturesServiceImpl($transport);
        $this->marginService = new MarginServiceImpl($transport);
        $this->spotService = new SpotServiceImpl($transport);
        $this->vipLendingService = new VIPLendingServiceImpl($transport);
    }

    public function getAccountService(): AccountService
    {
        return $this->accountService;
    }

    public function getAffiliateService(): AffiliateService
    {
        return $this->affiliateService;
    }

    public function getBrokerService(): BrokerService
    {
        return $this->brokerService;
    }

    public function getCopytradingService(): CopyTradingService
    {
        return $this->copyTradingService;
    }

    public function getEarnService(): EarnService
    {
        return $this->earnService;
    }

    public function getFuturesService(): FuturesService
    {
        return $this->futuresService;
    }

    public function getMarginService(): MarginService
    {
        return $this->marginService;
    }

    public function getSpotService(): SpotService
    {
        return $this->spotService;
    }

    public function getVipLendingService(): VIPLendingService
    {
        return $this->vipLendingService;
    }
}