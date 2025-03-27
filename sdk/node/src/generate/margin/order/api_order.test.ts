import { GetOrderByOrderIdResp } from './model_get_order_by_order_id_resp';
import { GetTradeHistoryResp } from './model_get_trade_history_resp';
import { GetOrderByClientOidResp } from './model_get_order_by_client_oid_resp';
import { CancelOrderByClientOidReq } from './model_cancel_order_by_client_oid_req';
import { GetClosedOrdersResp } from './model_get_closed_orders_resp';
import { AddOrderV1Req } from './model_add_order_v1_req';
import { AddOrderReq } from './model_add_order_req';
import { GetOpenOrdersResp } from './model_get_open_orders_resp';
import { GetClosedOrdersReq } from './model_get_closed_orders_req';
import { CancelOrderByOrderIdReq } from './model_cancel_order_by_order_id_req';
import { CancelAllOrdersBySymbolResp } from './model_cancel_all_orders_by_symbol_resp';
import { GetSymbolsWithOpenOrderReq } from './model_get_symbols_with_open_order_req';
import { GetOpenOrdersReq } from './model_get_open_orders_req';
import { AddOrderTestV1Req } from './model_add_order_test_v1_req';
import { GetTradeHistoryReq } from './model_get_trade_history_req';
import { CancelAllOrdersBySymbolReq } from './model_cancel_all_orders_by_symbol_req';
import { AddOrderTestReq } from './model_add_order_test_req';
import { AddOrderTestV1Resp } from './model_add_order_test_v1_resp';
import { AddOrderV1Resp } from './model_add_order_v1_resp';
import { CancelOrderByClientOidResp } from './model_cancel_order_by_client_oid_resp';
import { CancelOrderByOrderIdResp } from './model_cancel_order_by_order_id_resp';
import { AddOrderTestResp } from './model_add_order_test_resp';
import { GetOrderByClientOidReq } from './model_get_order_by_client_oid_req';
import { AddOrderResp } from './model_add_order_resp';
import { GetOrderByOrderIdReq } from './model_get_order_by_order_id_req';
import { GetSymbolsWithOpenOrderResp } from './model_get_symbols_with_open_order_resp';
import { RestResponse } from '@model/common';

