// Code generated from the UTA Private WebSocket Leverage schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA leverage multiplier change event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class LeverageEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private LeverageData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(LeverageEvent event);
  }
}
