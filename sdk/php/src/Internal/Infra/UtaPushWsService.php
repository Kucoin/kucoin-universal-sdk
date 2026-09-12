<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\WebSocketClientOption;
use KuCoin\UniversalSDK\Model\WebSocketEvent;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use RuntimeException;

/** Direct UTA public/private push WebSocket transport (not the legacy bullet-token protocol). */
class UtaPushWsService
{
    private const PUBLIC_ENDPOINTS = [
        'SPOT' => 'wss://x-push-spot.kucoin.com',
        'FUTURES' => 'wss://x-push-futures.kucoin.com',
    ];
    private const PRIVATE_ENDPOINT = 'wss://wsapi-push.kucoin.com';
    private const AUTH_PLAINTEXT = 'POST/api/websocket/users/verify';

    /** @var ClientOption */
    private $clientOption;
    /** @var LoopInterface */
    private $loop;
    /** @var WebSocketClientOption */
    private $option;
    /** @var bool */
    private $privateChannel;
    /** @var string|null */
    private $tradeType;
    /** @var KcSigner|null */
    private $signer;
    /** @var Connector */
    private $connector;
    /** @var WebSocket|null */
    private $connection;
    /** @var array */
    private $subscriptions = [];
    /** @var array */
    private $pendingAcks = [];
    /** @var bool */
    private $started = false;
    /** @var bool */
    private $connected = false;
    /** @var bool */
    private $shutdown = false;
    /** @var int */
    private $reconnectAttempts = 0;
    private $reconnectTimer;
    private $pingTimer;
    private $pongTimer;
    private $pendingPingId;
    private $pingInterval = 18.0;
    private $pingTimeout = 10.0;

    public function __construct(ClientOption $clientOption, LoopInterface $loop, bool $privateChannel, ?string $tradeType = null)
    {
        $this->clientOption = $clientOption;
        $this->loop = $loop;
        $this->option = $clientOption->websocketClientOption ?: new WebSocketClientOption();
        $this->privateChannel = $privateChannel;
        $this->tradeType = $tradeType === null ? null : strtoupper($tradeType);
        if (!$privateChannel && !isset(self::PUBLIC_ENDPOINTS[$this->tradeType])) {
            throw new \InvalidArgumentException('UTA public WebSocket tradeType must be SPOT or FUTURES');
        }
        if ($privateChannel) {
            if (!$clientOption->key || !$clientOption->secret || !$clientOption->passphrase) {
                throw new \InvalidArgumentException('UTA private WebSocket requires key, secret, and passphrase');
            }
            $this->signer = new KcSigner(
                $clientOption->key,
                $clientOption->secret,
                $clientOption->passphrase,
                $clientOption->brokerName,
                $clientOption->brokerPartner,
                $clientOption->brokerKey
            );
        }
        $this->connector = new Connector($loop);
    }

    public function start(): PromiseInterface
    {
        if ($this->connected) {
            return $this->resolved();
        }
        $this->started = true;
        $this->shutdown = false;
        return $this->dial();
    }

    public function stop(): PromiseInterface
    {
        $this->started = false;
        $this->shutdown = true;
        $this->connected = false;
        $this->clearTimers();
        $this->rejectPending(new RuntimeException('UTA WebSocket stopped'));
        if ($this->connection) {
            $this->connection->close();
            $this->connection = null;
        }
        $this->notify(WebSocketEvent::EVENT_CLIENT_SHUTDOWN, $this->privateChannel ? 'UTA_PRIVATE' : 'UTA_PUBLIC');
        return $this->resolved();
    }

    /** @param array{channel:string,callback:callable,symbol?:string,symbols?:array,tradeType?:string,accountType?:string,parameters?:array,includeTradeType?:bool} $subscription */
    public function subscribe(array $subscription): PromiseInterface
    {
        if (!$this->connected) {
            return $this->rejected(new RuntimeException('UTA WebSocket is not connected; call start() first'));
        }
        $this->validateSubscription($subscription);
        $id = $this->newId();
        $this->subscriptions[$id] = $subscription;

        return $this->sendSubscription($id, 'SUBSCRIBE', $subscription)->then(
            function () use ($id) { return $id; },
            function ($error) use ($id) {
                unset($this->subscriptions[$id]);
                throw $error;
            }
        );
    }

