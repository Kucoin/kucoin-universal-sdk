<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Evenement\EventEmitterTrait;
use Exception;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketClient;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketMetaProvider;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\WebSocketClientOption;
use KuCoin\UniversalSDK\Model\WebSocketEvent;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use RuntimeException;
use Throwable;

class DefaultWebSocketClient implements WebSocketClient
{
    use EventEmitterTrait;

    /**
     * Connection State
     */
    const STATE_DISCONNECTED = 0;
    const STATE_CONNECTING = 1;
    const STATE_CONNECTED = 2;
    private $state;
    /**
     * @var LoopInterface $loop
     */
    private $loop;
    /**
     * @var Connector $connector
     */
    private $connector;
    /**
     * @var WebSocket $conn
     */
    private $conn;
    /**
     * @var string $url
     */
    private $url;
    /**
     * @var WebSocketClientOption $options
     */
    private $options;
    /**
     * @var WebsocketMetaProvider
     */
    private $metaProvider;
    private $reconnectAttempts = 0;
    private $ackMap = [];
    private $serializer;
    private $keepAliveTimer;
    private $shutdown = false;
    private $reconnecting = false;


    public function __construct(WebsocketMetaProvider $metaProvider, WebSocketClientOption $options, LoopInterface $loop)
    {
        $this->loop = $loop;
        $this->connector = new Connector($this->loop);
        $this->options = $options;
        $this->state = self::STATE_DISCONNECTED;
        $this->serializer = SerializerBuilder::create()->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(new JsonSerializedHandler());
            })->build();
        $this->metaProvider = $metaProvider;
    }

    public function start(): PromiseInterface
    {
        if ($this->state !== self::STATE_DISCONNECTED) {
            Logger::warn('WebSocket already started');
            $deferred = new Deferred();
            $deferred->resolve(null);
            return $deferred->promise();
        }

        if ($this->keepAliveTimer) {
            $this->loop->cancelTimer($this->keepAliveTimer);
            $this->keepAliveTimer = null;
        }

        $this->state = self::STATE_CONNECTING;
        Logger::info('Dialing WebSocket');
        return $this->dial()->then(function () {
            $this->state = self::STATE_CONNECTED;
            $this->startHeartbeat();
            Logger::info('WebSocket connected');
            $this->emit('event', [WebSocketEvent::EVENT_CONNECTED, '']);
        }, function ($exception) {
            $this->state = self::STATE_DISCONNECTED;
            Logger::error('WebSocket connection failed', ['error' => $exception]);
            throw $exception;
        });
    }

    private function dial(): PromiseInterface
    {
        $deferred = new Deferred();
        $dailTimer = null;
        try {
            $this->url = $this->metaProvider->buildUri();
            Logger::info('Connecting to WebSocket endpoint', ['url' => $this->url]);

            $dailTimer = $this->loop->addTimer($this->options->dialTimeout, function () use ($deferred) {
                Logger::error('Dial timeout');
                $deferred->reject(new RuntimeException("wait server response timed out"));
            });
            $this->connector->__invoke($this->url)->then(
                function (WebSocket $conn) use ($deferred, $dailTimer) {
                    $this->conn = $conn;
                    $this->reconnectAttempts = 0;
                    Logger::info('WebSocket handshake started');

                    // Get handshakes from metaProvider
                    $handshakes = $this->metaProvider->handshakes();
                    $bootstrap = new WebSocketBootstrap($handshakes, [$this, 'handleMessage']);

                    $conn->on('message', function ($message) use ($conn, $bootstrap) {
                        $bootstrap->onMessage($conn, $message);
                    });

                    // Set up the bootstrap ready promise
                    $bootstrap->getReadyPromise()->then(
                        function () use ($deferred, $dailTimer, $conn) {
                            $this->loop->cancelTimer($dailTimer);
                            Logger::info('Handshake successful');
                            $deferred->resolve(null);
                        },
                        function ($error) use ($deferred, $dailTimer) {
                            $this->loop->cancelTimer($dailTimer);
                            Logger::error('Handshake failed', ['reason' => $error]);
                            $deferred->reject(new RuntimeException("Handshake failed: " . $error));
                        }
                    );

                    $conn->on('close', function ($code = null, $reason = null) {
                        $this->onClose($code, $reason);
                    });
                },
                function (Exception $e) use ($deferred, $dailTimer) {
                    $this->loop->cancelTimer($dailTimer);
                    Logger::error('Connection error', ['error' => $e->getMessage()]);
                    $deferred->reject($e);
                }
            );
        } catch (Exception $exception) {
            if ($dailTimer) {
                $this->loop->cancelTimer($dailTimer);
            }
            $deferred->reject($exception);
        }
        return $deferred->promise();
    }

    /**
     * Handle incoming WebSocket messages
     *
     * @param string $text
     */
    public function handleMessage(string $text): void
    {
        try {
            $parsedMessage = $this->metaProvider->parseMessage($text);

            switch ($parsedMessage->getType()) {
                case Constants::WS_MESSAGE_TYPE_WELCOME:
                    Logger::info("Received welcome message");
                    break;

                case Constants::WS_MESSAGE_TYPE_MESSAGE:
                    $this->emit('message', [$parsedMessage->getMessage()]);
                    if ($parsedMessage->isAck()) {
                        $this->handleAck($parsedMessage->getId(), null);
                    }
                    break;

                case Constants::WS_MESSAGE_TYPE_PONG:
                case Constants::WS_MESSAGE_TYPE_ACK:
                    $this->handleAck($parsedMessage->getId(), null);
                    break;

                case Constants::WS_MESSAGE_TYPE_ERROR:
                    $this->handleAck($parsedMessage->getId(), new Exception((string)$parsedMessage->getMessage()));
                    break;

                default:
                    Logger::warn("Unknown WebSocket message type: " . $parsedMessage->getType());
            }
        } catch (Exception $e) {
            Logger::error("Error handling WebSocket message", ['exception' => $e]);
        }
    }

    private function onClose($code, $reason)
    {
        Logger::warn('Connection closed', ['code' => $code, 'reason' => $reason]);

        $this->state = self::STATE_DISCONNECTED;

        if (!$this->shutdown && $this->options->reconnect) {
            $this->emit('event', [WebSocketEvent::EVENT_TRY_RECONNECT, '']);
            $this->reconnect();
        }
    }

    private function reconnect(): PromiseInterface
    {
        if ($this->reconnecting || $this->shutdown) {
            Logger::warn('Skip reconnect: already reconnecting or shutdown');
            $deferred = new Deferred();
            $deferred->resolve(null);
            return $deferred->promise();
        }

        $this->reconnecting = true;
        $maxAttempts = $this->options->reconnectAttempts < 0 ? PHP_INT_MAX : $this->options->reconnectAttempts;
        $interval = $this->options->reconnectInterval;

        Logger::info('Begin reconnect attempts', ['maxAttempts' => $maxAttempts]);

        $deferred = new Deferred();
        $attempt = 0;

        $tryReconnect = function () use (&$attempt, $maxAttempts, $interval, $deferred, &$tryReconnect) {
            if ($this->shutdown) {
                Logger::warn('Stop reconnect: client is shutdown');
                $deferred->resolve(null);
                $this->reconnecting = false;
                return;
            }

            if ($attempt >= $maxAttempts) {
                Logger::error('Reconnect failed after max attempts');
                $this->emit('event', [WebSocketEvent::EVENT_CLIENT_FAIL, 'Failed to reconnect after all attempts']);
                $deferred->reject(new RuntimeException('Reconnect failed'));
                $this->reconnecting = false;
                return;
            }

            $attempt++;
            Logger::info("Reconnect attempt {$attempt}/{$maxAttempts}");

            $this->close()->then(function () use ($interval, $deferred, $tryReconnect) {
                $this->loop->addTimer($interval, function () use ($deferred, $tryReconnect) {
                    $this->start()->then(function () use ($deferred) {
                        Logger::info('Reconnect successful');
                        $this->emit('reconnected', []);
                        $deferred->resolve(null);
                        $this->reconnecting = false;
                    }, function ($e) use ($tryReconnect) {
                        Logger::error('Reconnect failed, will retry', ['error' => $e]);
                        $tryReconnect(); // Retry
                    });
                });
            });
        };

        $tryReconnect();

        return $deferred->promise();
    }


    private function startHeartbeat()
    {
        $interval = $this->metaProvider->pingInterval() / 1000; // Convert to seconds
        $timeout = $this->metaProvider->pingTimeout() / 1000;   // Convert to seconds

        $this->keepAliveTimer = $this->loop->addPeriodicTimer($interval, function () use ($timeout) {
            if ($this->state == self::STATE_CONNECTED) {
                list($id, $pingMessage) = $this->metaProvider->pingMessage();
                $this->write($id, $pingMessage, $timeout)
                    ->then(function () {
                        Logger::info('Ping acknowledged');
                    })
                    ->catch(function ($e) {
                        Logger::warn('Ping failed', ['error' => $e]);
                    });
            }
        });
    }

    public function stop(): PromiseInterface
    {
        Logger::info('Shutting down WebSocket client...');
        $this->shutdown = true;

        return $this->close()->then(function () {
            $this->emit('event', [WebSocketEvent::EVENT_CLIENT_SHUTDOWN, '']);
        });
    }

    public function close(): PromiseInterface
    {
        Logger::info('Closing WebSocket client...');
        $this->reconnecting = false;

        if ($this->keepAliveTimer) {
            $this->loop->cancelTimer($this->keepAliveTimer);
            $this->keepAliveTimer = null;
        }

        foreach ($this->ackMap as $id => $entry) {
            $this->loop->cancelTimer($entry['timer']);
            $entry['deferred']->reject(new RuntimeException("Connection closed before ack received: $id"));
        }
        $this->ackMap = [];
        $this->state = self::STATE_DISCONNECTED;

        $this->emit('event', [WebSocketEvent::EVENT_DISCONNECTED, '']);

        if ($this->conn) {
            try {
                $this->conn->close();
            } catch (Throwable $e) {
                Logger::warn('Close connection failed', ['error' => $e]);
            }
            $this->conn = null;
        }

        $deferred = new Deferred();
        $deferred->resolve(null);
        return $deferred->promise();
    }


    public function write(string $id, $message, int $timeout): PromiseInterface
    {
        $deferred = new Deferred();
        if ($this->state !== self::STATE_CONNECTED) {
            $deferred->reject(new RuntimeException("WebSocket server is not connected"));
            return $deferred->promise();
        }

        $timer = $this->loop->addTimer($timeout, function () use ($id, $message, $deferred) {
            if (isset($this->ackMap[$id])) {
                unset($this->ackMap[$id]);
                Logger::error('Ack timeout', ['id' => $id]);
                $deferred->reject(new Exception("Ack timeout for {$id}"));
            }
        });
        $this->ackMap[$id] = ['deferred' => $deferred, 'timer' => $timer];

        try {
            $this->conn->send($message->jsonSerialize($this->serializer));
        } catch (Throwable $e) {
            unset($this->ackMap[$id]);
            Logger::error('Send failed', ['id' => $id, 'error' => $e]);
            $this->loop->cancelTimer($timer);
            $deferred->reject($e);
        }

        return $deferred->promise();
    }

    private function handleAck($id, $err)
    {
        if (isset($this->ackMap[$id])) {
            $entry = $this->ackMap[$id];
            $this->loop->cancelTimer($entry['timer']);
            unset($this->ackMap[$id]);

            if ($err) {
                Logger::warn('Ack rejected', ['id' => $id, 'error' => $err]);
                $entry['deferred']->reject($err);
            } else {
                Logger::debug('Ack resolved', ['id' => $id]);
                $entry['deferred']->resolve(null);
            }
        } else {
            Logger::warn('Unknown ack id', ['id' => $id]);
        }
    }
}
