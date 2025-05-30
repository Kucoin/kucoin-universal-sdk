<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Futures\FuturesPublic;
use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketService;
use React\Promise\PromiseInterface;

class FuturesPublicWsImpl implements FuturesPublicWs
{
    /**@var WebSocketService $wsService*/
    private $wsService;

    public function __construct(WebSocketService $wsService)
    {
        $this->wsService = $wsService;
    }

    public function announcement(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contract/announcement";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                AnnouncementEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function execution(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/execution";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                ExecutionEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function instrument(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contract/instrument";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                InstrumentEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function klines(
        string $symbol,
        string $type,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/limitCandle";

        $args = [implode("_", [$symbol, $type])];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                KlinesEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function orderbookIncrement(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/level2";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                OrderbookIncrementEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function orderbookLevel50(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/level2Depth50";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                OrderbookLevel50Event::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function orderbookLevel5(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/level2Depth5";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                OrderbookLevel5Event::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function symbolSnapshot(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/snapshot";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                SymbolSnapshotEvent::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function tickerV1(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/ticker";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                TickerV1Event::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function tickerV2(
        string $symbol,
        callable $onData,
        ?callable $onSuccess = null,
        ?callable $onError = null
    ): PromiseInterface {
        $topicPrefix = "/contractMarket/tickerV2";

        $args = [$symbol];

        return $this->wsService
            ->subscribe(
                $topicPrefix,
                $args,
                TickerV2Event::createCallback($onData)
            )
            ->then(
                function ($id) use ($onSuccess) {
                    if ($onSuccess) {
                        $onSuccess($id);
                    }
                    return $id;
                },
                function ($e) use ($onError) {
                    if ($onError) {
                        $onError($e);
                    }
                    throw $e;
                }
            );
    }

    public function unSubscribe(string $id): PromiseInterface
    {
        return $this->wsService->unsubscribe($id);
    }

    public function start(): PromiseInterface
    {
        return $this->wsService->start();
    }

    public function stop(): PromiseInterface
    {
        return $this->wsService->stop();
    }
}
