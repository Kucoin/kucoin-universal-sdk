// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.market;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.model.RestResponse;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetMarkPriceResp
    implements Response<GetMarkPriceResp, RestResponse<GetMarkPriceResp>> {
  /**
   * Symbol of the contract. Please refer to [Get Symbol endpoint:
   * symbol](https://www.kucoin.com/docs-new/api-3470220)
   */
  @JsonProperty("symbol")
  private String symbol;

  /** Granularity (milliseconds) */
  @JsonProperty("granularity")
  private Integer granularity;

  /** Time point (milliseconds) */
  @JsonProperty("timePoint")
  private Long timePoint;

  /** Mark price */
  @JsonProperty("value")
  private Double value;

  /** Index price */
  @JsonProperty("indexPrice")
  private Double indexPrice;

  /** common response */
  @JsonIgnore private RestResponse<GetMarkPriceResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetMarkPriceResp> response) {
    this.commonResponse = response;
  }
}
