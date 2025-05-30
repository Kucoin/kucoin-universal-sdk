<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetSpotSubAccountsSummaryV1Data implements Serializable
{
    /**
     *
     * @var string $userId
     * @Type("string")
     * @SerializedName("userId")
     */
    public $userId;
    /**
     *
     * @var int $uid
     * @Type("int")
     * @SerializedName("uid")
     */
    public $uid;
    /**
     *
     * @var string $subName
     * @Type("string")
     * @SerializedName("subName")
     */
    public $subName;
    /**
     *
     * @var int $type
     * @Type("int")
     * @SerializedName("type")
     */
    public $type;
    /**
     *
     * @var string $remarks
     * @Type("string")
     * @SerializedName("remarks")
     */
    public $remarks;
    /**
     * Sub-account Permission
     * @var string $access
     * @Type("string")
     * @SerializedName("access")
     */
    public $access;

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
            GetSpotSubAccountsSummaryV1Data::class,
            "json"
        );
    }
}
