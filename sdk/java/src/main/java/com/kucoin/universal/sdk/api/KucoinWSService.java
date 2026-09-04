package com.kucoin.universal.sdk.api;

import com.kucoin.universal.sdk.generate.futures.futuresprivate.FuturesPrivateWs;
import com.kucoin.universal.sdk.generate.futures.futurespublic.FuturesPublicWs;
import com.kucoin.universal.sdk.generate.margin.marginprivate.MarginPrivateWs;
import com.kucoin.universal.sdk.generate.margin.marginpublic.MarginPublicWs;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWs;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWs;
import com.kucoin.universal.sdk.generate.uta.publicws.UtaPublicWs;
import com.kucoin.universal.sdk.generate.uta.privatews.UtaPrivateWs;
import com.kucoin.universal.sdk.generate.uta.privatews.UtaPrivateTradeWs;
import com.kucoin.universal.sdk.model.PushTradeType;

/** KucoinWSService provides WebSocket interfaces for Spot, Margin, and Futures trading. */
public interface KucoinWSService {
  /**
   * Returns the interface to interact with the Spot Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return SpotPublicWs
   */
  SpotPublicWs newSpotPublicWS();

  /**
   * Returns the interface to interact with the Spot Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return SpotPrivateWs
   */
  SpotPrivateWs newSpotPrivateWS();

  /**
   * Returns the interface to interact with the Margin Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return MarginPublicWs
   */
  MarginPublicWs newMarginPublicWS();

  /**
   * Returns the interface to interact with the Margin Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return MarginPrivateWs
   */
  MarginPrivateWs newMarginPrivateWS();

  /**
   * Returns the interface to interact with the Futures Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return FuturesPublicWs
   */
  FuturesPublicWs newFuturesPublicWS();

  /**
   * Returns the interface to interact with the Futures Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return FuturesPrivateWs
   */
  FuturesPrivateWs newFuturesPrivateWS();

  /**
   * Returns the UTA public push WebSocket service.
   *
   * <p>This service uses the direct {@code x-push-spot} or {@code x-push-futures} protocol. It is
   * separate from the legacy topic/token WebSocket services above.
   *
   * @param tradeType selects the Spot or Futures public push endpoint
   * @return UTA public push service
   */
  UtaPublicWs newUtaPublicWS(PushTradeType tradeType);

  /**
   * Returns the UTA private push WebSocket service.
   *
   * <p>The service authenticates with the API credentials configured in {@link ClientOption}.
   *
   * @return UTA private push service
   */
  UtaPrivateWs newUtaPrivateWS();

  /**
   * Returns the UTA WebSocket trading service for placing authenticated orders.
   *
   * <p>This is distinct from {@link #newUtaPrivateWS()}, which receives private push events.
   */
  UtaPrivateTradeWs newUtaPrivateTradeWS();
}
