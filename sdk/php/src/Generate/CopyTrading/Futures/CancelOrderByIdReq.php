<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\CopyTrading\Futures;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class CancelOrderByIdReq implements Serializable
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
     * Order ID
     * @var string|null $orderId
     * @Type("string")
     * @SerializedName("orderId")
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
            CancelOrderByIdReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `CancelOrderByIdReq` class.
     * The builder pattern allows step-by-step construction of a `CancelOrderByIdReq` object.
     * @return CancelOrderByIdReqBuilder
     */
    public static function builder()
    {
        return new CancelOrderByIdReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `CancelOrderByIdReq` class with the given data.
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

class CancelOrderByIdReqBuilder
{
    /**
     * @var CancelOrderByIdReq $obj
     */
    private $obj;

    public function __construct(CancelOrderByIdReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Order ID
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
     * @return CancelOrderByIdReq
     */
    public function build()
    {
        return $this->obj;
    }
}
