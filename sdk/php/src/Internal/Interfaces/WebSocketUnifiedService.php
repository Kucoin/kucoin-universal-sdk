<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

use KuCoin\UniversalSDK\Model\UnifiedWsArgs;
use KuCoin\UniversalSDK\Model\UnifiedWsMessage;
use React\Promise\PromiseInterface;

/**
 * Interface for the unified WebSocket service that handles trading operations.
 */
interface WebSocketUnifiedService
{
    /**
     * Starts the WebSocket service and handles incoming messages.
     */
    public function start(): PromiseInterface;

    /**
     * Stops the WebSocket service.
     */
    public function stop(): PromiseInterface;

    /**
     * Sends a message to the unified WebSocket API and returns a promise that resolves with the response.
     * 
     * @param UnifiedWsArgs $args The arguments for the WebSocket call
     * @return PromiseInterface<UnifiedWsMessage> A promise that resolves with the response message
     */
    public function call(UnifiedWsArgs $args): PromiseInterface;
}