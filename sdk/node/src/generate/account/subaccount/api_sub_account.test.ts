import { GetSpotSubAccountListV2Resp } from './model_get_spot_sub_account_list_v2_resp';
import { AddSubAccountApiResp } from './model_add_sub_account_api_resp';
import { AddSubAccountApiReq } from './model_add_sub_account_api_req';
import { ModifySubAccountApiResp } from './model_modify_sub_account_api_resp';
import { AddSubAccountReq } from './model_add_sub_account_req';
import { GetSubAccountApiListResp } from './model_get_sub_account_api_list_resp';
import { AddSubAccountMarginPermissionReq } from './model_add_sub_account_margin_permission_req';
import { GetSpotSubAccountDetailResp } from './model_get_spot_sub_account_detail_resp';
import { DeleteSubAccountApiReq } from './model_delete_sub_account_api_req';
import { GetSpotSubAccountListV1Resp } from './model_get_spot_sub_account_list_v1_resp';
import { GetSpotSubAccountListV2Req } from './model_get_spot_sub_account_list_v2_req';
import { GetFuturesSubAccountListV2Req } from './model_get_futures_sub_account_list_v2_req';
import { GetFuturesSubAccountListV2Resp } from './model_get_futures_sub_account_list_v2_resp';
import { AddSubAccountFuturesPermissionReq } from './model_add_sub_account_futures_permission_req';
import { AddSubAccountMarginPermissionResp } from './model_add_sub_account_margin_permission_resp';
import { GetSpotSubAccountsSummaryV1Resp } from './model_get_spot_sub_accounts_summary_v1_resp';
import { GetSpotSubAccountsSummaryV2Req } from './model_get_spot_sub_accounts_summary_v2_req';
import { AddSubAccountFuturesPermissionResp } from './model_add_sub_account_futures_permission_resp';
import { AddSubAccountResp } from './model_add_sub_account_resp';
import { DeleteSubAccountApiResp } from './model_delete_sub_account_api_resp';
import { GetSubAccountApiListReq } from './model_get_sub_account_api_list_req';
import { ModifySubAccountApiReq } from './model_modify_sub_account_api_req';
import { GetSpotSubAccountDetailReq } from './model_get_spot_sub_account_detail_req';
import { GetSpotSubAccountsSummaryV2Resp } from './model_get_spot_sub_accounts_summary_v2_resp';
import { RestResponse } from '@model/common';

