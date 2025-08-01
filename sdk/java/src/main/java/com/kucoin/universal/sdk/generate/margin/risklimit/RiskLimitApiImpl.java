// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.margin.risklimit;

import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class RiskLimitApiImpl implements RiskLimitApi {
  private final Transport transport;

  public RiskLimitApiImpl(Transport transport) {
    this.transport = transport;
  }

  public GetMarginRiskLimitResp getMarginRiskLimit(GetMarginRiskLimitReq req) {
    return this.transport.call(
        "spot",
        false,
        "GET",
        "/api/v3/margin/currencies",
        req,
        GetMarginRiskLimitResp.class,
        false);
  }
}
