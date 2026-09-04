// Code generated from the UTA Public WebSocket Funding Fee schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Funding-rate payload for a Futures symbol. Decimal values are strings by protocol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class FundingFeeData {
  @JsonProperty("s")
  private String symbol;

  @JsonProperty("fr")
  private String fundingRate;

  @JsonProperty("ft")
  private Long fundingTime;

  @JsonProperty("lfr")
  private String lastFundingRate;

  @JsonProperty("nt")
  private Long nextFundingTime;

  /** Funding interval in milliseconds. */
  @JsonProperty("gl")
  private Long fundingInterval;

  @JsonProperty("fc")
  private String fundingCap;

  @JsonProperty("ff")
  private String fundingFloor;
}
