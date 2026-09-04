package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ObjectNode;
import com.kucoin.universal.sdk.generate.uta.order.PlaceOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.CancelOrderReq;
import com.kucoin.universal.sdk.generate.uta.order.AmendOrderReq;
import com.kucoin.universal.sdk.generate.uta.privatews.UtaAmendOrderWsResponse;
import com.kucoin.universal.sdk.generate.uta.privatews.UtaCancelOrderWsResponse;
import com.kucoin.universal.sdk.generate.uta.privatews.UtaPlaceOrderWsResponse;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import java.util.LinkedHashMap;
import java.util.Map;
import java.util.UUID;
import java.util.concurrent.CompletableFuture;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.CountDownLatch;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.TimeoutException;
import java.util.concurrent.atomic.AtomicBoolean;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import okhttp3.WebSocket;
import okhttp3.WebSocketListener;
import okio.ByteString;

/** Transport for the authenticated UTA WebSocket trade protocol. */
public final class PrivateTradeWsService {
  // OkHttp's HttpUrl accepts HTTP schemes; newWebSocket upgrades this HTTPS request to WSS.
  private static final String ENDPOINT = "https://wsapi.kucoin.com/v1/private";
  private static final String ORDER_OPERATION = "uta.order";
  private static final String CANCEL_OPERATION = "uta.cancel";
  private static final String AMEND_OPERATION = "uta.amend";

  private final ObjectMapper mapper =
      new ObjectMapper().setSerializationInclusion(JsonInclude.Include.NON_NULL);
  private final WebSocketClientOption option;
  private final KcSigner signer;
  private final String apiSecret;
  private volatile OkHttpClient http;
  private final Map<String, CompletableFuture<UtaPlaceOrderWsResponse>> pendingOrders =
      new ConcurrentHashMap<>();
  private final Map<String, CompletableFuture<UtaCancelOrderWsResponse>> pendingCancels =
      new ConcurrentHashMap<>();
  private final Map<String, CompletableFuture<UtaAmendOrderWsResponse>> pendingAmends =
      new ConcurrentHashMap<>();
  private final AtomicBoolean connected = new AtomicBoolean(false);
  private final AtomicBoolean started = new AtomicBoolean(false);
  private final AtomicBoolean shuttingDown = new AtomicBoolean(false);
  private final AtomicBoolean reconnecting = new AtomicBoolean(false);

  private volatile WebSocket socket;
  private volatile CountDownLatch welcome;
  private volatile RuntimeException dialFailure;

  public PrivateTradeWsService(ClientOption clientOption) {
    validateCredentials(clientOption);
    this.option =
        clientOption.getWebsocketClientOption() == null
            ? WebSocketClientOption.defaults()
            : clientOption.getWebsocketClientOption();
    this.signer =
        new KcSigner(
            clientOption.getKey(),
            clientOption.getSecret(),
            clientOption.getPassphrase(),
            clientOption.getBrokerName(),
            clientOption.getBrokerPartner(),
            clientOption.getBrokerKey());
    this.apiSecret = clientOption.getSecret();
    this.http = newHttpClient();
  }

  public void start() {
    if (!started.compareAndSet(false, true)) {
      return;
    }
    shuttingDown.set(false);
    ensureHttpClient();
    try {
      dial();
    } catch (RuntimeException e) {
      started.set(false);
      throw e;
    }
  }

