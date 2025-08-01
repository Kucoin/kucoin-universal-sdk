// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.order;

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
public class BatchAddOrdersResp
    implements Response<BatchAddOrdersResp, RestResponse<BatchAddOrdersResp>> {
  /** */
  @JsonProperty("data")
  private List<BatchAddOrdersData> data = new ArrayList<>();

  /** common response */
  @JsonIgnore private RestResponse<BatchAddOrdersResp> commonResponse;

  @Override
  public void setCommonResponse(RestResponse<BatchAddOrdersResp> response) {
    this.commonResponse = response;
  }

  @JsonCreator
  public static BatchAddOrdersResp fromJson(List<BatchAddOrdersData> data) {
    // original response
    BatchAddOrdersResp obj = new BatchAddOrdersResp();
    obj.data = data;
    return obj;
  }

  @JsonValue
  public Object toJson() {
    return this.data;
  }
}
