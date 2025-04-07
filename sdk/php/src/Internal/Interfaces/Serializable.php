<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

use JMS\Serializer\Serializer;

/**
 * Interface Serializable
 * For objects that can be serialized to JSON string.
 */
interface Serializable
{
    /**
     * @param Serializer $serializer
     * @return string
     */
    public function jsonSerialize($serializer);


    /**
     * @param mixed $json
     * @param Serializer $serializer
     * @return mixed
     */
    public static function jsonDeserialize($json, $serializer);
}


