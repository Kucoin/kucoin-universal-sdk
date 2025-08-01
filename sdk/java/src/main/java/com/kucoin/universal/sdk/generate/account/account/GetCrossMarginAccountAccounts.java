// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.account;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetCrossMarginAccountAccounts {
  /** currency */
  @JsonProperty("currency")
  private String currency;

  /** Total Assets */
  @JsonProperty("total")
  private String total;

  /** Account available assets (total assets - frozen) */
  @JsonProperty("available")
  private String available;

  /** Account frozen assets */
  @JsonProperty("hold")
  private String hold;

  /** Liabilities */
  @JsonProperty("liability")
  private String liability;

  /** The user's remaining maximum loan amount */
  @JsonProperty("maxBorrowSize")
  private String maxBorrowSize;

  /** Support borrow or not */
  @JsonProperty("borrowEnabled")
  private Boolean borrowEnabled;

  /** Support transfer or not */
  @JsonProperty("transferInEnabled")
  private Boolean transferInEnabled;

  /** Outstanding principal – the unpaid loan amount */
  @JsonProperty("liabilityPrincipal")
  private String liabilityPrincipal;

  /** Accrued interest – the unpaid interest amount */
  @JsonProperty("liabilityInterest")
  private String liabilityInterest;
}
