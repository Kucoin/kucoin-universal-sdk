// Code generated from the UTA Private WebSocket Liquidation Warning schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA account liquidation-risk warning event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class LiquidationWarningEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private LiquidationWarningData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(LiquidationWarningEvent event);
  }
}
