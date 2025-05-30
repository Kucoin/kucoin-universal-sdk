<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Credit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class RedeemReq implements Serializable
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
     * Currency
     * @var string $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Redemption amount
     * @var string $size
     * @Type("string")
     * @SerializedName("size")
     */
    public $size;
    /**
     * Purchase order ID
     * @var string $purchaseOrderNo
     * @Type("string")
     * @SerializedName("purchaseOrderNo")
     */
    public $purchaseOrderNo;

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
        return $serializer->deserialize($json, RedeemReq::class, "json");
    }
    /**
     * Creates a new instance of the `RedeemReq` class.
     * The builder pattern allows step-by-step construction of a `RedeemReq` object.
     * @return RedeemReqBuilder
     */
    public static function builder()
    {
        return new RedeemReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `RedeemReq` class with the given data.
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

class RedeemReqBuilder
{
    /**
     * @var RedeemReq $obj
     */
    private $obj;

    public function __construct(RedeemReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Currency
     * @param string $value
     * @return self
     */
    public function setCurrency($value)
    {
        $this->obj->currency = $value;
        return $this;
    }

    /**
     * Redemption amount
     * @param string $value
     * @return self
     */
    public function setSize($value)
    {
        $this->obj->size = $value;
        return $this;
    }

    /**
     * Purchase order ID
     * @param string $value
     * @return self
     */
    public function setPurchaseOrderNo($value)
    {
        $this->obj->purchaseOrderNo = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return RedeemReq
     */
    public function build()
    {
        return $this->obj;
    }
}
