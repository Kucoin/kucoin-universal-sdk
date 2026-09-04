// Code generated from the UTA WebSocket Trade schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Per-user rate-limit snapshot included in a WebSocket trade response. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class UtaWsRateLimit {
  @JsonProperty("limit") private Integer limit;
  @JsonProperty("remaining") private Integer remaining;
  @JsonProperty("reset") private Long reset;
}
