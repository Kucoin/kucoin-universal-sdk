// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package com.kucoin.universal.sdk.generate.futures.futurespublic;

public interface FuturesPublicWs {

  /**
   * announcement
   *
   * <p>Subscribe this topic to get Funding Fee Settlement.
   *
   * <p>push frequency: Settlement is made every 8 hours, real-time push
   */
  String announcement(String symbol, AnnouncementEvent.Callback callback);

  /**
   * Match execution data.
   *
   * <p>For each order executed, the system will send you the match messages in the format as
   * following.
   *
   * <p>push frequency: real-time
   */
  String execution(String symbol, ExecutionEvent.Callback callback);

  /**
   * instrument
   *
   * <p>Subscribe this topic to get the mark Price, index Price or funding fee Rate
   *
   * <p>push frequency: mark.index.price 1s, funding.rate 1min
   */
  String instrument(String symbol, InstrumentEvent.Callback callback);

  /**
   * Klines
   *
   * <p>Subscribe to this topic to get K-Line data.
   *
   * <p>push frequency: 1s
   */
  String klines(String symbol, String type, KlinesEvent.Callback callback);

  /**
   * Orderbook - Increment
   *
   * <p>The system will return the increment change orderbook data (all depth). If there is no
   * change in the market, data will not be pushed.
   *
   * <p>push frequency: real-time
   */
  String orderbookIncrement(String symbol, OrderbookIncrementEvent.Callback callback);

  /**
   * Orderbook - Level50
   *
   * <p>The depth50 market data.
   *
   * <p>push frequency: 100ms
   */
  String orderbookLevel50(String symbol, OrderbookLevel50Event.Callback callback);

  /**
   * Orderbook - Level5
   *
   * <p>The system will return the 5 best ask/bid orders data. If there is no change in the market,
   * data will not be pushed
   *
   * <p>push frequency: 100ms
   */
  String orderbookLevel5(String symbol, OrderbookLevel5Event.Callback callback);

  /**
   * Symbol Snapshot
   *
   * <p>Get symbol snapshot.
   *
   * <p>push frequency: 5000ms
   */
  String symbolSnapshot(String symbol, SymbolSnapshotEvent.Callback callback);

  /**
   * Get Ticker(not recommended)
   *
   * <p>Subscribe to this topic to get real-time pushes on BBO changes. It is not recommended to use
   * this topic any more. For real-time ticker information, please subscribe
   * /contractMarket/tickerV2:{symbol}.
   *
   * <p>push frequency: real-time
   */
  String tickerV1(String symbol, TickerV1Event.Callback callback);

  /**
   * Get Ticker V2
   *
   * <p>Subscribe to this topic to get real-time pushes of BBO changes. After subscription, when
   * there are changes in the order book (not necessarily ask1/bid1 changes), the system will push
   * the real-time ticker symbol information to you.
   *
   * <p>push frequency: real-time
   */
  String tickerV2(String symbol, TickerV2Event.Callback callback);

  /** Unsubscribe from topics */
  void unSubscribe(String id);

  /**
   * Initiates the WebSocket service
   *
   * <p>This method must be called before subscribing to any topics.
   */
  void start();

  /**
   * Stops the WebSocket service.
   *
   * <p>This method is used to terminate the WebSocket connection and stop all ongoing
   * subscriptions. It should be called when no further communication is needed with the server, or
   * when the application is being shut down to ensure a clean disconnection and release of
   * resources.
   */
  void stop();
}
