
package com.kucoin.universal.sdk.generate.service;

import com.kucoin.universal.sdk.generate.uta.account.AccountApi;
import com.kucoin.universal.sdk.generate.uta.account.AccountApiImpl;
import com.kucoin.universal.sdk.generate.uta.affiliate.AffiliateApi;
import com.kucoin.universal.sdk.generate.uta.affiliate.AffiliateApiImpl;
import com.kucoin.universal.sdk.generate.uta.market.MarketApi;
import com.kucoin.universal.sdk.generate.uta.market.MarketApiImpl;
import com.kucoin.universal.sdk.generate.uta.order.OrderApi;
import com.kucoin.universal.sdk.generate.uta.order.OrderApiImpl;
import com.kucoin.universal.sdk.generate.uta.positions.PositionsApi;
import com.kucoin.universal.sdk.generate.uta.positions.PositionsApiImpl;
import com.kucoin.universal.sdk.generate.uta.viplending.VIPLendingApi;
import com.kucoin.universal.sdk.generate.uta.viplending.VIPLendingApiImpl;
import com.kucoin.universal.sdk.internal.interfaces.Transport;


public class UTAServiceImpl implements UTAService{
    private AccountApi account;
    private MarketApi market;
    private VIPLendingApi vipLending;
    private PositionsApi positions;
    private OrderApi order;
    private AffiliateApi affiliate;

    public UTAServiceImpl(Transport transport) {
        this.account = new AccountApiImpl(transport);
        this.market = new MarketApiImpl(transport);
        this.vipLending = new VIPLendingApiImpl(transport);
        this.positions = new PositionsApiImpl(transport);
        this.order = new OrderApiImpl(transport);
        this.affiliate = new AffiliateApiImpl(transport);
    }


    public AccountApi getAccountApi() {
        return this.account;
    }

    public MarketApi getMarketApi() {
        return this.market;
    }

    public VIPLendingApi getVIPLendingApi() {
        return this.vipLending;
    }

    public PositionsApi getPositionsApi() {
        return this.positions;
    }

    public OrderApi getOrderApi() {
        return this.order;
    }

    public AffiliateApi getAffiliateApi() {
        return this.affiliate;
    }
}
