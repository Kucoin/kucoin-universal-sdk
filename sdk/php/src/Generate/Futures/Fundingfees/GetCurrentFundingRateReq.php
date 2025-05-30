<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Futures\Fundingfees;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetCurrentFundingRateReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [
        "symbol" => "symbol",
    ];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     * @Exclude()
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
            GetCurrentFundingRateReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetCurrentFundingRateReq` class.
     * The builder pattern allows step-by-step construction of a `GetCurrentFundingRateReq` object.
     * @return GetCurrentFundingRateReqBuilder
     */
    public static function builder()
    {
        return new GetCurrentFundingRateReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetCurrentFundingRateReq` class with the given data.
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

class GetCurrentFundingRateReqBuilder
{
    /**
     * @var GetCurrentFundingRateReq $obj
     */
    private $obj;

    public function __construct(GetCurrentFundingRateReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220)
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
     * @return GetCurrentFundingRateReq
     */
    public function build()
    {
        return $this->obj;
    }
}
