// Code generated from the UTA Public WebSocket Orderbook schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import java.util.List;
import lombok.Data;

/** Payload in a UTA public orderbook push. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class OrderbookData {
  /** Ending update sequence number. */
  @JsonProperty("C")
  private Long sequenceEnd;

  /** Starting update sequence number. */
  @JsonProperty("O")
  private Long sequenceStart;

  @JsonProperty("M")
  private Long matchingTime;

  /** Ask updates as [price, size], or [price, size, RPI flag] when the Futures RPI filter is on. */
  @JsonProperty("a")
  private List<List<String>> asks;

  /** Bid updates as [price, size], or [price, size, RPI flag] when the Futures RPI filter is on. */
  @JsonProperty("b")
  private List<List<String>> bids;

  @JsonProperty("s")
  private String symbol;
}
