// Code generated from the UTA Private WebSocket Position schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA futures position change event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class PositionEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private PositionData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(PositionEvent event);
  }
}
