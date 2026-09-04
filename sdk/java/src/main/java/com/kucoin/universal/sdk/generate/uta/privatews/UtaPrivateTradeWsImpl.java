// Code generated from the UTA WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.kucoin.universal.sdk.generate.uta.order.PlaceOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.CancelOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.AmendOrderReq;
import com.kucoin.universal.sdk.internal.infra.PrivateTradeWsService;

/** Implementation backed by the direct UTA WebSocket trading protocol. */
public final class UtaPrivateTradeWsImpl implements UtaPrivateTradeWs {
  private final PrivateTradeWsService wsService;

  public UtaPrivateTradeWsImpl(PrivateTradeWsService wsService) {
    this.wsService = wsService;
  }

  @Override
  public void start() {
    wsService.start();
  }

  @Override
  public UtaPlaceOrderWsResponse placeOrder(PlaceOrderReq request) {
    return wsService.placeOrder(request);
  }

  @Override
  public UtaCancelOrderWsResponse cancelOrder(CancelOrderReq request) {
    return wsService.cancelOrder(request);
  }

  @Override
  public UtaAmendOrderWsResponse amendOrder(AmendOrderReq request) {
    return wsService.amendOrder(request);
  }

  @Override
  public void stop() {
    wsService.stop();
  }
}
