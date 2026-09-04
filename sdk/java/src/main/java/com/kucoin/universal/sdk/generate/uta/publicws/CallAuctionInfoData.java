// Code generated from the UTA Public WebSocket Call Auction schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import java.math.BigDecimal;
import lombok.Data;

/** Call-auction estimates and bid/ask price ranges for a Spot symbol. */
@Data
@JsonIgnoreProperties(ignoreUnknown = true)
public class CallAuctionInfoData {
  @JsonProperty("s")
  private String symbol;

  /** Lowest sell price in the current auction range. */
  @JsonProperty("slp")
  private BigDecimal sellLowPrice;

  /** Lowest buy price in the current auction range. */
  @JsonProperty("blp")
  private BigDecimal buyLowPrice;

  /** Highest sell price in the current auction range. */
  @JsonProperty("shp")
  private BigDecimal sellHighPrice;

  /** Highest buy price in the current auction range. */
  @JsonProperty("bhp")
  private BigDecimal buyHighPrice;

  /** Estimated transaction price. */
  @JsonProperty("eq")
  private BigDecimal estimatedPrice;

  /** Estimated transaction quantity. */
  @JsonProperty("es")
  private BigDecimal estimatedSize;

  @JsonProperty("ts")
  private Long timestamp;
}
