package com.kucoin.universal.sdk.api;

import com.kucoin.universal.sdk.generate.service.*;

/**
 * Interface KucoinRestService Defines the contract for accessing KuCoin REST API service groups.
 */
public interface KucoinRestService {

  /**
   * Provides functions to access and manipulate account-related data.
   *
   * @return AccountService
   */
  AccountService getAccountService();

  /**
   * Provides functions to access affiliate-related data.
   *
   * @return AffiliateService
   */
  AffiliateService getAffiliateService();

  /**
   * Provides functions to access and manage broker-related data.
   *
   * @return BrokerService
   */
  BrokerService getBrokerService();

  /**
   * Provides functions to access and manage copy trading-related data.
   *
   * @return CopyTradingService
   */
  CopyTradingService getCopytradingService();

  /**
   * Provides functions to access and manage earn-related data.
   *
   * @return EarnService
   */
  EarnService getEarnService();

  /**
   * Provides functions to perform actions in the futures market.
   *
   * @return FuturesService
   */
  FuturesService getFuturesService();

  /**
   * Provides functions to access and manage margin-related data.
   *
   * @return MarginService
   */
  MarginService getMarginService();

  /**
   * Provides functions to perform actions in the spot market.
   *
   * @return SpotService
   */
  SpotService getSpotService();

  /**
   * Provides functions to access and manage VIP lending-related data.
   *
   * @return VIPLendingService
   */
  VIPLendingService getVipLendingService();

  /**
   * Closes the service and releases any resources held by the KucoinRestService. This method should
   * be called when the service is no longer needed to ensure proper cleanup.
   */

  UTAService getUTAService();

  void closeService();
}