    public function unsubscribe(string $id): PromiseInterface
    {
        if (!isset($this->subscriptions[$id])) {
            return $this->rejected(new \InvalidArgumentException('Unknown UTA subscription: ' . $id));
        }
        $subscription = $this->subscriptions[$id];
        if (!$this->connected) {
            unset($this->subscriptions[$id]);
            return $this->resolved();
        }
        return $this->sendSubscription($id, 'UNSUBSCRIBE', $subscription)->then(function () use ($id) {
            unset($this->subscriptions[$id]);
        });
    }

    private function dial(): PromiseInterface
    {
        $deferred = new Deferred();
        $endpoint = $this->privateChannel ? self::PRIVATE_ENDPOINT : self::PUBLIC_ENDPOINTS[$this->tradeType];
        $settled = false;
        $timeout = $this->loop->addTimer($this->option->dialTimeout, function () use (&$settled, $deferred) {
            if ($settled) {
                return;
            }
            $settled = true;
            $deferred->reject(new RuntimeException('welcome not received before dial timeout'));
            if ($this->connection) {
                $this->connection->close();
            }
        });
        $finish = function ($error = null) use (&$settled, $timeout, $deferred) {
            if ($settled) {
                return;
            }
            $settled = true;
            $this->loop->cancelTimer($timeout);
            if ($error) {
                $deferred->reject($error);
            } else {
                $deferred->resolve(null);
            }
        };

        ($this->connector)($endpoint)->then(
            function (WebSocket $connection) use ($finish) {
                $this->connection = $connection;
                $connection->on('message', function ($raw) use ($finish) {
                    $this->handleMessage((string)$raw, $finish);
                });
                $connection->on('close', function ($code = null, $reason = null) use ($finish) {
                    $this->handleDisconnect('closed ' . $code . ': ' . $reason, $finish);
                });
            },
            function ($error) use ($finish) {
                $finish($error instanceof \Throwable ? $error : new RuntimeException((string)$error));
            }
        );
        return $deferred->promise();
    }

    private function handleMessage(string $raw, callable $dialFinish): void
    {
        $message = json_decode($raw, true);
        if (!is_array($message)) {
            $this->notify(WebSocketEvent::EVENT_ERROR_RECEIVED, 'Invalid UTA WebSocket JSON');
            return;
        }
        if ($this->isWelcome($message)) {
            $this->pingInterval = $this->positiveSeconds($message['pingInterval'] ?? null, 18.0);
            $this->pingTimeout = $this->positiveSeconds($message['pingTimeout'] ?? null, 10.0);
            if ($this->privateChannel) {
                $this->authenticate()->then(
                    function () use ($dialFinish) { $this->markConnected($dialFinish); },
                    function ($error) use ($dialFinish) { $dialFinish($error); }
                );
            } else {
                $this->markConnected($dialFinish);
            }
            return;
        }
        if (strtolower((string)($message['op'] ?? '')) === 'pong' || strtolower((string)($message['type'] ?? '')) === 'pong') {
            $this->pendingPingId = null;
            if ($this->pongTimer) {
                $this->loop->cancelTimer($this->pongTimer);
                $this->pongTimer = null;
            }
            $this->notify(WebSocketEvent::EVENT_PONG_RECEIVED, $raw);
            return;
        }
        if (isset($message['id']) && array_key_exists('result', $message)) {
            $this->resolveAck((string)$message['id'], $message);
            return;
        }
        if (isset($message['T']) && array_key_exists('d', $message)) {
            $this->notify(WebSocketEvent::EVENT_MESSAGE_RECEIVED, $raw);
            $this->dispatch($message);
        }
    }

    private function markConnected(callable $dialFinish): void
    {
        $this->connected = true;
        $this->reconnectAttempts = 0;
        $this->schedulePing();
        $this->notify(WebSocketEvent::EVENT_CONNECTED, $this->privateChannel ? 'UTA_PRIVATE' : 'UTA_PUBLIC');
        $dialFinish();
    }

    private function authenticate(): PromiseInterface
    {
        $headers = $this->signer->headers(self::AUTH_PLAINTEXT);
        return $this->sendAndAwaitAck($this->newId(), [
            'op' => 'auth',
            'kc-api-key' => $headers['KC-API-KEY'],
            'kc-api-sign' => $headers['KC-API-SIGN'],
            'kc-api-timestamp' => $headers['KC-API-TIMESTAMP'],
            'kc-api-passphrase' => $headers['KC-API-PASSPHRASE'],
        ]);
    }

