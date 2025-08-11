<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

/**
 * Represents a parsed WebSocket message with type, ID, and message content.
 */
class WsParsedMessage
{
    /**
     * The type of the message (e.g., welcome, ping, pong, message, etc.)
     * @var string
     */
    private $type;

    /**
     * The ID of the message
     * @var string
     */
    private $id;

    /**
     * The actual message content
     * @var mixed
     */
    private $message;

    /**
     * Whether the message requires an acknowledgment
     * @var bool
     */
    private $ack;

    /**
     * @param string $type The type of the message
     * @param string|null $id The ID of the message
     * @param mixed $message The actual message content
     * @param bool $ack Whether the message requires an acknowledgment
     */
    public function __construct(string $type, ?string $id, $message, bool $ack)
    {
        $this->type = $type;
        $this->id = $id;
        $this->message = $message;
        $this->ack = $ack;
    }

    /**
     * Get the type of the message
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the ID of the message
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the message content
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Check if the message requires an acknowledgment
     * @return bool
     */
    public function isAck(): bool
    {
        return $this->ack;
    }
}