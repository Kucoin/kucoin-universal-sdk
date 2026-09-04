// Code generated from the UTA Public WebSocket ticker schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Payload in a UTA public ticker push. Numeric price and quantity values are strings by protocol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class TickerData {
  @JsonProperty("a")
  private String bestAskPrice;

  @JsonProperty("A")
  private String bestAskSize;

  @JsonProperty("b")
  private String bestBidPrice;

  @JsonProperty("B")
  private String bestBidSize;

  @JsonProperty("l")
  private String lastPrice;

  @JsonProperty("q")
  private String lastSize;

  @JsonProperty("s")
  private String symbol;

  /** BUY/SELL for Spot; the Futures service may use lowercase values. */
  @JsonProperty("S")
  private String side;

  @JsonProperty("E")
  private Long eventTime;

  /** Matching-engine time as defined separately by the Spot and Futures ticker documentation. */
  @JsonProperty("M")
  private Long matchingTime;
}
