package com.kucoin.universal.sdk.test.e2e.ws.spot;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.generate.spot.spotprivate.OrderV2Event;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWs;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.TransportOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import java.util.concurrent.CompletableFuture;
import java.util.concurrent.CountDownLatch;
import lombok.extern.slf4j.Slf4j;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;

@Slf4j
public class PrivateTest {

  private static SpotPrivateWs api;

  public static ObjectMapper mapper = new ObjectMapper();

  @BeforeAll
  public static void setUp() {

    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    WebSocketClientOption webSocketClientOption = WebSocketClientOption.defaults();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(webSocketClientOption)
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);
    api = kucoinClient.getWsService().newSpotPrivateWS();
    api.start();
  }

  @AfterAll
  public static void tearDown() {
    api.stop();
  }

  @Test
  public void testAccount() {
    CountDownLatch gotEvent = new CountDownLatch(1);
    CompletableFuture.supplyAsync(
            () ->
                api.account(
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getAccountId());
                      Assertions.assertNotNull(event.getAvailable());
                      Assertions.assertNotNull(event.getAvailableChange());
                      Assertions.assertNotNull(event.getCurrency());
                      Assertions.assertNotNull(event.getHold());
                      Assertions.assertNotNull(event.getHoldChange());
                      Assertions.assertNotNull(event.getRelationContext());
                      Assertions.assertNotNull(event.getRelationEvent());
                      Assertions.assertNotNull(event.getRelationEventId());
                      Assertions.assertNotNull(event.getTime());
                      Assertions.assertNotNull(event.getTotal());
                      log.info("event: {}", event.toString());
                      gotEvent.countDown();
                    }))
        .thenApply(
            id -> {
              try {
                gotEvent.await();
              } catch (InterruptedException e) {
                throw new RuntimeException(e);
              }
              return id;
            })
        .thenAccept(id -> api.unSubscribe(id))
        .join();
  }

  @Test
  public void testOrderV1() {
    CountDownLatch gotEvent = new CountDownLatch(1);
    CompletableFuture.supplyAsync(
            () ->
                api.orderV1(
                    (__, ___, event) -> {
                      log.info("event: {}", event.toString());
                      Assertions.assertNotNull(event.getFilledSize());
                      Assertions.assertNotNull(event.getOrderId());
                      Assertions.assertNotNull(event.getOrderTime());
                      Assertions.assertNotNull(event.getOrderType());
                      Assertions.assertNotNull(event.getPrice());
                      Assertions.assertNotNull(event.getSide());
                      Assertions.assertNotNull(event.getSize());
                      Assertions.assertNotNull(event.getStatus());
                      Assertions.assertNotNull(event.getSymbol());
                      Assertions.assertNotNull(event.getTs());
                      Assertions.assertNotNull(event.getType());
                      gotEvent.countDown();
                    }))
        .thenApply(
            id -> {
              try {
                gotEvent.await();
              } catch (InterruptedException e) {
                throw new RuntimeException(e);
              }
              return id;
            })
        .thenAccept(id -> api.unSubscribe(id))
        .join();
  }

  @Test
  public void testOrderV2() throws InterruptedException {
    CountDownLatch gotEvent = new CountDownLatch(1);
    api.orderV2(
        (String topic, String subject, OrderV2Event data) -> {
          log.info("event: {}", data.toString());
        });
    Thread.sleep(1000000000);
  }

  @Test
  public void testStopOrder() {
    CountDownLatch gotEvent = new CountDownLatch(1);
    CompletableFuture.supplyAsync(
            () ->
                api.stopOrder(
                    (__, ___, event) -> {
                      log.info("event: {}", event.toString());
                      gotEvent.countDown();
                    }))
        .thenApply(
            id -> {
              try {
                gotEvent.await();
              } catch (InterruptedException e) {
                throw new RuntimeException(e);
              }
              return id;
            })
        .thenAccept(id -> api.unSubscribe(id))
        .join();
  }
}
