<?php
namespace KuCoin\UniversalSDK\Generate\Margin\Risklimit;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class RiskLimitApiTest extends TestCase
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
     * getMarginRiskLimit Request
     * Get Margin Risk Limit
     * /api/v3/margin/currencies
     */
    public function testGetMarginRiskLimitRequest()
    {
        $data =
            "{\"isIsolated\": true, \"currency\": \"BTC\", \"symbol\": \"BTC-USDT\"}";
        $req = GetMarginRiskLimitReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMarginRiskLimit Response
     * Get Margin Risk Limit
     * /api/v3/margin/currencies
     */
    public function testGetMarginRiskLimitResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"timestamp\": 1729678659275,\n            \"currency\": \"BTC\",\n            \"borrowMaxAmount\": \"75.15\",\n            \"buyMaxAmount\": \"217.12\",\n            \"holdMaxAmount\": \"217.12\",\n            \"borrowCoefficient\": \"1\",\n            \"marginCoefficient\": \"1\",\n            \"precision\": 8,\n            \"borrowMinAmount\": \"0.001\",\n            \"borrowMinUnit\": \"0.0001\",\n            \"borrowEnabled\": true\n        }\n    ]\n}\n";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarginRiskLimitResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
