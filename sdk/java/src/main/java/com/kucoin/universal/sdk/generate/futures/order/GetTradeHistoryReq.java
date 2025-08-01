// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.order;

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
public class GetTradeHistoryReq implements Request {
  /**
   * List fills for a specific order only (if you specify orderId, other parameters can be ignored)
   */
  @JsonProperty("orderId")
  private String orderId;

  /**
   * Symbol of the contract. Please refer to [Get Symbol endpoint:
   * symbol](https://www.kucoin.com/docs-new/api-3470220)
   */
  @JsonProperty("symbol")
  private String symbol;

  /** Order side */
  @JsonProperty("side")
  private SideEnum side;

  /** Order Type */
  @JsonProperty("type")
  private TypeEnum type;

  /**
   * Transaction type: trade, adl, liquid, settlement. Supports querying multiple types at the same
   * time, separated by commas. Query all types when empty
   */
  @JsonProperty("tradeTypes")
  private String tradeTypes;

  /** Start time (milliseconds) */
  @JsonProperty("startAt")
  private Long startAt;

  /** End time (milliseconds) */
  @JsonProperty("endAt")
  private Long endAt;

  /** Current request page. The default currentPage is 1 */
  @JsonProperty("currentPage")
  @Builder.Default
  private Integer currentPage = 1;

  /** pageSize, The default pageSize is 50; the maximum cannot exceed 1000 */
  @JsonProperty("pageSize")
  @Builder.Default
  private Integer pageSize = 50;

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

  public enum TypeEnum {
    /** Limit order */
    LIMIT("limit"),
    /** Market order */
    MARKET("market"),
    /** Stop limit order */
    LIMITSTOP("limit_stop"),
    /** Stop Market order */
    MARKETSTOP("market_stop");

    private final String value;

    TypeEnum(String value) {
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
    public static TypeEnum fromValue(String value) {
      for (TypeEnum b : TypeEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
