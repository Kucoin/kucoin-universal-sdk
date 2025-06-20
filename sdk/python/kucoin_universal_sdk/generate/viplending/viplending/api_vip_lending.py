# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from abc import ABC, abstractmethod
from typing import Any
from kucoin_universal_sdk.internal.interfaces.transport import Transport
from .model_get_accounts_resp import GetAccountsResp
from .model_get_discount_rate_configs_resp import GetDiscountRateConfigsResp
from .model_get_loan_info_resp import GetLoanInfoResp


class VIPLendingAPI(ABC):

    @abstractmethod
    def get_discount_rate_configs(self,
                                  **kwargs: Any) -> GetDiscountRateConfigsResp:
        """
        summary: Get Discount Rate Configs
        description: Get the gradient discount rate of each currency
        documentation: https://www.kucoin.com/docs-new/api-3471463
        +-----------------------+---------+
        | Extra API Info        | Value   |
        +-----------------------+---------+
        | API-DOMAIN            | SPOT    |
        | API-CHANNEL           | PRIVATE |
        | API-PERMISSION        | NULL    |
        | API-RATE-LIMIT-POOL   | PUBLIC  |
        | API-RATE-LIMIT-WEIGHT | 10      |
        +-----------------------+---------+
        """
        pass

    @abstractmethod
    def get_loan_info(self, **kwargs: Any) -> GetLoanInfoResp:
        """
        summary: Get Loan Info
        description: The following information is only applicable to loans.  Get information on off-exchange funding and loans. This endpoint is only for querying accounts that are currently involved in loans.
        documentation: https://www.kucoin.com/docs-new/api-3470277
        +-----------------------+------------+
        | Extra API Info        | Value      |
        +-----------------------+------------+
        | API-DOMAIN            | SPOT       |
        | API-CHANNEL           | PRIVATE    |
        | API-PERMISSION        | SPOT       |
        | API-RATE-LIMIT-POOL   | MANAGEMENT |
        | API-RATE-LIMIT-WEIGHT | 5          |
        +-----------------------+------------+
        """
        pass

    @abstractmethod
    def get_accounts(self, **kwargs: Any) -> GetAccountsResp:
        """
        summary: Get Accounts
        description: Accounts participating in OTC lending. This interface is only for querying accounts currently running OTC lending.
        documentation: https://www.kucoin.com/docs-new/api-3470278
        +-----------------------+------------+
        | Extra API Info        | Value      |
        +-----------------------+------------+
        | API-DOMAIN            | SPOT       |
        | API-CHANNEL           | PRIVATE    |
        | API-PERMISSION        | SPOT       |
        | API-RATE-LIMIT-POOL   | MANAGEMENT |
        | API-RATE-LIMIT-WEIGHT | 20         |
        +-----------------------+------------+
        """
        pass


class VIPLendingAPIImpl(VIPLendingAPI):

    def __init__(self, transport: Transport):
        self.transport = transport

    def get_discount_rate_configs(self,
                                  **kwargs: Any) -> GetDiscountRateConfigsResp:
        return self.transport.call("spot", False, "GET",
                                   "/api/v1/otc-loan/discount-rate-configs",
                                   None, GetDiscountRateConfigsResp(), False,
                                   **kwargs)

    def get_loan_info(self, **kwargs: Any) -> GetLoanInfoResp:
        return self.transport.call("spot", False, "GET",
                                   "/api/v1/otc-loan/loan", None,
                                   GetLoanInfoResp(), False, **kwargs)

    def get_accounts(self, **kwargs: Any) -> GetAccountsResp:
        return self.transport.call("spot", False, "GET",
                                   "/api/v1/otc-loan/accounts", None,
                                   GetAccountsResp(), False, **kwargs)
