<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Model\WsMessage;

interface WebSocketMessageCallback
{

    /**
     * Handles incoming WebSocket messages.
     * @param WsMessage $message
     * @param Serializer $serializer
     * @return mixed
     */
    public function onMessage(WsMessage $message, Serializer $serializer);

}