package com.kucoin.universal.sdk.test.e2e.ws.unified;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.generate.unified.unifiedws.UnifiedPrivateWs;
import com.kucoin.universal.sdk.model.*;
import java.util.*;
import java.util.concurrent.CompletableFuture;
import lombok.extern.slf4j.Slf4j;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;

@Slf4j
public class PrivateTest {
  private static UnifiedPrivateWs api;

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
            .unifiedWsEndpoint(Constants.GLOBAL_UNIFIED_WS_API_ENDPOINT)
            .transportOption(TransportOption.defaults())
            .websocketClientOption(webSocketClientOption)
            .build();

    KucoinClient kucoinClient = new DefaultKucoinClient(clientOpt);
    api = kucoinClient.getWsService().newUnifiedPrivateWS();
    api.start();
  }

  @AfterAll
  public static void tearDown() {
    api.stop();
  }

  @Test
  public void testPlaceOrder() throws Exception {

    List<CompletableFuture<UnifiedWsMessage>> completableFutures = new ArrayList<>();

    for (int i = 0; i < 5; i++) {
      Map<String, Object> params = new HashMap<>();
      params.put("clientOid", UUID.randomUUID().toString());
      params.put("side", "buy");
      params.put("symbol", "BTC-USDT");
      params.put("type", "limit");
      params.put("remark", "test");
      params.put("price", "1");
      params.put("size", "2");

      UnifiedWsArgs args = new UnifiedWsArgs();
      args.setId(UUID.randomUUID().toString());
      args.setOp("spot.order");
      args.setArgs(params);
      completableFutures.add(
          api.unifiedTrading(args)
              .thenCompose(
                  (msg) -> {
                    log.info("add order args:{}, response:{}", args.toString(), msg.toString());

                    Map<String, Object> cancelOrderParams = new HashMap<>();
                    cancelOrderParams.put("orderId", msg.getData().get("orderId"));
                    cancelOrderParams.put("symbol", "BTC-USDT");
                    UnifiedWsArgs cancelArgs = new UnifiedWsArgs();
                    cancelArgs.setId(UUID.randomUUID().toString());
                    cancelArgs.setOp("spot.cancel");
                    cancelArgs.setArgs(cancelOrderParams);
                    return api.unifiedTrading(cancelArgs)
                        .thenApply(
                            (cancelMsg) -> {
                              log.info(
                                  "cancel order args:{}, response:{}",
                                  cancelArgs.toString(),
                                  cancelMsg.toString());
                              return null;
                            });
                  }));
    }

    CompletableFuture.allOf(completableFutures.toArray(new CompletableFuture[0])).get();
  }

    @Test
    public void testDoNothing() throws Exception {
      Thread.sleep(30_000);
    }
}
