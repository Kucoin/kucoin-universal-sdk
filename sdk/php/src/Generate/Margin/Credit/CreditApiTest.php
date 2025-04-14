<?php
namespace KuCoin\UniversalSDK\Generate\Margin\Credit;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class CreditApiTest extends TestCase
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
     * getLoanMarket Request
     * Get Loan Market
     * /api/v3/project/list
     */
    public function testGetLoanMarketRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetLoanMarketReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getLoanMarket Response
     * Get Loan Market
     * /api/v3/project/list
     */
    public function testGetLoanMarketResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"currency\": \"BTC\",\n            \"purchaseEnable\": true,\n            \"redeemEnable\": true,\n            \"increment\": \"0.00000001\",\n            \"minPurchaseSize\": \"0.001\",\n            \"maxPurchaseSize\": \"40\",\n            \"interestIncrement\": \"0.0001\",\n            \"minInterestRate\": \"0.005\",\n            \"marketInterestRate\": \"0.005\",\n            \"maxInterestRate\": \"0.32\",\n            \"autoPurchaseEnable\": false\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetLoanMarketResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getLoanMarketInterestRate Request
     * Get Loan Market Interest Rate
     * /api/v3/project/marketInterestRate
     */
    public function testGetLoanMarketInterestRateRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetLoanMarketInterestRateReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getLoanMarketInterestRate Response
     * Get Loan Market Interest Rate
     * /api/v3/project/marketInterestRate
     */
    public function testGetLoanMarketInterestRateResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"time\": \"202410170000\",\n            \"marketInterestRate\": \"0.005\"\n        },\n        {\n            \"time\": \"202410170100\",\n            \"marketInterestRate\": \"0.005\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetLoanMarketInterestRateResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * purchase Request
     * Purchase
     * /api/v3/purchase
     */
    public function testPurchaseRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"size\": \"0.001\", \"interestRate\": \"0.1\"}";
        $req = PurchaseReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * purchase Response
     * Purchase
     * /api/v3/purchase
     */
    public function testPurchaseResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderNo\": \"671bafa804c26d000773c533\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = PurchaseResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifyPurchase Request
     * Modify Purchase
     * /api/v3/lend/purchase/update
     */
    public function testModifyPurchaseRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"purchaseOrderNo\": \"671bafa804c26d000773c533\", \"interestRate\": \"0.09\"}";
        $req = ModifyPurchaseReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifyPurchase Response
     * Modify Purchase
     * /api/v3/lend/purchase/update
     */
    public function testModifyPurchaseResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": null\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifyPurchaseResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPurchaseOrders Request
     * Get Purchase Orders
     * /api/v3/purchase/orders
     */
    public function testGetPurchaseOrdersRequest()
    {
        $data =
            "{\"status\": \"DONE\", \"currency\": \"BTC\", \"purchaseOrderNo\": \"example_string_default_value\", \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetPurchaseOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPurchaseOrders Response
     * Get Purchase Orders
     * /api/v3/purchase/orders
     */
    public function testGetPurchaseOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"currency\": \"BTC\",\n                \"purchaseOrderNo\": \"671bb15a3b3f930007880bae\",\n                \"purchaseSize\": \"0.001\",\n                \"matchSize\": \"0\",\n                \"interestRate\": \"0.1\",\n                \"incomeSize\": \"0\",\n                \"applyTime\": 1729868122172,\n                \"status\": \"PENDING\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPurchaseOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * redeem Request
     * Redeem
     * /api/v3/redeem
     */
    public function testRedeemRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"size\": \"0.001\", \"purchaseOrderNo\": \"671bafa804c26d000773c533\"}";
        $req = RedeemReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * redeem Response
     * Redeem
     * /api/v3/redeem
     */
    public function testRedeemResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderNo\": \"671bafa804c26d000773c533\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = RedeemResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRedeemOrders Request
     * Get Redeem Orders
     * /api/v3/redeem/orders
     */
    public function testGetRedeemOrdersRequest()
    {
        $data =
            "{\"status\": \"DONE\", \"currency\": \"BTC\", \"redeemOrderNo\": \"example_string_default_value\", \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetRedeemOrdersReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRedeemOrders Response
     * Get Redeem Orders
     * /api/v3/redeem/orders
     */
    public function testGetRedeemOrdersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"currency\": \"BTC\",\n                \"purchaseOrderNo\": \"671bafa804c26d000773c533\",\n                \"redeemOrderNo\": \"671bb01004c26d000773c55c\",\n                \"redeemSize\": \"0.001\",\n                \"receiptSize\": \"0.001\",\n                \"applyTime\": null,\n                \"status\": \"DONE\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRedeemOrdersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
