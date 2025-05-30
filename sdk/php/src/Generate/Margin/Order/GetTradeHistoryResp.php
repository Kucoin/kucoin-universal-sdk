<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class GetTradeHistoryResp implements Response
{
    /**
     *
     * @var GetTradeHistoryItems[] $items
     * @Type("array<KuCoin\UniversalSDK\Generate\Margin\Order\GetTradeHistoryItems>")
     * @SerializedName("items")
     */
    public $items;
    /**
     * The ID of the last set of data from the previous data batch. By default, the latest information is given. lastId is used to filter data and paginate. If lastId is not entered, the default is a maximum of 100 returned data items. The return results include lastId, which can be used as a query parameter to look up new data from the next page.
     * @var int $lastId
     * @Type("int")
     * @SerializedName("lastId")
     */
    public $lastId;

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
            GetTradeHistoryResp::class,
            "json"
        );
    }
}
