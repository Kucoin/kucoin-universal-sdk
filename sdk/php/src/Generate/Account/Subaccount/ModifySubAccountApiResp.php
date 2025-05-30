<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class ModifySubAccountApiResp implements Response
{
    /**
     * Sub-account name
     * @var string $subName
     * @Type("string")
     * @SerializedName("subName")
     */
    public $subName;
    /**
     * API Key
     * @var string $apiKey
     * @Type("string")
     * @SerializedName("apiKey")
     */
    public $apiKey;
    /**
     * [Permissions](https://www.kucoin.com/docs-new/doc-338144)
     * @var string $permission
     * @Type("string")
     * @SerializedName("permission")
     */
    public $permission;
    /**
     * IP whitelist
     * @var string|null $ipWhitelist
     * @Type("string")
     * @SerializedName("ipWhitelist")
     */
    public $ipWhitelist;

    /**
     * common response
     * @Exclude()
     * @var RestResponse $commonResponse
     */
    public $commonResponse;

    public function setCommonResponse($response): void
    {
        $this->commonResponse = $response;
    }

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
            ModifySubAccountApiResp::class,
            "json"
        );
    }
}
