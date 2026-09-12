<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PublicWs;

use React\Promise\PromiseInterface;

/** Direct UTA public push WebSocket API. Construct one instance for SPOT or FUTURES. */
interface UtaPublicWs
{
    public function start(): PromiseInterface;
    public function stop(): PromiseInterface;
    public function ticker($symbols, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function kline(string $symbol, string $interval, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function trade(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function orderbook(string $symbol, string $depth, callable $onData, ?callable $onSuccess = null, ?callable $onError = null, int $rpiFilter = 0): PromiseInterface;
    public function markPrice(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function fundingFee($symbols, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function fundingFeeAllSymbols(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function callAuctionInfo(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function unSubscribe(string $id): PromiseInterface;
}
