// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.market;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.model.RestResponse;
import java.util.ArrayList;
import java.util.List;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetSpotIndexPriceResp
    implements Response<GetSpotIndexPriceResp, RestResponse<GetSpotIndexPriceResp>> {
  /** */
  @JsonProperty("dataList")
  private List<GetSpotIndexPriceDataList> dataList = new ArrayList<>();

  /** Whether there are more pages */
  @JsonProperty("hasMore")
  private Boolean hasMore;

  /** common response */
  @JsonIgnore private RestResponse<GetSpotIndexPriceResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetSpotIndexPriceResp> response) {
    this.commonResponse = response;
  }
}
