// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.margin.credit;

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
public class GetPurchaseOrdersItems {
  /** Currency */
  @JsonProperty("currency")
  private String currency;

  /** Purchase order ID */
  @JsonProperty("purchaseOrderNo")
  private String purchaseOrderNo;

  /** Total purchase size */
  @JsonProperty("purchaseSize")
  private String purchaseSize;

  /** Executed size */
  @JsonProperty("matchSize")
  private String matchSize;

  /** Target annualized interest rate */
  @JsonProperty("interestRate")
  private String interestRate;

  /** Redeemed amount */
  @JsonProperty("incomeSize")
  private String incomeSize;

  /** Time of purchase */
  @JsonProperty("applyTime")
  private Long applyTime;

  /** Status: DONE-completed; PENDING-settling */
  @JsonProperty("status")
  private StatusEnum status;

  public enum StatusEnum {
    /** */
    DONE("DONE"),
    /** */
    PENDING("PENDING");

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
}
