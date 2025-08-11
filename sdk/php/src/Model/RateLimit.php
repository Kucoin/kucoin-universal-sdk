<?php

namespace KuCoin\UniversalSDK\Model;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class RateLimit
 * Represents the rate limiting information for API requests.
 */
class RateLimit
{
    /**
     * Total resource pool quota
     * @var int
     * @Type("int")
     * @SerializedName("limit")
     */
    public $limit;

    /**
     * Remaining resource pool quota
     * @var int
     * @Type("int")
     * @SerializedName("remaining")
     */
    public $remaining;

    /**
     * Resource pool quota reset countdown (in milliseconds)
     * @var int
     * @Type("int")
     * @SerializedName("reset")
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