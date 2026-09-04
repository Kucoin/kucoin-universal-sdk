package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.generate.uta.privatews.ExecutionEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.ExecutionLiteEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.ExecutionLiteTradeType;
import com.kucoin.universal.sdk.generate.uta.privatews.BalanceAccountType;
import com.kucoin.universal.sdk.generate.uta.privatews.BalanceEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.OrderEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.PositionEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.LeverageEvent;
import com.kucoin.universal.sdk.generate.uta.privatews.LiquidationWarningEvent;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import com.kucoin.universal.sdk.model.WebSocketEvent;
import java.util.Map;
import java.util.UUID;
import java.util.concurrent.CompletableFuture;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.CountDownLatch;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.ScheduledFuture;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.TimeoutException;
import java.util.concurrent.atomic.AtomicBoolean;
import lombok.extern.slf4j.Slf4j;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import okhttp3.WebSocket;
import okhttp3.WebSocketListener;
import okio.ByteString;

/** Transport for the authenticated UTA private push protocol. */
@Slf4j
public final class PrivatePushWsService {
  /** UTA private push endpoint; this is distinct from the WebSocket trading endpoint. */
  private static final String ENDPOINT = "wss://wsapi-push.kucoin.com";
  private static final String AUTH_SIGN_PLAINTEXT = "POST/api/websocket/users/verify";
  private static final String CHANNEL_EXECUTION = "execution";
  private static final String CHANNEL_EXECUTION_LITE = "execution.lite";
  private static final String CHANNEL_ORDER = "order";
  private static final String CHANNEL_ORDER_ALL = "orderAll";
  private static final String CHANNEL_BALANCE = "balance";
  private static final String CHANNEL_POSITION = "position";
  private static final String CHANNEL_POSITION_ALL = "positionAll";
  private static final String CHANNEL_LEVERAGE = "leverage";
  private static final String CHANNEL_LIQUIDATION_WARNING = "lw";
  private static final String TRADE_TYPE_UNIFIED = "UNIFIED";
  private static final long DEFAULT_PING_INTERVAL_MS = 18_000L;
  private static final long DEFAULT_PING_TIMEOUT_MS = 10_000L;

  private final ObjectMapper mapper = new ObjectMapper();
  private final ClientOption clientOption;
  private final WebSocketClientOption option;
  private final KcSigner signer;
  private volatile OkHttpClient http;
  private volatile ScheduledExecutorService scheduler;
  private final Map<String, ExecutionEvent.Callback> executionSubscriptions =
      new ConcurrentHashMap<>();
  private final Map<String, ExecutionLiteSubscription> executionLiteSubscriptions =
      new ConcurrentHashMap<>();
  private final Map<String, OrderSubscription> orderSubscriptions = new ConcurrentHashMap<>();
  private final Map<String, BalanceSubscription> balanceSubscriptions = new ConcurrentHashMap<>();
  private final Map<String, PositionSubscription> positionSubscriptions = new ConcurrentHashMap<>();
  private final Map<String, LeverageEvent.Callback> leverageSubscriptions =
      new ConcurrentHashMap<>();
  private final Map<String, LiquidationWarningEvent.Callback> liquidationWarningSubscriptions =
      new ConcurrentHashMap<>();
  private final Map<String, CompletableFuture<Void>> acknowledgements = new ConcurrentHashMap<>();
  private final AtomicBoolean connected = new AtomicBoolean(false);
  private final AtomicBoolean started = new AtomicBoolean(false);
  private final AtomicBoolean shuttingDown = new AtomicBoolean(false);
  private final AtomicBoolean reconnecting = new AtomicBoolean(false);

  private volatile WebSocket socket;
  private volatile CountDownLatch welcome;
  private volatile RuntimeException dialFailure;
  private volatile long pingIntervalMs = DEFAULT_PING_INTERVAL_MS;
  private volatile long pingTimeoutMs = DEFAULT_PING_TIMEOUT_MS;
  private volatile String pendingPingId;
  private volatile ScheduledFuture<?> pingTask;

