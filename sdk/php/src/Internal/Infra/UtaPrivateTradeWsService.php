<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\WebSocketClientOption;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use RuntimeException;

/** Direct authenticated UTA trading transport for uta.order, uta.cancel and uta.amend. */
class UtaPrivateTradeWsService
{
    private const ENDPOINT = 'wss://wsapi.kucoin.com/v1/private';

    /** @var ClientOption */
    private $clientOption;
    /** @var LoopInterface */
    private $loop;
    /** @var WebSocketClientOption */
    private $option;
    /** @var Connector */
    private $connector;
    /** @var WebSocket|null */
    private $connection;
    /** @var array */
    private $pending = [];
    /** @var bool */
    private $started = false;
    /** @var bool */
    private $connected = false;
    /** @var bool */
    private $shutdown = false;
    /** @var int */
    private $reconnectAttempts = 0;
    private $reconnectTimer;

    public function __construct(ClientOption $clientOption, LoopInterface $loop)
    {
        if (!$clientOption->key || !$clientOption->secret || !$clientOption->passphrase) {
            throw new \InvalidArgumentException('UTA private trade WebSocket requires key, secret, and passphrase');
        }
        $this->clientOption = $clientOption;
        $this->loop = $loop;
        $this->option = $clientOption->websocketClientOption ?: new WebSocketClientOption();
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
        if ($this->reconnectTimer) {
            $this->loop->cancelTimer($this->reconnectTimer);
            $this->reconnectTimer = null;
        }
        if ($this->connection) {
            $this->connection->close();
            $this->connection = null;
        }
        $this->rejectPending(new RuntimeException('UTA private trade WebSocket stopped'));
        return $this->resolved();
    }

    public function placeOrder(array $request): PromiseInterface
    {
        return $this->sendOperation('uta.order', $this->orderArgs($request));
    }

    public function cancelOrder(array $request): PromiseInterface
    {
        $this->requireOrderReference($request);
        return $this->sendOperation('uta.cancel', $this->withoutNulls($request));
    }

    public function amendOrder(array $request): PromiseInterface
    {
        $this->requireOrderReference($request);
        return $this->sendOperation('uta.amend', $this->withoutNulls($request));
    }

    private function dial(): PromiseInterface
    {
        $headers = (new KcSigner(
            $this->clientOption->key,
            $this->clientOption->secret,
            $this->clientOption->passphrase,
            $this->clientOption->brokerName,
            $this->clientOption->brokerPartner,
            $this->clientOption->brokerKey
        ))->headers('');
        $connectionSign = base64_encode(hash_hmac(
            'sha256',
            $headers['KC-API-KEY'] . $headers['KC-API-TIMESTAMP'],
            $this->clientOption->secret,
            true
        ));
        $endpoint = self::ENDPOINT . '?' . http_build_query([
            'apikey' => $headers['KC-API-KEY'],
            'timestamp' => $headers['KC-API-TIMESTAMP'],
            'sign' => $connectionSign,
            'passphrase' => $headers['KC-API-PASSPHRASE'],
        ], '', '&', PHP_QUERY_RFC3986);

        $deferred = new Deferred();
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
            $error ? $deferred->reject($error) : $deferred->resolve(null);
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
            return;
        }
        if ($this->isWelcome($message)) {
            $this->connected = true;
            $this->reconnectAttempts = 0;
            $dialFinish();
            return;
        }
        // The trade gateway sends a session challenge before welcome. Do not confuse the
        // subsequent {data:"welcome"} frame with a challenge.
        if (isset($message['sessionId'], $message['timestamp']) && !array_key_exists('data', $message)) {
            if (!$this->connection) {
                $dialFinish(new RuntimeException('UTA trade WebSocket is not connected'));
                return;
            }
            $this->connection->send(base64_encode(hash_hmac('sha256', $raw, $this->clientOption->secret, true)));
            return;
        }
        if (!isset($message['id'])) {
            return;
        }
        $id = (string)$message['id'];
        if (!isset($this->pending[$id])) {
            return;
        }
        $pending = $this->pending[$id];
        unset($this->pending[$id]);
        $this->loop->cancelTimer($pending['timer']);
        if ((string)($message['code'] ?? '') === '200000') {
            $pending['deferred']->resolve($message);
            return;
        }
        $pending['deferred']->reject(new RuntimeException(json_encode($message)));
    }

    private function sendOperation(string $operation, array $args): PromiseInterface
    {
        if (!$this->connected || !$this->connection) {
            return $this->rejected(new RuntimeException('UTA private trade WebSocket is not connected; call start() first'));
        }
        $id = $this->newId();
        $deferred = new Deferred();
        $timer = $this->loop->addTimer($this->option->writeTimeout, function () use ($id, $operation, $deferred) {
            if (!isset($this->pending[$id])) {
                return;
            }
            unset($this->pending[$id]);
            $deferred->reject(new RuntimeException($operation . ' response timed out'));
        });
        $this->pending[$id] = ['deferred' => $deferred, 'timer' => $timer];
        try {
            $this->connection->send(json_encode(['id' => $id, 'op' => $operation, 'args' => $args], JSON_PRESERVE_ZERO_FRACTION));
        } catch (\Throwable $error) {
            $this->loop->cancelTimer($timer);
            unset($this->pending[$id]);
            $deferred->reject($error);
        }
        return $deferred->promise();
    }

    private function handleDisconnect(string $reason, callable $dialFinish): void
    {
        $wasConnected = $this->connected;
        $this->connected = false;
        $this->rejectPending(new RuntimeException($reason));
        if (!$wasConnected) {
            $dialFinish(new RuntimeException($reason));
            return;
        }
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
            return;
        }
        $this->reconnectAttempts++;
        $this->reconnectTimer = $this->loop->addTimer($this->option->reconnectInterval, function () {
            $this->reconnectTimer = null;
            $this->dial()->then(null, function () { $this->reconnect(); });
        });
    }

    private function orderArgs(array $request): array
    {
        $args = $this->withoutNulls($request);
        // REST model defaults are invalid for WebSocket orders when the matching trigger price is absent.
        if (empty($args['tpTriggerPrice'])) {
            unset($args['tpTriggerPriceType']);
        }
        if (empty($args['slTriggerPrice'])) {
            unset($args['slTriggerPriceType']);
        }
        return $args;
    }

    private function requireOrderReference(array $request): void
    {
        if (empty($request['orderId']) && empty($request['clientOid'])) {
            throw new \InvalidArgumentException('Either orderId or clientOid must be provided');
        }
    }

    private function withoutNulls(array $values): array
    {
        return array_filter($values, function ($value) { return $value !== null; });
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

    private function rejectPending(\Throwable $error): void
    {
        foreach ($this->pending as $pending) {
            $this->loop->cancelTimer($pending['timer']);
            $pending['deferred']->reject($error);
        }
        $this->pending = [];
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
