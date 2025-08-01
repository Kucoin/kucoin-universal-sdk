// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.deposit;

import com.kucoin.universal.sdk.internal.interfaces.Transport;

public class DepositApiImpl implements DepositApi {
  private final Transport transport;

  public DepositApiImpl(Transport transport) {
    this.transport = transport;
  }

  public AddDepositAddressV3Resp addDepositAddressV3(AddDepositAddressV3Req req) {
    return this.transport.call(
        "spot",
        false,
        "POST",
        "/api/v3/deposit-address/create",
        req,
        AddDepositAddressV3Resp.class,
        false);
  }

  public GetDepositAddressV3Resp getDepositAddressV3(GetDepositAddressV3Req req) {
    return this.transport.call(
        "spot",
        false,
        "GET",
        "/api/v3/deposit-addresses",
        req,
        GetDepositAddressV3Resp.class,
        false);
  }

  public GetDepositHistoryResp getDepositHistory(GetDepositHistoryReq req) {
    return this.transport.call(
        "spot", false, "GET", "/api/v1/deposits", req, GetDepositHistoryResp.class, false);
  }

  public GetDepositAddressV2Resp getDepositAddressV2(GetDepositAddressV2Req req) {
    return this.transport.call(
        "spot",
        false,
        "GET",
        "/api/v2/deposit-addresses",
        req,
        GetDepositAddressV2Resp.class,
        false);
  }

  public GetDepositAddressV1Resp getDepositAddressV1(GetDepositAddressV1Req req) {
    return this.transport.call(
        "spot",
        false,
        "GET",
        "/api/v1/deposit-addresses",
        req,
        GetDepositAddressV1Resp.class,
        false);
  }

  public GetDepositHistoryOldResp getDepositHistoryOld(GetDepositHistoryOldReq req) {
    return this.transport.call(
        "spot", false, "GET", "/api/v1/hist-deposits", req, GetDepositHistoryOldResp.class, false);
  }

  public AddDepositAddressV1Resp addDepositAddressV1(AddDepositAddressV1Req req) {
    return this.transport.call(
        "spot",
        false,
        "POST",
        "/api/v1/deposit-addresses",
        req,
        AddDepositAddressV1Resp.class,
        false);
  }
}
