// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.positions;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonValue;
import com.kucoin.universal.sdk.internal.interfaces.Request;
import java.util.ArrayList;
import java.util.List;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Builder
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class BatchSwitchMarginModeReq implements Request {
  /** Modified margin model: ISOLATED (isolated), CROSS (cross margin). */
  @JsonProperty("marginMode")
  private MarginModeEnum marginMode;

  /**
   * Symbol list of the contract, Please refer to [Get Symbol endpoint:
   * symbol](https://www.kucoin.com/docs-new/api-3470220)
   */
  @JsonProperty("symbols")
  @Builder.Default
  private List<String> symbols = new ArrayList<>();

  public enum MarginModeEnum {
    /** Isolated Margin Mode */
    ISOLATED("ISOLATED"),
    /** Cross Margin MOde */
    CROSS("CROSS");

    private final String value;

    MarginModeEnum(String value) {
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
    public static MarginModeEnum fromValue(String value) {
      for (MarginModeEnum b : MarginModeEnum.values()) {
        if (b.value.equals(value)) {
          return b;
        }
      }
      throw new IllegalArgumentException("Unexpected value '" + value + "'");
    }
  }
}
