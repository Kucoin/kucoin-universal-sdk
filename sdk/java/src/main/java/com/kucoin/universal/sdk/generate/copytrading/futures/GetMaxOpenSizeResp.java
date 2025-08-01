// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.copytrading.futures;

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
public class GetMaxOpenSizeResp
    implements Response<GetMaxOpenSizeResp, RestResponse<GetMaxOpenSizeResp>> {
  /**
   * Symbol of the contract. Please refer to [Get Symbol endpoint:
   * symbol](https://www.kucoin.com/docs-new/api-3470220)
   */
  @JsonProperty("symbol")
  private String symbol;

  /** Maximum buy size */
  @JsonProperty("maxBuyOpenSize")
  private String maxBuyOpenSize;

  /** Maximum buy size */
  @JsonProperty("maxSellOpenSize")
  private String maxSellOpenSize;

  /** common response */
  @JsonIgnore private RestResponse<GetMaxOpenSizeResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetMaxOpenSizeResp> response) {
    this.commonResponse = response;
  }
}
