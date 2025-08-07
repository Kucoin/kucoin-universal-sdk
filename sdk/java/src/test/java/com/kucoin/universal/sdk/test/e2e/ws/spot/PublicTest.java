package com.kucoin.universal.sdk.test.e2e.ws.spot;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWs;
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
public class PublicTest {

  private static SpotPublicWs api;

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
    api = kucoinClient.getWsService().newSpotPublicWS();
    api.start();
  }

  @AfterAll
  public static void tearDown() {
    api.stop();
  }

  /** allTickers Get All Tickers /allTickers/market/ticker:all */
  @Test
  public void testAllTickers() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.allTickers(
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getBestAsk());
                      Assertions.assertNotNull(event.getBestAskSize());
                      Assertions.assertNotNull(event.getBestBid());
                      Assertions.assertNotNull(event.getBestBidSize());
                      Assertions.assertNotNull(event.getPrice());
                      Assertions.assertNotNull(event.getSequence());
                      Assertions.assertNotNull(event.getSize());
                      Assertions.assertNotNull(event.getTime());
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

  /**
   * TODO callAuctionInfo Get Call Auction Info
   * /callAuctionInfo/callauction/callauctionData:_symbol_
   */
  @Test
  public void testCallAuctionInfo() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.callAuctionInfo(
                    "",
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getSymbol());
                      Assertions.assertNotNull(event.getEstimatedPrice());
                      Assertions.assertNotNull(event.getEstimatedSize());
                      Assertions.assertNotNull(event.getSellOrderRangeLowPrice());
                      Assertions.assertNotNull(event.getSellOrderRangeHighPrice());
                      Assertions.assertNotNull(event.getBuyOrderRangeLowPrice());
                      Assertions.assertNotNull(event.getBuyOrderRangeHighPrice());
                      Assertions.assertNotNull(event.getTime());
                      log.info("event: {}", event.toString());
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

  /**
   * TODO callAuctionOrderbookLevel50 CallAuctionOrderbook - Level50
   * /callAuctionOrderbookLevel50/callauction/level2Depth50:_symbol_
   */
  @Test
  public void testCallAuctionOrderbookLevel50() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.callAuctionOrderbookLevel50(
                    "",
                    (__, ___, event) -> {
                      event.getAsks().forEach(item -> {});

                      event.getBids().forEach(item -> {});

                      Assertions.assertNotNull(event.getTimestamp());
                      log.info("event: {}", event.toString());
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

  /** klines Klines /klines/market/candles:_symbol___type_ */
  @Test
  public void testKlines() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.klines(
                    "BTC-USDT",
                    "1min",
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getSymbol());
                      event.getCandles().forEach(item -> {});

                      Assertions.assertNotNull(event.getTime());
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

  /** marketSnapshot Market Snapshot /marketSnapshot/market/snapshot:_market_ */
  @Test
  public void testMarketSnapshot() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.marketSnapshot(
                    "BTC-USDT",
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getSequence());
                      Assertions.assertNotNull(event.getData());
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

  /**
   * orderbookIncrement Orderbook - Increment /orderbookIncrement/market/level2:_symbol_,_symbol_
   */
  @Test
  public void testOrderbookIncrement() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.orderbookIncrement(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getChanges());
                      Assertions.assertNotNull(event.getSequenceEnd());
                      Assertions.assertNotNull(event.getSequenceStart());
                      Assertions.assertNotNull(event.getSymbol());
                      Assertions.assertNotNull(event.getTime());
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

  /** orderbookLevel1 Orderbook - Level1 /orderbookLevel1/spotMarket/level1:_symbol_,_symbol_ */
  @Test
  public void testOrderbookLevel1() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.orderbookLevel1(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      event.getAsks().forEach(item -> {});

                      event.getBids().forEach(item -> {});

                      Assertions.assertNotNull(event.getTimestamp());
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

  /**
   * orderbookLevel50 Orderbook - Level50
   * /orderbookLevel50/spotMarket/level2Depth50:_symbol_,_symbol_
   */
  @Test
  public void testOrderbookLevel50() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.orderbookLevel50(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      event.getAsks().forEach(item -> {});

                      event.getBids().forEach(item -> {});

                      Assertions.assertNotNull(event.getTimestamp());
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

  /**
   * orderbookLevel5 Orderbook - Level5 /orderbookLevel5/spotMarket/level2Depth5:_symbol_,_symbol_
   */
  @Test
  public void testOrderbookLevel5() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.orderbookLevel5(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      event.getAsks().forEach(item -> {});

                      event.getBids().forEach(item -> {});

                      Assertions.assertNotNull(event.getTimestamp());
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

  /** symbolSnapshot Symbol Snapshot /symbolSnapshot/market/snapshot:_symbol_ */
  @Test
  public void testSymbolSnapshot() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.marketSnapshot(
                    "BTC-USDT",
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getSequence());
                      Assertions.assertNotNull(event.getData());
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

  /** ticker Get Ticker /ticker/market/ticker:_symbol_,_symbol_ */
  @Test
  public void testTicker() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.ticker(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getSequence());
                      Assertions.assertNotNull(event.getPrice());
                      Assertions.assertNotNull(event.getSize());
                      Assertions.assertNotNull(event.getBestAsk());
                      Assertions.assertNotNull(event.getBestAskSize());
                      Assertions.assertNotNull(event.getBestBid());
                      Assertions.assertNotNull(event.getBestBidSize());
                      Assertions.assertNotNull(event.getTime());
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

  /** trade Trade /trade/market/match:_symbol_,_symbol_ */
  @Test
  public void testTrade() {
    CountDownLatch gotEvent = new CountDownLatch(10);
    CompletableFuture.supplyAsync(
            () ->
                api.trade(
                    new String[] {"BTC-USDT", "ETH-USDT"},
                    (__, ___, event) -> {
                      Assertions.assertNotNull(event.getMakerOrderId());
                      Assertions.assertNotNull(event.getPrice());
                      Assertions.assertNotNull(event.getSequence());
                      Assertions.assertNotNull(event.getSide());
                      Assertions.assertNotNull(event.getSize());
                      Assertions.assertNotNull(event.getSymbol());
                      Assertions.assertNotNull(event.getTakerOrderId());
                      Assertions.assertNotNull(event.getTime());
                      Assertions.assertNotNull(event.getTradeId());
                      Assertions.assertNotNull(event.getType());
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
    public void testDoNothing() throws Exception {
        Thread.sleep(30_000);
    }
}
