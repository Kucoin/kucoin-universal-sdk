<?php

namespace KuCoin\UniversalSDK\Api;

/**
 * Client interface defines the methods to get REST and WebSocket services.
 */
interface Client
{
    /**
     * Get RESTful service.
     *
     * @return KucoinRestService
     */
    public function restService(): KucoinRestService;

    /**
     * Get WebSocket service.
     *
     * @return KucoinWSService
     */
    public function wsService(): KucoinWSService;
}
