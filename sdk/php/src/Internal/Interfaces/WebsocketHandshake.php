<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

use Ratchet\Client\WebSocket;

/**
 * Interface defining the contract for a WebSocket handshake process.
 */
interface WebsocketHandshake
{
    /**
     * Invokes a specific action with the given text and WebSocket instance.
     * 
     * @param WebSocket $socket The WebSocket connection
     * @param string $text The message text received
     * @throws \Exception If the handshake process fails
     */
    public function invoke(WebSocket $socket, string $text): void;
}