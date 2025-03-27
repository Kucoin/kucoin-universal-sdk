import unittest
from .model_flex_transfer_req import FlexTransferReq
from .model_flex_transfer_resp import FlexTransferResp
from .model_futures_account_transfer_in_req import FuturesAccountTransferInReq
from .model_futures_account_transfer_in_resp import FuturesAccountTransferInResp
from .model_futures_account_transfer_out_req import FuturesAccountTransferOutReq
from .model_futures_account_transfer_out_resp import FuturesAccountTransferOutResp
from .model_get_futures_account_transfer_out_ledger_req import GetFuturesAccountTransferOutLedgerReq
from .model_get_futures_account_transfer_out_ledger_resp import GetFuturesAccountTransferOutLedgerResp
from .model_get_transfer_quotas_req import GetTransferQuotasReq
from .model_get_transfer_quotas_resp import GetTransferQuotasResp
from .model_inner_transfer_req import InnerTransferReq
from .model_inner_transfer_resp import InnerTransferResp
from .model_sub_account_transfer_req import SubAccountTransferReq
from .model_sub_account_transfer_resp import SubAccountTransferResp
from typing_extensions import deprecated
from kucoin_universal_sdk.model.common import RestResponse


class TransferAPITest(unittest.TestCase):

    def test_get_transfer_quotas_req_model(self):
        """
       get_transfer_quotas
       Get Transfer Quotas
       /api/v1/accounts/transferable
       """
        data = "{\"currency\": \"BTC\", \"type\": \"MAIN\", \"tag\": \"ETH-USDT\"}"
        req = GetTransferQuotasReq.from_json(data)

    def test_get_transfer_quotas_resp_model(self):
        """
        get_transfer_quotas
        Get Transfer Quotas
        /api/v1/accounts/transferable
        """
        data = "{\"code\":\"200000\",\"data\":{\"currency\":\"USDT\",\"balance\":\"10.5\",\"available\":\"10.5\",\"holds\":\"0\",\"transferable\":\"10.5\"}}"
        common_response = RestResponse.from_json(data)
        resp = GetTransferQuotasResp.from_dict(common_response.data)

    def test_flex_transfer_req_model(self):
        """
       flex_transfer
       Flex Transfer
       /api/v3/accounts/universal-transfer
       """
        data = "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"type\": \"PARENT_TO_SUB\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"fromAccountType\": \"TRADE\", \"toUserId\": \"63743f07e0c5230001761d08\", \"toAccountType\": \"TRADE\"}"
        req = FlexTransferReq.from_json(data)

    def test_flex_transfer_resp_model(self):
        """
        flex_transfer
        Flex Transfer
        /api/v3/accounts/universal-transfer
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"6705f7248c6954000733ecac\"\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = FlexTransferResp.from_dict(common_response.data)

    def test_sub_account_transfer_req_model(self):
        """
       sub_account_transfer
       Sub-account Transfer
       /api/v2/accounts/sub-transfer
       """
        data = "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"direction\": \"OUT\", \"accountType\": \"MAIN\", \"subAccountType\": \"MAIN\", \"subUserId\": \"63743f07e0c5230001761d08\"}"
        req = SubAccountTransferReq.from_json(data)

    def test_sub_account_transfer_resp_model(self):
        """
        sub_account_transfer
        Sub-account Transfer
        /api/v2/accounts/sub-transfer
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"670be6b0b1b9080007040a9b\"}}"
        common_response = RestResponse.from_json(data)
        resp = SubAccountTransferResp.from_dict(common_response.data)

    def test_inner_transfer_req_model(self):
        """
       inner_transfer
       Internal Transfer
       /api/v2/accounts/inner-transfer
       """
        data = "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"from\": \"main\", \"to\": \"trade\"}"
        req = InnerTransferReq.from_json(data)

    def test_inner_transfer_resp_model(self):
        """
        inner_transfer
        Internal Transfer
        /api/v2/accounts/inner-transfer
        """
        data = "{\"code\":\"200000\",\"data\":{\"orderId\":\"670beb3482a1bb0007dec644\"}}"
        common_response = RestResponse.from_json(data)
        resp = InnerTransferResp.from_dict(common_response.data)

    def test_get_futures_account_transfer_out_ledger_req_model(self):
        """
       get_futures_account_transfer_out_ledger
       Get Futures Account Transfer Out Ledger
       /api/v1/transfer-list
       """
        data = "{\"currency\": \"XBT\", \"type\": \"MAIN\", \"tag\": [\"mock_a\", \"mock_b\"], \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}"
        req = GetFuturesAccountTransferOutLedgerReq.from_json(data)

    def test_get_futures_account_transfer_out_ledger_resp_model(self):
        """
        get_futures_account_transfer_out_ledger
        Get Futures Account Transfer Out Ledger
        /api/v1/transfer-list
        """
        data = "{\"code\":\"200000\",\"data\":{\"currentPage\":1,\"pageSize\":50,\"totalNum\":1,\"totalPage\":1,\"items\":[{\"applyId\":\"670bf84c577f6c00017a1c48\",\"currency\":\"USDT\",\"recRemark\":\"\",\"recSystem\":\"KUCOIN\",\"status\":\"SUCCESS\",\"amount\":\"0.01\",\"reason\":\"\",\"offset\":1519769124134806,\"createdAt\":1728837708000,\"remark\":\"\"}]}}"
        common_response = RestResponse.from_json(data)
        resp = GetFuturesAccountTransferOutLedgerResp.from_dict(
            common_response.data)

    def test_futures_account_transfer_out_req_model(self):
        """
       futures_account_transfer_out
       Futures Account Transfer Out
       /api/v3/transfer-out
       """
        data = "{\"currency\": \"USDT\", \"amount\": 0.01, \"recAccountType\": \"MAIN\"}"
        req = FuturesAccountTransferOutReq.from_json(data)

    def test_futures_account_transfer_out_resp_model(self):
        """
        futures_account_transfer_out
        Futures Account Transfer Out
        /api/v3/transfer-out
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"applyId\": \"670bf84c577f6c00017a1c48\",\n        \"bizNo\": \"670bf84c577f6c00017a1c47\",\n        \"payAccountType\": \"CONTRACT\",\n        \"payTag\": \"DEFAULT\",\n        \"remark\": \"\",\n        \"recAccountType\": \"MAIN\",\n        \"recTag\": \"DEFAULT\",\n        \"recRemark\": \"\",\n        \"recSystem\": \"KUCOIN\",\n        \"status\": \"PROCESSING\",\n        \"currency\": \"USDT\",\n        \"amount\": \"0.01\",\n        \"fee\": \"0\",\n        \"sn\": 1519769124134806,\n        \"reason\": \"\",\n        \"createdAt\": 1728837708000,\n        \"updatedAt\": 1728837708000\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = FuturesAccountTransferOutResp.from_dict(common_response.data)

    def test_futures_account_transfer_in_req_model(self):
        """
       futures_account_transfer_in
       Futures Account Transfer In
       /api/v1/transfer-in
       """
        data = "{\"currency\": \"USDT\", \"amount\": 0.01, \"payAccountType\": \"MAIN\"}"
        req = FuturesAccountTransferInReq.from_json(data)

    def test_futures_account_transfer_in_resp_model(self):
        """
        futures_account_transfer_in
        Futures Account Transfer In
        /api/v1/transfer-in
        """
        data = "{\"code\":\"200000\",\"data\":null}"
        common_response = RestResponse.from_json(data)
        resp = FuturesAccountTransferInResp.from_dict(common_response.data)
