package api

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/futuresprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/futurespublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/margin/marginprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/margin/marginpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotprivate"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/privatews"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/publicws"
)

type KucoinWSService interface {
	// NewSpotPublicWS returns the interface to interact with
	// the Spot Trading websocket(public channel) API of Kucoin.
	NewSpotPublicWS() spotpublic.SpotPublicWS

	// NewSpotPrivateWS returns the interface to interact with
	// the Spot Trading websocket(private channel) API of Kucoin.
	NewSpotPrivateWS() spotprivate.SpotPrivateWS

	// NewMarginPublicWS returns the interface to interact with
	// the Margin Trading websocket(public channel) API of Kucoin.
	NewMarginPublicWS() marginpublic.MarginPublicWS

	// NewMarginPrivateWS returns the interface to interact with
	// the Margin Trading websocket(private channel) API of Kucoin.
	NewMarginPrivateWS() marginprivate.MarginPrivateWS

	// NewFuturesPublicWS returns the interface to interact with
	// the Futures Trading websocket(public channel) API of Kucoin.
	NewFuturesPublicWS() futurespublic.FuturesPublicWS

	// NewFuturesPrivateWS returns the interface to interact with
	// the Futures Trading websocket(private channel) API of Kucoin.
	NewFuturesPrivateWS() futuresprivate.FuturesPrivateWS

	// NewUtaPublicWS returns a direct UTA public push WebSocket service for SPOT or FUTURES.
	NewUtaPublicWS(tradeType publicws.PushTradeType) publicws.UtaPublicWS

	// NewUtaPrivateWS returns the authenticated direct UTA private push WebSocket service.
	NewUtaPrivateWS() privatews.UtaPrivateWS

	// NewUtaPrivateTradeWS returns the authenticated direct UTA WebSocket trading service.
	NewUtaPrivateTradeWS() privatews.UtaPrivateTradeWS
}
