import { GetFuturesAccountTransferOutLedgerResp } from './model_get_futures_account_transfer_out_ledger_resp';
import { FuturesAccountTransferInResp } from './model_futures_account_transfer_in_resp';
import { InnerTransferResp } from './model_inner_transfer_resp';
import { InnerTransferReq } from './model_inner_transfer_req';
import { SubAccountTransferResp } from './model_sub_account_transfer_resp';
import { FlexTransferResp } from './model_flex_transfer_resp';
import { SubAccountTransferReq } from './model_sub_account_transfer_req';
import { GetTransferQuotasResp } from './model_get_transfer_quotas_resp';
import { GetTransferQuotasReq } from './model_get_transfer_quotas_req';
import { FuturesAccountTransferOutResp } from './model_futures_account_transfer_out_resp';
import { FuturesAccountTransferOutReq } from './model_futures_account_transfer_out_req';
import { FlexTransferReq } from './model_flex_transfer_req';
import { FuturesAccountTransferInReq } from './model_futures_account_transfer_in_req';
import { GetFuturesAccountTransferOutLedgerReq } from './model_get_futures_account_transfer_out_ledger_req';
import { RestResponse } from '@model/common';

describe('Auto Test', () => {
    test('getTransferQuotas request test', () => {
        /**
         * getTransferQuotas
         * Get Transfer Quotas
         * /api/v1/accounts/transferable
         */
        let data = '{"currency": "BTC", "type": "MAIN", "tag": "ETH-USDT"}';
        let req = GetTransferQuotasReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getTransferQuotas response test', () => {
        /**
         * getTransferQuotas
         * Get Transfer Quotas
         * /api/v1/accounts/transferable
         */
        let data =
            '{"code":"200000","data":{"currency":"USDT","balance":"10.5","available":"10.5","holds":"0","transferable":"10.5"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetTransferQuotasResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('flexTransfer request test', () => {
        /**
         * flexTransfer
         * Flex Transfer
         * /api/v3/accounts/universal-transfer
         */
        let data =
            '{"clientOid": "64ccc0f164781800010d8c09", "type": "PARENT_TO_SUB", "currency": "USDT", "amount": "0.01", "fromAccountType": "TRADE", "toUserId": "63743f07e0c5230001761d08", "toAccountType": "TRADE"}';
        let req = FlexTransferReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('flexTransfer response test', () => {
        /**
         * flexTransfer
         * Flex Transfer
         * /api/v3/accounts/universal-transfer
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "orderId": "6705f7248c6954000733ecac"\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = FlexTransferResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('subAccountTransfer request test', () => {
        /**
         * subAccountTransfer
         * Sub-account Transfer
         * /api/v2/accounts/sub-transfer
         */
        let data =
            '{"clientOid": "64ccc0f164781800010d8c09", "currency": "USDT", "amount": "0.01", "direction": "OUT", "accountType": "MAIN", "subAccountType": "MAIN", "subUserId": "63743f07e0c5230001761d08"}';
        let req = SubAccountTransferReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('subAccountTransfer response test', () => {
        /**
         * subAccountTransfer
         * Sub-account Transfer
         * /api/v2/accounts/sub-transfer
         */
        let data = '{"code":"200000","data":{"orderId":"670be6b0b1b9080007040a9b"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = SubAccountTransferResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('innerTransfer request test', () => {
        /**
         * innerTransfer
         * Internal Transfer
         * /api/v2/accounts/inner-transfer
         */
        let data =
            '{"clientOid": "64ccc0f164781800010d8c09", "currency": "USDT", "amount": "0.01", "from": "main", "to": "trade"}';
        let req = InnerTransferReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('innerTransfer response test', () => {
        /**
         * innerTransfer
         * Internal Transfer
         * /api/v2/accounts/inner-transfer
         */
        let data = '{"code":"200000","data":{"orderId":"670beb3482a1bb0007dec644"}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = InnerTransferResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('getFuturesAccountTransferOutLedger request test', () => {
        /**
         * getFuturesAccountTransferOutLedger
         * Get Futures Account Transfer Out Ledger
         * /api/v1/transfer-list
         */
        let data =
            '{"currency": "XBT", "type": "MAIN", "tag": ["mock_a", "mock_b"], "startAt": 1728663338000, "endAt": 1728692138000, "currentPage": 1, "pageSize": 50}';
        let req = GetFuturesAccountTransferOutLedgerReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('getFuturesAccountTransferOutLedger response test', () => {
        /**
         * getFuturesAccountTransferOutLedger
         * Get Futures Account Transfer Out Ledger
         * /api/v1/transfer-list
         */
        let data =
            '{"code":"200000","data":{"currentPage":1,"pageSize":50,"totalNum":1,"totalPage":1,"items":[{"applyId":"670bf84c577f6c00017a1c48","currency":"USDT","recRemark":"","recSystem":"KUCOIN","status":"SUCCESS","amount":"0.01","reason":"","offset":1519769124134806,"createdAt":1728837708000,"remark":""}]}}';
        let commonResp = RestResponse.fromJson(data);
        let resp = GetFuturesAccountTransferOutLedgerResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('futuresAccountTransferOut request test', () => {
        /**
         * futuresAccountTransferOut
         * Futures Account Transfer Out
         * /api/v3/transfer-out
         */
        let data = '{"currency": "USDT", "amount": 0.01, "recAccountType": "MAIN"}';
        let req = FuturesAccountTransferOutReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('futuresAccountTransferOut response test', () => {
        /**
         * futuresAccountTransferOut
         * Futures Account Transfer Out
         * /api/v3/transfer-out
         */
        let data =
            '{\n    "code": "200000",\n    "data": {\n        "applyId": "670bf84c577f6c00017a1c48",\n        "bizNo": "670bf84c577f6c00017a1c47",\n        "payAccountType": "CONTRACT",\n        "payTag": "DEFAULT",\n        "remark": "",\n        "recAccountType": "MAIN",\n        "recTag": "DEFAULT",\n        "recRemark": "",\n        "recSystem": "KUCOIN",\n        "status": "PROCESSING",\n        "currency": "USDT",\n        "amount": "0.01",\n        "fee": "0",\n        "sn": 1519769124134806,\n        "reason": "",\n        "createdAt": 1728837708000,\n        "updatedAt": 1728837708000\n    }\n}';
        let commonResp = RestResponse.fromJson(data);
        let resp = FuturesAccountTransferOutResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
    test('futuresAccountTransferIn request test', () => {
        /**
         * futuresAccountTransferIn
         * Futures Account Transfer In
         * /api/v1/transfer-in
         */
        let data = '{"currency": "USDT", "amount": 0.01, "payAccountType": "MAIN"}';
        let req = FuturesAccountTransferInReq.fromJson(data);
        expect(Object.values(req).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(req);
    });

    test('futuresAccountTransferIn response test', () => {
        /**
         * futuresAccountTransferIn
         * Futures Account Transfer In
         * /api/v1/transfer-in
         */
        let data = '{"code":"200000","data":null}';
        let commonResp = RestResponse.fromJson(data);
        let resp = FuturesAccountTransferInResp.fromObject(commonResp.data);
        if (commonResp.data !== null) {
            expect(
                Object.values(resp).every((value) => value === null || value === undefined),
            ).toBe(false);
            console.log(resp);
        }
    });
});
