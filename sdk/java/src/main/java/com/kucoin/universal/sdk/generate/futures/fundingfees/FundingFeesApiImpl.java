// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.fundingfees;

import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class FundingFeesApiImpl implements FundingFeesApi {
  private final Transport transport;

  public FundingFeesApiImpl(Transport transport) {
    this.transport = transport;
  }

  public GetCurrentFundingRateResp getCurrentFundingRate(GetCurrentFundingRateReq req) {
    return this.transport.call(
        "futures",
        false,
        "GET",
        "/api/v1/funding-rate/{symbol}/current",
        req,
        GetCurrentFundingRateResp.class,
        false);
  }

  public GetPublicFundingHistoryResp getPublicFundingHistory(GetPublicFundingHistoryReq req) {
    return this.transport.call(
        "futures",
        false,
        "GET",
        "/api/v1/contract/funding-rates",
        req,
        GetPublicFundingHistoryResp.class,
        false);
  }

  public GetPrivateFundingHistoryResp getPrivateFundingHistory(GetPrivateFundingHistoryReq req) {
    return this.transport.call(
        "futures",
        false,
        "GET",
        "/api/v1/funding-history",
        req,
        GetPrivateFundingHistoryResp.class,
        false);
  }
}
