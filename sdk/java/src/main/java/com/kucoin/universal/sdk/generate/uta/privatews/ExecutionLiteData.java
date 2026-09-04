// Code generated from the UTA Private WebSocket Execution Lite schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Lightweight execution data. Fee-related fields are intentionally absent. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class ExecutionLiteData {
  @JsonProperty("E")
  private Long eventTime;

  @JsonProperty("S")
  private String side;

  @JsonProperty("p")
  private String price;

  @JsonProperty("q")
  private String quantity;

  @JsonProperty("s")
  private String symbol;

  @JsonProperty("lR")
  private String liquidityRole;

  @JsonProperty("oT")
  private String orderType;

  @JsonProperty("oi")
  private String orderId;

  /** String supports both numeric and string forms sent by the channel. */
  @JsonProperty("ti")
  private String tradeId;
}
