<?php

namespace KuCoin\UniversalSDK\Api;

use KuCoin\UniversalSDK\Generate\Service\SpotService;

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
    public function getAccountService();

    /**
     * Provides functions to access affiliate-related data.
     *
     * @return AffiliateService
     */
    public function getAffiliateService();

    /**
     * Provides functions to access and manage broker-related data.
     *
     * @return BrokerService
     */
    public function getBrokerService();

    /**
     * Provides functions to access and manage copy trading-related data.
     *
     * @return CopyTradingService
     */
    public function getCopytradingService();

    /**
     * Provides functions to access and manage earn-related data.
     *
     * @return EarnService
     */
    public function getEarnService();

    /**
     * Provides functions to perform actions in the futures market.
     *
     * @return FuturesService
     */
    public function getFuturesService();

    /**
     * Provides functions to access and manage margin-related data.
     *
     * @return MarginService
     */
    public function getMarginService();

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
    public function getVipLendingService();
}
