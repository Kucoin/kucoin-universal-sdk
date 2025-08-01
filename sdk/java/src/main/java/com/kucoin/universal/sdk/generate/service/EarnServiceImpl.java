// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.service;

import com.kucoin.universal.sdk.generate.earn.earn.EarnApi;
import com.kucoin.universal.sdk.generate.earn.earn.EarnApiImpl;
import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class EarnServiceImpl implements EarnService {
  private Transport transport;
  private EarnApi earn;

  public EarnServiceImpl(Transport transport) {
    this.transport = transport;
    this.earn = new EarnApiImpl(transport);
  }

  public EarnApi getEarnApi() {
    return this.earn;
  }
}
