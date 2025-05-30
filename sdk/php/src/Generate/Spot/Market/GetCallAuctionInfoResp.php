<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class GetCallAuctionInfoResp implements Response
{
    /**
     * Symbol
     * @var string $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Estimated price
     * @var string $estimatedPrice
     * @Type("string")
     * @SerializedName("estimatedPrice")
     */
    public $estimatedPrice;
    /**
     * Estimated size
     * @var string $estimatedSize
     * @Type("string")
     * @SerializedName("estimatedSize")
     */
    public $estimatedSize;
    /**
     * Sell ​​order minimum price
     * @var string $sellOrderRangeLowPrice
     * @Type("string")
     * @SerializedName("sellOrderRangeLowPrice")
     */
    public $sellOrderRangeLowPrice;
    /**
     * Sell ​​order maximum price
     * @var string $sellOrderRangeHighPrice
     * @Type("string")
     * @SerializedName("sellOrderRangeHighPrice")
     */
    public $sellOrderRangeHighPrice;
    /**
     * Buy order minimum price
     * @var string $buyOrderRangeLowPrice
     * @Type("string")
     * @SerializedName("buyOrderRangeLowPrice")
     */
    public $buyOrderRangeLowPrice;
    /**
     * Buy ​​order maximum price
     * @var string $buyOrderRangeHighPrice
     * @Type("string")
     * @SerializedName("buyOrderRangeHighPrice")
     */
    public $buyOrderRangeHighPrice;
    /**
     * Timestamp (ms)
     * @var int $time
     * @Type("int")
     * @SerializedName("time")
     */
    public $time;

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
            GetCallAuctionInfoResp::class,
            "json"
        );
    }
}
