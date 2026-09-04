// Code generated from the UTA WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.kucoin.universal.sdk.generate.uta.order.PlaceOrderResp;
import lombok.Data;

/** Response to a {@code uta.order} WebSocket request. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class UtaPlaceOrderWsResponse {
  @JsonProperty("code") private String code;
  @JsonProperty("msg") private String message;
  @JsonProperty("id") private String id;
  @JsonProperty("op") private String operation;
  @JsonProperty("data") private PlaceOrderResp data;
  @JsonProperty("inTime") private Long inTime;
  @JsonProperty("outTime") private Long outTime;
  @JsonProperty("userRateLimit") private UtaWsRateLimit userRateLimit;
}
