// Code generated from the UTA Private WebSocket Execution schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of an executed unified-account trade. Decimal values and identifiers are strings. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class ExecutionData {
  @JsonProperty("oi")
  private String orderId;

  @JsonProperty("s")
  private String symbol;

  @JsonProperty("S")
  private String side;

  @JsonProperty("oT")
  private String orderType;

  @JsonProperty("p")
  private String price;

  @JsonProperty("q")
  private String quantity;

  @JsonProperty("ti")
  private String tradeId;

  @JsonProperty("E")
  private Long eventTime;

  @JsonProperty("lR")
  private String liquidityRole;

  @JsonProperty("f")
  private String fee;

  @JsonProperty("fC")
  private String feeCurrency;

  /** NORMAL, ADL, LIQUID, SETTLEMENT, etc. */
  @JsonProperty("fT")
  private String fillType;

  @JsonProperty("ci")
  private String clientOid;
}
