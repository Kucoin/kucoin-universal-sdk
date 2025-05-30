<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Futures\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetStopOrderListReq implements Serializable
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
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * buy or sell
     * - 'buy' :
     * - 'sell' :
     * @var string|null $side
     * @Type("string")
     * @SerializedName("side")
     */
    public $side;
    /**
     * limit, market
     * - 'limit' :
     * - 'market' :
     * @var string|null $type
     * @Type("string")
     * @SerializedName("type")
     */
    public $type;
    /**
     * Start time (milisecond)
     * @var int|null $startAt
     * @Type("int")
     * @SerializedName("startAt")
     */
    public $startAt;
    /**
     * End time (milisecond)
     * @var int|null $endAt
     * @Type("int")
     * @SerializedName("endAt")
     */
    public $endAt;
    /**
     * Current request page, The default currentPage is 1
     * @var int|null $currentPage
     * @Type("int")
     * @SerializedName("currentPage")
     */
    public $currentPage;
    /**
     * pageSize, The default pageSize is 50, The maximum cannot exceed 1000
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
            GetStopOrderListReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetStopOrderListReq` class.
     * The builder pattern allows step-by-step construction of a `GetStopOrderListReq` object.
     * @return GetStopOrderListReqBuilder
     */
    public static function builder()
    {
        return new GetStopOrderListReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetStopOrderListReq` class with the given data.
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

class GetStopOrderListReqBuilder
{
    /**
     * @var GetStopOrderListReq $obj
     */
    private $obj;

    public function __construct(GetStopOrderListReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     * @param string $value
     * @return self
     */
    public function setSymbol($value)
    {
        $this->obj->symbol = $value;
        return $this;
    }

    /**
     * buy or sell
     * - 'buy' :
     * - 'sell' :
     * @param string $value
     * @return self
     */
    public function setSide($value)
    {
        $this->obj->side = $value;
        return $this;
    }

    /**
     * limit, market
     * - 'limit' :
     * - 'market' :
     * @param string $value
     * @return self
     */
    public function setType($value)
    {
        $this->obj->type = $value;
        return $this;
    }

    /**
     * Start time (milisecond)
     * @param int $value
     * @return self
     */
    public function setStartAt($value)
    {
        $this->obj->startAt = $value;
        return $this;
    }

    /**
     * End time (milisecond)
     * @param int $value
     * @return self
     */
    public function setEndAt($value)
    {
        $this->obj->endAt = $value;
        return $this;
    }

    /**
     * Current request page, The default currentPage is 1
     * @param int $value
     * @return self
     */
    public function setCurrentPage($value)
    {
        $this->obj->currentPage = $value;
        return $this;
    }

    /**
     * pageSize, The default pageSize is 50, The maximum cannot exceed 1000
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
     * @return GetStopOrderListReq
     */
    public function build()
    {
        return $this->obj;
    }
}
