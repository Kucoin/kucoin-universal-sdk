<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Debit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetRepayHistoryReq implements Serializable
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
     * true-isolated, false-cross; default is false
     * @var bool|null $isIsolated
     * @Type("bool")
     * @SerializedName("isIsolated")
     */
    public $isIsolated = false;
    /**
     * symbol, mandatory for isolated margin account
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Repay order ID
     * @var string|null $orderNo
     * @Type("string")
     * @SerializedName("orderNo")
     */
    public $orderNo;
    /**
     * The start and end times are not restricted. If the start time is empty or less than 1680278400000, the default value is set to 1680278400000 (April 1, 2023, 00:00:00)
     * @var int|null $startTime
     * @Type("int")
     * @SerializedName("startTime")
     */
    public $startTime;
    /**
     * End time
     * @var int|null $endTime
     * @Type("int")
     * @SerializedName("endTime")
     */
    public $endTime;
    /**
     * Current query page, with a starting value of 1. Default:1
     * @var int|null $currentPage
     * @Type("int")
     * @SerializedName("currentPage")
     */
    public $currentPage = 1;
    /**
     * Number of results per page. Default is 50, minimum is 10, maximum is 500
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
            GetRepayHistoryReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetRepayHistoryReq` class.
     * The builder pattern allows step-by-step construction of a `GetRepayHistoryReq` object.
     * @return GetRepayHistoryReqBuilder
     */
    public static function builder()
    {
        return new GetRepayHistoryReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetRepayHistoryReq` class with the given data.
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

class GetRepayHistoryReqBuilder
{
    /**
     * @var GetRepayHistoryReq $obj
     */
    private $obj;

    public function __construct(GetRepayHistoryReq $obj)
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
     * true-isolated, false-cross; default is false
     * @param bool $value
     * @return self
     */
    public function setIsIsolated($value)
    {
        $this->obj->isIsolated = $value;
        return $this;
    }

    /**
     * symbol, mandatory for isolated margin account
     * @param string $value
     * @return self
     */
    public function setSymbol($value)
    {
        $this->obj->symbol = $value;
        return $this;
    }

    /**
     * Repay order ID
     * @param string $value
     * @return self
     */
    public function setOrderNo($value)
    {
        $this->obj->orderNo = $value;
        return $this;
    }

    /**
     * The start and end times are not restricted. If the start time is empty or less than 1680278400000, the default value is set to 1680278400000 (April 1, 2023, 00:00:00)
     * @param int $value
     * @return self
     */
    public function setStartTime($value)
    {
        $this->obj->startTime = $value;
        return $this;
    }

    /**
     * End time
     * @param int $value
     * @return self
     */
    public function setEndTime($value)
    {
        $this->obj->endTime = $value;
        return $this;
    }

    /**
     * Current query page, with a starting value of 1. Default:1
     * @param int $value
     * @return self
     */
    public function setCurrentPage($value)
    {
        $this->obj->currentPage = $value;
        return $this;
    }

    /**
     * Number of results per page. Default is 50, minimum is 10, maximum is 500
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
     * @return GetRepayHistoryReq
     */
    public function build()
    {
        return $this->obj;
    }
}
