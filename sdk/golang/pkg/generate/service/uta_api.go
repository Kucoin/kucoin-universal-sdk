package service

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/account"
)

type UTAService interface {
	GetAccountAPI() account.AccountApi
}

type UTAServiceImpl struct {
	AccountApi account.AccountApi
}

func NewUTAService(transport interfaces.Transport) UTAService {
	api := &UTAServiceImpl{}
	api.AccountApi = account.NewAccountApiImp(transport)
	return api
}

func (impl *UTAServiceImpl) GetAccountAPI() account.AccountApi {
	return impl.AccountApi
}
