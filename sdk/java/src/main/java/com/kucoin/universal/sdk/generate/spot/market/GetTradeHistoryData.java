// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.market;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetTradeHistoryData {
  /** Sequence number */
  @JsonProperty("sequence")
  private String sequence;

  /** Filled price */
  @JsonProperty("price")
  private String price;

  /** Filled amount */
  @JsonProperty("size")
  private String size;

  /**
   * Filled side, The trade side indicates the taker order side. A taker order is the order that was
   * matched with orders opened on the order book.
   */
  @JsonProperty("side")
  private SideEnum side;

  /** Filled timestamp(nanosecond) */
  @JsonProperty("time")
  private Long time;

  public enum SideEnum {
    /** buy */
    BUY("buy"),
    /** sell */
    SELL("sell");

    private final String value;

    SideEnum(String value) {
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
    public static SideEnum fromValue(String value) {
      for (SideEnum b : SideEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
