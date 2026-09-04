// Code generated from the UTA Private WebSocket Execution schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Unified-account execution event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class ExecutionEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private ExecutionData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(ExecutionEvent event);
  }
}
