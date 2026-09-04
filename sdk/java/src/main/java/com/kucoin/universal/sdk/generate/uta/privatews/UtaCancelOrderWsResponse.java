// Code generated from the UTA WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.kucoin.universal.sdk.generate.uta.order.CancelOrderResp;
import lombok.Data;

/** Response to a {@code uta.cancel} WebSocket request. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class UtaCancelOrderWsResponse {
  @JsonProperty("code") private String code;
  @JsonProperty("msg") private String message;
  @JsonProperty("id") private String id;
  @JsonProperty("op") private String operation;
  @JsonProperty("data") private CancelOrderResp data;
  @JsonProperty("inTime") private Long inTime;
  @JsonProperty("outTime") private Long outTime;
  @JsonProperty("userRateLimit") private UtaWsRateLimit userRateLimit;
}
