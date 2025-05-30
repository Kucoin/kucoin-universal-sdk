<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Deposit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetDepositHistoryReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * currency
     * @var string|null $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Status. Available value: PROCESSING, SUCCESS, and FAILURE
     * - 'PROCESSING' : Deposit processing
     * - 'SUCCESS' : Deposit success
     * - 'FAILURE' : Deposit fail
     * @var string|null $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;
    /**
     * Start time (milliseconds)
     * @var int|null $startAt
     * @Type("int")
     * @SerializedName("startAt")
     */
    public $startAt;
    /**
     * End time (milliseconds)
     * @var int|null $endAt
     * @Type("int")
     * @SerializedName("endAt")
     */
    public $endAt;
    /**
     * Current request page.
     * @var int|null $currentPage
     * @Type("int")
     * @SerializedName("currentPage")
     */
    public $currentPage;
    /**
     * Number of results per request. Minimum is 10, maximum is 500.
     * @var int|null $pageSize
     * @Type("int")
     * @SerializedName("pageSize")
     */
    public $pageSize = 50;

    private function __construct() {}

    /**
     * @param Serializer $serializer
     * @return string
     */
    public function jsonSerialize($serializer)
    {
        return $serializer->serialize($this, "json");
    }

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize($json, $serializer)
    {
        if ($json === null) {
            return new self();
        }
        return $serializer->deserialize(
            $json,
            GetDepositHistoryReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetDepositHistoryReq` class.
     * The builder pattern allows step-by-step construction of a `GetDepositHistoryReq` object.
     * @return GetDepositHistoryReqBuilder
     */
    public static function builder()
    {
        return new GetDepositHistoryReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetDepositHistoryReq` class with the given data.
     * Ensure that the keys in data match the target field names in the documentation,
     * rather than the variable names in the class.
     * @return self
     */
    public static function create(array $data)
    {
        $obj = new self();
        foreach ($data as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }
        return $obj;
    }
}

class GetDepositHistoryReqBuilder
{
    /**
     * @var GetDepositHistoryReq $obj
     */
    private $obj;

    public function __construct(GetDepositHistoryReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * currency
     * @param string $value
     * @return self
     */
    public function setCurrency($value)
    {
        $this->obj->currency = $value;
        return $this;
    }

    /**
     * Status. Available value: PROCESSING, SUCCESS, and FAILURE
     * - 'PROCESSING' : Deposit processing
     * - 'SUCCESS' : Deposit success
     * - 'FAILURE' : Deposit fail
     * @param string $value
     * @return self
     */
    public function setStatus($value)
    {
        $this->obj->status = $value;
        return $this;
    }

    /**
     * Start time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setStartAt($value)
    {
        $this->obj->startAt = $value;
        return $this;
    }

    /**
     * End time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setEndAt($value)
    {
        $this->obj->endAt = $value;
        return $this;
    }

    /**
     * Current request page.
     * @param int $value
     * @return self
     */
    public function setCurrentPage($value)
    {
        $this->obj->currentPage = $value;
        return $this;
    }

    /**
     * Number of results per request. Minimum is 10, maximum is 500.
     * @param int $value
     * @return self
     */
    public function setPageSize($value)
    {
        $this->obj->pageSize = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return GetDepositHistoryReq
     */
    public function build()
    {
        return $this->obj;
    }
}
