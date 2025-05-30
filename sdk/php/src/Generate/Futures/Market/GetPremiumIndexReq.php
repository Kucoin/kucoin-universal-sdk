<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Futures\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetPremiumIndexReq implements Serializable
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
     * Symbol of the contract. Please refer to [Get Symbol endpoint: premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Start time (milliseconds)
     * @var int|null $startAt
     * @Type("int")
     * @SerializedName("startAt")
     */
    public $startAt;
    /**
     * End time (milliseconds)
     * @var int|null $endAt
     * @Type("int")
     * @SerializedName("endAt")
     */
    public $endAt;
    /**
     * This parameter functions to judge whether the lookup is reversed. True means “yes”. False means “no”. This parameter is set as True by default.
     * @var bool|null $reverse
     * @Type("bool")
     * @SerializedName("reverse")
     */
    public $reverse = true;
    /**
     * Start offset. The unique attribute of the last returned result of the last request. The data of the first page will be returned by default.
     * @var int|null $offset
     * @Type("int")
     * @SerializedName("offset")
     */
    public $offset;
    /**
     * This parameter functions to judge whether the lookup is forward or not. True means “yes” and False means “no”. This parameter is set as true by default.
     * @var bool|null $forward
     * @Type("bool")
     * @SerializedName("forward")
     */
    public $forward = true;
    /**
     * Max. record count. The default record count is 10; the maximum length cannot exceed 100
     * @var int|null $maxCount
     * @Type("int")
     * @SerializedName("maxCount")
     */
    public $maxCount = 10;

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
            GetPremiumIndexReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetPremiumIndexReq` class.
     * The builder pattern allows step-by-step construction of a `GetPremiumIndexReq` object.
     * @return GetPremiumIndexReqBuilder
     */
    public static function builder()
    {
        return new GetPremiumIndexReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetPremiumIndexReq` class with the given data.
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

class GetPremiumIndexReqBuilder
{
    /**
     * @var GetPremiumIndexReq $obj
     */
    private $obj;

    public function __construct(GetPremiumIndexReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Symbol of the contract. Please refer to [Get Symbol endpoint: premiumsSymbol1M, premiumsSymbol8H](https://www.kucoin.com/docs-new/api-3470220)
     * @param string $value
     * @return self
     */
    public function setSymbol($value)
    {
        $this->obj->symbol = $value;
        return $this;
    }

    /**
     * Start time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setStartAt($value)
    {
        $this->obj->startAt = $value;
        return $this;
    }

    /**
     * End time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setEndAt($value)
    {
        $this->obj->endAt = $value;
        return $this;
    }

    /**
     * This parameter functions to judge whether the lookup is reversed. True means “yes”. False means “no”. This parameter is set as True by default.
     * @param bool $value
     * @return self
     */
    public function setReverse($value)
    {
        $this->obj->reverse = $value;
        return $this;
    }

    /**
     * Start offset. The unique attribute of the last returned result of the last request. The data of the first page will be returned by default.
     * @param int $value
     * @return self
     */
    public function setOffset($value)
    {
        $this->obj->offset = $value;
        return $this;
    }

    /**
     * This parameter functions to judge whether the lookup is forward or not. True means “yes” and False means “no”. This parameter is set as true by default.
     * @param bool $value
     * @return self
     */
    public function setForward($value)
    {
        $this->obj->forward = $value;
        return $this;
    }

    /**
     * Max. record count. The default record count is 10; the maximum length cannot exceed 100
     * @param int $value
     * @return self
     */
    public function setMaxCount($value)
    {
        $this->obj->maxCount = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return GetPremiumIndexReq
     */
    public function build()
    {
        return $this->obj;
    }
}
