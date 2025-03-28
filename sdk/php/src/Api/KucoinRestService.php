<?php

namespace KuCoin\UniversalSDK\Api;

use KuCoin\UniversalSDK\Generate\Service\AccountService;
use KuCoin\UniversalSDK\Generate\Service\AffiliateService;
use KuCoin\UniversalSDK\Generate\Service\BrokerService;
use KuCoin\UniversalSDK\Generate\Service\CopyTradingService;
use KuCoin\UniversalSDK\Generate\Service\EarnService;
use KuCoin\UniversalSDK\Generate\Service\FuturesService;
use KuCoin\UniversalSDK\Generate\Service\MarginService;
use KuCoin\UniversalSDK\Generate\Service\SpotService;
use KuCoin\UniversalSDK\Generate\Service\VIPLendingService;

/**
 * Interface KucoinRestService
 * Defines the contract for accessing KuCoin REST API service groups.
 */
interface KucoinRestService
{
    /**
     * Provides functions to access and manipulate account-related data.
     *
     * @return AccountService
     */
    public function getAccountService(): AccountService;

    /**
     * Provides functions to access affiliate-related data.
     *
     * @return AffiliateService
     */
    public function getAffiliateService(): AffiliateService;

    /**
     * Provides functions to access and manage broker-related data.
     *
     * @return BrokerService
     */
    public function getBrokerService(): BrokerService;

    /**
     * Provides functions to access and manage copy trading-related data.
     *
     * @return CopyTradingService
     */
    public function getCopytradingService(): CopyTradingService;

    /**
     * Provides functions to access and manage earn-related data.
     *
     * @return EarnService
     */
    public function getEarnService(): EarnService;

    /**
     * Provides functions to perform actions in the futures market.
     *
     * @return FuturesService
     */
    public function getFuturesService(): FuturesService;

    /**
     * Provides functions to access and manage margin-related data.
     *
     * @return MarginService
     */
    public function getMarginService(): MarginService;

    /**
     * Provides functions to perform actions in the spot market.
     *
     * @return SpotService
     */
    public function getSpotService(): SpotService;

    /**
     * Provides functions to access and manage VIP lending-related data.
     *
     * @return VIPLendingService
     */
    public function getVipLendingService(): VIPLendingService;
}
