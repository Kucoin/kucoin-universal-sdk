// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.account.subaccount;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
import java.util.ArrayList;
import java.util.List;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetSpotSubAccountsSummaryV2Items {
  /** Sub-account User ID */
  @JsonProperty("userId")
  private String userId;

  /** Sub-account UID */
  @JsonProperty("uid")
  private Integer uid;

  /** Sub-account name */
  @JsonProperty("subName")
  private String subName;

  /** Sub-account; 2:Enable, 3:Frozen */
  @JsonProperty("status")
  private StatusEnum status;

  /** Sub-account type */
  @JsonProperty("type")
  private TypeEnum type;

  /** Sub-account Permission */
  @JsonProperty("access")
  private String access;

  /** Time of event */
  @JsonProperty("createdAt")
  private Long createdAt;

  /** Remarks */
  @JsonProperty("remarks")
  private String remarks;

  /** Sub-account Permissions */
  @JsonProperty("tradeTypes")
  private List<String> tradeTypes = new ArrayList<>();

  /**
   * Sub-account active permissions: If you do not have the corresponding permissions, you must log
   * in to the sub-account and go to the corresponding web page to activate.
   */
  @JsonProperty("openedTradeTypes")
  private List<String> openedTradeTypes = new ArrayList<>();

  /** */
  @JsonProperty("hostedStatus")
  private String hostedStatus;

  public enum StatusEnum {
    /** Enable */
    _2(2),
    /** Frozen */
    _3(3);

    private final Integer value;

    StatusEnum(Integer value) {
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
    public static StatusEnum fromValue(Integer value) {
      for (StatusEnum b : StatusEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }

  public enum TypeEnum {
    /** Normal sub-account */
    NORMAL(0),
    /** Robot sub-account */
    ROBOT(1),
    /** New financial sub-account */
    NOVICE(2),
    /** Asset management sub-account */
    HOSTED(5);

    private final Integer value;

    TypeEnum(Integer value) {
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
    public static TypeEnum fromValue(Integer value) {
      for (TypeEnum b : TypeEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
