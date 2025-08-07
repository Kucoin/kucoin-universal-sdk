package com.kucoin.universal.sdk.internal.ws;

import com.kucoin.universal.sdk.api.KucoinWSService;
import com.kucoin.universal.sdk.generate.Version;
import com.kucoin.universal.sdk.generate.futures.futuresprivate.FuturesPrivateWs;
import com.kucoin.universal.sdk.generate.futures.futuresprivate.FuturesPrivateWsImpl;
import com.kucoin.universal.sdk.generate.futures.futurespublic.FuturesPublicWs;
import com.kucoin.universal.sdk.generate.futures.futurespublic.FuturesPublicWsImpl;
import com.kucoin.universal.sdk.generate.margin.marginprivate.MarginPrivateWs;
import com.kucoin.universal.sdk.generate.margin.marginprivate.MarginPrivateWsImpl;
import com.kucoin.universal.sdk.generate.margin.marginpublic.MarginPublicWs;
import com.kucoin.universal.sdk.generate.margin.marginpublic.MarginPublicWsImpl;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWs;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWsImpl;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWs;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWsImpl;
import com.kucoin.universal.sdk.generate.unified.unifiedws.UnifiedPrivateWs;
import com.kucoin.universal.sdk.generate.unified.unifiedws.UnifiedPrivateWsImpl;
import com.kucoin.universal.sdk.internal.infra.DefaultWebSocketUnifiedService;
import com.kucoin.universal.sdk.internal.infra.DefaultWsService;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;

/** DefaultKucoinWsImpl provides WebSocket interfaces for Spot, Margin, and Futures trading. */
public final class DefaultKucoinWsImpl implements KucoinWSService {

  /** Client configuration options. */
  private final ClientOption clientOption;

  public DefaultKucoinWsImpl(ClientOption clientOption) {
    this.clientOption = clientOption;
  }

  /**
   * Returns the interface to interact with the Spot Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return SpotPublicWs
   */
  @Override
  public SpotPublicWs newSpotPublicWS() {
    DefaultWsService wsService =
        new DefaultWsService(clientOption, Constants.DOMAIN_TYPE_SPOT, false, Version.SDK_VERSION);
    return new SpotPublicWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the Spot Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return SpotPrivateWs
   */
  @Override
  public SpotPrivateWs newSpotPrivateWS() {
    DefaultWsService wsService =
        new DefaultWsService(clientOption, Constants.DOMAIN_TYPE_SPOT, true, Version.SDK_VERSION);
    return new SpotPrivateWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the Margin Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return MarginPublicWs
   */
  @Override
  public MarginPublicWs newMarginPublicWS() {
    DefaultWsService wsService =
        new DefaultWsService(clientOption, Constants.DOMAIN_TYPE_SPOT, false, Version.SDK_VERSION);
    return new MarginPublicWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the Margin Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return MarginPrivateWs
   */
  @Override
  public MarginPrivateWs newMarginPrivateWS() {
    DefaultWsService wsService =
        new DefaultWsService(clientOption, Constants.DOMAIN_TYPE_SPOT, true, Version.SDK_VERSION);
    return new MarginPrivateWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the Futures Trading WebSocket (public channel) API of
   * KuCoin.
   *
   * @return FuturesPublicWs
   */
  @Override
  public FuturesPublicWs newFuturesPublicWS() {
    DefaultWsService wsService =
        new DefaultWsService(
            clientOption, Constants.DOMAIN_TYPE_FUTURES, false, Version.SDK_VERSION);
    return new FuturesPublicWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the Futures Trading WebSocket (private channel) API of
   * KuCoin.
   *
   * @return FuturesPrivateWs
   */
  @Override
  public FuturesPrivateWs newFuturesPrivateWS() {
    DefaultWsService wsService =
        new DefaultWsService(
            clientOption, Constants.DOMAIN_TYPE_FUTURES, true, Version.SDK_VERSION);
    return new FuturesPrivateWsImpl(wsService);
  }

  /**
   * Returns the interface to interact with the unified private WebSocket API of KuCoin, allowing
   * for spot, margin, and futures trading operations through a single, secure WebSocket connection.
   *
   * @return UnifiedPrivateWs The unified private WebSocket service interface.
   */
  @Override
  public UnifiedPrivateWs newUnifiedPrivateWS() {
    DefaultWebSocketUnifiedService wsService =
        new DefaultWebSocketUnifiedService(clientOption, Version.SDK_VERSION);
    return new UnifiedPrivateWsImpl(wsService);
  }
}
