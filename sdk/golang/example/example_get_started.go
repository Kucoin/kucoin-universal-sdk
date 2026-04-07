package main

import (
	"context"
	"os"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func GetStarted() {
	// Use the default logger or supply your custom logger
	defaultLogger := logger.NewDefaultLogger()
	logger.SetLogger(defaultLogger)

	// Retrieve API secret information from environment variables
	key := os.Getenv("API_KEY")
	secret := os.Getenv("API_SECRET")
	passphrase := os.Getenv("API_PASSPHRASE")

	// Set specific options, others will fall back to default values
	httpOption := types.NewTransportOptionBuilder().
		SetKeepAlive(true).
		SetMaxIdleConnsPerHost(10).
		Build()

	// Create a client using the specified options
	option := types.NewClientOptionBuilder().
		WithKey(key).
		WithSecret(secret).
		WithPassphrase(passphrase).
		WithSnitchProxyURL(os.Getenv("SNITCH_PROXY_URL")).
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithTransportOption(httpOption).
		Build()
	client, err := api.NewClient(option)
	if err != nil {
		panic(err)
	}

	// Get the Restful Service
	kuCoinRestService := client.RestService()

	// Get Spot Market API
	spotMarketAPI := kuCoinRestService.GetSpotService().GetMarketAPI()

	request := market.NewGetPartOrderBookReqBuilder().
		SetSymbol("BTC-USDT").
		SetSize("20").
		Build()

	// Query for part orderbook depth data. (aggregated by price)
	response, err := spotMarketAPI.GetPartOrderBook(request, context.Background())
	if err != nil {
		logger.GetLogger().Errorf("failed to get part order book: %v", err)
		return
	}
	logger.GetLogger().Infof("time=%d, sequence=%s, bids=%v, asks=%v", response.Time, response.Sequence, response.Bids, response.Asks)
}
