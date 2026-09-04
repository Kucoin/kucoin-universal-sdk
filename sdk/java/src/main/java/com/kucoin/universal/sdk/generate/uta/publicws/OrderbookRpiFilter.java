// Code generated from the UTA Public WebSocket Orderbook schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

/** Futures-only Retail Price Improvement filter for the UTA public {@code obu} channel. */
public enum OrderbookRpiFilter {
  NONE_RPI_ONLY(0),
  INCLUDE_RPI(1);

  private final int value;

  OrderbookRpiFilter(int value) {
    this.value = value;
  }

  public int getValue() {
    return value;
  }

  public static OrderbookRpiFilter fromValue(String value) {
    for (OrderbookRpiFilter filter : values()) {
      if (Integer.toString(filter.value).equals(value)) {
        return filter;
      }
    }
    throw new IllegalArgumentException("Unsupported orderbook rpiFilter: " + value);
  }
}
