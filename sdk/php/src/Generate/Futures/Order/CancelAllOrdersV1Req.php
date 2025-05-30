<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Futures\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class CancelAllOrdersV1Req implements Serializable
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
     * To cancel all limit orders for a specific contract only, unless otherwise specified, all limit orders will be deleted. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
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
            CancelAllOrdersV1Req::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `CancelAllOrdersV1Req` class.
     * The builder pattern allows step-by-step construction of a `CancelAllOrdersV1Req` object.
     * @return CancelAllOrdersV1ReqBuilder
     */
    public static function builder()
    {
        return new CancelAllOrdersV1ReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `CancelAllOrdersV1Req` class with the given data.
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

class CancelAllOrdersV1ReqBuilder
{
    /**
     * @var CancelAllOrdersV1Req $obj
     */
    private $obj;

    public function __construct(CancelAllOrdersV1Req $obj)
    {
        $this->obj = $obj;
    }
    /**
     * To cancel all limit orders for a specific contract only, unless otherwise specified, all limit orders will be deleted. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
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
     * @return CancelAllOrdersV1Req
     */
    public function build()
    {
        return $this->obj;
    }
}
