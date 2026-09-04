package com.kucoin.universal.sdk.model;

/** Trading domain used by the direct UTA public push WebSocket service. */
public enum PushTradeType {
  SPOT("wss://x-push-spot.kucoin.com"),
  FUTURES("wss://x-push-futures.kucoin.com");

  private final String endpoint;

  PushTradeType(String endpoint) {
    this.endpoint = endpoint;
  }

  public String getEndpoint() {
    return endpoint;
  }
}
