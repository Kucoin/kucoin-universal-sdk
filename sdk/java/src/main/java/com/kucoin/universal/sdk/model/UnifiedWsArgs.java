package com.kucoin.universal.sdk.model;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import java.util.HashMap;
import java.util.Map;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class UnifiedWsArgs {
  /**
   * User-defined ID (not orderid) is used to uniquely represent a request. The server will also
   * return this ID when returning.
   */
  @JsonProperty("id")
  private String id;

  /**
   * Command options The \"op\" parameter is one of the following enum values.
   *
   * <ul>
   *   <li>spot.order
   *   <li>margin.order
   *   <li>futures.order
   *   <li>spot.cancel
   *   <li>margin.cancel
   *   <li>futures.cancel
   *   <li>futures.multi_cancel
   *   <li>futures.multi_order
   *   <li>spot.sync_order
   *   <li>spot.modify
   *   <li>spot.sync_cancel
   * </ul>
   *
   * @see <a href="https://www.kucoin.com/docs-new/3470133w0">docs</a>
   */
  @JsonProperty("op")
  private String op;

  /** Business parameters, same as RestAPI */
  @JsonProperty("args")
  private Map<String, Object> args = new HashMap<>();
}
