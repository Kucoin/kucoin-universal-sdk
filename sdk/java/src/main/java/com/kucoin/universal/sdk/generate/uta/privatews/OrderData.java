// Code generated from the UTA Private WebSocket Order schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;

/** Details of a unified-account order lifecycle change. Decimal values and identifiers are strings. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class OrderData {
  @JsonProperty("tT") private String tradeType;
  @JsonProperty("oi") private String orderId;
  @JsonProperty("ci") private String clientOid;
  @JsonProperty("os") private Integer orderStatus;
  @JsonProperty("eT") private String eventType;
  @JsonProperty("s") private String symbol;
  @JsonProperty("S") private String side;
  @JsonProperty("oT") private String orderType;
  @JsonProperty("lR") private String liquidityRole;
  @JsonProperty("oS") private String orderSource;
  @JsonProperty("p") private String price;
  @JsonProperty("mM") private String marginMode;
  @JsonProperty("ti") private String tradeId;
  @JsonProperty("q") private String quantity;
  @JsonProperty("qU") private String quantityUnit;
  @JsonProperty("fS") private String filledSize;
  @JsonProperty("lS") private String lastFilledSize;
  @JsonProperty("ls") private String lastFilledValue;
  @JsonProperty("aP") private String averagePrice;
  @JsonProperty("f") private String fee;
  @JsonProperty("fC") private String feeCurrency;
  @JsonProperty("t") private String orderTag;
  @JsonProperty("cR") private String cancelReason;
  @JsonProperty("cS") private String cancelStatus;
  @JsonProperty("rS") private String remainingSize;
  @JsonProperty("tD") private String triggerDirection;
  @JsonProperty("tP") private String triggerPrice;
  @JsonProperty("tPT") private String triggerPriceType;
  @JsonProperty("pP") private String takeProfitPrice;
  @JsonProperty("pPT") private String takeProfitPriceType;
  @JsonProperty("lP") private String stopLossPrice;
  @JsonProperty("lPT") private String stopLossPriceType;
  @JsonProperty("toi") private String triggerOrderId;
  @JsonProperty("stp") private String selfTradePrevention;
  @JsonProperty("rO") private Boolean reduceOnly;
  @JsonProperty("tIF") private String timeInForce;
  @JsonProperty("pO") private Boolean postOnly;
  @JsonProperty("O") private Long createdAt;
  @JsonProperty("U") private Long updatedAt;
}
