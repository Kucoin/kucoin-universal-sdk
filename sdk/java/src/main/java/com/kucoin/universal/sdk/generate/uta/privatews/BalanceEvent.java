// Code generated from the UTA Private WebSocket Balance schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA account-balance change event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class BalanceEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private BalanceData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(BalanceEvent event);
  }
}
