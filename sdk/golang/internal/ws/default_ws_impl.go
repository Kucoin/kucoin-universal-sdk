package ws

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/infra"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/futuresprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/futurespublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/margin/marginprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/margin/marginpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/privatews"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/publicws"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

type KuCoinDefaultWsImpl struct {
	option *types.ClientOption
}

func NewKuCoinDefaultWsImpl(op *types.ClientOption) *KuCoinDefaultWsImpl {
	if op == nil {
		logger.GetLogger().Warnf("no client option provided")
		return nil
	}
	if op.WebSocketClientOption == nil {
		logger.GetLogger().Warnf("no websocket option provided; using defaults")
		op.WebSocketClientOption = types.NewWebSocketClientOption()
	}

	return &KuCoinDefaultWsImpl{
		op,
	}
}

func (impl *KuCoinDefaultWsImpl) NewSpotPublicWS() spotpublic.SpotPublicWS {
	return spotpublic.NewSpotPublicWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeSpot, false, generate.SdkVersion))
}

func (impl *KuCoinDefaultWsImpl) NewSpotPrivateWS() spotprivate.SpotPrivateWS {
	return spotprivate.NewSpotPrivateWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeSpot, true, generate.SdkVersion))
}

func (impl *KuCoinDefaultWsImpl) NewFuturesPublicWS() futurespublic.FuturesPublicWS {
	return futurespublic.NewFuturesPublicWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeFutures, false, generate.SdkVersion))
}

func (impl *KuCoinDefaultWsImpl) NewFuturesPrivateWS() futuresprivate.FuturesPrivateWS {
	return futuresprivate.NewFuturesPrivateWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeFutures, true, generate.SdkVersion))
}

func (impl *KuCoinDefaultWsImpl) NewMarginPublicWS() marginpublic.MarginPublicWS {
	return marginpublic.NewMarginPublicWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeSpot, false, generate.SdkVersion))

}

func (impl *KuCoinDefaultWsImpl) NewMarginPrivateWS() marginprivate.MarginPrivateWS {
	return marginprivate.NewMarginPrivateWSImp(infra.NewDefaultWsService(impl.option, types.DomainTypeSpot, true, generate.SdkVersion))
}

func (impl *KuCoinDefaultWsImpl) NewUtaPublicWS(tradeType publicws.PushTradeType) publicws.UtaPublicWS {
	return publicws.NewUtaPublicWSImpl(impl.option.WebSocketClientOption, tradeType)
}

func (impl *KuCoinDefaultWsImpl) NewUtaPrivateWS() privatews.UtaPrivateWS {
	return privatews.NewUtaPrivateWSImpl(impl.option)
}

func (impl *KuCoinDefaultWsImpl) NewUtaPrivateTradeWS() privatews.UtaPrivateTradeWS {
	return privatews.NewUtaPrivateTradeWSImpl(impl.option)
}
