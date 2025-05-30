<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetAllSymbolsReq implements Serializable
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
     * [The trading market](https://www.kucoin.com/docs-new/api-222921786)
     * @var string|null $market
     * @Type("string")
     * @SerializedName("market")
     */
    public $market;

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
        return $serializer->deserialize($json, GetAllSymbolsReq::class, "json");
    }
    /**
     * Creates a new instance of the `GetAllSymbolsReq` class.
     * The builder pattern allows step-by-step construction of a `GetAllSymbolsReq` object.
     * @return GetAllSymbolsReqBuilder
     */
    public static function builder()
    {
        return new GetAllSymbolsReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetAllSymbolsReq` class with the given data.
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

class GetAllSymbolsReqBuilder
{
    /**
     * @var GetAllSymbolsReq $obj
     */
    private $obj;

    public function __construct(GetAllSymbolsReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * [The trading market](https://www.kucoin.com/docs-new/api-222921786)
     * @param string $value
     * @return self
     */
    public function setMarket($value)
    {
        $this->obj->market = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return GetAllSymbolsReq
     */
    public function build()
    {
        return $this->obj;
    }
}
