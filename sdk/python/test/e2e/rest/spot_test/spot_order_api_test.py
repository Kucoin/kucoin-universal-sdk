import os
import unittest
import uuid

from kucoin_universal_sdk.api.client import DefaultClient
from kucoin_universal_sdk.extension.interceptor.logging import LoggingInterceptor
from kucoin_universal_sdk.generate.spot.order import CancelOrderByClientOidOldReqBuilder, GetOpenOrdersByPageReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_add_oco_order_req import AddOcoOrderReqBuilder, AddOcoOrderReq
from kucoin_universal_sdk.generate.spot.order.model_add_order_old_req import AddOrderOldReqBuilder, AddOrderOldReq
from kucoin_universal_sdk.generate.spot.order.model_add_order_req import AddOrderReqBuilder, AddOrderReq
from kucoin_universal_sdk.generate.spot.order.model_add_order_sync_req import AddOrderSyncReqBuilder, AddOrderSyncReq
from kucoin_universal_sdk.generate.spot.order.model_add_order_test_old_req import AddOrderTestOldReqBuilder, \
    AddOrderTestOldReq
from kucoin_universal_sdk.generate.spot.order.model_add_order_test_req import AddOrderTestReqBuilder, AddOrderTestReq
from kucoin_universal_sdk.generate.spot.order.model_add_stop_order_req import AddStopOrderReqBuilder, AddStopOrderReq
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_old_order_list import \
    BatchAddOrdersOldOrderListBuilder, BatchAddOrdersOldOrderList
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_old_req import BatchAddOrdersOldReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_order_list import BatchAddOrdersOrderListBuilder, \
    BatchAddOrdersOrderList
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_req import BatchAddOrdersReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_sync_order_list import \
    BatchAddOrdersSyncOrderListBuilder, BatchAddOrdersSyncOrderList
from kucoin_universal_sdk.generate.spot.order.model_batch_add_orders_sync_req import BatchAddOrdersSyncReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_batch_cancel_oco_orders_req import BatchCancelOcoOrdersReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_batch_cancel_order_old_req import BatchCancelOrderOldReqBuilder, \
    BatchCancelOrderOldReq
from kucoin_universal_sdk.generate.spot.order.model_batch_cancel_stop_order_req import BatchCancelStopOrderReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_all_orders_by_symbol_req import \
    CancelAllOrdersBySymbolReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_oco_order_by_client_oid_req import \
    CancelOcoOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_oco_order_by_order_id_req import \
    CancelOcoOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_order_by_client_oid_req import \
    CancelOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_order_by_client_oid_sync_req import \
    CancelOrderByClientOidSyncReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_order_by_order_id_old_req import \
    CancelOrderByOrderIdOldReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_order_by_order_id_req import CancelOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_order_by_order_id_sync_req import \
    CancelOrderByOrderIdSyncReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_partial_order_req import CancelPartialOrderReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_stop_order_by_client_oid_req import \
    CancelStopOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_cancel_stop_order_by_order_id_req import \
    CancelStopOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_closed_orders_req import GetClosedOrdersReqBuilder, \
    GetClosedOrdersReq
from kucoin_universal_sdk.generate.spot.order.model_get_oco_order_by_client_oid_req import \
    GetOcoOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_oco_order_by_order_id_req import GetOcoOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_oco_order_detail_by_order_id_req import \
    GetOcoOrderDetailByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_oco_order_list_req import GetOcoOrderListReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_open_orders_req import GetOpenOrdersReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_order_by_client_oid_old_req import \
    GetOrderByClientOidOldReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_order_by_client_oid_req import GetOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_order_by_order_id_old_req import GetOrderByOrderIdOldReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_order_by_order_id_req import GetOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_orders_list_old_req import GetOrdersListOldReqBuilder, \
    GetOrdersListOldReq
from kucoin_universal_sdk.generate.spot.order.model_get_stop_order_by_client_oid_req import \
    GetStopOrderByClientOidReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_stop_order_by_order_id_req import \
    GetStopOrderByOrderIdReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_get_stop_orders_list_req import GetStopOrdersListReqBuilder, \
    GetStopOrdersListReq
