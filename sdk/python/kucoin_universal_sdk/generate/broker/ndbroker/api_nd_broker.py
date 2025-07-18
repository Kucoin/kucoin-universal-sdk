# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from abc import ABC, abstractmethod
from typing import Any
from kucoin_universal_sdk.internal.interfaces.transport import Transport
from .model_add_sub_account_api_req import AddSubAccountApiReq
from .model_add_sub_account_api_resp import AddSubAccountApiResp
from .model_add_sub_account_req import AddSubAccountReq
from .model_add_sub_account_resp import AddSubAccountResp
from .model_delete_sub_account_api_req import DeleteSubAccountApiReq
from .model_delete_sub_account_api_resp import DeleteSubAccountApiResp
from .model_get_broker_info_req import GetBrokerInfoReq
from .model_get_broker_info_resp import GetBrokerInfoResp
from .model_get_deposit_detail_req import GetDepositDetailReq
from .model_get_deposit_detail_resp import GetDepositDetailResp
from .model_get_deposit_list_req import GetDepositListReq
from .model_get_deposit_list_resp import GetDepositListResp
from .model_get_kyc_status_list_req import GetKycStatusListReq
from .model_get_kyc_status_list_resp import GetKycStatusListResp
from .model_get_kyc_status_req import GetKycStatusReq
from .model_get_kyc_status_resp import GetKycStatusResp
from .model_get_rebase_req import GetRebaseReq
from .model_get_rebase_resp import GetRebaseResp
from .model_get_sub_account_api_req import GetSubAccountApiReq
from .model_get_sub_account_api_resp import GetSubAccountApiResp
from .model_get_sub_account_req import GetSubAccountReq
from .model_get_sub_account_resp import GetSubAccountResp
from .model_get_transfer_history_req import GetTransferHistoryReq
from .model_get_transfer_history_resp import GetTransferHistoryResp
from .model_get_withdraw_detail_req import GetWithdrawDetailReq
from .model_get_withdraw_detail_resp import GetWithdrawDetailResp
from .model_modify_sub_account_api_req import ModifySubAccountApiReq
from .model_modify_sub_account_api_resp import ModifySubAccountApiResp
from .model_submit_kyc_req import SubmitKycReq
from .model_submit_kyc_resp import SubmitKycResp
from .model_transfer_req import TransferReq
from .model_transfer_resp import TransferResp


