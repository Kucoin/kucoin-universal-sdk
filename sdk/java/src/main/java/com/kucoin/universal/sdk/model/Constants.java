package com.kucoin.universal.sdk.model;

/**
 * Contains API endpoints and enum-like constants for domain types, result codes, and WS message
 * types.
 */
public final class Constants {

  private Constants() {
    // Prevent instantiation
  }

  // ==== Global API Endpoints ====
  public static final String GLOBAL_API_ENDPOINT = "https://api.kucoin.com";
  public static final String GLOBAL_FUTURES_API_ENDPOINT = "https://api-futures.kucoin.com";
  public static final String GLOBAL_BROKER_API_ENDPOINT = "https://api-broker.kucoin.com";
  public static final String GLOBAL_UNIFIED_WS_API_ENDPOINT = "wss://wsapi.kucoin.com";

  // ==== Domain Types ====
  public static final String DOMAIN_TYPE_SPOT = "spot";
  public static final String DOMAIN_TYPE_FUTURES = "futures";
  public static final String DOMAIN_TYPE_BROKER = "broker";

  // ==== REST Result Codes ====
  public static final String RESULT_CODE_SUCCESS = "200000";

  // ==== WebSocket Message Types ====
  public static final String WS_MESSAGE_TYPE_WELCOME = "welcome";
  public static final String WS_MESSAGE_TYPE_PING = "ping";
  public static final String WS_MESSAGE_TYPE_PONG = "pong";
  public static final String WS_MESSAGE_TYPE_SUBSCRIBE = "subscribe";
  public static final String WS_MESSAGE_TYPE_ACK = "ack";
  public static final String WS_MESSAGE_TYPE_UNSUBSCRIBE = "unsubscribe";
  public static final String WS_MESSAGE_TYPE_ERROR = "error";
  public static final String WS_MESSAGE_TYPE_MESSAGE = "message";
  public static final String WS_MESSAGE_TYPE_NOTICE = "notice";
  public static final String WS_MESSAGE_TYPE_COMMAND = "command";
}
