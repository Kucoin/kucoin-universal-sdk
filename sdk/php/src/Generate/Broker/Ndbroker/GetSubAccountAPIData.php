<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Broker\Ndbroker;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetSubAccountAPIData implements Serializable
{
    /**
     * Sub-account UID
     * @var string $uid
     * @Type("string")
     * @SerializedName("uid")
     */
    public $uid;
    /**
     * apikey remarks
     * @var string $label
     * @Type("string")
     * @SerializedName("label")
     */
    public $label;
    /**
     * apiKey
     * @var string $apiKey
     * @Type("string")
     * @SerializedName("apiKey")
     */
    public $apiKey;
    /**
     * apiVersion
     * @var int $apiVersion
     * @Type("int")
     * @SerializedName("apiVersion")
     */
    public $apiVersion;
    /**
     * [Permissions](https://www.kucoin.com/docs-new/doc-338144) group list
     * - 'General' :
     * - 'Spot' :
     * - 'Futures' :
     * @var string[] $permissions
     * @Type("array<string>")
     * @SerializedName("permissions")
     */
    public $permissions;
    /**
     * IP whitelist list
     * @var string[] $ipWhitelist
     * @Type("array<string>")
     * @SerializedName("ipWhitelist")
     */
    public $ipWhitelist;
    /**
     * Creation time, Unix timestamp (milliseconds)
     * @var int $createdAt
     * @Type("int")
     * @SerializedName("createdAt")
     */
    public $createdAt;

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
            GetSubAccountAPIData::class,
            "json"
        );
    }
}
