<?php
namespace KuCoin\UniversalSDK\Generate\Spot\Order;

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
     * /api/v1/hf/orders
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
     * /api/v1/hf/orders
     */
    public function testAddOrderResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderSync Request
     * Add Order Sync
     * /api/v1/hf/orders/sync
     */
    public function testAddOrderSyncRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}";
        $req = AddOrderSyncReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderSync Response
     * Add Order Sync
     * /api/v1/hf/orders/sync
     */
    public function testAddOrderSyncResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"67111a7cb7cbdf000703e1f6\",\"clientOid\":\"5c52e11203aa677f33e493f\",\"orderTime\":1729174140586,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729174140588}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderSyncResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTest Request
     * Add Order Test
     * /api/v1/hf/orders/test
     */
    public function testAddOrderTestRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}";
        $req = AddOrderTestReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderTest Response
     * Add Order Test
     * /api/v1/hf/orders/test
     */
    public function testAddOrderTestResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderTestResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchAddOrders Request
     * Batch Add Orders
     * /api/v1/hf/orders/multi
     */
    public function testBatchAddOrdersRequest()
    {
        $data =
            "{\"orderList\": [{\"clientOid\": \"client order id 12\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 13\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}";
        $req = BatchAddOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchAddOrders Response
     * Batch Add Orders
     * /api/v1/hf/orders/multi
     */
    public function testBatchAddOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"orderId\": \"6710d8336afcdb0007319c27\",\n            \"clientOid\": \"client order id 12\",\n            \"success\": true\n        },\n        {\n            \"success\": false,\n            \"failMsg\": \"The order funds should more then 0.1 USDT.\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchAddOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchAddOrdersSync Request
     * Batch Add Orders Sync
     * /api/v1/hf/orders/multi/sync
     */
    public function testBatchAddOrdersSyncRequest()
    {
        $data =
            "{\"orderList\": [{\"clientOid\": \"client order id 13\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 14\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}";
        $req = BatchAddOrdersSyncReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchAddOrdersSync Response
     * Batch Add Orders Sync
     * /api/v1/hf/orders/multi/sync
     */
    public function testBatchAddOrdersSyncResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":[{\"orderId\":\"6711195e5584bc0007bd5aef\",\"clientOid\":\"client order id 13\",\"orderTime\":1729173854299,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729173854326,\"success\":true},{\"success\":false,\"failMsg\":\"The order funds should more then 0.1 USDT.\"}]}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchAddOrdersSyncResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByOrderId Request
     * Cancel Order By OrderId
     * /api/v1/hf/orders/{orderId}
     */
    public function testCancelOrderByOrderIdRequest()
    {
        $data =
            "{\"orderId\": \"671124f9365ccb00073debd4\", \"symbol\": \"BTC-USDT\"}";
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
     * /api/v1/hf/orders/{orderId}
     */
    public function testCancelOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671124f9365ccb00073debd4\"\n    }\n}";
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
     * cancelOrderByOrderIdSync Request
     * Cancel Order By OrderId Sync
     * /api/v1/hf/orders/sync/{orderId}
     */
    public function testCancelOrderByOrderIdSyncRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderId\": \"671128ee365ccb0007534d45\"}";
        $req = CancelOrderByOrderIdSyncReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByOrderIdSync Response
     * Cancel Order By OrderId Sync
     * /api/v1/hf/orders/sync/{orderId}
     */
    public function testCancelOrderByOrderIdSyncResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671128ee365ccb0007534d45\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByOrderIdSyncResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByClientOid Request
     * Cancel Order By ClientOid
     * /api/v1/hf/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}";
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
     * /api/v1/hf/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e493fb\"}}";
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
     * cancelOrderByClientOidSync Request
     * Cancel Order By ClientOid Sync
     * /api/v1/hf/orders/sync/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidSyncRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}";
        $req = CancelOrderByClientOidSyncReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByClientOidSync Response
     * Cancel Order By ClientOid Sync
     * /api/v1/hf/orders/sync/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidSyncResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByClientOidSyncResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelPartialOrder Request
     * Cancel Partial Order
     * /api/v1/hf/orders/cancel/{orderId}
     */
    public function testCancelPartialOrderRequest()
    {
        $data =
            "{\"orderId\": \"6711f73c1ef16c000717bb31\", \"symbol\": \"BTC-USDT\", \"cancelSize\": \"0.00001\"}";
        $req = CancelPartialOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelPartialOrder Response
     * Cancel Partial Order
     * /api/v1/hf/orders/cancel/{orderId}
     */
    public function testCancelPartialOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"6711f73c1ef16c000717bb31\",\n        \"cancelSize\": \"0.00001\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelPartialOrderResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelAllOrdersBySymbol Request
     * Cancel All Orders By Symbol
     * /api/v1/hf/orders
     */
    public function testCancelAllOrdersBySymbolRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\"}";
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
     * /api/v1/hf/orders
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
     * cancelAllOrders Request
     * Cancel All Orders
     * /api/v1/hf/orders/cancelAll
     */
    public function testCancelAllOrdersRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * cancelAllOrders Response
     * Cancel All Orders
     * /api/v1/hf/orders/cancelAll
     */
    public function testCancelAllOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"succeedSymbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ],\n        \"failedSymbols\": []\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelAllOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyOrder Request
     * Modify Order
     * /api/v1/hf/orders/alter
     */
    public function testModifyOrderRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderId\": \"670fd33bf9406e0007ab3945\", \"newPrice\": \"30000\", \"newSize\": \"0.0001\"}";
        $req = ModifyOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyOrder Response
     * Modify Order
     * /api/v1/hf/orders/alter
     */
    public function testModifyOrderResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"newOrderId\":\"67112258f9406e0007408827\",\"clientOid\":\"client order id 12\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByOrderId Request
     * Get Order By OrderId
     * /api/v1/hf/orders/{orderId}
     */
    public function testGetOrderByOrderIdRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderId\": \"6717422bd51c29000775ea03\"}";
        $req = GetOrderByOrderIdReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByOrderId Response
     * Get Order By OrderId
     * /api/v1/hf/orders/{orderId}
     */
    public function testGetOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}";
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
     * /api/v1/hf/orders/client-order/{clientOid}
     */
    public function testGetOrderByClientOidRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}";
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
     * /api/v1/hf/orders/client-order/{clientOid}
     */
    public function testGetOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}";
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
     * getSymbolsWithOpenOrder Request
     * Get Symbols With Open Order
     * /api/v1/hf/orders/active/symbols
     */
    public function testGetSymbolsWithOpenOrderRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getSymbolsWithOpenOrder Response
     * Get Symbols With Open Order
     * /api/v1/hf/orders/active/symbols
     */
    public function testGetSymbolsWithOpenOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ]\n    }\n}";
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
     * /api/v1/hf/orders/active
     */
    public function testGetOpenOrdersRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\"}";
        $req = GetOpenOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOpenOrders Response
     * Get Open Orders
     * /api/v1/hf/orders/active
     */
    public function testGetOpenOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"67120bbef094e200070976f6\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": \"order remarks\",\n            \"tags\": \"order tags\",\n            \"cancelExist\": false,\n            \"tradeType\": \"TRADE\",\n            \"inOrderBook\": true,\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"tax\": \"0\",\n            \"active\": true,\n            \"createdAt\": 1729235902748,\n            \"lastUpdatedAt\": 1729235909862\n        }\n    ]\n}";
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
     * getOpenOrdersByPage Request
     * Get Open Orders By Page
     * /api/v1/hf/orders/active/page
     */
    public function testGetOpenOrdersByPageRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\", \"pageNum\": 1, \"pageSize\": 20}";
        $req = GetOpenOrdersByPageReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOpenOrdersByPage Response
     * Get Open Orders By Page
     * /api/v1/hf/orders/active/page
     */
    public function testGetOpenOrdersByPageResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 20,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"67c1437ea5226600071cc080\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"createdAt\": 1740718974367,\n                \"lastUpdatedAt\": 1741867658590,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": true,\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"remainSize\": \"0.00001\",\n                \"remainFunds\": \"0.5\",\n                \"tax\": \"0\",\n                \"active\": true\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOpenOrdersByPageResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getClosedOrders Request
     * Get Closed Orders
     * /api/v1/hf/orders/done
     */
    public function testGetClosedOrdersRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetClosedOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getClosedOrders Response
     * Get Closed Orders
     * /api/v1/hf/orders/done
     */
    public function testGetClosedOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 19814995255305,\n        \"items\": [\n            {\n                \"id\": \"6717422bd51c29000775ea03\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"70000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.7\",\n                \"dealSize\": \"0.00001\",\n                \"dealFunds\": \"0.677176\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0.022824\",\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"fee\": \"0.000677176\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515444,\n                \"lastUpdatedAt\": 1729577515481\n            }\n        ]\n    }\n}";
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
     * /api/v1/hf/fills
     */
    public function testGetTradeHistoryRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetTradeHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTradeHistory Response
     * Get Trade History
     * /api/v1/hf/fills
     */
    public function testGetTradeHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 19814995255305,\n                \"orderId\": \"6717422bd51c29000775ea03\",\n                \"counterOrderId\": \"67174228135f9e000709da8c\",\n                \"tradeId\": 11029373945659392,\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"type\": \"limit\",\n                \"forceTaker\": false,\n                \"price\": \"67717.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.677176\",\n                \"fee\": \"0.000677176\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"taxRate\": \"0\",\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515473\n            }\n        ],\n        \"lastId\": 19814995255305\n    }\n}";
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
     * getDCP Request
     * Get DCP
     * /api/v1/hf/orders/dead-cancel-all/query
     */
    public function testGetDCPRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getDCP Response
     * Get DCP
     * /api/v1/hf/orders/dead-cancel-all/query
     */
    public function testGetDCPResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timeout\": 5,\n        \"symbols\": \"BTC-USDT,ETH-USDT\",\n        \"currentTime\": 1729241305,\n        \"triggerTime\": 1729241308\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDCPResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * setDCP Request
     * Set DCP
     * /api/v1/hf/orders/dead-cancel-all
     */
    public function testSetDCPRequest()
    {
        $data = "{\"timeout\": 5, \"symbols\": \"BTC-USDT,ETH-USDT\"}";
        $req = SetDCPReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * setDCP Response
     * Set DCP
     * /api/v1/hf/orders/dead-cancel-all
     */
    public function testSetDCPResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"currentTime\":1729656588,\"triggerTime\":1729656593}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = SetDCPResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addStopOrder Request
     * Add Stop Order
     * /api/v1/stop-order
     */
    public function testAddStopOrderRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"stopPrice\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}";
        $req = AddStopOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addStopOrder Response
     * Add Stop Order
     * /api/v1/stop-order
     */
    public function testAddStopOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"670fd33bf9406e0007ab3945\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddStopOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelStopOrderByClientOid Request
     * Cancel Stop Order By ClientOid
     * /api/v1/stop-order/cancelOrderByClientOid
     */
    public function testCancelStopOrderByClientOidRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"689ff597f4414061aa819cc414836abd\"}";
        $req = CancelStopOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelStopOrderByClientOid Response
     * Cancel Stop Order By ClientOid
     * /api/v1/stop-order/cancelOrderByClientOid
     */
    public function testCancelStopOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"vs8hoo8ksc8mario0035a74n\",\n        \"clientOid\": \"689ff597f4414061aa819cc414836abd\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelStopOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelStopOrderByOrderId Request
     * Cancel Stop Order By OrderId
     * /api/v1/stop-order/{orderId}
     */
    public function testCancelStopOrderByOrderIdRequest()
    {
        $data = "{\"orderId\": \"671124f9365ccb00073debd4\"}";
        $req = CancelStopOrderByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelStopOrderByOrderId Response
     * Cancel Stop Order By OrderId
     * /api/v1/stop-order/{orderId}
     */
    public function testCancelStopOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelStopOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchCancelStopOrder Request
     * Batch Cancel Stop Orders
     * /api/v1/stop-order/cancel
     */
    public function testBatchCancelStopOrderRequest()
    {
        $data =
            "{\"symbol\": \"example_string_default_value\", \"tradeType\": \"example_string_default_value\", \"orderIds\": \"example_string_default_value\"}";
        $req = BatchCancelStopOrderReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchCancelStopOrder Response
     * Batch Cancel Stop Orders
     * /api/v1/stop-order/cancel
     */
    public function testBatchCancelStopOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchCancelStopOrderResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getStopOrdersList Request
     * Get Stop Orders List
     * /api/v1/stop-order
     */
    public function testGetStopOrdersListRequest()
    {
        $data =
            "{\"symbol\": \"example_string_default_value\", \"side\": \"example_string_default_value\", \"type\": \"limit\", \"tradeType\": \"example_string_default_value\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"stop\": \"example_string_default_value\"}";
        $req = GetStopOrdersListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getStopOrdersList Response
     * Get Stop Orders List
     * /api/v1/stop-order
     */
    public function testGetStopOrdersListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 2,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"vs93gptvr9t2fsql003l8k5p\",\n                \"symbol\": \"BTC-USDT\",\n                \"userId\": \"633559791e1cbc0001f319bc\",\n                \"status\": \"NEW\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000.00000000000000000000\",\n                \"size\": \"0.00001000000000000000\",\n                \"funds\": null,\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": -1,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f222233e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"relatedNo\": null,\n                \"orderTime\": 1740626554883000024,\n                \"domainId\": \"kucoin\",\n                \"tradeSource\": \"USER\",\n                \"tradeType\": \"TRADE\",\n                \"feeCurrency\": \"USDT\",\n                \"takerFeeRate\": \"0.00100000000000000000\",\n                \"makerFeeRate\": \"0.00100000000000000000\",\n                \"createdAt\": 1740626554884,\n                \"stop\": \"loss\",\n                \"stopTriggerTime\": null,\n                \"stopPrice\": \"60000.00000000000000000000\",\n                \"limitPrice\": null,\n                \"pop\": null,\n                \"activateCondition\": null\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetStopOrdersListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getStopOrderByOrderId Request
     * Get Stop Order By OrderId
     * /api/v1/stop-order/{orderId}
     */
    public function testGetStopOrderByOrderIdRequest()
    {
        $data = "{\"orderId\": \"example_string_default_value\"}";
        $req = GetStopOrderByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getStopOrderByOrderId Response
     * Get Stop Order By OrderId
     * /api/v1/stop-order/{orderId}
     */
    public function testGetStopOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"vs8hoo8q2ceshiue003b67c0\",\n        \"symbol\": \"KCS-USDT\",\n        \"userId\": \"60fe4956c43cbc0006562c2c\",\n        \"status\": \"NEW\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"0.01000000000000000000\",\n        \"size\": \"0.01000000000000000000\",\n        \"funds\": null,\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"cancelAfter\": -1,\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": null,\n        \"channel\": \"API\",\n        \"clientOid\": \"40e0eb9efe6311eb8e58acde48001122\",\n        \"remark\": null,\n        \"tags\": null,\n        \"orderTime\": 1629098781127530200,\n        \"domainId\": \"kucoin\",\n        \"tradeSource\": \"USER\",\n        \"tradeType\": \"TRADE\",\n        \"feeCurrency\": \"USDT\",\n        \"takerFeeRate\": \"0.00200000000000000000\",\n        \"makerFeeRate\": \"0.00200000000000000000\",\n        \"createdAt\": 1629098781128,\n        \"stop\": \"loss\",\n        \"stopTriggerTime\": null,\n        \"stopPrice\": \"10.00000000000000000000\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetStopOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getStopOrderByClientOid Request
     * Get Stop Order By ClientOid
     * /api/v1/stop-order/queryOrderByClientOid
     */
    public function testGetStopOrderByClientOidRequest()
    {
        $data =
            "{\"clientOid\": \"example_string_default_value\", \"symbol\": \"example_string_default_value\"}";
        $req = GetStopOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getStopOrderByClientOid Response
     * Get Stop Order By ClientOid
     * /api/v1/stop-order/queryOrderByClientOid
     */
    public function testGetStopOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"vs8hoo8os561f5np0032vngj\",\n            \"symbol\": \"KCS-USDT\",\n            \"userId\": \"60fe4956c43cbc0006562c2c\",\n            \"status\": \"NEW\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"0.01000000000000000000\",\n            \"size\": \"0.01000000000000000000\",\n            \"funds\": null,\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"cancelAfter\": -1,\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": null,\n            \"channel\": \"API\",\n            \"clientOid\": \"2b700942b5db41cebe578cff48960e09\",\n            \"remark\": null,\n            \"tags\": null,\n            \"orderTime\": 1629020492834532600,\n            \"domainId\": \"kucoin\",\n            \"tradeSource\": \"USER\",\n            \"tradeType\": \"TRADE\",\n            \"feeCurrency\": \"USDT\",\n            \"takerFeeRate\": \"0.00200000000000000000\",\n            \"makerFeeRate\": \"0.00200000000000000000\",\n            \"createdAt\": 1629020492837,\n            \"stop\": \"loss\",\n            \"stopTriggerTime\": null,\n            \"stopPrice\": \"1.00000000000000000000\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetStopOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOcoOrder Request
     * Add OCO Order
     * /api/v3/oco/order
     */
    public function testAddOcoOrderRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"94000\", \"size\": \"0.1\", \"clientOid\": \"5c52e11203aa67f1e493fb\", \"stopPrice\": \"98000\", \"limitPrice\": \"96000\", \"remark\": \"this is remark\", \"tradeType\": \"TRADE\"}";
        $req = AddOcoOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOcoOrder Response
     * Add OCO Order
     * /api/v3/oco/order
     */
    public function testAddOcoOrderResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"674c316e688dea0007c7b986\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOcoOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOcoOrderByOrderId Request
     * Cancel OCO Order By OrderId
     * /api/v3/oco/order/{orderId}
     */
    public function testCancelOcoOrderByOrderIdRequest()
    {
        $data = "{\"orderId\": \"674c316e688dea0007c7b986\"}";
        $req = CancelOcoOrderByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOcoOrderByOrderId Response
     * Cancel OCO Order By OrderId
     * /api/v3/oco/order/{orderId}
     */
    public function testCancelOcoOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6kkmkk57003gok16\",\n            \"vs93gpqc6kkmkk57003gok17\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOcoOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOcoOrderByClientOid Request
     * Cancel OCO Order By ClientOid
     * /api/v3/oco/client-order/{clientOid}
     */
    public function testCancelOcoOrderByClientOidRequest()
    {
        $data = "{\"clientOid\": \"5c52e11203aa67f1e493fb\"}";
        $req = CancelOcoOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOcoOrderByClientOid Response
     * Cancel OCO Order By ClientOid
     * /api/v3/oco/client-order/{clientOid}
     */
    public function testCancelOcoOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6r0mkk57003gok3h\",\n            \"vs93gpqc6r0mkk57003gok3i\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOcoOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchCancelOcoOrders Request
     * Batch Cancel OCO Order
     * /api/v3/oco/orders
     */
    public function testBatchCancelOcoOrdersRequest()
    {
        $data =
            "{\"orderIds\": \"674c388172cf2800072ee746,674c38bdfd8300000795167e\", \"symbol\": \"BTC-USDT\"}";
        $req = BatchCancelOcoOrdersReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchCancelOcoOrders Response
     * Batch Cancel OCO Order
     * /api/v3/oco/orders
     */
    public function testBatchCancelOcoOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc750mkk57003gok6i\",\n            \"vs93gpqc750mkk57003gok6j\",\n            \"vs93gpqc75c39p83003tnriu\",\n            \"vs93gpqc75c39p83003tnriv\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchCancelOcoOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOcoOrderByOrderId Request
     * Get OCO Order By OrderId
     * /api/v3/oco/order/{orderId}
     */
    public function testGetOcoOrderByOrderIdRequest()
    {
        $data = "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}";
        $req = GetOcoOrderByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOcoOrderByOrderId Response
     * Get OCO Order By OrderId
     * /api/v3/oco/order/{orderId}
     */
    public function testGetOcoOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOcoOrderByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOcoOrderByClientOid Request
     * Get OCO Order By ClientOid
     * /api/v3/oco/client-order/{clientOid}
     */
    public function testGetOcoOrderByClientOidRequest()
    {
        $data = "{\"clientOid\": \"5c52e1203aa6f3g7f1e493fb\"}";
        $req = GetOcoOrderByClientOidReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOcoOrderByClientOid Response
     * Get OCO Order By ClientOid
     * /api/v3/oco/client-order/{clientOid}
     */
    public function testGetOcoOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n        \"orderTime\": 1733049594803,\n        \"status\": \"NEW\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOcoOrderByClientOidResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOcoOrderDetailByOrderId Request
     * Get OCO Order Detail By OrderId
     * /api/v3/oco/order/details/{orderId}
     */
    public function testGetOcoOrderDetailByOrderIdRequest()
    {
        $data = "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}";
        $req = GetOcoOrderDetailByOrderIdReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOcoOrderDetailByOrderId Response
     * Get OCO Order Detail By OrderId
     * /api/v3/oco/order/details/{orderId}
     */
    public function testGetOcoOrderDetailByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\",\n        \"orders\": [\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelj\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"94000.00000000000000000000\",\n                \"stopPrice\": \"94000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            },\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelk\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"96000.00000000000000000000\",\n                \"stopPrice\": \"98000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOcoOrderDetailByOrderIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOcoOrderList Request
     * Get OCO Order List
     * /api/v3/oco/orders
     */
    public function testGetOcoOrderListRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"startAt\": 123456, \"endAt\": 123456, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"currentPage\": 1}";
        $req = GetOcoOrderListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOcoOrderList Response
     * Get OCO Order List
     * /api/v3/oco/orders
     */
    public function testGetOcoOrderListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n                \"symbol\": \"BTC-USDT\",\n                \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n                \"orderTime\": 1733049594803,\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOcoOrderListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderOld Request
     * Add Order - Old
     * /api/v1/orders
     */
    public function testAddOrderOldRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderOldReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderOld Response
     * Add Order - Old
     * /api/v1/orders
     */
    public function testAddOrderOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8635b38d120007709c0f\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderOldResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTestOld Request
     * Add Order Test - Old
     * /api/v1/orders/test
     */
    public function testAddOrderTestOldRequest()
    {
        $data =
            "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}";
        $req = AddOrderTestOldReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderTestOld Response
     * Add Order Test - Old
     * /api/v1/orders/test
     */
    public function testAddOrderTestOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8776291d9e00074f1edf\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderTestOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchAddOrdersOld Request
     * Batch Add Orders - Old
     * /api/v1/orders/multi
     */
    public function testBatchAddOrdersOldRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderList\": [{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"50000\", \"size\": \"0.0001\"}, {\"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"49999\", \"size\": \"0.0001\"}]}";
        $req = BatchAddOrdersOldReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchAddOrdersOld Response
     * Batch Add Orders - Old
     * /api/v1/orders/multi
     */
    public function testBatchAddOrdersOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"data\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dfef434f0007efc431\",\n                \"status\": \"success\",\n                \"failMsg\": null,\n                \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"\n            },\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"49999\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dffb378b00077b9c20\",\n                \"status\": \"fail\",\n                \"failMsg\": \"Balance insufficient!\",\n                \"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchAddOrdersOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByOrderIdOld Request
     * Cancel Order By OrderId - Old
     * /api/v1/orders/{orderId}
     */
    public function testCancelOrderByOrderIdOldRequest()
    {
        $data = "{\"orderId\": \"674a97dfef434f0007efc431\"}";
        $req = CancelOrderByOrderIdOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByOrderIdOld Response
     * Cancel Order By OrderId - Old
     * /api/v1/orders/{orderId}
     */
    public function testCancelOrderByOrderIdOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a97dfef434f0007efc431\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByOrderIdOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByClientOidOld Request
     * Cancel Order By ClientOid - Old
     * /api/v1/order/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidOldRequest()
    {
        $data = "{\"clientOid\": \"5c52e11203aa677f331e493fb\"}";
        $req = CancelOrderByClientOidOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderByClientOidOld Response
     * Cancel Order By ClientOid - Old
     * /api/v1/order/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"67c3252a63d25e0007f91de9\",\n        \"clientOid\": \"5c52e11203aa677f331e493fb\",\n        \"cancelledOcoOrderIds\": null\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByClientOidOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchCancelOrderOld Request
     * Batch Cancel Order - Old
     * /api/v1/orders
     */
    public function testBatchCancelOrderOldRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"TRADE\"}";
        $req = BatchCancelOrderOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchCancelOrderOld Response
     * Batch Cancel Order - Old
     * /api/v1/orders
     */
    public function testBatchCancelOrderOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a8635b38d120007709c0f\",\n            \"674a8630439c100007d3bce1\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchCancelOrderOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrdersListOld Request
     * Get Orders List - Old
     * /api/v1/orders
     */
    public function testGetOrdersListOldRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"status\": \"active\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetOrdersListOldReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrdersListOld Response
     * Get Orders List - Old
     * /api/v1/orders
     */
    public function testGetOrdersListOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"674a9a872033a50007e2790d\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0\",\n                \"dealFunds\": \"0\",\n                \"dealSize\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"isActive\": false,\n                \"cancelExist\": true,\n                \"createdAt\": 1732942471752,\n                \"tradeType\": \"TRADE\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrdersListOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRecentOrdersListOld Request
     * Get Recent Orders List - Old
     * /api/v1/limit/orders
     */
    public function testGetRecentOrdersListOldRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getRecentOrdersListOld Response
     * Get Recent Orders List - Old
     * /api/v1/limit/orders
     */
    public function testGetRecentOrdersListOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"674a9a872033a50007e2790d\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0\",\n            \"dealFunds\": \"0\",\n            \"dealSize\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n            \"remark\": \"order remarks\",\n            \"tags\": null,\n            \"isActive\": false,\n            \"cancelExist\": true,\n            \"createdAt\": 1732942471752,\n            \"tradeType\": \"TRADE\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRecentOrdersListOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByOrderIdOld Request
     * Get Order By OrderId - Old
     * /api/v1/orders/{orderId}
     */
    public function testGetOrderByOrderIdOldRequest()
    {
        $data = "{\"orderId\": \"674a97dfef434f0007efc431\"}";
        $req = GetOrderByOrderIdOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByOrderIdOld Response
     * Get Order By OrderId - Old
     * /api/v1/orders/{orderId}
     */
    public function testGetOrderByOrderIdOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrderByOrderIdOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByClientOidOld Request
     * Get Order By ClientOid - Old
     * /api/v1/order/client-order/{clientOid}
     */
    public function testGetOrderByClientOidOldRequest()
    {
        $data = "{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"}";
        $req = GetOrderByClientOidOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByClientOidOld Response
     * Get Order By ClientOid - Old
     * /api/v1/order/client-order/{clientOid}
     */
    public function testGetOrderByClientOidOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrderByClientOidOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTradeHistoryOld Request
     * Get Trade History - Old
     * /api/v1/fills
     */
    public function testGetTradeHistoryOldRequest()
    {
        $data =
            "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetTradeHistoryOldReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTradeHistoryOld Response
     * Get Trade History - Old
     * /api/v1/fills
     */
    public function testGetTradeHistoryOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"symbol\": \"DOGE-USDT\",\n                \"tradeId\": \"10862827223795713\",\n                \"orderId\": \"6745698ef4f1200007c561a8\",\n                \"counterOrderId\": \"6745695ef15b270007ac5076\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"0.40739\",\n                \"size\": \"10\",\n                \"funds\": \"4.0739\",\n                \"fee\": \"0.0040739\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"type\": \"market\",\n                \"createdAt\": 1732602254928\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTradeHistoryOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRecentTradeHistoryOld Request
     * Get Recent Trade History - Old
     * /api/v1/limit/fills
     */
    public function testGetRecentTradeHistoryOldRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getRecentTradeHistoryOld Response
     * Get Recent Trade History - Old
     * /api/v1/limit/fills
     */
    public function testGetRecentTradeHistoryOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"tradeId\": \"11732720444522497\",\n            \"orderId\": \"674aab24754b1e00077dbc69\",\n            \"counterOrderId\": \"674aab1fb26bfb0007a18b67\",\n            \"side\": \"buy\",\n            \"liquidity\": \"taker\",\n            \"forceTaker\": false,\n            \"price\": \"96999.6\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.969996\",\n            \"fee\": \"0.000969996\",\n            \"feeRate\": \"0.001\",\n            \"feeCurrency\": \"USDT\",\n            \"stop\": \"\",\n            \"tradeType\": \"TRADE\",\n            \"type\": \"limit\",\n            \"createdAt\": 1732946724082\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRecentTradeHistoryOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