    private function sendSubscription(string $id, string $action, array $subscription): PromiseInterface
    {
        $message = ['action' => $action, 'channel' => $subscription['channel']];
        if (!empty($subscription['includeTradeType']) && !empty($subscription['tradeType'])) {
            $message['tradeType'] = $subscription['tradeType'];
        }
        if (!empty($subscription['accountType'])) {
            $message['accountType'] = $subscription['accountType'];
        }
        if (!empty($subscription['symbol'])) {
            $message['symbol'] = $subscription['symbol'];
        } elseif (!empty($subscription['symbols'])) {
            $symbols = array_values($subscription['symbols']);
            if (count($symbols) === 1) {
                $message['symbol'] = $symbols[0];
            } else {
                $message['symbols'] = $symbols;
            }
        }
        if (!empty($subscription['parameters'])) {
            foreach ($subscription['parameters'] as $key => $value) {
                $message[$key] = $value;
            }
        }
        return $this->sendAndAwaitAck($id, $message);
    }

    private function sendAndAwaitAck(string $id, array $message): PromiseInterface
    {
        if (!$this->connection) {
            return $this->rejected(new RuntimeException('UTA WebSocket is not open'));
        }
        $deferred = new Deferred();
        $timer = $this->loop->addTimer($this->option->writeTimeout, function () use ($id, $deferred) {
            if (!isset($this->pendingAcks[$id])) {
                return;
            }
            unset($this->pendingAcks[$id]);
            $deferred->reject(new RuntimeException('UTA WebSocket request timed out: ' . $id));
        });
        $this->pendingAcks[$id] = ['deferred' => $deferred, 'timer' => $timer];
        try {
            $this->connection->send(json_encode(array_merge(['id' => $id], $message), JSON_PRESERVE_ZERO_FRACTION));
        } catch (\Throwable $error) {
            $this->loop->cancelTimer($timer);
            unset($this->pendingAcks[$id]);
            $deferred->reject($error);
        }
        return $deferred->promise();
    }

    private function resolveAck(string $id, array $message): void
    {
        if (!isset($this->pendingAcks[$id])) {
            return;
        }
        $pending = $this->pendingAcks[$id];
        unset($this->pendingAcks[$id]);
        $this->loop->cancelTimer($pending['timer']);
        if ($message['result'] === true || $message['result'] === 'true') {
            $pending['deferred']->resolve(null);
            return;
        }
        $pending['deferred']->reject(new RuntimeException(json_encode($message)));
    }

    private function dispatch(array $event): void
    {
        $topic = (string)$event['T'];
        $channel = strpos($topic, 'execution.lite.') === 0 ? 'execution.lite' : explode('.', $topic)[0];
        foreach ($this->subscriptions as $subscription) {
            if (!$this->matches($subscription, $channel, $topic, $event)) {
                continue;
            }
            try {
                call_user_func($subscription['callback'], $event);
            } catch (\Throwable $error) {
                $this->notify(WebSocketEvent::EVENT_CALLBACK_ERROR, $error->getMessage());
            }
        }
    }

    private function matches(array $subscription, string $channel, string $topic, array $event): bool
    {
        $expectedChannel = $subscription['channel'];
        if ($expectedChannel !== $channel
            && !($expectedChannel === 'orderAll' && $channel === 'order')
            && !($expectedChannel === 'positionAll' && $channel === 'position')) {
            return false;
        }
        if (!empty($subscription['accountType']) && $topic !== 'balance.' . $subscription['accountType']) {
            return false;
        }
        $symbols = !empty($subscription['symbol'])
            ? [$subscription['symbol']]
            : ($subscription['symbols'] ?? []);
        if (!$symbols) {
            return true;
        }
        $symbol = is_array($event['d']) ? ($event['d']['s'] ?? null) : null;
        return $symbol !== null && in_array((string)$symbol, $symbols, true);
    }

    private function handleDisconnect(string $reason, callable $dialFinish): void
    {
        $wasConnected = $this->connected;
        $this->connected = false;
        $this->clearPingTimers();
        $this->rejectPending(new RuntimeException($reason));
        if (!$wasConnected) {
            $dialFinish(new RuntimeException($reason));
            return;
        }
        $this->notify(WebSocketEvent::EVENT_DISCONNECTED, $reason);
        if ($this->started && !$this->shutdown && $this->option->reconnect) {
            $this->reconnect();
        }
    }

