<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Fee;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class GetBasicFeeResp implements Response
{
    /**
     * Base taker fee rate
     * @var string $takerFeeRate
     * @Type("string")
     * @SerializedName("takerFeeRate")
     */
    public $takerFeeRate;
    /**
     * Base maker fee rate
     * @var string $makerFeeRate
     * @Type("string")
     * @SerializedName("makerFeeRate")
     */
    public $makerFeeRate;

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
        return $serializer->deserialize($json, GetBasicFeeResp::class, "json");
    }
}
