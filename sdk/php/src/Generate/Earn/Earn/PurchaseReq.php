<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Earn\Earn;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class PurchaseReq implements Serializable
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
     * Product ID
     * @var string $productId
     * @Type("string")
     * @SerializedName("productId")
     */
    public $productId;
    /**
     * Subscription amount
     * @var string $amount
     * @Type("string")
     * @SerializedName("amount")
     */
    public $amount;
    /**
     * MAIN (funding account), TRADE (spot trading account)
     * - 'MAIN' :
     * - 'TRADE' :
     * @var string $accountType
     * @Type("string")
     * @SerializedName("accountType")
     */
    public $accountType;

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
        return $serializer->deserialize($json, PurchaseReq::class, "json");
    }
    /**
     * Creates a new instance of the `PurchaseReq` class.
     * The builder pattern allows step-by-step construction of a `PurchaseReq` object.
     * @return PurchaseReqBuilder
     */
    public static function builder()
    {
        return new PurchaseReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `PurchaseReq` class with the given data.
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

class PurchaseReqBuilder
{
    /**
     * @var PurchaseReq $obj
     */
    private $obj;

    public function __construct(PurchaseReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Product ID
     * @param string $value
     * @return self
     */
    public function setProductId($value)
    {
        $this->obj->productId = $value;
        return $this;
    }

    /**
     * Subscription amount
     * @param string $value
     * @return self
     */
    public function setAmount($value)
    {
        $this->obj->amount = $value;
        return $this;
    }

    /**
     * MAIN (funding account), TRADE (spot trading account)
     * - 'MAIN' :
     * - 'TRADE' :
     * @param string $value
     * @return self
     */
    public function setAccountType($value)
    {
        $this->obj->accountType = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return PurchaseReq
     */
    public function build()
    {
        return $this->obj;
    }
}
