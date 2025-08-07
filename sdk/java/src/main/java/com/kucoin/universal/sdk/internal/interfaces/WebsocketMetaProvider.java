package com.kucoin.universal.sdk.internal.interfaces;

import java.util.List;
import java.util.Map;

/**
 * Interface providing the necessary methods for managing WebSocket connections, including
 * handshakes, URI construction, and ping settings.
 */
public interface WebsocketMetaProvider {

  /**
   * Retrieves a list of WebSocket handshakes that are used to establish and manage WebSocket
   * connections.
   */
  List<WebsocketHandshake> handshakes();

  /**
   * Parses an incoming WebSocket message and returns a pair containing the type of the message and
   * the parsed message object.
   */
  WsParsedMessage parseMessage(String text) throws Exception;

  /** Constructs and returns the URI for establishing a WebSocket connection. */
  String buildUri();

  /** Returns the recommended ping interval in milliseconds for the WebSocket connection. */
  long pingInterval();

  /** Returns the timeout in milliseconds for a ping to be considered as failed. */
  long pingTimeout();

  /** Retrieves the message to be used for pinging the WebSocket server. */
  Map.Entry<String, Object> pingMessage();

  /** Closes the WebSocket meta provider, releasing any resources held by it. */
  void close();
}
