<?php

namespace KuCoin\UniversalSDK\Model;

/**
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
    private $unifiedWsEndpoint;
    private $transportOption;
    private $websocketClientOption;

    /**
     * Set API key for authentication.
     *
     * @param string $key
     * @return self
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Set API secret for authentication.
     *
     * @param string $secret
     * @return self
     */
    public function setSecret(string $secret): self
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Set passphrase for authentication.
     *
     * @param string $passphrase
     * @return self
     */
    public function setPassphrase(string $passphrase): self
    {
        $this->passphrase = $passphrase;
        return $this;
    }

    /**
     * Set the API endpoint for spot market.
     *
     * @param string $spotEndpoint
     * @return self
     */
    public function setSpotEndpoint(string $spotEndpoint): self
    {
        $this->spotEndpoint = $spotEndpoint;
        return $this;
    }

    /**
     * Set the API endpoint for futures market.
     *
     * @param string $futuresEndpoint
     * @return self
     */
    public function setFuturesEndpoint(string $futuresEndpoint): self
    {
        $this->futuresEndpoint = $futuresEndpoint;
        return $this;
    }

    /**
     * Set the API endpoint for broker services.
     *
     * @param string $brokerEndpoint
     * @return self
     */
    public function setBrokerEndpoint(string $brokerEndpoint): self
    {
        $this->brokerEndpoint = $brokerEndpoint;
        return $this;
    }

    /**
     * Set the broker name.
     *
     * @param string $brokerName
     * @return self
     */
    public function setBrokerName(string $brokerName): self
    {
        $this->brokerName = $brokerName;
        return $this;
    }

    /**
     * Set the broker partner name.
     *
     * @param string $brokerPartner
     * @return self
     */
    public function setBrokerPartner(string $brokerPartner): self
    {
        $this->brokerPartner = $brokerPartner;
        return $this;
    }

    /**
     * Set the broker key.
     *
     * @param string $brokerKey
     * @return self
     */
    public function setBrokerKey(string $brokerKey): self
    {
        $this->brokerKey = $brokerKey;
        return $this;
    }
    
    /**
     * Set the unified WebSocket API endpoint.
     *
     * @param string $unifiedWsEndpoint
     * @return self
     */
    public function setUnifiedWsEndpoint(string $unifiedWsEndpoint): self
    {
        $this->unifiedWsEndpoint = $unifiedWsEndpoint;
        return $this;
    }

    /**
     * Set transport option configuration for HTTP client.
     *
     * @param TransportOption $transportOption
     * @return self
     */
    public function setTransportOption(TransportOption $transportOption): self
    {
        $this->transportOption = $transportOption;
        return $this;
    }

    /**
     * Set WebSocket client option configuration.
     *
     * @param WebSocketClientOption $websocketClientOption
     * @return self
     */
    public function setWebSocketClientOption(WebSocketClientOption $websocketClientOption): self
    {
        $this->websocketClientOption = $websocketClientOption;
        return $this;
    }

    /**
     * Build and return the ClientOption object with the configured values.
     *
     * @return ClientOption
     */
    public function build(): ClientOption
    {
        return new ClientOption(
            $this->key,
            $this->secret,
            $this->passphrase,
            $this->spotEndpoint,
            $this->futuresEndpoint,
            $this->brokerEndpoint,
            $this->unifiedWsEndpoint,
            $this->brokerName,
            $this->brokerPartner,
            $this->brokerKey,
            $this->transportOption,
            $this->websocketClientOption
        );
    }
}
