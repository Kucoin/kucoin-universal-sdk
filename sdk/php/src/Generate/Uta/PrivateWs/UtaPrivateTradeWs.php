<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PrivateWs;

use React\Promise\PromiseInterface;

/** Direct UTA WebSocket trading API. These operations create, cancel, or amend real orders. */
interface UtaPrivateTradeWs
{
    public function start(): PromiseInterface;
    public function stop(): PromiseInterface;
    public function placeOrder(array $request): PromiseInterface;
    public function cancelOrder(array $request): PromiseInterface;
    public function amendOrder(array $request): PromiseInterface;
}
