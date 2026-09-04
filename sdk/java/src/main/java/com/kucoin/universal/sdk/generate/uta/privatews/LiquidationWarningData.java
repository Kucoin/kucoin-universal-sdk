// Code generated from the UTA Private WebSocket Liquidation Warning schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of a UTA liquidation-risk warning. Decimal values are strings. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class LiquidationWarningData {
  @JsonProperty("eT") private String eventType;
  @JsonProperty("r") private String riskRatio;
  @JsonProperty("a") private String assets;
  @JsonProperty("iM") private String initialMargin;
  @JsonProperty("mM") private String maintenanceMargin;
  @JsonProperty("aM") private String availableMargin;
  @JsonProperty("e") private String equity;
  @JsonProperty("l") private String liabilities;
  @JsonProperty("U") private Long updatedAt;
}
