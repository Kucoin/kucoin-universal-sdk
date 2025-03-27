import os
import unittest

from kucoin_universal_sdk.api.client import DefaultClient
from kucoin_universal_sdk.extension.interceptor.logging import LoggingInterceptor
from kucoin_universal_sdk.generate.account.deposit.model_add_deposit_address_v1_req import \
    AddDepositAddressV1ReqBuilder, AddDepositAddressV1Req
from kucoin_universal_sdk.generate.account.deposit.model_add_deposit_address_v3_req import \
    AddDepositAddressV3ReqBuilder, AddDepositAddressV3Req
from kucoin_universal_sdk.generate.account.deposit.model_get_deposit_address_v1_req import GetDepositAddressV1ReqBuilder
from kucoin_universal_sdk.generate.account.deposit.model_get_deposit_address_v2_req import GetDepositAddressV2ReqBuilder
from kucoin_universal_sdk.generate.account.deposit.model_get_deposit_address_v3_req import GetDepositAddressV3ReqBuilder
from kucoin_universal_sdk.generate.account.deposit.model_get_deposit_history_old_req import \
    GetDepositHistoryOldReqBuilder
from kucoin_universal_sdk.generate.account.deposit.model_get_deposit_history_req import GetDepositHistoryReqBuilder
from kucoin_universal_sdk.model.client_option import ClientOptionBuilder
from kucoin_universal_sdk.model.constants import GLOBAL_API_ENDPOINT, GLOBAL_FUTURES_API_ENDPOINT, \
    GLOBAL_BROKER_API_ENDPOINT
from kucoin_universal_sdk.model.transport_option import TransportOptionBuilder


class AccountApiTest(unittest.TestCase):
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
        self.api = kucoin_rest_api.get_account_service().get_deposit_api()

    def test_get_deposit_address_v1_req(self):
        """
            get_deposit_address_v1
            Get Deposit Addresses(V1)
            /api/v1/deposit-addresses
        """

        builder = GetDepositAddressV1ReqBuilder()
        builder.set_currency("USDT").set_chain("eth")
        req = builder.build()
        try:
            resp = self.api.get_deposit_address_v1(req)
            print("code: ", resp.common_response.code)
            print("msg: ", resp.common_response.message)
            print("data: ", resp.to_json())
        except Exception as e:
            print("error: ", e)
            raise e

    def test_add_deposit_address_v1_req(self):
       """
           add_deposit_address_v1
           Add Deposit Address(V1)
           /api/v1/deposit-addresses
       """

       builder = AddDepositAddressV1ReqBuilder()
       builder.set_currency('ETH').set_chain('eth').set_to(AddDepositAddressV1Req.ToEnum.MAIN)
       req = builder.build()
       try:
           resp = self.api.add_deposit_address_v1(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e

    def test_get_deposit_history_req(self):
       """
           get_deposit_history
           Get Deposit History
           /api/v1/deposits
       """

       builder = GetDepositHistoryReqBuilder()
       builder.set_currency("USDT").set_start_at(1673496371000).set_end_at(1705032371000)
       req = builder.build()
       try:
           resp = self.api.get_deposit_history(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e

    # TODO empty data
    def test_get_deposit_history_old_req(self):
       """
           get_deposit_history_old
           Get Deposit History(OLD)
           /api/v1/hist-deposits
       """

       builder = GetDepositHistoryOldReqBuilder()
       builder.set_start_at(1714492800000).set_end_at(1732982400000)
       req = builder.build()
       try:
           resp = self.api.get_deposit_history_old(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e

    def test_get_deposit_address_v2_req(self):
       """
           get_deposit_address_v2
           Get Deposit Addresses(V2)
           /api/v2/deposit-addresses
       """

       builder = GetDepositAddressV2ReqBuilder()
       builder.set_currency("USDT").set_chain("SOL")
       req = builder.build()
       try:
           resp = self.api.get_deposit_address_v2(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e

    def test_add_deposit_address_v3_req(self):
       """
           add_deposit_address_v3
           Add Deposit Address(V3)
           /api/v3/deposit-address/create
       """

       builder = AddDepositAddressV3ReqBuilder()
       builder.set_currency("USDT").set_chain("xtz").set_to(AddDepositAddressV3Req.ToEnum.MAIN).set_amount("1")
       req = builder.build()
       try:
           resp = self.api.add_deposit_address_v3(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e

    def test_get_deposit_address_v3_req(self):
       """
           get_deposit_address_v3
           Get Deposit Addresses(V3)
           /api/v3/deposit-addresses
       """

       builder = GetDepositAddressV3ReqBuilder()
       builder.set_currency("ETH").set_amount("10").set_chain("eth")
       req = builder.build()
       try:
           resp = self.api.get_deposit_address_v3(req)
           print("code: ", resp.common_response.code)
           print("msg: ", resp.common_response.message)
           print("data: ", resp.to_json())
       except Exception as e:
           print("error: ", e)
           raise e
