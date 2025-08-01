// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.subaccount;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
import com.kucoin.universal.sdk.internal.interfaces.Request;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Builder
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class AddSubAccountReq implements Request {
  /**
   * Password (7–24 characters, must contain letters and numbers, cannot only contain numbers or
   * include special characters)
   */
  @JsonProperty("password")
  private String password;

  /** Remarks (1–24 characters) */
  @JsonProperty("remarks")
  private String remarks;

  /**
   * Sub-account name (must contain 7–32 characters, at least one number and one letter. Cannot
   * contain any spaces.)
   */
  @JsonProperty("subName")
  private String subName;

  /**
   * Permission (types include Spot, Futures, Margin permissions, which can be used alone or in
   * combination).
   */
  @JsonProperty("access")
  private AccessEnum access;

  public enum AccessEnum {
    /** Spot Account */
    SPOT("Spot"),
    /** Futures Account */
    FUTURES("Futures"),
    /** Margin Account */
    MARGIN("Margin");

    private final String value;

    AccessEnum(String value) {
      this.value = value;
    }

    @JsonValue
    public String getValue() {
      return value;
    }

    @Override
    public String toString() {
      return String.valueOf(value);
    }

    @JsonCreator
    public static AccessEnum fromValue(String value) {
      for (AccessEnum b : AccessEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
