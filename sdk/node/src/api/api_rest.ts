import { AccountService } from '@generate/service/account_api';
import { AffiliateService } from '@generate/service/affiliate_api';
import { BrokerService } from '@generate/service/broker_api';
import { EarnService } from '@generate/service/earn_api';
import { FuturesService } from '@generate/service/futures_api';
import { MarginService } from '@generate/service/margin_api';
import { SpotService } from '@generate/service/spot_api';
import { VIPLendingService } from '@generate/service/viplending_api';
import { CopyTradingService } from '@src/generate';
import { UTAService } from '@generate/service/uta_api';


export interface KucoinRestService {
    /**
     * AccountService provides functions to access and manipulate account related data.
     */
    getAccountService(): AccountService;

    /**
     * AffiliateService provides functions to access affiliate-related data.
     */
    getAffiliateService(): AffiliateService;

    /**
     * BrokerService provides functions to access and manage broker-related data.
     */
    getBrokerService(): BrokerService;

    /**
     * CopyTradingService provides functions to access and manage copy trading-related data
     */
    getCopyTradingService(): CopyTradingService;

    /**
     * EarnService provides functions to access and manage earn-related data.
     */
    getEarnService(): EarnService;

    /**
     * FuturesService provides functions to perform actions in the futures market.
     */
    getFuturesService(): FuturesService;

    /**
     * MarginService provides functions to access and manage margin-related data.
     */
    getMarginService(): MarginService;

    /**
     * SpotService provides functions to perform actions in the spot market.
     */
    getSpotService(): SpotService;

    /**
     * VipLendingService provides functions to access and manage VIP lending-related data.
     */
    getVipLendingService(): VIPLendingService;


    getUtaService():UTAService;
}
