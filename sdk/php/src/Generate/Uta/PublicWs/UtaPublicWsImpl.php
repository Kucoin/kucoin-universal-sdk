<?php

namespace KuCoin\UniversalSDK\Generate\Uta\PublicWs;

use KuCoin\UniversalSDK\Internal\Infra\UtaPushWsService;
use React\Promise\PromiseInterface;

class UtaPublicWsImpl implements UtaPublicWs
{
    /** @var UtaPushWsService */
    private $wsService;
    /** @var string */
    private $tradeType;

    public function __construct(UtaPushWsService $wsService, string $tradeType)
    {
        $this->wsService = $wsService;
        $this->tradeType = strtoupper($tradeType);
    }

    public function start(): PromiseInterface { return $this->wsService->start(); }
    public function stop(): PromiseInterface { return $this->wsService->stop(); }
    public function unSubscribe(string $id): PromiseInterface { return $this->wsService->unsubscribe($id); }

    public function ticker($symbols, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        return $this->subscribe('ticker', $symbols, $onData, $onSuccess, $onError, [], true);
    }

    public function kline(string $symbol, string $interval, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        if ($this->tradeType === 'FUTURES' && $interval === '6hour') {
            throw new \InvalidArgumentException('6hour Kline is not supported for FUTURES');
        }
        return $this->subscribe('kline', $symbol, $onData, $onSuccess, $onError, ['interval' => $interval], true);
    }

    public function trade(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        return $this->subscribe('trade', $symbol, $onData, $onSuccess, $onError, [], true);
    }

    public function orderbook(string $symbol, string $depth, callable $onData, ?callable $onSuccess = null, ?callable $onError = null, int $rpiFilter = 0): PromiseInterface
    {
        if ($rpiFilter === 1 && $this->tradeType !== 'FUTURES') {
            throw new \InvalidArgumentException('rpiFilter=1 is supported only for FUTURES');
        }
        if ($rpiFilter === 1 && $depth !== '5' && $depth !== '50') {
            throw new \InvalidArgumentException('rpiFilter=1 supports only depth 5 or 50');
        }
        return $this->subscribe('obu', $symbol, $onData, $onSuccess, $onError, ['depth' => $depth, 'rpiFilter' => $rpiFilter], true);
    }

    public function markPrice(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        $this->requireFutures('mark-price');
        return $this->subscribe('mark-price', $symbol, $onData, $onSuccess, $onError, [], false);
    }

    public function fundingFee($symbols, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        $this->requireFutures('funding-fee');
        return $this->subscribe('funding-fee', $symbols, $onData, $onSuccess, $onError, [], false);
    }

    public function fundingFeeAllSymbols(callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        $this->requireFutures('funding-fee-all-symbols');
        return $this->subscribe('funding-fee-all-symbols', null, $onData, $onSuccess, $onError, [], false);
    }

    public function callAuctionInfo(string $symbol, callable $onData, ?callable $onSuccess = null, ?callable $onError = null): PromiseInterface
    {
        if ($this->tradeType !== 'SPOT') {
            throw new \InvalidArgumentException('callAuctionInfo is available only from the SPOT endpoint');
        }
        return $this->subscribe('callAuctionInfo', $symbol, $onData, $onSuccess, $onError, [], false);
    }

    private function subscribe(string $channel, $symbols, callable $onData, ?callable $onSuccess, ?callable $onError, array $parameters, bool $includeTradeType): PromiseInterface
    {
        $subscription = [
            'channel' => $channel,
            'callback' => $onData,
            'parameters' => $parameters,
            'includeTradeType' => $includeTradeType,
            'tradeType' => $this->tradeType,
        ];
        if (is_array($symbols)) {
            $subscription['symbols'] = array_values($symbols);
        } elseif ($symbols !== null) {
            $subscription['symbol'] = $symbols;
        }
        return $this->wsService->subscribe($subscription)->then(
            function ($id) use ($onSuccess) {
                if ($onSuccess) { $onSuccess($id); }
                return $id;
            },
            function ($error) use ($onError) {
                if ($onError) { $onError($error); }
                throw $error;
            }
        );
    }

    private function requireFutures(string $channel): void
    {
        if ($this->tradeType !== 'FUTURES') {
            throw new \InvalidArgumentException($channel . ' is available only from the FUTURES endpoint');
        }
    }
}
