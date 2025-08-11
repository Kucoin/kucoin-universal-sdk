<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

/**
 * Interface providing the necessary methods for managing WebSocket connections,
 * including handshakes, URI construction, and ping settings.
 */
interface WebsocketMetaProvider
{
    /**
     * Retrieves a list of WebSocket handshakes that are used to establish and manage WebSocket connections.
     * 
     * @return WebsocketHandshake[] List of handshake handlers
     */
    public function handshakes(): array;

    /**
     * Parses an incoming WebSocket message and returns a structured representation.
     * 
     * @param string $text The raw message text
     * @return WsParsedMessage The parsed message
     * @throws \Exception If parsing fails
     */
    public function parseMessage(string $text): WsParsedMessage;

    /**
     * Constructs and returns the URI for establishing a WebSocket connection.
     * 
     * @return string The WebSocket URI
     */
    public function buildUri(): string;

    /**
     * Returns the recommended ping interval in milliseconds for the WebSocket connection.
     * 
     * @return int Ping interval in milliseconds
     */
    public function pingInterval(): int;

    /**
     * Returns the timeout in milliseconds for a ping to be considered as failed.
     * 
     * @return int Ping timeout in milliseconds
     */
    public function pingTimeout(): int;

    /**
     * Retrieves the message to be used for pinging the WebSocket server.
     * 
     * @return array{0: string, 1: mixed} A pair containing the message ID and the message object
     */
    public function pingMessage(): array;

    /**
     * Closes the WebSocket meta provider, releasing any resources held by it.
     */
    public function close(): void;
}