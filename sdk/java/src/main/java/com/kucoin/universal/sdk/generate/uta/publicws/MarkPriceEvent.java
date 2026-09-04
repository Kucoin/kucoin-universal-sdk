// Code generated from the UTA Public WebSocket Mark Price schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Futures mark-price channel event, including mark price, index price and open interest. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class MarkPriceEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private MarkPriceData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(MarkPriceEvent event);
  }
}
