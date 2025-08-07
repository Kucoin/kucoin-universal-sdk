package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.*;
import com.kucoin.universal.sdk.model.*;
import java.util.Arrays;
import java.util.UUID;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public final class DefaultWsService
    implements WebSocketService, WebsocketTransportListener<WsMessage> {
  private final ObjectMapper mapper = new ObjectMapper();
  private final WebsocketTransport client;
  private final WebSocketClientOption option;
  private final boolean privateChannel;
  private TopicManager topicManager = new TopicManager();

  public DefaultWsService(
      ClientOption opt, String domain, boolean privateChannel, String sdkVersion) {

    this.privateChannel = privateChannel;
    this.option = opt.getWebsocketClientOption();

    Transport tokenTransport = new DefaultTransport(opt, sdkVersion);

    WsTokenProvider tokenProvider =
        new DefaultWsTokenProvider(tokenTransport, domain, privateChannel);
    mapper.setSerializationInclusion(JsonInclude.Include.NON_NULL);
    this.client =
        new DefaultWebsocketTransport(
            new DefaultWebsocketMetaProvider(tokenProvider, mapper), option, this);
  }

  @Override
  public void start() {
    client.start();
  }

  @Override
  public void stop() {
    client.stop();
  }

  @Override
  public String subscribe(String prefix, String[] args, WebSocketMessageCallback callback) {

    SubInfo sub = new SubInfo(prefix, Arrays.asList(args), callback);
    CallbackManager cm = topicManager.getCallbackManager(prefix);
    String id = sub.toId();
    Exception exception = null;

    if (!cm.add(sub)) {
      throw new IllegalStateException("already subscribed");
    }

    try {
      WsMessage msg = new WsMessage();
      msg.setId(id);
      msg.setType(Constants.WS_MESSAGE_TYPE_SUBSCRIBE);
      msg.setTopic(sub.subTopic());
      msg.setPrivateChannel(privateChannel);
      msg.setResponse(true);

      client.write(msg.getId(), msg, option.getWriteTimeout()).join();
      return id;
    } catch (Exception e) {
      cm.remove(id);
      exception = e;
      throw new RuntimeException("subscribe failed", e);
    } finally {
      log.info(
          "subscribe prefix:{}, args:{}, private:{}, id:{}",
          prefix,
          args,
          privateChannel,
          id,
          exception);
    }
  }

  @Override
  public void unsubscribe(String id) {
    SubInfo sub = SubInfo.fromId(id);
    CallbackManager cm = topicManager.getCallbackManager(sub.subTopic());
    Exception exception = null;

    try {
      WsMessage msg = new WsMessage();
      msg.setId(UUID.randomUUID().toString());
      msg.setType(Constants.WS_MESSAGE_TYPE_UNSUBSCRIBE);
      msg.setTopic(sub.subTopic());
      msg.setPrivateChannel(privateChannel);
      msg.setResponse(true);

      client.write(msg.getId(), msg, option.getWriteTimeout()).join();
      cm.remove(id);
    } catch (Exception e) {
      exception = e;
      throw new RuntimeException("unsubscribe failed", e);
    } finally {
      log.info("unsubscribe private:{}, id:{}", privateChannel, id, exception);
    }
  }

  @Override
  public void onEvent(WebSocketEvent event, String message) {
    notifyEvent(event, message);
  }

  @Override
  public void onMessage(WsMessage wsMessage) {
    CallbackManager cm = topicManager.getCallbackManager(wsMessage.getTopic());
    WebSocketMessageCallback cb = cm.get(wsMessage.getTopic());
    if (cb == null) {
      log.warn("can not find callback manager, topic:{}", wsMessage.getTopic());
      return;
    }

    try {
      cb.onMessage(wsMessage, mapper);
    } catch (Throwable t) {
      notifyEvent(WebSocketEvent.CALLBACK_ERROR, t.getMessage());
      log.error("invoke callback error", t);
    }
  }

  @Override
  public void onReconnected() {
    TopicManager oldTopicManager = topicManager;
    this.topicManager = new TopicManager();

    oldTopicManager.forEach(
        (key, value) -> {
          value
              .getSubInfo()
              .forEach(
                  sub -> {
                    try {
                      subscribe(
                          sub.getPrefix(),
                          sub.getArgs().toArray(new String[] {}),
                          sub.getCallback());
                      notifyEvent(WebSocketEvent.RE_SUBSCRIBE_OK, sub.toId());
                    } catch (Exception e) {
                      notifyEvent(WebSocketEvent.RE_SUBSCRIBE_ERROR, sub.toId());
                    }
                  });
        });
  }

  private void notifyEvent(WebSocketEvent ev, String msg) {
    if (option.getEventCallback() != null) {
      try {
        option.getEventCallback().onEvent(ev, msg);
      } catch (Exception e) {
        log.error("exception when notify event", e);
      }
    }
  }
}
