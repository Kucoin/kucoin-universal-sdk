
import { Transport } from '@internal/interfaces/transport';

import { AccountAPI, AccountAPIImpl } from '@generate/uta/account/api_account';
import { AffiliateAPI, AffiliateAPIImpl } from '@generate/uta/affiliate/api_affiliate';
import { MarketAPI, MarketAPIImpl } from '@generate/uta/market/api_market';
import { OrderAPI, OrderAPIImpl } from '@generate/uta/order/api_order';
import { PositionsAPI, PositionsAPIImpl } from '@generate/uta/positions/api_positions';
import { VIPLendingAPI, VIPLendingAPIImpl } from '@generate/uta/viplending/api_vip_lending';

export interface UTAService {
    getAccountApi(): AccountAPI;
    getAffiliateApi(): AffiliateAPI;
    getMarketApi(): MarketAPI;
    getOrderApi(): OrderAPI;
    getPositionsApi(): PositionsAPI;
    getVIPLendingApi(): VIPLendingAPI;
}

export class UTAServiceImpl implements UTAService {
    private readonly transport: Transport;
    private readonly account: AccountAPI;
    private readonly affiliate: AffiliateAPI;
    private readonly market: MarketAPI;
    private readonly order: OrderAPI;
    private readonly positions: PositionsAPI;
    private readonly vipLending: VIPLendingAPI;

    constructor(transport: Transport) {
        this.transport = transport;
        this.account = new AccountAPIImpl(transport);
        this.affiliate = new AffiliateAPIImpl(transport);
        this.market = new MarketAPIImpl(transport);
        this.order = new OrderAPIImpl(transport);
        this.positions = new PositionsAPIImpl(transport);
        this.vipLending = new VIPLendingAPIImpl(transport);
    }

    getAccountApi(): AccountAPI {
        return this.account;
    }

    getAffiliateApi(): AffiliateAPI {
        return this.affiliate;
    }

    getMarketApi(): MarketAPI {
        return this.market;
    }

    getOrderApi(): OrderAPI {
        return this.order;
    }

    getPositionsApi(): PositionsAPI {
        return this.positions;
    }

    getVIPLendingApi(): VIPLendingAPI {
        return this.vipLending;
    }
}
