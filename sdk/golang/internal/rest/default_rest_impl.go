package rest

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/infra"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/service"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

type KuCoinDefaultRestImpl struct {
	accountService     service.AccountService
	affiliateService   service.AffiliateService
	brokerService      service.BrokerService
	copytradingService service.CopytradingService
	earnService        service.EarnService
	futuresService     service.FuturesService
	marginService      service.MarginService
	spotService        service.SpotService
	vipLendingService  service.ViplendingService
	utaService         service.UTAService
}

func NewKuCoinDefaultRestImpl(op *types.ClientOption) *KuCoinDefaultRestImpl {
	if op == nil || op.TransportOption == nil {
		logger.GetLogger().Warnf("no transport option provided")
		return nil
	}

	logger.GetLogger().Infof("sdk version: %s", generate.SdkVersion)
	transport := infra.NewDefaultTransport(op, generate.SdkVersion)

	return &KuCoinDefaultRestImpl{
		accountService:     service.NewAccountService(transport),
		affiliateService:   service.NewAffiliateService(transport),
		brokerService:      service.NewBrokerService(transport),
		copytradingService: service.NewCopytradingService(transport),
		earnService:        service.NewEarnService(transport),
		futuresService:     service.NewFuturesService(transport),
		marginService:      service.NewMarginService(transport),
		spotService:        service.NewSpotService(transport),
		vipLendingService:  service.NewViplendingService(transport),
		utaService:         service.NewUTAService(transport),
	}
}

func (impl *KuCoinDefaultRestImpl) GetAccountService() service.AccountService {
	return impl.accountService
}

func (impl *KuCoinDefaultRestImpl) GetAffiliateService() service.AffiliateService {
	return impl.affiliateService
}

func (impl *KuCoinDefaultRestImpl) GetBrokerService() service.BrokerService {
	return impl.brokerService
}

func (impl *KuCoinDefaultRestImpl) GetCopytradingService() service.CopytradingService {
	return impl.copytradingService
}

func (impl *KuCoinDefaultRestImpl) GetEarnService() service.EarnService {
	return impl.earnService
}

func (impl *KuCoinDefaultRestImpl) GetFuturesService() service.FuturesService {
	return impl.futuresService
}

func (impl *KuCoinDefaultRestImpl) GetMarginService() service.MarginService {
	return impl.marginService
}

func (impl *KuCoinDefaultRestImpl) GetSpotService() service.SpotService {
	return impl.spotService
}

func (impl *KuCoinDefaultRestImpl) GetVipLendingService() service.ViplendingService {
	return impl.vipLendingService
}

func (impl *KuCoinDefaultRestImpl) GetUTAService() service.UTAService {
	return impl.utaService
}
