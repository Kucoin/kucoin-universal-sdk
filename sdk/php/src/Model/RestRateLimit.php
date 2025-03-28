<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Class RestRateLimit
 * Represents the rate limiting information for a REST API.
 */
class RestRateLimit
{
    /**
     * Total resource pool quota
     * @var int
     */
    public $limit;

    /**
     * Remaining resource pool quota
     * @var int
     */
    public $remaining;

    /**
     * Resource pool quota reset countdown (in milliseconds)
     * @var int
     */
    public $reset;

    /**
     * @param int $limit
     * @param int $remaining
     * @param int $reset
     */
    public function __construct(int $limit, int $remaining, int $reset)
    {
        $this->limit = $limit;
        $this->remaining = $remaining;
        $this->reset = $reset;
    }
}
