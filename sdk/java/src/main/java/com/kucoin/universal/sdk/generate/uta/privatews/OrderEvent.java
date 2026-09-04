// Code generated from the UTA Private WebSocket Order schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Unified-account order lifecycle event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class OrderEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private OrderData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(OrderEvent event);
  }
}
