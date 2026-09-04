// Code generated from the UTA Public WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA public trade event envelope. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class TradeEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private TradeData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(TradeEvent event);
  }
}
