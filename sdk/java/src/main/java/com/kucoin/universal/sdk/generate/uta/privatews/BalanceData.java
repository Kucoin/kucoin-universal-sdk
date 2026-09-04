// Code generated from the UTA Private WebSocket Balance schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of a UTA account-balance change. Decimal values and timestamps are represented as strings. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class BalanceData {
  @JsonProperty("U") private String updatedAt;
  @JsonProperty("a") private String available;
  @JsonProperty("b") private String balance;
  @JsonProperty("c") private String currency;
  @JsonProperty("e") private String equity;
  @JsonProperty("h") private String hold;
  @JsonProperty("l") private String liabilities;
  @JsonProperty("cS") private String changeStatus;
}
