// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.broker.ndbroker;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetSubAccountItems {
  /** Sub-account name */
  @JsonProperty("accountName")
  private String accountName;

  /** Sub-account UID */
  @JsonProperty("uid")
  private String uid;

  /** Creation time, Unix timestamp (milliseconds) */
  @JsonProperty("createdAt")
  private Long createdAt;

  /** Sub-account VIP level */
  @JsonProperty("level")
  private Integer level;
}
