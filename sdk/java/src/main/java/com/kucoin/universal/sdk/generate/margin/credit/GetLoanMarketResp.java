// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.margin.credit;

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
public class GetLoanMarketResp
    implements Response<GetLoanMarketResp, RestResponse<GetLoanMarketResp>> {
  /** */
  @JsonProperty("data")
  private List<GetLoanMarketData> data = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetLoanMarketResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetLoanMarketResp> response) {
    this.commonResponse = response;
  }

  @JsonCreator
  public static GetLoanMarketResp fromJson(List<GetLoanMarketData> data) {
    // original response
    GetLoanMarketResp obj = new GetLoanMarketResp();
    obj.data = data;
    return obj;
  }

  @JsonValue
  public Object toJson() {
    return this.data;
  }
}
