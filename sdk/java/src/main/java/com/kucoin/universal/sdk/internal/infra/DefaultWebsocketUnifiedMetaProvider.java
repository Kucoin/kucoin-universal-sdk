package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.WebsocketHandshake;
import com.kucoin.universal.sdk.internal.interfaces.WebsocketMetaProvider;
import com.kucoin.universal.sdk.internal.interfaces.WsParsedMessage;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.UnifiedWsMessage;
import java.net.URLEncoder;
import java.util.*;
import java.util.stream.Collectors;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public class DefaultWebsocketUnifiedMetaProvider implements WebsocketMetaProvider {

  private final ClientOption clientOption;

  private final ObjectMapper mapper;

  private volatile long pingInterval;

  private volatile long pingTimeout;

  public DefaultWebsocketUnifiedMetaProvider(ClientOption clientOption, ObjectMapper mapper) {
    this.clientOption = clientOption;
    this.mapper = mapper;
  }

  @Override
  public WsParsedMessage parseMessage(String text) throws Exception {
    UnifiedWsMessage unifiedWsMessage = mapper.readValue(text, UnifiedWsMessage.class);

    String type = "";
    boolean ack = false;

    switch (unifiedWsMessage.getOp()) {
      case Constants.WS_MESSAGE_TYPE_PONG:
        {
          type = Constants.WS_MESSAGE_TYPE_PONG;
        }
      default:
        {
          type = Constants.WS_MESSAGE_TYPE_MESSAGE;
          ack = true;
        }
    }

    return new WsParsedMessage(type, unifiedWsMessage.getId(), unifiedWsMessage, ack);
  }

  @Override
  public Map.Entry<String, Object> pingMessage() {
    Map<String, String> ping = new HashMap<>();
    ping.put("id", UUID.randomUUID().toString());
    ping.put("op", "ping");
    ping.put("timestamp", String.valueOf(System.currentTimeMillis()));
    return new AbstractMap.SimpleEntry<>(ping.get("id"), ping);
  }

  @Override
  public List<WebsocketHandshake> handshakes() {
    return Arrays.asList(
        // step1: sign auth message
        (socket, text) -> {
          log.info("receive auth message: {}", text);
          Map m = mapper.readValue(text, Map.class);
          Object code = m.get("code");
          if (code != null && !Constants.RESULT_CODE_SUCCESS.equalsIgnoreCase((String) code)) {
            throw new RuntimeException("expected auth success, but get:" + text);
          }
          socket.send(KcSigner.sign(text, clientOption.getSecret()));
        },
        // step2: receive welcome message
        (socket, text) -> {
          Map m = mapper.readValue(text, Map.class);
          String data = (String) m.get("data");
          pingInterval = (Integer) (m.get("pingInterval"));
          pingTimeout = (Integer) (m.get("pingTimeout"));

          if (Constants.WS_MESSAGE_TYPE_WELCOME.equalsIgnoreCase(data)) {
            log.info("receive welcome message: {}", m);
          } else {
            throw new RuntimeException("expected welcome message, but get:" + text);
          }
        });
  }

  @Override
  public String buildUri() {
    long timeStamp = System.currentTimeMillis();
    StringBuilder sb = new StringBuilder();
    sb.append(clientOption.getUnifiedWsEndpoint());
    sb.append("/v1/private?");
    Map<String, String> params = new HashMap<>();
    params.put("apikey", clientOption.getKey());
    params.put(
        "sign",
        KcSigner.sign(
            String.format("%s%d", clientOption.getKey(), timeStamp), clientOption.getSecret()));
    params.put("passphrase", KcSigner.sign(clientOption.getPassphrase(), clientOption.getSecret()));
    params.put("timestamp", String.valueOf(timeStamp));
    sb.append(
        params.entrySet().stream()
            .map(e -> URLEncoder.encode(e.getKey()) + "=" + URLEncoder.encode(e.getValue()))
            .collect(Collectors.joining("&")));
    return sb.toString();
  }

  @Override
  public long pingInterval() {
    return pingInterval;
  }

  @Override
  public long pingTimeout() {
    return pingTimeout;
  }

  @Override
  public void close() {}
}
