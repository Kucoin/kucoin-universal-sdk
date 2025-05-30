<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetSpotSubAccountsSummaryV2Items implements Serializable
{
    /**
     * Sub-account User ID
     * @var string $userId
     * @Type("string")
     * @SerializedName("userId")
     */
    public $userId;
    /**
     * Sub-account UID
     * @var int $uid
     * @Type("int")
     * @SerializedName("uid")
     */
    public $uid;
    /**
     * Sub-account name
     * @var string $subName
     * @Type("string")
     * @SerializedName("subName")
     */
    public $subName;
    /**
     * Sub-account; 2:Enable, 3:Frozen
     * - 2 : Enable
     * - 3 : Frozen
     * @var int $status
     * @Type("int")
     * @SerializedName("status")
     */
    public $status;
    /**
     * Sub-account type
     * - 0 : Normal sub-account
     * - 1 : Robot sub-account
     * - 2 : New financial sub-account
     * - 5 : Asset management sub-account
     * @var int $type
     * @Type("int")
     * @SerializedName("type")
     */
    public $type;
    /**
     * Sub-account Permission
     * @var string $access
     * @Type("string")
     * @SerializedName("access")
     */
    public $access;
    /**
     * Time of event
     * @var int $createdAt
     * @Type("int")
     * @SerializedName("createdAt")
     */
    public $createdAt;
    /**
     * Remarks
     * @var string $remarks
     * @Type("string")
     * @SerializedName("remarks")
     */
    public $remarks;
    /**
     * Sub-account Permissions
     * @var string[] $tradeTypes
     * @Type("array<string>")
     * @SerializedName("tradeTypes")
     */
    public $tradeTypes;
    /**
     * Sub-account active permissions: If you do not have the corresponding permissions, you must log in to the sub-account and go to the corresponding web page to activate.
     * @var string[] $openedTradeTypes
     * @Type("array<string>")
     * @SerializedName("openedTradeTypes")
     */
    public $openedTradeTypes;
    /**
     *
     * @var string $hostedStatus
     * @Type("string")
     * @SerializedName("hostedStatus")
     */
    public $hostedStatus;

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
            GetSpotSubAccountsSummaryV2Items::class,
            "json"
        );
    }
}
