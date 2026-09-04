package com.kucoin.universal.sdk.internal.rest;

import com.kucoin.universal.sdk.api.KucoinRestService;
import com.kucoin.universal.sdk.generate.Version;
import com.kucoin.universal.sdk.generate.service.*;
import com.kucoin.universal.sdk.internal.infra.DefaultTransport;
import com.kucoin.universal.sdk.internal.interfaces.Transport;
import com.kucoin.universal.sdk.model.ClientOption;
import lombok.extern.slf4j.Slf4j;

/**
 * DefaultKucoinRestAPIImpl is the default implementation of {@link KucoinRestService}. It wires
 * every generated REST service implementation with a shared {@link DefaultTransport}.
 */
@Slf4j
public final class DefaultKucoinRestAPIImpl implements KucoinRestService {


  private final AccountService accountService;
  private final AffiliateService affiliateService;
  private final BrokerService brokerService;
  private final CopyTradingService copyTradingService;
  private final EarnService earnService;
  private final FuturesService futuresService;
  private final MarginService marginService;
  private final SpotService spotService;
  private final VIPLendingService vipLendingService;
  private final Transport transport;
  private final UTAService utaService;

  public DefaultKucoinRestAPIImpl(ClientOption option) {
    if (option.getTransportOption() == null) {
      throw new RuntimeException("no transport option provided");
    }
    transport = new DefaultTransport(option, Version.SDK_VERSION);
    this.utaService = new UTAServiceImpl(transport);
    this.accountService = new AccountServiceImpl(transport);
    this.affiliateService = new AffiliateServiceImpl(transport);
    this.brokerService = new BrokerServiceImpl(transport);
    this.copyTradingService = new CopyTradingServiceImpl(transport);
    this.earnService = new EarnServiceImpl(transport);
    this.futuresService = new FuturesServiceImpl(transport);
    this.marginService = new MarginServiceImpl(transport);
    this.spotService = new SpotServiceImpl(transport);
    this.vipLendingService = new VIPLendingServiceImpl(transport);

    log.info("SDK version: {}", Version.SDK_VERSION);
  }

  @Override
  public AccountService getAccountService() {
    return accountService;
  }

  @Override
  public AffiliateService getAffiliateService() {
    return affiliateService;
  }

  @Override
  public BrokerService getBrokerService() {
    return brokerService;
  }

  @Override
  public CopyTradingService getCopytradingService() {
    return copyTradingService;
  }

  @Override
  public EarnService getEarnService() {
    return earnService;
  }

  @Override
  public FuturesService getFuturesService() {
    return futuresService;
  }

  @Override
  public MarginService getMarginService() {
    return marginService;
  }

  @Override
  public SpotService getSpotService() {
    return spotService;
  }

  @Override
  public VIPLendingService getVipLendingService() {
    return vipLendingService;
  }

  @Override
  public UTAService getUTAService() {
        return utaService;
  }

    @Override
  public void closeService() {
    transport.close();
  }
}
