package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.*;
import com.kucoin.universal.sdk.model.*;
import java.net.URI;
import java.time.Duration;
import java.util.Date;
import java.util.Map;
import java.util.concurrent.*;
import java.util.concurrent.atomic.AtomicBoolean;
import lombok.extern.slf4j.Slf4j;
import okhttp3.*;
import okhttp3.Request;
import okhttp3.Response;

/** OkHttp-based WebSocket transport with */
@Slf4j
public final class DefaultWebsocketTransport implements WebsocketTransport {

  private final WebsocketMetaProvider metaProvider;
  private final WebSocketClientOption opt;
  private final WebsocketTransportListener listener;

  private final OkHttpClient http;
  private final ObjectMapper mapper = new ObjectMapper();
  private final AtomicBoolean connected = new AtomicBoolean(false);
  private final AtomicBoolean shutting = new AtomicBoolean(false);
  private final AtomicBoolean reconnecting = new AtomicBoolean(false);
  private final Map<String, CompletableFuture<Void>> ackMap = new ConcurrentHashMap<>();
  private final ScheduledExecutorService scheduler =
      Executors.newSingleThreadScheduledExecutor(
          r -> {
            Thread t = new Thread(r);
            t.setName("ws-scheduler-single-pool");
            t.setDaemon(true);
            return t;
          });
  private volatile WebSocket socket;

  public DefaultWebsocketTransport(
      WebsocketMetaProvider metaProvider,
      WebSocketClientOption option,
      WebsocketTransportListener listener) {

    this.metaProvider = metaProvider;
    this.opt = option;
    this.listener = listener;
    this.http =
        new OkHttpClient()
            .newBuilder()
            .connectTimeout(option.getDialTimeout())
            .writeTimeout(option.getWriteTimeout())
            .build();
  }

  private static <T> CompletableFuture<T> failed(Throwable ex) {
    CompletableFuture<T> f = new CompletableFuture<>();
    f.completeExceptionally(ex);
    return f;
  }

  @Override
  public void start() {
    dial();
    schedulePing();
  }

  @Override
  public void stop() {
    shutting.set(true);
    safeClose("shutdown");
    http.connectionPool().evictAll();
    http.dispatcher().executorService().shutdown();
    scheduler.shutdownNow();
    metaProvider.close();
    log.info("websocket closed");
    listener.onEvent(WebSocketEvent.CLIENT_SHUTDOWN, "");
  }

  @Override
  public CompletableFuture<Void> write(String id, Object m, Duration timeout) {
    if (!connected.get()) {
      return failed(new IllegalStateException("not connected"));
    }

    CompletableFuture<Void> fut = new CompletableFuture<>();
    ackMap.put(id, fut);

    try {
      boolean queued = socket.send(mapper.writeValueAsString(m));
      if (!queued) {
        throw new IllegalStateException("enqueue message failed");
      }
    } catch (Exception e) {
      ackMap.remove(id);
      return failed(e);
    }

    scheduler.schedule(
        () -> {
          if (ackMap.remove(id) != null) {
            fut.completeExceptionally(new TimeoutException("ack timeout"));
          }
        },
        timeout.toMillis(),
        TimeUnit.MILLISECONDS);

    return fut;
  }

  private void dial() {
    try {
      URI uri = URI.create(metaProvider.buildUri());

      Request req = new Request.Builder().url(uri.toString()).build();

      WebSocketBootstrap webSocketBootstrap =
          new WebSocketBootstrap(metaProvider.handshakes(), this::handle);

      socket =
          http.newWebSocket(
              req,
              new WebSocketListener() {
                @Override
                public void onMessage(WebSocket w, String txt) {
                  webSocketBootstrap.onMessage(w, txt);
                }

                @Override
                public void onClosed(WebSocket w, int c, String r) {
                  tryReconnect(r);
                }

                @Override
                public void onFailure(WebSocket w, Throwable t, Response r) {
                  tryReconnect(t.getMessage());
                }
              });

      webSocketBootstrap
          .getReadyFuture()
          .get(opt.getDialTimeout().toMillis(), TimeUnit.MILLISECONDS);

      connected.set(true);
      listener.onEvent(WebSocketEvent.CONNECTED, "");
      log.info("Websocket connected");
    } catch (Exception e) {
      safeClose("dial-error");
      throw new RuntimeException(e);
    }
  }

