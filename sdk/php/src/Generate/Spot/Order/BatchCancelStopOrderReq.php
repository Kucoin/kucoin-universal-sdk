<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class BatchCancelStopOrderReq implements Serializable
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
     * Cancel the open order for the specified symbol
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * The type of trading : TRADE（Spot）, MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
     * @var string|null $tradeType
     * @Type("string")
     * @SerializedName("tradeType")
     */
    public $tradeType;
    /**
     * Comma seperated order IDs.
     * @var string|null $orderIds
     * @Type("string")
     * @SerializedName("orderIds")
     */
    public $orderIds;

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
            BatchCancelStopOrderReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `BatchCancelStopOrderReq` class.
     * The builder pattern allows step-by-step construction of a `BatchCancelStopOrderReq` object.
     * @return BatchCancelStopOrderReqBuilder
     */
    public static function builder()
    {
        return new BatchCancelStopOrderReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `BatchCancelStopOrderReq` class with the given data.
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

class BatchCancelStopOrderReqBuilder
{
    /**
     * @var BatchCancelStopOrderReq $obj
     */
    private $obj;

    public function __construct(BatchCancelStopOrderReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Cancel the open order for the specified symbol
     * @param string $value
     * @return self
     */
    public function setSymbol($value)
    {
        $this->obj->symbol = $value;
        return $this;
    }

    /**
     * The type of trading : TRADE（Spot）, MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
     * @param string $value
     * @return self
     */
    public function setTradeType($value)
    {
        $this->obj->tradeType = $value;
        return $this;
    }

    /**
     * Comma seperated order IDs.
     * @param string $value
     * @return self
     */
    public function setOrderIds($value)
    {
        $this->obj->orderIds = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return BatchCancelStopOrderReq
     */
    public function build()
    {
        return $this->obj;
    }
}
