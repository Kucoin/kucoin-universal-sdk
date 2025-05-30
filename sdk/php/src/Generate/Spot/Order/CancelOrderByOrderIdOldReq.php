<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class CancelOrderByOrderIdOldReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [
        "orderId" => "orderId",
    ];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * The unique order id generated by the trading system
     * @var string|null $orderId
     * @Type("string")
     * @SerializedName("orderId")
     * @Exclude()
     */
    public $orderId;

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
            CancelOrderByOrderIdOldReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `CancelOrderByOrderIdOldReq` class.
     * The builder pattern allows step-by-step construction of a `CancelOrderByOrderIdOldReq` object.
     * @return CancelOrderByOrderIdOldReqBuilder
     */
    public static function builder()
    {
        return new CancelOrderByOrderIdOldReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `CancelOrderByOrderIdOldReq` class with the given data.
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

class CancelOrderByOrderIdOldReqBuilder
{
    /**
     * @var CancelOrderByOrderIdOldReq $obj
     */
    private $obj;

    public function __construct(CancelOrderByOrderIdOldReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * The unique order id generated by the trading system
     * @param string $value
     * @return self
     */
    public function setOrderId($value)
    {
        $this->obj->orderId = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return CancelOrderByOrderIdOldReq
     */
    public function build()
    {
        return $this->obj;
    }
}
