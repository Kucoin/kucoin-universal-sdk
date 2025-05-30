<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Credit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetPurchaseOrdersItems implements Serializable
{
    /**
     * Currency
     * @var string $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Purchase order ID
     * @var string $purchaseOrderNo
     * @Type("string")
     * @SerializedName("purchaseOrderNo")
     */
    public $purchaseOrderNo;
    /**
     * Total purchase size
     * @var string $purchaseSize
     * @Type("string")
     * @SerializedName("purchaseSize")
     */
    public $purchaseSize;
    /**
     * Executed size
     * @var string $matchSize
     * @Type("string")
     * @SerializedName("matchSize")
     */
    public $matchSize;
    /**
     * Target annualized interest rate
     * @var string $interestRate
     * @Type("string")
     * @SerializedName("interestRate")
     */
    public $interestRate;
    /**
     * Redeemed amount
     * @var string $incomeSize
     * @Type("string")
     * @SerializedName("incomeSize")
     */
    public $incomeSize;
    /**
     * Time of purchase
     * @var int $applyTime
     * @Type("int")
     * @SerializedName("applyTime")
     */
    public $applyTime;
    /**
     * Status: DONE-completed; PENDING-settling
     * - 'DONE' :
     * - 'PENDING' :
     * @var string $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;

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
            GetPurchaseOrdersItems::class,
            "json"
        );
    }
}
