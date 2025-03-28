<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Builder pattern for constructing WebSocketClientOption instances.
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
     * Enable or disable automatic reconnection.
     *
     * @param bool $reconnect
     * @return self
     */
    public function setReconnect(bool $reconnect): self
    {
        $this->option->reconnect = $reconnect;
        return $this;
    }

    /**
     * Set the maximum number of reconnection attempts. Use -1 for unlimited.
     *
     * @param int $attempts
     * @return self
     */
    public function setReconnectAttempts(int $attempts): self
    {
        $this->option->reconnectAttempts = $attempts;
        return $this;
    }

    /**
     * Set the interval between reconnection attempts (in seconds).
     *
     * @param float $interval
     * @return self
     */
    public function setReconnectInterval(float $interval): self
    {
        $this->option->reconnectInterval = $interval;
        return $this;
    }

    /**
     * Set the timeout for WebSocket connection (in seconds).
     *
     * @param float $timeout
     * @return self
     */
    public function setDialTimeout(float $timeout): self
    {
        $this->option->dialTimeout = $timeout;
        return $this;
    }

    /**
     * Set the buffer size for reading messages.
     *
     * @param int $size
     * @return self
     */
    public function setReadMessageBuffer(int $size): self
    {
        $this->option->readMessageBuffer = $size;
        return $this;
    }

    /**
     * Set the buffer size for writing messages.
     *
     * @param int $size
     * @return self
     */
    public function setWriteMessageBuffer(int $size): self
    {
        $this->option->writeMessageBuffer = $size;
        return $this;
    }

    /**
     * Set the timeout for sending messages (in seconds).
     *
     * @param float $timeout
     * @return self
     */
    public function setWriteTimeout(float $timeout): self
    {
        $this->option->writeTimeout = $timeout;
        return $this;
    }

    /**
     * Set the callback function for handling WebSocket events.
     * Signature: function(string $eventType, string $eventData, string $eventMessage): void
     *
     * @param callable|null $callback
     * @return self
     */
    public function setEventCallback($callback): self
    {
        $this->option->eventCallback = $callback;
        return $this;
    }

    /**
     * Build and return the WebSocketClientOption instance.
     *
     * @return WebSocketClientOption
     */
    public function build(): WebSocketClientOption
    {
        return $this->option;
    }
}
