// Code generated from the UTA Public WebSocket Orderbook schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** UTA public orderbook event envelope. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class OrderbookEvent {
  @JsonProperty("T")
  private String topic;

  /** {@code snapshot} for a snapshot message, {@code delta} for an incremental message. */
  @JsonProperty("t")
  private String updateType;

  /** The depth mode that produced this event. */
  @JsonProperty("dp")
  private String depth;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private OrderbookData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(OrderbookEvent event);
  }
}
