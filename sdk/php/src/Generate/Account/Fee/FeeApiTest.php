<?php
namespace KuCoin\UniversalSDK\Generate\Account\Fee;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class FeeApiTest extends TestCase
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
     * getBasicFee Request
     * Get Basic Fee - Spot/Margin
     * /api/v1/base-fee
     */
    public function testGetBasicFeeRequest()
    {
        $data = "{\"currencyType\": 1}";
        $req = GetBasicFeeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getBasicFee Response
     * Get Basic Fee - Spot/Margin
     * /api/v1/base-fee
     */
    public function testGetBasicFeeResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"takerFeeRate\": \"0.001\",\n        \"makerFeeRate\": \"0.001\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetBasicFeeResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotActualFee Request
     * Get Actual Fee - Spot/Margin
     * /api/v1/trade-fees
     */
    public function testGetSpotActualFeeRequest()
    {
        $data = "{\"symbols\": \"BTC-USDT,ETH-USDT\"}";
        $req = GetSpotActualFeeReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotActualFee Response
     * Get Actual Fee - Spot/Margin
     * /api/v1/trade-fees
     */
    public function testGetSpotActualFeeResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":[{\"symbol\":\"BTC-USDT\",\"takerFeeRate\":\"0.001\",\"makerFeeRate\":\"0.001\"},{\"symbol\":\"ETH-USDT\",\"takerFeeRate\":\"0.001\",\"makerFeeRate\":\"0.001\"}]}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotActualFeeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFuturesActualFee Request
     * Get Actual Fee - Futures
     * /api/v1/trade-fees
     */
    public function testGetFuturesActualFeeRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetFuturesActualFeeReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFuturesActualFee Response
     * Get Actual Fee - Futures
     * /api/v1/trade-fees
     */
    public function testGetFuturesActualFeeResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"symbol\":\"XBTUSDTM\",\"takerFeeRate\":\"0.0006\",\"makerFeeRate\":\"0.0002\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFuturesActualFeeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
