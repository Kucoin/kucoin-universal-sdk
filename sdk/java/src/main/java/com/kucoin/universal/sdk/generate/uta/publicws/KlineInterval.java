// Code generated from the UTA Public WebSocket Kline schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

/** Intervals accepted by the UTA public Kline channel. {@link #HOUR_6} is Spot-only. */
public enum KlineInterval {
  MIN_1("1min"),
  MIN_3("3min"),
  MIN_5("5min"),
  MIN_15("15min"),
  MIN_30("30min"),
  HOUR_1("1hour"),
  HOUR_2("2hour"),
  HOUR_4("4hour"),
  HOUR_6("6hour"),
  HOUR_8("8hour"),
  HOUR_12("12hour"),
  DAY_1("1day"),
  WEEK_1("1week"),
  MONTH_1("1month");

  private final String value;

  KlineInterval(String value) {
    this.value = value;
  }

  public String getValue() {
    return value;
  }

  public static KlineInterval fromValue(String value) {
    for (KlineInterval interval : values()) {
      if (interval.value.equals(value)) {
        return interval;
      }
    }
    throw new IllegalArgumentException("Unsupported Kline interval: " + value);
  }
}
