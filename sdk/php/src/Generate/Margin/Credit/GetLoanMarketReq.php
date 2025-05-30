<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Credit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetLoanMarketReq implements Serializable
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
        return $serializer->deserialize($json, GetLoanMarketReq::class, "json");
    }
    /**
     * Creates a new instance of the `GetLoanMarketReq` class.
     * The builder pattern allows step-by-step construction of a `GetLoanMarketReq` object.
     * @return GetLoanMarketReqBuilder
     */
    public static function builder()
    {
        return new GetLoanMarketReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetLoanMarketReq` class with the given data.
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

class GetLoanMarketReqBuilder
{
    /**
     * @var GetLoanMarketReq $obj
     */
    private $obj;

    public function __construct(GetLoanMarketReq $obj)
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
     * Get the final object.
     * @return GetLoanMarketReq
     */
    public function build()
    {
        return $this->obj;
    }
}
