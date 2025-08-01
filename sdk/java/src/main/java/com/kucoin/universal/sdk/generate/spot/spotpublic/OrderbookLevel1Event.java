// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.spot.spotpublic;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.internal.interfaces.WebSocketMessageCallback;
import com.kucoin.universal.sdk.model.WsMessage;
import java.util.ArrayList;
import java.util.List;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@AllArgsConstructor
@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class OrderbookLevel1Event implements Response<OrderbookLevel1Event, WsMessage> {
  /** price, size */
  @JsonProperty("asks")
  private List<String> asks = new ArrayList<>();

  /** */
  @JsonProperty("bids")
  private List<String> bids = new ArrayList<>();

  /** */
  @JsonProperty("timestamp")
  private Long timestamp;

  /** common response */
  @JsonIgnore private WsMessage commonResponse;

  @Override
  public void setCommonResponse(WsMessage response) {
    this.commonResponse = response;
  }

  @FunctionalInterface
  public interface Callback {
    void onEvent(String topic, String subject, OrderbookLevel1Event data);
  }

  public static class CallbackAdapters {
    public static WebSocketMessageCallback of(Callback callback) {
      return (msg, objectMapper) -> {
        OrderbookLevel1Event event =
            objectMapper.convertValue(msg.getData(), OrderbookLevel1Event.class);
        event.setCommonResponse(msg);
        callback.onEvent(msg.getTopic(), msg.getSubject(), event);
      };
    }
  }
}
