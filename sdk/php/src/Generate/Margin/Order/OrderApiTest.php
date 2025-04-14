<?php
namespace KuCoin\UniversalSDK\Generate\Margin\Order;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class OrderApiTest extends TestCase
{
    /**
     * @var Serializer $serializer
     */
    private $serializer;

    protected function setUp(): void
    {
        $this->serializer = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(
                    new JsonSerializedHandler()
                );
            })
            ->build();
    }

    function hasAnyNoneNull($object): bool
    {
        $refClass = new ReflectionClass($object);
        $props = $refClass->getProperties();

        $excludeSize = 0;
        $totalSize = sizeof($props);
        foreach ($props as $prop) {
            $doc = $prop->getDocComment();

            if ($doc !== false && strpos($doc, "@Exclude") !== false) {
                $excludeSize++;
                continue;
            }

            $prop->setAccessible(true);

            $value = $prop->getValue($object);
            if ($value !== null) {
                return true;
            }
        }
        return $excludeSize === $totalSize;
    }

    /**
     * addOrder Request
     * Add Order
     * /api/v3/hf/margin/order
     */
    public function testAddOrderRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrder Response
     * Add Order
     * /api/v3/hf/margin/order
     */
    public function testAddOrderResponse()
    {
        $data =
            "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671663e02188630007e21c9c\",\n        \"clientOid\": \"5c52e11203aa677f33e1493fb\",\n        \"borrowSize\": \"10.2\",\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTest Request
     * Add Order Test
     * /api/v3/hf/margin/order/test
     */
    public function testAddOrderTestRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderTestReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderTest Response
     * Add Order Test
     * /api/v3/hf/margin/order/test
     */
    public function testAddOrderTestResponse()
    {
        $data =
            "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"5bd6e9286d99522a52e458de\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"borrowSize\": 10.2,\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderTestResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByOrderId Request
     * Cancel Order By OrderId
     * /api/v3/hf/margin/orders/{orderId}
     */
    public function testCancelOrderByOrderIdRequest()
    {
        $data =
            "{\"orderId\": \"671663e02188630007e21c9c\", \"symbol\": \"BTC-USDT\"}";
        $req = CancelOrderByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByOrderId Response
     * Cancel Order By OrderId
     * /api/v3/hf/margin/orders/{orderId}
     */
    public function testCancelOrderByOrderIdResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"671663e02188630007e21c9c\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByClientOid Request
     * Cancel Order By ClientOid
     * /api/v3/hf/margin/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e1493fb\", \"symbol\": \"BTC-USDT\"}";
        $req = CancelOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByClientOid Response
     * Cancel Order By ClientOid
     * /api/v3/hf/margin/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e1493fb\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelAllOrdersBySymbol Request
     * Cancel All Orders By Symbol
     * /api/v3/hf/margin/orders
     */
    public function testCancelAllOrdersBySymbolRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}";
        $req = CancelAllOrdersBySymbolReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelAllOrdersBySymbol Response
     * Cancel All Orders By Symbol
     * /api/v3/hf/margin/orders
     */
    public function testCancelAllOrdersBySymbolResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":\"success\"}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelAllOrdersBySymbolResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSymbolsWithOpenOrder Request
     * Get Symbols With Open Order
     * /api/v3/hf/margin/order/active/symbols
     */
    public function testGetSymbolsWithOpenOrderRequest()
    {
        $data = "{\"tradeType\": \"MARGIN_TRADE\"}";
        $req = GetSymbolsWithOpenOrderReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSymbolsWithOpenOrder Response
     * Get Symbols With Open Order
     * /api/v3/hf/margin/order/active/symbols
     */
    public function testGetSymbolsWithOpenOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbolSize\": 1,\n        \"symbols\": [\n            \"BTC-USDT\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSymbolsWithOpenOrderResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOpenOrders Request
     * Get Open Orders
     * /api/v3/hf/margin/orders/active
     */
    public function testGetOpenOrdersRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}";
        $req = GetOpenOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOpenOrders Response
     * Get Open Orders
     * /api/v3/hf/margin/orders/active
     */
    public function testGetOpenOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"671667306afcdb000723107f\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"stop\": null,\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": null,\n            \"tags\": null,\n            \"cancelExist\": false,\n            \"tradeType\": \"MARGIN_TRADE\",\n            \"inOrderBook\": true,\n            \"active\": true,\n            \"tax\": \"0\",\n            \"createdAt\": 1729521456248,\n            \"lastUpdatedAt\": 1729521460940\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOpenOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getClosedOrders Request
     * Get Closed Orders
     * /api/v3/hf/margin/orders/done
     */
    public function testGetClosedOrdersRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetClosedOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getClosedOrders Response
     * Get Closed Orders
     * /api/v3/hf/margin/orders/done
     */
    public function testGetClosedOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 136112949351,\n        \"items\": [\n            {\n                \"id\": \"6716491f6afcdb00078365c8\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0\",\n                \"cancelledSize\": \"0.00001\",\n                \"cancelledFunds\": \"0.5\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"stop\": null,\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": null,\n                \"tags\": null,\n                \"cancelExist\": true,\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729513759162,\n                \"lastUpdatedAt\": 1729521126597\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetClosedOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTradeHistory Request
     * Get Trade History
     * /api/v3/hf/margin/fills
     */
    public function testGetTradeHistoryRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetTradeHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTradeHistory Response
     * Get Trade History
     * /api/v3/hf/margin/fills
     */
    public function testGetTradeHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 137891621991,\n                \"symbol\": \"BTC-USDT\",\n                \"tradeId\": 11040911994273793,\n                \"orderId\": \"671868085584bc0007d85f46\",\n                \"counterOrderId\": \"67186805b7cbdf00071621f9\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"67141.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.671416\",\n                \"fee\": \"0.000671416\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"tax\": \"0\",\n                \"taxRate\": \"0\",\n                \"type\": \"limit\",\n                \"createdAt\": 1729652744998\n            }\n        ],\n        \"lastId\": 137891621991\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTradeHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByOrderId Request
     * Get Order By OrderId
     * /api/v3/hf/margin/orders/{orderId}
     */
    public function testGetOrderByOrderIdRequest()
    {
        $data =
            "{\"orderId\": \"671667306afcdb000723107f\", \"symbol\": \"BTC-USDT\"}";
        $req = GetOrderByOrderIdReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByOrderId Response
     * Get Order By OrderId
     * /api/v3/hf/margin/orders/{orderId}
     */
    public function testGetOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByClientOid Request
     * Get Order By ClientOid
     * /api/v3/hf/margin/orders/client-order/{clientOid}
     */
    public function testGetOrderByClientOidRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}";
        $req = GetOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByClientOid Response
     * Get Order By ClientOid
     * /api/v3/hf/margin/orders/client-order/{clientOid}
     */
    public function testGetOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderV1 Request
     * Add Order - V1
     * /api/v1/margin/order
     */
    public function testAddOrderV1Request()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderV1Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderV1 Response
     * Add Order - V1
     * /api/v1/margin/order
     */
    public function testAddOrderV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderV1Resp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTestV1 Request
     * Add Order Test - V1
     * /api/v1/margin/order/test
     */
    public function testAddOrderTestV1Request()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderTestV1Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderTestV1 Response
     * Add Order Test - V1
     * /api/v1/margin/order/test
     */
    public function testAddOrderTestV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderTestV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