describe('Auto Test', () => {
    test('addOrder request test', () => {
        /**
         * addOrder
         * Add Order
         * /api/v3/hf/margin/order
         */
        let data =
            '{"type": "limit", "symbol": "BTC-USDT", "side": "buy", "price": "50000", "size": "0.00001", "clientOid": "5c52e11203aa677f33e493fb", "remark": "order remarks"}';
        let req = AddOrderReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addOrder response test', () => {
        /**
         * addOrder
         * Add Order
         * /api/v3/hf/margin/order
         */
        let data =
            '{\n    "success": true,\n    "code": "200000",\n    "data": {\n        "orderId": "671663e02188630007e21c9c",\n        "clientOid": "5c52e11203aa677f33e1493fb",\n        "borrowSize": "10.2",\n        "loanApplyId": "600656d9a33ac90009de4f6f"\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddOrderResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addOrderTest request test', () => {
        /**
         * addOrderTest
         * Add Order Test
         * /api/v3/hf/margin/order/test
         */
        let data =
            '{"type": "limit", "symbol": "BTC-USDT", "side": "buy", "price": "50000", "size": "0.00001", "clientOid": "5c52e11203aa677f33e493fb", "remark": "order remarks"}';
        let req = AddOrderTestReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addOrderTest response test', () => {
        /**
         * addOrderTest
         * Add Order Test
         * /api/v3/hf/margin/order/test
         */
        let data =
            '{\n    "success": true,\n    "code": "200000",\n    "data": {\n        "orderId": "5bd6e9286d99522a52e458de",\n        "clientOid": "5c52e11203aa677f33e493fb",\n        "borrowSize": 10.2,\n        "loanApplyId": "600656d9a33ac90009de4f6f"\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddOrderTestResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('cancelOrderByOrderId request test', () => {
        /**
         * cancelOrderByOrderId
         * Cancel Order By OrderId
         * /api/v3/hf/margin/orders/{orderId}
         */
        let data = '{"orderId": "671663e02188630007e21c9c", "symbol": "BTC-USDT"}';
        let req = CancelOrderByOrderIdReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('cancelOrderByOrderId response test', () => {
        /**
         * cancelOrderByOrderId
         * Cancel Order By OrderId
         * /api/v3/hf/margin/orders/{orderId}
         */
        let data = '{"code":"200000","data":{"orderId":"671663e02188630007e21c9c"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = CancelOrderByOrderIdResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('cancelOrderByClientOid request test', () => {
        /**
         * cancelOrderByClientOid
         * Cancel Order By ClientOid
         * /api/v3/hf/margin/orders/client-order/{clientOid}
         */
        let data = '{"clientOid": "5c52e11203aa677f33e1493fb", "symbol": "BTC-USDT"}';
        let req = CancelOrderByClientOidReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('cancelOrderByClientOid response test', () => {
        /**
         * cancelOrderByClientOid
         * Cancel Order By ClientOid
         * /api/v3/hf/margin/orders/client-order/{clientOid}
         */
        let data = '{"code":"200000","data":{"clientOid":"5c52e11203aa677f33e1493fb"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = CancelOrderByClientOidResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('cancelAllOrdersBySymbol request test', () => {
        /**
         * cancelAllOrdersBySymbol
         * Cancel All Orders By Symbol
         * /api/v3/hf/margin/orders
         */
        let data = '{"symbol": "BTC-USDT", "tradeType": "MARGIN_TRADE"}';
        let req = CancelAllOrdersBySymbolReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('cancelAllOrdersBySymbol response test', () => {
        /**
         * cancelAllOrdersBySymbol
         * Cancel All Orders By Symbol
         * /api/v3/hf/margin/orders
         */
        let data = '{"code":"200000","data":"success"}';
        let commonResp = RestResponse.fromJson(data);
        let resp = CancelAllOrdersBySymbolResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSymbolsWithOpenOrder request test', () => {
        /**
         * getSymbolsWithOpenOrder
         * Get Symbols With Open Order
         * /api/v3/hf/margin/order/active/symbols
         */
        let data = '{"tradeType": "MARGIN_TRADE"}';
        let req = GetSymbolsWithOpenOrderReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSymbolsWithOpenOrder response test', () => {
        /**
         * getSymbolsWithOpenOrder
         * Get Symbols With Open Order
         * /api/v3/hf/margin/order/active/symbols
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "symbolSize": 1,\n        "symbols": [\n            "BTC-USDT"\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetSymbolsWithOpenOrderResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getOpenOrders request test', () => {
        /**
         * getOpenOrders
         * Get Open Orders
         * /api/v3/hf/margin/orders/active
         */
        let data = '{"symbol": "BTC-USDT", "tradeType": "MARGIN_TRADE"}';
        let req = GetOpenOrdersReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getOpenOrders response test', () => {
        /**
         * getOpenOrders
         * Get Open Orders
         * /api/v3/hf/margin/orders/active
         */
        let data =
            '{\n    "code": "200000",\n    "data": [\n        {\n            "id": "671667306afcdb000723107f",\n            "clientOid": "5c52e11203aa677f33e493fb",\n            "symbol": "BTC-USDT",\n            "opType": "DEAL",\n            "type": "limit",\n            "side": "buy",\n            "price": "50000",\n            "size": "0.00001",\n            "funds": "0.5",\n            "dealSize": "0",\n            "dealFunds": "0",\n            "remainSize": "0.00001",\n            "remainFunds": "0.5",\n            "cancelledSize": "0",\n            "cancelledFunds": "0",\n            "fee": "0",\n            "feeCurrency": "USDT",\n            "stp": null,\n            "stop": null,\n            "stopTriggered": false,\n            "stopPrice": "0",\n            "timeInForce": "GTC",\n            "postOnly": false,\n            "hidden": false,\n            "iceberg": false,\n            "visibleSize": "0",\n            "cancelAfter": 0,\n            "channel": "API",\n            "remark": null,\n            "tags": null,\n            "cancelExist": false,\n            "tradeType": "MARGIN_TRADE",\n            "inOrderBook": true,\n            "active": true,\n            "tax": "0",\n            "createdAt": 1729521456248,\n            "lastUpdatedAt": 1729521460940\n        }\n    ]\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetOpenOrdersResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getClosedOrders request test', () => {
        /**
         * getClosedOrders
         * Get Closed Orders
         * /api/v3/hf/margin/orders/done
         */
        let data =
            '{"symbol": "BTC-USDT", "tradeType": "MARGIN_TRADE", "side": "buy", "type": "limit", "lastId": 254062248624417, "limit": 20, "startAt": 1728663338000, "endAt": 1728692138000}';
        let req = GetClosedOrdersReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getClosedOrders response test', () => {
        /**
         * getClosedOrders
         * Get Closed Orders
         * /api/v3/hf/margin/orders/done
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "lastId": 136112949351,\n        "items": [\n            {\n                "id": "6716491f6afcdb00078365c8",\n                "clientOid": "5c52e11203aa677f33e493fb",\n                "symbol": "BTC-USDT",\n                "opType": "DEAL",\n                "type": "limit",\n                "side": "buy",\n                "price": "50000",\n                "size": "0.00001",\n                "funds": "0.5",\n                "dealSize": "0",\n                "dealFunds": "0",\n                "remainSize": "0",\n                "remainFunds": "0",\n                "cancelledSize": "0.00001",\n                "cancelledFunds": "0.5",\n                "fee": "0",\n                "feeCurrency": "USDT",\n                "stp": null,\n                "stop": null,\n                "stopTriggered": false,\n                "stopPrice": "0",\n                "timeInForce": "GTC",\n                "postOnly": false,\n                "hidden": false,\n                "iceberg": false,\n                "visibleSize": "0",\n                "cancelAfter": 0,\n                "channel": "API",\n                "remark": null,\n                "tags": null,\n                "cancelExist": true,\n                "tradeType": "MARGIN_TRADE",\n                "inOrderBook": false,\n                "active": false,\n                "tax": "0",\n                "createdAt": 1729513759162,\n                "lastUpdatedAt": 1729521126597\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetClosedOrdersResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getTradeHistory request test', () => {
        /**
         * getTradeHistory
         * Get Trade History
         * /api/v3/hf/margin/fills
         */
        let data =
            '{"symbol": "BTC-USDT", "tradeType": "MARGIN_TRADE", "orderId": "example_string_default_value", "side": "buy", "type": "limit", "lastId": 254062248624417, "limit": 100, "startAt": 1728663338000, "endAt": 1728692138000}';
        let req = GetTradeHistoryReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getTradeHistory response test', () => {
        /**
         * getTradeHistory
         * Get Trade History
         * /api/v3/hf/margin/fills
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "items": [\n            {\n                "id": 137891621991,\n                "symbol": "BTC-USDT",\n                "tradeId": 11040911994273793,\n                "orderId": "671868085584bc0007d85f46",\n                "counterOrderId": "67186805b7cbdf00071621f9",\n                "side": "buy",\n                "liquidity": "taker",\n                "forceTaker": false,\n                "price": "67141.6",\n                "size": "0.00001",\n                "funds": "0.671416",\n                "fee": "0.000671416",\n                "feeRate": "0.001",\n                "feeCurrency": "USDT",\n                "stop": "",\n                "tradeType": "MARGIN_TRADE",\n                "tax": "0",\n                "taxRate": "0",\n                "type": "limit",\n                "createdAt": 1729652744998\n            }\n        ],\n        "lastId": 137891621991\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetTradeHistoryResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getOrderByOrderId request test', () => {
        /**
         * getOrderByOrderId
         * Get Order By OrderId
         * /api/v3/hf/margin/orders/{orderId}
         */
        let data = '{"orderId": "671667306afcdb000723107f", "symbol": "BTC-USDT"}';
        let req = GetOrderByOrderIdReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getOrderByOrderId response test', () => {
        /**
         * getOrderByOrderId
         * Get Order By OrderId
         * /api/v3/hf/margin/orders/{orderId}
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "id": "671667306afcdb000723107f",\n        "symbol": "BTC-USDT",\n        "opType": "DEAL",\n        "type": "limit",\n        "side": "buy",\n        "price": "50000",\n        "size": "0.00001",\n        "funds": "0.5",\n        "dealSize": "0",\n        "dealFunds": "0",\n        "fee": "0",\n        "feeCurrency": "USDT",\n        "stp": null,\n        "stop": null,\n        "stopTriggered": false,\n        "stopPrice": "0",\n        "timeInForce": "GTC",\n        "postOnly": false,\n        "hidden": false,\n        "iceberg": false,\n        "visibleSize": "0",\n        "cancelAfter": 0,\n        "channel": "API",\n        "clientOid": "5c52e11203aa677f33e493fb",\n        "remark": null,\n        "tags": null,\n        "cancelExist": false,\n        "createdAt": 1729521456248,\n        "lastUpdatedAt": 1729651011877,\n        "tradeType": "MARGIN_TRADE",\n        "inOrderBook": true,\n        "cancelledSize": "0",\n        "cancelledFunds": "0",\n        "remainSize": "0.00001",\n        "remainFunds": "0.5",\n        "tax": "0",\n        "active": true\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetOrderByOrderIdResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getOrderByClientOid request test', () => {
        /**
         * getOrderByClientOid
         * Get Order By ClientOid
         * /api/v3/hf/margin/orders/client-order/{clientOid}
         */
        let data = '{"clientOid": "5c52e11203aa677f33e493fb", "symbol": "BTC-USDT"}';
        let req = GetOrderByClientOidReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getOrderByClientOid response test', () => {
        /**
         * getOrderByClientOid
         * Get Order By ClientOid
         * /api/v3/hf/margin/orders/client-order/{clientOid}
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "id": "671667306afcdb000723107f",\n        "symbol": "BTC-USDT",\n        "opType": "DEAL",\n        "type": "limit",\n        "side": "buy",\n        "price": "50000",\n        "size": "0.00001",\n        "funds": "0.5",\n        "dealSize": "0",\n        "dealFunds": "0",\n        "fee": "0",\n        "feeCurrency": "USDT",\n        "stp": null,\n        "stop": null,\n        "stopTriggered": false,\n        "stopPrice": "0",\n        "timeInForce": "GTC",\n        "postOnly": false,\n        "hidden": false,\n        "iceberg": false,\n        "visibleSize": "0",\n        "cancelAfter": 0,\n        "channel": "API",\n        "clientOid": "5c52e11203aa677f33e493fb",\n        "remark": null,\n        "tags": null,\n        "cancelExist": false,\n        "createdAt": 1729521456248,\n        "lastUpdatedAt": 1729651011877,\n        "tradeType": "MARGIN_TRADE",\n        "inOrderBook": true,\n        "cancelledSize": "0",\n        "cancelledFunds": "0",\n        "remainSize": "0.00001",\n        "remainFunds": "0.5",\n        "tax": "0",\n        "active": true\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetOrderByClientOidResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addOrderV1 request test', () => {
        /**
         * addOrderV1
         * Add Order - V1
         * /api/v1/margin/order
         */
        let data =
            '{"type": "limit", "symbol": "BTC-USDT", "side": "buy", "price": "50000", "size": "0.00001", "clientOid": "5c52e11203aa677f33e4193fb", "remark": "order remarks"}';
        let req = AddOrderV1Req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addOrderV1 response test', () => {
        /**
         * addOrderV1
         * Add Order - V1
         * /api/v1/margin/order
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "orderId": "671bb90194422f00073ff4f0",\n        "loanApplyId": null,\n        "borrowSize": null,\n        "clientOid": null\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddOrderV1Resp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addOrderTestV1 request test', () => {
        /**
         * addOrderTestV1
         * Add Order Test - V1
         * /api/v1/margin/order/test
         */
        let data =
            '{"type": "limit", "symbol": "BTC-USDT", "side": "buy", "price": "50000", "size": "0.00001", "clientOid": "5c52e11203aa677f33e4193fb", "remark": "order remarks"}';
        let req = AddOrderTestV1Req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addOrderTestV1 response test', () => {
        /**
         * addOrderTestV1
         * Add Order Test - V1
         * /api/v1/margin/order/test
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "orderId": "671bb90194422f00073ff4f0",\n        "loanApplyId": null,\n        "borrowSize": null,\n        "clientOid": null\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddOrderTestV1Resp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
});
