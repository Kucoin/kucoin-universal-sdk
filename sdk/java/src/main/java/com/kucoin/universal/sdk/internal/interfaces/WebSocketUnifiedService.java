package com.kucoin.universal.sdk.internal.interfaces;

import com.kucoin.universal.sdk.model.UnifiedWsArgs;
import com.kucoin.universal.sdk.model.UnifiedWsMessage;
import java.util.concurrent.CompletableFuture;

public interface WebSocketUnifiedService {

  /** Starts the WebSocket service and handles incoming messages. */
  void start();

  /** Stops the WebSocket service. */
  void stop();

  /** send to message */
  CompletableFuture<UnifiedWsMessage> call(UnifiedWsArgs args);
}
