<?php
namespace KuCoin\UniversalSDK\Generate\Affiliate\Affiliate;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AffiliateApiTest extends TestCase
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
     * getAccount Request
     * Get Account
     * /api/v2/affiliate/inviter/statistics
     */
    public function testGetAccountRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getAccount Response
     * Get Account
     * /api/v2/affiliate/inviter/statistics
     */
    public function testGetAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"parentUid\": \"1000000\",\n        \"orders\": [\n            {\n                \"orderId\": \"1668458892612980737\",\n                \"currency\": \"USDT\",\n                \"principal\": \"100\",\n                \"interest\": \"0\"\n            }\n        ],\n        \"ltv\": {\n            \"transferLtv\": \"0.6000\",\n            \"onlyClosePosLtv\": \"0.7500\",\n            \"delayedLiquidationLtv\": \"0.9000\",\n            \"instantLiquidationLtv\": \"0.9500\",\n            \"currentLtv\": \"0.0854\"\n        },\n        \"totalMarginAmount\": \"1170.36181573\",\n        \"transferMarginAmount\": \"166.66666666\",\n        \"margins\": [\n            {\n                \"marginCcy\": \"USDT\",\n                \"marginQty\": \"1170.36181573\",\n                \"marginFactor\": \"1.000000000000000000\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAccountResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
