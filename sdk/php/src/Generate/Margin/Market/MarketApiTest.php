<?php
namespace KuCoin\UniversalSDK\Generate\Margin\Market;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class MarketApiTest extends TestCase
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
     * getCrossMarginSymbols Request
     * Get Symbols - Cross Margin
     * /api/v3/margin/symbols
     */
    public function testGetCrossMarginSymbolsRequest()
    {
        $data = "{\"symbol\": \"BTC-USDT\"}";
        $req = GetCrossMarginSymbolsReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getCrossMarginSymbols Response
     * Get Symbols - Cross Margin
     * /api/v3/margin/symbols
     */
    public function testGetCrossMarginSymbolsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timestamp\": 1729665839353,\n        \"items\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"name\": \"BTC-USDT\",\n                \"enableTrading\": true,\n                \"market\": \"USDS\",\n                \"baseCurrency\": \"BTC\",\n                \"quoteCurrency\": \"USDT\",\n                \"baseIncrement\": \"0.00000001\",\n                \"baseMinSize\": \"0.00001\",\n                \"baseMaxSize\": \"10000000000\",\n                \"quoteIncrement\": \"0.000001\",\n                \"quoteMinSize\": \"0.1\",\n                \"quoteMaxSize\": \"99999999\",\n                \"priceIncrement\": \"0.1\",\n                \"feeCurrency\": \"USDT\",\n                \"priceLimitRate\": \"0.1\",\n                \"minFunds\": \"0.1\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetCrossMarginSymbolsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getETFInfo Request
     * Get ETF Info
     * /api/v3/etf/info
     */
    public function testGetETFInfoRequest()
    {
        $data = "{\"currency\": \"BTCUP\"}";
        $req = GetETFInfoReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getETFInfo Response
     * Get ETF Info
     * /api/v3/etf/info
     */
    public function testGetETFInfoResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"currency\": \"BTCUP\",\n            \"netAsset\": \"33.846\",\n            \"targetLeverage\": \"2-4\",\n            \"actualLeverage\": \"2.1648\",\n            \"issuedSize\": \"107134.87655291\",\n            \"basket\": \"118.324559 XBTUSDTM\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetETFInfoResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarkPriceDetail Request
     * Get Mark Price Detail
     * /api/v1/mark-price/{symbol}/current
     */
    public function testGetMarkPriceDetailRequest()
    {
        $data = "{\"symbol\": \"USDT-BTC\"}";
        $req = GetMarkPriceDetailReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMarkPriceDetail Response
     * Get Mark Price Detail
     * /api/v1/mark-price/{symbol}/current
     */
    public function testGetMarkPriceDetailResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"USDT-BTC\",\n        \"timePoint\": 1729676888000,\n        \"value\": 1.5045E-5\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarkPriceDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarginConfig Request
     * Get Margin Config
     * /api/v1/margin/config
     */
    public function testGetMarginConfigRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getMarginConfig Response
     * Get Margin Config
     * /api/v1/margin/config
     */
    public function testGetMarginConfigResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"maxLeverage\": 5,\n        \"warningDebtRatio\": \"0.95\",\n        \"liqDebtRatio\": \"0.97\",\n        \"currencyList\": [\n            \"VRA\",\n            \"APT\",\n            \"IOTX\",\n            \"SHIB\",\n            \"KDA\",\n            \"BCHSV\",\n            \"NEAR\",\n            \"CLV\",\n            \"AUDIO\",\n            \"AIOZ\",\n            \"FLOW\",\n            \"WLD\",\n            \"COMP\",\n            \"MEME\",\n            \"SLP\",\n            \"STX\",\n            \"ZRO\",\n            \"QI\",\n            \"PYTH\",\n            \"RUNE\",\n            \"DGB\",\n            \"IOST\",\n            \"SUI\",\n            \"BCH\",\n            \"CAKE\",\n            \"DOT\",\n            \"OMG\",\n            \"POL\",\n            \"GMT\",\n            \"1INCH\",\n            \"RSR\",\n            \"NKN\",\n            \"BTC\",\n            \"AR\",\n            \"ARB\",\n            \"TON\",\n            \"LISTA\",\n            \"AVAX\",\n            \"SEI\",\n            \"FTM\",\n            \"ERN\",\n            \"BB\",\n            \"BTT\",\n            \"JTO\",\n            \"ONE\",\n            \"RLC\",\n            \"ANKR\",\n            \"SUSHI\",\n            \"CATI\",\n            \"ALGO\",\n            \"PEPE2\",\n            \"ATOM\",\n            \"LPT\",\n            \"BIGTIME\",\n            \"CFX\",\n            \"DYM\",\n            \"VELO\",\n            \"XPR\",\n            \"SNX\",\n            \"JUP\",\n            \"MANA\",\n            \"API3\",\n            \"PYR\",\n            \"ROSE\",\n            \"GLMR\",\n            \"SATS\",\n            \"TIA\",\n            \"GALAX\",\n            \"SOL\",\n            \"DAO\",\n            \"FET\",\n            \"ETC\",\n            \"MKR\",\n            \"WOO\",\n            \"DODO\",\n            \"OGN\",\n            \"BNB\",\n            \"ICP\",\n            \"BLUR\",\n            \"ETH\",\n            \"ZEC\",\n            \"NEO\",\n            \"CELO\",\n            \"REN\",\n            \"MANTA\",\n            \"LRC\",\n            \"STRK\",\n            \"ADA\",\n            \"STORJ\",\n            \"REQ\",\n            \"TAO\",\n            \"VET\",\n            \"FITFI\",\n            \"USDT\",\n            \"DOGE\",\n            \"HBAR\",\n            \"SXP\",\n            \"NEIROCTO\",\n            \"CHR\",\n            \"ORDI\",\n            \"DASH\",\n            \"PEPE\",\n            \"ONDO\",\n            \"ILV\",\n            \"WAVES\",\n            \"CHZ\",\n            \"DOGS\",\n            \"XRP\",\n            \"CTSI\",\n            \"JASMY\",\n            \"FLOKI\",\n            \"TRX\",\n            \"KAVA\",\n            \"SAND\",\n            \"C98\",\n            \"UMA\",\n            \"NOT\",\n            \"IMX\",\n            \"WIF\",\n            \"ENA\",\n            \"EGLD\",\n            \"BOME\",\n            \"LTC\",\n            \"USDC\",\n            \"METIS\",\n            \"WIN\",\n            \"THETA\",\n            \"FXS\",\n            \"ENJ\",\n            \"CRO\",\n            \"AEVO\",\n            \"INJ\",\n            \"LTO\",\n            \"CRV\",\n            \"GRT\",\n            \"DYDX\",\n            \"FLUX\",\n            \"ENS\",\n            \"WAX\",\n            \"MASK\",\n            \"POND\",\n            \"UNI\",\n            \"AAVE\",\n            \"LINA\",\n            \"TLM\",\n            \"BONK\",\n            \"QNT\",\n            \"LDO\",\n            \"ALICE\",\n            \"XLM\",\n            \"LINK\",\n            \"CKB\",\n            \"LUNC\",\n            \"YFI\",\n            \"ETHW\",\n            \"XTZ\",\n            \"LUNA\",\n            \"OP\",\n            \"SUPER\",\n            \"EIGEN\",\n            \"KSM\",\n            \"ELON\",\n            \"EOS\",\n            \"FIL\",\n            \"ZETA\",\n            \"SKL\",\n            \"BAT\",\n            \"APE\",\n            \"HMSTR\",\n            \"YGG\",\n            \"MOVR\",\n            \"PEOPLE\",\n            \"KCS\",\n            \"AXS\",\n            \"ARPA\",\n            \"ZIL\"\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarginConfigResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarkPriceList Request
     * Get Mark Price List
     * /api/v3/mark-price/all-symbols
     */
    public function testGetMarkPriceListRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getMarkPriceList Response
     * Get Mark Price List
     * /api/v3/mark-price/all-symbols
     */
    public function testGetMarkPriceListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"USDT-BTC\",\n            \"timePoint\": 1729676522000,\n            \"value\": 1.504E-5\n        },\n        {\n            \"symbol\": \"USDC-BTC\",\n            \"timePoint\": 1729676522000,\n            \"value\": 1.5049024E-5\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarkPriceListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getIsolatedMarginSymbols Request
     * Get Symbols - Isolated Margin
     * /api/v1/isolated/symbols
     */
    public function testGetIsolatedMarginSymbolsRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getIsolatedMarginSymbols Response
     * Get Symbols - Isolated Margin
     * /api/v1/isolated/symbols
     */
    public function testGetIsolatedMarginSymbolsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"symbolName\": \"BTC-USDT\",\n            \"baseCurrency\": \"BTC\",\n            \"quoteCurrency\": \"USDT\",\n            \"maxLeverage\": 10,\n            \"flDebtRatio\": \"0.97\",\n            \"tradeEnable\": true,\n            \"autoRenewMaxDebtRatio\": \"0.96\",\n            \"baseBorrowEnable\": true,\n            \"quoteBorrowEnable\": true,\n            \"baseTransferInEnable\": true,\n            \"quoteTransferInEnable\": true,\n            \"baseBorrowCoefficient\": \"1\",\n            \"quoteBorrowCoefficient\": \"1\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetIsolatedMarginSymbolsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
