from abc import ABC, abstractmethod

from kucoin_universal_sdk.generate.service.account_api import AccountService
from kucoin_universal_sdk.generate.service.affiliate_api import AffiliateService
from kucoin_universal_sdk.generate.service.broker_api import BrokerService
from kucoin_universal_sdk.generate.service.copytrading_api import CopyTradingService
from kucoin_universal_sdk.generate.service.earn_api import EarnService
from kucoin_universal_sdk.generate.service.futures_api import FuturesService
from kucoin_universal_sdk.generate.service.margin_api import MarginService
from kucoin_universal_sdk.generate.service.spot_api import SpotService
from kucoin_universal_sdk.generate.service.viplending_api import VIPLendingService
from kucoin_universal_sdk.generate.service.uta_api import UTAService


class KucoinRestService(ABC):

    @abstractmethod
    def get_account_service(self) -> AccountService:
        """Provides functions to access and manipulate account-related data."""
        pass

    @abstractmethod
    def get_affiliate_service(self) -> AffiliateService:
        """Provides functions to access affiliate-related data."""
        pass

    @abstractmethod
    def get_broker_service(self) -> BrokerService:
        """Provides functions to access and manage broker-related data."""
        pass

    @abstractmethod
    def get_copytrading_service(self) -> CopyTradingService:
        """Provides functions to access and manage copy trading-related data."""
        pass

    @abstractmethod
    def get_earn_service(self) -> EarnService:
        """Provides functions to access and manage earn-related data."""
        pass

    @abstractmethod
    def get_futures_service(self) -> FuturesService:
        """Provides functions to perform actions in the futures market."""
        pass

    @abstractmethod
    def get_margin_service(self) -> MarginService:
        """Provides functions to access and manage margin-related data."""
        pass

    @abstractmethod
    def get_spot_service(self) -> SpotService:
        """Provides functions to perform actions in the spot market."""
        pass

    @abstractmethod
    def get_vip_lending_service(self) -> VIPLendingService:
        """Provides functions to access and manage VIP lending-related data."""
        pass

    @abstractmethod
    def get_uta_service(self) -> UTAService:
        pass
