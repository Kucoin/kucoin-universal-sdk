<?php

namespace KuCoin\UniversalSDK\Model;


/**
 * Configuration for WebSocket client behavior.
 */
class WebSocketClientOption
{
    /**
     * Enables automatic reconnection.
     * @var bool
     */
    public $reconnect = true;

    /**
     * Maximum number of reconnection attempts; -1 for unlimited.
     * @var int
     */
    public $reconnectAttempts = -1;

    /**
     * Interval between reconnection attempts (in seconds).
     * @var float
     */
    public $reconnectInterval = 5.0;

    /**
     * Timeout for connecting the WebSocket (in seconds).
     * @var float
     */
    public $dialTimeout = 10.0;

    /**
     * Timeout for sending messages (in seconds).
     * @var float
     */
    public $writeTimeout = 5.0;

    /**
     * Callback function to handle WebSocket events.
     * Signature: function(string $eventType, string $eventMessage): void
     * @see WebSocketEvent.php
     * @var callable|null
     */
    public $eventCallback = null;

    public function __construct()
    {
    }
}