  public PrivatePushWsService(ClientOption clientOption) {
    this.clientOption = clientOption;
    this.option =
        clientOption.getWebsocketClientOption() == null
            ? WebSocketClientOption.defaults()
            : clientOption.getWebsocketClientOption();
    validateCredentials(clientOption);
    this.signer =
        new KcSigner(
            clientOption.getKey(),
            clientOption.getSecret(),
            clientOption.getPassphrase(),
            clientOption.getBrokerName(),
            clientOption.getBrokerPartner(),
            clientOption.getBrokerKey());
    this.http = newHttpClient();
    this.scheduler = newScheduler();
  }

  public void start() {
    if (!started.compareAndSet(false, true)) {
      return;
    }
    shuttingDown.set(false);
    ensureResources();
    try {
      dial();
    } catch (RuntimeException e) {
      started.set(false);
      throw e;
    }
  }

  public void stop() {
    if (!started.getAndSet(false)) {
      return;
    }
    shuttingDown.set(true);
    closeSocket("shutdown");
    ScheduledExecutorService currentScheduler = scheduler;
    currentScheduler.shutdownNow();
    OkHttpClient currentHttp = http;
    currentHttp.connectionPool().evictAll();
    currentHttp.dispatcher().executorService().shutdown();
    notifyEvent(WebSocketEvent.CLIENT_SHUTDOWN, "");
  }

