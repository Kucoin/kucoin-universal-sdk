import {
    ClientOptionBuilder,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    TransportOptionBuilder,
} from '@model/index';
import {
    AddOcoOrderReq,
    AddOrderOldReq,
    AddOrderReq,
    AddOrderSyncReq,
    AddOrderTestOldReq,
    AddOrderTestReq,
    AddStopOrderReq,
    BatchAddOrdersOldOrderList,
    BatchAddOrdersOldReq,
    BatchAddOrdersOrderList,
    BatchAddOrdersReq,
    BatchAddOrdersSyncOrderList,
    BatchAddOrdersSyncReq,
    BatchCancelOcoOrdersReq,
    BatchCancelOrderOldReq,
    BatchCancelStopOrderReq,
    CancelAllOrdersBySymbolReq,
    CancelOcoOrderByClientOidReq,
    CancelOcoOrderByOrderIdReq,
    CancelOrderByClientOidOldReq,
    CancelOrderByClientOidReq,
    CancelOrderByClientOidSyncReq,
    CancelOrderByOrderIdOldReq,
    CancelOrderByOrderIdReq,
    CancelOrderByOrderIdSyncReq,
    CancelPartialOrderReq,
    CancelStopOrderByClientOidReq,
    CancelStopOrderByOrderIdReq,
    GetClosedOrdersReq,
    GetOcoOrderByClientOidReq,
    GetOcoOrderByOrderIdReq,
    GetOcoOrderDetailByOrderIdReq,
    GetOcoOrderListReq, GetOpenOrdersByPageReq,
    GetOpenOrdersReq,
    GetOrderByClientOidOldReq,
    GetOrderByClientOidReq,
    GetOrderByOrderIdOldReq,
    GetOrderByOrderIdReq,
    GetOrdersListOldReq,
    GetStopOrderByClientOidReq,
    GetStopOrderByOrderIdReq,
    GetStopOrdersListReq,
    GetTradeHistoryOldReq,
    GetTradeHistoryReq,
    ModifyOrderReq,
    OrderAPI,
    SetDCPReq,
} from '@src/generate/spot/order';
import { DefaultClient } from '@api/index';
import { randomUUID } from 'crypto';

