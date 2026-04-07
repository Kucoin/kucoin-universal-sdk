package main

import (
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/futurespublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"os"
	"time"
)

func WsExample() {
	// Use the default logger or supply your custom logger
	defaultLogger := logger.NewDefaultLogger()
	logger.SetLogger(defaultLogger)

	// Retrieve API secret information from environment variables
	key := os.Getenv("API_KEY")
	secret := os.Getenv("API_SECRET")
	passphrase := os.Getenv("API_PASSPHRASE")

	// Set specific options, others will fall back to default values
	wsOption := types.NewWebSocketClientOptionBuilder().Build()

	// Create a client using the specified options
	option := types.NewClientOptionBuilder().
		WithKey(key).
		WithSecret(secret).
		WithPassphrase(passphrase).
		WithSnitchProxyURL(os.Getenv("SNITCH_PROXY_URL")).
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithWebSocketClientOption(wsOption).
		Build()
	client, err := api.NewClient(option)
	if err != nil {
		panic(err)
	}

	// Get the websocket service
	wsService := client.WsService()

	spotWsExample(wsService.NewSpotPublicWS())
	futuresWsExample(wsService.NewFuturesPublicWS())
}

func spotWsExample(spotPublicWs spotpublic.SpotPublicWS) {
	err := spotPublicWs.Start()
	if err != nil {
		logger.GetLogger().Error("failed to start spot public websocket: %v", err)
		return
	}
	defer spotPublicWs.Stop()

	tickerEventCallback := func(topic string, subject string, data *spotpublic.TickerEvent) error {
		// Process logic
		logger.GetLogger().Infof("received ticker event %s %s %s %s %d %s",
			topic, subject, data.Sequence, data.Price, data.Time, data.Size)
		return nil
	}

	// Get ticker
	subId, err := spotPublicWs.Ticker([]string{"BTC-USDT"}, tickerEventCallback)

	if err != nil {
		logger.GetLogger().Fatalf("subscribe error: %v", err)
		return
	}

	// Triggered when certain conditions are met
	<-time.After(time.Second * 10)

	// Unsubscribe by sub id
	err = spotPublicWs.UnSubscribe(subId)
	if err != nil {
		logger.GetLogger().Fatalf("unsubscribe error: %v, id: %s", err, subId)
	}
}

func futuresWsExample(futuresPublicWs futurespublic.FuturesPublicWS) {
	err := futuresPublicWs.Start()
	if err != nil {
		logger.GetLogger().Fatalf("failed to start futures public websocket: %v", err)
		return
	}

	defer futuresPublicWs.Stop()

	tickerEventV2Callback := func(topic string, subject string, data *futurespublic.TickerV2Event) error {
		logger.GetLogger().Infof("received ticker event %+v", data.ToMap())
		return nil
	}

	//  Get Ticker
	subId, err := futuresPublicWs.TickerV2("XBTUSDTM", tickerEventV2Callback)

	if err != nil {
		logger.GetLogger().Fatalf("subscribe error: %v", err)
		return
	}
	// Triggered when certain conditions are met
	<-time.After(time.Second * 10)
	err = futuresPublicWs.UnSubscribe(subId)
	if err != nil {
		logger.GetLogger().Fatalf("unsubscribe error: %v, id: %s", err, subId)
	}
}
