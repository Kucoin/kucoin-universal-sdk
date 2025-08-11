<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketClient;
use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketUnifiedService;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\UnifiedWsArgs;
use KuCoin\UniversalSDK\Model\UnifiedWsMessage;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use RuntimeException;

/**
 * Default implementation of the WebSocketUnifiedService interface.
 */
class DefaultWebSocketUnifiedService implements WebSocketUnifiedService
{
    /**
     * @var ClientOption
     */
    private $option;

    /**
     * @var WebSocketClient
     */
    private $client;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Map of request IDs to their corresponding promises
     * @var array<string, Deferred>
     */
    private $futureMap = [];

    /**
     * @param ClientOption $opt
     * @param LoopInterface $loop
     * @param string $sdkVersion
     */
    public function __construct(ClientOption $opt, LoopInterface $loop, string $sdkVersion)
    {
        if (empty($opt->unifiedWsEndpoint)) {
            throw new RuntimeException("Missing unified WebSocket endpoint");
        }

        $this->option = $opt->websocketClientOption;
        $this->serializer = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(new JsonSerializedHandler());
            })->build();

        $this->client = new DefaultWebSocketClient(
            new DefaultWebsocketUnifiedMetaProvider($opt, $this->serializer),
            $this->option,
            $loop
        );

        $this->client->on("event", function ($event, $msg) {
            $this->notifyEvent($event, $msg);
        });

        $this->client->on("message", function (UnifiedWsMessage $wsMessage) {
            $deferred = $this->futureMap[$wsMessage->id] ?? null;
            if ($deferred) {
                unset($this->futureMap[$wsMessage->id]);
                Logger::debug("Unified WebSocket API response received, id={$wsMessage->id}, op={$wsMessage->op}");
                try {
                    $deferred->resolve($wsMessage);
                } catch (Exception $e) {
                    Logger::error("Unified WebSocket API response processing failed, id={$wsMessage->id}, op={$wsMessage->op}", ['exception' => $e]);
                }
            }
        });

        $this->client->on("reconnected", function () {
            // No recovery needed for unified API; subscriptions are managed elsewhere
        });
    }

    /**
     * {@inheritdoc}
     */
    public function start(): PromiseInterface
    {
        return $this->client->start();
    }

    /**
     * {@inheritdoc}
     */
    public function stop(): PromiseInterface
    {
        return $this->client->stop();
    }

    /**
     * {@inheritdoc}
     */
    public function call(UnifiedWsArgs $args): PromiseInterface
    {
        // Ensure ID exists
        if (empty($args->id)) {
            $args->id = uniqid('', true);
        }

        // Ensure operation type is set
        if (empty($args->op)) {
            throw new RuntimeException("Missing required field: op");
        }

        $deferred = new Deferred();

        // Check for duplicate ID
        if (isset($this->futureMap[$args->id])) {
            throw new RuntimeException("Duplicate request id: " . $args->id);
        }

        $this->futureMap[$args->id] = $deferred;

        Logger::info("Calling unified WebSocket API, id={$args->id}, op={$args->op}");

        $this->client->write($args->id, $args, $this->option->writeTimeout)
            ->then(
                function () use ($args, $deferred) {
                    Logger::info("Unified WebSocket API call sent, id={$args->id}, op={$args->op}");
                },
                function ($ex) use ($args, $deferred) {
                    unset($this->futureMap[$args->id]);
                    Logger::error("Unified WebSocket API call failed, id={$args->id}, op={$args->op}", ['exception' => $ex]);
                    $deferred->reject($ex);
                }
            );

        return $deferred->promise();
    }

    /**
     * Notify event listeners of WebSocket events
     *
     * @param string $ev
     * @param string $msg
     */
    private function notifyEvent(string $ev, string $msg): void
    {
        if (isset($this->option->eventCallback)) {
            try {
                call_user_func($this->option->eventCallback, $ev, $msg);
            } catch (Exception $e) {
                Logger::error("Exception when notifying event", ['exception' => $e]);
            }
        }
    }
}