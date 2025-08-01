// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.subaccount;

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
public class GetSpotSubAccountListV2Resp
    implements Response<GetSpotSubAccountListV2Resp, RestResponse<GetSpotSubAccountListV2Resp>> {
  /** */
  @JsonProperty("currentPage")
  private Integer currentPage;

  /** */
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
  private List<GetSpotSubAccountListV2Items> items = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetSpotSubAccountListV2Resp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetSpotSubAccountListV2Resp> response) {
    this.commonResponse = response;
  }
}
