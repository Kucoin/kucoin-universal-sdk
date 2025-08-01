// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.order;

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
public class AddOcoOrderReq implements Request {
  /**
   * Client Order Id，The ClientOid field is a unique ID created by the user（we recommend using a
   * UUID）, and can only contain numbers, letters, underscores （_）, and hyphens （-）. This field is
   * returned when order information is obtained. You can use clientOid to tag your orders.
   * ClientOid is different from the order ID created by the service provider. Please do not
   * initiate requests using the same clientOid. The maximum length for the ClientOid is 40
   * characters. Please remember the orderId created by the service provider, it used to check for
   * updates in order status.
   */
  @JsonProperty("clientOid")
  private String clientOid;

  /** specify if the order is to 'buy' or 'sell' */
  @JsonProperty("side")
  private SideEnum side;

  /** symbol */
  @JsonProperty("symbol")
  private String symbol;

  /** Order placement remarks, length cannot exceed 20 characters (ASCII) */
  @JsonProperty("remark")
  private String remark;

  /** Specify price for order */
  @JsonProperty("price")
  private String price;

  /** Specify quantity for order */
  @JsonProperty("size")
  private String size;

  /** trigger price. */
  @JsonProperty("stopPrice")
  private String stopPrice;

  /** The limit order price after take-profit and stop-loss are triggered. */
  @JsonProperty("limitPrice")
  private String limitPrice;

  /** Transaction Type, currently only supports TRADE (spot transactions), the default is TRADE */
  @JsonProperty("tradeType")
  private TradeTypeEnum tradeType;

  public enum SideEnum {
    /** */
    BUY("buy"),
    /** */
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

  public enum TradeTypeEnum {
    /** Spot Trading */
    TRADE("TRADE");

    private final String value;

    TradeTypeEnum(String value) {
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
    public static TradeTypeEnum fromValue(String value) {
      for (TradeTypeEnum b : TradeTypeEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
