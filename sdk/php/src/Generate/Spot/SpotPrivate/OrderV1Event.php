<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\SpotPrivate;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketMessageCallback;
use KuCoin\UniversalSDK\Model\WsMessage;

class OrderV1Event implements Response
{
    /**
     * Cumulative number of cancellations
     * @var string|null $canceledSize
     * @Type("string")
     * @SerializedName("canceledSize")
     */
    public $canceledSize;
    /**
     * Client Order ID: The ClientOid field is a unique ID created by the user
     * @var string $clientOid
     * @Type("string")
     * @SerializedName("clientOid")
     */
    public $clientOid;
    /**
     * Cumulative number filled
     * @var string|null $filledSize
     * @Type("string")
     * @SerializedName("filledSize")
     */
    public $filledSize;
    /**
     * The unique order id generated by the trading system
     * @var string $orderId
     * @Type("string")
     * @SerializedName("orderId")
     */
    public $orderId;
    /**
     * Gateway received the message time (milliseconds)
     * @var int $orderTime
     * @Type("int")
     * @SerializedName("orderTime")
     */
    public $orderTime;
    /**
     * User-specified order type
     * @var string $orderType
     * @Type("string")
     * @SerializedName("orderType")
     */
    public $orderType;
    /**
     * User-specified order size
     * @var string $originSize
     * @Type("string")
     * @SerializedName("originSize")
     */
    public $originSize;
    /**
     * Specify price for currency
     * @var string|null $price
     * @Type("string")
     * @SerializedName("price")
     */
    public $price;
    /**
     * Remain funds
     * @var string|null $remainFunds
     * @Type("string")
     * @SerializedName("remainFunds")
     */
    public $remainFunds;
    /**
     * Remain size
     * @var string|null $remainSize
     * @Type("string")
     * @SerializedName("remainSize")
     */
    public $remainSize;
    /**
     * buy or sell
     * @var string $side
     * @Type("string")
     * @SerializedName("side")
     */
    public $side;
    /**
     * User-specified order size
     * @var string|null $size
     * @Type("string")
     * @SerializedName("size")
     */
    public $size;
    /**
     * Order Status
     * @var string $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;
    /**
     * Symbol
     * @var string $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Match engine received the message time  (nanoseconds)
     * @var int $ts
     * @Type("int")
     * @SerializedName("ts")
     */
    public $ts;
    /**
     * Order Type
     * @var string $type
     * @Type("string")
     * @SerializedName("type")
     */
    public $type;
    /**
     * The size before order update
     * @var string|null $oldSize
     * @Type("string")
     * @SerializedName("oldSize")
     */
    public $oldSize;
    /**
     * Actual Fee Type
     * @var string|null $feeType
     * @Type("string")
     * @SerializedName("feeType")
     */
    public $feeType;
    /**
     * Actual transaction order type, If the counterparty order is an [Hidden/Iceberg Order](https://www.kucoin.com/docs-new/doc-338146), even if it is a maker order, this param will be displayed as taker. For actual trading fee, please refer to the **feeType**
     * @var string|null $liquidity
     * @Type("string")
     * @SerializedName("liquidity")
     */
    public $liquidity;
    /**
     * Match Price (when the type is \"match\")
     * @var string|null $matchPrice
     * @Type("string")
     * @SerializedName("matchPrice")
     */
    public $matchPrice;
    /**
     * Match Size (when the type is \"match\")
     * @var string|null $matchSize
     * @Type("string")
     * @SerializedName("matchSize")
     */
    public $matchSize;
    /**
     * Trade ID: Generated by Matching engine.
     * @var string|null $tradeId
     * @Type("string")
     * @SerializedName("tradeId")
     */
    public $tradeId;

    private function __construct() {}

    /**
     * common response
     * @Exclude()
     * @var WsMessage $commonResponse
     */
    public $commonResponse;

    public function setCommonResponse($response): void
    {
        $this->commonResponse = $response;
    }
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
        return $serializer->deserialize($json, OrderV1Event::class, "json");
    }

    /**
     * @param callable $callback function(string $topic, string $subject, OrderV1Event $data): void
     */
    public static function createCallback(
        callable $callback
    ): OrderV1EventCallbackWrapper {
        return new OrderV1EventCallbackWrapper($callback);
    }
}

class OrderV1EventCallbackWrapper implements WebSocketMessageCallback
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @param callable $callback function(string $topic, string $subject, OrderV1Event $data): void
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function onMessage(WsMessage $msg, Serializer $serializer)
    {
        $event = OrderV1Event::jsonDeserialize(
            $serializer->serialize($msg->rawData, "json"),
            $serializer
        );
        $event->setCommonResponse($msg);
        call_user_func($this->callback, $msg->topic, $msg->subject, $event);
    }
}
