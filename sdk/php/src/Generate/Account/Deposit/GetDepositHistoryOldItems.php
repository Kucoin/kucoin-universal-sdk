<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Deposit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetDepositHistoryOldItems implements Serializable
{
    /**
     * Currency
     * @var string|null $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Database record creation time
     * @var int|null $createAt
     * @Type("int")
     * @SerializedName("createAt")
     */
    public $createAt;
    /**
     * Deposit amount
     * @var string|null $amount
     * @Type("string")
     * @SerializedName("amount")
     */
    public $amount;
    /**
     * Wallet Txid
     * @var string|null $walletTxId
     * @Type("string")
     * @SerializedName("walletTxId")
     */
    public $walletTxId;
    /**
     * Internal deposit or not
     * @var bool|null $isInner
     * @Type("bool")
     * @SerializedName("isInner")
     */
    public $isInner;
    /**
     *
     * - 'PROCESSING' :
     * - 'SUCCESS' :
     * - 'FAILURE' :
     * @var string|null $status
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
            GetDepositHistoryOldItems::class,
            "json"
        );
    }
}
