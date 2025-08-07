package com.kucoin.universal.sdk.model;

import lombok.Builder;
import lombok.Getter;
import lombok.ToString;

/**
 * ClientOption holds the configuration details for a client, including authentication keys, API
 * endpoints, and transport options.
 */
@ToString
@Getter
@Builder(builderClassName = "Builder")
public class ClientOption {

  /* ---------- required auth ---------- */
  private final String key;
  private final String secret;
  private final String passphrase;

  /* ---------- optional broker ---------- */
  private final String brokerName;
  private final String brokerPartner;
  private final String brokerKey;

  /* ---------- endpoints ---------- */
  private final String spotEndpoint;
  private final String futuresEndpoint;
  private final String brokerEndpoint;
  private final String unifiedWsEndpoint;

  /* ---------- transport tuning ---------- */
  private final TransportOption transportOption;
  private final WebSocketClientOption websocketClientOption;
}