class NDBrokerAPI(ABC):

    @abstractmethod
    def submit_kyc(self, req: SubmitKycReq, **kwargs: Any) -> SubmitKycResp:
        """
        summary: Submit KYC
        description: This endpointcan submit kyc information for a sub-account of nd broker
        documentation: https://www.kucoin.com/docs-new/api-3472406
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | NULL    |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_kyc_status(self, req: GetKycStatusReq,
                       **kwargs: Any) -> GetKycStatusResp:
        """
        summary: Get KYC Status
        description: This endpoint can query the specified Kyc status
        documentation: https://www.kucoin.com/docs-new/api-3472407
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | NULL    |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_kyc_status_list(self, req: GetKycStatusListReq,
                            **kwargs: Any) -> GetKycStatusListResp:
        """
        summary: Get KYC Status List
        description: This endpoint can query the specified Kyc status list
        documentation: https://www.kucoin.com/docs-new/api-3472408
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | NULL    |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_broker_info(self, req: GetBrokerInfoReq,
                        **kwargs: Any) -> GetBrokerInfoResp:
        """
        summary: Get Broker Info
        description: This endpoint supports querying the basic information of the current Broker.
        documentation: https://www.kucoin.com/docs-new/api-3470282
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 2       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def add_sub_account(self, req: AddSubAccountReq,
                        **kwargs: Any) -> AddSubAccountResp:
        """
        summary: Add sub-account
        description: This endpoint supports Broker users creating sub-accounts.
        documentation: https://www.kucoin.com/docs-new/api-3470290
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 3       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_sub_account(self, req: GetSubAccountReq,
                        **kwargs: Any) -> GetSubAccountResp:
        """
        summary: Get sub-account
        description: This interface supports querying sub-accounts created by Broker.
        documentation: https://www.kucoin.com/docs-new/api-3470283
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 2       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def add_sub_account_api(self, req: AddSubAccountApiReq,
                            **kwargs: Any) -> AddSubAccountApiResp:
        """
        summary: Add sub-account API
        description: This interface supports the creation of Broker sub-account APIKEY.
        documentation: https://www.kucoin.com/docs-new/api-3470291
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 3       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_sub_account_api(self, req: GetSubAccountApiReq,
                            **kwargs: Any) -> GetSubAccountApiResp:
        """
        summary: Get sub-account API
        description: This interface supports querying the Broker’s sub-account APIKEY.
        documentation: https://www.kucoin.com/docs-new/api-3470284
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 2       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def modify_sub_account_api(self, req: ModifySubAccountApiReq,
                               **kwargs: Any) -> ModifySubAccountApiResp:
        """
        summary: Modify sub-account API
        description: This interface supports modifying the Broker’s sub-account APIKEY.
        documentation: https://www.kucoin.com/docs-new/api-3470292
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 3       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def delete_sub_account_api(self, req: DeleteSubAccountApiReq,
                               **kwargs: Any) -> DeleteSubAccountApiResp:
        """
        summary: Delete sub-account API
        description: This interface supports deleting Broker’s sub-account APIKEY.
        documentation: https://www.kucoin.com/docs-new/api-3470289
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 3       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def transfer(self, req: TransferReq, **kwargs: Any) -> TransferResp:
        """
        summary: Transfer
        description: This endpoint supports fund transfer between Broker accounts and Broker sub-accounts.  Please be aware that withdrawal from sub-accounts is not directly supported. Broker has to transfer funds from broker sub-account to broker account to initiate the withdrawals.
        documentation: https://www.kucoin.com/docs-new/api-3470293
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 1       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_transfer_history(self, req: GetTransferHistoryReq,
                             **kwargs: Any) -> GetTransferHistoryResp:
        """
        summary: Get Transfer History
        description: This endpoint supports querying the transfer records of the broker itself and its created sub-accounts.
        documentation: https://www.kucoin.com/docs-new/api-3470286
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 1       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_deposit_list(self, req: GetDepositListReq,
                         **kwargs: Any) -> GetDepositListResp:
        """
        summary: Get Deposit List
        description: The deposit records of each sub-account under the ND broker can be obtained at this endpoint.
        documentation: https://www.kucoin.com/docs-new/api-3470285
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 10      |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_deposit_detail(self, req: GetDepositDetailReq,
                           **kwargs: Any) -> GetDepositDetailResp:
        """
        summary: Get Deposit Detail
        description: This endpoint supports querying the deposit record of sub-accounts created by a Broker (excluding main account of ND broker).
        documentation: https://www.kucoin.com/docs-new/api-3470288
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 1       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_withdraw_detail(self, req: GetWithdrawDetailReq,
                            **kwargs: Any) -> GetWithdrawDetailResp:
        """
        summary: Get Withdraw Detail
        description: This endpoint supports querying the withdrawal records of sub-accounts created by a Broker (excluding main account of ND broker).
        documentation: https://www.kucoin.com/docs-new/api-3470287
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 1       |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_rebase(self, req: GetRebaseReq, **kwargs: Any) -> GetRebaseResp:
        """
        summary: Get Broker Rebate
        description: This interface supports the downloading of Broker rebate orders.
        documentation: https://www.kucoin.com/docs-new/api-3470281
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | BROKER  |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | GENERAL |
        | API-RATE-LIMIT-POOL   | BROKER  |
        | API-RATE-LIMIT-WEIGHT | 3       |
        +-----------------------+---------+
        """
        pass


class NDBrokerAPIImpl(NDBrokerAPI):

    def __init__(self, transport: Transport):
        self.transport = transport

    def submit_kyc(self, req: SubmitKycReq, **kwargs: Any) -> SubmitKycResp:
        return self.transport.call("broker", True, "POST",
                                   "/api/kyc/ndBroker/proxyClient/submit", req,
                                   SubmitKycResp(), False, **kwargs)

    def get_kyc_status(self, req: GetKycStatusReq,
                       **kwargs: Any) -> GetKycStatusResp:
        return self.transport.call(
            "broker", True, "GET", "/api/kyc/ndBroker/proxyClient/status/list",
            req, GetKycStatusResp(), False, **kwargs)

    def get_kyc_status_list(self, req: GetKycStatusListReq,
                            **kwargs: Any) -> GetKycStatusListResp:
        return self.transport.call(
            "broker", True, "GET", "/api/kyc/ndBroker/proxyClient/status/page",
            req, GetKycStatusListResp(), False, **kwargs)

    def get_broker_info(self, req: GetBrokerInfoReq,
                        **kwargs: Any) -> GetBrokerInfoResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v1/broker/nd/info", req,
                                   GetBrokerInfoResp(), False, **kwargs)

    def add_sub_account(self, req: AddSubAccountReq,
                        **kwargs: Any) -> AddSubAccountResp:
        return self.transport.call("broker", True, "POST",
                                   "/api/v1/broker/nd/account", req,
                                   AddSubAccountResp(), False, **kwargs)

    def get_sub_account(self, req: GetSubAccountReq,
                        **kwargs: Any) -> GetSubAccountResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v1/broker/nd/account", req,
                                   GetSubAccountResp(), False, **kwargs)

    def add_sub_account_api(self, req: AddSubAccountApiReq,
                            **kwargs: Any) -> AddSubAccountApiResp:
        return self.transport.call("broker", True, "POST",
                                   "/api/v1/broker/nd/account/apikey", req,
                                   AddSubAccountApiResp(), False, **kwargs)

    def get_sub_account_api(self, req: GetSubAccountApiReq,
                            **kwargs: Any) -> GetSubAccountApiResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v1/broker/nd/account/apikey", req,
                                   GetSubAccountApiResp(), False, **kwargs)

    def modify_sub_account_api(self, req: ModifySubAccountApiReq,
                               **kwargs: Any) -> ModifySubAccountApiResp:
        return self.transport.call("broker", True, "POST",
                                   "/api/v1/broker/nd/account/update-apikey",
                                   req, ModifySubAccountApiResp(), False,
                                   **kwargs)

    def delete_sub_account_api(self, req: DeleteSubAccountApiReq,
                               **kwargs: Any) -> DeleteSubAccountApiResp:
        return self.transport.call("broker", True, "DELETE",
                                   "/api/v1/broker/nd/account/apikey", req,
                                   DeleteSubAccountApiResp(), False, **kwargs)

    def transfer(self, req: TransferReq, **kwargs: Any) -> TransferResp:
        return self.transport.call("broker", True, "POST",
                                   "/api/v1/broker/nd/transfer", req,
                                   TransferResp(), False, **kwargs)

    def get_transfer_history(self, req: GetTransferHistoryReq,
                             **kwargs: Any) -> GetTransferHistoryResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v3/broker/nd/transfer/detail", req,
                                   GetTransferHistoryResp(), False, **kwargs)

    def get_deposit_list(self, req: GetDepositListReq,
                         **kwargs: Any) -> GetDepositListResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v1/asset/ndbroker/deposit/list", req,
                                   GetDepositListResp(), False, **kwargs)

    def get_deposit_detail(self, req: GetDepositDetailReq,
                           **kwargs: Any) -> GetDepositDetailResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v3/broker/nd/deposit/detail", req,
                                   GetDepositDetailResp(), False, **kwargs)

    def get_withdraw_detail(self, req: GetWithdrawDetailReq,
                            **kwargs: Any) -> GetWithdrawDetailResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v3/broker/nd/withdraw/detail", req,
                                   GetWithdrawDetailResp(), False, **kwargs)

    def get_rebase(self, req: GetRebaseReq, **kwargs: Any) -> GetRebaseResp:
        return self.transport.call("broker", True, "GET",
                                   "/api/v1/broker/nd/rebase/download", req,
                                   GetRebaseResp(), False, **kwargs)
