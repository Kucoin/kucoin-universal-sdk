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
public class GetAllTickersTicker {
  /** Symbol */
  @JsonProperty("symbol")
  private String symbol;

  /** Name of trading pairs, it will change after renaming */
  @JsonProperty("symbolName")
  private String symbolName;

  /** Best bid price */
  @JsonProperty("buy")
  private String buy;

  /** Best bid size */
  @JsonProperty("bestBidSize")
  private String bestBidSize;

  /** Best ask price */
  @JsonProperty("sell")
  private String sell;

  /** Best ask size */
  @JsonProperty("bestAskSize")
  private String bestAskSize;

  /** 24h change rate */
  @JsonProperty("changeRate")
  private String changeRate;

  /** 24h change price */
  @JsonProperty("changePrice")
  private String changePrice;

  /** Highest price in 24h */
  @JsonProperty("high")
  private String high;

  /** Lowest price in 24h */
  @JsonProperty("low")
  private String low;

  /** 24h volume, executed based on base currency */
  @JsonProperty("vol")
  private String vol;

  /** 24h traded amount */
  @JsonProperty("volValue")
  private String volValue;

  /** Last traded price */
  @JsonProperty("last")
  private String last;

  /** Average trading price in the last 24 hours */
  @JsonProperty("averagePrice")
  private String averagePrice;

  /** Basic Taker Fee */
  @JsonProperty("takerFeeRate")
  private String takerFeeRate;

  /** Basic Maker Fee */
  @JsonProperty("makerFeeRate")
  private String makerFeeRate;

  /**
   * The taker fee coefficient. The actual fee needs to be multiplied by this coefficient to get the
   * final fee. Most currencies have a coefficient of 1. If set to 0, it means no fee
   */
  @JsonProperty("takerCoefficient")
  private TakerCoefficientEnum takerCoefficient;

  /**
   * The maker fee coefficient. The actual fee needs to be multiplied by this coefficient to get the
   * final fee. Most currencies have a coefficient of 1. If set to 0, it means no fee
   */
  @JsonProperty("makerCoefficient")
  private MakerCoefficientEnum makerCoefficient;

  public enum TakerCoefficientEnum {
    /** The taker fee coefficient is 1 */
    _1("1"),
    /** No fee */
    _0("0");

    private final String value;

    TakerCoefficientEnum(String value) {
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
    public static TakerCoefficientEnum fromValue(String value) {
      for (TakerCoefficientEnum b : TakerCoefficientEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }

  public enum MakerCoefficientEnum {
    /** The maker fee coefficient is 1 */
    _1("1"),
    /** No fee */
    _0("0");

    private final String value;

    MakerCoefficientEnum(String value) {
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
    public static MakerCoefficientEnum fromValue(String value) {
      for (MakerCoefficientEnum b : MakerCoefficientEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
