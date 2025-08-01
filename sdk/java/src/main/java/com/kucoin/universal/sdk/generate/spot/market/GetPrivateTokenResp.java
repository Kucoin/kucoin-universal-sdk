// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.market;

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
public class GetPrivateTokenResp
    implements Response<GetPrivateTokenResp, RestResponse<GetPrivateTokenResp>> {
  /** The token required to establish a Websocket connection */
  @JsonProperty("token")
  private String token;

  /** */
  @JsonProperty("instanceServers")
  private List<GetPrivateTokenInstanceServers> instanceServers = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<GetPrivateTokenResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<GetPrivateTokenResp> response) {
    this.commonResponse = response;
  }
}
