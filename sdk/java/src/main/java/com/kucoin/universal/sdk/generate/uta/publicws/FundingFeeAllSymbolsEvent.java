// Code generated from the UTA Public WebSocket Funding Fee All Symbols schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import java.util.List;
import lombok.Data;

/** Futures funding-fee update for all symbols. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class FundingFeeAllSymbolsEvent {
  @JsonProperty("T")
  private String topic;

  @JsonProperty("P")
  private Long sequence;

  @JsonProperty("d")
  private List<FundingFeeData> data;

  @FunctionalInterface
  public interface Callback {
    void onEvent(FundingFeeAllSymbolsEvent event);
  }
}
