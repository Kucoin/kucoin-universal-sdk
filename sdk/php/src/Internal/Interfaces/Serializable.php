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


    public static function jsonDeserialize($json, $serializer);
}


