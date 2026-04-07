package main

import (
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/spotpublic"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"log"
	"os"
	"strconv"
	"sync"
	"time"
)

type KLine struct {
	Open      float64
	High      float64
	Low       float64
	Close     float64
	Volume    float64
	StartTime int64
	EndTime   int64
}

var (
	klineData    = make(map[int64]map[string]*KLine)
	klineMutex   = sync.Mutex{}
	timeInterval = int64(60)
)

func onTradeData(topic, subject string, tradeEvent *spotpublic.TradeEvent) error {
	klineMutex.Lock()
	defer klineMutex.Unlock()

	t, err := strconv.ParseInt(tradeEvent.Time, 10, 64)
	if err != nil {
		fmt.Println(err)
		return err
	}

	p, err := strconv.ParseFloat(tradeEvent.Price, 64)
	if err != nil {
		fmt.Println(err)
		return err
	}

	s, err := strconv.ParseFloat(tradeEvent.Size, 64)
	if err != nil {
		fmt.Println(err)
		return err
	}

	symbol := tradeEvent.Symbol
	price := p
	size := s
	timestamp := t / 1e9

	periodStart := (timestamp / timeInterval) * timeInterval
	periodEnd := periodStart + timeInterval

	if _, ok := klineData[periodStart]; !ok {
		klineData[periodStart] = make(map[string]*KLine)
	}

	if _, ok := klineData[periodStart][symbol]; !ok {
		klineData[periodStart][symbol] = &KLine{
			Open:      price,
			High:      price,
			Low:       price,
			Close:     price,
			Volume:    size,
			StartTime: periodStart,
			EndTime:   periodEnd,
		}
	} else {
		kline := klineData[periodStart][symbol]
		kline.High = max(kline.High, price)
		kline.Low = min(kline.Low, price)
		kline.Close = price
		kline.Volume += size
	}

	log.Printf("KLine for %s @ %s: %+v", symbol, time.Unix(periodStart, 0), klineData[periodStart][symbol])
	return nil
}

func printKlineData() {
	klineMutex.Lock()
	defer klineMutex.Unlock()

	for periodStart, symbols := range klineData {
		fmt.Printf("\nTime Period: %s\n", time.Unix(periodStart, 0))
		for symbol, kline := range symbols {
			fmt.Printf("  Symbol: %s\n", symbol)
			fmt.Printf("    Open: %.2f\n", kline.Open)
			fmt.Printf("    High: %.2f\n", kline.High)
			fmt.Printf("    Low: %.2f\n", kline.Low)
			fmt.Printf("    Close: %.2f\n", kline.Close)
			fmt.Printf("    Volume: %.2f\n", kline.Volume)
			fmt.Printf("    Start Time: %s\n", time.Unix(kline.StartTime, 0))
			fmt.Printf("    End Time: %s\n", time.Unix(kline.EndTime, 0))
		}
	}
}

func RealTimeKlineExample() {
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

	spotPublicWs := wsService.NewSpotPublicWS()
	err = spotPublicWs.Start()
	if err != nil {
		panic(err)
	}
	defer spotPublicWs.Stop()

	subId, err := spotPublicWs.Trade([]string{"BTC-USDT", "ETH-USDT"}, onTradeData)
	if err != nil {
		panic(err)
	}

	time.Sleep(3 * time.Minute)

	err = spotPublicWs.UnSubscribe(subId)
	if err != nil {
		panic(err)
	}

	printKlineData()

	log.Println("Program finished.")
}
