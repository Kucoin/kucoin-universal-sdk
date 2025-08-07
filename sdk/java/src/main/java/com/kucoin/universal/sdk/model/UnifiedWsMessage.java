package com.kucoin.universal.sdk.model;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import java.util.HashMap;
import java.util.Map;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class UnifiedWsMessage {
  /** User-defined ID (not orderid) is used to uniquely represent a request */
  @JsonProperty("id")
  private String id;

  /** Response data */
  @JsonProperty("data")
  private Map<String, Object> data = new HashMap<>();

  /** Command options */
  @JsonProperty("op")
  private String op;

  /** Gateway error code, 200000 means ok */
  @JsonProperty("code")
  private String code;

  /** Error message */
  @JsonProperty("msg")
  private String message;

  /** Gateway in time(ms) */
  @JsonProperty("inTime")
  private Long inTime;

  /** Gateway out time(ms) */
  @JsonProperty("outTime")
  private Long outTime;

  /** Rate limiting data */
  @JsonProperty("userRateLimit")
  private RateLimit rateLimit;
}
