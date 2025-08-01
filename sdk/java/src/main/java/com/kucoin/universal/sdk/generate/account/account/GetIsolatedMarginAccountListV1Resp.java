// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.account;

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
public class GetIsolatedMarginAccountListV1Resp
    implements Response<
        GetIsolatedMarginAccountListV1Resp, RestResponse<GetIsolatedMarginAccountListV1Resp>> {
  /** The total balance of the isolated margin account (in the request coin) */
  @JsonProperty("totalConversionBalance")
  private String totalConversionBalance;

  /** Total liabilities of the isolated margin account (in the request coin) */
  @JsonProperty("liabilityConversionBalance")
  private String liabilityConversionBalance;

  /** Account list */
  @JsonProperty("assets")
  private List<GetIsolatedMarginAccountListV1Assets> assets = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetIsolatedMarginAccountListV1Resp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetIsolatedMarginAccountListV1Resp> response) {
    this.commonResponse = response;
  }
}
