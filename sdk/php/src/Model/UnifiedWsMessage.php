<?php

namespace KuCoin\UniversalSDK\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
/**
 * Class UnifiedWsMessage
 * Represents a message from the unified WebSocket API.
 */
class UnifiedWsMessage
{
    /**
     * User-defined ID (not orderid) is used to uniquely represent a request
     * 
     * @var string
     * @Type("string")
     * @SerializedName("id")
     */
    public $id;

    /**
     * Response data
     * 
     * @var array
     * @Type("array")
     * @SerializedName("data")
     */
    public $data = [];

    /**
     * Command options
     * 
     * @var string
     * @Type("string")
     * @SerializedName("op")
     */
    public $op;

    /**
     * Gateway error code, 200000 means ok
     * 
     * @var string
     * @Type("string")
     * @SerializedName("code")
     */
    public $code;

    /**
     * Error message
     * 
     * @var string
     * @Type("string")
     * @SerializedName("msg")
     */
    public $message;

    /**
     * Gateway in time(ms)
     * 
     * @var int
     * @Type("int")
     * @SerializedName("inTime")
     */
    public $inTime;

    /**
     * Gateway out time(ms)
     * 
     * @var int
     * @Type("int")
     * @SerializedName("outTime")
     */
    public $outTime;

    /**
     * Rate limiting data
     * 
     * @var RateLimit
     * @Type("KuCoin\UniversalSDK\Model\RateLimit")
     * @SerializedName("userRateLimit")
     */
    public $rateLimit;
}