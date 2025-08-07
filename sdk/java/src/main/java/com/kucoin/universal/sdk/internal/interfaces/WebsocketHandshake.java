package com.kucoin.universal.sdk.internal.interfaces;

import okhttp3.WebSocket;

/** Interface defining the contract for a WebSocket handshake process. */
public interface WebsocketHandshake {
  /** Invokes a specific action with the given text and WebSocket instance. */
  void invoke(WebSocket socket, String text) throws Exception;
}
