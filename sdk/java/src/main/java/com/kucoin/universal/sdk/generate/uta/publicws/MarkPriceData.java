// Code generated from the UTA Public WebSocket Mark Price schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Mark price, index price and open-interest payload for a Futures symbol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class MarkPriceData {
  @JsonProperty("s")
  private String symbol;

  @JsonProperty("mp")
  private String markPrice;

  @JsonProperty("ip")
  private String indexPrice;

  @JsonProperty("oi")
  private String openInterest;

  @JsonProperty("ts")
  private Long timestamp;
}
