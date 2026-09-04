package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.generate.uta.publicws.KlineEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.KlineInterval;
import com.kucoin.universal.sdk.generate.uta.publicws.MarkPriceEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.FundingFeeEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.FundingFeeAllSymbolsEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.CallAuctionInfoEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.OrderbookDepth;
import com.kucoin.universal.sdk.generate.uta.publicws.OrderbookEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.OrderbookRpiFilter;
import com.kucoin.universal.sdk.generate.uta.publicws.TickerEvent;
import com.kucoin.universal.sdk.generate.uta.publicws.TradeEvent;
import com.kucoin.universal.sdk.model.PushTradeType;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import com.kucoin.universal.sdk.model.WebSocketEvent;
import java.time.Duration;
import java.util.Arrays;
import java.util.LinkedHashSet;
import java.util.Map;
import java.util.Set;
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

/**
 * Transport for the direct public push protocol at x-push-spot and x-push-futures.
 *
 * <p>It deliberately does not use {@link DefaultWebsocketTransport}: that transport expects a
 * token endpoint and the legacy {@code type/topic} wire format.
 */
@Slf4j
public final class PushPublicWsService {
  private static final String CHANNEL_TICKER = "ticker";
  private static final String CHANNEL_KLINE = "kline";
  private static final String CHANNEL_TRADE = "trade";
  private static final String CHANNEL_ORDERBOOK = "obu";
  private static final String CHANNEL_MARK_PRICE = "mark-price";
  private static final String CHANNEL_FUNDING_FEE = "funding-fee";
  private static final String CHANNEL_FUNDING_FEE_ALL_SYMBOLS = "funding-fee-all-symbols";
  private static final String CHANNEL_CALL_AUCTION_INFO = "callAuctionInfo";
  private static final long DEFAULT_PING_INTERVAL_MS = 18_000L;
  private static final long PING_TIMEOUT_MS = 10_000L;

  private final ObjectMapper mapper = new ObjectMapper();
  private final WebSocketClientOption option;
  private final PushTradeType tradeType;
  private volatile OkHttpClient http;
  private volatile ScheduledExecutorService scheduler;
  private final Map<String, Subscription> subscriptions = new ConcurrentHashMap<>();
  private final Map<String, CompletableFuture<Void>> acknowledgements = new ConcurrentHashMap<>();
  private final AtomicBoolean connected = new AtomicBoolean(false);
  private final AtomicBoolean started = new AtomicBoolean(false);
  private final AtomicBoolean shuttingDown = new AtomicBoolean(false);
  private final AtomicBoolean reconnecting = new AtomicBoolean(false);

  private volatile WebSocket socket;
  private volatile CountDownLatch welcome;
  private volatile RuntimeException dialFailure;
  private volatile long pingIntervalMs = DEFAULT_PING_INTERVAL_MS;
  private volatile String pendingPingId;
  private volatile ScheduledFuture<?> pingTask;

  public PushPublicWsService(WebSocketClientOption option, PushTradeType tradeType) {
    this.option = option == null ? WebSocketClientOption.defaults() : option;
    this.tradeType = tradeType;
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

  public String subscribeTicker(String[] symbols, TickerEvent.Callback callback) {
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_TICKER,
        symbols,
        java.util.Collections.emptyMap(),
        message -> callback.onEvent(mapper.treeToValue(message, TickerEvent.class)));
  }

  public String subscribeKline(
      String symbol, KlineInterval interval, KlineEvent.Callback callback) {
    if (interval == null) {
      throw new IllegalArgumentException("interval must not be null");
    }
    if (tradeType == PushTradeType.FUTURES && interval == KlineInterval.HOUR_6) {
      throw new IllegalArgumentException("6hour Kline is not supported for FUTURES");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    Map<String, Object> parameters = new java.util.LinkedHashMap<>();
    parameters.put("interval", interval.getValue());
    return subscribe(
        CHANNEL_KLINE,
        new String[] {symbol},
        parameters,
        message -> callback.onEvent(mapper.treeToValue(message, KlineEvent.class)));
  }

  public String subscribeTrade(String symbol, TradeEvent.Callback callback) {
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_TRADE,
        new String[] {symbol},
        java.util.Collections.emptyMap(),
        message -> callback.onEvent(mapper.treeToValue(message, TradeEvent.class)));
  }

