<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class AddStopOrderResp implements Response
{
    /**
     * The unique order id generated by the trading system,which can be used later for further actions such as canceling the order.
     * @var string $orderId
     * @Type("string")
     * @SerializedName("orderId")
     */
    public $orderId;

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
        return $serializer->deserialize($json, AddStopOrderResp::class, "json");
    }
}