  public String subscribeExecution(ExecutionEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    executionSubscriptions.put(id, callback);
    try {
      sendSubscription(id, "subscribe", CHANNEL_EXECUTION, TRADE_TYPE_UNIFIED);
      return id;
    } catch (RuntimeException e) {
      executionSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribeExecutionLite(
      ExecutionLiteTradeType tradeType, ExecutionLiteEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (tradeType == null) {
      throw new IllegalArgumentException("tradeType must not be null");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    executionLiteSubscriptions.put(id, new ExecutionLiteSubscription(tradeType, callback));
    try {
      sendSubscription(id, "subscribe", CHANNEL_EXECUTION_LITE, tradeType.name());
      return id;
    } catch (RuntimeException e) {
      executionLiteSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribeOrderAll(OrderEvent.Callback callback) {
    return subscribeOrder(CHANNEL_ORDER_ALL, null, callback);
  }

  public String subscribeOrder(String symbol, OrderEvent.Callback callback) {
    if (isBlank(symbol)) {
      throw new IllegalArgumentException("symbol must not be blank");
    }
    return subscribeOrder(CHANNEL_ORDER, symbol.trim(), callback);
  }

  private String subscribeOrder(String channel, String symbol, OrderEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    orderSubscriptions.put(id, new OrderSubscription(channel, symbol, callback));
    try {
      sendSubscription(id, "subscribe", channel, TRADE_TYPE_UNIFIED, symbol);
      return id;
    } catch (RuntimeException e) {
      orderSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribeBalance(BalanceAccountType accountType, BalanceEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (accountType == null) {
      throw new IllegalArgumentException("accountType must not be null");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    balanceSubscriptions.put(id, new BalanceSubscription(accountType, callback));
    try {
      sendBalanceSubscription(id, "subscribe", accountType);
      return id;
    } catch (RuntimeException e) {
      balanceSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribePositionAll(PositionEvent.Callback callback) {
    return subscribePosition(CHANNEL_POSITION_ALL, null, callback);
  }

  public String subscribePosition(String symbol, PositionEvent.Callback callback) {
    if (isBlank(symbol)) {
      throw new IllegalArgumentException("symbol must not be blank");
    }
    return subscribePosition(CHANNEL_POSITION, symbol.trim(), callback);
  }

  private String subscribePosition(String channel, String symbol, PositionEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    positionSubscriptions.put(id, new PositionSubscription(channel, symbol, callback));
    try {
      sendSubscription(id, "subscribe", channel, TRADE_TYPE_UNIFIED, symbol);
      return id;
    } catch (RuntimeException e) {
      positionSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribeLeverage(LeverageEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    leverageSubscriptions.put(id, callback);
    try {
      sendSubscription(id, "subscribe", CHANNEL_LEVERAGE, TRADE_TYPE_UNIFIED);
      return id;
    } catch (RuntimeException e) {
      leverageSubscriptions.remove(id);
      throw e;
    }
  }

  public String subscribeLiquidationWarning(LiquidationWarningEvent.Callback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private WebSocket is not connected; call start() first");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }

    String id = UUID.randomUUID().toString();
    liquidationWarningSubscriptions.put(id, callback);
    try {
      sendSubscription(id, "subscribe", CHANNEL_LIQUIDATION_WARNING, TRADE_TYPE_UNIFIED);
      return id;
    } catch (RuntimeException e) {
      liquidationWarningSubscriptions.remove(id);
      throw e;
    }
  }

  public void unsubscribe(String id) {
    if (executionSubscriptions.containsKey(id)) {
      sendSubscription(id, "unsubscribe", CHANNEL_EXECUTION, TRADE_TYPE_UNIFIED);
      executionSubscriptions.remove(id);
      return;
    }

    ExecutionLiteSubscription liteSubscription = executionLiteSubscriptions.get(id);
    if (liteSubscription != null) {
      sendSubscription(id, "unsubscribe", CHANNEL_EXECUTION_LITE, liteSubscription.tradeType.name());
      executionLiteSubscriptions.remove(id);
      return;
    }

    OrderSubscription orderSubscription = orderSubscriptions.get(id);
    if (orderSubscription != null) {
      sendSubscription(
          id,
          "unsubscribe",
          orderSubscription.channel,
          TRADE_TYPE_UNIFIED,
          orderSubscription.symbol);
      orderSubscriptions.remove(id);
      return;
    }

    BalanceSubscription balanceSubscription = balanceSubscriptions.get(id);
    if (balanceSubscription != null) {
      sendBalanceSubscription(id, "unsubscribe", balanceSubscription.accountType);
      balanceSubscriptions.remove(id);
      return;
    }

    PositionSubscription positionSubscription = positionSubscriptions.get(id);
    if (positionSubscription != null) {
      sendSubscription(
          id,
          "unsubscribe",
          positionSubscription.channel,
          TRADE_TYPE_UNIFIED,
          positionSubscription.symbol);
      positionSubscriptions.remove(id);
      return;
    }

    if (leverageSubscriptions.containsKey(id)) {
      sendSubscription(id, "unsubscribe", CHANNEL_LEVERAGE, TRADE_TYPE_UNIFIED);
      leverageSubscriptions.remove(id);
      return;
    }

    if (liquidationWarningSubscriptions.containsKey(id)) {
      sendSubscription(id, "unsubscribe", CHANNEL_LIQUIDATION_WARNING, TRADE_TYPE_UNIFIED);
      liquidationWarningSubscriptions.remove(id);
    }
  }

  private void dial() {
    welcome = new CountDownLatch(1);
    dialFailure = null;
    Request request = new Request.Builder().url(ENDPOINT).build();
    socket =
        http.newWebSocket(
            request,
            new WebSocketListener() {
              @Override
              public void onMessage(WebSocket webSocket, String text) {
                handle(text);
              }

              @Override
              public void onMessage(WebSocket webSocket, ByteString bytes) {
                handle(bytes.utf8());
              }

              @Override
              public void onClosed(WebSocket webSocket, int code, String reason) {
                String message = "closed " + code + ": " + reason;
                if (!connected.get()) {
                  failDial(new IllegalStateException(message));
                } else {
                  onDisconnected(message);
                }
              }

              @Override
              public void onFailure(WebSocket webSocket, Throwable throwable, Response response) {
                if (!connected.get()) {
                  failDial(new IllegalStateException("WebSocket connection failed", throwable));
                } else {
                  onDisconnected(throwable.getMessage());
                }
              }
            });

    try {
      if (!welcome.await(option.getDialTimeout().toMillis(), TimeUnit.MILLISECONDS)) {
        throw new IllegalStateException("welcome not received before dial timeout");
      }
      if (dialFailure != null) {
        throw dialFailure;
      }
      authenticate();
      connected.set(true);
      notifyEvent(WebSocketEvent.CONNECTED, "UTA_PRIVATE");
      schedulePing();
    } catch (InterruptedException e) {
      Thread.currentThread().interrupt();
      throw new IllegalStateException("interrupted while waiting for WebSocket welcome", e);
    } catch (RuntimeException e) {
      closeSocket("dial-error");
      throw e;
    }
  }

  private void authenticate() {
    Map<String, String> headers = signer.headers(AUTH_SIGN_PLAINTEXT);
    Map<String, Object> request = new java.util.LinkedHashMap<>();
    request.put("id", UUID.randomUUID().toString());
    request.put("op", "auth");
    request.put("kc-api-key", headers.get("KC-API-KEY"));
    request.put("kc-api-sign", headers.get("KC-API-SIGN"));
    request.put("kc-api-timestamp", headers.get("KC-API-TIMESTAMP"));
    request.put("kc-api-passphrase", headers.get("KC-API-PASSPHRASE"));
    sendAndAwaitAck((String) request.get("id"), request, "authentication");
  }

  private void sendSubscription(String id, String action, String channel, String tradeType) {
    sendSubscription(id, action, channel, tradeType, null);
  }

  private void sendSubscription(
      String id, String action, String channel, String tradeType, String symbol) {
    Map<String, Object> request = new java.util.LinkedHashMap<>();
    request.put("id", id);
    request.put("action", action);
    request.put("channel", channel);
    request.put("tradeType", tradeType);
    if (symbol != null) {
      request.put("symbol", symbol);
    }
    sendAndAwaitAck(id, request, action + " " + channel);
  }

  private void sendBalanceSubscription(String id, String action, BalanceAccountType accountType) {
    Map<String, Object> request = new java.util.LinkedHashMap<>();
    request.put("id", id);
    request.put("action", action);
    request.put("channel", CHANNEL_BALANCE);
    request.put("accountType", accountType.name());
    sendAndAwaitAck(id, request, action + " " + CHANNEL_BALANCE);
  }

  private void handle(String text) {
    try {
      JsonNode message = mapper.readTree(text);
      if (isWelcome(message)) {
        pingIntervalMs = Math.max(1_000L, message.path("pingInterval").asLong(DEFAULT_PING_INTERVAL_MS));
        pingTimeoutMs = Math.max(1_000L, message.path("pingTimeout").asLong(DEFAULT_PING_TIMEOUT_MS));
        CountDownLatch currentWelcome = welcome;
        if (currentWelcome != null) {
          currentWelcome.countDown();
        }
        return;
      }

      if ("pong".equalsIgnoreCase(message.path("op").asText())) {
        pendingPingId = null;
        return;
      }

      String id = message.path("id").asText(null);
      if (id != null && message.has("result")) {
        CompletableFuture<Void> acknowledgement = acknowledgements.remove(id);
        if (acknowledgement != null) {
          if (message.path("result").asBoolean(false)
              || "true".equalsIgnoreCase(message.path("result").asText())) {
            acknowledgement.complete(null);
          } else {
            acknowledgement.completeExceptionally(new IllegalStateException(message.toString()));
          }
        }
        return;
      }

      if ("execution.UNIFIED".equals(message.path("T").asText()) && message.has("d")) {
        ExecutionEvent event = mapper.treeToValue(message, ExecutionEvent.class);
        executionSubscriptions.values().forEach(callback -> dispatch(callback, event));
      } else if (message.path("T").asText().startsWith(CHANNEL_EXECUTION_LITE + ".")
          && message.has("d")) {
        ExecutionLiteEvent event = mapper.treeToValue(message, ExecutionLiteEvent.class);
        executionLiteSubscriptions
            .values()
            .forEach(subscription -> dispatch(subscription.callback, event));
      } else if (message.path("T").asText().startsWith(CHANNEL_ORDER) && message.has("d")) {
        OrderEvent event = mapper.treeToValue(message, OrderEvent.class);
        orderSubscriptions
            .values()
            .forEach(
                subscription -> {
                  if (subscription.symbol == null
                      || subscription.symbol.equals(event.getData().getSymbol())) {
                    dispatch(subscription.callback, event);
                  }
                });
      } else if (message.path("T").asText().startsWith(CHANNEL_BALANCE + ".")
          && message.has("d")) {
        BalanceEvent event = mapper.treeToValue(message, BalanceEvent.class);
        balanceSubscriptions
            .values()
            .forEach(
                subscription -> {
                  if ((CHANNEL_BALANCE + "." + subscription.accountType.name())
                      .equals(event.getTopic())) {
                    dispatch(subscription.callback, event);
                  }
                });
      } else if (message.path("T").asText().startsWith(CHANNEL_POSITION) && message.has("d")) {
        PositionEvent event = mapper.treeToValue(message, PositionEvent.class);
        positionSubscriptions
            .values()
            .forEach(
                subscription -> {
                  if (subscription.symbol == null
                      || subscription.symbol.equals(event.getData().getSymbol())) {
                    dispatch(subscription.callback, event);
                  }
                });
      } else if (message.path("T").asText().startsWith(CHANNEL_LEVERAGE + ".")
          && message.has("d")) {
        LeverageEvent event = mapper.treeToValue(message, LeverageEvent.class);
        leverageSubscriptions.values().forEach(callback -> dispatch(callback, event));
      } else if (message.path("T").asText().startsWith(CHANNEL_LIQUIDATION_WARNING + ".")
          && message.has("d")) {
        LiquidationWarningEvent event = mapper.treeToValue(message, LiquidationWarningEvent.class);
        liquidationWarningSubscriptions.values().forEach(callback -> dispatch(callback, event));
      } else {
        log.debug("Ignoring UTA private WebSocket message: {}", text);
      }
    } catch (Exception e) {
      log.error("Unable to decode UTA private WebSocket message", e);
      notifyEvent(WebSocketEvent.ERROR_RECEIVED, e.getMessage());
    }
  }

  /**
   * The direct push gateways have used different envelope fields across protocol versions.
   * Accept all known welcome-frame shapes before starting authentication.
   */
  private boolean isWelcome(JsonNode message) {
    return "welcome".equalsIgnoreCase(message.path("message").asText())
        || "welcome".equalsIgnoreCase(message.path("op").asText())
        || "welcome".equalsIgnoreCase(message.path("type").asText());
  }

  private void sendAndAwaitAck(String id, Map<String, Object> message, String operation) {
    if (socket == null) {
      throw new IllegalStateException("UTA private WebSocket is not connected");
    }
    CompletableFuture<Void> acknowledgement = new CompletableFuture<>();
    acknowledgements.put(id, acknowledgement);
    try {
      if (!socket.send(mapper.writeValueAsString(message))) {
        throw new IllegalStateException("enqueue message failed");
      }
      acknowledgement.get(option.getWriteTimeout().toMillis(), TimeUnit.MILLISECONDS);
    } catch (TimeoutException e) {
      throw new IllegalStateException(operation + " acknowledgement timed out", e);
    } catch (Exception e) {
      throw new IllegalStateException(operation + " failed", e);
    } finally {
      acknowledgements.remove(id);
    }
  }

  private void schedulePing() {
    ScheduledFuture<?> currentPingTask = pingTask;
    if (currentPingTask != null) {
      currentPingTask.cancel(false);
    }
    pingTask =
        scheduler.scheduleAtFixedRate(
            () -> {
              if (!connected.get()) {
                return;
              }
              if (pendingPingId != null) {
                onDisconnected("pong timeout");
                return;
              }
              String id = UUID.randomUUID().toString();
              pendingPingId = id;
              Map<String, Object> ping = new java.util.LinkedHashMap<>();
              ping.put("id", id);
              ping.put("op", "ping");
              ping.put("timestamp", System.currentTimeMillis());
              try {
                if (!socket.send(mapper.writeValueAsString(ping))) {
                  onDisconnected("ping enqueue failed");
                  return;
                }
                scheduler.schedule(
                    () -> {
                      if (id.equals(pendingPingId)) {
                        onDisconnected("pong timeout");
                      }
                    },
                    pingTimeoutMs,
                    TimeUnit.MILLISECONDS);
              } catch (Exception e) {
                onDisconnected(e.getMessage());
              }
            },
            pingIntervalMs,
            pingIntervalMs,
            TimeUnit.MILLISECONDS);
  }

  private void onDisconnected(String reason) {
    if (!connected.getAndSet(false)) {
      return;
    }
    closeSocket("disconnected");
    notifyEvent(WebSocketEvent.DISCONNECTED, reason == null ? "" : reason);
    if (!started.get() || shuttingDown.get() || !option.isReconnect()) {
      return;
    }
    reconnect();
  }

  private void reconnect() {
    if (!reconnecting.compareAndSet(false, true)) {
      return;
    }
    Thread thread =
        new Thread(
            () -> {
              try {
                int attempt = 0;
                while (started.get() && !shuttingDown.get()) {
                  if (option.getReconnectAttempts() != -1 && attempt >= option.getReconnectAttempts()) {
                    notifyEvent(WebSocketEvent.CLIENT_FAIL, "maximum reconnect attempts exceeded");
                    return;
                  }
                  try {
                    notifyEvent(WebSocketEvent.TRY_RECONNECT, "attempt " + attempt);
                    dial();
                    executionSubscriptions
                        .keySet()
                        .forEach(
                            id ->
                                sendSubscription(
                                    id, "subscribe", CHANNEL_EXECUTION, TRADE_TYPE_UNIFIED));
                    executionLiteSubscriptions.forEach(
                        (id, subscription) ->
                            sendSubscription(
                                id,
                                "subscribe",
                                CHANNEL_EXECUTION_LITE,
                                subscription.tradeType.name()));
                    orderSubscriptions.forEach(
                        (id, subscription) ->
                            sendSubscription(
                                id,
                                "subscribe",
                                subscription.channel,
                                TRADE_TYPE_UNIFIED,
                                subscription.symbol));
                    balanceSubscriptions.forEach(
                        (id, subscription) ->
                            sendBalanceSubscription(id, "subscribe", subscription.accountType));
                    positionSubscriptions.forEach(
                        (id, subscription) ->
                            sendSubscription(
                                id,
                                "subscribe",
                                subscription.channel,
                                TRADE_TYPE_UNIFIED,
                                subscription.symbol));
                    leverageSubscriptions
                        .keySet()
                        .forEach(
                            id ->
                                sendSubscription(
                                    id, "subscribe", CHANNEL_LEVERAGE, TRADE_TYPE_UNIFIED));
                    liquidationWarningSubscriptions
                        .keySet()
                        .forEach(
                            id ->
                                sendSubscription(
                                    id,
                                    "subscribe",
                                    CHANNEL_LIQUIDATION_WARNING,
                                    TRADE_TYPE_UNIFIED));
                    notifyEvent(WebSocketEvent.RE_SUBSCRIBE_OK, "private channels");
                    return;
                  } catch (Exception e) {
                    attempt++;
                    notifyEvent(WebSocketEvent.RE_SUBSCRIBE_ERROR, e.getMessage());
                    try {
                      Thread.sleep(option.getReconnectInterval().toMillis());
                    } catch (InterruptedException interrupted) {
                      Thread.currentThread().interrupt();
                      return;
                    }
                  }
                }
              } finally {
                reconnecting.set(false);
              }
            },
            "uta-private-ws-reconnect");
    thread.setDaemon(true);
    thread.start();
  }

  private void closeSocket(String reason) {
    pendingPingId = null;
    ScheduledFuture<?> currentPingTask = pingTask;
    if (currentPingTask != null) {
      currentPingTask.cancel(false);
      pingTask = null;
    }
    WebSocket currentSocket = socket;
    socket = null;
    connected.set(false);
    if (currentSocket != null) {
      currentSocket.close(1000, reason);
      currentSocket.cancel();
    }
  }

  private void ensureResources() {
    ScheduledExecutorService currentScheduler = scheduler;
    if (currentScheduler == null || currentScheduler.isShutdown()) {
      scheduler = newScheduler();
    }
    OkHttpClient currentHttp = http;
    if (currentHttp == null || currentHttp.dispatcher().executorService().isShutdown()) {
      http = newHttpClient();
    }
  }

  private OkHttpClient newHttpClient() {
    return new OkHttpClient.Builder()
        .connectTimeout(option.getDialTimeout())
        .writeTimeout(option.getWriteTimeout())
        .build();
  }

  private ScheduledExecutorService newScheduler() {
    return Executors.newSingleThreadScheduledExecutor(
        runnable -> {
          Thread thread = new Thread(runnable, "uta-private-ws-scheduler");
          thread.setDaemon(true);
          return thread;
        });
  }

  private void failDial(RuntimeException failure) {
    dialFailure = failure;
    CountDownLatch currentWelcome = welcome;
    if (currentWelcome != null) {
      currentWelcome.countDown();
    }
  }

  private void dispatch(ExecutionEvent.Callback callback, ExecutionEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(ExecutionLiteEvent.Callback callback, ExecutionLiteEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(OrderEvent.Callback callback, OrderEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(BalanceEvent.Callback callback, BalanceEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(PositionEvent.Callback callback, PositionEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(LeverageEvent.Callback callback, LeverageEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void dispatch(
      LiquidationWarningEvent.Callback callback, LiquidationWarningEvent event) {
    try {
      callback.onEvent(event);
    } catch (Throwable throwable) {
      log.error("UTA private WebSocket callback failed", throwable);
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, throwable.getMessage());
    }
  }

  private void notifyEvent(WebSocketEvent event, String message) {
    if (option.getEventCallback() != null) {
      try {
        option.getEventCallback().onEvent(event, message);
      } catch (Exception e) {
        log.error("WebSocket event callback failed", e);
      }
    }
  }

  private static void validateCredentials(ClientOption option) {
    if (isBlank(option.getKey()) || isBlank(option.getSecret()) || isBlank(option.getPassphrase())) {
      throw new IllegalStateException("API key, secret and passphrase are required for UTA private WebSocket");
    }
  }

  private static boolean isBlank(String value) {
    return value == null || value.trim().isEmpty();
  }

  private static final class ExecutionLiteSubscription {
    private final ExecutionLiteTradeType tradeType;
    private final ExecutionLiteEvent.Callback callback;

    private ExecutionLiteSubscription(
        ExecutionLiteTradeType tradeType, ExecutionLiteEvent.Callback callback) {
      this.tradeType = tradeType;
      this.callback = callback;
    }
  }

  private static final class OrderSubscription {
    private final String channel;
    private final String symbol;
    private final OrderEvent.Callback callback;

    private OrderSubscription(String channel, String symbol, OrderEvent.Callback callback) {
      this.channel = channel;
      this.symbol = symbol;
      this.callback = callback;
    }
  }

  private static final class BalanceSubscription {
    private final BalanceAccountType accountType;
    private final BalanceEvent.Callback callback;

    private BalanceSubscription(BalanceAccountType accountType, BalanceEvent.Callback callback) {
      this.accountType = accountType;
      this.callback = callback;
    }
  }

  private static final class PositionSubscription {
    private final String channel;
    private final String symbol;
    private final PositionEvent.Callback callback;

    private PositionSubscription(String channel, String symbol, PositionEvent.Callback callback) {
      this.channel = channel;
      this.symbol = symbol;
      this.callback = callback;
    }
  }
}
