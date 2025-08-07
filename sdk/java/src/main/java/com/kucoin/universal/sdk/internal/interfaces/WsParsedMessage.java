package com.kucoin.universal.sdk.internal.interfaces;

import lombok.AllArgsConstructor;
import lombok.Data;

@Data
@AllArgsConstructor
public class WsParsedMessage {

  private String type;

  private String id;

  private Object message;

  private boolean ack;
}
