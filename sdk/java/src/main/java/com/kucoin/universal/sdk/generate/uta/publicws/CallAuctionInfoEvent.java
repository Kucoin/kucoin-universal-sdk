// Code generated from the UTA Public WebSocket Call Auction schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Spot call-auction information event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class CallAuctionInfoEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("t")
  private String updateType;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private CallAuctionInfoData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(CallAuctionInfoEvent event);
  }
}
