<?php

namespace KuCoin\UniversalSDK\Model;

use JMS\Serializer\Serializer;

/**
 * Class WsMessage
 * Represents a message between the WebSocket client and server.
 */
class WsMessage
{
    /**
     * Unique message ID
     * @var string
     * @Type("string")
     * @SerializedName("id")
     */
    public $id;

    /**
     * Message type (e.g., "ping", "subscribe", etc.)
     * @var string
     * @Type("string")
     * @SerializedName("type")
     */
    public $type;

    /**
     * Sequence number
     * @var int
     * @Type("integer")
     * @SerializedName("sn")
     */
    public $sn;

    /**
     * The topic of the message
     * @var string
     * @Type("string")
     * @SerializedName("topic")
     */
    public $topic;

    /**
     * Subject of the message
     * @var string
     * @Type("string")
     * @SerializedName("subject")
     */
    public $subject;

    /**
     * Indicates if it is a private channel
     * @var bool
     * @Type("boolean")
     * @SerializedName("privateChannel")
     */
    public $privateChannel;

    /**
     * Indicates if the message is a response
     * @var bool
     * @Type("boolean")
     * @SerializedName("response")
     */
    public $response;

    /**
     * Raw message data
     * @var mixed
     * @Type("JsonSerialized")
     * @SerializedName("data")
     */
    public $rawData;

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize(string $json, Serializer $serializer): WsMessage
    {
        return $serializer->deserialize($json, self::class, 'json');
    }
}
