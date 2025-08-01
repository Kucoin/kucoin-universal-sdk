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
public class GetMarginAccountDetailResp
    implements Response<GetMarginAccountDetailResp, RestResponse<GetMarginAccountDetailResp>> {
  /** Debt ratio */
  @JsonProperty("debtRatio")
  private String debtRatio;

  /** Margin account list */
  @JsonProperty("accounts")
  private List<GetMarginAccountDetailAccounts> accounts = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetMarginAccountDetailResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetMarginAccountDetailResp> response) {
    this.commonResponse = response;
  }
}
