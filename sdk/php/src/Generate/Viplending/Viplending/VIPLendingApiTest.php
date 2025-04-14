<?php
namespace KuCoin\UniversalSDK\Generate\Viplending\Viplending;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class VIPLendingApiTest extends TestCase
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
     * getDiscountRateConfigs Request
     * Get Discount Rate Configs
     * /api/v1/otc-loan/discount-rate-configs
     */
    public function testGetDiscountRateConfigsRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getDiscountRateConfigs Response
     * Get Discount Rate Configs
     * /api/v1/otc-loan/discount-rate-configs
     */
    public function testGetDiscountRateConfigsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"currency\": \"BTC\",\n            \"usdtLevels\": [\n                {\n                    \"left\": 0,\n                    \"right\": 20000000,\n                    \"discountRate\": \"1.00000000\"\n                },\n                {\n                    \"left\": 20000000,\n                    \"right\": 50000000,\n                    \"discountRate\": \"0.95000000\"\n                },\n                {\n                    \"left\": 50000000,\n                    \"right\": 100000000,\n                    \"discountRate\": \"0.90000000\"\n                },\n                {\n                    \"left\": 100000000,\n                    \"right\": 300000000,\n                    \"discountRate\": \"0.50000000\"\n                },\n                {\n                    \"left\": 300000000,\n                    \"right\": 99999999999,\n                    \"discountRate\": \"0.00000000\"\n                }\n            ]\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDiscountRateConfigsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getLoanInfo Request
     * Get Loan Info
     * /api/v1/otc-loan/loan
     */
    public function testGetLoanInfoRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getLoanInfo Response
     * Get Loan Info
     * /api/v1/otc-loan/loan
     */
    public function testGetLoanInfoResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"parentUid\": \"1260004199\",\n        \"orders\": [{\n            \"orderId\": \"671a2be815f4140007a588e1\",\n            \"principal\": \"100\",\n            \"interest\": \"0\",\n            \"currency\": \"USDT\"\n        }],\n        \"ltv\": {\n            \"transferLtv\": \"0.6000\",\n            \"onlyClosePosLtv\": \"0.7500\",\n            \"delayedLiquidationLtv\": \"0.7500\",\n            \"instantLiquidationLtv\": \"0.8000\",\n            \"currentLtv\": \"0.1111\"\n        },\n        \"totalMarginAmount\": \"900.00000000\",\n        \"transferMarginAmount\": \"166.66666666\",\n        \"margins\": [{\n            \"marginCcy\": \"USDT\",\n            \"marginQty\": \"1000.00000000\",\n            \"marginFactor\": \"0.9000000000\"\n        }]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetLoanInfoResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getAccounts Request
     * Get Accounts
     * /api/v1/otc-loan/accounts
     */
    public function testGetAccountsRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getAccounts Response
     * Get Accounts
     * /api/v1/otc-loan/accounts
     */
    public function testGetAccountsResponse()
    {
        $data =
            "\n{\n    \"code\": \"200000\",\n    \"data\": [{\n        \"uid\": \"1260004199\",\n        \"marginCcy\": \"USDT\",\n        \"marginQty\": \"900\",\n        \"marginFactor\": \"0.9000000000\",\n        \"accountType\": \"TRADE\",\n        \"isParent\": true\n    }]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAccountsResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
