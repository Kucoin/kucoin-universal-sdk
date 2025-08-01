// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.account;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
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
public class GetSpotAccountListResp
    implements Response<GetSpotAccountListResp, RestResponse<GetSpotAccountListResp>> {
  /** */
  @JsonProperty("data")
  private List<GetSpotAccountListData> data = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetSpotAccountListResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetSpotAccountListResp> response) {
    this.commonResponse = response;
  }

  @JsonCreator
  public static GetSpotAccountListResp fromJson(List<GetSpotAccountListData> data) {
    // original response
    GetSpotAccountListResp obj = new GetSpotAccountListResp();
    obj.data = data;
    return obj;
  }

  @JsonValue
  public Object toJson() {
    return this.data;
  }
}
