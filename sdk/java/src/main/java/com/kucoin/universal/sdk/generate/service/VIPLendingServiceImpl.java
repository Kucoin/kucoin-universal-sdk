// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.service;

import com.kucoin.universal.sdk.generate.viplending.viplending.VIPLendingApi;
import com.kucoin.universal.sdk.generate.viplending.viplending.VIPLendingApiImpl;
import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class VIPLendingServiceImpl implements VIPLendingService {
  private Transport transport;
  private VIPLendingApi vIPLending;

  public VIPLendingServiceImpl(Transport transport) {
    this.transport = transport;
    this.vIPLending = new VIPLendingApiImpl(transport);
  }

  public VIPLendingApi getVIPLendingApi() {
    return this.vIPLending;
  }
}
