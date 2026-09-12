<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PrivateWs;

use KuCoin\UniversalSDK\Internal\Infra\UtaPushWsService;
use React\Promise\PromiseInterface;

class UtaPrivateWsImpl implements UtaPrivateWs
{
    /** @var UtaPushWsService */
    private $wsService;

    public function __construct(UtaPushWsService $wsService) { $this->wsService = $wsService; }
    public function start(): PromiseInterface { return $this->wsService->start(); }
    public function stop(): PromiseInterface { return $this->wsService->stop(); }
    public function unSubscribe(string $id): PromiseInterface { return $this->wsService->unsubscribe($id); }

    public function execution(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('execution', $onData, $onSuccess, $onError, ['tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function executionLite(string $tradeType, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('execution.lite', $onData, $onSuccess, $onError, ['tradeType' => strtoupper($tradeType), 'includeTradeType' => true]); }
    public function orderAll(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('orderAll', $onData, $onSuccess, $onError, ['tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function order(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('order', $onData, $onSuccess, $onError, ['symbol' => $symbol, 'tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function balance(string $accountType, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('balance', $onData, $onSuccess, $onError, ['accountType' => strtoupper($accountType)]); }
    public function positionAll(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('positionAll', $onData, $onSuccess, $onError, ['tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function position(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('position', $onData, $onSuccess, $onError, ['symbol' => $symbol, 'tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function leverage(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('leverage', $onData, $onSuccess, $onError, ['tradeType' => 'UNIFIED', 'includeTradeType' => true]); }
    public function liquidationWarning(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    { return $this->subscribe('lw', $onData, $onSuccess, $onError, ['tradeType' => 'UNIFIED', 'includeTradeType' => true]); }

    private function subscribe(string $channel, callable $onData, ?callable $onSuccess, ?callable $onError, array $options): PromiseInterface
    {
        return $this->wsService->subscribe(array_merge(['channel' => $channel, 'callback' => $onData], $options))->then(
            function ($id) use ($onSuccess) { if ($onSuccess) { $onSuccess($id); } return $id; },
            function ($error) use ($onError) { if ($onError) { $onError($error); } throw $error; }
        );
    }
}
