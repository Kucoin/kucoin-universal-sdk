// Code generated from the UTA Private WebSocket Position schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of a UTA futures position update. Decimal values and identifiers are strings. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class PositionData {
  @JsonProperty("O") private Long createdAt;
  @JsonProperty("U") private Long updatedAt;
  @JsonProperty("l") private String leverage;
  @JsonProperty("q") private String quantity;
  @JsonProperty("s") private String symbol;
  @JsonProperty("bP") private String bankruptcyPrice;
  @JsonProperty("eP") private String entryPrice;
  @JsonProperty("iM") private String initialMargin;
  @JsonProperty("lP") private String liquidationPrice;
  @JsonProperty("mM") private String marginMode;
  @JsonProperty("mP") private String markPrice;
  @JsonProperty("pV") private String positionValue;
  @JsonProperty("pi") private String positionId;
  @JsonProperty("mmr") private String maintenanceMarginRate;
  @JsonProperty("mtM") private String maintenanceMargin;
  @JsonProperty("rPL") private String realisedPnl;
  @JsonProperty("uPL") private String unrealisedPnl;
  @JsonProperty("r") private String riskLimitLevel;
  @JsonProperty("adl") private String adl;
}
