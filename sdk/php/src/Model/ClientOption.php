<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Holds configuration details for authentication and endpoints.
 */
class ClientOption
{
    /**
     * Authentication key for the client.
     * @var string
     */
    public $key;

    /**
     * Authentication secret for the client.
     * @var string
     */
    public $secret;

    /**
     * Authentication passphrase for the client.
     * @var string
     */
    public $passphrase;

    /**
     * The name of the broker.
     * @var string
     */
    public $brokerName;

    /**
     * The partner associated with the broker.
     * @var string
     */
    public $brokerPartner;

    /**
     * The secret key for the broker.
     * @var string
     */
    public $brokerKey;

    /**
     * Spot market API endpoint for the client.
     * @var string
     */
    public $spotEndpoint;

    /**
     * Futures market API endpoint for the client.
     * @var string
     */
    public $futuresEndpoint;

    /**
     * Broker API endpoint for the client.
     * @var string
     */
    public $brokerEndpoint;
    
    /**
     * Unified WebSocket API endpoint for the client.
     * @var string
     */
    public $unifiedWsEndpoint;

    /**
     * Configuration for HTTP transport.
     * @var TransportOption|null
     */
    public $transportOption;

    /**
     * Configuration for WebSocket transport.
     * @var WebSocketClientOption|null
     */
    public $websocketClientOption;

    public function __construct(
        $key,
        $secret,
        $passphrase,
        $spotEndpoint,
        $futuresEndpoint,
        $brokerEndpoint,
        $unifiedWsEndpoint,
        $brokerName,
        $brokerPartner,
        $brokerKey,
        $transportOption = null,
        $websocketClientOption = null
    )
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->passphrase = $passphrase;
        $this->spotEndpoint = $spotEndpoint;
        $this->futuresEndpoint = $futuresEndpoint;
        $this->brokerEndpoint = $brokerEndpoint;
        $this->unifiedWsEndpoint = $unifiedWsEndpoint;
        $this->brokerName = $brokerName;
        $this->brokerPartner = $brokerPartner;
        $this->brokerKey = $brokerKey;
        $this->transportOption = $transportOption;
        $this->websocketClientOption = $websocketClientOption;
    }
}
