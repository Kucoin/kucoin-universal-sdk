<?php
namespace KuCoin\UniversalSDK\Generate\Futures\Order;

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
     * /api/v1/orders
     */
    public function testAddOrderRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"side\": \"buy\", \"symbol\": \"XBTUSDTM\", \"leverage\": 3, \"type\": \"limit\", \"remark\": \"order remarks\", \"reduceOnly\": false, \"marginMode\": \"ISOLATED\", \"price\": \"0.1\", \"size\": 1, \"timeInForce\": \"GTC\"}";
        $req = AddOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrder Response
     * Add Order
     * /api/v1/orders
     */
    public function testAddOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"234125150956625920\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTest Request
     * Add Order Test
     * /api/v1/orders/test
     */
    public function testAddOrderTestRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"side\": \"buy\", \"symbol\": \"XBTUSDTM\", \"leverage\": 3, \"type\": \"limit\", \"remark\": \"order remarks\", \"reduceOnly\": false, \"marginMode\": \"ISOLATED\", \"price\": \"0.1\", \"size\": 1, \"timeInForce\": \"GTC\"}";
        $req = AddOrderTestReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addOrderTest Response
     * Add Order Test
     * /api/v1/orders/test
     */
    public function testAddOrderTestResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"234125150956625920\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderTestResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * batchAddOrders Request
     * Batch Add Orders
     * /api/v1/orders/multi
     */
    public function testBatchAddOrdersRequest()
    {
        $data =
            "[{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"side\": \"buy\", \"symbol\": \"XBTUSDTM\", \"leverage\": 3, \"type\": \"limit\", \"remark\": \"order remarks\", \"reduceOnly\": false, \"marginMode\": \"ISOLATED\", \"price\": \"0.1\", \"size\": 1, \"timeInForce\": \"GTC\"}, {\"clientOid\": \"5c52e11203aa677f33e493fc\", \"side\": \"buy\", \"symbol\": \"XBTUSDTM\", \"leverage\": 3, \"type\": \"limit\", \"remark\": \"order remarks\", \"reduceOnly\": false, \"marginMode\": \"ISOLATED\", \"price\": \"0.1\", \"size\": 1, \"timeInForce\": \"GTC\"}]";
        $req = BatchAddOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchAddOrders Response
     * Batch Add Orders
     * /api/v1/orders/multi
     */
    public function testBatchAddOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"orderId\": \"235919387779985408\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"XBTUSDTM\",\n            \"code\": \"200000\",\n            \"msg\": \"success\"\n        },\n        {\n            \"orderId\": \"235919387855482880\",\n            \"clientOid\": \"5c52e11203aa677f33e493fc\",\n            \"symbol\": \"XBTUSDTM\",\n            \"code\": \"200000\",\n            \"msg\": \"success\"\n        }\n    ]\n}";
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
     * addTPSLOrder Request
     * Add Take Profit And Stop Loss Order
     * /api/v1/st-orders
     */
    public function testAddTPSLOrderRequest()
    {
        $data =
            "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"side\": \"buy\", \"symbol\": \"XBTUSDTM\", \"leverage\": 3, \"type\": \"limit\", \"remark\": \"order remarks\", \"reduceOnly\": false, \"marginMode\": \"ISOLATED\", \"price\": \"0.2\", \"size\": 1, \"timeInForce\": \"GTC\", \"triggerStopUpPrice\": \"0.3\", \"triggerStopDownPrice\": \"0.1\", \"stopPriceType\": \"TP\"}";
        $req = AddTPSLOrderReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addTPSLOrder Response
     * Add Take Profit And Stop Loss Order
     * /api/v1/st-orders
     */
    public function testAddTPSLOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"234125150956625920\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddTPSLOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderById Request
     * Cancel Order By OrderId
     * /api/v1/orders/{orderId}
     */
    public function testCancelOrderByIdRequest()
    {
        $data = "{\"orderId\": \"example_string_default_value\"}";
        $req = CancelOrderByIdReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderById Response
     * Cancel Order By OrderId
     * /api/v1/orders/{orderId}
     */
    public function testCancelOrderByIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"235303670076489728\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelOrderByIdResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelOrderByClientOid Request
     * Cancel Order By ClientOid
     * /api/v1/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"clientOid\": \"example_string_default_value\"}";
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
     * /api/v1/orders/client-order/{clientOid}
     */
    public function testCancelOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"clientOid\": \"017485b0-2957-4681-8a14-5d46b35aee0d\"\n    }\n}";
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
     * batchCancelOrders Request
     * Batch Cancel Orders
     * /api/v1/orders/multi-cancel
     */
    public function testBatchCancelOrdersRequest()
    {
        $data =
            "{\"orderIdsList\": [\"250445104152670209\", \"250445181751463936\"]}";
        $req = BatchCancelOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * batchCancelOrders Response
     * Batch Cancel Orders
     * /api/v1/orders/multi-cancel
     */
    public function testBatchCancelOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"orderId\": \"250445104152670209\",\n            \"clientOid\": null,\n            \"code\": \"200\",\n            \"msg\": \"success\"\n        },\n        {\n            \"orderId\": \"250445181751463936\",\n            \"clientOid\": null,\n            \"code\": \"200\",\n            \"msg\": \"success\"\n        }\n    ]\n}\n";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BatchCancelOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelAllOrdersV3 Request
     * Cancel All Orders
     * /api/v3/orders
     */
    public function testCancelAllOrdersV3Request()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = CancelAllOrdersV3Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelAllOrdersV3 Response
     * Cancel All Orders
     * /api/v3/orders
     */
    public function testCancelAllOrdersV3Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"235919172150824960\",\n            \"235919172150824961\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelAllOrdersV3Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelAllStopOrders Request
     * Cancel All Stop orders
     * /api/v1/stopOrders
     */
    public function testCancelAllStopOrdersRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = CancelAllStopOrdersReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelAllStopOrders Response
     * Cancel All Stop orders
     * /api/v1/stopOrders
     */
    public function testCancelAllStopOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"235919172150824960\",\n            \"235919172150824961\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelAllStopOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOrderByOrderId Request
     * Get Order By OrderId
     * /api/v1/orders/{order-id}
     */
    public function testGetOrderByOrderIdRequest()
    {
        $data = "{\"order-id\": \"236655147005071361\"}";
        $req = GetOrderByOrderIdReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderByOrderId Response
     * Get Order By OrderId
     * /api/v1/orders/{order-id}
     */
    public function testGetOrderByOrderIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"236655147005071361\",\n        \"symbol\": \"XBTUSDTM\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"0.1\",\n        \"size\": 1,\n        \"value\": \"0.0001\",\n        \"dealValue\": \"0\",\n        \"dealSize\": 0,\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopPriceType\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"leverage\": \"3\",\n        \"forceHold\": false,\n        \"closeOrder\": false,\n        \"visibleSize\": 0,\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": \"\",\n        \"isActive\": true,\n        \"cancelExist\": false,\n        \"createdAt\": 1729236185949,\n        \"updatedAt\": 1729236185949,\n        \"endAt\": null,\n        \"orderTime\": 1729236185885647952,\n        \"settleCurrency\": \"USDT\",\n        \"marginMode\": \"ISOLATED\",\n        \"avgDealPrice\": \"0\",\n        \"filledSize\": 0,\n        \"filledValue\": \"0\",\n        \"status\": \"open\",\n        \"reduceOnly\": false\n    }\n}";
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
     * /api/v1/orders/byClientOid
     */
    public function testGetOrderByClientOidRequest()
    {
        $data = "{\"clientOid\": \"5c52e11203aa677f33e493fb\"}";
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
     * /api/v1/orders/byClientOid
     */
    public function testGetOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"250444645610336256\",\n        \"symbol\": \"XRPUSDTM\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"0.1\",\n        \"size\": 1,\n        \"value\": \"1\",\n        \"dealValue\": \"0\",\n        \"dealSize\": 0,\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopPriceType\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"leverage\": \"3\",\n        \"forceHold\": false,\n        \"closeOrder\": false,\n        \"visibleSize\": 0,\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": \"\",\n        \"isActive\": true,\n        \"cancelExist\": false,\n        \"createdAt\": 1732523858568,\n        \"updatedAt\": 1732523858568,\n        \"endAt\": null,\n        \"orderTime\": 1732523858550892322,\n        \"settleCurrency\": \"USDT\",\n        \"marginMode\": \"ISOLATED\",\n        \"avgDealPrice\": \"0\",\n        \"filledSize\": 0,\n        \"filledValue\": \"0\",\n        \"status\": \"open\",\n        \"reduceOnly\": false\n    }\n}";
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
     * getOrderList Request
     * Get Order List
     * /api/v1/orders
     */
    public function testGetOrderListRequest()
    {
        $data =
            "{\"status\": \"done\", \"symbol\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetOrderListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOrderList Response
     * Get Order List
     * /api/v1/orders
     */
    public function testGetOrderListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"230181737576050688\",\n                \"symbol\": \"PEOPLEUSDTM\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"0.05\",\n                \"size\": 10,\n                \"value\": \"5\",\n                \"dealValue\": \"0\",\n                \"dealSize\": 0,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPriceType\": \"\",\n                \"stopTriggered\": false,\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"leverage\": \"1\",\n                \"forceHold\": false,\n                \"closeOrder\": false,\n                \"visibleSize\": 0,\n                \"clientOid\": \"5a80bd847f1811ef8a7faa665a37b3d7\",\n                \"remark\": null,\n                \"tags\": \"\",\n                \"isActive\": true,\n                \"cancelExist\": false,\n                \"createdAt\": 1727692804813,\n                \"updatedAt\": 1727692804813,\n                \"endAt\": null,\n                \"orderTime\": 1727692804808418000,\n                \"settleCurrency\": \"USDT\",\n                \"marginMode\": \"ISOLATED\",\n                \"avgDealPrice\": \"0\",\n                \"filledSize\": 0,\n                \"filledValue\": \"0\",\n                \"status\": \"open\",\n                \"reduceOnly\": false\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOrderListResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRecentClosedOrders Request
     * Get Recent Closed Orders
     * /api/v1/recentDoneOrders
     */
    public function testGetRecentClosedOrdersRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetRecentClosedOrdersReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRecentClosedOrders Response
     * Get Recent Closed Orders
     * /api/v1/recentDoneOrders
     */
    public function testGetRecentClosedOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"236387137732231168\",\n            \"symbol\": \"XRPUSDTM\",\n            \"type\": \"market\",\n            \"side\": \"buy\",\n            \"price\": \"0\",\n            \"size\": 1,\n            \"value\": \"5.51\",\n            \"dealValue\": \"5.511\",\n            \"dealSize\": 1,\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopPriceType\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"leverage\": \"10.0\",\n            \"forceHold\": false,\n            \"closeOrder\": false,\n            \"visibleSize\": 0,\n            \"clientOid\": \"16698fe6-2746-4aeb-a7fa-61f633ab6090\",\n            \"remark\": null,\n            \"tags\": \"\",\n            \"isActive\": false,\n            \"cancelExist\": false,\n            \"createdAt\": 1729172287496,\n            \"updatedAt\": 1729172287568,\n            \"endAt\": 1729172287568,\n            \"orderTime\": 1729172287496950800,\n            \"settleCurrency\": \"USDT\",\n            \"marginMode\": \"ISOLATED\",\n            \"avgDealPrice\": \"0.5511\",\n            \"filledSize\": 1,\n            \"filledValue\": \"5.511\",\n            \"status\": \"done\",\n            \"reduceOnly\": false\n        },\n        {\n            \"id\": \"236317213710184449\",\n            \"symbol\": \"XBTUSDTM\",\n            \"type\": \"market\",\n            \"side\": \"buy\",\n            \"price\": \"0\",\n            \"size\": 1,\n            \"value\": \"67.4309\",\n            \"dealValue\": \"67.4309\",\n            \"dealSize\": 1,\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopPriceType\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"leverage\": \"3\",\n            \"forceHold\": false,\n            \"closeOrder\": false,\n            \"visibleSize\": 0,\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"remark\": null,\n            \"tags\": \"\",\n            \"isActive\": false,\n            \"cancelExist\": false,\n            \"createdAt\": 1729155616310,\n            \"updatedAt\": 1729155616324,\n            \"endAt\": 1729155616324,\n            \"orderTime\": 1729155616310180400,\n            \"settleCurrency\": \"USDT\",\n            \"marginMode\": \"ISOLATED\",\n            \"avgDealPrice\": \"67430.9\",\n            \"filledSize\": 1,\n            \"filledValue\": \"67.4309\",\n            \"status\": \"done\",\n            \"reduceOnly\": false\n        },\n        {\n            \"id\": \"236317094436728832\",\n            \"symbol\": \"XBTUSDTM\",\n            \"type\": \"market\",\n            \"side\": \"buy\",\n            \"price\": \"0\",\n            \"size\": 1,\n            \"value\": \"67.445\",\n            \"dealValue\": \"67.445\",\n            \"dealSize\": 1,\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopPriceType\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"leverage\": \"3\",\n            \"forceHold\": false,\n            \"closeOrder\": false,\n            \"visibleSize\": 0,\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"remark\": null,\n            \"tags\": \"\",\n            \"isActive\": false,\n            \"cancelExist\": false,\n            \"createdAt\": 1729155587873,\n            \"updatedAt\": 1729155587946,\n            \"endAt\": 1729155587946,\n            \"orderTime\": 1729155587873332000,\n            \"settleCurrency\": \"USDT\",\n            \"marginMode\": \"ISOLATED\",\n            \"avgDealPrice\": \"67445.0\",\n            \"filledSize\": 1,\n            \"filledValue\": \"67.445\",\n            \"status\": \"done\",\n            \"reduceOnly\": false\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRecentClosedOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getStopOrderList Request
     * Get Stop Order List
     * /api/v1/stopOrders
     */
    public function testGetStopOrderListRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"side\": \"buy\", \"type\": \"limit\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 123456, \"pageSize\": 50}";
        $req = GetStopOrderListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getStopOrderList Response
     * Get Stop Order List
     * /api/v1/stopOrders
     */
    public function testGetStopOrderListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"230181737576050688\",\n                \"symbol\": \"PEOPLEUSDTM\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"0.05\",\n                \"size\": 10,\n                \"value\": \"5\",\n                \"dealValue\": \"0\",\n                \"dealSize\": 0,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPriceType\": \"\",\n                \"stopTriggered\": false,\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"leverage\": \"1\",\n                \"forceHold\": false,\n                \"closeOrder\": false,\n                \"visibleSize\": 0,\n                \"clientOid\": \"5a80bd847f1811ef8a7faa665a37b3d7\",\n                \"remark\": null,\n                \"tags\": \"\",\n                \"isActive\": true,\n                \"cancelExist\": false,\n                \"createdAt\": 1727692804813,\n                \"updatedAt\": 1727692804813,\n                \"endAt\": null,\n                \"orderTime\": 1727692804808418000,\n                \"settleCurrency\": \"USDT\",\n                \"marginMode\": \"ISOLATED\",\n                \"avgDealPrice\": \"0\",\n                \"filledSize\": 0,\n                \"filledValue\": \"0\",\n                \"status\": \"open\",\n                \"reduceOnly\": false\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetStopOrderListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getOpenOrderValue Request
     * Get Open Order Value
     * /api/v1/openOrderStatistics
     */
    public function testGetOpenOrderValueRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetOpenOrderValueReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getOpenOrderValue Response
     * Get Open Order Value
     * /api/v1/openOrderStatistics
     */
    public function testGetOpenOrderValueResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"openOrderBuySize\": 1,\n        \"openOrderSellSize\": 0,\n        \"openOrderBuyCost\": \"0.0001\",\n        \"openOrderSellCost\": \"0\",\n        \"settleCurrency\": \"USDT\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetOpenOrderValueResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRecentTradeHistory Request
     * Get Recent Trade History
     * /api/v1/recentFills
     */
    public function testGetRecentTradeHistoryRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetRecentTradeHistoryReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRecentTradeHistory Response
     * Get Recent Trade History
     * /api/v1/recentFills
     */
    public function testGetRecentTradeHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"tradeId\": \"1784277229880\",\n            \"orderId\": \"236317213710184449\",\n            \"side\": \"buy\",\n            \"liquidity\": \"taker\",\n            \"forceTaker\": false,\n            \"price\": \"67430.9\",\n            \"size\": 1,\n            \"value\": \"67.4309\",\n            \"openFeePay\": \"0.04045854\",\n            \"closeFeePay\": \"0\",\n            \"stop\": \"\",\n            \"feeRate\": \"0.00060\",\n            \"fixFee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"marginMode\": \"ISOLATED\",\n            \"fee\": \"0.04045854\",\n            \"settleCurrency\": \"USDT\",\n            \"orderType\": \"market\",\n            \"displayType\": \"market\",\n            \"tradeType\": \"trade\",\n            \"subTradeType\": null,\n            \"tradeTime\": 1729155616320000000,\n            \"createdAt\": 1729155616493\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"tradeId\": \"1784277132002\",\n            \"orderId\": \"236317094436728832\",\n            \"side\": \"buy\",\n            \"liquidity\": \"taker\",\n            \"forceTaker\": false,\n            \"price\": \"67445\",\n            \"size\": 1,\n            \"value\": \"67.445\",\n            \"openFeePay\": \"0\",\n            \"closeFeePay\": \"0.040467\",\n            \"stop\": \"\",\n            \"feeRate\": \"0.00060\",\n            \"fixFee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"marginMode\": \"ISOLATED\",\n            \"fee\": \"0.040467\",\n            \"settleCurrency\": \"USDT\",\n            \"orderType\": \"market\",\n            \"displayType\": \"market\",\n            \"tradeType\": \"trade\",\n            \"subTradeType\": null,\n            \"tradeTime\": 1729155587944000000,\n            \"createdAt\": 1729155588104\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRecentTradeHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTradeHistory Request
     * Get Trade History
     * /api/v1/fills
     */
    public function testGetTradeHistoryRequest()
    {
        $data =
            "{\"orderId\": \"236655147005071361\", \"symbol\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"tradeTypes\": \"trade\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetTradeHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTradeHistory Response
     * Get Trade History
     * /api/v1/fills
     */
    public function testGetTradeHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 2,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"symbol\": \"XBTUSDTM\",\n                \"tradeId\": \"1828954878212\",\n                \"orderId\": \"284486580251463680\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"86275.1\",\n                \"size\": 1,\n                \"value\": \"86.2751\",\n                \"openFeePay\": \"0.05176506\",\n                \"closeFeePay\": \"0\",\n                \"stop\": \"\",\n                \"feeRate\": \"0.00060\",\n                \"fixFee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"subTradeType\": null,\n                \"marginMode\": \"CROSS\",\n                \"openFeeTaxPay\": \"0\",\n                \"closeFeeTaxPay\": \"0\",\n                \"displayType\": \"market\",\n                \"fee\": \"0.05176506\",\n                \"settleCurrency\": \"USDT\",\n                \"orderType\": \"market\",\n                \"tradeType\": \"trade\",\n                \"tradeTime\": 1740640088244000000,\n                \"createdAt\": 1740640088427\n            }\n        ]\n    }\n}";
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
     * cancelAllOrdersV1 Request
     * Cancel All Orders - V1
     * /api/v1/orders
     */
    public function testCancelAllOrdersV1Request()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = CancelAllOrdersV1Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelAllOrdersV1 Response
     * Cancel All Orders - V1
     * /api/v1/orders
     */
    public function testCancelAllOrdersV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"235919172150824960\",\n            \"235919172150824961\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelAllOrdersV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
