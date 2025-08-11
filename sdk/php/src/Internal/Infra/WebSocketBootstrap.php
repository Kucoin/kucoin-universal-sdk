<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketHandshake;
use Ratchet\Client\WebSocket;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;

/**
 * WebSocketBootstrap is a utility class designed to facilitate the setup and management of
 * WebSocket connections, particularly focusing on the handshake process and message handling.
 * It ensures that the connection is only considered ready after all handshakes are completed successfully.
 */
class WebSocketBootstrap
{
    /**
     * Promise that resolves when the WebSocket connection is ready
     * @var Deferred
     */
    private $readyDeferred;

    /**
     * Callback function to handle messages after handshake is complete
     * @var callable
     */
    private $messageHandler;

    /**
     * Flag indicating if the connection is established and handshake is complete
     * @var bool
     */
    private $connected = false;

    /**
     * Iterator for handshake steps
     * @var array
     */
    private $handshakes = [];

    /**
     * Current position in the handshake sequence
     * @var int
     */
    private $handshakePosition = 0;

    /**
     * @param WebsocketHandshake[] $handshakes List of handshake handlers
     * @param callable $messageHandler Function to handle messages after handshake
     */
    public function __construct(array $handshakes, callable $messageHandler)
    {
        $this->handshakes = $handshakes;
        $this->messageHandler = $messageHandler;
        $this->readyDeferred = new Deferred();
    }

    /**
     * Get a promise that resolves when the WebSocket connection is ready
     * 
     * @return PromiseInterface
     */
    public function getReadyPromise(): PromiseInterface
    {
        return $this->readyDeferred->promise();
    }

    /**
     * Handle incoming WebSocket messages
     * 
     * @param WebSocket $socket The WebSocket connection
     * @param string $text The message text
     */
    public function onMessage(WebSocket $socket, string $text): void
    {
        if ($this->connected) {
            call_user_func($this->messageHandler, $text);
            return;
        }

        try {
            if ($this->handshakePosition < count($this->handshakes)) {
                $currentHandshake = $this->handshakes[$this->handshakePosition];
                $currentHandshake->invoke($socket, $text);
                $this->handshakePosition++;

                if ($this->handshakePosition >= count($this->handshakes)) {
                    $this->connected = true;
                    Logger::info('WebSocket handshake completed successfully');
                    $this->readyDeferred->resolve(null);
                }
            }
        } catch (Exception $e) {
            Logger::error('Error in WebSocketBootstrap: ' . $e->getMessage());
            $this->readyDeferred->reject($e);
        }
    }
}