// Code generated from the UTA Public WebSocket Funding Fee schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Futures funding-fee channel event. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class FundingFeeEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private FundingFeeData data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(FundingFeeEvent event);
  }
}
