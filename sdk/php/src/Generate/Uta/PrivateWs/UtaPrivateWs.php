<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PrivateWs;

use React\Promise\PromiseInterface;

/** Direct UTA private push WebSocket API. All callbacks receive the raw UTA event array. */
interface UtaPrivateWs
{
    public function start(): PromiseInterface;
    public function stop(): PromiseInterface;
    public function execution(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function executionLite(string $tradeType, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function orderAll(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function order(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function balance(string $accountType, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function positionAll(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function position(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function leverage(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function liquidationWarning(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface;
    public function unSubscribe(string $id): PromiseInterface;
}
