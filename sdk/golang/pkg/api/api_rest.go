package api

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/service"
)

type KucoinRestService interface {
	// GetAccountService
	// AccountService provides functions to access and manipulate account related data.
	GetAccountService() service.AccountService

	// GetAffiliateService
	// AffiliateService provides functions to access affiliate-related data.
	GetAffiliateService() service.AffiliateService

	// GetBrokerService
	// BrokerService provides functions to access and manage broker-related data.
	GetBrokerService() service.BrokerService

	// GetCopytradingService
	// Provides functions to access and manage copy trading-related data
	GetCopytradingService() service.CopytradingService

	// GetEarnService
	// EarnService provides functions to access and manage earn-related data.
	GetEarnService() service.EarnService

	// GetFuturesService
	// FuturesService provides functions to perform actions in the futures market.
	GetFuturesService() service.FuturesService

	// GetMarginService
	// MarginService provides functions to access and manage margin-related data.
	GetMarginService() service.MarginService

	// GetSpotService
	// SpotService provides functions to perform actions in the spot market.
	GetSpotService() service.SpotService

	// GetVipLendingService
	// VipLendingService provides functions to access and manage VIP lending-related data.
	GetVipLendingService() service.ViplendingService

	GetUTAService() service.UTAService
}
