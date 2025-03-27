<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Class TransportOption
 * TransportOption holds configurations for HTTP client behavior.
 */
class TransportOption
{
    /**
     * Enables keep-alive for persistent connections. Defaults to true.
     * @var bool
     */
    public $keepAlive = true;

    /**
     * The number of connection pools to cache (i.e., how many hosts). Defaults to 10.
     * @var int
     */
    public $maxPoolSize = 10;

    /**
     * The maximum number of connections to save in the pool. Defaults to 10.
     * @var int
     */
    public $maxConnectionPerPool = 10;

    /**
     * Connection timeout duration in seconds. Defaults to 10.
     * @var float
     */
    public $connectTimeout = 10;

    /**
     * Read timeout duration in seconds. Defaults to 30.
     * @var float
     */
    public $readTimeout = 30;

    /**
     * HTTP(s) proxy. Example: ['http' => '192.168.1.1', 'https' => '192.168.1.1']
     * @var array|null
     */
    public $proxy = null;

    /**
     * Maximum number of retry attempts. Defaults to 3.
     * @var int
     */
    public $maxRetries = 3;

    /**
     * Delay in seconds between retries. Defaults to 2.
     * @var float
     */
    public $retryDelay = 2;

    /**
     * List of HTTP interceptors.
     * @var InterceptorInterface[]
     */
    public $interceptors = [];

    public function __construct()
    {
    }
}

/**
 * Class TransportOptionBuilder
 * Builder class for TransportOption.
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
     * @param bool $keepAlive
     * @return $this
     */
    public function setKeepAlive($keepAlive)
    {
        $this->option->keepAlive = $keepAlive;
        return $this;
    }

    /**
     * @param int $maxPoolSize
     * @return $this
     */
    public function setMaxPoolSize($maxPoolSize)
    {
        $this->option->maxPoolSize = $maxPoolSize;
        return $this;
    }

    /**
     * @param int $maxConnectionPerPool
     * @return $this
     */
    public function setMaxConnectionPerPool($maxConnectionPerPool)
    {
        $this->option->maxConnectionPerPool = $maxConnectionPerPool;
        return $this;
    }

    /**
     * @param float $connectTimeout
     * @return $this
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->option->connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * @param float $readTimeout
     * @return $this
     */
    public function setReadTimeout($readTimeout)
    {
        $this->option->readTimeout = $readTimeout;
        return $this;
    }

    /**
     * @param array $proxy
     * @return $this
     */
    public function setProxy(array $proxy)
    {
        $this->option->proxy = $proxy;
        return $this;
    }

    /**
     * @param int $maxRetries
     * @return $this
     */
    public function setMaxRetries($maxRetries)
    {
        $this->option->maxRetries = $maxRetries;
        return $this;
    }

    /**
     * @param float $retryDelay
     * @return $this
     */
    public function setRetryDelay($retryDelay)
    {
        $this->option->retryDelay = $retryDelay;
        return $this;
    }

    /**
     * @param InterceptorInterface[] $interceptors
     * @return $this
     */
    public function setInterceptors(array $interceptors)
    {
        $this->option->interceptors = $interceptors;
        return $this;
    }

    /**
     * @param InterceptorInterface $interceptor
     * @return $this
     */
    public function addInterceptor(InterceptorInterface $interceptor)
    {
        $this->option->interceptors[] = $interceptor;
        return $this;
    }

    /**
     * Finalize and return the configured TransportOption.
     *
     * @return TransportOption
     */
    public function build()
    {
        return $this->option;
    }
}
