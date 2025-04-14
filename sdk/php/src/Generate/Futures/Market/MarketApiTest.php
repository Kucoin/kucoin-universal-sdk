<?php
namespace KuCoin\UniversalSDK\Generate\Futures\Market;

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
     * getSymbol Request
     * Get Symbol
     * /api/v1/contracts/{symbol}
     */
    public function testGetSymbolRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetSymbolReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSymbol Response
     * Get Symbol
     * /api/v1/contracts/{symbol}
     */
    public function testGetSymbolResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"rootSymbol\": \"USDT\",\n        \"type\": \"FFWCSX\",\n        \"firstOpenDate\": 1585555200000,\n        \"expireDate\": null,\n        \"settleDate\": null,\n        \"baseCurrency\": \"XBT\",\n        \"quoteCurrency\": \"USDT\",\n        \"settleCurrency\": \"USDT\",\n        \"maxOrderQty\": 1000000,\n        \"maxPrice\": 1000000.0,\n        \"lotSize\": 1,\n        \"tickSize\": 0.1,\n        \"indexPriceTickSize\": 0.01,\n        \"multiplier\": 0.001,\n        \"initialMargin\": 0.008,\n        \"maintainMargin\": 0.004,\n        \"maxRiskLimit\": 100000,\n        \"minRiskLimit\": 100000,\n        \"riskStep\": 50000,\n        \"makerFeeRate\": 2.0E-4,\n        \"takerFeeRate\": 6.0E-4,\n        \"takerFixFee\": 0.0,\n        \"makerFixFee\": 0.0,\n        \"settlementFee\": null,\n        \"isDeleverage\": true,\n        \"isQuanto\": true,\n        \"isInverse\": false,\n        \"markMethod\": \"FairPrice\",\n        \"fairMethod\": \"FundingRate\",\n        \"fundingBaseSymbol\": \".XBTINT8H\",\n        \"fundingQuoteSymbol\": \".USDTINT8H\",\n        \"fundingRateSymbol\": \".XBTUSDTMFPI8H\",\n        \"indexSymbol\": \".KXBTUSDT\",\n        \"settlementSymbol\": \"\",\n        \"status\": \"Open\",\n        \"fundingFeeRate\": 5.2E-5,\n        \"predictedFundingFeeRate\": 8.3E-5,\n        \"fundingRateGranularity\": 28800000,\n        \"openInterest\": \"6748176\",\n        \"turnoverOf24h\": 1.0346431983265533E9,\n        \"volumeOf24h\": 12069.225,\n        \"markPrice\": 86378.69,\n        \"indexPrice\": 86382.64,\n        \"lastTradePrice\": 86364,\n        \"nextFundingRateTime\": 17752926,\n        \"maxLeverage\": 125,\n        \"sourceExchanges\": [\n            \"okex\",\n            \"binance\",\n            \"kucoin\",\n            \"bybit\",\n            \"bitmart\",\n            \"gateio\"\n        ],\n        \"premiumsSymbol1M\": \".XBTUSDTMPI\",\n        \"premiumsSymbol8H\": \".XBTUSDTMPI8H\",\n        \"fundingBaseSymbol1M\": \".XBTINT\",\n        \"fundingQuoteSymbol1M\": \".USDTINT\",\n        \"lowPrice\": 82205.2,\n        \"highPrice\": 89299.9,\n        \"priceChgPct\": -0.028,\n        \"priceChg\": -2495.9,\n        \"k\": 490.0,\n        \"m\": 300.0,\n        \"f\": 1.3,\n        \"mmrLimit\": 0.3,\n        \"mmrLevConstant\": 125.0,\n        \"supportCross\": true,\n        \"buyLimit\": 90700.7115,\n        \"sellLimit\": 82062.5485\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSymbolResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getAllSymbols Request
     * Get All Symbols
     * /api/v1/contracts/active
     */
    public function testGetAllSymbolsRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getAllSymbols Response
     * Get All Symbols
     * /api/v1/contracts/active
     */
    public function testGetAllSymbolsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"rootSymbol\": \"USDT\",\n            \"type\": \"FFWCSX\",\n            \"firstOpenDate\": 1585555200000,\n            \"expireDate\": null,\n            \"settleDate\": null,\n            \"baseCurrency\": \"XBT\",\n            \"quoteCurrency\": \"USDT\",\n            \"settleCurrency\": \"USDT\",\n            \"maxOrderQty\": 1000000,\n            \"maxPrice\": 1000000,\n            \"lotSize\": 1,\n            \"tickSize\": 0.1,\n            \"indexPriceTickSize\": 0.01,\n            \"multiplier\": 0.001,\n            \"initialMargin\": 0.008,\n            \"maintainMargin\": 0.004,\n            \"maxRiskLimit\": 100000,\n            \"minRiskLimit\": 100000,\n            \"riskStep\": 50000,\n            \"makerFeeRate\": 0.0002,\n            \"takerFeeRate\": 0.0006,\n            \"takerFixFee\": 0,\n            \"makerFixFee\": 0,\n            \"settlementFee\": null,\n            \"isDeleverage\": true,\n            \"isQuanto\": true,\n            \"isInverse\": false,\n            \"markMethod\": \"FairPrice\",\n            \"fairMethod\": \"FundingRate\",\n            \"fundingBaseSymbol\": \".XBTINT8H\",\n            \"fundingQuoteSymbol\": \".USDTINT8H\",\n            \"fundingRateSymbol\": \".XBTUSDTMFPI8H\",\n            \"indexSymbol\": \".KXBTUSDT\",\n            \"settlementSymbol\": \"\",\n            \"status\": \"Open\",\n            \"fundingFeeRate\": 0.000052,\n            \"predictedFundingFeeRate\": 0.000083,\n            \"fundingRateGranularity\": 28800000,\n            \"openInterest\": \"6748176\",\n            \"turnoverOf24h\": 1034643198.3265533,\n            \"volumeOf24h\": 12069.225,\n            \"markPrice\": 86378.69,\n            \"indexPrice\": 86382.64,\n            \"lastTradePrice\": 86364,\n            \"nextFundingRateTime\": 17752926,\n            \"maxLeverage\": 125,\n            \"sourceExchanges\": [\n                \"okex\",\n                \"binance\",\n                \"kucoin\",\n                \"bybit\",\n                \"bitmart\",\n                \"gateio\"\n            ],\n            \"premiumsSymbol1M\": \".XBTUSDTMPI\",\n            \"premiumsSymbol8H\": \".XBTUSDTMPI8H\",\n            \"fundingBaseSymbol1M\": \".XBTINT\",\n            \"fundingQuoteSymbol1M\": \".USDTINT\",\n            \"lowPrice\": 82205.2,\n            \"highPrice\": 89299.9,\n            \"priceChgPct\": -0.028,\n            \"priceChg\": -2495.9,\n            \"k\": 490,\n            \"m\": 300,\n            \"f\": 1.3,\n            \"mmrLimit\": 0.3,\n            \"mmrLevConstant\": 125,\n            \"supportCross\": true,\n            \"buyLimit\": 90700.7115,\n            \"sellLimit\": 82062.5485\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAllSymbolsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTicker Request
     * Get Ticker
     * /api/v1/ticker
     */
    public function testGetTickerRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetTickerReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTicker Response
     * Get Ticker
     * /api/v1/ticker
     */
    public function testGetTickerResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"sequence\":1697895100310,\"symbol\":\"XBTUSDM\",\"side\":\"sell\",\"size\":2936,\"tradeId\":\"1697901180000\",\"price\":\"67158.4\",\"bestBidPrice\":\"67169.6\",\"bestBidSize\":32345,\"bestAskPrice\":\"67169.7\",\"bestAskSize\":7251,\"ts\":1729163001780000000}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTickerResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getAllTickers Request
     * Get All Tickers
     * /api/v1/allTickers
     */
    public function testGetAllTickersRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getAllTickers Response
     * Get All Tickers
     * /api/v1/allTickers
     */
    public function testGetAllTickersResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"sequence\": 1707992727046,\n            \"symbol\": \"XBTUSDTM\",\n            \"side\": \"sell\",\n            \"size\": 21,\n            \"tradeId\": \"1784299761369\",\n            \"price\": \"67153\",\n            \"bestBidPrice\": \"67153\",\n            \"bestBidSize\": 2767,\n            \"bestAskPrice\": \"67153.1\",\n            \"bestAskSize\": 5368,\n            \"ts\": 1729163466659000000\n        },\n        {\n            \"sequence\": 1697895166299,\n            \"symbol\": \"XBTUSDM\",\n            \"side\": \"sell\",\n            \"size\": 1956,\n            \"tradeId\": \"1697901245065\",\n            \"price\": \"67145.2\",\n            \"bestBidPrice\": \"67135.3\",\n            \"bestBidSize\": 1,\n            \"bestAskPrice\": \"67135.8\",\n            \"bestAskSize\": 3,\n            \"ts\": 1729163445340000000\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAllTickersResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFullOrderBook Request
     * Get Full OrderBook
     * /api/v1/level2/snapshot
     */
    public function testGetFullOrderBookRequest()
    {
        $data = "{\"symbol\": \"XBTUSDM\"}";
        $req = GetFullOrderBookReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFullOrderBook Response
     * Get Full OrderBook
     * /api/v1/level2/snapshot
     */
    public function testGetFullOrderBookResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"sequence\": 1697895963339,\n        \"symbol\": \"XBTUSDM\",\n        \"bids\": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        \"asks\": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        \"ts\": 1729168101216000000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFullOrderBookResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPartOrderBook Request
     * Get Part OrderBook
     * /api/v1/level2/depth{size}
     */
    public function testGetPartOrderBookRequest()
    {
        $data = "{\"size\": \"20\", \"symbol\": \"XBTUSDM\"}";
        $req = GetPartOrderBookReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPartOrderBook Response
     * Get Part OrderBook
     * /api/v1/level2/depth{size}
     */
    public function testGetPartOrderBookResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"sequence\": 1697895963339,\n        \"symbol\": \"XBTUSDM\",\n        \"bids\": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        \"asks\": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        \"ts\": 1729168101216000000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPartOrderBookResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTradeHistory Request
     * Get Trade History
     * /api/v1/trade/history
     */
    public function testGetTradeHistoryRequest()
    {
        $data = "{\"symbol\": \"XBTUSDM\"}";
        $req = GetTradeHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTradeHistory Response
     * Get Trade History
     * /api/v1/trade/history
     */
    public function testGetTradeHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"sequence\": 1697915257909,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257909\",\n            \"makerOrderId\": \"236679665752801280\",\n            \"takerOrderId\": \"236679667975745536\",\n            \"ts\": 1729242032152000000,\n            \"size\": 1,\n            \"price\": \"67878\",\n            \"side\": \"sell\"\n        },\n        {\n            \"sequence\": 1697915257749,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257749\",\n            \"makerOrderId\": \"236679660971245570\",\n            \"takerOrderId\": \"236679665400492032\",\n            \"ts\": 1729242031535000000,\n            \"size\": 1,\n            \"price\": \"67867.8\",\n            \"side\": \"sell\"\n        },\n        {\n            \"sequence\": 1697915257701,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257701\",\n            \"makerOrderId\": \"236679660971245570\",\n            \"takerOrderId\": \"236679661919211521\",\n            \"ts\": 1729242030932000000,\n            \"size\": 1,\n            \"price\": \"67867.8\",\n            \"side\": \"sell\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTradeHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getKlines Request
     * Get Klines
     * /api/v1/kline/query
     */
    public function testGetKlinesRequest()
    {
        $data =
            "{\"symbol\": \"XBTUSDTM\", \"granularity\": 1, \"from\": 1728552342000, \"to\": 1729243542000}";
        $req = GetKlinesReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getKlines Response
     * Get Klines
     * /api/v1/kline/query
     */
    public function testGetKlinesResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        [\n            1728576000000,\n            60791.1,\n            61035,\n            58940,\n            60300,\n            5501167\n        ],\n        [\n            1728604800000,\n            60299.9,\n            60924.1,\n            60077.4,\n            60666.1,\n            1220980\n        ],\n        [\n            1728633600000,\n            60665.7,\n            62436.8,\n            60650.1,\n            62255.1,\n            3386359\n        ]\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetKlinesResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarkPrice Request
     * Get Mark Price
     * /api/v1/mark-price/{symbol}/current
     */
    public function testGetMarkPriceRequest()
    {
        $data = "{\"symbol\": \"XBTUSDTM\"}";
        $req = GetMarkPriceReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMarkPrice Response
     * Get Mark Price
     * /api/v1/mark-price/{symbol}/current
     */
    public function testGetMarkPriceResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"symbol\":\"XBTUSDTM\",\"granularity\":1000,\"timePoint\":1729254307000,\"value\":67687.08,\"indexPrice\":67683.58}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarkPriceResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotIndexPrice Request
     * Get Spot Index Price
     * /api/v1/index/query
     */
    public function testGetSpotIndexPriceRequest()
    {
        $data =
            "{\"symbol\": \".KXBTUSDT\", \"startAt\": 123456, \"endAt\": 123456, \"reverse\": true, \"offset\": 123456, \"forward\": true, \"maxCount\": 10}";
        $req = GetSpotIndexPriceReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotIndexPrice Response
     * Get Spot Index Price
     * /api/v1/index/query
     */
    public function testGetSpotIndexPriceResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"hasMore\": true,\n        \"dataList\": [\n            {\n                \"symbol\": \".KXBTUSDT\",\n                \"granularity\": 1000,\n                \"timePoint\": 1730557515000,\n                \"value\": 69202.94,\n                \"decomposionList\": [\n                    {\n                        \"exchange\": \"gateio\",\n                        \"price\": 69209.27,\n                        \"weight\": 0.0533\n                    },\n                    {\n                        \"exchange\": \"bitmart\",\n                        \"price\": 69230.77,\n                        \"weight\": 0.0128\n                    },\n                    {\n                        \"exchange\": \"okex\",\n                        \"price\": 69195.34,\n                        \"weight\": 0.11\n                    },\n                    {\n                        \"exchange\": \"bybit\",\n                        \"price\": 69190.33,\n                        \"weight\": 0.0676\n                    },\n                    {\n                        \"exchange\": \"binance\",\n                        \"price\": 69204.55,\n                        \"weight\": 0.6195\n                    },\n                    {\n                        \"exchange\": \"kucoin\",\n                        \"price\": 69202.91,\n                        \"weight\": 0.1368\n                    }\n                ]\n            },\n            {\n                \"symbol\": \".KXBTUSDT\",\n                \"granularity\": 1000,\n                \"timePoint\": 1730557514000,\n                \"value\": 69204.98,\n                \"decomposionList\": [\n                    {\n                        \"exchange\": \"gateio\",\n                        \"price\": 69212.71,\n                        \"weight\": 0.0808\n                    },\n                    {\n                        \"exchange\": \"bitmart\",\n                        \"price\": 69230.77,\n                        \"weight\": 0.0134\n                    },\n                    {\n                        \"exchange\": \"okex\",\n                        \"price\": 69195.49,\n                        \"weight\": 0.0536\n                    },\n                    {\n                        \"exchange\": \"bybit\",\n                        \"price\": 69195.97,\n                        \"weight\": 0.0921\n                    },\n                    {\n                        \"exchange\": \"binance\",\n                        \"price\": 69204.56,\n                        \"weight\": 0.5476\n                    },\n                    {\n                        \"exchange\": \"kucoin\",\n                        \"price\": 69207.8,\n                        \"weight\": 0.2125\n                    }\n                ]\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotIndexPriceResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getInterestRateIndex Request
     * Get Interest Rate Index
     * /api/v1/interest/query
     */
    public function testGetInterestRateIndexRequest()
    {
        $data =
            "{\"symbol\": \".XBTINT8H\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"reverse\": true, \"offset\": 254062248624417, \"forward\": true, \"maxCount\": 10}";
        $req = GetInterestRateIndexReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getInterestRateIndex Response
     * Get Interest Rate Index
     * /api/v1/interest/query
     */
    public function testGetInterestRateIndexResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"dataList\": [\n            {\n                \"symbol\": \".XBTINT\",\n                \"granularity\": 60000,\n                \"timePoint\": 1728692100000,\n                \"value\": 3.0E-4\n            },\n            {\n                \"symbol\": \".XBTINT\",\n                \"granularity\": 60000,\n                \"timePoint\": 1728692040000,\n                \"value\": 3.0E-4\n            }\n        ],\n        \"hasMore\": true\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetInterestRateIndexResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPremiumIndex Request
     * Get Premium Index
     * /api/v1/premium/query
     */
    public function testGetPremiumIndexRequest()
    {
        $data =
            "{\"symbol\": \".XBTUSDTMPI\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"reverse\": true, \"offset\": 254062248624417, \"forward\": true, \"maxCount\": 10}";
        $req = GetPremiumIndexReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPremiumIndex Response
     * Get Premium Index
     * /api/v1/premium/query
     */
    public function testGetPremiumIndexResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"hasMore\": true,\n        \"dataList\": [\n            {\n                \"symbol\": \".XBTUSDTMPI\",\n                \"granularity\": 60000,\n                \"timePoint\": 1730558040000,\n                \"value\": 0.00006\n            },\n            {\n                \"symbol\": \".XBTUSDTMPI\",\n                \"granularity\": 60000,\n                \"timePoint\": 1730557980000,\n                \"value\": -0.000025\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPremiumIndexResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * get24hrStats Request
     * Get 24hr stats
     * /api/v1/trade-statistics
     */
    public function testGet24hrStatsRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * get24hrStats Response
     * Get 24hr stats
     * /api/v1/trade-statistics
     */
    public function testGet24hrStatsResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"turnoverOf24h\":1.1155733413273683E9}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = Get24hrStatsResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getServerTime Request
     * Get Server Time
     * /api/v1/timestamp
     */
    public function testGetServerTimeRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getServerTime Response
     * Get Server Time
     * /api/v1/timestamp
     */
    public function testGetServerTimeResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":1729260030774}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetServerTimeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getServiceStatus Request
     * Get Service Status
     * /api/v1/status
     */
    public function testGetServiceStatusRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getServiceStatus Response
     * Get Service Status
     * /api/v1/status
     */
    public function testGetServiceStatusResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"msg\":\"\",\"status\":\"open\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetServiceStatusResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPublicToken Request
     * Get Public Token - Futures
     * /api/v1/bullet-public
     */
    public function testGetPublicTokenRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getPublicToken Response
     * Get Public Token - Futures
     * /api/v1/bullet-public
     */
    public function testGetPublicTokenResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"token\":\"2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ6dACm4ny9vJtLTRq_YsRUlG5ADnAawegdiYB9J6i9GjsxUuhPw3Blq6rhZlGykT3Vp1phUafnulOOpts-MEmEF-3bpfetLOAjsMMBS5qwTWJBvJHl5Vs9Y=.gJEIAywPXFr_4L-WG10eug==\",\"instanceServers\":[{\"endpoint\":\"wss://ws-api-futures.kucoin.com/\",\"encrypt\":true,\"protocol\":\"websocket\",\"pingInterval\":18000,\"pingTimeout\":10000}]}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPublicTokenResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPrivateToken Request
     * Get Private Token - Futures
     * /api/v1/bullet-private
     */
    public function testGetPrivateTokenRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getPrivateToken Response
     * Get Private Token - Futures
     * /api/v1/bullet-private
     */
    public function testGetPrivateTokenResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"token\": \"2neAiuYvAU737TOajb2U3uT8AEZqSWYe0fBD4LoHuXJDSC7gIzJiH4kNTWhCPISWo6nDpAe7aUaaHJ4fG8oRjFgMfUI2sM4IySWHrBceFocY8pKy2REU1HwZIngtMdMrjqPnP-biofFWbNaP1cl0X1pZc2SQ-33hDH1LgNP-yg8bktVoIG0dIxSN4m3uzO8u.ueCCihQ5_4GPpXKxWTDiFQ==\",\n        \"instanceServers\": [\n            {\n                \"endpoint\": \"wss://ws-api-futures.kucoin.com/\",\n                \"encrypt\": true,\n                \"protocol\": \"websocket\",\n                \"pingInterval\": 18000,\n                \"pingTimeout\": 10000\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPrivateTokenResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
