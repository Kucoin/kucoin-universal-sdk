import unittest
from .model_account_event import AccountEvent
from .model_order_v1_event import OrderV1Event
from .model_order_v2_event import OrderV2Event
from .model_stop_order_event import StopOrderEvent
from kucoin_universal_sdk.model.common import WsMessage


class SpotPrivateAPITest(unittest.TestCase):

    def test_account_resp_model(self):
        """
        account
        Get Account Balance
        /account/account/balance
        """
        data = "{\"topic\":\"/account/balance\",\"type\":\"message\",\"subject\":\"account.balance\",\"id\":\"354689988084000\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"accountId\":\"548674591753\",\"currency\":\"USDT\",\"total\":\"21.133773386762\",\"available\":\"20.132773386762\",\"hold\":\"1.001\",\"availableChange\":\"-0.5005\",\"holdChange\":\"0.5005\",\"relationContext\":{\"symbol\":\"BTC-USDT\",\"orderId\":\"6721d0632db25b0007071fdc\"},\"relationEvent\":\"trade.hold\",\"relationEventId\":\"354689988084000\",\"time\":\"1730269283892\"}}"
        common_response = WsMessage.from_json(data)
        resp = AccountEvent.from_dict(common_response.raw_data)

    def test_order_v1_resp_model(self):
        """
        order_v1
        Get Order(V1)
        /orderV1/spotMarket/tradeOrders
        """
        data = "{\"topic\":\"/spotMarket/tradeOrdersV2\",\"type\":\"message\",\"subject\":\"orderChange\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"canceledSize\":\"0\",\"clientOid\":\"5c52e11203aa677f33e493fb\",\"filledSize\":\"0\",\"orderId\":\"6720ecd9ec71f4000747731a\",\"orderTime\":1730211033305,\"orderType\":\"limit\",\"originSize\":\"0.00001\",\"price\":\"50000\",\"remainSize\":\"0.00001\",\"side\":\"buy\",\"size\":\"0.00001\",\"status\":\"open\",\"symbol\":\"BTC-USDT\",\"ts\":1730211033335000000,\"type\":\"open\"}}"
        common_response = WsMessage.from_json(data)
        resp = OrderV1Event.from_dict(common_response.raw_data)

    def test_order_v2_resp_model(self):
        """
        order_v2
        Get Order(V2)
        /orderV2/spotMarket/tradeOrdersV2
        """
        data = "{\"topic\":\"/spotMarket/tradeOrdersV2\",\"type\":\"message\",\"subject\":\"orderChange\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e493fc\",\"orderId\":\"6720da3fa30a360007f5f832\",\"orderTime\":1730206271588,\"orderType\":\"market\",\"originSize\":\"0.00001\",\"side\":\"buy\",\"status\":\"new\",\"symbol\":\"BTC-USDT\",\"ts\":1730206271616000000,\"type\":\"received\"}}"
        common_response = WsMessage.from_json(data)
        resp = OrderV2Event.from_dict(common_response.raw_data)

    def test_stop_order_resp_model(self):
        """
        stop_order
        Get Stop Order
        /stopOrder/spotMarket/advancedOrders
        """
        data = "{\"topic\":\"/spotMarket/advancedOrders\",\"type\":\"message\",\"subject\":\"stopOrder\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"orderId\":\"vs93gpupfa48anof003u85mb\",\"orderPrice\":\"70000\",\"orderType\":\"stop\",\"side\":\"buy\",\"size\":\"0.00007142\",\"stop\":\"loss\",\"stopPrice\":\"71000\",\"symbol\":\"BTC-USDT\",\"tradeType\":\"TRADE\",\"type\":\"open\",\"createdAt\":1742305928064,\"ts\":1742305928091268493}}"
        common_response = WsMessage.from_json(data)
        resp = StopOrderEvent.from_dict(common_response.raw_data)
