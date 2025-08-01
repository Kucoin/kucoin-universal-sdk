// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.order;

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
public class GetStopOrdersListResp
    implements Response<GetStopOrdersListResp, RestResponse<GetStopOrdersListResp>> {
  /** current page id */
  @JsonProperty("currentPage")
  private Integer currentPage;

  /** */
  @JsonProperty("pageSize")
  private Integer pageSize;

  /** the stop order count */
  @JsonProperty("totalNum")
  private Integer totalNum;

  /** total page count of the list */
  @JsonProperty("totalPage")
  private Integer totalPage;

  /** the list of stop orders */
  @JsonProperty("items")
  private List<GetStopOrdersListItems> items = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetStopOrdersListResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetStopOrdersListResp> response) {
    this.commonResponse = response;
  }
}
