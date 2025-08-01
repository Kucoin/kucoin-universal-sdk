// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.broker.apibroker;

public interface APIBrokerApi {
  /**
   * Get Broker Rebate
   *
   * <p>This interface supports the downloading of Broker rebate orders.
   *
   * <p>Extra API Info:
   *
   * <ul>
   *   <li>API-DOMAIN : SPOT
   *   <li>API-CHANNEL : PRIVATE
   *   <li>API-PERMISSION : GENERAL
   *   <li>API-RATE-LIMIT-POOL : MANAGEMENT
   *   <li>API-RATE-LIMIT-WEIGHT : 3
   * </ul>
   *
   * @see <a href="https://www.kucoin.com/docs-new/api-3470280">docs</a>
   */
  GetRebaseResp getRebase(GetRebaseReq req);
}
