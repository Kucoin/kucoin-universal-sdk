// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.transfer;

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
public class InnerTransferReq implements Request {
  /**
   * Unique order ID created by users to identify their orders, e.g. UUID, with a maximum length of
   * 128 bits
   */
  @JsonProperty("clientOid")
  private String clientOid;

  /** currency */
  @JsonProperty("currency")
  private String currency;

  /** Transfer amount: The amount is a positive integer multiple of the currency precision. */
  @JsonProperty("amount")
  private String amount;

  /** Receiving Account Type: main, trade, margin, isolated, margin_v2, isolated_v2, contract */
  @JsonProperty("to")
  private ToEnum to;

  /** Trading pair, required when the payment account type is isolated, e.g.: BTC-USDT */
  @JsonProperty("fromTag")
  private String fromTag;

  /** Trading pair, required when the payment account type is isolated, e.g.: BTC-USDT */
  @JsonProperty("toTag")
  private String toTag;

  /** Payment Account Type: main, trade, margin, isolated, margin_v2, isolated_v2 */
  @JsonProperty("from")
  private FromEnum from;

  public enum ToEnum {
    /** Funding account */
    MAIN("main"),
    /** Spot account */
    TRADE("trade"),
    /** Cross margin account */
    MARGIN("margin"),
    /** Isolated margin account */
    ISOLATED("isolated"),
    /** Cross margin account */
    MARGINV2("margin_v2"),
    /** Isolated margin account */
    ISOLATEDV2("isolated_v2"),
    /** Option account */
    OPTION("option");

    private final String value;

    ToEnum(String value) {
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
    public static ToEnum fromValue(String value) {
      for (ToEnum b : ToEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }

  public enum FromEnum {
    /** Funding account */
    MAIN("main"),
    /** Spot account */
    TRADE("trade"),
    /** Cross margin account */
    MARGIN("margin"),
    /** Isolated margin account */
    ISOLATED("isolated"),
    /** Cross margin account */
    MARGINV2("margin_v2"),
    /** Isolated margin account */
    ISOLATEDV2("isolated_v2"),
    /** Option account */
    OPTION("option");

    private final String value;

    FromEnum(String value) {
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
    public static FromEnum fromValue(String value) {
      for (FromEnum b : FromEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
