import { OrderV2Event } from './model_order_v2_event';
import { StopOrderEvent } from './model_stop_order_event';
import { AccountEvent } from './model_account_event';
import { OrderV1Event } from './model_order_v1_event';
import { WsMessage } from '@model/common';

describe('Auto Test', () => {
    test('account response test', () => {
        /**
         * account
         * Get Account Balance
         * /account/account/balance
         */
        let data =
            '{"topic":"/account/balance","type":"message","subject":"account.balance","id":"354689988084000","userId":"633559791e1cbc0001f319bc","channelType":"private","data":{"accountId":"548674591753","currency":"USDT","total":"21.133773386762","available":"20.132773386762","hold":"1.001","availableChange":"-0.5005","holdChange":"0.5005","relationContext":{"symbol":"BTC-USDT","orderId":"6721d0632db25b0007071fdc"},"relationEvent":"trade.hold","relationEventId":"354689988084000","time":"1730269283892"}}';
        let commonResp = WsMessage.fromJson(data);
        let resp = AccountEvent.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('orderV1 response test', () => {
        /**
         * orderV1
         * Get Order(V1)
         * /orderV1/spotMarket/tradeOrders
         */
        let data =
            '{"topic":"/spotMarket/tradeOrdersV2","type":"message","subject":"orderChange","userId":"633559791e1cbc0001f319bc","channelType":"private","data":{"canceledSize":"0","clientOid":"5c52e11203aa677f33e493fb","filledSize":"0","orderId":"6720ecd9ec71f4000747731a","orderTime":1730211033305,"orderType":"limit","originSize":"0.00001","price":"50000","remainSize":"0.00001","side":"buy","size":"0.00001","status":"open","symbol":"BTC-USDT","ts":1730211033335000000,"type":"open"}}';
        let commonResp = WsMessage.fromJson(data);
        let resp = OrderV1Event.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('orderV2 response test', () => {
        /**
         * orderV2
         * Get Order(V2)
         * /orderV2/spotMarket/tradeOrdersV2
         */
        let data =
            '{"topic":"/spotMarket/tradeOrdersV2","type":"message","subject":"orderChange","userId":"633559791e1cbc0001f319bc","channelType":"private","data":{"clientOid":"5c52e11203aa677f33e493fc","orderId":"6720da3fa30a360007f5f832","orderTime":1730206271588,"orderType":"market","originSize":"0.00001","side":"buy","status":"new","symbol":"BTC-USDT","ts":1730206271616000000,"type":"received"}}';
        let commonResp = WsMessage.fromJson(data);
        let resp = OrderV2Event.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
    test('stopOrder response test', () => {
        /**
         * stopOrder
         * Get Stop Order
         * /stopOrder/spotMarket/advancedOrders
         */
        let data =
            '{"topic":"/spotMarket/advancedOrders","type":"message","subject":"stopOrder","userId":"633559791e1cbc0001f319bc","channelType":"private","data":{"orderId":"vs93gpupfa48anof003u85mb","orderPrice":"70000","orderType":"stop","side":"buy","size":"0.00007142","stop":"loss","stopPrice":"71000","symbol":"BTC-USDT","tradeType":"TRADE","type":"open","createdAt":1742305928064,"ts":1742305928091268493}}';
        let commonResp = WsMessage.fromJson(data);
        let resp = StopOrderEvent.fromObject(commonResp.data);
        expect(Object.values(resp).every((value) => value === null || value === undefined)).toBe(
            false,
        );
        console.log(resp);
    });
});
