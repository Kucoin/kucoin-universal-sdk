package com.kucoin.universal.sdk.internal.interfaces;

import com.kucoin.universal.sdk.model.WebSocketEvent;

public interface WebsocketTransportListener<T> {

  void onEvent(WebSocketEvent event, String message);

  void onMessage(T wsMessage);

  void onReconnected();
}
