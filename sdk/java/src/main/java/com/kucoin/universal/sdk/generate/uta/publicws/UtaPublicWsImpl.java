// Code generated from the UTA Public WebSocket schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.publicws;

import com.kucoin.universal.sdk.internal.infra.PushPublicWsService;

/** Implementation backed by the direct UTA public push protocol. */
public final class UtaPublicWsImpl implements UtaPublicWs {
  private final PushPublicWsService wsService;

  public UtaPublicWsImpl(PushPublicWsService wsService) {
    this.wsService = wsService;
  }

  @Override
  public String ticker(String symbol, TickerEvent.Callback callback) {
    return wsService.subscribeTicker(new String[] {symbol}, callback);
  }

  @Override
  public String ticker(String[] symbols, TickerEvent.Callback callback) {
    return wsService.subscribeTicker(symbols, callback);
  }

  @Override
  public String kline(String symbol, KlineInterval interval, KlineEvent.Callback callback) {
    return wsService.subscribeKline(symbol, interval, callback);
  }

  @Override
  public String trade(String symbol, TradeEvent.Callback callback) {
    return wsService.subscribeTrade(symbol, callback);
  }

  @Override
  public String orderbook(String symbol, OrderbookDepth depth, OrderbookEvent.Callback callback) {
    return wsService.subscribeOrderbook(symbol, depth, OrderbookRpiFilter.NONE_RPI_ONLY, callback);
  }

  @Override
  public String orderbook(
      String symbol,
      OrderbookDepth depth,
      OrderbookRpiFilter rpiFilter,
      OrderbookEvent.Callback callback) {
    return wsService.subscribeOrderbook(symbol, depth, rpiFilter, callback);
  }

  @Override
  public String markPrice(String symbol, MarkPriceEvent.Callback callback) {
    return wsService.subscribeMarkPrice(symbol, callback);
  }

  @Override
  public String fundingFee(String symbol, FundingFeeEvent.Callback callback) {
    return wsService.subscribeFundingFee(new String[] {symbol}, callback);
  }

  @Override
  public String fundingFee(String[] symbols, FundingFeeEvent.Callback callback) {
    return wsService.subscribeFundingFee(symbols, callback);
  }

  @Override
  public String fundingFeeAllSymbols(FundingFeeAllSymbolsEvent.Callback callback) {
    return wsService.subscribeFundingFeeAllSymbols(callback);
  }

  @Override
  public String callAuctionInfo(String symbol, CallAuctionInfoEvent.Callback callback) {
    return wsService.subscribeCallAuctionInfo(symbol, callback);
  }

  @Override
  public void unSubscribe(String id) {
    wsService.unsubscribe(id);
  }

  @Override
  public void start() {
    wsService.start();
  }

  @Override
  public void stop() {
    wsService.stop();
  }
}
