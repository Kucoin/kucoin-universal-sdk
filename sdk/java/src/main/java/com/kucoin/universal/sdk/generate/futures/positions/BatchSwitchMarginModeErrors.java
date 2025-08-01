// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.positions;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class BatchSwitchMarginModeErrors {
  /** Error code */
  @JsonProperty("code")
  private String code;

  /** Error message */
  @JsonProperty("msg")
  private String msg;

  /** Symbol */
  @JsonProperty("symbol")
  private String symbol;
}
