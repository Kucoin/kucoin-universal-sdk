package market

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestMarketGetSymbolReqModel(t *testing.T) {
	// GetSymbol
	// Get Symbol
	// /api/v1/contracts/{symbol}

	data := "{\"symbol\": \"XBTUSDTM\"}"
	req := &GetSymbolReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetSymbolRespModel(t *testing.T) {
	// GetSymbol
	// Get Symbol
	// /api/v1/contracts/{symbol}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"XBTUSDTM\",\n        \"rootSymbol\": \"USDT\",\n        \"type\": \"FFWCSX\",\n        \"firstOpenDate\": 1585555200000,\n        \"expireDate\": null,\n        \"settleDate\": null,\n        \"baseCurrency\": \"XBT\",\n        \"quoteCurrency\": \"USDT\",\n        \"settleCurrency\": \"USDT\",\n        \"maxOrderQty\": 1000000,\n        \"maxPrice\": 1000000.0,\n        \"lotSize\": 1,\n        \"tickSize\": 0.1,\n        \"indexPriceTickSize\": 0.01,\n        \"multiplier\": 0.001,\n        \"initialMargin\": 0.008,\n        \"maintainMargin\": 0.004,\n        \"maxRiskLimit\": 100000,\n        \"minRiskLimit\": 100000,\n        \"riskStep\": 50000,\n        \"makerFeeRate\": 2.0E-4,\n        \"takerFeeRate\": 6.0E-4,\n        \"takerFixFee\": 0.0,\n        \"makerFixFee\": 0.0,\n        \"settlementFee\": null,\n        \"isDeleverage\": true,\n        \"isQuanto\": true,\n        \"isInverse\": false,\n        \"markMethod\": \"FairPrice\",\n        \"fairMethod\": \"FundingRate\",\n        \"fundingBaseSymbol\": \".XBTINT8H\",\n        \"fundingQuoteSymbol\": \".USDTINT8H\",\n        \"fundingRateSymbol\": \".XBTUSDTMFPI8H\",\n        \"indexSymbol\": \".KXBTUSDT\",\n        \"settlementSymbol\": \"\",\n        \"status\": \"Open\",\n        \"fundingFeeRate\": 5.2E-5,\n        \"predictedFundingFeeRate\": 8.3E-5,\n        \"fundingRateGranularity\": 28800000,\n        \"openInterest\": \"6748176\",\n        \"turnoverOf24h\": 1.0346431983265533E9,\n        \"volumeOf24h\": 12069.225,\n        \"markPrice\": 86378.69,\n        \"indexPrice\": 86382.64,\n        \"lastTradePrice\": 86364,\n        \"nextFundingRateTime\": 17752926,\n        \"maxLeverage\": 125,\n        \"sourceExchanges\": [\n            \"okex\",\n            \"binance\",\n            \"kucoin\",\n            \"bybit\",\n            \"bitmart\",\n            \"gateio\"\n        ],\n        \"premiumsSymbol1M\": \".XBTUSDTMPI\",\n        \"premiumsSymbol8H\": \".XBTUSDTMPI8H\",\n        \"fundingBaseSymbol1M\": \".XBTINT\",\n        \"fundingQuoteSymbol1M\": \".USDTINT\",\n        \"lowPrice\": 82205.2,\n        \"highPrice\": 89299.9,\n        \"priceChgPct\": -0.028,\n        \"priceChg\": -2495.9,\n        \"k\": 490.0,\n        \"m\": 300.0,\n        \"f\": 1.3,\n        \"mmrLimit\": 0.3,\n        \"mmrLevConstant\": 125.0,\n        \"supportCross\": true,\n        \"buyLimit\": 90700.7115,\n        \"sellLimit\": 82062.5485\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSymbolResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetAllSymbolsReqModel(t *testing.T) {
	// GetAllSymbols
	// Get All Symbols
	// /api/v1/contracts/active

}

func TestMarketGetAllSymbolsRespModel(t *testing.T) {
	// GetAllSymbols
	// Get All Symbols
	// /api/v1/contracts/active

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"XBTUSDTM\",\n            \"rootSymbol\": \"USDT\",\n            \"type\": \"FFWCSX\",\n            \"firstOpenDate\": 1585555200000,\n            \"expireDate\": null,\n            \"settleDate\": null,\n            \"baseCurrency\": \"XBT\",\n            \"quoteCurrency\": \"USDT\",\n            \"settleCurrency\": \"USDT\",\n            \"maxOrderQty\": 1000000,\n            \"maxPrice\": 1000000,\n            \"lotSize\": 1,\n            \"tickSize\": 0.1,\n            \"indexPriceTickSize\": 0.01,\n            \"multiplier\": 0.001,\n            \"initialMargin\": 0.008,\n            \"maintainMargin\": 0.004,\n            \"maxRiskLimit\": 100000,\n            \"minRiskLimit\": 100000,\n            \"riskStep\": 50000,\n            \"makerFeeRate\": 0.0002,\n            \"takerFeeRate\": 0.0006,\n            \"takerFixFee\": 0,\n            \"makerFixFee\": 0,\n            \"settlementFee\": null,\n            \"isDeleverage\": true,\n            \"isQuanto\": true,\n            \"isInverse\": false,\n            \"markMethod\": \"FairPrice\",\n            \"fairMethod\": \"FundingRate\",\n            \"fundingBaseSymbol\": \".XBTINT8H\",\n            \"fundingQuoteSymbol\": \".USDTINT8H\",\n            \"fundingRateSymbol\": \".XBTUSDTMFPI8H\",\n            \"indexSymbol\": \".KXBTUSDT\",\n            \"settlementSymbol\": \"\",\n            \"status\": \"Open\",\n            \"fundingFeeRate\": 0.000052,\n            \"predictedFundingFeeRate\": 0.000083,\n            \"fundingRateGranularity\": 28800000,\n            \"openInterest\": \"6748176\",\n            \"turnoverOf24h\": 1034643198.3265533,\n            \"volumeOf24h\": 12069.225,\n            \"markPrice\": 86378.69,\n            \"indexPrice\": 86382.64,\n            \"lastTradePrice\": 86364,\n            \"nextFundingRateTime\": 17752926,\n            \"maxLeverage\": 125,\n            \"sourceExchanges\": [\n                \"okex\",\n                \"binance\",\n                \"kucoin\",\n                \"bybit\",\n                \"bitmart\",\n                \"gateio\"\n            ],\n            \"premiumsSymbol1M\": \".XBTUSDTMPI\",\n            \"premiumsSymbol8H\": \".XBTUSDTMPI8H\",\n            \"fundingBaseSymbol1M\": \".XBTINT\",\n            \"fundingQuoteSymbol1M\": \".USDTINT\",\n            \"lowPrice\": 82205.2,\n            \"highPrice\": 89299.9,\n            \"priceChgPct\": -0.028,\n            \"priceChg\": -2495.9,\n            \"k\": 490,\n            \"m\": 300,\n            \"f\": 1.3,\n            \"mmrLimit\": 0.3,\n            \"mmrLevConstant\": 125,\n            \"supportCross\": true,\n            \"buyLimit\": 90700.7115,\n            \"sellLimit\": 82062.5485\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetAllSymbolsResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetTickerReqModel(t *testing.T) {
	// GetTicker
	// Get Ticker
	// /api/v1/ticker

	data := "{\"symbol\": \"XBTUSDTM\"}"
	req := &GetTickerReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetTickerRespModel(t *testing.T) {
	// GetTicker
	// Get Ticker
	// /api/v1/ticker

	data := "{\"code\":\"200000\",\"data\":{\"sequence\":1697895100310,\"symbol\":\"XBTUSDM\",\"side\":\"sell\",\"size\":2936,\"tradeId\":\"1697901180000\",\"price\":\"67158.4\",\"bestBidPrice\":\"67169.6\",\"bestBidSize\":32345,\"bestAskPrice\":\"67169.7\",\"bestAskSize\":7251,\"ts\":1729163001780000000}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetTickerResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetAllTickersReqModel(t *testing.T) {
	// GetAllTickers
	// Get All Tickers
	// /api/v1/allTickers

}

func TestMarketGetAllTickersRespModel(t *testing.T) {
	// GetAllTickers
	// Get All Tickers
	// /api/v1/allTickers

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"sequence\": 1707992727046,\n            \"symbol\": \"XBTUSDTM\",\n            \"side\": \"sell\",\n            \"size\": 21,\n            \"tradeId\": \"1784299761369\",\n            \"price\": \"67153\",\n            \"bestBidPrice\": \"67153\",\n            \"bestBidSize\": 2767,\n            \"bestAskPrice\": \"67153.1\",\n            \"bestAskSize\": 5368,\n            \"ts\": 1729163466659000000\n        },\n        {\n            \"sequence\": 1697895166299,\n            \"symbol\": \"XBTUSDM\",\n            \"side\": \"sell\",\n            \"size\": 1956,\n            \"tradeId\": \"1697901245065\",\n            \"price\": \"67145.2\",\n            \"bestBidPrice\": \"67135.3\",\n            \"bestBidSize\": 1,\n            \"bestAskPrice\": \"67135.8\",\n            \"bestAskSize\": 3,\n            \"ts\": 1729163445340000000\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetAllTickersResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetFullOrderBookReqModel(t *testing.T) {
	// GetFullOrderBook
	// Get Full OrderBook
	// /api/v1/level2/snapshot

	data := "{\"symbol\": \"XBTUSDM\"}"
	req := &GetFullOrderBookReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetFullOrderBookRespModel(t *testing.T) {
	// GetFullOrderBook
	// Get Full OrderBook
	// /api/v1/level2/snapshot

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"sequence\": 1697895963339,\n        \"symbol\": \"XBTUSDM\",\n        \"bids\": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        \"asks\": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        \"ts\": 1729168101216000000\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetFullOrderBookResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPartOrderBookReqModel(t *testing.T) {
	// GetPartOrderBook
	// Get Part OrderBook
	// /api/v1/level2/depth{size}

	data := "{\"size\": \"20\", \"symbol\": \"XBTUSDM\"}"
	req := &GetPartOrderBookReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPartOrderBookRespModel(t *testing.T) {
	// GetPartOrderBook
	// Get Part OrderBook
	// /api/v1/level2/depth{size}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"sequence\": 1697895963339,\n        \"symbol\": \"XBTUSDM\",\n        \"bids\": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        \"asks\": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        \"ts\": 1729168101216000000\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetPartOrderBookResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetTradeHistoryReqModel(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v1/trade/history

	data := "{\"symbol\": \"XBTUSDM\"}"
	req := &GetTradeHistoryReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetTradeHistoryRespModel(t *testing.T) {
	// GetTradeHistory
	// Get Trade History
	// /api/v1/trade/history

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"sequence\": 1697915257909,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257909\",\n            \"makerOrderId\": \"236679665752801280\",\n            \"takerOrderId\": \"236679667975745536\",\n            \"ts\": 1729242032152000000,\n            \"size\": 1,\n            \"price\": \"67878\",\n            \"side\": \"sell\"\n        },\n        {\n            \"sequence\": 1697915257749,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257749\",\n            \"makerOrderId\": \"236679660971245570\",\n            \"takerOrderId\": \"236679665400492032\",\n            \"ts\": 1729242031535000000,\n            \"size\": 1,\n            \"price\": \"67867.8\",\n            \"side\": \"sell\"\n        },\n        {\n            \"sequence\": 1697915257701,\n            \"contractId\": 1,\n            \"tradeId\": \"1697915257701\",\n            \"makerOrderId\": \"236679660971245570\",\n            \"takerOrderId\": \"236679661919211521\",\n            \"ts\": 1729242030932000000,\n            \"size\": 1,\n            \"price\": \"67867.8\",\n            \"side\": \"sell\"\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetTradeHistoryResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetKlinesReqModel(t *testing.T) {
	// GetKlines
	// Get Klines
	// /api/v1/kline/query

	data := "{\"symbol\": \"XBTUSDTM\", \"granularity\": 1, \"from\": 1728552342000, \"to\": 1729243542000}"
	req := &GetKlinesReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetKlinesRespModel(t *testing.T) {
	// GetKlines
	// Get Klines
	// /api/v1/kline/query

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        [\n            1728576000000,\n            60791.1,\n            61035,\n            58940,\n            60300,\n            5501167\n        ],\n        [\n            1728604800000,\n            60299.9,\n            60924.1,\n            60077.4,\n            60666.1,\n            1220980\n        ],\n        [\n            1728633600000,\n            60665.7,\n            62436.8,\n            60650.1,\n            62255.1,\n            3386359\n        ]\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetKlinesResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetMarkPriceReqModel(t *testing.T) {
	// GetMarkPrice
	// Get Mark Price
	// /api/v1/mark-price/{symbol}/current

	data := "{\"symbol\": \"XBTUSDTM\"}"
	req := &GetMarkPriceReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetMarkPriceRespModel(t *testing.T) {
	// GetMarkPrice
	// Get Mark Price
	// /api/v1/mark-price/{symbol}/current

	data := "{\"code\":\"200000\",\"data\":{\"symbol\":\"XBTUSDTM\",\"granularity\":1000,\"timePoint\":1729254307000,\"value\":67687.08,\"indexPrice\":67683.58}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetMarkPriceResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetSpotIndexPriceReqModel(t *testing.T) {
	// GetSpotIndexPrice
	// Get Spot Index Price
	// /api/v1/index/query

	data := "{\"symbol\": \".KXBTUSDT\", \"startAt\": 123456, \"endAt\": 123456, \"reverse\": true, \"offset\": 123456, \"forward\": true, \"maxCount\": 10}"
	req := &GetSpotIndexPriceReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetSpotIndexPriceRespModel(t *testing.T) {
	// GetSpotIndexPrice
	// Get Spot Index Price
	// /api/v1/index/query

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"hasMore\": true,\n        \"dataList\": [\n            {\n                \"symbol\": \".KXBTUSDT\",\n                \"granularity\": 1000,\n                \"timePoint\": 1730557515000,\n                \"value\": 69202.94,\n                \"decomposionList\": [\n                    {\n                        \"exchange\": \"gateio\",\n                        \"price\": 69209.27,\n                        \"weight\": 0.0533\n                    },\n                    {\n                        \"exchange\": \"bitmart\",\n                        \"price\": 69230.77,\n                        \"weight\": 0.0128\n                    },\n                    {\n                        \"exchange\": \"okex\",\n                        \"price\": 69195.34,\n                        \"weight\": 0.11\n                    },\n                    {\n                        \"exchange\": \"bybit\",\n                        \"price\": 69190.33,\n                        \"weight\": 0.0676\n                    },\n                    {\n                        \"exchange\": \"binance\",\n                        \"price\": 69204.55,\n                        \"weight\": 0.6195\n                    },\n                    {\n                        \"exchange\": \"kucoin\",\n                        \"price\": 69202.91,\n                        \"weight\": 0.1368\n                    }\n                ]\n            },\n            {\n                \"symbol\": \".KXBTUSDT\",\n                \"granularity\": 1000,\n                \"timePoint\": 1730557514000,\n                \"value\": 69204.98,\n                \"decomposionList\": [\n                    {\n                        \"exchange\": \"gateio\",\n                        \"price\": 69212.71,\n                        \"weight\": 0.0808\n                    },\n                    {\n                        \"exchange\": \"bitmart\",\n                        \"price\": 69230.77,\n                        \"weight\": 0.0134\n                    },\n                    {\n                        \"exchange\": \"okex\",\n                        \"price\": 69195.49,\n                        \"weight\": 0.0536\n                    },\n                    {\n                        \"exchange\": \"bybit\",\n                        \"price\": 69195.97,\n                        \"weight\": 0.0921\n                    },\n                    {\n                        \"exchange\": \"binance\",\n                        \"price\": 69204.56,\n                        \"weight\": 0.5476\n                    },\n                    {\n                        \"exchange\": \"kucoin\",\n                        \"price\": 69207.8,\n                        \"weight\": 0.2125\n                    }\n                ]\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotIndexPriceResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetInterestRateIndexReqModel(t *testing.T) {
	// GetInterestRateIndex
	// Get Interest Rate Index
	// /api/v1/interest/query

	data := "{\"symbol\": \".XBTINT8H\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"reverse\": true, \"offset\": 254062248624417, \"forward\": true, \"maxCount\": 10}"
	req := &GetInterestRateIndexReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetInterestRateIndexRespModel(t *testing.T) {
	// GetInterestRateIndex
	// Get Interest Rate Index
	// /api/v1/interest/query

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"dataList\": [\n            {\n                \"symbol\": \".XBTINT\",\n                \"granularity\": 60000,\n                \"timePoint\": 1728692100000,\n                \"value\": 3.0E-4\n            },\n            {\n                \"symbol\": \".XBTINT\",\n                \"granularity\": 60000,\n                \"timePoint\": 1728692040000,\n                \"value\": 3.0E-4\n            }\n        ],\n        \"hasMore\": true\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetInterestRateIndexResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPremiumIndexReqModel(t *testing.T) {
	// GetPremiumIndex
	// Get Premium Index
	// /api/v1/premium/query

	data := "{\"symbol\": \".XBTUSDTMPI\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"reverse\": true, \"offset\": 254062248624417, \"forward\": true, \"maxCount\": 10}"
	req := &GetPremiumIndexReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPremiumIndexRespModel(t *testing.T) {
	// GetPremiumIndex
	// Get Premium Index
	// /api/v1/premium/query

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"hasMore\": true,\n        \"dataList\": [\n            {\n                \"symbol\": \".XBTUSDTMPI\",\n                \"granularity\": 60000,\n                \"timePoint\": 1730558040000,\n                \"value\": 0.00006\n            },\n            {\n                \"symbol\": \".XBTUSDTMPI\",\n                \"granularity\": 60000,\n                \"timePoint\": 1730557980000,\n                \"value\": -0.000025\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetPremiumIndexResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGet24hrStatsReqModel(t *testing.T) {
	// Get24hrStats
	// Get 24hr stats
	// /api/v1/trade-statistics

}

func TestMarketGet24hrStatsRespModel(t *testing.T) {
	// Get24hrStats
	// Get 24hr stats
	// /api/v1/trade-statistics

	data := "{\"code\":\"200000\",\"data\":{\"turnoverOf24h\":1.1155733413273683E9}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &Get24hrStatsResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetServerTimeReqModel(t *testing.T) {
	// GetServerTime
	// Get Server Time
	// /api/v1/timestamp

}

func TestMarketGetServerTimeRespModel(t *testing.T) {
	// GetServerTime
	// Get Server Time
	// /api/v1/timestamp

	data := "{\"code\":\"200000\",\"data\":1729260030774}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetServerTimeResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetServiceStatusReqModel(t *testing.T) {
	// GetServiceStatus
	// Get Service Status
	// /api/v1/status

}

func TestMarketGetServiceStatusRespModel(t *testing.T) {
	// GetServiceStatus
	// Get Service Status
	// /api/v1/status

	data := "{\"code\":\"200000\",\"data\":{\"msg\":\"\",\"status\":\"open\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetServiceStatusResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPublicTokenReqModel(t *testing.T) {
	// GetPublicToken
	// Get Public Token - Futures
	// /api/v1/bullet-public

}

func TestMarketGetPublicTokenRespModel(t *testing.T) {
	// GetPublicToken
	// Get Public Token - Futures
	// /api/v1/bullet-public

	data := "{\"code\":\"200000\",\"data\":{\"token\":\"2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ6dACm4ny9vJtLTRq_YsRUlG5ADnAawegdiYB9J6i9GjsxUuhPw3Blq6rhZlGykT3Vp1phUafnulOOpts-MEmEF-3bpfetLOAjsMMBS5qwTWJBvJHl5Vs9Y=.gJEIAywPXFr_4L-WG10eug==\",\"instanceServers\":[{\"endpoint\":\"wss://ws-api-futures.kucoin.com/\",\"encrypt\":true,\"protocol\":\"websocket\",\"pingInterval\":18000,\"pingTimeout\":10000}]}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetPublicTokenResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestMarketGetPrivateTokenReqModel(t *testing.T) {
	// GetPrivateToken
	// Get Private Token - Futures
	// /api/v1/bullet-private

}

func TestMarketGetPrivateTokenRespModel(t *testing.T) {
	// GetPrivateToken
	// Get Private Token - Futures
	// /api/v1/bullet-private

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"token\": \"2neAiuYvAU737TOajb2U3uT8AEZqSWYe0fBD4LoHuXJDSC7gIzJiH4kNTWhCPISWo6nDpAe7aUaaHJ4fG8oRjFgMfUI2sM4IySWHrBceFocY8pKy2REU1HwZIngtMdMrjqPnP-biofFWbNaP1cl0X1pZc2SQ-33hDH1LgNP-yg8bktVoIG0dIxSN4m3uzO8u.ueCCihQ5_4GPpXKxWTDiFQ==\",\n        \"instanceServers\": [\n            {\n                \"endpoint\": \"wss://ws-api-futures.kucoin.com/\",\n                \"encrypt\": true,\n                \"protocol\": \"websocket\",\n                \"pingInterval\": 18000,\n                \"pingTimeout\": 10000\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetPrivateTokenResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}
