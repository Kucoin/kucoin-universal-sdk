// Code generated from the UTA Private WebSocket schema; DO NOT EDIT.
package com.kucoin.universal.sdk.generate.uta.privatews;

/** Direct UTA private push WebSocket API. */
public interface UtaPrivateWs {
  /** Subscribe to unified-account execution events. */
  String execution(ExecutionEvent.Callback callback);

  /** Subscribe to lightweight execution events for the selected trade type. */
  String executionLite(ExecutionLiteTradeType tradeType, ExecutionLiteEvent.Callback callback);

  /** Subscribe to all unified-account order lifecycle events. */
  String orderAll(OrderEvent.Callback callback);

  /** Subscribe to unified-account order lifecycle events for one symbol. */
  String order(String symbol, OrderEvent.Callback callback);

  /** Subscribe to account-balance change events for one account type. */
  String balance(BalanceAccountType accountType, BalanceEvent.Callback callback);

  /** Subscribe to all UTA futures position updates. */
  String positionAll(PositionEvent.Callback callback);

  /** Subscribe to UTA futures position updates for one contract symbol. */
  String position(String symbol, PositionEvent.Callback callback);

  /** Subscribe to unified-account leverage multiplier changes. */
  String leverage(LeverageEvent.Callback callback);

  /** Subscribe to unified-account liquidation-risk warnings. */
  String liquidationWarning(LiquidationWarningEvent.Callback callback);

  /** Unsubscribe a subscription created by this service. */
  void unSubscribe(String id);

  /** Connect, authenticate with the configured API credentials, and start heartbeats. */
  void start();

  /** Close the connection and stop all background tasks. */
  void stop();
}
