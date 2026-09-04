// Code generated from the UTA Private WebSocket Leverage schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of a UTA futures or margin leverage change. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class LeverageData {
  @JsonProperty("s") private String symbol;
  @JsonProperty("c") private String currency;
  @JsonProperty("l") private String leverage;
  @JsonProperty("mM") private String marginMode;
  @JsonProperty("tT") private String tradeType;
}
