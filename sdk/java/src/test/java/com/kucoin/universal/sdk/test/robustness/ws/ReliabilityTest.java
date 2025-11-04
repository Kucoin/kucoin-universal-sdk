package com.kucoin.universal.sdk.test.robustness.ws;

import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.generate.spot.market.GetAllSymbolsData;
import com.kucoin.universal.sdk.generate.spot.market.GetAllSymbolsReq;
import com.kucoin.universal.sdk.generate.spot.market.GetAllSymbolsResp;
import com.kucoin.universal.sdk.generate.spot.spotprivate.OrderV2Event;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWs;
import com.kucoin.universal.sdk.generate.spot.spotpublic.AllTickersEvent;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWs;
import com.kucoin.universal.sdk.generate.spot.spotpublic.TradeEvent;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.TransportOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import java.util.List;
import java.util.concurrent.atomic.AtomicInteger;
import lombok.extern.slf4j.Slf4j;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

@Slf4j
public class ReliabilityTest {

  @Test
  public void testCallback() {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    AtomicInteger atomicInteger = new AtomicInteger();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(
                WebSocketClientOption.builder()
                    .eventCallback(
                        ((event, message) -> {
                          atomicInteger.incrementAndGet();
                          log.info("Event: {}, {}", event, message);
                        }))
                    .build())
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);
    SpotPublicWs spotPublicWs = kucoinClient.getWsService().newSpotPublicWS();
    spotPublicWs.start();
    spotPublicWs.stop();

    Assertions.assertEquals(3, atomicInteger.get());
  }

  @Test
  public void testReconnect() throws Exception {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    AtomicInteger atomicInteger = new AtomicInteger();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(
                WebSocketClientOption.builder()
                    .eventCallback(
                        ((event, message) -> {
                          atomicInteger.incrementAndGet();
                          log.info("Event: {}, {}", event, message);
                        }))
                    .build())
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);
    SpotPublicWs spotPublicWs = kucoinClient.getWsService().newSpotPublicWS();
    spotPublicWs.start();

    spotPublicWs.allTickers((String topic, String subject, AllTickersEvent data) -> {});

    Thread.sleep(1000 * 12000);
    spotPublicWs.stop();
  }

  private static void noop(String topic, String subject, TradeEvent data) {}

  @Test
  public void testReconnect1() throws Exception {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    AtomicInteger atomicInteger = new AtomicInteger();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(
                WebSocketClientOption.builder()
                    .eventCallback(
                        ((event, message) -> {
                          atomicInteger.incrementAndGet();
                          log.info("Event: {}, {}", event, message);
                        }))
                    .build())
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);

    GetAllSymbolsResp resp =
        kucoinClient
            .getRestService()
            .getSpotService()
            .getMarketApi()
            .getAllSymbols(GetAllSymbolsReq.builder().market("USDS").build());
    List<GetAllSymbolsData> data = resp.getData();
    if (data.size() > 100) {
      data = data.subList(0, 100);
    }

    SpotPublicWs spotPublicWs = kucoinClient.getWsService().newSpotPublicWS();
    spotPublicWs.start();

    data.forEach(
        d -> {
          spotPublicWs.trade(new String[] {d.getSymbol()}, ReliabilityTest::noop);
        });

    Thread.sleep(1000 * 12000);
    spotPublicWs.stop();
  }

  @Test
  public void testReconnect2() throws Exception {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    AtomicInteger atomicInteger = new AtomicInteger();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(
                WebSocketClientOption.builder()
                    .eventCallback(
                        ((event, message) -> {
                          atomicInteger.incrementAndGet();
                          log.info("Event: {}, {}", event, message);
                        }))
                    .build())
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);

    SpotPublicWs spotPublicWs = kucoinClient.getWsService().newSpotPublicWS();
    spotPublicWs.start();

    spotPublicWs.trade(new String[] {"BTC-USDT", "ETH-USDT"}, ReliabilityTest::noop);

    Thread.sleep(1000 * 12000);
    spotPublicWs.stop();
  }

  @Test
  public void testReconnect3() throws Exception {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    AtomicInteger atomicInteger = new AtomicInteger();

    ClientOption clientOpt =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(
                WebSocketClientOption.builder()
                    .eventCallback(
                        ((event, message) -> {
                          atomicInteger.incrementAndGet();
                          log.info("Event: {}, {}", event, message);
                        }))
                    .build())
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);

    SpotPrivateWs spotPrivateWs = kucoinClient.getWsService().newSpotPrivateWS();
    spotPrivateWs.start();

    spotPrivateWs.orderV2(
        (String topic, String subject, OrderV2Event data) -> {
          log.info("OrderV2: {}, {}, {}", topic, subject, data);
        });

    Thread.sleep(1000 * 12000);
    spotPrivateWs.stop();
  }
}
