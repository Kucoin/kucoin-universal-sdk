<?php

namespace KuCoin\UniversalSDK\Internal\Utils;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;

class JsonSerializedHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'type' => 'JsonSerialized',
                'format' => 'json',
                'method' => 'deserializeJson',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'type' => 'JsonSerialized',
                'format' => 'json',
                'method' => 'serializeJson',
            ],
        ];
    }

    public function deserializeJson(
        DeserializationVisitorInterface $visitor,
                                        $data,
        array                           $type,
        Context                         $context
    )
    {
        return $data;
    }

    public function serializeJson(
        SerializationVisitorInterface $visitor,
                                      $data,
        array                         $type,
        Context                       $context
    )
    {
        return $data;
    }
}
