<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Builder pattern for constructing TransportOption instances.
 */
class TransportOptionBuilder
{
    /**
     * @var TransportOption
     */
    private $option;

    public function __construct()
    {
        $this->option = new TransportOption();
    }

    /**
     * Enable or disable keep-alive for persistent connections.
     *
     * @param bool $keepAlive
     * @return self
     */
    public function setKeepAlive(bool $keepAlive): self
    {
        $this->option->keepAlive = $keepAlive;
        return $this;
    }

    /**
     * Set the number of connection pools to cache.
     *
     * @param int $maxPoolSize
     * @return self
     */
    public function setMaxPoolSize(int $maxPoolSize): self
    {
        $this->option->maxPoolSize = $maxPoolSize;
        return $this;
    }

    /**
     * Set the maximum number of connections per pool.
     *
     * @param int $maxConnectionPerPool
     * @return self
     */
    public function setMaxConnectionPerPool(int $maxConnectionPerPool): self
    {
        $this->option->maxConnectionPerPool = $maxConnectionPerPool;
        return $this;
    }

    /**
     * Set connection timeout duration (in seconds).
     *
     * @param float $connectTimeout
     * @return self
     */
    public function setConnectTimeout(float $connectTimeout): self
    {
        $this->option->connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * Set read timeout duration (in seconds).
     *
     * @param float $readTimeout
     * @return self
     */
    public function setReadTimeout(float $readTimeout): self
    {
        $this->option->readTimeout = $readTimeout;
        return $this;
    }

    /**
     * Set HTTP(s) proxy.
     *
     * @param array|null $proxy
     * @return self
     */
    public function setProxy($proxy): self
    {
        $this->option->proxy = $proxy;
        return $this;
    }

    /**
     * Set the maximum number of retry attempts.
     *
     * @param int $maxRetries
     * @return self
     */
    public function setMaxRetries(int $maxRetries): self
    {
        $this->option->maxRetries = $maxRetries;
        return $this;
    }

    /**
     * Set the delay between retry attempts (in seconds).
     *
     * @param float $retryDelay
     * @return self
     */
    public function setRetryDelay(float $retryDelay): self
    {
        $this->option->retryDelay = $retryDelay;
        return $this;
    }

    /**
     * Set the list of HTTP interceptors.
     *
     * @param InterceptorInterface[] $interceptors
     * @return self
     */
    public function setInterceptors(array $interceptors): self
    {
        $this->option->interceptors = $interceptors;
        return $this;
    }

    /**
     * Build and return the TransportOption object with configured values.
     *
     * @return TransportOption
     */
    public function build(): TransportOption
    {
        return $this->option;
    }
}
