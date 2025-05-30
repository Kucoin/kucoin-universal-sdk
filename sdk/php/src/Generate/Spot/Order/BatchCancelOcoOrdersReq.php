<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class BatchCancelOcoOrdersReq implements Serializable
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
     * Specify the order ID; there can be multiple orders, separated by commas. If not passed, all OCO orders will be canceled by default.
     * @var string|null $orderIds
     * @Type("string")
     * @SerializedName("orderIds")
     */
    public $orderIds;
    /**
     * Trading pair. If not passed, the OCO orders of all symbols will be canceled by default.
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;

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
            BatchCancelOcoOrdersReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `BatchCancelOcoOrdersReq` class.
     * The builder pattern allows step-by-step construction of a `BatchCancelOcoOrdersReq` object.
     * @return BatchCancelOcoOrdersReqBuilder
     */
    public static function builder()
    {
        return new BatchCancelOcoOrdersReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `BatchCancelOcoOrdersReq` class with the given data.
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

class BatchCancelOcoOrdersReqBuilder
{
    /**
     * @var BatchCancelOcoOrdersReq $obj
     */
    private $obj;

    public function __construct(BatchCancelOcoOrdersReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Specify the order ID; there can be multiple orders, separated by commas. If not passed, all OCO orders will be canceled by default.
     * @param string $value
     * @return self
     */
    public function setOrderIds($value)
    {
        $this->obj->orderIds = $value;
        return $this;
    }

    /**
     * Trading pair. If not passed, the OCO orders of all symbols will be canceled by default.
     * @param string $value
     * @return self
     */
    public function setSymbol($value)
    {
        $this->obj->symbol = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return BatchCancelOcoOrdersReq
     */
    public function build()
    {
        return $this->obj;
    }
}
