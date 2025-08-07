package com.kucoin.universal.sdk.model;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;
import lombok.ToString;

@Data
@ToString(exclude = "data")
@JsonIgnoreProperties(ignoreUnknown = true)
public class RestResponse<T> {

  @JsonProperty("code")
  private String code;

  @JsonProperty("data")
  private T data;

  @JsonProperty("msg")
  private String message;

  @JsonProperty("rateLimit")
  private RateLimit rateLimit;

  public void checkError() throws RestError {
    if (!code.equalsIgnoreCase(Constants.RESULT_CODE_SUCCESS)) {
      throw new RestError(
          this,
          new Exception(
              String.format("Server returned an error, code: %s, msg: %s", code, message)));
    }
  }
}
