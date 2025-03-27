import { GetMarkPriceDetailReq } from './model_get_mark_price_detail_req';
import { GetCrossMarginSymbolsResp } from './model_get_cross_margin_symbols_resp';
import { GetMarkPriceListResp } from './model_get_mark_price_list_resp';
import { GetIsolatedMarginSymbolsResp } from './model_get_isolated_margin_symbols_resp';
import { GetCrossMarginSymbolsReq } from './model_get_cross_margin_symbols_req';
import { GetMarkPriceDetailResp } from './model_get_mark_price_detail_resp';
import { GetMarginConfigResp } from './model_get_margin_config_resp';
import { GetETFInfoResp } from './model_get_etf_info_resp';
import { GetETFInfoReq } from './model_get_etf_info_req';
import { RestResponse } from '@model/common';

describe('Auto Test', () => {
    test('getCrossMarginSymbols request test', () => {
        /**
         * getCrossMarginSymbols
         * Get Symbols - Cross Margin
         * /api/v3/margin/symbols
         */
        let data = '{"symbol": "BTC-USDT"}';
        let req = GetCrossMarginSymbolsReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getCrossMarginSymbols response test', () => {
        /**
         * getCrossMarginSymbols
         * Get Symbols - Cross Margin
         * /api/v3/margin/symbols
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "timestamp": 1729665839353,\n        "items": [\n            {\n                "symbol": "BTC-USDT",\n                "name": "BTC-USDT",\n                "enableTrading": true,\n                "market": "USDS",\n                "baseCurrency": "BTC",\n                "quoteCurrency": "USDT",\n                "baseIncrement": "0.00000001",\n                "baseMinSize": "0.00001",\n                "baseMaxSize": "10000000000",\n                "quoteIncrement": "0.000001",\n                "quoteMinSize": "0.1",\n                "quoteMaxSize": "99999999",\n                "priceIncrement": "0.1",\n                "feeCurrency": "USDT",\n                "priceLimitRate": "0.1",\n                "minFunds": "0.1"\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetCrossMarginSymbolsResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getETFInfo request test', () => {
        /**
         * getETFInfo
         * Get ETF Info
         * /api/v3/etf/info
         */
        let data = '{"currency": "BTCUP"}';
        let req = GetETFInfoReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getETFInfo response test', () => {
        /**
         * getETFInfo
         * Get ETF Info
         * /api/v3/etf/info
         */
        let data =
            '{\n    "code": "200000",\n    "data": [\n        {\n            "currency": "BTCUP",\n            "netAsset": "33.846",\n            "targetLeverage": "2-4",\n            "actualLeverage": "2.1648",\n            "issuedSize": "107134.87655291",\n            "basket": "118.324559 XBTUSDTM"\n        }\n    ]\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetETFInfoResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getMarkPriceDetail request test', () => {
        /**
         * getMarkPriceDetail
         * Get Mark Price Detail
         * /api/v1/mark-price/{symbol}/current
         */
        let data = '{"symbol": "USDT-BTC"}';
        let req = GetMarkPriceDetailReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getMarkPriceDetail response test', () => {
        /**
         * getMarkPriceDetail
         * Get Mark Price Detail
         * /api/v1/mark-price/{symbol}/current
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "symbol": "USDT-BTC",\n        "timePoint": 1729676888000,\n        "value": 1.5045E-5\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetMarkPriceDetailResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getMarginConfig request test', () => {
        /**
         * getMarginConfig
         * Get Margin Config
         * /api/v1/margin/config
         */
    });

    test('getMarginConfig response test', () => {
        /**
         * getMarginConfig
         * Get Margin Config
         * /api/v1/margin/config
         */
    });
    test('getMarkPriceList request test', () => {
        /**
         * getMarkPriceList
         * Get Mark Price List
         * /api/v3/mark-price/all-symbols
         */
    });

    test('getMarkPriceList response test', () => {
        /**
         * getMarkPriceList
         * Get Mark Price List
         * /api/v3/mark-price/all-symbols
         */
    });
    test('getIsolatedMarginSymbols request test', () => {
        /**
         * getIsolatedMarginSymbols
         * Get Symbols - Isolated Margin
         * /api/v1/isolated/symbols
         */
    });

    test('getIsolatedMarginSymbols response test', () => {
        /**
         * getIsolatedMarginSymbols
         * Get Symbols - Isolated Margin
         * /api/v1/isolated/symbols
         */
    });
});
