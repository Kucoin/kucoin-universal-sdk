// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.affiliate.affiliate;

import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class AffiliateApiImpl implements AffiliateApi {
  private final Transport transport;

  public AffiliateApiImpl(Transport transport) {
    this.transport = transport;
  }

  public GetAccountResp getAccount() {
    return this.transport.call(
        "spot",
        false,
        "GET",
        "/api/v2/affiliate/inviter/statistics",
        null,
        GetAccountResp.class,
        false);
  }
}
