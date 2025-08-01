// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.copytrading.futures;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.model.RestResponse;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetMaxWithdrawMarginResp
    implements Response<GetMaxWithdrawMarginResp, RestResponse<GetMaxWithdrawMarginResp>> {
  /**
   * The size of the position that can be deposited. If it is USDT-margin, it represents the amount
   * of USDT. If it is coin-margin, this value represents the number of coins
   */
  @JsonProperty("data")
  private String data;

  /** common response */
  @JsonIgnore private RestResponse<GetMaxWithdrawMarginResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetMaxWithdrawMarginResp> response) {
    this.commonResponse = response;
  }

  @JsonCreator
  public static GetMaxWithdrawMarginResp fromJson(String data) {
    // original response
    GetMaxWithdrawMarginResp obj = new GetMaxWithdrawMarginResp();
    obj.data = data;
    return obj;
  }

  @JsonValue
  public Object toJson() {
    return this.data;
  }
}
