package com.kucoin.test.regression;

import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.api.KucoinRestService;
import com.kucoin.universal.sdk.api.KucoinWSService;
import com.kucoin.universal.sdk.generate.futures.futurespublic.FuturesPublicWs;
import com.kucoin.universal.sdk.generate.spot.market.GetAllSymbolsData;
import com.kucoin.universal.sdk.generate.spot.market.GetAllSymbolsReq;
import com.kucoin.universal.sdk.generate.spot.spotprivate.SpotPrivateWs;
import com.kucoin.universal.sdk.generate.spot.spotpublic.SpotPublicWs;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.TransportOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;
import java.util.List;
import java.util.concurrent.CountDownLatch;
import java.util.stream.Collectors;
import lombok.extern.slf4j.Slf4j;

/** Runs a WebSocket reconnect test, subscribing to spot and futures market data. */
@Slf4j
public class RunReconnectTest {

  public static void runReconnectTest() {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    ClientOption clientOption =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .transportOption(TransportOption.builder().build())
            .websocketClientOption(WebSocketClientOption.defaults())
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .build();

    KucoinClient client = new DefaultKucoinClient(clientOption);
    KucoinRestService rest = client.getRestService();
    KucoinWSService wsSvc = client.getWsService();

    List<String> symbols =
        rest
            .getSpotService()
            .getMarketApi()
            .getAllSymbols(GetAllSymbolsReq.builder().market("USDS").build())
            .getData()
            .stream()
            .map(GetAllSymbolsData::getSymbol)
            .limit(50)
            .collect(Collectors.toList());

    spotWsExample(wsSvc.newSpotPublicWS(), symbols);
    privateWsExample(wsSvc.newSpotPrivateWS());
    futuresWsExample(wsSvc.newFuturesPublicWS());

    log.info("Total subscribe: 53");

    try {
      CountDownLatch latch = new CountDownLatch(1);
      latch.await();
    } catch (InterruptedException e) {
      log.error("Main thread interrupted", e);
      Thread.currentThread().interrupt();
    }
  }

  private static void noop(String __, String ___, Object ____) {}

  public static void spotWsExample(SpotPublicWs ws, List<String> symbols) {
    ws.start();
    for (String symbol : symbols) {
      ws.trade(new String[] {symbol}, RunReconnectTest::noop);
    }
    ws.ticker(new String[] {"BTC-USDT", "ETH-USDT"}, RunReconnectTest::noop);
  }

   public static void privateWsExample(SpotPrivateWs ws) {
       ws.start();
       ws.orderV2(RunReconnectTest::noop);
   }

  public static void futuresWsExample(FuturesPublicWs ws) {
    ws.start();
    ws.tickerV2("XBTUSDTM", RunReconnectTest::noop);
    ws.tickerV1("XBTUSDTM", RunReconnectTest::noop);
    log.info("Futures subscribe [OK]");
  }

  public static void main(String[] args) {
    runReconnectTest();
  }
}
