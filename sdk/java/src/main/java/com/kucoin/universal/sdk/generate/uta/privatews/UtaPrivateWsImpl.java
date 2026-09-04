// Code generated from the UTA Private WebSocket schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

import com.kucoin.universal.sdk.internal.infra.PrivatePushWsService;

/** Implementation backed by the direct UTA private push protocol. */
public final class UtaPrivateWsImpl implements UtaPrivateWs {
  private final PrivatePushWsService wsService;

  public UtaPrivateWsImpl(PrivatePushWsService wsService) {
    this.wsService = wsService;
  }

  @Override
  public String execution(ExecutionEvent.Callback callback) {
    return wsService.subscribeExecution(callback);
  }

  @Override
  public String executionLite(ExecutionLiteTradeType tradeType, ExecutionLiteEvent.Callback callback) {
    return wsService.subscribeExecutionLite(tradeType, callback);
  }

  @Override
  public String orderAll(OrderEvent.Callback callback) {
    return wsService.subscribeOrderAll(callback);
  }

  @Override
  public String order(String symbol, OrderEvent.Callback callback) {
    return wsService.subscribeOrder(symbol, callback);
  }

  @Override
  public String balance(BalanceAccountType accountType, BalanceEvent.Callback callback) {
    return wsService.subscribeBalance(accountType, callback);
  }

  @Override
  public String positionAll(PositionEvent.Callback callback) {
    return wsService.subscribePositionAll(callback);
  }

  @Override
  public String position(String symbol, PositionEvent.Callback callback) {
    return wsService.subscribePosition(symbol, callback);
  }

  @Override
  public String leverage(LeverageEvent.Callback callback) {
    return wsService.subscribeLeverage(callback);
  }

  @Override
  public String liquidationWarning(LiquidationWarningEvent.Callback callback) {
    return wsService.subscribeLiquidationWarning(callback);
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
