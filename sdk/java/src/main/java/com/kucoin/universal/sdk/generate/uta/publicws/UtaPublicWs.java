// Code generated from the UTA Public WebSocket schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

/** Direct UTA public push WebSocket API. One instance represents either Spot or Futures. */
public interface UtaPublicWs {
  /** Subscribe to ticker pushes for one symbol. */
  String ticker(String symbol, TickerEvent.Callback callback);

  /** Subscribe to ticker pushes for multiple symbols. */
  String ticker(String[] symbols, TickerEvent.Callback callback);

  /** Subscribe to Kline pushes for one symbol and interval. */
  String kline(String symbol, KlineInterval interval, KlineEvent.Callback callback);

  /** Subscribe to real-time trade pushes for one symbol. */
  String trade(String symbol, TradeEvent.Callback callback);

  /** Subscribe to an orderbook depth stream with the default no-RPI filter. */
  String orderbook(String symbol, OrderbookDepth depth, OrderbookEvent.Callback callback);

  /** Subscribe to an orderbook depth stream with an explicit Futures RPI filter. */
  String orderbook(
      String symbol,
      OrderbookDepth depth,
      OrderbookRpiFilter rpiFilter,
      OrderbookEvent.Callback callback);

  /** Subscribe to Futures mark price, index price and open-interest updates for one symbol. */
  String markPrice(String symbol, MarkPriceEvent.Callback callback);

  /** Subscribe to Futures funding-fee updates for one symbol. */
  String fundingFee(String symbol, FundingFeeEvent.Callback callback);

  /** Subscribe to Futures funding-fee updates for multiple symbols. */
  String fundingFee(String[] symbols, FundingFeeEvent.Callback callback);

  /** Subscribe to Futures funding-fee updates for all symbols. */
  String fundingFeeAllSymbols(FundingFeeAllSymbolsEvent.Callback callback);

  /** Subscribe to Spot call-auction information for one symbol. */
  String callAuctionInfo(String symbol, CallAuctionInfoEvent.Callback callback);

  /** Unsubscribe the subscription returned by {@link #ticker(String, TickerEvent.Callback)}. */
  void unSubscribe(String id);

  /** Connect and wait for the server welcome message. */
  void start();

  /** Close the connection and stop ping/reconnect tasks. */
  void stop();
}
