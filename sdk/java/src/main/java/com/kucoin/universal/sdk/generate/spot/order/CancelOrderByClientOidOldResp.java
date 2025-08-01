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
public class CancelOrderByClientOidOldResp
    implements Response<
        CancelOrderByClientOidOldResp, RestResponse<CancelOrderByClientOidOldResp>> {
  /** Client Order Id，unique identifier created by the user */
  @JsonProperty("clientOid")
  private String clientOid;

  /** The unique order id generated by the trading system */
  @JsonProperty("cancelledOrderId")
  private String cancelledOrderId;

  /** */
  @JsonProperty("cancelledOcoOrderIds")
  private List<String> cancelledOcoOrderIds = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<CancelOrderByClientOidOldResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<CancelOrderByClientOidOldResp> response) {
    this.commonResponse = response;
  }
}
