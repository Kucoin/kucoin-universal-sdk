import unittest
from .model_add_order_req import AddOrderReq
from .model_add_order_resp import AddOrderResp
from .model_add_order_test_req import AddOrderTestReq
from .model_add_order_test_resp import AddOrderTestResp
from .model_add_order_test_v1_req import AddOrderTestV1Req
from .model_add_order_test_v1_resp import AddOrderTestV1Resp
from .model_add_order_v1_req import AddOrderV1Req
from .model_add_order_v1_resp import AddOrderV1Resp
from .model_cancel_all_orders_by_symbol_req import CancelAllOrdersBySymbolReq
from .model_cancel_all_orders_by_symbol_resp import CancelAllOrdersBySymbolResp
from .model_cancel_order_by_client_oid_req import CancelOrderByClientOidReq
from .model_cancel_order_by_client_oid_resp import CancelOrderByClientOidResp
from .model_cancel_order_by_order_id_req import CancelOrderByOrderIdReq
from .model_cancel_order_by_order_id_resp import CancelOrderByOrderIdResp
from .model_get_closed_orders_req import GetClosedOrdersReq
from .model_get_closed_orders_resp import GetClosedOrdersResp
from .model_get_open_orders_req import GetOpenOrdersReq
from .model_get_open_orders_resp import GetOpenOrdersResp
from .model_get_order_by_client_oid_req import GetOrderByClientOidReq
from .model_get_order_by_client_oid_resp import GetOrderByClientOidResp
from .model_get_order_by_order_id_req import GetOrderByOrderIdReq
from .model_get_order_by_order_id_resp import GetOrderByOrderIdResp
from .model_get_symbols_with_open_order_req import GetSymbolsWithOpenOrderReq
from .model_get_symbols_with_open_order_resp import GetSymbolsWithOpenOrderResp
from .model_get_trade_history_req import GetTradeHistoryReq
from .model_get_trade_history_resp import GetTradeHistoryResp
from typing_extensions import deprecated
from kucoin_universal_sdk.model.common import RestResponse


