// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.order;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetTradeHistoryOldItems {
  /** symbol */
  @JsonProperty("symbol")
  private String symbol;

  /** */
  @JsonProperty("tradeId")
  private String tradeId;

  /** The unique order id generated by the trading system */
  @JsonProperty("orderId")
  private String orderId;

  /** Counterparty order ID */
  @JsonProperty("counterOrderId")
  private String counterOrderId;

  /** Buy or sell */
  @JsonProperty("side")
  private String side;

  /** Liquidity type: taker or maker */
  @JsonProperty("liquidity")
  private String liquidity;

  /** */
  @JsonProperty("forceTaker")
  private Boolean forceTaker;

  /** Order Price */
  @JsonProperty("price")
  private String price;

  /** Order Size */
  @JsonProperty("size")
  private String size;

  /** Order Funds */
  @JsonProperty("funds")
  private String funds;

  /** [Handling fees](https://www.kucoin.com/docs-new/api-5327739) */
  @JsonProperty("fee")
  private String fee;

  /** Fee rate */
  @JsonProperty("feeRate")
  private String feeRate;

  /** Currency used to calculate trading fee */
  @JsonProperty("feeCurrency")
  private String feeCurrency;

  /**
   * Take Profit and Stop Loss type, currently HFT does not support the Take Profit and Stop Loss
   * type, so it is empty
   */
  @JsonProperty("stop")
  private String stop;

  /** Trade type, redundancy param */
  @JsonProperty("tradeType")
  private String tradeType;

  /** Specify if the order is a 'limit' order or 'market' order. */
  @JsonProperty("type")
  private String type;

  /** */
  @JsonProperty("createdAt")
  private Long createdAt;
}
