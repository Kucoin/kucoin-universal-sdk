// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.earn.earn;

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
public class GetAccountHoldingItems {
  /** Holding ID */
  @JsonProperty("orderId")
  private String orderId;

  /** Product ID */
  @JsonProperty("productId")
  private String productId;

  /** Product category */
  @JsonProperty("productCategory")
  private String productCategory;

  /** Product sub-type */
  @JsonProperty("productType")
  private String productType;

  /** currency */
  @JsonProperty("currency")
  private String currency;

  /** Income currency */
  @JsonProperty("incomeCurrency")
  private String incomeCurrency;

  /** Annualized Rate of Return, for example, 0.035 is equal to 3.5% annualized rate of return */
  @JsonProperty("returnRate")
  private String returnRate;

  /** Holding amount */
  @JsonProperty("holdAmount")
  private String holdAmount;

  /** Redeemed amount */
  @JsonProperty("redeemedAmount")
  private String redeemedAmount;

  /** Redeeming amount */
  @JsonProperty("redeemingAmount")
  private String redeemingAmount;

  /** Product earliest interest start time, in milliseconds */
  @JsonProperty("lockStartTime")
  private Long lockStartTime;

  /** Product maturity time, in milliseconds */
  @JsonProperty("lockEndTime")
  private Long lockEndTime;

  /** Most recent subscription time, in milliseconds */
  @JsonProperty("purchaseTime")
  private Long purchaseTime;

  /** Redemption waiting period (days) */
  @JsonProperty("redeemPeriod")
  private Integer redeemPeriod;

  /** Status: LOCKED (holding), REDEEMING (redeeming) */
  @JsonProperty("status")
  private StatusEnum status;

  /** Whether the fixed product supports early redemption: 0 (no), 1 (yes) */
  @JsonProperty("earlyRedeemSupported")
  private EarlyRedeemSupportedEnum earlyRedeemSupported;

  public enum StatusEnum {
    /** */
    LOCKED("LOCKED"),
    /** */
    REDEEMING("REDEEMING");

    private final String value;

    StatusEnum(String value) {
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
    public static StatusEnum fromValue(String value) {
      for (StatusEnum b : StatusEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }

  public enum EarlyRedeemSupportedEnum {
    /** */
    _0(0),
    /** */
    _1(1);

    private final Integer value;

    EarlyRedeemSupportedEnum(Integer value) {
      this.value = value;
    }

    @JsonValue
    public Integer getValue() {
      return value;
    }

    @Override
    public String toString() {
      return String.valueOf(value);
    }

    @JsonCreator
    public static EarlyRedeemSupportedEnum fromValue(Integer value) {
      for (EarlyRedeemSupportedEnum b : EarlyRedeemSupportedEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
