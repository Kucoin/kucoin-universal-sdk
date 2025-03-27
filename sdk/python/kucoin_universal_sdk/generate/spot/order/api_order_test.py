import unittest
from .model_add_oco_order_req import AddOcoOrderReq
from .model_add_oco_order_resp import AddOcoOrderResp
from .model_add_order_old_req import AddOrderOldReq
from .model_add_order_old_resp import AddOrderOldResp
from .model_add_order_req import AddOrderReq
from .model_add_order_resp import AddOrderResp
from .model_add_order_sync_req import AddOrderSyncReq
from .model_add_order_sync_resp import AddOrderSyncResp
from .model_add_order_test_old_req import AddOrderTestOldReq
from .model_add_order_test_old_resp import AddOrderTestOldResp
from .model_add_order_test_req import AddOrderTestReq
from .model_add_order_test_resp import AddOrderTestResp
from .model_add_stop_order_req import AddStopOrderReq
from .model_add_stop_order_resp import AddStopOrderResp
from .model_batch_add_orders_old_req import BatchAddOrdersOldReq
from .model_batch_add_orders_old_resp import BatchAddOrdersOldResp
from .model_batch_add_orders_req import BatchAddOrdersReq
from .model_batch_add_orders_resp import BatchAddOrdersResp
from .model_batch_add_orders_sync_req import BatchAddOrdersSyncReq
from .model_batch_add_orders_sync_resp import BatchAddOrdersSyncResp
from .model_batch_cancel_oco_orders_req import BatchCancelOcoOrdersReq
from .model_batch_cancel_oco_orders_resp import BatchCancelOcoOrdersResp
from .model_batch_cancel_order_old_req import BatchCancelOrderOldReq
from .model_batch_cancel_order_old_resp import BatchCancelOrderOldResp
from .model_batch_cancel_stop_order_req import BatchCancelStopOrderReq
from .model_batch_cancel_stop_order_resp import BatchCancelStopOrderResp
from .model_cancel_all_orders_by_symbol_req import CancelAllOrdersBySymbolReq
from .model_cancel_all_orders_by_symbol_resp import CancelAllOrdersBySymbolResp
from .model_cancel_all_orders_resp import CancelAllOrdersResp
from .model_cancel_oco_order_by_client_oid_req import CancelOcoOrderByClientOidReq
from .model_cancel_oco_order_by_client_oid_resp import CancelOcoOrderByClientOidResp
from .model_cancel_oco_order_by_order_id_req import CancelOcoOrderByOrderIdReq
from .model_cancel_oco_order_by_order_id_resp import CancelOcoOrderByOrderIdResp
from .model_cancel_order_by_client_oid_old_req import CancelOrderByClientOidOldReq
from .model_cancel_order_by_client_oid_old_resp import CancelOrderByClientOidOldResp
from .model_cancel_order_by_client_oid_req import CancelOrderByClientOidReq
from .model_cancel_order_by_client_oid_resp import CancelOrderByClientOidResp
from .model_cancel_order_by_client_oid_sync_req import CancelOrderByClientOidSyncReq
from .model_cancel_order_by_client_oid_sync_resp import CancelOrderByClientOidSyncResp
from .model_cancel_order_by_order_id_old_req import CancelOrderByOrderIdOldReq
from .model_cancel_order_by_order_id_old_resp import CancelOrderByOrderIdOldResp
from .model_cancel_order_by_order_id_req import CancelOrderByOrderIdReq
from .model_cancel_order_by_order_id_resp import CancelOrderByOrderIdResp
from .model_cancel_order_by_order_id_sync_req import CancelOrderByOrderIdSyncReq
from .model_cancel_order_by_order_id_sync_resp import CancelOrderByOrderIdSyncResp
from .model_cancel_partial_order_req import CancelPartialOrderReq
from .model_cancel_partial_order_resp import CancelPartialOrderResp
from .model_cancel_stop_order_by_client_oid_req import CancelStopOrderByClientOidReq
from .model_cancel_stop_order_by_client_oid_resp import CancelStopOrderByClientOidResp
from .model_cancel_stop_order_by_order_id_req import CancelStopOrderByOrderIdReq
from .model_cancel_stop_order_by_order_id_resp import CancelStopOrderByOrderIdResp
from .model_get_closed_orders_req import GetClosedOrdersReq
from .model_get_closed_orders_resp import GetClosedOrdersResp
from .model_get_dcp_resp import GetDcpResp
from .model_get_oco_order_by_client_oid_req import GetOcoOrderByClientOidReq
from .model_get_oco_order_by_client_oid_resp import GetOcoOrderByClientOidResp
from .model_get_oco_order_by_order_id_req import GetOcoOrderByOrderIdReq
from .model_get_oco_order_by_order_id_resp import GetOcoOrderByOrderIdResp
from .model_get_oco_order_detail_by_order_id_req import GetOcoOrderDetailByOrderIdReq
from .model_get_oco_order_detail_by_order_id_resp import GetOcoOrderDetailByOrderIdResp
from .model_get_oco_order_list_req import GetOcoOrderListReq
from .model_get_oco_order_list_resp import GetOcoOrderListResp
from .model_get_open_orders_by_page_req import GetOpenOrdersByPageReq
from .model_get_open_orders_by_page_resp import GetOpenOrdersByPageResp
from .model_get_open_orders_req import GetOpenOrdersReq
from .model_get_open_orders_resp import GetOpenOrdersResp
from .model_get_order_by_client_oid_old_req import GetOrderByClientOidOldReq
from .model_get_order_by_client_oid_old_resp import GetOrderByClientOidOldResp
from .model_get_order_by_client_oid_req import GetOrderByClientOidReq
from .model_get_order_by_client_oid_resp import GetOrderByClientOidResp
from .model_get_order_by_order_id_old_req import GetOrderByOrderIdOldReq
from .model_get_order_by_order_id_old_resp import GetOrderByOrderIdOldResp
from .model_get_order_by_order_id_req import GetOrderByOrderIdReq
from .model_get_order_by_order_id_resp import GetOrderByOrderIdResp
from .model_get_orders_list_old_req import GetOrdersListOldReq
from .model_get_orders_list_old_resp import GetOrdersListOldResp
from .model_get_recent_orders_list_old_resp import GetRecentOrdersListOldResp
from .model_get_recent_trade_history_old_resp import GetRecentTradeHistoryOldResp
from .model_get_stop_order_by_client_oid_req import GetStopOrderByClientOidReq
from .model_get_stop_order_by_client_oid_resp import GetStopOrderByClientOidResp
from .model_get_stop_order_by_order_id_req import GetStopOrderByOrderIdReq
from .model_get_stop_order_by_order_id_resp import GetStopOrderByOrderIdResp
from .model_get_stop_orders_list_req import GetStopOrdersListReq
from .model_get_stop_orders_list_resp import GetStopOrdersListResp
from .model_get_symbols_with_open_order_resp import GetSymbolsWithOpenOrderResp
from .model_get_trade_history_old_req import GetTradeHistoryOldReq
from .model_get_trade_history_old_resp import GetTradeHistoryOldResp
from .model_get_trade_history_req import GetTradeHistoryReq
from .model_get_trade_history_resp import GetTradeHistoryResp
from .model_modify_order_req import ModifyOrderReq
from .model_modify_order_resp import ModifyOrderResp
from .model_set_dcp_req import SetDcpReq
from .model_set_dcp_resp import SetDcpResp
from typing_extensions import deprecated
from kucoin_universal_sdk.model.common import RestResponse


