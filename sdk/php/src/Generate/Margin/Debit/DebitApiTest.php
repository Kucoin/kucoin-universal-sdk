<?php
namespace KuCoin\UniversalSDK\Generate\Margin\Debit;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class DebitApiTest extends TestCase
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
     * borrow Request
     * Borrow
     * /api/v3/margin/borrow
     */
    public function testBorrowRequest()
    {
        $data =
            "{\"currency\": \"USDT\", \"size\": 10, \"timeInForce\": \"FOK\", \"isIsolated\": false, \"isHf\": false}";
        $req = BorrowReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * borrow Response
     * Borrow
     * /api/v3/margin/borrow
     */
    public function testBorrowResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderNo\":\"67187162c0d6990007717b15\",\"actualSize\":\"10\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = BorrowResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getBorrowHistory Request
     * Get Borrow History
     * /api/v3/margin/borrow
     */
    public function testGetBorrowHistoryRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"orderNo\": \"example_string_default_value\", \"startTime\": 123456, \"endTime\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetBorrowHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getBorrowHistory Response
     * Get Borrow History
     * /api/v3/margin/borrow
     */
    public function testGetBorrowHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timestamp\": 1729657580449,\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 2,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"orderNo\": \"67187162c0d6990007717b15\",\n                \"symbol\": null,\n                \"currency\": \"USDT\",\n                \"size\": \"10\",\n                \"actualSize\": \"10\",\n                \"status\": \"SUCCESS\",\n                \"createdTime\": 1729655138000\n            },\n            {\n                \"orderNo\": \"67187155b088e70007149585\",\n                \"symbol\": null,\n                \"currency\": \"USDT\",\n                \"size\": \"0.1\",\n                \"actualSize\": \"0\",\n                \"status\": \"FAILED\",\n                \"createdTime\": 1729655125000\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetBorrowHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * repay Request
     * Repay
     * /api/v3/margin/repay
     */
    public function testRepayRequest()
    {
        $data = "{\"currency\": \"USDT\", \"size\": 10}";
        $req = RepayReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * repay Response
     * Repay
     * /api/v3/margin/repay
     */
    public function testRepayResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"timestamp\":1729655606816,\"orderNo\":\"671873361d5bd400075096ad\",\"actualSize\":\"10\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = RepayResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRepayHistory Request
     * Get Repay History
     * /api/v3/margin/repay
     */
    public function testGetRepayHistoryRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"orderNo\": \"example_string_default_value\", \"startTime\": 123456, \"endTime\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetRepayHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRepayHistory Response
     * Get Repay History
     * /api/v3/margin/repay
     */
    public function testGetRepayHistoryResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"timestamp\":1729663471891,\"currentPage\":1,\"pageSize\":50,\"totalNum\":1,\"totalPage\":1,\"items\":[{\"orderNo\":\"671873361d5bd400075096ad\",\"symbol\":null,\"currency\":\"USDT\",\"size\":\"10\",\"principal\":\"9.99986518\",\"interest\":\"0.00013482\",\"status\":\"SUCCESS\",\"createdTime\":1729655606000}]}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRepayHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getInterestHistory Request
     * Get Interest History.
     * /api/v3/margin/interest
     */
    public function testGetInterestHistoryRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"startTime\": 123456, \"endTime\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetInterestHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getInterestHistory Response
     * Get Interest History.
     * /api/v3/margin/interest
     */
    public function testGetInterestHistoryResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"timestamp\":1729665170701,\"currentPage\":1,\"pageSize\":50,\"totalNum\":3,\"totalPage\":1,\"items\":[{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729663213375},{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729659618802},{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729656028077}]}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetInterestHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyLeverage Request
     * Modify Leverage
     * /api/v3/position/update-user-leverage
     */
    public function testModifyLeverageRequest()
    {
        $data = "{\"leverage\": \"5\"}";
        $req = ModifyLeverageReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyLeverage Response
     * Modify Leverage
     * /api/v3/position/update-user-leverage
     */
    public function testModifyLeverageResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":null}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyLeverageResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
