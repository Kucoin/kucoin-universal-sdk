<?php

namespace KuCoin\UniversalSDK\Internal\Rest;

use Exception;
use KuCoin\UniversalSDK\Api\KucoinRestService;
use KuCoin\UniversalSDK\Generate\Service\SpotService;
use KuCoin\UniversalSDK\Generate\Service\SpotServiceImpl;
use KuCoin\UniversalSDK\Generate\Version;
use KuCoin\UniversalSDK\Internal\Infra\DefaultTransport;
use KuCoin\UniversalSDK\Model\ClientOption;

class DefaultKucoinRestAPIImpl implements KucoinRestService
{
    private $spotService;

    public function __construct(ClientOption $option)
    {
        if ($option->transportOption == null) {
            throw new Exception("no transport option provided");
        }
        $transport = new DefaultTransport($option, Version::SDK_VERSION);
        $this->spotService = new SpotServiceImpl($transport);
    }


    public function getAccountService()
    {
        return $this->api;
    }

    public function getAffiliateService()
    {
        // TODO: Implement getAffiliateService() method.
    }

    public function getBrokerService()
    {
        // TODO: Implement getBrokerService() method.
    }

    public function getCopytradingService()
    {
        // TODO: Implement getCopytradingService() method.
    }

    public function getEarnService()
    {
        // TODO: Implement getEarnService() method.
    }

    public function getFuturesService()
    {
        // TODO: Implement getFuturesService() method.
    }

    public function getMarginService()
    {
        // TODO: Implement getMarginService() method.
    }

    public function getSpotService(): SpotService
    {
        return $this->spotService;
    }

    public function getVipLendingService()
    {
        // TODO: Implement getVipLendingService() method.
    }
}