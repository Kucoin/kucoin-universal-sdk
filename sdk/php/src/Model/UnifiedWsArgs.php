<?php

namespace KuCoin\UniversalSDK\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Serializer;

/**
 * Class UnifiedWsArgs
 * Represents the arguments for a unified WebSocket API call.
 */
class UnifiedWsArgs
{
    /**
     * User-defined ID (not orderid) is used to uniquely represent a request.
     * The server will also return this ID when returning.
     * 
     * @var string
     * @Type("string")
     * @SerializedName("id")
     */
    public $id;

    /**
     * Command options. The "op" parameter is one of the following enum values:
     * - spot.order
     * - margin.order
     * - futures.order
     * - spot.cancel
     * - margin.cancel
     * - futures.cancel
     * - futures.multi_cancel
     * - futures.multi_order
     * - spot.sync_order
     * - spot.modify
     * - spot.sync_cancel
     * 
     * @var string
     * @Type("string")
     * @SerializedName("op")
     */
    public $op;

    /**
     * Business parameters, same as RestAPI
     * 
     * @var array
     * @Type("array")
     * @SerializedName("args")
     */
    public $args = [];

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize(string $json, Serializer $serializer): UnifiedWsArgs
    {
        return $serializer->deserialize($json, self::class, 'json');
    }

    /**
     * @param Serializer $serializer
     * @return string
     */
    public function jsonSerialize(Serializer $serializer): string
    {
        return $serializer->serialize($this, 'json');
    }
}