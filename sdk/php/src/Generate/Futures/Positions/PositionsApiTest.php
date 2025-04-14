<?php
namespace KuCoin\UniversalSDK\Generate\Futures\Positions;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class PositionsApiTest extends TestCase
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
     * getMarginMode Request
     * Get Margin Mode
     * /api/v2/position/getMarginMode
     */
    public function testGetMarginModeRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetMarginModeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMarginMode Response
     * Get Margin Mode
     * /api/v2/position/getMarginMode
     */
    public function testGetMarginModeResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"marginMode\": \"ISOLATED\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarginModeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * switchMarginMode Request
     * Switch Margin Mode
     * /api/v2/position/changeMarginMode
     */
    public function testSwitchMarginModeRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"marginMode\": \"ISOLATED\"}";
        $req = SwitchMarginModeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * switchMarginMode Response
     * Switch Margin Mode
     * /api/v2/position/changeMarginMode
     */
    public function testSwitchMarginModeResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"marginMode\": \"ISOLATED\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = SwitchMarginModeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMaxOpenSize Request
     * Get Max Open Size
     * /api/v2/getMaxOpenSize
     */
    public function testGetMaxOpenSizeRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"price\": \"example_string_default_value\", \"leverage\": 123456}";
        $req = GetMaxOpenSizeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMaxOpenSize Response
     * Get Max Open Size
     * /api/v2/getMaxOpenSize
     */
    public function testGetMaxOpenSizeResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"maxBuyOpenSize\": 0,\n        \"maxSellOpenSize\": 0\n    }\n}";
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
     * getPositionDetails Request
     * Get Position Details
     * /api/v1/position
     */
    public function testGetPositionDetailsRequest()
    {
        $data = "{\"symbol\": \"example_string_default_value\"}";
        $req = GetPositionDetailsReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPositionDetails Response
     * Get Position Details
     * /api/v1/position
     */
    public function testGetPositionDetailsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"500000000000988255\",\n        \"symbol\": \"XBTUSDTM\",\n        \"autoDeposit\": false,\n        \"crossMode\": false,\n        \"maintMarginReq\": 0.005,\n        \"riskLimit\": 500000,\n        \"realLeverage\": 2.88,\n        \"delevPercentage\": 0.18,\n        \"openingTimestamp\": 1729155616322,\n        \"currentTimestamp\": 1729482542135,\n        \"currentQty\": 1,\n        \"currentCost\": 67.4309,\n        \"currentComm\": 0.01925174,\n        \"unrealisedCost\": 67.4309,\n        \"realisedGrossCost\": 0.0,\n        \"realisedCost\": 0.01925174,\n        \"isOpen\": true,\n        \"markPrice\": 68900.7,\n        \"markValue\": 68.9007,\n        \"posCost\": 67.4309,\n        \"posCross\": 0.01645214,\n        \"posCrossMargin\": 0,\n        \"posInit\": 22.4769666644,\n        \"posComm\": 0.0539546299,\n        \"posCommCommon\": 0.0539447199,\n        \"posLoss\": 0.03766885,\n        \"posMargin\": 22.5097045843,\n        \"posFunding\": -0.0212068,\n        \"posMaint\": 0.3931320569,\n        \"maintMargin\": 23.9795045843,\n        \"realisedGrossPnl\": 0.0,\n        \"realisedPnl\": -0.06166534,\n        \"unrealisedPnl\": 1.4698,\n        \"unrealisedPnlPcnt\": 0.0218,\n        \"unrealisedRoePcnt\": 0.0654,\n        \"avgEntryPrice\": 67430.9,\n        \"liquidationPrice\": 45314.33,\n        \"bankruptPrice\": 44975.16,\n        \"settleCurrency\": \"USDT\",\n        \"maintainMargin\": 0.005,\n        \"riskLimitLevel\": 2,\n        \"marginMode\": \"ISOLATED\",\n        \"positionSide\": \"BOTH\",\n        \"leverage\": 2.88\n    }\n}\n";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPositionDetailsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPositionList Request
     * Get Position List
     * /api/v1/positions
     */
    public function testGetPositionListRequest()
    {
        $data = "{\"currency\": \"USDT\"}";
        $req = GetPositionListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPositionList Response
     * Get Position List
     * /api/v1/positions
     */
    public function testGetPositionListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"500000000001046430\",\n            \"symbol\": \"ETHUSDM\",\n            \"crossMode\": true,\n            \"delevPercentage\": 0.71,\n            \"openingTimestamp\": 1730635780702,\n            \"currentTimestamp\": 1730636040926,\n            \"currentQty\": 1,\n            \"currentCost\": -4.069805E-4,\n            \"currentComm\": 2.441E-7,\n            \"unrealisedCost\": -4.069805E-4,\n            \"realisedGrossCost\": 0.0,\n            \"realisedCost\": 2.441E-7,\n            \"isOpen\": true,\n            \"markPrice\": 2454.12,\n            \"markValue\": -4.07478E-4,\n            \"posCost\": -4.069805E-4,\n            \"posInit\": 4.06981E-5,\n            \"posMargin\": 4.07478E-5,\n            \"realisedGrossPnl\": 0.0,\n            \"realisedPnl\": -2.441E-7,\n            \"unrealisedPnl\": -4.975E-7,\n            \"unrealisedPnlPcnt\": -0.0012,\n            \"unrealisedRoePcnt\": -0.0122,\n            \"avgEntryPrice\": 2457.12,\n            \"liquidationPrice\": 1429.96,\n            \"bankruptPrice\": 1414.96,\n            \"settleCurrency\": \"ETH\",\n            \"isInverse\": true,\n            \"marginMode\": \"CROSS\",\n            \"positionSide\": \"BOTH\",\n            \"leverage\": 10\n        },\n        {\n            \"id\": \"500000000000988255\",\n            \"symbol\": \"XBTUSDTM\",\n            \"autoDeposit\": true,\n            \"crossMode\": false,\n            \"maintMarginReq\": 0.005,\n            \"riskLimit\": 500000,\n            \"realLeverage\": 2.97,\n            \"delevPercentage\": 0.5,\n            \"openingTimestamp\": 1729155616322,\n            \"currentTimestamp\": 1730636040926,\n            \"currentQty\": 1,\n            \"currentCost\": 67.4309,\n            \"currentComm\": -0.15936162,\n            \"unrealisedCost\": 67.4309,\n            \"realisedGrossCost\": 0.0,\n            \"realisedCost\": -0.15936162,\n            \"isOpen\": true,\n            \"markPrice\": 68323.06,\n            \"markValue\": 68.32306,\n            \"posCost\": 67.4309,\n            \"posCross\": 0.06225152,\n            \"posCrossMargin\": 0,\n            \"posInit\": 22.2769666644,\n            \"posComm\": 0.0539821899,\n            \"posCommCommon\": 0.0539447199,\n            \"posLoss\": 0.26210915,\n            \"posMargin\": 22.1310912243,\n            \"posFunding\": -0.19982016,\n            \"posMaint\": 0.4046228699,\n            \"maintMargin\": 23.0232512243,\n            \"realisedGrossPnl\": 0.0,\n            \"realisedPnl\": -0.2402787,\n            \"unrealisedPnl\": 0.89216,\n            \"unrealisedPnlPcnt\": 0.0132,\n            \"unrealisedRoePcnt\": 0.04,\n            \"avgEntryPrice\": 67430.9,\n            \"liquidationPrice\": 45704.44,\n            \"bankruptPrice\": 45353.8,\n            \"settleCurrency\": \"USDT\",\n            \"isInverse\": false,\n            \"maintainMargin\": 0.005,\n            \"marginMode\": \"ISOLATED\",\n            \"positionSide\": \"BOTH\",\n            \"leverage\": 2.97\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPositionListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPositionsHistory Request
     * Get Positions History
     * /api/v1/history-positions
     */
    public function testGetPositionsHistoryRequest()
    {
        $data =
            "{\"symbol\": \"example_string_default_value\", \"from\": 123456, \"to\": 123456, \"limit\": 10, \"pageId\": 1}";
        $req = GetPositionsHistoryReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPositionsHistory Response
     * Get Positions History
     * /api/v1/history-positions
     */
    public function testGetPositionsHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"closeId\": \"500000000036305465\",\n                \"userId\": \"633559791e1cbc0001f319bc\",\n                \"symbol\": \"XBTUSDTM\",\n                \"settleCurrency\": \"USDT\",\n                \"leverage\": \"1.0\",\n                \"type\": \"CLOSE_LONG\",\n                \"pnl\": \"0.51214413\",\n                \"realisedGrossCost\": \"-0.5837\",\n                \"realisedGrossCostNew\": \"-0.5837\",\n                \"withdrawPnl\": \"0.0\",\n                \"tradeFee\": \"0.03766066\",\n                \"fundingFee\": \"-0.03389521\",\n                \"openTime\": 1735549162120,\n                \"closeTime\": 1735589352069,\n                \"openPrice\": \"93859.8\",\n                \"closePrice\": \"94443.5\",\n                \"marginMode\": \"CROSS\",\n                \"tax\": \"0.0\",\n                \"roe\": null,\n                \"liquidAmount\": null,\n                \"liquidPrice\": null,\n                \"side\": \"LONG\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPositionsHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMaxWithdrawMargin Request
     * Get Max Withdraw Margin
     * /api/v1/margin/maxWithdrawMargin
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
     * /api/v1/margin/maxWithdrawMargin
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
     * getCrossMarginLeverage Request
     * Get Cross Margin Leverage
     * /api/v2/getCrossUserLeverage
     */
    public function testGetCrossMarginLeverageRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetCrossMarginLeverageReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getCrossMarginLeverage Response
     * Get Cross Margin Leverage
     * /api/v2/getCrossUserLeverage
     */
    public function testGetCrossMarginLeverageResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"leverage\": \"3\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetCrossMarginLeverageResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyMarginLeverage Request
     * Modify Cross Margin Leverage
     * /api/v2/changeCrossUserLeverage
     */
    public function testModifyMarginLeverageRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"leverage\": \"10\"}";
        $req = ModifyMarginLeverageReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyMarginLeverage Response
     * Modify Cross Margin Leverage
     * /api/v2/changeCrossUserLeverage
     */
    public function testModifyMarginLeverageResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": true\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyMarginLeverageResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addIsolatedMargin Request
     * Add Isolated Margin
     * /api/v1/position/margin/deposit-margin
     */
    public function testAddIsolatedMarginRequest()
    {
        $data =
            "{\"symbol\": \"string\", \"margin\": 0, \"bizNo\": \"string\"}";
        $req = AddIsolatedMarginReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addIsolatedMargin Response
     * Add Isolated Margin
     * /api/v1/position/margin/deposit-margin
     */
    public function testAddIsolatedMarginResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6200c9b83aecfb000152ddcd\",\n        \"symbol\": \"XBTUSDTM\",\n        \"autoDeposit\": false,\n        \"maintMarginReq\": 0.005,\n        \"riskLimit\": 500000,\n        \"realLeverage\": 18.72,\n        \"crossMode\": false,\n        \"delevPercentage\": 0.66,\n        \"openingTimestamp\": 1646287090131,\n        \"currentTimestamp\": 1646295055021,\n        \"currentQty\": 1,\n        \"currentCost\": 43.388,\n        \"currentComm\": 0.0260328,\n        \"unrealisedCost\": 43.388,\n        \"realisedGrossCost\": 0,\n        \"realisedCost\": 0.0260328,\n        \"isOpen\": true,\n        \"markPrice\": 43536.65,\n        \"markValue\": 43.53665,\n        \"posCost\": 43.388,\n        \"posCross\": 0.000024985,\n        \"posInit\": 2.1694,\n        \"posComm\": 0.02733446,\n        \"posLoss\": 0,\n        \"posMargin\": 2.19675944,\n        \"posMaint\": 0.24861326,\n        \"maintMargin\": 2.34540944,\n        \"realisedGrossPnl\": 0,\n        \"realisedPnl\": -0.0260328,\n        \"unrealisedPnl\": 0.14865,\n        \"unrealisedPnlPcnt\": 0.0034,\n        \"unrealisedRoePcnt\": 0.0685,\n        \"avgEntryPrice\": 43388,\n        \"liquidationPrice\": 41440,\n        \"bankruptPrice\": 41218,\n        \"userId\": 1234321123,\n        \"settleCurrency\": \"USDT\"\n    }\n}";
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
     * /api/v1/margin/withdrawMargin
     */
    public function testRemoveIsolatedMarginRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"withdrawAmount\": \"0.0000001\"}";
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
     * /api/v1/margin/withdrawMargin
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
     * getIsolatedMarginRiskLimit Request
     * Get Isolated Margin Risk Limit
     * /api/v1/contracts/risk-limit/{symbol}
     */
    public function testGetIsolatedMarginRiskLimitRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetIsolatedMarginRiskLimitReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getIsolatedMarginRiskLimit Response
     * Get Isolated Margin Risk Limit
     * /api/v1/contracts/risk-limit/{symbol}
     */
    public function testGetIsolatedMarginRiskLimitResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 1,\n            \"maxRiskLimit\": 100000,\n            \"minRiskLimit\": 0,\n            \"maxLeverage\": 125,\n            \"initialMargin\": 0.008,\n            \"maintainMargin\": 0.004\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 2,\n            \"maxRiskLimit\": 500000,\n            \"minRiskLimit\": 100000,\n            \"maxLeverage\": 100,\n            \"initialMargin\": 0.01,\n            \"maintainMargin\": 0.005\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 3,\n            \"maxRiskLimit\": 1000000,\n            \"minRiskLimit\": 500000,\n            \"maxLeverage\": 75,\n            \"initialMargin\": 0.014,\n            \"maintainMargin\": 0.007\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 4,\n            \"maxRiskLimit\": 2000000,\n            \"minRiskLimit\": 1000000,\n            \"maxLeverage\": 50,\n            \"initialMargin\": 0.02,\n            \"maintainMargin\": 0.01\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 5,\n            \"maxRiskLimit\": 3000000,\n            \"minRiskLimit\": 2000000,\n            \"maxLeverage\": 30,\n            \"initialMargin\": 0.034,\n            \"maintainMargin\": 0.017\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 6,\n            \"maxRiskLimit\": 5000000,\n            \"minRiskLimit\": 3000000,\n            \"maxLeverage\": 20,\n            \"initialMargin\": 0.05,\n            \"maintainMargin\": 0.025\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 7,\n            \"maxRiskLimit\": 8000000,\n            \"minRiskLimit\": 5000000,\n            \"maxLeverage\": 10,\n            \"initialMargin\": 0.1,\n            \"maintainMargin\": 0.05\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 8,\n            \"maxRiskLimit\": 12000000,\n            \"minRiskLimit\": 8000000,\n            \"maxLeverage\": 5,\n            \"initialMargin\": 0.2,\n            \"maintainMargin\": 0.1\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 9,\n            \"maxRiskLimit\": 20000000,\n            \"minRiskLimit\": 12000000,\n            \"maxLeverage\": 4,\n            \"initialMargin\": 0.25,\n            \"maintainMargin\": 0.125\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 10,\n            \"maxRiskLimit\": 30000000,\n            \"minRiskLimit\": 20000000,\n            \"maxLeverage\": 3,\n            \"initialMargin\": 0.334,\n            \"maintainMargin\": 0.167\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 11,\n            \"maxRiskLimit\": 40000000,\n            \"minRiskLimit\": 30000000,\n            \"maxLeverage\": 2,\n            \"initialMargin\": 0.5,\n            \"maintainMargin\": 0.25\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"level\": 12,\n            \"maxRiskLimit\": 50000000,\n            \"minRiskLimit\": 40000000,\n            \"maxLeverage\": 1,\n            \"initialMargin\": 1.0,\n            \"maintainMargin\": 0.5\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetIsolatedMarginRiskLimitResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyIsolatedMarginRiskLimt Request
     * Modify Isolated Margin Risk Limit
     * /api/v1/position/risk-limit-level/change
     */
    public function testModifyIsolatedMarginRiskLimtRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\", \"level\": 2}";
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
     * /api/v1/position/risk-limit-level/change
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
     * /api/v1/position/margin/auto-deposit-status
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
     * /api/v1/position/margin/auto-deposit-status
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