from kucoin_universal_sdk.generate.spot.order.model_get_trade_history_old_req import GetTradeHistoryOldReqBuilder, \
    GetTradeHistoryOldReq
from kucoin_universal_sdk.generate.spot.order.model_get_trade_history_req import GetTradeHistoryReqBuilder, \
    GetTradeHistoryReq
from kucoin_universal_sdk.generate.spot.order.model_modify_order_req import ModifyOrderReqBuilder
from kucoin_universal_sdk.generate.spot.order.model_set_dcp_req import SetDcpReqBuilder
from kucoin_universal_sdk.model.client_option import ClientOptionBuilder
from kucoin_universal_sdk.model.constants import GLOBAL_API_ENDPOINT, GLOBAL_BROKER_API_ENDPOINT, \
    GLOBAL_FUTURES_API_ENDPOINT
from kucoin_universal_sdk.model.transport_option import TransportOptionBuilder


class SpotApiTest(unittest.TestCase):
    def setUp(self):
        key = os.getenv("API_KEY")
        secret = os.getenv("API_SECRET")
        passphrase = os.getenv("API_PASSPHRASE")

        # create http transport option
        http_transport_option = (
            TransportOptionBuilder()
            .set_interceptors([LoggingInterceptor()])
            .build()
        )

        # create client option
        client_option = (
            ClientOptionBuilder()
            .set_key(key)
            .set_secret(secret)
            .set_passphrase(passphrase)
            .set_spot_endpoint(GLOBAL_API_ENDPOINT)
            .set_futures_endpoint(GLOBAL_FUTURES_API_ENDPOINT)
            .set_broker_endpoint(GLOBAL_BROKER_API_ENDPOINT)
            .set_transport_option(http_transport_option)
            .build()
        )

        # create API client
        client = DefaultClient(client_option)
        kucoin_rest_api = client.rest_service()
        self.api = kucoin_rest_api.get_spot_service().get_order_api()

    def test_get_trade_history_old_req(self):
        """
            get_trade_history_old
            Get Trade History - Old
            /api/v1/fills
        """

        builder = GetTradeHistoryOldReqBuilder()
        builder.set_symbol("DOGE-USDT").set_side(GetTradeHistoryOldReq.SideEnum.BUY).set_type(
            GetTradeHistoryOldReq.TypeEnum.LIMIT).set_trade_type(
            GetTradeHistoryOldReq.TradeTypeEnum.TRADE).set_start_at(1733068800000).set_end_at(
            1733155200000).set_current_page(1).set_page_size(10)
        req = builder.build()
        try:
            resp = self.api.get_trade_history_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_trade_history_req(self):
        """
            get_trade_history
            Get Trade History
            /api/v1/hf/fills
        """

        builder = GetTradeHistoryReqBuilder()
        builder.set_symbol("DOGE-USDT").set_side(GetTradeHistoryReq.SideEnum.BUY)
        req = builder.build()
        try:
            resp = self.api.get_trade_history(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_open_orders_req(self):
        """
            get_open_orders
            Get Open Orders
            /api/v1/hf/orders/active
        """

        builder = GetOpenOrdersReqBuilder()
        builder.set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.get_open_orders(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_symbols_with_open_order_req(self):
        """
            get_symbols_with_open_order
            Get Symbols With Open Order
            /api/v1/hf/orders/active/symbols
        """

        try:
            resp = self.api.get_symbols_with_open_order()
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_modify_order_req(self):
        """
            modify_order
            Modify Order
            /api/v1/hf/orders/alter
        """

        builder = ModifyOrderReqBuilder()
        builder.set_client_oid("463f0c43-4117-4dad-9f72-11eeda5150c8").set_symbol("BTC-USDT").set_order_id(
            "6746946b68486d0007779687").set_new_price("9800").set_new_size("0.001")
        req = builder.build()
        try:
            resp = self.api.modify_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_all_orders_req(self):
        """
            cancel_all_orders
            Cancel All Orders
            /api/v1/hf/orders/cancelAll
        """

        try:
            resp = self.api.cancel_all_orders()
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_partial_order_req(self):
        """
            cancel_partial_order
            Cancel Partial Order
            /api/v1/hf/orders/cancel/{orderId}
        """

        builder = CancelPartialOrderReqBuilder()
        builder.set_order_id("674694be0d855300070e1ae3").set_symbol("BTC-USDT").set_cancel_size("0.0001")
        req = builder.build()
        try:
            resp = self.api.cancel_partial_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_client_oid_req(self):
        """
            cancel_order_by_client_oid
            Cancel Order By ClientOid
            /api/v1/hf/orders/client-order/{clientOid}
        """

        builder = CancelOrderByClientOidReqBuilder()
        builder.set_client_oid("93eab1c8-527d-419a-80d1-54cec27f84ba").set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_order_by_client_oid_req(self):
        """
            get_order_by_client_oid
            Get Order By ClientOid
            /api/v1/hf/orders/client-order/{clientOid}
        """

        builder = GetOrderByClientOidReqBuilder()
        builder.set_symbol("BTC-USDT").set_client_oid("93eab1c8-527d-419a-80d1-54cec27f84ba")
        req = builder.build()
        try:
            resp = self.api.get_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_set_dcp_req(self):
        """
            set_dcp
            Set DCP
            /api/v1/hf/orders/dead-cancel-all
        """

        builder = SetDcpReqBuilder()
        builder.set_timeout(10).set_symbols("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.set_dcp(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_dcp_req(self):
        """
            get_dcp
            Get DCP
            /api/v1/hf/orders/dead-cancel-all/query
        """

        try:
            resp = self.api.get_dcp()
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_all_orders_by_symbol_req(self):
        """
            cancel_all_orders_by_symbol
            Cancel All Orders By Symbol
            /api/v1/hf/orders
        """

        builder = CancelAllOrdersBySymbolReqBuilder()
        builder.set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.cancel_all_orders_by_symbol(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_open_orders_by_page_req(self):
        """
            get_open_orders_by_page
            Get Open Orders By Page
            /api/v1/hf/orders/active/page
        """

        builder = GetOpenOrdersByPageReqBuilder()
        builder.set_symbol("BTC-USDT").set_page_num(1).set_page_size(50)
        req = builder.build()
        try:
            resp = self.api.get_open_orders_by_page(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_closed_orders_req(self):
        """
            get_closed_orders
            Get Closed Orders
            /api/v1/hf/orders/done
        """

        builder = GetClosedOrdersReqBuilder()
        builder.set_symbol("BTC-USDT").set_side(GetClosedOrdersReq.SideEnum.BUY)
        req = builder.build()
        try:
            resp = self.api.get_closed_orders(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_add_orders_req(self):
        """
            batch_add_orders
            Batch Add Orders
            /api/v1/hf/orders/multi
        """

        builder = BatchAddOrdersReqBuilder()

        order1 = BatchAddOrdersOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "10000").set_size("0.0005").build()
        order2 = BatchAddOrdersOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "10000").set_size("0.0005").build()

        builder.set_order_list([order1, order2])
        req = builder.build()
        try:
            resp = self.api.batch_add_orders(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_add_orders_sync_req(self):
        """
            batch_add_orders_sync
            Batch Add Orders Sync
            /api/v1/hf/orders/multi/sync
        """

        builder = BatchAddOrdersSyncReqBuilder()

        order1 = BatchAddOrdersSyncOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersSyncOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersSyncOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "10000").set_size("0.0005").build()
        order2 = BatchAddOrdersSyncOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersSyncOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersSyncOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "10000").set_size("0.0005").build()

        builder.set_order_list([order1, order2])
        req = builder.build()
        try:
            resp = self.api.batch_add_orders_sync(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_order_id_req(self):
        """
            cancel_order_by_order_id
            Cancel Order By OrderId
            /api/v1/hf/orders/{orderId}
        """

        builder = CancelOrderByOrderIdReqBuilder()
        builder.set_order_id("674693c0f1bf4000077dc838").set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_order_by_order_id_req(self):
        """
            get_order_by_order_id
            Get Order By OrderId
            /api/v1/hf/orders/{orderId}
        """

        builder = GetOrderByOrderIdReqBuilder()
        builder.set_symbol("BTC-USDT").set_order_id("67d8dc675de54400076be9f2")
        req = builder.build()
        try:
            resp = self.api.get_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_order_req(self):
        """
            add_order
            Add Order
            /api/v1/hf/orders
        """

        builder = AddOrderReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOrderReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(
            AddOrderReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("10000").set_size("0.001")
        req = builder.build()
        try:
            resp = self.api.add_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_client_oid_sync_req(self):
        """
            cancel_order_by_client_oid_sync
            Cancel Order By ClientOid Sync
            /api/v1/hf/orders/sync/client-order/{clientOid}
        """

        builder = CancelOrderByClientOidSyncReqBuilder()
        builder.set_client_oid("fdb62f14-d059-43a2-b8f5-c7a8a05daa51").set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_client_oid_sync(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_order_id_sync_req(self):
        """
            cancel_order_by_order_id_sync
            Cancel Order By OrderId Sync
            /api/v1/hf/orders/sync/{orderId}
        """

        builder = CancelOrderByOrderIdSyncReqBuilder()
        builder.set_order_id("67d8dc675de54400076be9f2").set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_order_id_sync(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_order_sync_req(self):
        """
            add_order_sync
            Add Order Sync
            /api/v1/hf/orders/sync
        """

        builder = AddOrderSyncReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOrderSyncReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(
            AddOrderSyncReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("10000").set_size("0.001")
        req = builder.build()
        try:
            resp = self.api.add_order_sync(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_order_test_req(self):
        """
            add_order_test
            Add Order Test
            /api/v1/hf/orders/test
        """

        builder = AddOrderTestReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOrderTestReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(
            AddOrderTestReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("10000").set_size("0.001")
        req = builder.build()
        try:
            resp = self.api.add_order_test(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_recent_trade_history_old_req(self):
        """
            get_recent_trade_history_old
            Get Recent Trade History - Old
            /api/v1/limit/fills
        """
        try:
            resp = self.api.get_recent_trade_history_old()
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_recent_orders_list_old_req(self):
        """
            get_recent_orders_list_old
            Get Recent Orders List - Old
            /api/v1/limit/orders
        """
        try:
            resp = self.api.get_recent_orders_list_old()
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_client_oid_old_req(self):
        """
            cancel_order_by_client_oid_old
            Cancel Order By ClientOid - Old
            /api/v1/order/client-order/{clientOid}
        """

        builder = CancelOrderByClientOidOldReqBuilder()
        builder.set_client_oid("5d1962d9-5010-4d59-8872-75264c86c95e")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_client_oid_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_order_by_client_oid_old_req(self):
        """
            get_order_by_client_oid_old
            Get Order By ClientOid - Old
            /api/v1/order/client-order/{clientOid}
        """

        builder = GetOrderByClientOidOldReqBuilder()
        builder.set_client_oid("27e2e92f-29d5-41b2-9580-d010c6277239")
        req = builder.build()
        try:
            resp = self.api.get_order_by_client_oid_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_cancel_order_old_req(self):
        """
            batch_cancel_order_old
            Batch Cancel Order - Old
            /api/v1/orders
        """

        builder = BatchCancelOrderOldReqBuilder()
        builder.set_symbol("BTC-USDT").set_trade_type(BatchCancelOrderOldReq.TradeTypeEnum.TRADE)
        req = builder.build()
        try:
            resp = self.api.batch_cancel_order_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_orders_list_old_req(self):
        """
            get_orders_list_old
            Get Orders List - Old
            /api/v1/orders
        """

        builder = GetOrdersListOldReqBuilder()
        builder.set_symbol('DOGE-USDT').set_status(GetOrdersListOldReq.StatusEnum.DONE).set_side(
            GetOrdersListOldReq.SideEnum.BUY).set_type(GetOrdersListOldReq.TypeEnum.LIMIT).set_trade_type(
            GetOrdersListOldReq.TradeTypeEnum.TRADE).set_start_at(1733068800000).set_end_at(1733155200000)

        req = builder.build()
        try:
            resp = self.api.get_orders_list_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_add_orders_old_req(self):
        """
            batch_add_orders_old
            Batch Add Orders - Old
            /api/v1/orders/multi
        """
        order1 = BatchAddOrdersOldOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersOldOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersOldOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "100").set_size("0.1").build()
        order2 = BatchAddOrdersOldOrderListBuilder().set_client_oid(uuid.uuid4().__str__()).set_side(
            BatchAddOrdersOldOrderList.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(BatchAddOrdersOldOrderList.TypeEnum.LIMIT).set_remark("sdk_test").set_price(
            "100").set_size("0.1").build()

        builder = BatchAddOrdersOldReqBuilder()
        builder.set_order_list([order1, order2]).set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.batch_add_orders_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_order_by_order_id_old_req(self):
        """
            cancel_order_by_order_id_old
            Cancel Order By OrderId - Old
            /api/v1/orders/{orderId}
        """

        builder = CancelOrderByOrderIdOldReqBuilder()
        builder.set_symbol("BTC-USDT").set_order_id("674ec1702033a500072bb983")
        req = builder.build()
        try:
            resp = self.api.cancel_order_by_order_id_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_order_by_order_id_old_req(self):
        """
            get_order_by_order_id_old
            Get Order By OrderId - Old
            /api/v1/orders/{orderId}
        """

        builder = GetOrderByOrderIdOldReqBuilder()
        builder.set_order_id("674ebbe5e21c7400071a5273")
        req = builder.build()
        try:
            resp = self.api.get_order_by_order_id_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_order_old_req(self):
        """
            add_order_old
            Add Order - Old
            /api/v1/orders
        """

        builder = AddOrderOldReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOrderOldReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(AddOrderOldReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("100").set_size("0.1")
        req = builder.build()
        try:
            resp = self.api.add_order_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_order_test_old_req(self):
        """
            add_order_test_old
            Add Order Test - Old
            /api/v1/orders/test
        """

        builder = AddOrderTestOldReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOrderTestOldReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(AddOrderTestOldReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("100").set_size(
            "0.1")
        req = builder.build()
        try:
            resp = self.api.add_order_test_old(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_cancel_stop_order_req(self):
        """
            batch_cancel_stop_order
            Batch Cancel Stop Orders
            /api/v1/stop-order/cancel
        """

        builder = BatchCancelStopOrderReqBuilder()
        builder.set_symbol("BTC-USDT").set_trade_type("TRADE").set_order_ids("vs93gpqeoiefr0o0003par0c")
        req = builder.build()
        try:
            resp = self.api.batch_cancel_stop_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_stop_order_by_client_oid_req(self):
        """
            cancel_stop_order_by_client_oid
            Cancel Stop Order By ClientOid
            /api/v1/stop-order/cancelOrderByClientOid
        """

        builder = CancelStopOrderByClientOidReqBuilder()
        builder.set_symbol("BTC-USDT").set_client_oid("a2537f39-bf2a-4d4a-b33e-21a606645242")
        req = builder.build()
        try:
            resp = self.api.cancel_stop_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_stop_orders_list_req(self):
        """
            get_stop_orders_list
            Get Stop Orders List
            /api/v1/stop-order
        """

        builder = GetStopOrdersListReqBuilder()
        builder.set_symbol("BTC-USDT").set_side(GetStopOrdersListReq.SideEnum.BUY)
        req = builder.build()
        try:
            resp = self.api.get_stop_orders_list(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_stop_order_by_order_id_req(self):
        """
            cancel_stop_order_by_order_id
            Cancel Stop Order By OrderId
            /api/v1/stop-order/{orderId}
        """

        builder = CancelStopOrderByOrderIdReqBuilder()
        builder.set_order_id("vs93gpqeon4mh3fa003sg8na")
        req = builder.build()
        try:
            resp = self.api.cancel_stop_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_stop_order_by_order_id_req(self):
        """
            get_stop_order_by_order_id
            Get Stop Order By OrderId
            /api/v1/stop-order/{orderId}
        """

        builder = GetStopOrderByOrderIdReqBuilder()
        builder.set_order_id("vs93gpqeoiefr0o0003par0c")
        req = builder.build()
        try:
            resp = self.api.get_stop_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_stop_order_req(self):
        """
            add_stop_order
            Add Stop Order
            /api/v1/stop-order
        """
        builder = AddStopOrderReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddStopOrderReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_type(AddStopOrderReq.TypeEnum.LIMIT).set_remark("sdk_test").set_price("100").set_size(
            "0.1").set_stop_price("8000")
        req = builder.build()
        try:
            resp = self.api.add_stop_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_stop_order_by_client_oid_req(self):
        """
            get_stop_order_by_client_oid
            Get Stop Order By ClientOid
            /api/v1/stop-order/queryOrderByClientOid
        """

        builder = GetStopOrderByClientOidReqBuilder()
        builder.set_client_oid("c455af40-3136-45de-a30b-49ea7db1ff37")
        req = builder.build()
        try:
            resp = self.api.get_stop_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_oco_order_by_client_oid_req(self):
        """
            cancel_oco_order_by_client_oid
            Cancel OCO Order By ClientOid
            /api/v3/oco/client-order/{clientOid}
        """

        builder = CancelOcoOrderByClientOidReqBuilder()
        builder.set_client_oid("bcf01179-71dc-416b-bf7d-1a8510d989c1")
        req = builder.build()
        try:
            resp = self.api.cancel_oco_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_oco_order_by_client_oid_req(self):
        """
            get_oco_order_by_client_oid
            Get OCO Order By ClientOid
            /api/v3/oco/client-order/{clientOid}
        """

        builder = GetOcoOrderByClientOidReqBuilder()
        builder.set_client_oid("ca353603-4c91-4360-90f4-6409d1c75ff6")
        req = builder.build()
        try:
            resp = self.api.get_oco_order_by_client_oid(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_oco_order_detail_by_order_id_req(self):
        """
            get_oco_order_detail_by_order_id
            Get OCO Order Detail By OrderId
            /api/v3/oco/order/details/{orderId}
        """

        builder = GetOcoOrderDetailByOrderIdReqBuilder()
        builder.set_order_id("674ec7de688dea0007c8234b")
        req = builder.build()
        try:
            resp = self.api.get_oco_order_detail_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_cancel_oco_order_by_order_id_req(self):
        """
            cancel_oco_order_by_order_id
            Cancel OCO Order By OrderId
            /api/v3/oco/order/{orderId}
        """

        builder = CancelOcoOrderByOrderIdReqBuilder()
        builder.set_order_id("674ec69772cf2800072f3f53")
        req = builder.build()
        try:
            resp = self.api.cancel_oco_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_oco_order_by_order_id_req(self):
        """
            get_oco_order_by_order_id
            Get OCO Order By OrderId
            /api/v3/oco/order/{orderId}
        """

        builder = GetOcoOrderByOrderIdReqBuilder()
        builder.set_order_id("674ec69772cf2800072f3f53")
        req = builder.build()
        try:
            resp = self.api.get_oco_order_by_order_id(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_oco_order_req(self):
        """
            add_oco_order
            Add OCO Order
            /api/v3/oco/order
        """

        builder = AddOcoOrderReqBuilder()
        builder.set_client_oid(uuid.uuid4().__str__()).set_side(AddOcoOrderReq.SideEnum.BUY).set_symbol(
            "BTC-USDT").set_remark("sdk_test").set_price("94000").set_size("0.001").set_stop_price(
            "98000").set_limit_price("96000").set_trade_type(AddOcoOrderReq.TradeTypeEnum.TRADE)
        req = builder.build()
        try:
            resp = self.api.add_oco_order(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_batch_cancel_oco_orders_req(self):
        """
            batch_cancel_oco_orders
            Batch Cancel OCO Order
            /api/v3/oco/orders
        """

        builder = BatchCancelOcoOrdersReqBuilder()
        builder.set_order_ids("674ec74ffd83000007956c62").set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.batch_cancel_oco_orders(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_get_oco_order_list_req(self):
        """
            get_oco_order_list
            Get OCO Order List
            /api/v3/oco/orders
        """

        builder = GetOcoOrderListReqBuilder()
        builder.set_symbol("BTC-USDT")
        req = builder.build()
        try:
            resp = self.api.get_oco_order_list(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e
