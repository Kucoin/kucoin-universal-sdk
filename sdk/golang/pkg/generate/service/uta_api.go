package service

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/account"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/affiliate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/positions"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/viplending"
)

type UTAService interface {
	GetAccountAPI() account.AccountAPI
	GetAffiliateAPI() affiliate.AffiliateAPI
	GetMarketAPI() market.MarketAPI
	GetOrderAPI() order.OrderAPI
	GetPositionsAPI() positions.PositionsAPI
	GetVIPLendingAPI() viplending.VIPLendingAPI
}

type UTAServiceImpl struct {
	AccountAPI    account.AccountAPI
	AffiliateAPI  affiliate.AffiliateAPI
	MarketAPI     market.MarketAPI
	OrderAPI      order.OrderAPI
	PositionsAPI  positions.PositionsAPI
	VIPLendingAPI viplending.VIPLendingAPI
}

func NewUTAService(transport interfaces.Transport) UTAService {
	api := &UTAServiceImpl{}
	api.AccountAPI = account.NewAccountAPIImp(transport)
	api.AffiliateAPI = affiliate.NewAffiliateAPIImp(transport)
	api.MarketAPI = market.NewMarketAPIImp(transport)
	api.OrderAPI = order.NewOrderAPIImp(transport)
	api.PositionsAPI = positions.NewPositionsAPIImp(transport)
	api.VIPLendingAPI = viplending.NewVIPLendingAPIImp(transport)
	return api
}

func (impl *UTAServiceImpl) GetAccountAPI() account.AccountAPI {
	return impl.AccountAPI
}

func (impl *UTAServiceImpl) GetAffiliateAPI() affiliate.AffiliateAPI {
	return impl.AffiliateAPI
}

func (impl *UTAServiceImpl) GetMarketAPI() market.MarketAPI {
	return impl.MarketAPI
}

func (impl *UTAServiceImpl) GetOrderAPI() order.OrderAPI {
	return impl.OrderAPI
}

func (impl *UTAServiceImpl) GetPositionsAPI() positions.PositionsAPI {
	return impl.PositionsAPI
}

func (impl *UTAServiceImpl) GetVIPLendingAPI() viplending.VIPLendingAPI {
	return impl.VIPLendingAPI
}
