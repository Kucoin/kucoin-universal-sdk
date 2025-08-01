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
public class GetOcoOrderByClientOidResp
    implements Response<GetOcoOrderByClientOidResp, RestResponse<GetOcoOrderByClientOidResp>> {
  /** symbol */
  @JsonProperty("symbol")
  private String symbol;

  /** Client Order Id */
  @JsonProperty("clientOid")
  private String clientOid;

  /**
   * The unique order id generated by the trading system,which can be used later for further actions
   * such as canceling the order.
   */
  @JsonProperty("orderId")
  private String orderId;

  /** Order placement time, milliseconds */
  @JsonProperty("orderTime")
  private Long orderTime;

  /** Order status: NEW: New, DONE: Completed, TRIGGERED: Triggered, CANCELLED: Cancelled */
  @JsonProperty("status")
  private String status;

  /** common response */
  @JsonIgnore private RestResponse<GetOcoOrderByClientOidResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetOcoOrderByClientOidResp> response) {
    this.commonResponse = response;
  }
}
