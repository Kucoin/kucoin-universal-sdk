<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PrivateWs;

use KuCoin\UniversalSDK\Internal\Infra\UtaPrivateTradeWsService;
use React\Promise\PromiseInterface;

class UtaPrivateTradeWsImpl implements UtaPrivateTradeWs
{
    /** @var UtaPrivateTradeWsService */
    private $wsService;

    public function __construct(UtaPrivateTradeWsService $wsService) { $this->wsService = $wsService; }
    public function start(): PromiseInterface { return $this->wsService->start(); }
    public function stop(): PromiseInterface { return $this->wsService->stop(); }
    public function placeOrder(array $request): PromiseInterface { return $this->wsService->placeOrder($request); }
    public function cancelOrder(array $request): PromiseInterface { return $this->wsService->cancelOrder($request); }
    public function amendOrder(array $request): PromiseInterface { return $this->wsService->amendOrder($request); }
}
