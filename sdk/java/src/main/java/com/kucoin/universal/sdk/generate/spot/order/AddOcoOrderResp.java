// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.order;

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
public class AddOcoOrderResp implements Response<AddOcoOrderResp, RestResponse<AddOcoOrderResp>> {
  /**
   * The unique order id generated by the trading system,which can be used later for further actions
   * such as canceling the order.
   */
  @JsonProperty("orderId")
  private String orderId;

  /** common response */
  @JsonIgnore private RestResponse<AddOcoOrderResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<AddOcoOrderResp> response) {
    this.commonResponse = response;
  }
}
