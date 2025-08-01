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
public class CancelAllOrdersResp
    implements Response<CancelAllOrdersResp, RestResponse<CancelAllOrdersResp>> {
  /** The Symbols Successfully cancelled */
  @JsonProperty("succeedSymbols")
  private List<String> succeedSymbols = new ArrayList<>();

  /** The Symbols Failed to cancel */
  @JsonProperty("failedSymbols")
  private List<CancelAllOrdersFailedSymbols> failedSymbols = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<CancelAllOrdersResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<CancelAllOrdersResp> response) {
    this.commonResponse = response;
  }
}
