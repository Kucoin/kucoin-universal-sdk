package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.WebSocketUnifiedService;
import com.kucoin.universal.sdk.internal.interfaces.WebsocketTransport;
import com.kucoin.universal.sdk.internal.interfaces.WebsocketTransportListener;
import com.kucoin.universal.sdk.model.*;
import java.util.Map;
import java.util.UUID;
import java.util.concurrent.CompletableFuture;
import java.util.concurrent.ConcurrentHashMap;
import java.util.function.Function;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public class DefaultWebSocketUnifiedService
    implements WebSocketUnifiedService, WebsocketTransportListener<UnifiedWsMessage> {

  private final WebSocketClientOption option;
  private final WebsocketTransport client;
  private final ObjectMapper mapper = new ObjectMapper();
  private final Map<String, CompletableFuture<UnifiedWsMessage>> futureMap =
      new ConcurrentHashMap<>();

  public DefaultWebSocketUnifiedService(ClientOption opt, String sdkVersion) {
    if (opt.getUnifiedWsEndpoint() == null || opt.getUnifiedWsEndpoint().isEmpty()) {
      throw new IllegalArgumentException("Missing unified WebSocket endpoint");
    }

    mapper.setSerializationInclusion(JsonInclude.Include.NON_NULL);
    this.option = opt.getWebsocketClientOption();
    this.client =
        new DefaultWebsocketTransport(
            new DefaultWebsocketUnifiedMetaProvider(opt, mapper), option, this);
  }

  @Override
  public void onEvent(WebSocketEvent event, String message) {
    notifyEvent(event, message);
  }

  @Override
  public void onMessage(UnifiedWsMessage wsMessage) {
    CompletableFuture<UnifiedWsMessage> future = futureMap.remove(wsMessage.getId());
    if (future != null) {
      if (future.complete(wsMessage)) {
        log.debug(
            "Unified WebSocket API response received, id={}, op={}",
            wsMessage.getId(),
            wsMessage.getOp());
      } else {
        log.warn("Future for id={} was already completed", wsMessage.getId());
      }
    }
  }

  @Override
  public void onReconnected() {
    // No recovery needed for unified API; subscriptions are managed elsewhere
  }

  @Override
  public void start() {
    client.start();
  }

  @Override
  public void stop() {
    client.stop();
  }

  @Override
  public CompletableFuture<UnifiedWsMessage> call(UnifiedWsArgs args) {
    // Ensure ID exists
    if (args.getId() == null || args.getId().isEmpty()) {
      args.setId(UUID.randomUUID().toString());
    }

    // Ensure operation type is set
    if (args.getOp() == null || args.getOp().isEmpty()) {
      throw new IllegalArgumentException("Missing required field: op");
    }

    CompletableFuture<UnifiedWsMessage> future = new CompletableFuture<>();

    // Check for duplicate ID
    Object previous = futureMap.put(args.getId(), future);
    if (previous != null) {
      throw new IllegalArgumentException("Duplicate request id: " + args.getId());
    }

    log.info("Calling unified WebSocket API, id={}, op={}", args.getId(), args.getOp());

    return client
        .write(args.getId(), args, option.getWriteTimeout())
        .thenApply(
            ignored -> {
              log.info("Unified WebSocket API call sent, id={}, op={}", args.getId(), args.getOp());
              return future;
            })
        .exceptionally(
            ex -> {
              futureMap.remove(args.getId());
              log.error(
                  "Unified WebSocket API call failed, id={}, op={}",
                  args.getId(),
                  args.getOp(),
                  ex);
              future.completeExceptionally(ex);
              return future;
            })
        .thenCompose(Function.identity());
  }

  private void notifyEvent(WebSocketEvent ev, String msg) {
    if (option.getEventCallback() != null) {
      try {
        option.getEventCallback().onEvent(ev, msg);
      } catch (Exception e) {
        log.error("exception when notify event", e);
      }
    }
  }
}