  public String subscribeOrderbook(
      String symbol,
      OrderbookDepth depth,
      OrderbookRpiFilter rpiFilter,
      OrderbookEvent.Callback callback) {
    if (depth == null) {
      throw new IllegalArgumentException("depth must not be null");
    }
    if (rpiFilter == null) {
      throw new IllegalArgumentException("rpiFilter must not be null");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    if (rpiFilter == OrderbookRpiFilter.INCLUDE_RPI && tradeType != PushTradeType.FUTURES) {
      throw new IllegalArgumentException("rpiFilter=1 is supported only for FUTURES");
    }
    if (rpiFilter == OrderbookRpiFilter.INCLUDE_RPI
        && depth != OrderbookDepth.BEST_5
        && depth != OrderbookDepth.BEST_50) {
      throw new IllegalArgumentException("rpiFilter=1 supports only depth 5 or 50");
    }

    Map<String, Object> parameters = new java.util.LinkedHashMap<>();
    parameters.put("depth", depth.getValue());
    parameters.put("rpiFilter", rpiFilter.getValue());
    return subscribe(
        CHANNEL_ORDERBOOK,
        new String[] {symbol},
        parameters,
        message -> callback.onEvent(mapper.treeToValue(message, OrderbookEvent.class)));
  }

  public String subscribeMarkPrice(String symbol, MarkPriceEvent.Callback callback) {
    if (tradeType != PushTradeType.FUTURES) {
      throw new IllegalStateException("mark-price is available only from the FUTURES public endpoint");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_MARK_PRICE,
        new String[] {symbol},
        java.util.Collections.emptyMap(),
        false,
        message -> callback.onEvent(mapper.treeToValue(message, MarkPriceEvent.class)));
  }

  public String subscribeFundingFee(String[] symbols, FundingFeeEvent.Callback callback) {
    if (tradeType != PushTradeType.FUTURES) {
      throw new IllegalStateException("funding-fee is available only from the FUTURES public endpoint");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_FUNDING_FEE,
        symbols,
        java.util.Collections.emptyMap(),
        false,
        message -> callback.onEvent(mapper.treeToValue(message, FundingFeeEvent.class)));
  }

  public String subscribeFundingFeeAllSymbols(FundingFeeAllSymbolsEvent.Callback callback) {
    if (tradeType != PushTradeType.FUTURES) {
      throw new IllegalStateException(
          "funding-fee-all-symbols is available only from the FUTURES public endpoint");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_FUNDING_FEE_ALL_SYMBOLS,
        new String[0],
        java.util.Collections.emptyMap(),
        false,
        true,
        message -> callback.onEvent(mapper.treeToValue(message, FundingFeeAllSymbolsEvent.class)));
  }

  public String subscribeCallAuctionInfo(String symbol, CallAuctionInfoEvent.Callback callback) {
    if (tradeType != PushTradeType.SPOT) {
      throw new IllegalStateException(
          "callAuctionInfo is available only from the SPOT public endpoint");
    }
    if (callback == null) {
      throw new IllegalArgumentException("callback must not be null");
    }
    return subscribe(
        CHANNEL_CALL_AUCTION_INFO,
        new String[] {symbol},
        java.util.Collections.emptyMap(),
        false,
        message -> callback.onEvent(mapper.treeToValue(message, CallAuctionInfoEvent.class)));
  }

  private String subscribe(
      String channel,
      String[] symbols,
      Map<String, Object> parameters,
      PushEventCallback callback) {
    return subscribe(channel, symbols, parameters, true, callback);
  }

  private String subscribe(
      String channel,
      String[] symbols,
      Map<String, Object> parameters,
      boolean includeTradeType,
      PushEventCallback callback) {
    return subscribe(channel, symbols, parameters, includeTradeType, false, callback);
  }

  private String subscribe(
      String channel,
      String[] symbols,
      Map<String, Object> parameters,
      boolean includeTradeType,
      boolean allowNoSymbols,
      PushEventCallback callback) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA public WebSocket is not connected; call start() first");
    }

    String[] normalizedSymbols = normalizeSymbols(symbols, allowNoSymbols);
    String id = UUID.randomUUID().toString();
    Subscription subscription =
        new Subscription(id, channel, normalizedSymbols, parameters, includeTradeType, callback);
    if (subscriptions.putIfAbsent(id, subscription) != null) {
      throw new IllegalStateException("duplicate subscription id");
    }

