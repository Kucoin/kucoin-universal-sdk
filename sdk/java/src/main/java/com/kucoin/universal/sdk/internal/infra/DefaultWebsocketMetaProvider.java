package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.*;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.WsMessage;
import java.util.*;
import java.util.concurrent.ThreadLocalRandom;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public class DefaultWebsocketMetaProvider implements WebsocketMetaProvider {

  private final WsTokenProvider tokenProvider;
  private volatile WsToken token;
  private final ObjectMapper mapper;

  public DefaultWebsocketMetaProvider(WsTokenProvider tokenProvider, ObjectMapper mapper) {
    this.tokenProvider = tokenProvider;
    this.mapper = mapper;
  }

  @Override
  public List<WebsocketHandshake> handshakes() {
    return Arrays.asList(
        (socket, text) -> {
          WsMessage m = mapper.readValue(text, WsMessage.class);
          switch (m.getType()) {
            case Constants.WS_MESSAGE_TYPE_WELCOME:
              {
                log.info("receive welcome message: {}", m);
                break;
              }
            default:
              {
                throw new RuntimeException("unexpected message: " + m);
              }
          }
        });
  }

  @Override
  public WsParsedMessage parseMessage(String text) throws Exception {
    WsMessage m = mapper.readValue(text, WsMessage.class);
    return new WsParsedMessage(m.getType(), m.getId(), m, false);
  }

  @Override
  public Map.Entry<String, Object> pingMessage() {
    WsMessage ping = new WsMessage();
    ping.setId(String.valueOf(System.nanoTime()));
    ping.setType(Constants.WS_MESSAGE_TYPE_PING);
    return new AbstractMap.SimpleEntry<>(ping.getId(), ping);
  }

  @Override
  public String buildUri() {
    token = pick(tokenProvider.getToken());
    return token.getEndpoint() + "?connectId=" + System.nanoTime() + "&token=" + token.getToken();
  }

  public long pingInterval() {
    return token.getPingInterval();
  }

  @Override
  public long pingTimeout() {
    return token.getPingTimeout();
  }

  @Override
  public void close() {
    tokenProvider.close();
  }

  private WsToken pick(List<WsToken> list) {
    if (list == null || list.isEmpty()) {
      throw new IllegalArgumentException("empty token list");
    }
    return list.get(ThreadLocalRandom.current().nextInt(list.size()));
  }
}
