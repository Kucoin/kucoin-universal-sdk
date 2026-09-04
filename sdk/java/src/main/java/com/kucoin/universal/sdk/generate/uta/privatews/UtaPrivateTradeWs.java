// Code generated from the UTA WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.kucoin.universal.sdk.generate.uta.order.PlaceOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.CancelOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.AmendOrderReq;

/** Direct UTA private WebSocket trading API. */
public interface UtaPrivateTradeWs {
  /** Connect to the authenticated UTA WebSocket trade endpoint. */
  void start();

  /** Place a UTA Spot, Margin, or Futures order using {@code op: uta.order}. */
  UtaPlaceOrderWsResponse placeOrder(PlaceOrderReq request);

  /** Cancel one UTA Spot, Margin, or Futures order using {@code op: uta.cancel}. */
  UtaCancelOrderWsResponse cancelOrder(CancelOrderReq request);

  /** Amend one UTA order using {@code op: uta.amend}. */
  UtaAmendOrderWsResponse amendOrder(AmendOrderReq request);

  /** Close the connection and release resources. */
  void stop();
}
