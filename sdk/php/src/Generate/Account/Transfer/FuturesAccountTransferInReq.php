<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Transfer;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class FuturesAccountTransferInReq implements Serializable
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
     * Currency, including XBT, USDT...
     * @var string $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Amount to be transferred in
     * @var float $amount
     * @Type("float")
     * @SerializedName("amount")
     */
    public $amount;
    /**
     * Payment account type, including MAIN, TRADE
     * - 'MAIN' :
     * - 'TRADE' :
     * @var string $payAccountType
     * @Type("string")
     * @SerializedName("payAccountType")
     */
    public $payAccountType;

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
            FuturesAccountTransferInReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `FuturesAccountTransferInReq` class.
     * The builder pattern allows step-by-step construction of a `FuturesAccountTransferInReq` object.
     * @return FuturesAccountTransferInReqBuilder
     */
    public static function builder()
    {
        return new FuturesAccountTransferInReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `FuturesAccountTransferInReq` class with the given data.
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

class FuturesAccountTransferInReqBuilder
{
    /**
     * @var FuturesAccountTransferInReq $obj
     */
    private $obj;

    public function __construct(FuturesAccountTransferInReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Currency, including XBT, USDT...
     * @param string $value
     * @return self
     */
    public function setCurrency($value)
    {
        $this->obj->currency = $value;
        return $this;
    }

    /**
     * Amount to be transferred in
     * @param float $value
     * @return self
     */
    public function setAmount($value)
    {
        $this->obj->amount = $value;
        return $this;
    }

    /**
     * Payment account type, including MAIN, TRADE
     * - 'MAIN' :
     * - 'TRADE' :
     * @param string $value
     * @return self
     */
    public function setPayAccountType($value)
    {
        $this->obj->payAccountType = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return FuturesAccountTransferInReq
     */
    public function build()
    {
        return $this->obj;
    }
}
