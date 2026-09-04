// Code generated from the UTA Public WebSocket Orderbook schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

/** Depth mode accepted by the UTA public {@code obu} channel. */
public enum OrderbookDepth {
  BEST_1("1"),
  BEST_5("5"),
  BEST_50("50"),
  INCREMENT("increment"),
  INCREMENT_10MS("increment@10ms");

  private final String value;

  OrderbookDepth(String value) {
    this.value = value;
  }

  public String getValue() {
    return value;
  }

  public static OrderbookDepth fromValue(String value) {
    for (OrderbookDepth depth : values()) {
      if (depth.value.equals(value)) {
        return depth;
      }
    }
    throw new IllegalArgumentException("Unsupported orderbook depth: " + value);
  }
}
