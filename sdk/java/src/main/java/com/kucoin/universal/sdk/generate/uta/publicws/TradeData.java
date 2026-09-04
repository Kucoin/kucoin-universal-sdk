// Code generated from the UTA Public WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Payload in a UTA public trade push. Price and quantity values are strings by protocol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class TradeData {
  @JsonProperty("p")
  private String price;

  @JsonProperty("q")
  private String quantity;

  @JsonProperty("s")
  private String symbol;

  /** Trade side; both Spot and Futures examples use lowercase values. */
  @JsonProperty("S")
  private String side;

  @JsonProperty("E")
  private Long eventTime;

  @JsonProperty("M")
  private Long matchingTime;

  /** Trade identifier. Kept as String because the protocol can exceed JavaScript-safe precision. */
  @JsonProperty("ti")
  private String tradeId;

  /** Futures-only: whether the trade was executed by a retail price-improvement order. */
  @JsonProperty("rpi")
  private Boolean retailPriceImprovement;
}
