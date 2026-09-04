import logging

from kucoin_universal_sdk.api.api_rest import KucoinRestService
from kucoin_universal_sdk.generate.service.account_api import AccountService, AccountServiceImpl
from kucoin_universal_sdk.generate.service.affiliate_api import AffiliateService, AffiliateServiceImpl
from kucoin_universal_sdk.generate.service.broker_api import BrokerService, BrokerServiceImpl
from kucoin_universal_sdk.generate.service.copytrading_api import CopyTradingService, CopyTradingServiceImpl
from kucoin_universal_sdk.generate.service.earn_api import EarnService, EarnServiceImpl
from kucoin_universal_sdk.generate.service.futures_api import FuturesService, FuturesServiceImpl
from kucoin_universal_sdk.generate.service.margin_api import MarginService, MarginServiceImpl
from kucoin_universal_sdk.generate.service.spot_api import SpotService, SpotServiceImpl
from kucoin_universal_sdk.generate.service.viplending_api import VIPLendingService, VIPLendingServiceImpl
from kucoin_universal_sdk.generate.service.uta_api import UTAService,UTAServiceImpl

from kucoin_universal_sdk.generate.version import sdk_version
from kucoin_universal_sdk.internal.infra.default_transport import DefaultTransport
from kucoin_universal_sdk.model.client_option import ClientOption


class DefaultKucoinRestAPIImpl(KucoinRestService):
    def __init__(self, options: ClientOption):
        if options is None or options.transport_option is None:
            raise Exception("no transport option provided")

        logging.info(f"sdk version: {sdk_version}")

        transport = DefaultTransport(options, sdk_version)

        self.account_service = AccountServiceImpl(transport)
        self.affiliate_service = AffiliateServiceImpl(transport)
        self.broker_service = BrokerServiceImpl(transport)
        self.copytrading_service = CopyTradingServiceImpl(transport)
        self.earn_service = EarnServiceImpl(transport)
        self.futures_service = FuturesServiceImpl(transport)
        self.margin_service = MarginServiceImpl(transport)
        self.spot_service = SpotServiceImpl(transport)
        self.vip_lending_service = VIPLendingServiceImpl(transport)
        self.uta_service = UTAServiceImpl(transport)


    def get_account_service(self) -> AccountService:
        return self.account_service

    def get_affiliate_service(self) -> AffiliateService:
        return self.affiliate_service

    def get_broker_service(self) -> BrokerService:
        return self.broker_service

    def get_copytrading_service(self) -> CopyTradingService:
        return self.copytrading_service

    def get_earn_service(self) -> EarnService:
        return self.earn_service

    def get_futures_service(self) -> FuturesService:
        return self.futures_service

    def get_margin_service(self) -> MarginService:
        return self.margin_service

    def get_spot_service(self) -> SpotService:
        return self.spot_service

    def get_vip_lending_service(self) -> VIPLendingService:
        return self.vip_lending_service

    def get_uta_service(self) -> UTAService:
        return self.uta_service