  private void handle(String text) {
    try {
      WsParsedMessage parsedMessage = this.metaProvider.parseMessage(text);
      switch (parsedMessage.getType()) {
        case Constants.WS_MESSAGE_TYPE_WELCOME:
          {
            log.info("receive welcome message: {}", parsedMessage.getMessage());
            break;
          }
        case Constants.WS_MESSAGE_TYPE_MESSAGE:
          {
            listener.onMessage(parsedMessage.getMessage());
            if (parsedMessage.isAck()) {
              CompletableFuture<Void> f = ackMap.remove(parsedMessage.getId());
              if (f != null) {
                f.complete(null);
              }
            }
            break;
          }

        case Constants.WS_MESSAGE_TYPE_PONG:
        case Constants.WS_MESSAGE_TYPE_ACK:
        case Constants.WS_MESSAGE_TYPE_ERROR:
          {
            CompletableFuture<Void> f = ackMap.remove(parsedMessage.getId());
            if (f == null) {
              break;
            }
            if (parsedMessage.getType().equalsIgnoreCase(Constants.WS_MESSAGE_TYPE_ERROR)) {
              f.completeExceptionally(
                  new RuntimeException(String.valueOf(parsedMessage.getMessage())));
            } else {
              f.complete(null);
            }
            break;
          }
        default:
          {
            log.warn("unknown ws type {}", parsedMessage.getType());
          }
      }
    } catch (Exception e) {
      log.error("decode err", e);
    }
  }

  private void schedulePing() {
    long interval = metaProvider.pingInterval();
    long timeout = metaProvider.pingTimeout();
    scheduler.scheduleAtFixedRate(
        () -> {
          if (!connected.get()) {
            return;
          }
          Map.Entry<String, Object> ping = metaProvider.pingMessage();
          write(ping.getKey(), ping.getValue(), Duration.ofMillis(timeout))
              .thenRun(
                  () -> {
                    log.debug("ping success");
                  })
              .exceptionally(
                  ex -> {
                    log.error("Schedule ping error", ex);
                    return null;
                  });
        },
        interval,
        interval,
        TimeUnit.MILLISECONDS);
  }

  private void tryReconnect(String reason) {
    if (shutting.get()) {
      return;
    }
    log.error("Websocket disconnected due to {}, Reconnection...", reason);

    if (!opt.isReconnect()) {
      log.warn("Reconnect failed: auto-reconnect is disabled");
      return;
    }

    if (!reconnecting.compareAndSet(false, true)) {
      log.warn("Another thread is reconnecting, skip current attempt");
      return;
    }

    safeClose("reconnect");

    Thread reconnectThread =
        new Thread(
            () -> {
              int attempt = 0;

              try {
                while (true) {
                  if (shutting.get()) {
                    log.info("Reconnect failed: client is shutting down");
                    return;
                  }
                  if (opt.getReconnectAttempts() != -1 && attempt >= opt.getReconnectAttempts()) {
                    log.info("Reconnect failed: maximum number of attempts exceeded");
                    listener.onEvent(WebSocketEvent.CLIENT_FAIL, "");
                    return;
                  }

                  try {
                    listener.onEvent(WebSocketEvent.TRY_RECONNECT, "attempt " + attempt);
                    dial();
                    listener.onEvent(WebSocketEvent.CONNECTED, "");
                    listener.onReconnected();
                    log.info("Reconnect successful");
                    return;
                  } catch (Exception ex) {
                    attempt++;
                    log.info(
                        "Reconnect failed, retry:{}, max:{}, reason:{}",
                        attempt,
                        opt.getReconnectAttempts(),
                        ex.getMessage());
                    try {
                      Thread.sleep(opt.getReconnectInterval().toMillis());
                    } catch (InterruptedException e) {
                      Thread.currentThread().interrupt();
                      return;
                    }
                  }
                }
              } finally {
                reconnecting.set(false);
              }
            });
    reconnectThread.setName(String.format("Reconnect-Thread-%s", new Date()));
    reconnectThread.setDaemon(true);
    reconnectThread.start();
  }

  private void safeClose(String reason) {
    try {
      log.info("Safe close resource for reason: {}", reason);
      listener.onEvent(WebSocketEvent.DISCONNECTED, "");
      ackMap
          .values()
          .forEach(f -> f.completeExceptionally(new RuntimeException("connection closed")));
      ackMap.clear();
      connected.set(false);
      if (socket != null) {
        socket.close(1000, reason);
        socket.cancel();
        socket = null;
      }
    } catch (Exception e) {
      log.error("exception when safe close", e);
    }
  }
}