class OrderAPITest(unittest.TestCase):

    def test_add_order_req_model(self):
        """
       add_order
       Add Order
       /api/v3/hf/margin/order
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddOrderReq.from_json(data)

    def test_add_order_resp_model(self):
        """
        add_order
        Add Order
        /api/v3/hf/margin/order
        """
        data = "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671663e02188630007e21c9c\",\n        \"clientOid\": \"5c52e11203aa677f33e1493fb\",\n        \"borrowSize\": \"10.2\",\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderResp.from_dict(common_response.data)

    def test_add_order_test_req_model(self):
        """
       add_order_test
       Add Order Test
       /api/v3/hf/margin/order/test
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e493fb\", \"remark\": \"order remarks\"}"
        req = AddOrderTestReq.from_json(data)

    def test_add_order_test_resp_model(self):
        """
        add_order_test
        Add Order Test
        /api/v3/hf/margin/order/test
        """
        data = "{\n    \"success\": true,\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"5bd6e9286d99522a52e458de\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"borrowSize\": 10.2,\n        \"loanApplyId\": \"600656d9a33ac90009de4f6f\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderTestResp.from_dict(common_response.data)

    def test_cancel_order_by_order_id_req_model(self):
        """
       cancel_order_by_order_id
       Cancel Order By OrderId
       /api/v3/hf/margin/orders/{orderId}
       """
        data = "{\"orderId\": \"671663e02188630007e21c9c\", \"symbol\": \"BTC-USDT\"}"
        req = CancelOrderByOrderIdReq.from_json(data)

    def test_cancel_order_by_order_id_resp_model(self):
        """
        cancel_order_by_order_id
        Cancel Order By OrderId
        /api/v3/hf/margin/orders/{orderId}
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"671663e02188630007e21c9c\"}}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByOrderIdResp.from_dict(common_response.data)

    def test_cancel_order_by_client_oid_req_model(self):
        """
       cancel_order_by_client_oid
       Cancel Order By ClientOid
       /api/v3/hf/margin/orders/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e11203aa677f33e1493fb\", \"symbol\": \"BTC-USDT\"}"
        req = CancelOrderByClientOidReq.from_json(data)

    def test_cancel_order_by_client_oid_resp_model(self):
        """
        cancel_order_by_client_oid
        Cancel Order By ClientOid
        /api/v3/hf/margin/orders/client-order/{clientOid}
        """
        data = "{\"code\":\"200000\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e1493fb\"}}"
        common_response = RestResponse.from_json(data)
        resp = CancelOrderByClientOidResp.from_dict(common_response.data)

    def test_cancel_all_orders_by_symbol_req_model(self):
        """
       cancel_all_orders_by_symbol
       Cancel All Orders By Symbol
       /api/v3/hf/margin/orders
       """
        data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}"
        req = CancelAllOrdersBySymbolReq.from_json(data)

    def test_cancel_all_orders_by_symbol_resp_model(self):
        """
        cancel_all_orders_by_symbol
        Cancel All Orders By Symbol
        /api/v3/hf/margin/orders
        """
        data = "{\"code\":\"200000\",\"data\":\"success\"}"
        common_response = RestResponse.from_json(data)
        resp = CancelAllOrdersBySymbolResp.from_dict(common_response.data)

    def test_get_symbols_with_open_order_req_model(self):
        """
       get_symbols_with_open_order
       Get Symbols With Open Order
       /api/v3/hf/margin/order/active/symbols
       """
        data = "{\"tradeType\": \"MARGIN_TRADE\"}"
        req = GetSymbolsWithOpenOrderReq.from_json(data)

    def test_get_symbols_with_open_order_resp_model(self):
        """
        get_symbols_with_open_order
        Get Symbols With Open Order
        /api/v3/hf/margin/order/active/symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbolSize\": 1,\n        \"symbols\": [\n            \"BTC-USDT\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetSymbolsWithOpenOrderResp.from_dict(common_response.data)

    def test_get_open_orders_req_model(self):
        """
       get_open_orders
       Get Open Orders
       /api/v3/hf/margin/orders/active
       """
        data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\"}"
        req = GetOpenOrdersReq.from_json(data)

    def test_get_open_orders_resp_model(self):
        """
        get_open_orders
        Get Open Orders
        /api/v3/hf/margin/orders/active
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"671667306afcdb000723107f\",\n            \"clientOid\": \"5c52e11203aa677f33e493fb\",\n            \"symbol\": \"BTC-USDT\",\n            \"opType\": \"DEAL\",\n            \"type\": \"limit\",\n            \"side\": \"buy\",\n            \"price\": \"50000\",\n            \"size\": \"0.00001\",\n            \"funds\": \"0.5\",\n            \"dealSize\": \"0\",\n            \"dealFunds\": \"0\",\n            \"remainSize\": \"0.00001\",\n            \"remainFunds\": \"0.5\",\n            \"cancelledSize\": \"0\",\n            \"cancelledFunds\": \"0\",\n            \"fee\": \"0\",\n            \"feeCurrency\": \"USDT\",\n            \"stp\": null,\n            \"stop\": null,\n            \"stopTriggered\": false,\n            \"stopPrice\": \"0\",\n            \"timeInForce\": \"GTC\",\n            \"postOnly\": false,\n            \"hidden\": false,\n            \"iceberg\": false,\n            \"visibleSize\": \"0\",\n            \"cancelAfter\": 0,\n            \"channel\": \"API\",\n            \"remark\": null,\n            \"tags\": null,\n            \"cancelExist\": false,\n            \"tradeType\": \"MARGIN_TRADE\",\n            \"inOrderBook\": true,\n            \"active\": true,\n            \"tax\": \"0\",\n            \"createdAt\": 1729521456248,\n            \"lastUpdatedAt\": 1729521460940\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOpenOrdersResp.from_dict(common_response.data)

    def test_get_closed_orders_req_model(self):
        """
       get_closed_orders
       Get Closed Orders
       /api/v3/hf/margin/orders/done
       """
        data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 20, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
        req = GetClosedOrdersReq.from_json(data)

    def test_get_closed_orders_resp_model(self):
        """
        get_closed_orders
        Get Closed Orders
        /api/v3/hf/margin/orders/done
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"lastId\": 136112949351,\n        \"items\": [\n            {\n                \"id\": \"6716491f6afcdb00078365c8\",\n                \"clientOid\": \"5c52e11203aa677f33e493fb\",\n                \"symbol\": \"BTC-USDT\",\n                \"opType\": \"DEAL\",\n                \"type\": \"limit\",\n                \"side\": \"buy\",\n                \"price\": \"50000\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.5\",\n                \"dealSize\": \"0\",\n                \"dealFunds\": \"0\",\n                \"remainSize\": \"0\",\n                \"remainFunds\": \"0\",\n                \"cancelledSize\": \"0.00001\",\n                \"cancelledFunds\": \"0.5\",\n                \"fee\": \"0\",\n                \"feeCurrency\": \"USDT\",\n                \"stp\": null,\n                \"stop\": null,\n                \"stopTriggered\": false,\n                \"stopPrice\": \"0\",\n                \"timeInForce\": \"GTC\",\n                \"postOnly\": false,\n                \"hidden\": false,\n                \"iceberg\": false,\n                \"visibleSize\": \"0\",\n                \"cancelAfter\": 0,\n                \"channel\": \"API\",\n                \"remark\": null,\n                \"tags\": null,\n                \"cancelExist\": true,\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"inOrderBook\": false,\n                \"active\": false,\n                \"tax\": \"0\",\n                \"createdAt\": 1729513759162,\n                \"lastUpdatedAt\": 1729521126597\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetClosedOrdersResp.from_dict(common_response.data)

    def test_get_trade_history_req_model(self):
        """
       get_trade_history
       Get Trade History
       /api/v3/hf/margin/fills
       """
        data = "{\"symbol\": \"BTC-USDT\", \"tradeType\": \"MARGIN_TRADE\", \"orderId\": \"example_string_default_value\", \"side\": \"buy\", \"type\": \"limit\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}"
        req = GetTradeHistoryReq.from_json(data)

    def test_get_trade_history_resp_model(self):
        """
        get_trade_history
        Get Trade History
        /api/v3/hf/margin/fills
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"items\": [\n            {\n                \"id\": 137891621991,\n                \"symbol\": \"BTC-USDT\",\n                \"tradeId\": 11040911994273793,\n                \"orderId\": \"671868085584bc0007d85f46\",\n                \"counterOrderId\": \"67186805b7cbdf00071621f9\",\n                \"side\": \"buy\",\n                \"liquidity\": \"taker\",\n                \"forceTaker\": false,\n                \"price\": \"67141.6\",\n                \"size\": \"0.00001\",\n                \"funds\": \"0.671416\",\n                \"fee\": \"0.000671416\",\n                \"feeRate\": \"0.001\",\n                \"feeCurrency\": \"USDT\",\n                \"stop\": \"\",\n                \"tradeType\": \"MARGIN_TRADE\",\n                \"tax\": \"0\",\n                \"taxRate\": \"0\",\n                \"type\": \"limit\",\n                \"createdAt\": 1729652744998\n            }\n        ],\n        \"lastId\": 137891621991\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetTradeHistoryResp.from_dict(common_response.data)

    def test_get_order_by_order_id_req_model(self):
        """
       get_order_by_order_id
       Get Order By OrderId
       /api/v3/hf/margin/orders/{orderId}
       """
        data = "{\"orderId\": \"671667306afcdb000723107f\", \"symbol\": \"BTC-USDT\"}"
        req = GetOrderByOrderIdReq.from_json(data)

    def test_get_order_by_order_id_resp_model(self):
        """
        get_order_by_order_id
        Get Order By OrderId
        /api/v3/hf/margin/orders/{orderId}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByOrderIdResp.from_dict(common_response.data)

    def test_get_order_by_client_oid_req_model(self):
        """
       get_order_by_client_oid
       Get Order By ClientOid
       /api/v3/hf/margin/orders/client-order/{clientOid}
       """
        data = "{\"clientOid\": \"5c52e11203aa677f33e493fb\", \"symbol\": \"BTC-USDT\"}"
        req = GetOrderByClientOidReq.from_json(data)

    def test_get_order_by_client_oid_resp_model(self):
        """
        get_order_by_client_oid
        Get Order By ClientOid
        /api/v3/hf/margin/orders/client-order/{clientOid}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"id\": \"671667306afcdb000723107f\",\n        \"symbol\": \"BTC-USDT\",\n        \"opType\": \"DEAL\",\n        \"type\": \"limit\",\n        \"side\": \"buy\",\n        \"price\": \"50000\",\n        \"size\": \"0.00001\",\n        \"funds\": \"0.5\",\n        \"dealSize\": \"0\",\n        \"dealFunds\": \"0\",\n        \"fee\": \"0\",\n        \"feeCurrency\": \"USDT\",\n        \"stp\": null,\n        \"stop\": null,\n        \"stopTriggered\": false,\n        \"stopPrice\": \"0\",\n        \"timeInForce\": \"GTC\",\n        \"postOnly\": false,\n        \"hidden\": false,\n        \"iceberg\": false,\n        \"visibleSize\": \"0\",\n        \"cancelAfter\": 0,\n        \"channel\": \"API\",\n        \"clientOid\": \"5c52e11203aa677f33e493fb\",\n        \"remark\": null,\n        \"tags\": null,\n        \"cancelExist\": false,\n        \"createdAt\": 1729521456248,\n        \"lastUpdatedAt\": 1729651011877,\n        \"tradeType\": \"MARGIN_TRADE\",\n        \"inOrderBook\": true,\n        \"cancelledSize\": \"0\",\n        \"cancelledFunds\": \"0\",\n        \"remainSize\": \"0.00001\",\n        \"remainFunds\": \"0.5\",\n        \"tax\": \"0\",\n        \"active\": true\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetOrderByClientOidResp.from_dict(common_response.data)

    def test_add_order_v1_req_model(self):
        """
       add_order_v1
       Add Order - V1
       /api/v1/margin/order
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}"
        req = AddOrderV1Req.from_json(data)

    def test_add_order_v1_resp_model(self):
        """
        add_order_v1
        Add Order - V1
        /api/v1/margin/order
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderV1Resp.from_dict(common_response.data)

    def test_add_order_test_v1_req_model(self):
        """
       add_order_test_v1
       Add Order Test - V1
       /api/v1/margin/order/test
       """
        data = "{\"type\": \"limit\", \"symbol\": \"BTC-USDT\", \"side\": \"buy\", \"price\": \"50000\", \"size\": \"0.00001\", \"clientOid\": \"5c52e11203aa677f33e4193fb\", \"remark\": \"order remarks\"}"
        req = AddOrderTestV1Req.from_json(data)

    def test_add_order_test_v1_resp_model(self):
        """
        add_order_test_v1
        Add Order Test - V1
        /api/v1/margin/order/test
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671bb90194422f00073ff4f0\",\n        \"loanApplyId\": null,\n        \"borrowSize\": null,\n        \"clientOid\": null\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = AddOrderTestV1Resp.from_dict(common_response.data)