    private function reconnect(): void
    {
        if ($this->reconnectTimer) {
            return;
        }
        if ($this->option->reconnectAttempts >= 0 && $this->reconnectAttempts >= $this->option->reconnectAttempts) {
            $this->notify(WebSocketEvent::EVENT_CLIENT_FAIL, 'maximum reconnect attempts exceeded');
            return;
        }
        $this->reconnectAttempts++;
        $this->notify(WebSocketEvent::EVENT_TRY_RECONNECT, 'attempt ' . $this->reconnectAttempts);
        $this->reconnectTimer = $this->loop->addTimer($this->option->reconnectInterval, function () {
            $this->reconnectTimer = null;
            $this->dial()->then(function () {
                $promises = [];
                foreach ($this->subscriptions as $id => $subscription) {
                    $promises[] = $this->sendSubscription($id, 'SUBSCRIBE', $subscription);
                }
                foreach ($promises as $promise) {
                    $promise->then(null, function ($error) {
                        $this->notify(WebSocketEvent::EVENT_RE_SUBSCRIBE_ERROR, (string)$error);
                    });
                }
                $this->notify(WebSocketEvent::EVENT_RE_SUBSCRIBE_OK, 'UTA subscriptions');
            }, function ($error) {
                $this->notify(WebSocketEvent::EVENT_RE_SUBSCRIBE_ERROR, (string)$error);
                $this->reconnect();
            });
        });
    }

    private function schedulePing(): void
    {
        $this->clearPingTimers();
        $this->pingTimer = $this->loop->addPeriodicTimer($this->pingInterval, function () {
            if (!$this->connected || !$this->connection) {
                return;
            }
            if ($this->pendingPingId !== null) {
                $this->connection->close();
                return;
            }
            $id = $this->newId();
            $this->pendingPingId = $id;
            $this->connection->send(json_encode(['id' => $id, 'op' => 'ping', 'timestamp' => (int)(microtime(true) * 1000)]));
            $this->pongTimer = $this->loop->addTimer($this->pingTimeout, function () use ($id) {
                if ($this->pendingPingId === $id && $this->connection) {
                    $this->connection->close();
                }
            });
        });
    }

    private function validateSubscription(array $subscription): void
    {
        if (empty($subscription['channel']) || empty($subscription['callback']) || !is_callable($subscription['callback'])) {
            throw new \InvalidArgumentException('UTA subscription requires channel and callback');
        }
        $withoutSymbol = ['funding-fee-all-symbols', 'execution', 'execution.lite', 'orderAll', 'balance', 'positionAll', 'leverage', 'lw'];
        if (empty($subscription['symbol']) && empty($subscription['symbols']) && !in_array($subscription['channel'], $withoutSymbol, true)) {
            throw new \InvalidArgumentException($subscription['channel'] . ' requires a symbol or symbols');
        }
    }

    private function isWelcome(array $message): bool
    {
        foreach (['data', 'message', 'op', 'type'] as $field) {
            if (isset($message[$field]) && is_scalar($message[$field]) && strtolower((string)$message[$field]) === 'welcome') {
                return true;
            }
        }
        return false;
    }

    private function positiveSeconds($milliseconds, float $fallback): float
    {
        if (!is_numeric($milliseconds) || (float)$milliseconds <= 0) {
            return $fallback;
        }
        return max(1.0, ((float)$milliseconds) / 1000.0);
    }

    private function clearPingTimers(): void
    {
        foreach (['pingTimer', 'pongTimer'] as $property) {
            if ($this->$property) {
                $this->loop->cancelTimer($this->$property);
                $this->$property = null;
            }
        }
        $this->pendingPingId = null;
    }

    private function clearTimers(): void
    {
        $this->clearPingTimers();
        if ($this->reconnectTimer) {
            $this->loop->cancelTimer($this->reconnectTimer);
            $this->reconnectTimer = null;
        }
    }

    private function rejectPending(\Throwable $error): void
    {
        foreach ($this->pendingAcks as $pending) {
            $this->loop->cancelTimer($pending['timer']);
            $pending['deferred']->reject($error);
        }
        $this->pendingAcks = [];
    }

    private function notify(string $event, string $message): void
    {
        if (!$this->option->eventCallback) {
            return;
        }
        try {
            call_user_func($this->option->eventCallback, $event, $message);
        } catch (\Throwable $error) {
            Logger::warn('UTA WebSocket event callback failed', ['error' => $error->getMessage()]);
        }
    }

    private function newId(): string
    {
        try {
            return bin2hex(random_bytes(16));
        } catch (\Throwable $error) {
            return uniqid('uta_', true);
        }
    }

    private function resolved(): PromiseInterface
    {
        $deferred = new Deferred();
        $deferred->resolve(null);
        return $deferred->promise();
    }

    private function rejected(\Throwable $error): PromiseInterface
    {
        $deferred = new Deferred();
        $deferred->reject($error);
        return $deferred->promise();
    }
}
