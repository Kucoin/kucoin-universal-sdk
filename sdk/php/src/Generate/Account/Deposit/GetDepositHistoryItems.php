<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Deposit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetDepositHistoryItems implements Serializable
{
    /**
     * Currency
     * @var string|null $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * The chainName of currency
     * @var string|null $chain
     * @Type("string")
     * @SerializedName("chain")
     */
    public $chain;
    /**
     * Status
     * - 'PROCESSING' :
     * - 'SUCCESS' :
     * - 'FAILURE' :
     * @var string|null $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;
    /**
     * Deposit address
     * @var string|null $address
     * @Type("string")
     * @SerializedName("address")
     */
    public $address;
    /**
     * Address remark. If there’s no remark, it is empty.
     * @var string|null $memo
     * @Type("string")
     * @SerializedName("memo")
     */
    public $memo;
    /**
     * Internal deposit or not
     * @var bool|null $isInner
     * @Type("bool")
     * @SerializedName("isInner")
     */
    public $isInner;
    /**
     * Deposit amount
     * @var string|null $amount
     * @Type("string")
     * @SerializedName("amount")
     */
    public $amount;
    /**
     * Fees charged for deposit
     * @var string|null $fee
     * @Type("string")
     * @SerializedName("fee")
     */
    public $fee;
    /**
     * Wallet Txid
     * @var string|null $walletTxId
     * @Type("string")
     * @SerializedName("walletTxId")
     */
    public $walletTxId;
    /**
     * Database record creation time
     * @var int|null $createdAt
     * @Type("int")
     * @SerializedName("createdAt")
     */
    public $createdAt;
    /**
     * Update time of the database record
     * @var int|null $updatedAt
     * @Type("int")
     * @SerializedName("updatedAt")
     */
    public $updatedAt;
    /**
     * remark
     * @var string|null $remark
     * @Type("string")
     * @SerializedName("remark")
     */
    public $remark;
    /**
     * Whether there is any debt.A quick rollback will cause the deposit to fail. If the deposit fails, you will need to repay the balance.
     * @var bool|null $arrears
     * @Type("bool")
     * @SerializedName("arrears")
     */
    public $arrears;

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
            GetDepositHistoryItems::class,
            "json"
        );
    }
}
