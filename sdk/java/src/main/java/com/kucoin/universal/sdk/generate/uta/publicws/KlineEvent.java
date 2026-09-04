// Code generated from the UTA Public WebSocket Kline schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA public Kline event envelope. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class KlineEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private KlineData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(KlineEvent event);
  }
}
