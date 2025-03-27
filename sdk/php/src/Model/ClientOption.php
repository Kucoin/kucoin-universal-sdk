<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Class ClientOption
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
        $brokerName,
        $brokerPartner,
        $brokerKey,
        $transportOption = null,
        $websocketClientOption = null
    ) {
        $this->key = $key;
        $this->secret = $secret;
        $this->passphrase = $passphrase;
        $this->spotEndpoint = $spotEndpoint;
        $this->futuresEndpoint = $futuresEndpoint;
        $this->brokerEndpoint = $brokerEndpoint;
        $this->brokerName = $brokerName;
        $this->brokerPartner = $brokerPartner;
        $this->brokerKey = $brokerKey;
        $this->transportOption = $transportOption;
        $this->websocketClientOption = $websocketClientOption;
    }
}

/**
 * Class ClientOptionBuilder
 * Builder pattern for constructing ClientOption instances.
 */
class ClientOptionBuilder
{
    private $key;
    private $secret;
    private $passphrase;
    private $spotEndpoint;
    private $futuresEndpoint;
    private $brokerEndpoint;
    private $brokerName;
    private $brokerPartner;
    private $brokerKey;
    private $transportOption;
    private $websocketClientOption;




    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
        return $this;
    }

    public function setSpotEndpoint($spotEndpoint)
    {
        $this->spotEndpoint = $spotEndpoint;
        return $this;
    }

    public function setFuturesEndpoint($futuresEndpoint)
    {
        $this->futuresEndpoint = $futuresEndpoint;
        return $this;
    }

    public function setBrokerEndpoint($brokerEndpoint)
    {
        $this->brokerEndpoint = $brokerEndpoint;
        return $this;
    }

    public function setBrokerName($brokerName)
    {
        $this->brokerName = $brokerName;
        return $this;
    }

    public function setBrokerPartner($brokerPartner)
    {
        $this->brokerPartner = $brokerPartner;
        return $this;
    }

    public function setBrokerKey($brokerKey)
    {
        $this->brokerKey = $brokerKey;
        return $this;
    }

    public function setTransportOption($transportOption)
    {
        $this->transportOption = $transportOption;
        return $this;
    }

    public function setWebSocketClientOption($websocketClientOption)
    {
        $this->websocketClientOption = $websocketClientOption;
        return $this;
    }

    /**
     * Build and return the ClientOption object.
     *
     * @return ClientOption
     */
    public function build()
    {
        return new ClientOption(
            $this->key,
            $this->secret,
            $this->passphrase,
            $this->spotEndpoint,
            $this->futuresEndpoint,
            $this->brokerEndpoint,
            $this->brokerName,
            $this->brokerPartner,
            $this->brokerKey,
            $this->transportOption,
            $this->websocketClientOption
        );
    }
}
