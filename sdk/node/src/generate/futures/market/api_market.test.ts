import { GetPremiumIndexResp } from './model_get_premium_index_resp';
import { GetMarkPriceResp } from './model_get_mark_price_resp';
import { GetTradeHistoryResp } from './model_get_trade_history_resp';
import { GetServiceStatusResp } from './model_get_service_status_resp';
import { GetTickerReq } from './model_get_ticker_req';
import { GetInterestRateIndexReq } from './model_get_interest_rate_index_req';
import { GetSpotIndexPriceReq } from './model_get_spot_index_price_req';
import { GetMarkPriceReq } from './model_get_mark_price_req';
import { GetPrivateTokenResp } from './model_get_private_token_resp';
import { GetPartOrderBookReq } from './model_get_part_order_book_req';
import { GetPremiumIndexReq } from './model_get_premium_index_req';
import { GetSymbolReq } from './model_get_symbol_req';
import { GetSymbolResp } from './model_get_symbol_resp';
import { GetTickerResp } from './model_get_ticker_resp';
import { GetFullOrderBookResp } from './model_get_full_order_book_resp';
import { GetFullOrderBookReq } from './model_get_full_order_book_req';
import { GetAllSymbolsResp } from './model_get_all_symbols_resp';
import { GetTradeHistoryReq } from './model_get_trade_history_req';
import { GetPublicTokenResp } from './model_get_public_token_resp';
import { GetInterestRateIndexResp } from './model_get_interest_rate_index_resp';
import { Get24hrStatsResp } from './model_get24hr_stats_resp';
import { GetKlinesReq } from './model_get_klines_req';
import { GetPartOrderBookResp } from './model_get_part_order_book_resp';
import { GetAllTickersResp } from './model_get_all_tickers_resp';
import { GetServerTimeResp } from './model_get_server_time_resp';
import { GetSpotIndexPriceResp } from './model_get_spot_index_price_resp';
import { GetKlinesResp } from './model_get_klines_resp';
import { RestResponse } from '@model/common';

