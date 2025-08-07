package com.kucoin.universal.sdk.internal.infra;

import com.kucoin.universal.sdk.internal.interfaces.WebsocketHandshake;
import java.util.Iterator;
import java.util.List;
import java.util.concurrent.CompletableFuture;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.function.Consumer;
import lombok.Getter;
import lombok.extern.slf4j.Slf4j;
import okhttp3.WebSocket;

/**
 * WebSocketBootstrap is a utility class designed to facilitate the setup and management of
 * WebSocket connections, particularly focusing on the handshake process and message handling. It
 * ensures that the connection is only considered ready after all handshakes are completed
 * successfully.
 */
@Slf4j
public class WebSocketBootstrap {
  @Getter private final CompletableFuture<Void> readyFuture = new CompletableFuture<>();
  private final Consumer<String> messageHandler;
  private final AtomicBoolean connected = new AtomicBoolean(false);
  private Iterator<WebsocketHandshake> handshakes;

  public WebSocketBootstrap(List<WebsocketHandshake> handshakes, Consumer<String> messageHandler) {
    this.handshakes = handshakes.iterator();
    this.messageHandler = messageHandler;
  }

  public void onMessage(WebSocket w, String txt) {
    if (connected.get()) {
      messageHandler.accept(txt);
      return;
    }

    try {
      if (handshakes.hasNext()) {
        WebsocketHandshake currentHandshake = handshakes.next();
        currentHandshake.invoke(w, txt);

        if (!handshakes.hasNext()) {
          if (connected.compareAndSet(false, true)) {
            log.info("websocket handshake done");
            readyFuture.complete(null);
          }
        }
      }
    } catch (Exception e) {
      log.error("Error in WebSocketBootstrap", e);
      readyFuture.completeExceptionally(e);
    }
  }
}