    try {
      sendSubscription(subscription, "subscribe");
      return id;
    } catch (RuntimeException e) {
      subscriptions.remove(id);
      throw e;
    }
  }

  public void unsubscribe(String id) {
    Subscription subscription = subscriptions.get(id);
    if (subscription == null) {
      return;
    }
    sendSubscription(subscription, "unsubscribe");
    subscriptions.remove(id);
  }

  private String[] normalizeSymbols(String[] symbols, boolean allowNoSymbols) {
    if (symbols == null || symbols.length == 0) {
      if (allowNoSymbols) {
        return new String[0];
      }
      throw new IllegalArgumentException("at least one symbol is required");
    }
    Set<String> result = new LinkedHashSet<>();
    for (String symbol : symbols) {
      if (symbol == null || symbol.trim().isEmpty()) {
        throw new IllegalArgumentException("symbol must not be blank");
      }
      result.add(symbol.trim());
    }
    return result.toArray(new String[0]);
  }

  private void dial() {
    welcome = new CountDownLatch(1);
    dialFailure = null;
    Request request = new Request.Builder().url(tradeType.getEndpoint()).build();
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
      connected.set(true);
      notifyEvent(WebSocketEvent.CONNECTED, tradeType.name());
      schedulePing();
    } catch (InterruptedException e) {
      Thread.currentThread().interrupt();
      throw new IllegalStateException("interrupted while waiting for WebSocket welcome", e);
    } catch (RuntimeException e) {
      closeSocket("dial-error");
      throw e;
    }
  }

  private void failDial(RuntimeException failure) {
    dialFailure = failure;
    CountDownLatch currentWelcome = welcome;
    if (currentWelcome != null) {
      currentWelcome.countDown();
    }
  }

  private void handle(String text) {
    try {
      JsonNode message = mapper.readTree(text);
      if ("welcome".equalsIgnoreCase(message.path("message").asText())) {
        long announcedInterval = message.path("pingInterval").asLong(DEFAULT_PING_INTERVAL_MS);
        pingIntervalMs = Math.max(1_000L, announcedInterval);
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
          if (message.path("result").asBoolean(false) || "true".equalsIgnoreCase(message.path("result").asText())) {
            acknowledgement.complete(null);
          } else {
            acknowledgement.completeExceptionally(new IllegalStateException(message.toString()));
          }
        }
        return;
      }

      if (message.has("T") && message.has("d")) {
        String topic = message.path("T").asText();
        String channel = topic.contains(".") ? topic.substring(0, topic.indexOf('.')) : topic;
        String symbol = message.path("d").path("s").asText(null);
        subscriptions.values().forEach(subscription -> subscription.dispatch(channel, symbol, message));
      } else {
        log.debug("Ignoring UTA public WebSocket message: {}", text);
      }
    } catch (Exception e) {
      log.error("Unable to decode UTA public WebSocket message", e);
      notifyEvent(WebSocketEvent.ERROR_RECEIVED, e.getMessage());
    }
  }

  private void sendSubscription(Subscription subscription, String action) {
    Map<String, Object> request = new java.util.LinkedHashMap<>();
    request.put("id", subscription.id);
    request.put("action", action);
    request.put("channel", subscription.channel);
    if (subscription.includeTradeType) {
      request.put("tradeType", tradeType.name());
    }
    if (subscription.symbols.length == 1) {
      request.put("symbol", subscription.symbols[0]);
    } else if (subscription.symbols.length > 1) {
      request.put("symbols", subscription.symbols);
    }
    request.putAll(subscription.parameters);
    sendAndAwaitAck(subscription.id, request);
  }

  private void sendAndAwaitAck(String id, Map<String, Object> message) {
    if (!connected.get() || socket == null) {
      throw new IllegalStateException("UTA public WebSocket is not connected");
    }
    CompletableFuture<Void> acknowledgement = new CompletableFuture<>();
    acknowledgements.put(id, acknowledgement);
    try {
      if (!socket.send(mapper.writeValueAsString(message))) {
        throw new IllegalStateException("enqueue message failed");
      }
      acknowledgement.get(option.getWriteTimeout().toMillis(), TimeUnit.MILLISECONDS);
    } catch (TimeoutException e) {
      throw new IllegalStateException("subscription acknowledgement timed out", e);
    } catch (Exception e) {
      throw new IllegalStateException("subscription failed", e);
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
                Math.min(PING_TIMEOUT_MS, Math.max(3_000L, pingIntervalMs / 2)),
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
                    subscriptions.values().forEach(subscription -> sendSubscription(subscription, "subscribe"));
                    notifyEvent(WebSocketEvent.RE_SUBSCRIBE_OK, tradeType.name());
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
            "uta-public-ws-reconnect");
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
          Thread thread = new Thread(runnable, "uta-public-ws-scheduler");
          thread.setDaemon(true);
          return thread;
        });
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

  private static final class Subscription {
    private final String id;
    private final String channel;
    private final String[] symbols;
    private final Map<String, Object> parameters;
    private final boolean includeTradeType;
    private final PushEventCallback callback;

    private Subscription(
        String id,
        String channel,
        String[] symbols,
        Map<String, Object> parameters,
        boolean includeTradeType,
        PushEventCallback callback) {
      this.id = id;
      this.channel = channel;
      this.symbols = Arrays.copyOf(symbols, symbols.length);
      this.parameters = new java.util.LinkedHashMap<>(parameters);
      this.includeTradeType = includeTradeType;
      this.callback = callback;
    }

    private void dispatch(String eventChannel, String symbol, JsonNode event) {
      if (!channel.equals(eventChannel)
          || (symbols.length > 0 && (symbol == null || !Arrays.asList(symbols).contains(symbol)))) {
        return;
      }
      try {
        callback.onEvent(event);
      } catch (Throwable throwable) {
        log.error("UTA public WebSocket callback failed", throwable);
      }
    }
  }

  @FunctionalInterface
  private interface PushEventCallback {
    void onEvent(JsonNode event) throws Exception;
  }
}