describe('Auto Test', () => {
    test('addSubAccount request test', () => {
        /**
         * addSubAccount
         * Add sub-account
         * /api/v2/sub/user/created
         */
        let data =
            '{"password": "1234567", "remarks": "TheRemark", "subName": "Name1234567", "access": "Spot"}';
        let req = AddSubAccountReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addSubAccount response test', () => {
        /**
         * addSubAccount
         * Add sub-account
         * /api/v2/sub/user/created
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "currentPage": 1,\n        "pageSize": 10,\n        "totalNum": 1,\n        "totalPage": 1,\n        "items": [\n            {\n                "userId": "63743f07e0c5230001761d08",\n                "uid": 169579801,\n                "subName": "testapi6",\n                "status": 2,\n                "type": 0,\n                "access": "All",\n                "createdAt": 1668562696000,\n                "remarks": "remarks",\n                "tradeTypes": [\n                    "Spot",\n                    "Futures",\n                    "Margin"\n                ],\n                "openedTradeTypes": [\n                    "Spot"\n                ],\n                "hostedStatus": null\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddSubAccountResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addSubAccountMarginPermission request test', () => {
        /**
         * addSubAccountMarginPermission
         * Add sub-account Margin Permission
         * /api/v3/sub/user/margin/enable
         */
        let data = '{"uid": "169579801"}';
        let req = AddSubAccountMarginPermissionReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addSubAccountMarginPermission response test', () => {
        /**
         * addSubAccountMarginPermission
         * Add sub-account Margin Permission
         * /api/v3/sub/user/margin/enable
         */
        let data = '{\n    "code": "200000",\n    "data": null\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddSubAccountMarginPermissionResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addSubAccountFuturesPermission request test', () => {
        /**
         * addSubAccountFuturesPermission
         * Add sub-account Futures Permission
         * /api/v3/sub/user/futures/enable
         */
        let data = '{"uid": "169579801"}';
        let req = AddSubAccountFuturesPermissionReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addSubAccountFuturesPermission response test', () => {
        /**
         * addSubAccountFuturesPermission
         * Add sub-account Futures Permission
         * /api/v3/sub/user/futures/enable
         */
        let data = '{\n    "code": "200000",\n    "data": null\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddSubAccountFuturesPermissionResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSpotSubAccountsSummaryV2 request test', () => {
        /**
         * getSpotSubAccountsSummaryV2
         * Get sub-account List - Summary Info
         * /api/v2/sub/user
         */
        let data = '{"currentPage": 1, "pageSize": 10}';
        let req = GetSpotSubAccountsSummaryV2Req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSpotSubAccountsSummaryV2 response test', () => {
        /**
         * getSpotSubAccountsSummaryV2
         * Get sub-account List - Summary Info
         * /api/v2/sub/user
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "currentPage": 1,\n        "pageSize": 10,\n        "totalNum": 1,\n        "totalPage": 1,\n        "items": [\n            {\n                "userId": "63743f07e0c5230001761d08",\n                "uid": 169579801,\n                "subName": "testapi6",\n                "status": 2,\n                "type": 0,\n                "access": "All",\n                "createdAt": 1668562696000,\n                "remarks": "remarks",\n                "tradeTypes": [\n                    "Spot",\n                    "Futures",\n                    "Margin"\n                ],\n                "openedTradeTypes": [\n                    "Spot"\n                ],\n                "hostedStatus": null\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetSpotSubAccountsSummaryV2Resp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSpotSubAccountDetail request test', () => {
        /**
         * getSpotSubAccountDetail
         * Get sub-account Detail - Balance
         * /api/v1/sub-accounts/{subUserId}
         */
        let data =
            '{"subUserId": "63743f07e0c5230001761d08", "includeBaseAmount": true, "baseCurrency": "example_string_default_value", "baseAmount": "example_string_default_value"}';
        let req = GetSpotSubAccountDetailReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSpotSubAccountDetail response test', () => {
        /**
         * getSpotSubAccountDetail
         * Get sub-account Detail - Balance
         * /api/v1/sub-accounts/{subUserId}
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "subUserId": "63743f07e0c5230001761d08",\n        "subName": "testapi6",\n        "mainAccounts": [\n            {\n                "currency": "USDT",\n                "balance": "0.01",\n                "available": "0.01",\n                "holds": "0",\n                "baseCurrency": "BTC",\n                "baseCurrencyPrice": "62384.3",\n                "baseAmount": "0.00000016",\n                "tag": "DEFAULT"\n            }\n        ],\n        "tradeAccounts": [\n            {\n                "currency": "USDT",\n                "balance": "0.01",\n                "available": "0.01",\n                "holds": "0",\n                "baseCurrency": "BTC",\n                "baseCurrencyPrice": "62384.3",\n                "baseAmount": "0.00000016",\n                "tag": "DEFAULT"\n            }\n        ],\n        "marginAccounts": [\n            {\n                "currency": "USDT",\n                "balance": "0.01",\n                "available": "0.01",\n                "holds": "0",\n                "baseCurrency": "BTC",\n                "baseCurrencyPrice": "62384.3",\n                "baseAmount": "0.00000016",\n                "tag": "DEFAULT"\n            }\n        ],\n        "tradeHFAccounts": []\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetSpotSubAccountDetailResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSpotSubAccountListV2 request test', () => {
        /**
         * getSpotSubAccountListV2
         * Get sub-account List - Spot Balance (V2)
         * /api/v2/sub-accounts
         */
        let data = '{"currentPage": 1, "pageSize": 10}';
        let req = GetSpotSubAccountListV2Req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSpotSubAccountListV2 response test', () => {
        /**
         * getSpotSubAccountListV2
         * Get sub-account List - Spot Balance (V2)
         * /api/v2/sub-accounts
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "currentPage": 1,\n        "pageSize": 10,\n        "totalNum": 3,\n        "totalPage": 1,\n        "items": [\n            {\n                "subUserId": "63743f07e0c5230001761d08",\n                "subName": "testapi6",\n                "mainAccounts": [\n                    {\n                        "currency": "USDT",\n                        "balance": "0.01",\n                        "available": "0.01",\n                        "holds": "0",\n                        "baseCurrency": "BTC",\n                        "baseCurrencyPrice": "62514.5",\n                        "baseAmount": "0.00000015",\n                        "tag": "DEFAULT"\n                    }\n                ],\n                "tradeAccounts": [\n                    {\n                        "currency": "USDT",\n                        "balance": "0.01",\n                        "available": "0.01",\n                        "holds": "0",\n                        "baseCurrency": "BTC",\n                        "baseCurrencyPrice": "62514.5",\n                        "baseAmount": "0.00000015",\n                        "tag": "DEFAULT"\n                    }\n                ],\n                "marginAccounts": [\n                    {\n                        "currency": "USDT",\n                        "balance": "0.01",\n                        "available": "0.01",\n                        "holds": "0",\n                        "baseCurrency": "BTC",\n                        "baseCurrencyPrice": "62514.5",\n                        "baseAmount": "0.00000015",\n                        "tag": "DEFAULT"\n                    }\n                ],\n                "tradeHFAccounts": []\n            },\n            {\n                "subUserId": "670538a31037eb000115b076",\n                "subName": "Name1234567",\n                "mainAccounts": [],\n                "tradeAccounts": [],\n                "marginAccounts": [],\n                "tradeHFAccounts": []\n            },\n            {\n                "subUserId": "66b0c0905fc1480001c14c36",\n                "subName": "LTkucoin1491",\n                "mainAccounts": [],\n                "tradeAccounts": [],\n                "marginAccounts": [],\n                "tradeHFAccounts": []\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetSpotSubAccountListV2Resp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getFuturesSubAccountListV2 request test', () => {
        /**
         * getFuturesSubAccountListV2
         * Get sub-account List - Futures Balance (V2)
         * /api/v1/account-overview-all
         */
        let data = '{"currency": "USDT"}';
        let req = GetFuturesSubAccountListV2Req.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getFuturesSubAccountListV2 response test', () => {
        /**
         * getFuturesSubAccountListV2
         * Get sub-account List - Futures Balance (V2)
         * /api/v1/account-overview-all
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "summary": {\n            "accountEquityTotal": 103.899081508,\n            "unrealisedPNLTotal": 38.81075,\n            "marginBalanceTotal": 65.336985668,\n            "positionMarginTotal": 68.9588320683,\n            "orderMarginTotal": 0,\n            "frozenFundsTotal": 0,\n            "availableBalanceTotal": 67.2492494397,\n            "currency": "USDT"\n        },\n        "accounts": [\n            {\n                "accountName": "Name1234567",\n                "accountEquity": 0,\n                "unrealisedPNL": 0,\n                "marginBalance": 0,\n                "positionMargin": 0,\n                "orderMargin": 0,\n                "frozenFunds": 0,\n                "availableBalance": 0,\n                "currency": "USDT"\n            },\n            {\n                "accountName": "LTkucoin1491",\n                "accountEquity": 0,\n                "unrealisedPNL": 0,\n                "marginBalance": 0,\n                "positionMargin": 0,\n                "orderMargin": 0,\n                "frozenFunds": 0,\n                "availableBalance": 0,\n                "currency": "USDT"\n            },\n            {\n                "accountName": "manage112233",\n                "accountEquity": 0,\n                "unrealisedPNL": 0,\n                "marginBalance": 0,\n                "positionMargin": 0,\n                "orderMargin": 0,\n                "frozenFunds": 0,\n                "availableBalance": 0,\n                "currency": "USDT"\n            },\n            {\n                "accountName": "testapi6",\n                "accountEquity": 27.30545128,\n                "unrealisedPNL": 22.549,\n                "marginBalance": 4.75645128,\n                "positionMargin": 24.1223749975,\n                "orderMargin": 0,\n                "frozenFunds": 0,\n                "availableBalance": 25.7320762825,\n                "currency": "USDT"\n            },\n            {\n                "accountName": "main",\n                "accountEquity": 76.593630228,\n                "unrealisedPNL": 16.26175,\n                "marginBalance": 60.580534388,\n                "positionMargin": 44.8364570708,\n                "orderMargin": 0,\n                "frozenFunds": 0,\n                "availableBalance": 41.5171731572,\n                "currency": "USDT"\n            }\n        ]\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetFuturesSubAccountListV2Resp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('addSubAccountApi request test', () => {
        /**
         * addSubAccountApi
         * Add sub-account API
         * /api/v1/sub/api-key
         */
        let data =
            '{"subName": "testapi6", "passphrase": "11223344", "remark": "TheRemark", "permission": "General,Spot,Futures"}';
        let req = AddSubAccountApiReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('addSubAccountApi response test', () => {
        /**
         * addSubAccountApi
         * Add sub-account API
         * /api/v1/sub/api-key
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "subName": "testapi6",\n        "remark": "TheRemark",\n        "apiKey": "670621e3a25958000159c82f",\n        "apiSecret": "46fd8974******896f005b2340",\n        "apiVersion": 3,\n        "passphrase": "11223344",\n        "permission": "General,Futures",\n        "createdAt": 1728455139000\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = AddSubAccountApiResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('modifySubAccountApi request test', () => {
        /**
         * modifySubAccountApi
         * Modify sub-account API
         * /api/v1/sub/api-key/update
         */
        let data =
            '{"subName": "testapi6", "apiKey": "670621e3a25958000159c82f", "passphrase": "11223344", "permission": "General,Spot,Futures"}';
        let req = ModifySubAccountApiReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('modifySubAccountApi response test', () => {
        /**
         * modifySubAccountApi
         * Modify sub-account API
         * /api/v1/sub/api-key/update
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "subName": "testapi6",\n        "apiKey": "670621e3a25958000159c82f",\n        "permission": "General,Futures,Spot"\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = ModifySubAccountApiResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSubAccountApiList request test', () => {
        /**
         * getSubAccountApiList
         * Get sub-account API List
         * /api/v1/sub/api-key
         */
        let data = '{"apiKey": "example_string_default_value", "subName": "testapi6"}';
        let req = GetSubAccountApiListReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getSubAccountApiList response test', () => {
        /**
         * getSubAccountApiList
         * Get sub-account API List
         * /api/v1/sub/api-key
         */
        let data =
            '{\n    "code": "200000",\n    "data": [\n        {\n            "subName": "apiSdkTest",\n            "remark": "sdk_test_integration",\n            "apiKey": "673eab2a955ebf000195d7e4",\n            "apiVersion": 3,\n            "permission": "General",\n            "ipWhitelist": "10.**.1",\n            "createdAt": 1732160298000,\n            "uid": 215112467,\n            "isMaster": false\n        }\n    ]\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetSubAccountApiListResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('deleteSubAccountApi request test', () => {
        /**
         * deleteSubAccountApi
         * Delete sub-account API
         * /api/v1/sub/api-key
         */
        let data =
            '{"apiKey": "670621e3a25958000159c82f", "subName": "testapi6", "passphrase": "11223344"}';
        let req = DeleteSubAccountApiReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('deleteSubAccountApi response test', () => {
        /**
         * deleteSubAccountApi
         * Delete sub-account API
         * /api/v1/sub/api-key
         */
        let data =
            '{"code":"200000","data":{"subName":"testapi6","apiKey":"670621e3a25958000159c82f"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = DeleteSubAccountApiResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getSpotSubAccountsSummaryV1 request test', () => {
        /**
         * getSpotSubAccountsSummaryV1
         * Get sub-account List - Summary Info (V1)
         * /api/v1/sub/user
         */
    });

    test('getSpotSubAccountsSummaryV1 response test', () => {
        /**
         * getSpotSubAccountsSummaryV1
         * Get sub-account List - Summary Info (V1)
         * /api/v1/sub/user
         */
    });
    test('getSpotSubAccountListV1 request test', () => {
        /**
         * getSpotSubAccountListV1
         * Get sub-account List - Spot Balance (V1)
         * /api/v1/sub-accounts
         */
    });

    test('getSpotSubAccountListV1 response test', () => {
        /**
         * getSpotSubAccountListV1
         * Get sub-account List - Spot Balance (V1)
         * /api/v1/sub-accounts
         */
    });
});
