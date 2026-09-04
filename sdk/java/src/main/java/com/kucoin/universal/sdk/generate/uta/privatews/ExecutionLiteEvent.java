// Code generated from the UTA Private WebSocket Execution Lite schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Lightweight UTA private execution event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class ExecutionLiteEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private ExecutionLiteData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(ExecutionLiteEvent event);
  }
}
