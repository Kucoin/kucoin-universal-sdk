// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.order;

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
public class GetOrderListResp
    implements Response<GetOrderListResp, RestResponse<GetOrderListResp>> {
  /** Current request page, The default currentPage is 1 */
  @JsonProperty("currentPage")
  private Integer currentPage;

  /** pageSize, The default pageSize is 50, The maximum cannot exceed 1000 */
  @JsonProperty("pageSize")
  private Integer pageSize;

  /** */
  @JsonProperty("totalNum")
  private Integer totalNum;

  /** */
  @JsonProperty("totalPage")
  private Integer totalPage;

  /** */
  @JsonProperty("items")
  private List<GetOrderListItems> items = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetOrderListResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetOrderListResp> response) {
    this.commonResponse = response;
  }
}
