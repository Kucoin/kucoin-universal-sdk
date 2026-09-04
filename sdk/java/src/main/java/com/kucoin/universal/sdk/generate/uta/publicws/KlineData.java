// Code generated from the UTA Public WebSocket Kline schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Payload in a UTA public Kline push. Prices, amount and volume are strings by protocol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class KlineData {
  @JsonProperty("o")
  private String open;

  @JsonProperty("c")
  private String close;

  @JsonProperty("l")
  private String low;

  @JsonProperty("h")
  private String high;

  /** Whether the Kline is closed. */
  @JsonProperty("S")
  private Boolean closed;

  @JsonProperty("v")
  private String volume;

  @JsonProperty("i")
  private String interval;

  @JsonProperty("a")
  private String amount;

  /** Kline close time in seconds. */
  @JsonProperty("C")
  private Long closeTime;

  @JsonProperty("s")
  private String symbol;

  /** Kline open time in seconds. */
  @JsonProperty("O")
  private Long openTime;
}
