// Code generated from the UTA Public WebSocket ticker schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA public ticker event envelope. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class TickerEvent {
  /** Event topic, for example {@code ticker.SPOT} or {@code ticker.FUTURES}. */
  @JsonProperty("T")
  private String topic;

  /** Server sequence / push identifier. */
  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private TickerData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(TickerEvent event);
  }
}
