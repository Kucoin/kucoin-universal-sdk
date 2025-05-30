<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Fee;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetSpotActualFeeReq implements Serializable
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
     * Trading pair (optional; you can inquire fee rates of 10 trading pairs each time at most)
     * @var string|null $symbols
     * @Type("string")
     * @SerializedName("symbols")
     */
    public $symbols;

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
            GetSpotActualFeeReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetSpotActualFeeReq` class.
     * The builder pattern allows step-by-step construction of a `GetSpotActualFeeReq` object.
     * @return GetSpotActualFeeReqBuilder
     */
    public static function builder()
    {
        return new GetSpotActualFeeReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetSpotActualFeeReq` class with the given data.
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

class GetSpotActualFeeReqBuilder
{
    /**
     * @var GetSpotActualFeeReq $obj
     */
    private $obj;

    public function __construct(GetSpotActualFeeReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Trading pair (optional; you can inquire fee rates of 10 trading pairs each time at most)
     * @param string $value
     * @return self
     */
    public function setSymbols($value)
    {
        $this->obj->symbols = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return GetSpotActualFeeReq
     */
    public function build()
    {
        return $this->obj;
    }
}