describe('Auto Test', () => {
    test('getAllTickers request test', () => {
        /**
         * getAllTickers
         * Get All Tickers
         * /api/v1/allTickers
         */
    });

    test('getAllTickers response test', () => {
        /**
         * getAllTickers
         * Get All Tickers
         * /api/v1/allTickers
         */
    });
    test('getPrivateToken request test', () => {
        /**
         * getPrivateToken
         * Get Private Token - Futures
         * /api/v1/bullet-private
         */
    });

    test('getPrivateToken response test', () => {
        /**
         * getPrivateToken
         * Get Private Token - Futures
         * /api/v1/bullet-private
         */
    });
    test('getPublicToken request test', () => {
        /**
         * getPublicToken
         * Get Public Token - Futures
         * /api/v1/bullet-public
         */
    });

    test('getPublicToken response test', () => {
        /**
         * getPublicToken
         * Get Public Token - Futures
         * /api/v1/bullet-public
         */
    });
    test('GetAllSymbols request test', () => {
        /**
         * GetAllSymbols
         * Get All Symbols
         * /api/v1/contracts/active
         */
    });

    test('GetAllSymbols response test', () => {
        /**
         * GetAllSymbols
         * Get All Symbols
         * /api/v1/contracts/active
         */
    });
    test('getSymbol request test', () => {
        /**
         * getSymbol
         * Get Symbol
         * /api/v1/contracts/{symbol}
         */
        let data = '{"symbol": "XBTUSDTM"}';
        let req = new GetSymbolReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSymbol response test', () => {
        /**
         * getSymbol
         * Get Symbol
         * /api/v1/contracts/{symbol}
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "symbol": "XBTUSDM",\n        "rootSymbol": "XBT",\n        "type": "FFWCSX",\n        "firstOpenDate": 1552638575000,\n        "expireDate": null,\n        "settleDate": null,\n        "baseCurrency": "XBT",\n        "quoteCurrency": "USD",\n        "settleCurrency": "XBT",\n        "maxOrderQty": 10000000,\n        "maxPrice": 1000000.0,\n        "lotSize": 1,\n        "tickSize": 0.1,\n        "indexPriceTickSize": 0.1,\n        "multiplier": -1.0,\n        "initialMargin": 0.014,\n        "maintainMargin": 0.007,\n        "maxRiskLimit": 1,\n        "minRiskLimit": 1,\n        "riskStep": 0,\n        "makerFeeRate": 2.0E-4,\n        "takerFeeRate": 6.0E-4,\n        "takerFixFee": 0.0,\n        "makerFixFee": 0.0,\n        "settlementFee": null,\n        "isDeleverage": true,\n        "isQuanto": false,\n        "isInverse": true,\n        "markMethod": "FairPrice",\n        "fairMethod": "FundingRate",\n        "fundingBaseSymbol": ".XBTINT8H",\n        "fundingQuoteSymbol": ".USDINT8H",\n        "fundingRateSymbol": ".XBTUSDMFPI8H",\n        "indexSymbol": ".BXBT",\n        "settlementSymbol": null,\n        "status": "Open",\n        "fundingFeeRate": 1.75E-4,\n        "predictedFundingFeeRate": 1.76E-4,\n        "fundingRateGranularity": 28800000,\n        "openInterest": "61725904",\n        "turnoverOf24h": 209.56303473,\n        "volumeOf24h": 1.4354731E7,\n        "markPrice": 68336.7,\n        "indexPrice": 68335.29,\n        "lastTradePrice": 68349.3,\n        "nextFundingRateTime": 17402942,\n        "maxLeverage": 75,\n        "sourceExchanges": [\n            "kraken",\n            "bitstamp",\n            "crypto"\n        ],\n        "premiumsSymbol1M": ".XBTUSDMPI",\n        "premiumsSymbol8H": ".XBTUSDMPI8H",\n        "fundingBaseSymbol1M": ".XBTINT",\n        "fundingQuoteSymbol1M": ".USDINT",\n        "lowPrice": 67436.7,\n        "highPrice": 69471.8,\n        "priceChgPct": 0.0097,\n        "priceChg": 658.7,\n        "k": 2645000.0,\n        "m": 1640000.0,\n        "f": 1.3,\n        "mmrLimit": 0.3,\n        "mmrLevConstant": 75.0,\n        "supportCross": true\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetSymbolResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getSpotIndexPrice request test', () => {
        /**
         * getSpotIndexPrice
         * Get Spot Index Price
         * /api/v1/index/query
         */
        let data =
            '{"symbol": ".KXBTUSDT", "startAt": 123456, "endAt": 123456, "reverse": true, "offset": 123456, "forward": true, "maxCount": 10}';
        let req = new GetSpotIndexPriceReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSpotIndexPrice response test', () => {
        /**
         * getSpotIndexPrice
         * Get Spot Index Price
         * /api/v1/index/query
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "hasMore": true,\n        "dataList": [\n            {\n                "symbol": ".KXBTUSDT",\n                "granularity": 1000,\n                "timePoint": 1730557515000,\n                "value": 69202.94,\n                "decomposionList": [\n                    {\n                        "exchange": "gateio",\n                        "price": 69209.27,\n                        "weight": 0.0533\n                    },\n                    {\n                        "exchange": "bitmart",\n                        "price": 69230.77,\n                        "weight": 0.0128\n                    },\n                    {\n                        "exchange": "okex",\n                        "price": 69195.34,\n                        "weight": 0.11\n                    },\n                    {\n                        "exchange": "bybit",\n                        "price": 69190.33,\n                        "weight": 0.0676\n                    },\n                    {\n                        "exchange": "binance",\n                        "price": 69204.55,\n                        "weight": 0.6195\n                    },\n                    {\n                        "exchange": "kucoin",\n                        "price": 69202.91,\n                        "weight": 0.1368\n                    }\n                ]\n            },\n            {\n                "symbol": ".KXBTUSDT",\n                "granularity": 1000,\n                "timePoint": 1730557514000,\n                "value": 69204.98,\n                "decomposionList": [\n                    {\n                        "exchange": "gateio",\n                        "price": 69212.71,\n                        "weight": 0.0808\n                    },\n                    {\n                        "exchange": "bitmart",\n                        "price": 69230.77,\n                        "weight": 0.0134\n                    },\n                    {\n                        "exchange": "okex",\n                        "price": 69195.49,\n                        "weight": 0.0536\n                    },\n                    {\n                        "exchange": "bybit",\n                        "price": 69195.97,\n                        "weight": 0.0921\n                    },\n                    {\n                        "exchange": "binance",\n                        "price": 69204.56,\n                        "weight": 0.5476\n                    },\n                    {\n                        "exchange": "kucoin",\n                        "price": 69207.8,\n                        "weight": 0.2125\n                    }\n                ]\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetSpotIndexPriceResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getInterestRateIndex request test', () => {
        /**
         * getInterestRateIndex
         * Get Interest Rate Index
         * /api/v1/interest/query
         */
        let data =
            '{"symbol": ".XBTINT8H", "startAt": 1728663338000, "endAt": 1728692138000, "reverse": true, "offset": 254062248624417, "forward": true, "maxCount": 10}';
        let req = new GetInterestRateIndexReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getInterestRateIndex response test', () => {
        /**
         * getInterestRateIndex
         * Get Interest Rate Index
         * /api/v1/interest/query
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "dataList": [\n            {\n                "symbol": ".XBTINT",\n                "granularity": 60000,\n                "timePoint": 1728692100000,\n                "value": 3.0E-4\n            },\n            {\n                "symbol": ".XBTINT",\n                "granularity": 60000,\n                "timePoint": 1728692040000,\n                "value": 3.0E-4\n            }\n        ],\n        "hasMore": true\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetInterestRateIndexResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getKlines request test', () => {
        /**
         * getKlines
         * Get Klines
         * /api/v1/kline/query
         */
        let data =
            '{"symbol": "XBTUSDTM", "granularity": 1, "from": 1728552342000, "to": 1729243542000}';
        let req = new GetKlinesReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getKlines response test', () => {
        /**
         * getKlines
         * Get Klines
         * /api/v1/kline/query
         */
        let data =
            '{\n    "code": "200000",\n    "data": [\n        [\n            1728576000000,\n            60791.1,\n            61035,\n            58940,\n            60300,\n            5501167\n        ],\n        [\n            1728604800000,\n            60299.9,\n            60924.1,\n            60077.4,\n            60666.1,\n            1220980\n        ],\n        [\n            1728633600000,\n            60665.7,\n            62436.8,\n            60650.1,\n            62255.1,\n            3386359\n        ]\n    ]\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetKlinesResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getPartOrderBook request test', () => {
        /**
         * getPartOrderBook
         * Get Part OrderBook
         * /api/v1/level2/depth{size}
         */
        let data = '{"symbol": "XBTUSDM", "size": "20"}';
        let req = new GetPartOrderBookReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getPartOrderBook response test', () => {
        /**
         * getPartOrderBook
         * Get Part OrderBook
         * /api/v1/level2/depth{size}
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "sequence": 1697895963339,\n        "symbol": "XBTUSDM",\n        "bids": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        "asks": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        "ts": 1729168101216000000\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetPartOrderBookResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getFullOrderBook request test', () => {
        /**
         * getFullOrderBook
         * Get Full OrderBook
         * /api/v1/level2/snapshot
         */
        let data = '{"symbol": "XBTUSDM"}';
        let req = new GetFullOrderBookReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getFullOrderBook response test', () => {
        /**
         * getFullOrderBook
         * Get Full OrderBook
         * /api/v1/level2/snapshot
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "sequence": 1697895963339,\n        "symbol": "XBTUSDM",\n        "bids": [\n            [\n                66968,\n                2\n            ],\n            [\n                66964.8,\n                25596\n            ]\n        ],\n        "asks": [\n            [\n                66968.1,\n                13501\n            ],\n            [\n                66968.7,\n                2032\n            ]\n        ],\n        "ts": 1729168101216000000\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetFullOrderBookResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getMarkPrice request test', () => {
        /**
         * getMarkPrice
         * Get Mark Price
         * /api/v1/mark-price/{symbol}/current
         */
        let data = '{"symbol": "XBTUSDTM"}';
        let req = new GetMarkPriceReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getMarkPrice response test', () => {
        /**
         * getMarkPrice
         * Get Mark Price
         * /api/v1/mark-price/{symbol}/current
         */
        let data =
            '{"code":"200000","data":{"symbol":"XBTUSDTM","granularity":1000,"timePoint":1729254307000,"value":67687.08,"indexPrice":67683.58}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetMarkPriceResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getPremiumIndex request test', () => {
        /**
         * getPremiumIndex
         * Get Premium Index
         * /api/v1/premium/query
         */
        let data =
            '{"symbol": ".XBTUSDTMPI", "startAt": 1728663338000, "endAt": 1728692138000, "reverse": true, "offset": 254062248624417, "forward": true, "maxCount": 10}';
        let req = new GetPremiumIndexReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getPremiumIndex response test', () => {
        /**
         * getPremiumIndex
         * Get Premium Index
         * /api/v1/premium/query
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "hasMore": true,\n        "dataList": [\n            {\n                "symbol": ".XBTUSDTMPI",\n                "granularity": 60000,\n                "timePoint": 1730558040000,\n                "value": 0.00006\n            },\n            {\n                "symbol": ".XBTUSDTMPI",\n                "granularity": 60000,\n                "timePoint": 1730557980000,\n                "value": -0.000025\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetPremiumIndexResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getServiceStatus request test', () => {
        /**
         * getServiceStatus
         * Get Service Status
         * /api/v1/status
         */
    });

    test('getServiceStatus response test', () => {
        /**
         * getServiceStatus
         * Get Service Status
         * /api/v1/status
         */
    });
    test('getTicker request test', () => {
        /**
         * getTicker
         * Get Ticker
         * /api/v1/ticker
         */
        let data = '{"symbol": "XBTUSDTM"}';
        let req = new GetTickerReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getTicker response test', () => {
        /**
         * getTicker
         * Get Ticker
         * /api/v1/ticker
         */
        let data =
            '{"code":"200000","data":{"sequence":1697895100310,"symbol":"XBTUSDM","side":"sell","size":2936,"tradeId":"1697901180000","price":"67158.4","bestBidPrice":"67169.6","bestBidSize":32345,"bestAskPrice":"67169.7","bestAskSize":7251,"ts":1729163001780000000}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetTickerResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('getServerTime request test', () => {
        /**
         * getServerTime
         * Get Server Time
         * /api/v1/timestamp
         */
    });

    test('getServerTime response test', () => {
        /**
         * getServerTime
         * Get Server Time
         * /api/v1/timestamp
         */
    });
    test('getTradeHistory request test', () => {
        /**
         * getTradeHistory
         * Get Trade History
         * /api/v1/trade/history
         */
        let data = '{"symbol": "XBTUSDM"}';
        let req = new GetTradeHistoryReq();
        req = req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getTradeHistory response test', () => {
        /**
         * getTradeHistory
         * Get Trade History
         * /api/v1/trade/history
         */
        let data =
            '{\n    "code": "200000",\n    "data": [\n        {\n            "sequence": 1697915257909,\n            "contractId": 1,\n            "tradeId": "1697915257909",\n            "makerOrderId": "236679665752801280",\n            "takerOrderId": "236679667975745536",\n            "ts": 1729242032152000000,\n            "size": 1,\n            "price": "67878",\n            "side": "sell"\n        },\n        {\n            "sequence": 1697915257749,\n            "contractId": 1,\n            "tradeId": "1697915257749",\n            "makerOrderId": "236679660971245570",\n            "takerOrderId": "236679665400492032",\n            "ts": 1729242031535000000,\n            "size": 1,\n            "price": "67867.8",\n            "side": "sell"\n        },\n        {\n            "sequence": 1697915257701,\n            "contractId": 1,\n            "tradeId": "1697915257701",\n            "makerOrderId": "236679660971245570",\n            "takerOrderId": "236679661919211521",\n            "ts": 1729242030932000000,\n            "size": 1,\n            "price": "67867.8",\n            "side": "sell"\n        }\n    ]\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = new GetTradeHistoryResp();
        resp = resp.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('get24hrStats request test', () => {
        /**
         * get24hrStats
         * Get 24hr Stats
         * /api/v1/trade-statistics
         */
    });

    test('get24hrStats response test', () => {
        /**
         * get24hrStats
         * Get 24hr Stats
         * /api/v1/trade-statistics
         */
    });
});