describe('Auto Test', () => {
    let api: OrderAPI;

    beforeAll(() => {
        const key = process.env.API_KEY || '';
        const secret = process.env.API_SECRET || '';
        const passphrase = process.env.API_PASSPHRASE || '';

        // Set specific options, others will fall back to default values
        const httpTransportOption = new TransportOptionBuilder()
            .setKeepAlive(true)
            .setMaxConnsPerHost(10)
            .setMaxIdleConns(10)
            .build();

        // Create a client using the specified options
        const clientOption = new ClientOptionBuilder()
            .setKey(key)
            .setSecret(secret)
            .setPassphrase(passphrase)
            .setSpotEndpoint(GlobalApiEndpoint)
            .setFuturesEndpoint(GlobalFuturesApiEndpoint)
            .setBrokerEndpoint(GlobalBrokerApiEndpoint)
            .setTransportOption(httpTransportOption)
            .build();

        const client = new DefaultClient(clientOption);

        // Get the Restful Service
        const kucoinRestService = client.restService();
        api = kucoinRestService.getSpotService().getOrderApi();
    });

    test('addOrder request test', () => {
        /**
         * addOrder
         * Add Order
         * /api/v1/hf/orders
         */
        let builder = AddOrderReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOrderReq.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(AddOrderReq.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001');
        let req = builder.build();
        let resp = api.addOrder(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('addOrderSync request test', () => {
        /**
         * addOrderSync
         * Add Order Sync
         * /api/v1/hf/orders/sync
         */
        let builder = AddOrderSyncReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOrderSyncReq.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(AddOrderSyncReq.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001');
        let req = builder.build();
        let resp = api.addOrderSync(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.orderTime).toEqual(expect.anything());
            expect(result.originSize).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.remainSize).toEqual(expect.anything());
            expect(result.canceledSize).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            expect(result.matchTime).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('addOrderTest request test', () => {
        /**
         * addOrderTest
         * Add Order Test
         * /api/v1/hf/orders/test
         */
        let builder = AddOrderTestReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOrderTestReq.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(AddOrderTestReq.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001');
        let req = builder.build();
        let resp = api.addOrderTest(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchAddOrders request test', () => {
        /**
         * batchAddOrders
         * Batch Add Orders
         * /api/v1/hf/orders/multi
         */
        let builder = BatchAddOrdersReq.builder();

        let order1 = BatchAddOrdersOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersOrderList.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(BatchAddOrdersOrderList.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        let order2 = BatchAddOrdersOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersOrderList.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(BatchAddOrdersOrderList.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        builder.setOrderList([order1, order2]);
        let req = builder.build();
        let resp = api.batchAddOrders(req);
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchAddOrdersSync request test', () => {
        /**
         * batchAddOrdersSync
         * Batch Add Orders Sync
         * /api/v1/hf/orders/multi/sync
         */
        let builder = BatchAddOrdersSyncReq.builder();

        let order1 = BatchAddOrdersSyncOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersSyncOrderList.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(BatchAddOrdersSyncOrderList.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        let order2 = BatchAddOrdersSyncOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersSyncOrderList.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(BatchAddOrdersSyncOrderList.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        builder.setOrderList([order1, order2]);
        let req = builder.build();
        let resp = api.batchAddOrdersSync(req);
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByOrderId request test', () => {
        /**
         * cancelOrderByOrderId
         * Cancel Order By OrderId
         * /api/v1/hf/orders/{orderId}
         */
        let builder = CancelOrderByOrderIdReq.builder();
        builder.setOrderId('67d8da811ecaf60007e9f590').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.cancelOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByOrderIdSync request test', () => {
        /**
         * cancelOrderByOrderIdSync
         * Cancel Order By OrderId Sync
         * /api/v1/hf/orders/sync/{orderId}
         */
        let builder = CancelOrderByOrderIdSyncReq.builder();
        builder.setOrderId('67ac0f8a5040460007779a50').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.cancelOrderByOrderIdSync(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.originSize).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.remainSize).toEqual(expect.anything());
            expect(result.canceledSize).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByClientOid request test', () => {
        /**
         * cancelOrderByClientOid
         * Cancel Order By ClientOid
         * /api/v1/hf/orders/client-order/{clientOid}
         */
        let builder = CancelOrderByClientOidReq.builder();
        builder.setClientOid('04e1dc6f-47af-4e3c-8551-7aa757dac0da').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.cancelOrderByClientOid(req);
        return resp.then((result) => {
            expect(result.clientOid).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByClientOidSync request test', () => {
        /**
         * cancelOrderByClientOidSync
         * Cancel Order By ClientOid Sync
         * /api/v1/hf/orders/sync/client-order/{clientOid}
         */
        let builder = CancelOrderByClientOidSyncReq.builder();
        builder.setClientOid('a6f95aa9-7b4f-476f-9eff-87f51a4e61cc').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.cancelOrderByClientOidSync(req);
        return resp.then((result) => {
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.originSize).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.remainSize).toEqual(expect.anything());
            expect(result.canceledSize).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelPartialOrder request test', () => {
        /**
         * cancelPartialOrder
         * Cancel Partial Order
         * /api/v1/hf/orders/cancel/{orderId}
         */
        let builder = CancelPartialOrderReq.builder();
        builder
            .setOrderId('67ac100407813c00077755d1')
            .setSymbol('BTC-USDT')
            .setCancelSize('0.0005');
        let req = builder.build();
        let resp = api.cancelPartialOrder(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.cancelSize).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelAllOrdersBySymbol request test', () => {
        /**
         * cancelAllOrdersBySymbol
         * Cancel All Orders By Symbol
         * /api/v1/hf/orders
         */
        let builder = CancelAllOrdersBySymbolReq.builder();
        builder.setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.cancelAllOrdersBySymbol(req);
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });
    test('cancelAllOrders request test', () => {
        /**
         * cancelAllOrders
         * Cancel All Orders
         * /api/v1/hf/orders/cancelAll
         */
        let resp = api.cancelAllOrders();
        return resp.then((result) => {
            expect(result.succeedSymbols).toEqual(expect.anything());
            expect(result.failedSymbols).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('modifyOrder request test', () => {
        /**
         * modifyOrder
         * Modify Order
         * /api/v1/hf/orders/alter
         */
        let builder = ModifyOrderReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSymbol('BTC-USDT')
            .setOrderId('67ac106d07813c000779486e')
            .setNewPrice('9000')
            .setNewSize('0.001');
        let req = builder.build();
        let resp = api.modifyOrder(req);
        return resp.then((result) => {
            expect(result.newOrderId).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOrderByOrderId request test', () => {
        /**
         * getOrderByOrderId
         * Get Order By OrderId
         * /api/v1/hf/orders/{orderId}
         */
        let builder = GetOrderByOrderIdReq.builder();
        builder.setSymbol('BTC-USDT').setOrderId('67d8da811ecaf60007e9f590');
        let req = builder.build();
        let resp = api.getOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.id).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.opType).toEqual(expect.anything());
            expect(result.type).toEqual(expect.anything());
            expect(result.side).toEqual(expect.anything());
            expect(result.price).toEqual(expect.anything());
            expect(result.size).toEqual(expect.anything());
            expect(result.funds).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.dealFunds).toEqual(expect.anything());
            expect(result.fee).toEqual(expect.anything());
            expect(result.timeInForce).toEqual(expect.anything());
            expect(result.postOnly).toEqual(expect.anything());
            expect(result.hidden).toEqual(expect.anything());
            expect(result.iceberg).toEqual(expect.anything());
            expect(result.visibleSize).toEqual(expect.anything());
            expect(result.cancelAfter).toEqual(expect.anything());
            expect(result.channel).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.cancelExist).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.lastUpdatedAt).toEqual(expect.anything());
            expect(result.tradeType).toEqual(expect.anything());
            expect(result.inOrderBook).toEqual(expect.anything());
            expect(result.cancelledSize).toEqual(expect.anything());
            expect(result.cancelledFunds).toEqual(expect.anything());
            expect(result.remainSize).toEqual(expect.anything());
            expect(result.remainFunds).toEqual(expect.anything());
            expect(result.tax).toEqual(expect.anything());
            expect(result.active).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOrderByClientOid request test', () => {
        /**
         * getOrderByClientOid
         * Get Order By ClientOid
         * /api/v1/hf/orders/client-order/{clientOid}
         */
        let builder = GetOrderByClientOidReq.builder();
        builder.setSymbol('BTC-USDT').setClientOid('f7b518cc-fa55-472b-9c56-89e64d2af3a2');
        let req = builder.build();
        let resp = api.getOrderByClientOid(req);
        return resp.then((result) => {
            expect(result.id).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.opType).toEqual(expect.anything());
            expect(result.type).toEqual(expect.anything());
            expect(result.side).toEqual(expect.anything());
            expect(result.price).toEqual(expect.anything());
            expect(result.size).toEqual(expect.anything());
            expect(result.funds).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.dealFunds).toEqual(expect.anything());
            expect(result.fee).toEqual(expect.anything());
            expect(result.feeCurrency).toEqual(expect.anything());
            expect(result.timeInForce).toEqual(expect.anything());
            expect(result.postOnly).toEqual(expect.anything());
            expect(result.hidden).toEqual(expect.anything());
            expect(result.iceberg).toEqual(expect.anything());
            expect(result.visibleSize).toEqual(expect.anything());
            expect(result.cancelAfter).toEqual(expect.anything());
            expect(result.channel).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.cancelExist).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.lastUpdatedAt).toEqual(expect.anything());
            expect(result.tradeType).toEqual(expect.anything());
            expect(result.inOrderBook).toEqual(expect.anything());
            expect(result.cancelledSize).toEqual(expect.anything());
            expect(result.cancelledFunds).toEqual(expect.anything());
            expect(result.remainSize).toEqual(expect.anything());
            expect(result.remainFunds).toEqual(expect.anything());
            expect(result.tax).toEqual(expect.anything());
            expect(result.active).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSymbolsWithOpenOrder request test', () => {
        /**
         * getSymbolsWithOpenOrder
         * Get Symbols With Open Order
         * /api/v1/hf/orders/active/symbols
         */
        let resp = api.getSymbolsWithOpenOrder();
        return resp.then((result) => {
            expect(result.symbols).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOpenOrders request test', () => {
        /**
         * getOpenOrders
         * Get Open Orders
         * /api/v1/hf/orders/active
         */
        let builder = GetOpenOrdersReq.builder();
        builder.setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.getOpenOrders(req);
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });


    test('getOpenOrdersByPage request test', ()=> {
        /**
         * getOpenOrdersByPage
         * Get Open Orders By Page
         * /api/v1/hf/orders/active/page
         */
        let builder = GetOpenOrdersByPageReq.builder();
        builder.setSymbol('BTC-USDT').setPageNum(1).setPageSize(50);
        let req = builder.build();
        let resp = api.getOpenOrdersByPage(req);
        return resp.then(result => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            result.items.forEach(item => {
                expect(item.fee).toEqual(expect.anything());
                expect(item.id).toEqual(expect.anything());
                expect(item.symbol).toEqual(expect.anything());
                expect(item.opType).toEqual(expect.anything());
            })
            console.log(resp);
        });
    })


    test('getClosedOrders request test', () => {
        /**
         * getClosedOrders
         * Get Closed Orders
         * /api/v1/hf/orders/done
         */
        let builder = GetClosedOrdersReq.builder();
        builder
            .setSymbol('BTC-USDT')
            .setSide(GetClosedOrdersReq.SideEnum.BUY)
            .setType(GetClosedOrdersReq.TypeEnum.LIMIT);
        let req = builder.build();
        let resp = api.getClosedOrders(req);
        return resp.then((result) => {
            expect(result.lastId).toEqual(expect.anything());
            expect(result.items).toEqual(expect.anything());
            result.items.forEach((result) => {
                expect(result.id).toEqual(expect.anything());
                expect(result.symbol).toEqual(expect.anything());
                expect(result.opType).toEqual(expect.anything());
                expect(result.type).toEqual(expect.anything());
                expect(result.side).toEqual(expect.anything());
                expect(result.price).toEqual(expect.anything());
                expect(result.size).toEqual(expect.anything());
                expect(result.funds).toEqual(expect.anything());
                expect(result.dealSize).toEqual(expect.anything());
                expect(result.dealFunds).toEqual(expect.anything());
                expect(result.fee).toEqual(expect.anything());
                expect(result.feeCurrency).toEqual(expect.anything());
                expect(result.timeInForce).toEqual(expect.anything());
                expect(result.postOnly).toEqual(expect.anything());
                expect(result.hidden).toEqual(expect.anything());
                expect(result.iceberg).toEqual(expect.anything());
                expect(result.visibleSize).toEqual(expect.anything());
                expect(result.cancelAfter).toEqual(expect.anything());
                expect(result.channel).toEqual(expect.anything());
                expect(result.clientOid).toEqual(expect.anything());
                expect(result.cancelExist).toEqual(expect.anything());
                expect(result.createdAt).toEqual(expect.anything());
                expect(result.lastUpdatedAt).toEqual(expect.anything());
                expect(result.tradeType).toEqual(expect.anything());
                expect(result.inOrderBook).toEqual(expect.anything());
                expect(result.cancelledSize).toEqual(expect.anything());
                expect(result.cancelledFunds).toEqual(expect.anything());
                expect(result.remainSize).toEqual(expect.anything());
                expect(result.remainFunds).toEqual(expect.anything());
                expect(result.tax).toEqual(expect.anything());
                expect(result.active).toEqual(expect.anything());
            });
            console.log(resp);
        });
    });

    test('getTradeHistory request test', () => {
        /**
         * getTradeHistory
         * Get Trade History
         * /api/v1/hf/fills
         */
        let builder = GetTradeHistoryReq.builder();
        builder.setSymbol('KCS-USDT').setSide(GetTradeHistoryReq.SideEnum.SELL);
        let req = builder.build();
        let resp = api.getTradeHistory(req);
        return resp.then((result) => {
            result.items.forEach((result) => {
                expect(result.id).toEqual(expect.anything());
                expect(result.symbol).toEqual(expect.anything());
                expect(result.type).toEqual(expect.anything());
                expect(result.side).toEqual(expect.anything());
                expect(result.price).toEqual(expect.anything());
                expect(result.size).toEqual(expect.anything());
                expect(result.funds).toEqual(expect.anything());
                expect(result.fee).toEqual(expect.anything());
                expect(result.feeCurrency).toEqual(expect.anything());
                expect(result.createdAt).toEqual(expect.anything());
                expect(result.tradeType).toEqual(expect.anything());
                expect(result.tax).toEqual(expect.anything());
            });
            expect(result.lastId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getDCP request test', () => {
        /**
         * getDCP
         * Get DCP
         * /api/v1/hf/orders/dead-cancel-all/query
         */
        let resp = api.getDCP();
        return resp.then((result) => {
            expect(result.timeout).toEqual(expect.anything());
            expect(result.symbols).toEqual(expect.anything());
            expect(result.currentTime).toEqual(expect.anything());
            expect(result.triggerTime).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('setDCP request test', () => {
        /**
         * setDCP
         * Set DCP
         * /api/v1/hf/orders/dead-cancel-all
         */
        let builder = SetDCPReq.builder();
        builder.setTimeout(5).setSymbols('BTC-USDT');
        let req = builder.build();
        let resp = api.setDCP(req);
        return resp.then((result) => {
            expect(result.currentTime).toEqual(expect.anything());
            expect(result.triggerTime).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('addStopOrder request test', () => {
        /**
         * addStopOrder
         * Add Stop Order
         * /api/v1/stop-order
         */
        let builder = AddStopOrderReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddStopOrderReq.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setType(AddStopOrderReq.TypeEnum.LIMIT)
            .setRemark('sdk_test')
            .setPrice('10000')
            .setSize('0.001')
            .setStopPrice('8000');
        let req = builder.build();
        let resp = api.addStopOrder(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            console.log(resp);
            console.log(req.clientOid);
        });
    });

    test('cancelStopOrderByClientOid request test', () => {
        /**
         * cancelStopOrderByClientOid
         * Cancel Stop Order By ClientOid
         * /api/v1/stop-order/cancelOrderByClientOid
         */
        let builder = CancelStopOrderByClientOidReq.builder();
        builder.setSymbol('BTC-USDT').setClientOid('0d760198-6696-4220-82e4-509cc248c537');
        let req = builder.build();
        let resp = api.cancelStopOrderByClientOid(req);
        return resp.then((result) => {
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.cancelledOrderId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelStopOrderByOrderId request test', () => {
        /**
         * cancelStopOrderByOrderId
         * Cancel Stop Order By OrderId
         * /api/v1/stop-order/{orderId}
         */
        let builder = CancelStopOrderByOrderIdReq.builder();
        builder.setOrderId('vs93gptc29o8u2if003v8h2f');
        let req = builder.build();
        let resp = api.cancelStopOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchCancelStopOrder request test', () => {
        /**
         * batchCancelStopOrder
         * Batch Cancel Stop Orders
         * /api/v1/stop-order/cancel
         */
        let builder = BatchCancelStopOrderReq.builder();
        builder.setSymbol('BTC-USDT').setTradeType('TRADE').setOrderIds('vs93gptc2bgm77kh003gj9js');
        let req = builder.build();
        let resp = api.batchCancelStopOrder(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getStopOrdersList request test', () => {
        /**
         * getStopOrdersList
         * Get Stop Orders List
         * /api/v1/stop-order
         */
        let builder = GetStopOrdersListReq.builder();
        builder
            .setSymbol('BTC-USDT')
            .setType(GetStopOrdersListReq.TypeEnum.LIMIT)
        let req = builder.build();
        let resp = api.getStopOrdersList(req);
        return resp.then((result) => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            result.items?.forEach((item) => {
                expect(item.id).toEqual(expect.any(String));
                expect(item.symbol).toEqual(expect.any(String));
                expect(item.userId).toEqual(expect.any(String));
                expect(item.status).toEqual(expect.any(String));
                expect(item.type).toEqual(expect.any(String));
                expect(item.side).toEqual(expect.any(String));
                expect(item.price).toEqual(expect.any(String));
                expect(item.size).toEqual(expect.any(String));
                expect(item.timeInForce).toEqual(expect.any(String));
                expect(item.cancelAfter).toEqual(expect.any(Number));
                expect(item.postOnly).toEqual(expect.any(Boolean));
                expect(item.hidden).toEqual(expect.any(Boolean));
                expect(item.iceberg).toEqual(expect.any(Boolean));
                expect(item.channel).toEqual(expect.any(String));
                expect(item.clientOid).toEqual(expect.any(String));
                expect(item.remark).toEqual(expect.any(String));
                expect(item.orderTime).toEqual(expect.any(Number));
                expect(item.domainId).toEqual(expect.any(String));
                expect(item.tradeSource).toEqual(expect.any(String));
                expect(item.tradeType).toEqual(expect.any(String));
                expect(item.feeCurrency).toEqual(expect.any(String));
                expect(item.takerFeeRate).toEqual(expect.any(String));
            });
            console.log(resp);
        });
    });

    test('getStopOrderByOrderId request test', () => {
        /**
         * getStopOrderByOrderId
         * Get Stop Order By OrderId
         * /api/v1/stop-order/{orderId}
         */
        let builder = GetStopOrderByOrderIdReq.builder();
        builder.setOrderId('vs93gptc2etm77kh003gj9kc');
        let req = builder.build();
        let resp = api.getStopOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.id).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.userId).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            expect(result.type).toEqual(expect.anything());
            expect(result.side).toEqual(expect.anything());
            expect(result.price).toEqual(expect.anything());
            expect(result.size).toEqual(expect.anything());
            expect(result.timeInForce).toEqual(expect.anything());
            expect(result.cancelAfter).toEqual(expect.anything());
            expect(result.postOnly).toEqual(expect.anything());
            expect(result.hidden).toEqual(expect.anything());
            expect(result.iceberg).toEqual(expect.anything());
            expect(result.channel).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.remark).toEqual(expect.anything());
            expect(result.domainId).toEqual(expect.anything());
            expect(result.tradeSource).toEqual(expect.anything());
            expect(result.tradeType).toEqual(expect.anything());
            expect(result.feeCurrency).toEqual(expect.anything());
            expect(result.takerFeeRate).toEqual(expect.anything());
            expect(result.makerFeeRate).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.stop).toEqual(expect.anything());
            expect(result.stopPrice).toEqual(expect.anything());
            expect(result.orderTime).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getStopOrderByClientOid request test', () => {
        /**
         * getStopOrderByClientOid
         * Get Stop Order By ClientOid
         * /api/v1/stop-order/queryOrderByClientOid
         */
        let builder = GetStopOrderByClientOidReq.builder();
        builder.setClientOid('0b7b79ae-d435-44d1-916e-c9cf970f7d08').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.getStopOrderByClientOid(req);
        return resp.then((result) => {
            result.data.forEach((result) => {
                expect(result.id).toEqual(expect.anything());
                expect(result.symbol).toEqual(expect.anything());
                expect(result.userId).toEqual(expect.anything());
                expect(result.status).toEqual(expect.anything());
                expect(result.type).toEqual(expect.anything());
                expect(result.side).toEqual(expect.anything());
                expect(result.price).toEqual(expect.anything());
                expect(result.size).toEqual(expect.anything());
                expect(result.timeInForce).toEqual(expect.anything());
                expect(result.cancelAfter).toEqual(expect.anything());
                expect(result.postOnly).toEqual(expect.anything());
                expect(result.hidden).toEqual(expect.anything());
                expect(result.iceberg).toEqual(expect.anything());
                expect(result.channel).toEqual(expect.anything());
                expect(result.clientOid).toEqual(expect.anything());
                expect(result.remark).toEqual(expect.anything());
                expect(result.domainId).toEqual(expect.anything());
                expect(result.tradeSource).toEqual(expect.anything());
                expect(result.tradeType).toEqual(expect.anything());
                expect(result.feeCurrency).toEqual(expect.anything());
                expect(result.takerFeeRate).toEqual(expect.anything());
                expect(result.makerFeeRate).toEqual(expect.anything());
                expect(result.createdAt).toEqual(expect.anything());
                expect(result.stop).toEqual(expect.anything());
                expect(result.stopPrice).toEqual(expect.anything());
                expect(result.orderTime).toEqual(expect.anything());
            });
            console.log(resp);
        });
    });

    test('addOcoOrder request test', () => {
        /**
         * addOcoOrder
         * Add OCO Order
         * /api/v3/oco/order
         */
        let builder = AddOcoOrderReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOcoOrderReq.SideEnum.BUY)
            .setSymbol('BTC-USDT')
            .setPrice('94000')
            .setSize('0.001')
            .setStopPrice('98000')
            .setLimitPrice('96000')
            .setTradeType(AddOcoOrderReq.TradeTypeEnum.TRADE);
        let req = builder.build();
        let resp = api.addOcoOrder(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOcoOrderByOrderId request test', () => {
        /**
         * cancelOcoOrderByOrderId
         * Cancel OCO Order By OrderId
         * /api/v3/oco/order/{orderId}
         */
        let builder = CancelOcoOrderByOrderIdReq.builder();
        builder.setOrderId('67ac14f68f0a4f0007f44486');
        let req = builder.build();
        let resp = api.cancelOcoOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOcoOrderByClientOid request test', () => {
        /**
         * cancelOcoOrderByClientOid
         * Cancel OCO Order By ClientOid
         * /api/v3/oco/client-order/{clientOid}
         */
        let builder = CancelOcoOrderByClientOidReq.builder();
        builder.setClientOid('9e4ffc79-eac5-4253-9a03-85cb1951de74');
        let req = builder.build();
        let resp = api.cancelOcoOrderByClientOid(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchCancelOcoOrders request test', () => {
        /**
         * batchCancelOcoOrders
         * Batch Cancel OCO Order
         * /api/v3/oco/orders
         */
        let builder = BatchCancelOcoOrdersReq.builder();
        builder.setOrderIds('67ac15d038b7780007aecda6').setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.batchCancelOcoOrders(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOcoOrderByOrderId request test', () => {
        /**
         * getOcoOrderByOrderId
         * Get OCO Order By OrderId
         * /api/v3/oco/order/{orderId}
         */
        let builder = GetOcoOrderByOrderIdReq.builder();
        builder.setOrderId('67ac152467338f0007143106');
        let req = builder.build();
        let resp = api.getOcoOrderByOrderId(req);
        return resp.then((result) => {
            expect(result.symbol).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.orderId).toEqual(expect.anything());
            expect(result.orderTime).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOcoOrderByClientOid request test', () => {
        /**
         * getOcoOrderByClientOid
         * Get OCO Order By ClientOid
         * /api/v3/oco/client-order/{clientOid}
         */
        let builder = GetOcoOrderByClientOidReq.builder();
        builder.setClientOid('9e4ffc79-eac5-4253-9a03-85cb1951de74');
        let req = builder.build();
        let resp = api.getOcoOrderByClientOid(req);
        return resp.then((result) => {
            expect(result.symbol).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.orderId).toEqual(expect.anything());
            expect(result.orderTime).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOcoOrderDetailByOrderId request test', () => {
        /**
         * getOcoOrderDetailByOrderId
         * Get OCO Order Detail By OrderId
         * /api/v3/oco/order/details/{orderId}
         */
        let builder = GetOcoOrderDetailByOrderIdReq.builder();
        builder.setOrderId('67ac152467338f0007143106');
        let req = builder.build();
        let resp = api.getOcoOrderDetailByOrderId(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.orderTime).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            expect(result.orders).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOcoOrderList request test', () => {
        /**
         * getOcoOrderList
         * Get OCO Order List
         * /api/v3/oco/orders
         */
        let builder = GetOcoOrderListReq.builder();
        builder.setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.getOcoOrderList(req);
        return resp.then((result) => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            result.items.forEach((item) => {
                expect(item.orderId).toEqual(expect.any(String));
                expect(item.symbol).toEqual(expect.any(String));
                expect(item.clientOid).toEqual(expect.any(String));
                expect(item.orderTime).toEqual(expect.any(Number));
                expect(item.status).toEqual(expect.any(String));
            });
            console.log(resp);
        });
    });

    test('addOrderOld request test', () => {
        /**
         * addOrderOld
         * Add Order - Old
         * /api/v1/orders
         */
        let builder = AddOrderOldReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOrderOldReq.SideEnum.BUY)
            .setTradeType(AddOrderOldReq.TradeTypeEnum.TRADE)
            .setType(AddOrderOldReq.TypeEnum.LIMIT)
            .setSymbol('BTC-USDT')
            .setPrice('10000')
            .setSize('0.001');
        let req = builder.build();
        let resp = api.addOrderOld(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('addOrderTestOld request test', () => {
        /**
         * addOrderTestOld
         * Add Order Test - Old
         * /api/v1/orders/test
         */
        let builder = AddOrderTestOldReq.builder();
        builder
            .setClientOid(randomUUID())
            .setSide(AddOrderOldReq.SideEnum.BUY)
            .setTradeType(AddOrderOldReq.TradeTypeEnum.TRADE)
            .setType(AddOrderOldReq.TypeEnum.LIMIT)
            .setSymbol('BTC-USDT')
            .setPrice('94000')
            .setSize('0.001');
        let req = builder.build();
        let resp = api.addOrderTestOld(req);
        return resp.then((result) => {
            expect(result.orderId).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchAddOrdersOld request test', () => {
        /**
         * batchAddOrdersOld
         * Batch Add Orders - Old
         * /api/v1/orders/multi
         */
        let builder = BatchAddOrdersOldReq.builder();

        let order1 = BatchAddOrdersOldOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersOldOrderList.SideEnum.BUY)
            .setTradeType(BatchAddOrdersOldOrderList.TradeTypeEnum.TRADE)
            .setType(BatchAddOrdersOldOrderList.TypeEnum.LIMIT)
            .setSymbol('BTC-USDT')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        let order2 = BatchAddOrdersOldOrderList.builder()
            .setClientOid(randomUUID())
            .setSide(BatchAddOrdersOldOrderList.SideEnum.BUY)
            .setTradeType(BatchAddOrdersOldOrderList.TradeTypeEnum.TRADE)
            .setType(BatchAddOrdersOldOrderList.TypeEnum.LIMIT)
            .setSymbol('BTC-USDT')
            .setPrice('10000')
            .setSize('0.001')
            .build();

        builder.setOrderList([order1, order2]).setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.batchAddOrdersOld(req);
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByOrderIdOld request test', () => {
        /**
         * cancelOrderByOrderIdOld
         * Cancel Order By OrderId - Old
         * /api/v1/orders/{orderId}
         */
        let builder = CancelOrderByOrderIdOldReq.builder();
        builder.setOrderId('67ac173127f3550007502cfc');
        let req = builder.build();
        let resp = api.cancelOrderByOrderIdOld(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('cancelOrderByClientOidOld request test', () => {
        /**
         * cancelOrderByClientOidOld
         * Cancel Order By ClientOid - Old
         * /api/v1/order/client-order/{clientOid}
         */
        let builder = CancelOrderByClientOidOldReq.builder();
        builder.setClientOid('0a3a8abd-09e1-498f-a6cc-94eeacfe2203');
        let req = builder.build();
        let resp = api.cancelOrderByClientOidOld(req);
        return resp.then((result) => {
            expect(result.clientOid).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('batchCancelOrderOld request test', () => {
        /**
         * batchCancelOrderOld
         * Batch Cancel Order - Old
         * /api/v1/orders
         */
        let builder = BatchCancelOrderOldReq.builder();
        builder.setSymbol('BTC-USDT').setTradeType(BatchCancelOrderOldReq.TradeTypeEnum.TRADE);
        let req = builder.build();
        let resp = api.batchCancelOrderOld(req);
        return resp.then((result) => {
            expect(result.cancelledOrderIds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOrdersListOld request test', () => {
        /**
         * getOrdersListOld
         * Get Orders List - Old
         * /api/v1/orders
         */
        let builder = GetOrdersListOldReq.builder();
        builder.setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.getOrdersListOld(req);
        return resp.then((result) => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            result.items.forEach((item) => {
                expect(item.id).toEqual(expect.any(String));
                expect(item.symbol).toEqual(expect.any(String));
                expect(item.opType).toEqual(expect.any(String));
                expect(item.type).toEqual(expect.any(String));
                expect(item.side).toEqual(expect.any(String));
                expect(item.price).toEqual(expect.any(String));
                expect(item.size).toEqual(expect.any(String));
                expect(item.dealFunds).toEqual(expect.any(String));
                expect(item.dealSize).toEqual(expect.any(String));
                expect(item.fee).toEqual(expect.any(String));
                expect(item.feeCurrency).toEqual(expect.any(String));
                expect(item.stop).toEqual(expect.any(String));
                expect(item.stopTriggered).toEqual(expect.any(Boolean));
                expect(item.stopPrice).toEqual(expect.any(String));
                expect(item.timeInForce).toEqual(expect.any(String));
                expect(item.postOnly).toEqual(expect.any(Boolean));
                expect(item.hidden).toEqual(expect.any(Boolean));
                expect(item.iceberg).toEqual(expect.any(Boolean));
                expect(item.cancelAfter).toEqual(expect.any(Number));
                expect(item.channel).toEqual(expect.any(String));
                expect(item.isActive).toEqual(expect.any(Boolean));
                expect(item.cancelExist).toEqual(expect.any(Boolean));
                expect(item.createdAt).toEqual(expect.any(Number));
                expect(item.tradeType).toEqual(expect.any(String));
            });
            console.log(resp);
        });
    });

    test('getRecentOrdersListOld request test', () => {
        /**
         * getRecentOrdersListOld
         * Get Recent Orders List - Old
         * /api/v1/limit/orders
         */
        let resp = api.getRecentOrdersListOld();
        return resp.then((result) => {
            result.data.forEach((item) => {
                expect(item.id).toEqual(expect.any(String));
                expect(item.symbol).toEqual(expect.any(String));
                expect(item.opType).toEqual(expect.any(String));
                expect(item.type).toEqual(expect.any(String));
                expect(item.side).toEqual(expect.any(String));
                expect(item.price).toEqual(expect.any(String));
                expect(item.size).toEqual(expect.any(String));
                expect(item.dealFunds).toEqual(expect.any(String));
                expect(item.dealSize).toEqual(expect.any(String));
                expect(item.fee).toEqual(expect.any(String));
                expect(item.feeCurrency).toEqual(expect.any(String));
                expect(item.stop).toEqual(expect.any(String));
                expect(item.stopTriggered).toEqual(expect.any(Boolean));
                expect(item.stopPrice).toEqual(expect.any(String));
                expect(item.timeInForce).toEqual(expect.any(String));
                expect(item.postOnly).toEqual(expect.any(Boolean));
                expect(item.hidden).toEqual(expect.any(Boolean));
                expect(item.iceberg).toEqual(expect.any(Boolean));
                expect(item.cancelAfter).toEqual(expect.any(Number));
                expect(item.channel).toEqual(expect.any(String));
                expect(item.isActive).toEqual(expect.any(Boolean));
                expect(item.cancelExist).toEqual(expect.any(Boolean));
                expect(item.createdAt).toEqual(expect.any(Number));
                expect(item.tradeType).toEqual(expect.any(String));
            });
            console.log(resp);
        });
    });

    test('getOrderByOrderIdOld request test', () => {
        /**
         * getOrderByOrderIdOld
         * Get Order By OrderId - Old
         * /api/v1/orders/{orderId}
         */
        let builder = GetOrderByOrderIdOldReq.builder();
        builder.setOrderId('67ac1892a794c7000729b372');
        let req = builder.build();
        let resp = api.getOrderByOrderIdOld(req);
        return resp.then((result) => {
            expect(result.id).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.opType).toEqual(expect.anything());
            expect(result.type).toEqual(expect.anything());
            expect(result.side).toEqual(expect.anything());
            expect(result.price).toEqual(expect.anything());
            expect(result.size).toEqual(expect.anything());
            expect(result.funds).toEqual(expect.anything());
            expect(result.dealFunds).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.fee).toEqual(expect.anything());
            expect(result.feeCurrency).toEqual(expect.anything());
            expect(result.stopTriggered).toEqual(expect.anything());
            expect(result.stopPrice).toEqual(expect.anything());
            expect(result.timeInForce).toEqual(expect.anything());
            expect(result.postOnly).toEqual(expect.anything());
            expect(result.hidden).toEqual(expect.anything());
            expect(result.iceberg).toEqual(expect.anything());
            expect(result.visibleSize).toEqual(expect.anything());
            expect(result.cancelAfter).toEqual(expect.anything());
            expect(result.channel).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.isActive).toEqual(expect.anything());
            expect(result.cancelExist).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.tradeType).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getOrderByClientOidOld request test', () => {
        /**
         * getOrderByClientOidOld
         * Get Order By ClientOid - Old
         * /api/v1/order/client-order/{clientOid}
         */
        let builder = GetOrderByClientOidOldReq.builder();
        builder.setClientOid('f156fff8-fb03-4557-84c1-d30acb976ee8');
        let req = builder.build();
        let resp = api.getOrderByClientOidOld(req);
        return resp.then((result) => {
            expect(result.id).toEqual(expect.anything());
            expect(result.symbol).toEqual(expect.anything());
            expect(result.opType).toEqual(expect.anything());
            expect(result.type).toEqual(expect.anything());
            expect(result.side).toEqual(expect.anything());
            expect(result.price).toEqual(expect.anything());
            expect(result.size).toEqual(expect.anything());
            expect(result.funds).toEqual(expect.anything());
            expect(result.dealFunds).toEqual(expect.anything());
            expect(result.dealSize).toEqual(expect.anything());
            expect(result.fee).toEqual(expect.anything());
            expect(result.feeCurrency).toEqual(expect.anything());
            expect(result.stopTriggered).toEqual(expect.anything());
            expect(result.stopPrice).toEqual(expect.anything());
            expect(result.timeInForce).toEqual(expect.anything());
            expect(result.postOnly).toEqual(expect.anything());
            expect(result.hidden).toEqual(expect.anything());
            expect(result.iceberg).toEqual(expect.anything());
            expect(result.visibleSize).toEqual(expect.anything());
            expect(result.cancelAfter).toEqual(expect.anything());
            expect(result.channel).toEqual(expect.anything());
            expect(result.clientOid).toEqual(expect.anything());
            expect(result.isActive).toEqual(expect.anything());
            expect(result.cancelExist).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.tradeType).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getTradeHistoryOld request test', () => {
        /**
         * getTradeHistoryOld
         * Get Trade History - Old
         * /api/v1/fills
         */
        let builder = GetTradeHistoryOldReq.builder();
        builder.setSymbol('KCS-USDT').setTradeType(GetTradeHistoryOldReq.TradeTypeEnum.TRADE);
        let req = builder.build();
        let resp = api.getTradeHistoryOld(req);
        return resp.then((result) => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            result.items.forEach((result) => {
                expect(result.symbol).toEqual(expect.anything());
                expect(result.type).toEqual(expect.anything());
                expect(result.side).toEqual(expect.anything());
                expect(result.price).toEqual(expect.anything());
                expect(result.size).toEqual(expect.anything());
                expect(result.funds).toEqual(expect.anything());
                expect(result.fee).toEqual(expect.anything());
                expect(result.feeCurrency).toEqual(expect.anything());
                expect(result.createdAt).toEqual(expect.anything());
                expect(result.tradeType).toEqual(expect.anything());
            });
            console.log(resp);
        });
    });

    test('getRecentTradeHistoryOld request test', () => {
        /**
         * getRecentTradeHistoryOld
         * Get Recent Trade History - Old
         * /api/v1/limit/fills
         */
        let resp = api.getRecentTradeHistoryOld();
        return resp.then((result) => {
            result.data.forEach((item) => {
                expect(item.symbol).toEqual(expect.any(String));
                expect(item.tradeId).toEqual(expect.any(String));
                expect(item.orderId).toEqual(expect.any(String));
                expect(item.counterOrderId).toEqual(expect.any(String));
                expect(item.side).toEqual(expect.any(String));
                expect(item.liquidity).toEqual(expect.any(String));
                expect(item.forceTaker).toEqual(expect.any(Boolean));
                expect(item.price).toEqual(expect.any(String));
                expect(item.size).toEqual(expect.any(String));
                expect(item.funds).toEqual(expect.any(String));
                expect(item.fee).toEqual(expect.any(String));
                expect(item.feeRate).toEqual(expect.any(String));
                expect(item.feeCurrency).toEqual(expect.any(String));
                expect(item.stop).toEqual(expect.any(String));
                expect(item.tradeType).toEqual(expect.any(String));
                expect(item.type).toEqual(expect.any(String));
                expect(item.createdAt).toEqual(expect.any(Number));
            });
            console.log(resp);
        });
    });
});
