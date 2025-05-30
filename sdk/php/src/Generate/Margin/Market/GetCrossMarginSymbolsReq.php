<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetCrossMarginSymbolsReq implements Serializable
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
     * If not provided, all cross margin symbol will be queried. If provided, only the specified symbol will be queried.
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
            GetCrossMarginSymbolsReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetCrossMarginSymbolsReq` class.
     * The builder pattern allows step-by-step construction of a `GetCrossMarginSymbolsReq` object.
     * @return GetCrossMarginSymbolsReqBuilder
     */
    public static function builder()
    {
        return new GetCrossMarginSymbolsReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetCrossMarginSymbolsReq` class with the given data.
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

class GetCrossMarginSymbolsReqBuilder
{
    /**
     * @var GetCrossMarginSymbolsReq $obj
     */
    private $obj;

    public function __construct(GetCrossMarginSymbolsReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * If not provided, all cross margin symbol will be queried. If provided, only the specified symbol will be queried.
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
     * @return GetCrossMarginSymbolsReq
     */
    public function build()
    {
        return $this->obj;
    }
}
