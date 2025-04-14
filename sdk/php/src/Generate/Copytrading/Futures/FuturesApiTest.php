<?php
namespace KuCoin\UniversalSDK\Generate\Copytrading\Futures;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class FuturesApiTest extends TestCase
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
     * /api/v1/copy-trade/futures/orders
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
     * /api/v1/copy-trade/futures/orders
     */
    public function testAddOrderResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"263485113055133696\",\n        \"clientOid\": \"5c52e11203aa677f331e493fb\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddOrderResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addOrderTest Request
     * Add Order Test
     * /api/v1/copy-trade/futures/orders/test
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
     * /api/v1/copy-trade/futures/orders/test
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
     * addTPSLOrder Request
     * Add Take Profit And Stop Loss Order
     * /api/v1/copy-trade/futures/st-orders
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
     * /api/v1/copy-trade/futures/st-orders
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
     * /api/v1/copy-trade/futures/orders
     */
    public function testCancelOrderByIdRequest()
    {
        $data = "{\"orderId\": \"263485113055133696\"}";
        $req = CancelOrderByIdReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelOrderById Response
     * Cancel Order By OrderId
     * /api/v1/copy-trade/futures/orders
     */
    public function testCancelOrderByIdResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"263485113055133696\"\n        ]\n    }\n}";
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
     * /api/v1/copy-trade/futures/orders/client-order
     */
    public function testCancelOrderByClientOidRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"clientOid\": \"5c52e11203aa677f331e493fb\"}";
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
     * /api/v1/copy-trade/futures/orders/client-order
     */
    public function testCancelOrderByClientOidResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"clientOid\": \"5c52e11203aa677f331e4913fb\"\n    }\n}";
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
     * getMaxOpenSize Request
     * Get Max Open Size
     * /api/v1/copy-trade/futures/get-max-open-size
     */
    public function testGetMaxOpenSizeRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"price\": 123456.0, \"leverage\": 123456}";
        $req = GetMaxOpenSizeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMaxOpenSize Response
     * Get Max Open Size
     * /api/v1/copy-trade/futures/get-max-open-size
     */
    public function testGetMaxOpenSizeResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"maxBuyOpenSize\": \"1000000\",\n        \"maxSellOpenSize\": \"51\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMaxOpenSizeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMaxWithdrawMargin Request
     * Get Max Withdraw Margin
     * /api/v1/copy-trade/futures/position/margin/max-withdraw-margin
     */
    public function testGetMaxWithdrawMarginRequest()
    {
        $data = "{\"symbol\": \"example_string_default_value\"}";
        $req = GetMaxWithdrawMarginReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMaxWithdrawMargin Response
     * Get Max Withdraw Margin
     * /api/v1/copy-trade/futures/position/margin/max-withdraw-margin
     */
    public function testGetMaxWithdrawMarginResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": \"21.1135719252\"\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMaxWithdrawMarginResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addIsolatedMargin Request
     * Add Isolated Margin
     * /api/v1/copy-trade/futures/position/margin/deposit-margin
     */
    public function testAddIsolatedMarginRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"margin\": 3, \"bizNo\": \"112233\"}";
        $req = AddIsolatedMarginReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addIsolatedMargin Response
     * Add Isolated Margin
     * /api/v1/copy-trade/futures/position/margin/deposit-margin
     */
    public function testAddIsolatedMarginResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"400000000000974886\",\n        \"symbol\": \"XBTUSDTM\",\n        \"autoDeposit\": true,\n        \"maintMarginReq\": \"0.004\",\n        \"riskLimit\": 100000,\n        \"realLeverage\": \"1.83\",\n        \"crossMode\": false,\n        \"marginMode\": \"\",\n        \"positionSide\": \"\",\n        \"leverage\": \"1.83\",\n        \"delevPercentage\": 0.2,\n        \"openingTimestamp\": 1736932881164,\n        \"currentTimestamp\": 1736933530230,\n        \"currentQty\": 1,\n        \"currentCost\": \"97.302\",\n        \"currentComm\": \"0.0583812\",\n        \"unrealisedCost\": \"97.302\",\n        \"realisedGrossCost\": \"0.0000000000\",\n        \"realisedCost\": \"0.0583812000\",\n        \"isOpen\": true,\n        \"markPrice\": \"96939.98\",\n        \"markValue\": \"96.9399800000\",\n        \"posCost\": \"97.302\",\n        \"posCross\": \"20.9874\",\n        \"posInit\": \"32.4339999967\",\n        \"posComm\": \"0.0904415999\",\n        \"posLoss\": \"0\",\n        \"posMargin\": \"53.5118415966\",\n        \"posMaint\": \"0.4796495999\",\n        \"maintMargin\": \"53.1498215966\",\n        \"realisedGrossPnl\": \"0.0000000000\",\n        \"realisedPnl\": \"-0.0583812000\",\n        \"unrealisedPnl\": \"-0.3620200000\",\n        \"unrealisedPnlPcnt\": \"-0.0037\",\n        \"unrealisedRoePcnt\": \"-0.0112\",\n        \"avgEntryPrice\": \"97302.00\",\n        \"liquidationPrice\": \"44269.81\",\n        \"bankruptPrice\": \"43880.61\",\n        \"settleCurrency\": \"USDT\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddIsolatedMarginResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * removeIsolatedMargin Request
     * Remove Isolated Margin
     * /api/v1/copy-trade/futures/position/margin/withdraw-margin
     */
    public function testRemoveIsolatedMarginRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"withdrawAmount\": 1e-07}";
        $req = RemoveIsolatedMarginReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * removeIsolatedMargin Response
     * Remove Isolated Margin
     * /api/v1/copy-trade/futures/position/margin/withdraw-margin
     */
    public function testRemoveIsolatedMarginResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": \"0.1\"\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = RemoveIsolatedMarginResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyIsolatedMarginRiskLimt Request
     * Modify Isolated Margin Risk Limit
     * /api/v1/copy-trade/futures/position/risk-limit-level/change
     */
    public function testModifyIsolatedMarginRiskLimtRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"level\": 1}";
        $req = ModifyIsolatedMarginRiskLimtReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyIsolatedMarginRiskLimt Response
     * Modify Isolated Margin Risk Limit
     * /api/v1/copy-trade/futures/position/risk-limit-level/change
     */
    public function testModifyIsolatedMarginRiskLimtResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": true\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyIsolatedMarginRiskLimtResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyAutoDepositStatus Request
     * Modify Isolated Margin Auto-Deposit Status
     * /api/v1/copy-trade/futures/position/margin/auto-deposit-status
     */
    public function testModifyAutoDepositStatusRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"status\": true}";
        $req = ModifyAutoDepositStatusReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyAutoDepositStatus Response
     * Modify Isolated Margin Auto-Deposit Status
     * /api/v1/copy-trade/futures/position/margin/auto-deposit-status
     */
    public function testModifyAutoDepositStatusResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": true\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyAutoDepositStatusResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
