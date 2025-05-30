<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Credit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetRedeemOrdersItems implements Serializable
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
     * Redeem order ID
     * @var string $redeemOrderNo
     * @Type("string")
     * @SerializedName("redeemOrderNo")
     */
    public $redeemOrderNo;
    /**
     * Redemption size
     * @var string $redeemSize
     * @Type("string")
     * @SerializedName("redeemSize")
     */
    public $redeemSize;
    /**
     * Redeemed size
     * @var string $receiptSize
     * @Type("string")
     * @SerializedName("receiptSize")
     */
    public $receiptSize;
    /**
     * Time of redeem
     * @var string $applyTime
     * @Type("string")
     * @SerializedName("applyTime")
     */
    public $applyTime;
    /**
     * Status: DONE-completed; PENDING-settling
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
            GetRedeemOrdersItems::class,
            "json"
        );
    }
}