  public UtaPlaceOrderWsResponse placeOrder(PlaceOrderReq order) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private trade WebSocket is not connected; call start() first");
    }
    if (order == null) {
      throw new IllegalArgumentException("order must not be null");
    }

    String id = UUID.randomUUID().toString();
    CompletableFuture<UtaPlaceOrderWsResponse> response = new CompletableFuture<>();
    pendingOrders.put(id, response);
    try {
      Map<String, Object> request = new LinkedHashMap<>();
      request.put("id", id);
      request.put("op", ORDER_OPERATION);
      request.put("args", orderArgs(order));
      if (!socket.send(mapper.writeValueAsString(request))) {
        throw new IllegalStateException("uta.order enqueue failed");
      }
      return response.get(option.getWriteTimeout().toMillis(), TimeUnit.MILLISECONDS);
    } catch (TimeoutException e) {
      throw new IllegalStateException("uta.order response timed out", e);
    } catch (Exception e) {
      throw new IllegalStateException("uta.order failed", e);
    } finally {
      pendingOrders.remove(id);
    }
  }

  public UtaCancelOrderWsResponse cancelOrder(CancelOrderReq cancel) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private trade WebSocket is not connected; call start() first");
    }
    if (cancel == null) {
      throw new IllegalArgumentException("cancel request must not be null");
    }
    if (isBlank(cancel.getOrderId()) && isBlank(cancel.getClientOid())) {
      throw new IllegalArgumentException("either orderId or clientOid must be provided");
    }

    String id = UUID.randomUUID().toString();
    CompletableFuture<UtaCancelOrderWsResponse> response = new CompletableFuture<>();
    pendingCancels.put(id, response);
    try {
      Map<String, Object> request = new LinkedHashMap<>();
      request.put("id", id);
      request.put("op", CANCEL_OPERATION);
      request.put("args", mapper.valueToTree(cancel));
      if (!socket.send(mapper.writeValueAsString(request))) {
        throw new IllegalStateException("uta.cancel enqueue failed");
      }
      return response.get(option.getWriteTimeout().toMillis(), TimeUnit.MILLISECONDS);
    } catch (TimeoutException e) {
      throw new IllegalStateException("uta.cancel response timed out", e);
    } catch (Exception e) {
      throw new IllegalStateException("uta.cancel failed", e);
    } finally {
      pendingCancels.remove(id);
    }
  }

  public UtaAmendOrderWsResponse amendOrder(AmendOrderReq amend) {
    if (!connected.get()) {
      throw new IllegalStateException("UTA private trade WebSocket is not connected; call start() first");
    }
    if (amend == null) {
      throw new IllegalArgumentException("amend request must not be null");
    }
    if (isBlank(amend.getOrderId()) && isBlank(amend.getClientOid())) {
      throw new IllegalArgumentException("either orderId or clientOid must be provided");
    }

    String id = UUID.randomUUID().toString();
    CompletableFuture<UtaAmendOrderWsResponse> response = new CompletableFuture<>();
    pendingAmends.put(id, response);
    try {
      Map<String, Object> request = new LinkedHashMap<>();
      request.put("id", id);
      request.put("op", AMEND_OPERATION);
      request.put("args", mapper.valueToTree(amend));
      if (!socket.send(mapper.writeValueAsString(request))) {
        throw new IllegalStateException("uta.amend enqueue failed");
      }
      return response.get(option.getWriteTimeout().toMillis(), TimeUnit.MILLISECONDS);
    } catch (TimeoutException e) {
      throw new IllegalStateException("uta.amend response timed out", e);
    } catch (Exception e) {
      throw new IllegalStateException("uta.amend failed", e);
    } finally {
      pendingAmends.remove(id);
    }
  }

  public void stop() {
    if (!started.getAndSet(false)) {
      return;
    }
    shuttingDown.set(true);
    closeSocket("shutdown");
    failPending(new IllegalStateException("UTA private trade WebSocket stopped"));
    OkHttpClient currentHttp = http;
    currentHttp.connectionPool().evictAll();
    currentHttp.dispatcher().executorService().shutdown();
  }

  private void dial() {
    welcome = new CountDownLatch(1);
    dialFailure = null;
    Map<String, String> headers = signer.headers("");
    String connectionSign =
        hmac(headers.get("KC-API-KEY") + headers.get("KC-API-TIMESTAMP"), apiSecret);
    HttpUrl url =
        HttpUrl.get(ENDPOINT)
            .newBuilder()
            .addQueryParameter("apikey", headers.get("KC-API-KEY"))
            .addQueryParameter("timestamp", headers.get("KC-API-TIMESTAMP"))
            .addQueryParameter("sign", connectionSign)
            .addQueryParameter("passphrase", headers.get("KC-API-PASSPHRASE"))
            .build();
    OkHttpClient currentHttp = http;
    socket =
        currentHttp.newWebSocket(
            new Request.Builder().url(url).build(),
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
                onDisconnected(webSocket, new IllegalStateException("closed " + code + ": " + reason));
              }

              @Override
              public void onFailure(WebSocket webSocket, Throwable throwable, Response response) {
                onDisconnected(
                    webSocket, new IllegalStateException("WebSocket connection failed", throwable));
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
    } catch (InterruptedException e) {
      Thread.currentThread().interrupt();
      throw new IllegalStateException("interrupted while waiting for WebSocket welcome", e);
    } catch (RuntimeException e) {
      closeAfterDialError();
      throw e;
    }
  }

  private void handle(String text) {
    String id = null;
    try {
      JsonNode message = mapper.readTree(text);
      if (isWelcome(message)) {
        CountDownLatch currentWelcome = welcome;
        if (currentWelcome != null) {
          currentWelcome.countDown();
        }
        return;
      }
      if (isAuthChallenge(message)) {
        WebSocket currentSocket = socket;
        if (currentSocket == null || !currentSocket.send(hmac(text, apiSecret))) {
          failDial(new IllegalStateException("WebSocket trade authentication send failed"));
        }
        return;
      }
      id = message.path("id").asText(null);
      if (id == null) {
        if (message.has("code")) {
          failDial(new IllegalStateException(message.toString()));
        }
        return;
      }
      CompletableFuture<UtaPlaceOrderWsResponse> pending = pendingOrders.get(id);
      if (pending != null) {
        UtaPlaceOrderWsResponse response = mapper.treeToValue(message, UtaPlaceOrderWsResponse.class);
        if ("200000".equals(response.getCode())) {
          pending.complete(response);
        } else {
          pending.completeExceptionally(new IllegalStateException(message.toString()));
        }
        return;
      }

      CompletableFuture<UtaCancelOrderWsResponse> pendingCancel = pendingCancels.get(id);
      if (pendingCancel != null) {
        UtaCancelOrderWsResponse response = mapper.treeToValue(message, UtaCancelOrderWsResponse.class);
        if ("200000".equals(response.getCode())) {
          pendingCancel.complete(response);
        } else {
          pendingCancel.completeExceptionally(new IllegalStateException(message.toString()));
        }
        return;
      }

      CompletableFuture<UtaAmendOrderWsResponse> pendingAmend = pendingAmends.get(id);
      if (pendingAmend != null) {
        UtaAmendOrderWsResponse response = mapper.treeToValue(message, UtaAmendOrderWsResponse.class);
        if ("200000".equals(response.getCode())) {
          pendingAmend.complete(response);
        } else {
          pendingAmend.completeExceptionally(new IllegalStateException(message.toString()));
        }
      }
    } catch (Exception e) {
      IllegalStateException failure = new IllegalStateException("Unable to decode UTA trade response", e);
      if (id == null) {
        failPending(failure);
      } else {
        failPending(id, failure);
      }
    }
  }

  private boolean isWelcome(JsonNode message) {
    return "welcome".equalsIgnoreCase(message.path("data").asText())
        || "welcome".equalsIgnoreCase(message.path("message").asText())
        || "welcome".equalsIgnoreCase(message.path("op").asText())
        || "welcome".equalsIgnoreCase(message.path("type").asText());
  }

  /**
   * Generated REST request models define TP/SL trigger-type defaults. The WebSocket gateway
   * rejects those fields unless their matching trigger price is present.
   */
  private ObjectNode orderArgs(PlaceOrderReq order) {
    ObjectNode args = mapper.valueToTree(order);
    if (isBlank(order.getTpTriggerPrice())) {
      args.remove("tpTriggerPriceType");
    }
    if (isBlank(order.getSlTriggerPrice())) {
      args.remove("slTriggerPriceType");
    }
    return args;
  }

  private boolean isAuthChallenge(JsonNode message) {
    return message.hasNonNull("sessionId")
        && message.hasNonNull("timestamp")
        && !message.has("data");
  }

  private void onDisconnected(WebSocket disconnectedSocket, RuntimeException failure) {
    if (disconnectedSocket != socket) {
      return;
    }
    boolean wasConnected = connected.getAndSet(false);
    if (!started.get()) {
      return;
    }
    if (!wasConnected) {
      failDial(failure);
      return;
    }
    socket = null;
    failPending(failure);
    if (!shuttingDown.get() && option.isReconnect()) {
      reconnect();
    }
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
                  if (option.getReconnectAttempts() != -1
                      && attempt >= option.getReconnectAttempts()) {
                    return;
                  }
                  try {
                    dial();
                    return;
                  } catch (RuntimeException e) {
                    attempt++;
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
            "uta-private-trade-ws-reconnect");
    thread.setDaemon(true);
    thread.start();
  }

  private void closeSocket(String reason) {
    connected.set(false);
    WebSocket currentSocket = socket;
    socket = null;
    if (currentSocket != null) {
      currentSocket.close(1000, reason);
      currentSocket.cancel();
    }
  }

  private void ensureHttpClient() {
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

  private void closeAfterDialError() {
    connected.set(false);
    WebSocket currentSocket = socket;
    socket = null;
    if (currentSocket != null) {
      currentSocket.close(1000, "dial-error");
      currentSocket.cancel();
    }
  }

  private void failDial(RuntimeException failure) {
    dialFailure = failure;
    CountDownLatch currentWelcome = welcome;
    if (currentWelcome != null) {
      currentWelcome.countDown();
    }
  }

  private void failPending(RuntimeException failure) {
    pendingOrders.values().forEach(pending -> pending.completeExceptionally(failure));
    pendingOrders.clear();
    pendingCancels.values().forEach(pending -> pending.completeExceptionally(failure));
    pendingCancels.clear();
    pendingAmends.values().forEach(pending -> pending.completeExceptionally(failure));
    pendingAmends.clear();
  }

  private void failPending(String id, RuntimeException failure) {
    CompletableFuture<UtaPlaceOrderWsResponse> order = pendingOrders.get(id);
    if (order != null) {
      order.completeExceptionally(failure);
      return;
    }
    CompletableFuture<UtaCancelOrderWsResponse> cancel = pendingCancels.get(id);
    if (cancel != null) {
      cancel.completeExceptionally(failure);
      return;
    }
    CompletableFuture<UtaAmendOrderWsResponse> amend = pendingAmends.get(id);
    if (amend != null) {
      amend.completeExceptionally(failure);
    }
  }

  private static void validateCredentials(ClientOption option) {
    if (isBlank(option.getKey()) || isBlank(option.getSecret()) || isBlank(option.getPassphrase())) {
      throw new IllegalStateException("API key, secret and passphrase are required for UTA WebSocket trade");
    }
  }

  private static boolean isBlank(String value) {
    return value == null || value.trim().isEmpty();
  }

  private static String hmac(String plain, String secret) {
    try {
      Mac mac = Mac.getInstance("HmacSHA256");
      mac.init(new SecretKeySpec(secret.getBytes(java.nio.charset.StandardCharsets.UTF_8), "HmacSHA256"));
      return java.util.Base64.getEncoder().encodeToString(
          mac.doFinal(plain.getBytes(java.nio.charset.StandardCharsets.UTF_8)));
    } catch (Exception e) {
      throw new IllegalStateException("HMAC-SHA256 failure", e);
    }
  }
}
