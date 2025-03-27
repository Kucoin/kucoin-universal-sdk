<?php

namespace KuCoin\UniversalSDK\Model;


/**
 * Class WebSocketClientOption
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
     * Buffer size for reading messages.
     * @var int
     */
    public $readMessageBuffer = 1024;

    /**
     * Buffer size for writing messages.
     * @var int
     */
    public $writeMessageBuffer = 256;

    /**
     * Timeout for sending messages (in seconds).
     * @var float
     */
    public $writeTimeout = 5.0;

    /**
     * Callback function to handle WebSocket events.
     * Signature: function(string $eventType, string $eventData, string $eventMessage): void
     *
     * @var callable|null
     */
    public $eventCallback = null;

    public function __construct()
    {
    }
}

/**
 * Class WebSocketClientOptionBuilder
 * Fluent builder for WebSocketClientOption.
 */
class WebSocketClientOptionBuilder
{
    /**
     * @var WebSocketClientOption
     */
    private $option;

    public function __construct()
    {
        $this->option = new WebSocketClientOption();
    }

    /**
     * @param bool $reconnect
     * @return $this
     */
    public function withReconnect($reconnect)
    {
        $this->option->reconnect = $reconnect;
        return $this;
    }

    /**
     * @param int $attempts
     * @return $this
     */
    public function withReconnectAttempts($attempts)
    {
        $this->option->reconnectAttempts = $attempts;
        return $this;
    }

    /**
     * @param float $interval
     * @return $this
     */
    public function withReconnectInterval($interval)
    {
        $this->option->reconnectInterval = $interval;
        return $this;
    }

    /**
     * @param float $timeout
     * @return $this
     */
    public function withDialTimeout($timeout)
    {
        $this->option->dialTimeout = $timeout;
        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function withReadMessageBuffer($size)
    {
        $this->option->readMessageBuffer = $size;
        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function withWriteMessageBuffer($size)
    {
        $this->option->writeMessageBuffer = $size;
        return $this;
    }

    /**
     * @param float $timeout
     * @return $this
     */
    public function withWriteTimeout($timeout)
    {
        $this->option->writeTimeout = $timeout;
        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function withEventCallback($callback)
    {
        $this->option->eventCallback = $callback;
        return $this;
    }

    /**
     * Finalizes the configuration and returns the WebSocketClientOption instance.
     *
     * @return WebSocketClientOption
     */
    public function build()
    {
        return $this->option;
    }
}