class OrderAPITest(unittest.TestCase):

    def test_add_order_req_model(self):
        """
       add_order
       Add Order
       /api/v1/hf/orders
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddOrderReq.from_json(data)

    def test_add_order_resp_model(self):
        """
        add_order
        Add Order
        /api/v1/hf/orders
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderResp.from_dict(common_response.data)

    def test_add_order_sync_req_model(self):
        """
       add_order_sync
       Add Order Sync
       /api/v1/hf/orders/sync
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}"
        req = AddOrderSyncReq.from_json(data)

    def test_add_order_sync_resp_model(self):
        """
        add_order_sync
        Add Order Sync
        /api/v1/hf/orders/sync
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"67111a7cb7cbdf000703e1f6\",\"clientOid\":\"5c52e11203aa677f33e493f\",\"orderTime\":1729174140586,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729174140588}}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderSyncResp.from_dict(common_response.data)

    def test_add_order_test_req_model(self):
        """
       add_order_test
       Add Order Test
       /api/v1/hf/orders/test
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493f\", \"remark\": \"order remarks\"}"
        req = AddOrderTestReq.from_json(data)

    def test_add_order_test_resp_model(self):
        """
        add_order_test
        Add Order Test
        /api/v1/hf/orders/test
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"670fd33bf9406e0007ab3945\",\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderTestResp.from_dict(common_response.data)

    def test_batch_add_orders_req_model(self):
        """
       batch_add_orders
       Batch Add Orders
       /api/v1/hf/orders/multi
       """
        data = "{\"orderList\": [{\"clientOid\": \"client order id 12\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 13\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}"
        req = BatchAddOrdersReq.from_json(data)

    def test_batch_add_orders_resp_model(self):
        """
        batch_add_orders
        Batch Add Orders
        /api/v1/hf/orders/multi
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"orderId\": \"6710d8336afcdb0007319c27\",\n            \"clientOid\": \"client order id 12\",\n            \"success\": true\n        },\n        {\n            \"success\": false,\n            \"failMsg\": \"The order funds should more then 0.1 USDT.\"\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = BatchAddOrdersResp.from_dict(common_response.data)

    def test_batch_add_orders_sync_req_model(self):
        """
       batch_add_orders_sync
       Batch Add Orders Sync
       /api/v1/hf/orders/multi/sync
       """
        data = "{\"orderList\": [{\"clientOid\": \"client order id 13\", \"symbol\": \"BTC-USDT\", \"type\": \"limit\", \"side\": \"buy\", \"price\": \"30000\", \"size\": \"0.00001\"}, {\"clientOid\": \"client order id 14\", \"symbol\": \"ETH-USDT\", \"type\": \"limit\", \"side\": \"sell\", \"price\": \"2000\", \"size\": \"0.00001\"}]}"
        req = BatchAddOrdersSyncReq.from_json(data)

    def test_batch_add_orders_sync_resp_model(self):
        """
        batch_add_orders_sync
        Batch Add Orders Sync
        /api/v1/hf/orders/multi/sync
        """
        data = "{\"code\":\"200000\",\"data\":[{\"orderId\":\"6711195e5584bc0007bd5aef\",\"clientOid\":\"client order id 13\",\"orderTime\":1729173854299,\"originSize\":\"0.00001\",\"dealSize\":\"0\",\"remainSize\":\"0.00001\",\"canceledSize\":\"0\",\"status\":\"open\",\"matchTime\":1729173854326,\"success\":true},{\"success\":false,\"failMsg\":\"The order funds should more then 0.1 USDT.\"}]}"
        common_response = RestResponse.from_json(data)
        resp = BatchAddOrdersSyncResp.from_dict(common_response.data)

    def test_cancel_order_by_order_id_req_model(self):
        """
       cancel_order_by_order_id
       Cancel Order By OrderId
       /api/v1/hf/orders/{orderId}
       """
        data = "{\"orderId\": \"671124f9365ccb00073debd4\", \"symbol\": \"BTC-USDT\"}"
        req = CancelOrderByOrderIdReq.from_json(data)

    def test_cancel_order_by_order_id_resp_model(self):
        """
        cancel_order_by_order_id
        Cancel Order By OrderId
        /api/v1/hf/orders/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671124f9365ccb00073debd4\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByOrderIdResp.from_dict(common_response.data)

    def test_cancel_order_by_order_id_sync_req_model(self):
        """
       cancel_order_by_order_id_sync
       Cancel Order By OrderId Sync
       /api/v1/hf/orders/sync/{orderId}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderId\": \"671128ee365ccb0007534d45\"}"
        req = CancelOrderByOrderIdSyncReq.from_json(data)

    def test_cancel_order_by_order_id_sync_resp_model(self):
        """
        cancel_order_by_order_id_sync
        Cancel Order By OrderId Sync
        /api/v1/hf/orders/sync/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671128ee365ccb0007534d45\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByOrderIdSyncResp.from_dict(common_response.data)

    def test_cancel_order_by_client_oid_req_model(self):
        """
       cancel_order_by_client_oid
       Cancel Order By ClientOid
       /api/v1/hf/orders/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}"
        req = CancelOrderByClientOidReq.from_json(data)

    def test_cancel_order_by_client_oid_resp_model(self):
        """
        cancel_order_by_client_oid
        Cancel Order By ClientOid
        /api/v1/hf/orders/client-order/{clientOid}
        """
        data = "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e493fb\"}}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByClientOidResp.from_dict(common_response.data)

    def test_cancel_order_by_client_oid_sync_req_model(self):
        """
       cancel_order_by_client_oid_sync
       Cancel Order By ClientOid Sync
       /api/v1/hf/orders/sync/client-order/{clientOid}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}"
        req = CancelOrderByClientOidSyncReq.from_json(data)

    def test_cancel_order_by_client_oid_sync_resp_model(self):
        """
        cancel_order_by_client_oid_sync
        Cancel Order By ClientOid Sync
        /api/v1/hf/orders/sync/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"originSize\": \"0.00001\",\n        \"dealSize\": \"0\",\n        \"remainSize\": \"0\",\n        \"canceledSize\": \"0.00001\",\n        \"status\": \"done\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByClientOidSyncResp.from_dict(common_response.data)

    def test_cancel_partial_order_req_model(self):
        """
       cancel_partial_order
       Cancel Partial Order
       /api/v1/hf/orders/cancel/{orderId}
       """
        data = "{\"orderId\": \"6711f73c1ef16c000717bb31\", \"symbol\": \"BTC-USDT\", \"cancelSize\": \"0.00001\"}"
        req = CancelPartialOrderReq.from_json(data)

    def test_cancel_partial_order_resp_model(self):
        """
        cancel_partial_order
        Cancel Partial Order
        /api/v1/hf/orders/cancel/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"6711f73c1ef16c000717bb31\",\n        \"cancelSize\": \"0.00001\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelPartialOrderResp.from_dict(common_response.data)

    def test_cancel_all_orders_by_symbol_req_model(self):
        """
       cancel_all_orders_by_symbol
       Cancel All Orders By Symbol
       /api/v1/hf/orders
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = CancelAllOrdersBySymbolReq.from_json(data)

    def test_cancel_all_orders_by_symbol_resp_model(self):
        """
        cancel_all_orders_by_symbol
        Cancel All Orders By Symbol
        /api/v1/hf/orders
        """
        data = "{\"code\":\"200000\",\"data\":\"success\"}"
        common_response = RestResponse.from_json(data)
        resp = CancelAllOrdersBySymbolResp.from_dict(common_response.data)

    def test_cancel_all_orders_req_model(self):
        """
       cancel_all_orders
       Cancel All Orders
       /api/v1/hf/orders/cancelAll
       """

    def test_cancel_all_orders_resp_model(self):
        """
        cancel_all_orders
        Cancel All Orders
        /api/v1/hf/orders/cancelAll
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"succeedSymbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ],\n        \"failedSymbols\": []\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelAllOrdersResp.from_dict(common_response.data)

    def test_modify_order_req_model(self):
        """
       modify_order
       Modify Order
       /api/v1/hf/orders/alter
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderId\": \"670fd33bf9406e0007ab3945\", \"newPrice\": \"30000\", \"newSize\": \"0.0001\"}"
        req = ModifyOrderReq.from_json(data)

    def test_modify_order_resp_model(self):
        """
        modify_order
        Modify Order
        /api/v1/hf/orders/alter
        """
        data = "{\"code\":\"200000\",\"data\":{\"newOrderId\":\"67112258f9406e0007408827\",\"clientOid\":\"client order id 12\"}}"
        common_response = RestResponse.from_json(data)
        resp = ModifyOrderResp.from_dict(common_response.data)

    def test_get_order_by_order_id_req_model(self):
        """
       get_order_by_order_id
       Get Order By OrderId
       /api/v1/hf/orders/{orderId}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderId\": \"6717422bd51c29000775ea03\"}"
        req = GetOrderByOrderIdReq.from_json(data)

    def test_get_order_by_order_id_resp_model(self):
        """
        get_order_by_order_id
        Get Order By OrderId
        /api/v1/hf/orders/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByOrderIdResp.from_dict(common_response.data)

    def test_get_order_by_client_oid_req_model(self):
        """
       get_order_by_client_oid
       Get Order By ClientOid
       /api/v1/hf/orders/client-order/{clientOid}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"5c52e11203aa677f33e493fb\"}"
        req = GetOrderByClientOidReq.from_json(data)

    def test_get_order_by_client_oid_resp_model(self):
        """
        get_order_by_client_oid
        Get Order By ClientOid
        /api/v1/hf/orders/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"6717422bd51c29000775ea03\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"70000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.7\",\n        \"dealSize\": \"0.00001\",\n        \"dealFunds\": \"0.677176\",\n        \"remainSize\": \"0\",\n        \"remainFunds\": \"0.022824\",\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"fee\": \"0.000677176\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"remark\": \"order remarks\",\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"tradeType\": \"TRADE\",\n        \"inOrderBook\": false,\n        \"active\": false,\n        \"tax\": \"0\",\n        \"createdAt\": 1729577515444,\n        \"lastUpdatedAt\": 1729577515481\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByClientOidResp.from_dict(common_response.data)

    def test_get_symbols_with_open_order_req_model(self):
        """
       get_symbols_with_open_order
       Get Symbols With Open Order
       /api/v1/hf/orders/active/symbols
       """

    def test_get_symbols_with_open_order_resp_model(self):
        """
        get_symbols_with_open_order
        Get Symbols With Open Order
        /api/v1/hf/orders/active/symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbols\": [\n            \"ETH-USDT\",\n            \"BTC-USDT\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetSymbolsWithOpenOrderResp.from_dict(common_response.data)

    def test_get_open_orders_req_model(self):
        """
       get_open_orders
       Get Open Orders
       /api/v1/hf/orders/active
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetOpenOrdersReq.from_json(data)

    def test_get_open_orders_resp_model(self):
        """
        get_open_orders
        Get Open Orders
        /api/v1/hf/orders/active
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"67120bbef094e200070976f6\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": \"order remarks\",\n            \"tags\": \"order tags\",\n            \"cancelExist\": false,\n            \"tradeType\": \"TRADE\",\n            \"inOrderBook\": true,\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"tax\": \"0\",\n            \"active\": true,\n            \"createdAt\": 1729235902748,\n            \"lastUpdatedAt\": 1729235909862\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOpenOrdersResp.from_dict(common_response.data)

    def test_get_open_orders_by_page_req_model(self):
        """
       get_open_orders_by_page
       Get Open Orders By Page
       /api/v1/hf/orders/active/page
       """
        data = "{\"symbol\": \"BTC-USDT\", \"pageNum\": 1, \"pageSize\": 20}"
        req = GetOpenOrdersByPageReq.from_json(data)

    def test_get_open_orders_by_page_resp_model(self):
        """
        get_open_orders_by_page
        Get Open Orders By Page
        /api/v1/hf/orders/active/page
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 20,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"67c1437ea5226600071cc080\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"createdAt\": 1740718974367,\n                \"lastUpdatedAt\": 1741867658590,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": true,\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"remainSize\": \"0.00001\",\n                \"remainFunds\": \"0.5\",\n                \"tax\": \"0\",\n                \"active\": true\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOpenOrdersByPageResp.from_dict(common_response.data)

    def test_get_closed_orders_req_model(self):
        """
       get_closed_orders
       Get Closed Orders
       /api/v1/hf/orders/done
       """
        data = "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
        req = GetClosedOrdersReq.from_json(data)

    def test_get_closed_orders_resp_model(self):
        """
        get_closed_orders
        Get Closed Orders
        /api/v1/hf/orders/done
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 19814995255305,\n        \"items\": [\n            {\n                \"id\": \"6717422bd51c29000775ea03\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"70000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.7\",\n                \"dealSize\": \"0.00001\",\n                \"dealFunds\": \"0.677176\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0.022824\",\n                \"cancelledSize\": \"0\",\n                \"cancelledFunds\": \"0\",\n                \"fee\": \"0.000677176\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"cancelExist\": false,\n                \"tradeType\": \"TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515444,\n                \"lastUpdatedAt\": 1729577515481\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetClosedOrdersResp.from_dict(common_response.data)

    def test_get_trade_history_req_model(self):
        """
       get_trade_history
       Get Trade History
       /api/v1/hf/fills
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
        req = GetTradeHistoryReq.from_json(data)

    def test_get_trade_history_resp_model(self):
        """
        get_trade_history
        Get Trade History
        /api/v1/hf/fills
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 19814995255305,\n                \"orderId\": \"6717422bd51c29000775ea03\",\n                \"counterOrderId\": \"67174228135f9e000709da8c\",\n                \"tradeId\": 11029373945659392,\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"type\": \"limit\",\n                \"forceTaker\": false,\n                \"price\": \"67717.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.677176\",\n                \"fee\": \"0.000677176\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"taxRate\": \"0\",\n                \"tax\": \"0\",\n                \"createdAt\": 1729577515473\n            }\n        ],\n        \"lastId\": 19814995255305\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetTradeHistoryResp.from_dict(common_response.data)

    def test_get_dcp_req_model(self):
        """
       get_dcp
       Get DCP
       /api/v1/hf/orders/dead-cancel-all/query
       """

    def test_get_dcp_resp_model(self):
        """
        get_dcp
        Get DCP
        /api/v1/hf/orders/dead-cancel-all/query
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timeout\": 5,\n        \"symbols\": \"BTC-USDT,ETH-USDT\",\n        \"currentTime\": 1729241305,\n        \"triggerTime\": 1729241308\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetDcpResp.from_dict(common_response.data)

    def test_set_dcp_req_model(self):
        """
       set_dcp
       Set DCP
       /api/v1/hf/orders/dead-cancel-all
       """
        data = "{\"timeout\": 5, \"symbols\": \"BTC-USDT,ETH-USDT\"}"
        req = SetDcpReq.from_json(data)

    def test_set_dcp_resp_model(self):
        """
        set_dcp
        Set DCP
        /api/v1/hf/orders/dead-cancel-all
        """
        data = "{\"code\":\"200000\",\"data\":{\"currentTime\":1729656588,\"triggerTime\":1729656593}}"
        common_response = RestResponse.from_json(data)
        resp = SetDcpResp.from_dict(common_response.data)

    def test_add_stop_order_req_model(self):
        """
       add_stop_order
       Add Stop Order
       /api/v1/stop-order
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"stopPrice\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddStopOrderReq.from_json(data)

    def test_add_stop_order_resp_model(self):
        """
        add_stop_order
        Add Stop Order
        /api/v1/stop-order
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"670fd33bf9406e0007ab3945\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddStopOrderResp.from_dict(common_response.data)

    def test_cancel_stop_order_by_client_oid_req_model(self):
        """
       cancel_stop_order_by_client_oid
       Cancel Stop Order By ClientOid
       /api/v1/stop-order/cancelOrderByClientOid
       """
        data = "{\"symbol\": \"BTC-USDT\", \"clientOid\": \"689ff597f4414061aa819cc414836abd\"}"
        req = CancelStopOrderByClientOidReq.from_json(data)

    def test_cancel_stop_order_by_client_oid_resp_model(self):
        """
        cancel_stop_order_by_client_oid
        Cancel Stop Order By ClientOid
        /api/v1/stop-order/cancelOrderByClientOid
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"vs8hoo8ksc8mario0035a74n\",\n        \"clientOid\": \"689ff597f4414061aa819cc414836abd\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelStopOrderByClientOidResp.from_dict(common_response.data)

    def test_cancel_stop_order_by_order_id_req_model(self):
        """
       cancel_stop_order_by_order_id
       Cancel Stop Order By OrderId
       /api/v1/stop-order/{orderId}
       """
        data = "{\"orderId\": \"671124f9365ccb00073debd4\"}"
        req = CancelStopOrderByOrderIdReq.from_json(data)

    def test_cancel_stop_order_by_order_id_resp_model(self):
        """
        cancel_stop_order_by_order_id
        Cancel Stop Order By OrderId
        /api/v1/stop-order/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelStopOrderByOrderIdResp.from_dict(common_response.data)

    def test_batch_cancel_stop_order_req_model(self):
        """
       batch_cancel_stop_order
       Batch Cancel Stop Orders
       /api/v1/stop-order/cancel
       """
        data = "{\"symbol\": \"example_string_default_value\", \"tradeType\": \"example_string_default_value\", \"orderIds\": \"example_string_default_value\"}"
        req = BatchCancelStopOrderReq.from_json(data)

    def test_batch_cancel_stop_order_resp_model(self):
        """
        batch_cancel_stop_order
        Batch Cancel Stop Orders
        /api/v1/stop-order/cancel
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"671124f9365ccb00073debd4\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = BatchCancelStopOrderResp.from_dict(common_response.data)

    def test_get_stop_orders_list_req_model(self):
        """
       get_stop_orders_list
       Get Stop Orders List
       /api/v1/stop-order
       """
        data = "{\"symbol\": \"example_string_default_value\", \"side\": \"example_string_default_value\", \"type\": \"limit\", \"tradeType\": \"example_string_default_value\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"stop\": \"example_string_default_value\"}"
        req = GetStopOrdersListReq.from_json(data)

    def test_get_stop_orders_list_resp_model(self):
        """
        get_stop_orders_list
        Get Stop Orders List
        /api/v1/stop-order
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 2,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"vs93gptvr9t2fsql003l8k5p\",\n                \"symbol\": \"BTC-USDT\",\n                \"userId\": \"633559791e1cbc0001f319bc\",\n                \"status\": \"NEW\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000.00000000000000000000\",\n                \"size\": \"0.00001000000000000000\",\n                \"funds\": null,\n                \"stp\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": -1,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f222233e493fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"relatedNo\": null,\n                \"orderTime\": 1740626554883000024,\n                \"domainId\": \"kucoin\",\n                \"tradeSource\": \"USER\",\n                \"tradeType\": \"TRADE\",\n                \"feeCurrency\": \"USDT\",\n                \"takerFeeRate\": \"0.00100000000000000000\",\n                \"makerFeeRate\": \"0.00100000000000000000\",\n                \"createdAt\": 1740626554884,\n                \"stop\": \"loss\",\n                \"stopTriggerTime\": null,\n                \"stopPrice\": \"60000.00000000000000000000\",\n                \"limitPrice\": null,\n                \"pop\": null,\n                \"activateCondition\": null\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetStopOrdersListResp.from_dict(common_response.data)

    def test_get_stop_order_by_order_id_req_model(self):
        """
       get_stop_order_by_order_id
       Get Stop Order By OrderId
       /api/v1/stop-order/{orderId}
       """
        data = "{\"orderId\": \"example_string_default_value\"}"
        req = GetStopOrderByOrderIdReq.from_json(data)

    def test_get_stop_order_by_order_id_resp_model(self):
        """
        get_stop_order_by_order_id
        Get Stop Order By OrderId
        /api/v1/stop-order/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"vs8hoo8q2ceshiue003b67c0\",\n        \"symbol\": \"KCS-USDT\",\n        \"userId\": \"60fe4956c43cbc0006562c2c\",\n        \"status\": \"NEW\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"0.01000000000000000000\",\n        \"size\": \"0.01000000000000000000\",\n        \"funds\": null,\n        \"stp\": null,\n        \"timeInForce\": \"GTC\",\n        \"cancelAfter\": -1,\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": null,\n        \"channel\": \"API\",\n        \"clientOid\": \"40e0eb9efe6311eb8e58acde48001122\",\n        \"remark\": null,\n        \"tags\": null,\n        \"orderTime\": 1629098781127530200,\n        \"domainId\": \"kucoin\",\n        \"tradeSource\": \"USER\",\n        \"tradeType\": \"TRADE\",\n        \"feeCurrency\": \"USDT\",\n        \"takerFeeRate\": \"0.00200000000000000000\",\n        \"makerFeeRate\": \"0.00200000000000000000\",\n        \"createdAt\": 1629098781128,\n        \"stop\": \"loss\",\n        \"stopTriggerTime\": null,\n        \"stopPrice\": \"10.00000000000000000000\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetStopOrderByOrderIdResp.from_dict(common_response.data)

    def test_get_stop_order_by_client_oid_req_model(self):
        """
       get_stop_order_by_client_oid
       Get Stop Order By ClientOid
       /api/v1/stop-order/queryOrderByClientOid
       """
        data = "{\"clientOid\": \"example_string_default_value\", \"symbol\": \"example_string_default_value\"}"
        req = GetStopOrderByClientOidReq.from_json(data)

    def test_get_stop_order_by_client_oid_resp_model(self):
        """
        get_stop_order_by_client_oid
        Get Stop Order By ClientOid
        /api/v1/stop-order/queryOrderByClientOid
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"vs8hoo8os561f5np0032vngj\",\n            \"symbol\": \"KCS-USDT\",\n            \"userId\": \"60fe4956c43cbc0006562c2c\",\n            \"status\": \"NEW\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"0.01000000000000000000\",\n            \"size\": \"0.01000000000000000000\",\n            \"funds\": null,\n            \"stp\": null,\n            \"timeInForce\": \"GTC\",\n            \"cancelAfter\": -1,\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": null,\n            \"channel\": \"API\",\n            \"clientOid\": \"2b700942b5db41cebe578cff48960e09\",\n            \"remark\": null,\n            \"tags\": null,\n            \"orderTime\": 1629020492834532600,\n            \"domainId\": \"kucoin\",\n            \"tradeSource\": \"USER\",\n            \"tradeType\": \"TRADE\",\n            \"feeCurrency\": \"USDT\",\n            \"takerFeeRate\": \"0.00200000000000000000\",\n            \"makerFeeRate\": \"0.00200000000000000000\",\n            \"createdAt\": 1629020492837,\n            \"stop\": \"loss\",\n            \"stopTriggerTime\": null,\n            \"stopPrice\": \"1.00000000000000000000\"\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetStopOrderByClientOidResp.from_dict(common_response.data)

    def test_add_oco_order_req_model(self):
        """
       add_oco_order
       Add OCO Order
       /api/v3/oco/order
       """
        data = "{\"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"94000\", \"size\": \"0.1\", \"clientOid\": \"5c52e11203aa67f1e493fb\", \"stopPrice\": \"98000\", \"limitPrice\": \"96000\", \"remark\": \"this is remark\", \"tradeType\": \"TRADE\"}"
        req = AddOcoOrderReq.from_json(data)

    def test_add_oco_order_resp_model(self):
        """
        add_oco_order
        Add OCO Order
        /api/v3/oco/order
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"674c316e688dea0007c7b986\"}}"
        common_response = RestResponse.from_json(data)
        resp = AddOcoOrderResp.from_dict(common_response.data)

    def test_cancel_oco_order_by_order_id_req_model(self):
        """
       cancel_oco_order_by_order_id
       Cancel OCO Order By OrderId
       /api/v3/oco/order/{orderId}
       """
        data = "{\"orderId\": \"674c316e688dea0007c7b986\"}"
        req = CancelOcoOrderByOrderIdReq.from_json(data)

    def test_cancel_oco_order_by_order_id_resp_model(self):
        """
        cancel_oco_order_by_order_id
        Cancel OCO Order By OrderId
        /api/v3/oco/order/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6kkmkk57003gok16\",\n            \"vs93gpqc6kkmkk57003gok17\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOcoOrderByOrderIdResp.from_dict(common_response.data)

    def test_cancel_oco_order_by_client_oid_req_model(self):
        """
       cancel_oco_order_by_client_oid
       Cancel OCO Order By ClientOid
       /api/v3/oco/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e11203aa67f1e493fb\"}"
        req = CancelOcoOrderByClientOidReq.from_json(data)

    def test_cancel_oco_order_by_client_oid_resp_model(self):
        """
        cancel_oco_order_by_client_oid
        Cancel OCO Order By ClientOid
        /api/v3/oco/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc6r0mkk57003gok3h\",\n            \"vs93gpqc6r0mkk57003gok3i\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOcoOrderByClientOidResp.from_dict(common_response.data)

    def test_batch_cancel_oco_orders_req_model(self):
        """
       batch_cancel_oco_orders
       Batch Cancel OCO Order
       /api/v3/oco/orders
       """
        data = "{\"orderIds\": \"674c388172cf2800072ee746,674c38bdfd8300000795167e\", \"symbol\": \"BTC-USDT\"}"
        req = BatchCancelOcoOrdersReq.from_json(data)

    def test_batch_cancel_oco_orders_resp_model(self):
        """
        batch_cancel_oco_orders
        Batch Cancel OCO Order
        /api/v3/oco/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"vs93gpqc750mkk57003gok6i\",\n            \"vs93gpqc750mkk57003gok6j\",\n            \"vs93gpqc75c39p83003tnriu\",\n            \"vs93gpqc75c39p83003tnriv\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = BatchCancelOcoOrdersResp.from_dict(common_response.data)

    def test_get_oco_order_by_order_id_req_model(self):
        """
       get_oco_order_by_order_id
       Get OCO Order By OrderId
       /api/v3/oco/order/{orderId}
       """
        data = "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}"
        req = GetOcoOrderByOrderIdReq.from_json(data)

    def test_get_oco_order_by_order_id_resp_model(self):
        """
        get_oco_order_by_order_id
        Get OCO Order By OrderId
        /api/v3/oco/order/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOcoOrderByOrderIdResp.from_dict(common_response.data)

    def test_get_oco_order_by_client_oid_req_model(self):
        """
       get_oco_order_by_client_oid
       Get OCO Order By ClientOid
       /api/v3/oco/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e1203aa6f3g7f1e493fb\"}"
        req = GetOcoOrderByClientOidReq.from_json(data)

    def test_get_oco_order_by_client_oid_resp_model(self):
        """
        get_oco_order_by_client_oid
        Get OCO Order By ClientOid
        /api/v3/oco/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n        \"orderTime\": 1733049594803,\n        \"status\": \"NEW\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOcoOrderByClientOidResp.from_dict(common_response.data)

    def test_get_oco_order_detail_by_order_id_req_model(self):
        """
       get_oco_order_detail_by_order_id
       Get OCO Order Detail By OrderId
       /api/v3/oco/order/details/{orderId}
       """
        data = "{\"orderId\": \"674c3b6e688dea0007c7bab2\"}"
        req = GetOcoOrderDetailByOrderIdReq.from_json(data)

    def test_get_oco_order_detail_by_order_id_resp_model(self):
        """
        get_oco_order_detail_by_order_id
        Get OCO Order Detail By OrderId
        /api/v3/oco/order/details/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674c3b6e688dea0007c7bab2\",\n        \"symbol\": \"BTC-USDT\",\n        \"clientOid\": \"5c52e1203aa6f37f1e493fb\",\n        \"orderTime\": 1733049198863,\n        \"status\": \"NEW\",\n        \"orders\": [\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelj\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"94000.00000000000000000000\",\n                \"stopPrice\": \"94000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            },\n            {\n                \"id\": \"vs93gpqc7dn6h3fa003sfelk\",\n                \"symbol\": \"BTC-USDT\",\n                \"side\": \"buy\",\n                \"price\": \"96000.00000000000000000000\",\n                \"stopPrice\": \"98000.00000000000000000000\",\n                \"size\": \"0.10000000000000000000\",\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOcoOrderDetailByOrderIdResp.from_dict(common_response.data)

    def test_get_oco_order_list_req_model(self):
        """
       get_oco_order_list
       Get OCO Order List
       /api/v3/oco/orders
       """
        data = "{\"symbol\": \"BTC-USDT\", \"startAt\": 123456, \"endAt\": 123456, \"orderIds\": \"example_string_default_value\", \"pageSize\": 50, \"currentPage\": 1}"
        req = GetOcoOrderListReq.from_json(data)

    def test_get_oco_order_list_resp_model(self):
        """
        get_oco_order_list
        Get OCO Order List
        /api/v3/oco/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"orderId\": \"674c3cfa72cf2800072ee7ce\",\n                \"symbol\": \"BTC-USDT\",\n                \"clientOid\": \"5c52e1203aa6f3g7f1e493fb\",\n                \"orderTime\": 1733049594803,\n                \"status\": \"NEW\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOcoOrderListResp.from_dict(common_response.data)

    def test_add_order_old_req_model(self):
        """
       add_order_old
       Add Order - Old
       /api/v1/orders
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddOrderOldReq.from_json(data)

    def test_add_order_old_resp_model(self):
        """
        add_order_old
        Add Order - Old
        /api/v1/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8635b38d120007709c0f\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderOldResp.from_dict(common_response.data)

    def test_add_order_test_old_req_model(self):
        """
       add_order_test_old
       Add Order Test - Old
       /api/v1/orders/test
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddOrderTestOldReq.from_json(data)

    def test_add_order_test_old_resp_model(self):
        """
        add_order_test_old
        Add Order Test - Old
        /api/v1/orders/test
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"674a8776291d9e00074f1edf\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderTestOldResp.from_dict(common_response.data)

    def test_batch_add_orders_old_req_model(self):
        """
       batch_add_orders_old
       Batch Add Orders - Old
       /api/v1/orders/multi
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderList\": [{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"50000\", \"size\": \"0.0001\"}, {\"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\", \"side\": \"buy\", \"type\": \"limit\", \"price\": \"49999\", \"size\": \"0.0001\"}]}"
        req = BatchAddOrdersOldReq.from_json(data)

    def test_batch_add_orders_old_resp_model(self):
        """
        batch_add_orders_old
        Batch Add Orders - Old
        /api/v1/orders/multi
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"data\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dfef434f0007efc431\",\n                \"status\": \"success\",\n                \"failMsg\": null,\n                \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"\n            },\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"49999\",\n                \"size\": \"0.0001\",\n                \"funds\": null,\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopPrice\": null,\n                \"timeInForce\": \"GTC\",\n                \"cancelAfter\": 0,\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberge\": false,\n                \"iceberg\": false,\n                \"visibleSize\": null,\n                \"channel\": \"API\",\n                \"id\": \"674a97dffb378b00077b9c20\",\n                \"status\": \"fail\",\n                \"failMsg\": \"Balance insufficient!\",\n                \"clientOid\": \"37245dbe6e134b5c97732bfb36cd4a9d\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = BatchAddOrdersOldResp.from_dict(common_response.data)

    def test_cancel_order_by_order_id_old_req_model(self):
        """
       cancel_order_by_order_id_old
       Cancel Order By OrderId - Old
       /api/v1/orders/{orderId}
       """
        data = "{\"orderId\": \"674a97dfef434f0007efc431\"}"
        req = CancelOrderByOrderIdOldReq.from_json(data)

    def test_cancel_order_by_order_id_old_resp_model(self):
        """
        cancel_order_by_order_id_old
        Cancel Order By OrderId - Old
        /api/v1/orders/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a97dfef434f0007efc431\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByOrderIdOldResp.from_dict(common_response.data)

    def test_cancel_order_by_client_oid_old_req_model(self):
        """
       cancel_order_by_client_oid_old
       Cancel Order By ClientOid - Old
       /api/v1/order/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e11203aa677f331e493fb\"}"
        req = CancelOrderByClientOidOldReq.from_json(data)

    def test_cancel_order_by_client_oid_old_resp_model(self):
        """
        cancel_order_by_client_oid_old
        Cancel Order By ClientOid - Old
        /api/v1/order/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderId\": \"67c3252a63d25e0007f91de9\",\n        \"clientOid\": \"5c52e11203aa677f331e493fb\",\n        \"cancelledOcoOrderIds\": null\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByClientOidOldResp.from_dict(common_response.data)

    def test_batch_cancel_order_old_req_model(self):
        """
       batch_cancel_order_old
       Batch Cancel Order - Old
       /api/v1/orders
       """
        data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"TRADE\"}"
        req = BatchCancelOrderOldReq.from_json(data)

    def test_batch_cancel_order_old_resp_model(self):
        """
        batch_cancel_order_old
        Batch Cancel Order - Old
        /api/v1/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"cancelledOrderIds\": [\n            \"674a8635b38d120007709c0f\",\n            \"674a8630439c100007d3bce1\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = BatchCancelOrderOldResp.from_dict(common_response.data)

    def test_get_orders_list_old_req_model(self):
        """
       get_orders_list_old
       Get Orders List - Old
       /api/v1/orders
       """
        data = "{\"symbol\": \"BTC-USDT\", \"status\": \"active\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 123456, \"endAt\": 123456, \"currentPage\": 1, \"pageSize\": 50}"
        req = GetOrdersListOldReq.from_json(data)

    def test_get_orders_list_old_resp_model(self):
        """
        get_orders_list_old
        Get Orders List - Old
        /api/v1/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"674a9a872033a50007e2790d\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0\",\n                \"dealFunds\": \"0\",\n                \"dealSize\": \"0\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": \"\",\n                \"stop\": \"\",\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n                \"remark\": \"order remarks\",\n                \"tags\": null,\n                \"isActive\": false,\n                \"cancelExist\": true,\n                \"createdAt\": 1732942471752,\n                \"tradeType\": \"TRADE\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrdersListOldResp.from_dict(common_response.data)

    def test_get_recent_orders_list_old_req_model(self):
        """
       get_recent_orders_list_old
       Get Recent Orders List - Old
       /api/v1/limit/orders
       """

    def test_get_recent_orders_list_old_resp_model(self):
        """
        get_recent_orders_list_old
        Get Recent Orders List - Old
        /api/v1/limit/orders
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"674a9a872033a50007e2790d\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0\",\n            \"dealFunds\": \"0\",\n            \"dealSize\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": \"\",\n            \"stop\": \"\",\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"clientOid\": \"5c52e11203aa677f33e4923fb\",\n            \"remark\": \"order remarks\",\n            \"tags\": null,\n            \"isActive\": false,\n            \"cancelExist\": true,\n            \"createdAt\": 1732942471752,\n            \"tradeType\": \"TRADE\"\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetRecentOrdersListOldResp.from_dict(common_response.data)

    def test_get_order_by_order_id_old_req_model(self):
        """
       get_order_by_order_id_old
       Get Order By OrderId - Old
       /api/v1/orders/{orderId}
       """
        data = "{\"orderId\": \"674a97dfef434f0007efc431\"}"
        req = GetOrderByOrderIdOldReq.from_json(data)

    def test_get_order_by_order_id_old_resp_model(self):
        """
        get_order_by_order_id_old
        Get Order By OrderId - Old
        /api/v1/orders/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByOrderIdOldResp.from_dict(common_response.data)

    def test_get_order_by_client_oid_old_req_model(self):
        """
       get_order_by_client_oid_old
       Get Order By ClientOid - Old
       /api/v1/order/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\"}"
        req = GetOrderByClientOidOldReq.from_json(data)

    def test_get_order_by_client_oid_old_resp_model(self):
        """
        get_order_by_client_oid_old
        Get Order By ClientOid - Old
        /api/v1/order/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"674a97dfef434f0007efc431\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.0001\",\n        \"funds\": \"0\",\n        \"dealFunds\": \"0\",\n        \"dealSize\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": \"\",\n        \"stop\": \"\",\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"3d07008668054da6b3cb12e432c2b13a\",\n        \"remark\": null,\n        \"tags\": null,\n        \"isActive\": false,\n        \"cancelExist\": true,\n        \"createdAt\": 1732941791518,\n        \"tradeType\": \"TRADE\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByClientOidOldResp.from_dict(common_response.data)

    def test_get_trade_history_old_req_model(self):
        """
       get_trade_history_old
       Get Trade History - Old
       /api/v1/fills
       """
        data = "{\"symbol\": \"BTC-USDT\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"tradeType\": \"TRADE\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}"
        req = GetTradeHistoryOldReq.from_json(data)

    def test_get_trade_history_old_resp_model(self):
        """
        get_trade_history_old
        Get Trade History - Old
        /api/v1/fills
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"symbol\": \"DOGE-USDT\",\n                \"tradeId\": \"10862827223795713\",\n                \"orderId\": \"6745698ef4f1200007c561a8\",\n                \"counterOrderId\": \"6745695ef15b270007ac5076\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"0.40739\",\n                \"size\": \"10\",\n                \"funds\": \"4.0739\",\n                \"fee\": \"0.0040739\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"TRADE\",\n                \"type\": \"market\",\n                \"createdAt\": 1732602254928\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetTradeHistoryOldResp.from_dict(common_response.data)

    def test_get_recent_trade_history_old_req_model(self):
        """
       get_recent_trade_history_old
       Get Recent Trade History - Old
       /api/v1/limit/fills
       """

    def test_get_recent_trade_history_old_resp_model(self):
        """
        get_recent_trade_history_old
        Get Recent Trade History - Old
        /api/v1/limit/fills
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"tradeId\": \"11732720444522497\",\n            \"orderId\": \"674aab24754b1e00077dbc69\",\n            \"counterOrderId\": \"674aab1fb26bfb0007a18b67\",\n            \"side\": \"buy\",\n            \"liquidity\": \"taker\",\n            \"forceTaker\": false,\n            \"price\": \"96999.6\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.969996\",\n            \"fee\": \"0.000969996\",\n            \"feeRate\": \"0.001\",\n            \"feeCurrency\": \"USDT\",\n            \"stop\": \"\",\n            \"tradeType\": \"TRADE\",\n            \"type\": \"limit\",\n            \"createdAt\": 1732946724082\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetRecentTradeHistoryOldResp.from_dict(common_response.data)
