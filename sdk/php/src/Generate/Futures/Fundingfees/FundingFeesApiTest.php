<?php
namespace KuCoin\UniversalSDK\Generate\Futures\Fundingfees;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class FundingFeesApiTest extends TestCase
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
     * getCurrentFundingRate Request
     * Get Current Funding Rate.
     * /api/v1/funding-rate/{symbol}/current
     */
    public function testGetCurrentFundingRateRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetCurrentFundingRateReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getCurrentFundingRate Response
     * Get Current Funding Rate.
     * /api/v1/funding-rate/{symbol}/current
     */
    public function testGetCurrentFundingRateResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \".XBTUSDTMFPI8H\",\n        \"granularity\": 28800000,\n        \"timePoint\": 1731441600000,\n        \"value\": 6.41E-4,\n        \"predictedValue\": 5.2E-5,\n        \"fundingRateCap\": 0.003,\n        \"fundingRateFloor\": -0.003\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetCurrentFundingRateResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPublicFundingHistory Request
     * Get Public Funding History
     * /api/v1/contract/funding-rates
     */
    public function testGetPublicFundingHistoryRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"from\": 1700310700000, \"to\": 1702310700000}";
        $req = GetPublicFundingHistoryReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPublicFundingHistory Response
     * Get Public Funding History
     * /api/v1/contract/funding-rates
     */
    public function testGetPublicFundingHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.1E-4,\n            \"timepoint\": 1702296000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.47E-4,\n            \"timepoint\": 1702267200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.52E-4,\n            \"timepoint\": 1702238400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 5.13E-4,\n            \"timepoint\": 1702209600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.21E-4,\n            \"timepoint\": 1702180800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 5.06E-4,\n            \"timepoint\": 1702152000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.68E-4,\n            \"timepoint\": 1702123200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.82E-4,\n            \"timepoint\": 1702094400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.0E-4,\n            \"timepoint\": 1702065600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 5.46E-4,\n            \"timepoint\": 1702036800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.97E-4,\n            \"timepoint\": 1702008000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 5.76E-4,\n            \"timepoint\": 1701979200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.22E-4,\n            \"timepoint\": 1701950400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.92E-4,\n            \"timepoint\": 1701921600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.1E-4,\n            \"timepoint\": 1701892800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.48E-4,\n            \"timepoint\": 1701864000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.68E-4,\n            \"timepoint\": 1701835200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.51E-4,\n            \"timepoint\": 1701806400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.44E-4,\n            \"timepoint\": 1701777600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.25E-4,\n            \"timepoint\": 1701748800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": -8.2E-5,\n            \"timepoint\": 1701720000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.64E-4,\n            \"timepoint\": 1701691200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 4.14E-4,\n            \"timepoint\": 1701662400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.44E-4,\n            \"timepoint\": 1701633600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.99E-4,\n            \"timepoint\": 1701604800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.79E-4,\n            \"timepoint\": 1701576000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 8.7E-5,\n            \"timepoint\": 1701547200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.6E-5,\n            \"timepoint\": 1701518400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": -3.7E-5,\n            \"timepoint\": 1701489600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.5E-5,\n            \"timepoint\": 1701460800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 6.8E-5,\n            \"timepoint\": 1701432000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.2E-5,\n            \"timepoint\": 1701403200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.45E-4,\n            \"timepoint\": 1701374400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.41E-4,\n            \"timepoint\": 1701345600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 9.4E-5,\n            \"timepoint\": 1701316800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.08E-4,\n            \"timepoint\": 1701288000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.6E-5,\n            \"timepoint\": 1701259200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.0E-5,\n            \"timepoint\": 1701230400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.0E-5,\n            \"timepoint\": 1701201600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.16E-4,\n            \"timepoint\": 1701172800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.04E-4,\n            \"timepoint\": 1701144000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.3E-4,\n            \"timepoint\": 1701115200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 6.2E-5,\n            \"timepoint\": 1701086400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.33E-4,\n            \"timepoint\": 1701057600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 8.0E-5,\n            \"timepoint\": 1701028800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.11E-4,\n            \"timepoint\": 1701000000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.4E-5,\n            \"timepoint\": 1700971200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.01E-4,\n            \"timepoint\": 1700942400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.9E-5,\n            \"timepoint\": 1700913600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.1E-5,\n            \"timepoint\": 1700884800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.0E-6,\n            \"timepoint\": 1700856000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.03E-4,\n            \"timepoint\": 1700827200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 3.0E-6,\n            \"timepoint\": 1700798400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 6.7E-5,\n            \"timepoint\": 1700769600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.47E-4,\n            \"timepoint\": 1700740800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.8E-5,\n            \"timepoint\": 1700712000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.39E-4,\n            \"timepoint\": 1700683200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 7.5E-5,\n            \"timepoint\": 1700654400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.11E-4,\n            \"timepoint\": 1700625600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 9.8E-5,\n            \"timepoint\": 1700596800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.18E-4,\n            \"timepoint\": 1700568000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.16E-4,\n            \"timepoint\": 1700539200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.6E-4,\n            \"timepoint\": 1700510400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.92E-4,\n            \"timepoint\": 1700481600000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.13E-4,\n            \"timepoint\": 1700452800000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.47E-4,\n            \"timepoint\": 1700424000000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.3E-4,\n            \"timepoint\": 1700395200000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 2.63E-4,\n            \"timepoint\": 1700366400000\n        },\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"fundingRate\": 1.32E-4,\n            \"timepoint\": 1700337600000\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPublicFundingHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPrivateFundingHistory Request
     * Get Private Funding History
     * /api/v1/funding-history
     */
    public function testGetPrivateFundingHistoryRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"startAt\": 1700310700000, \"endAt\": 1702310700000, \"reverse\": true, \"offset\": 123456, \"forward\": true, \"maxCount\": 123456}";
        $req = GetPrivateFundingHistoryReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPrivateFundingHistory Response
     * Get Private Funding History
     * /api/v1/funding-history
     */
    public function testGetPrivateFundingHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"dataList\": [\n            {\n                \"id\": 1472387374042586,\n                \"symbol\": \"XBTUSDTM\",\n                \"timePoint\": 1731470400000,\n                \"fundingRate\": 6.41E-4,\n                \"markPrice\": 87139.92,\n                \"positionQty\": 1,\n                \"positionCost\": 87.13992,\n                \"funding\": -0.05585669,\n                \"settleCurrency\": \"USDT\",\n                \"context\": \"{\\\"marginMode\\\": \\\"ISOLATED\\\", \\\"positionSide\\\": \\\"BOTH\\\"}\",\n                \"marginMode\": \"ISOLATED\"\n            }\n        ],\n        \"hasMore\": true\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPrivateFundingHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
