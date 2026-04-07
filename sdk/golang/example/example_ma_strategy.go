package main

import (
	"context"
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/account/account"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"log"
	"os"
	"os/signal"
	"strconv"
	"time"
)

/**
DISCLAIMER:
This strategy is provided for educational and illustrative purposes only. It is not intended to be used as financial
or investment advice. Trading cryptocurrencies involves significant risk, and you should carefully consider your
investment objectives, level of experience, and risk appetite. Past performance of any trading strategy is not
indicative of future results.

The authors and contributors of this example are not responsible for any financial losses or damages that may occur
from using this code. Use it at your own discretion and consult with a professional financial advisor if necessary.
*/

type Action string

const (
	BUY  Action = "buy"
	SELL Action = "sell"
	SKIP Action = "skip"
)

// A simple moving average crossover strategy example.
// Strategy Logic:
//  1. Calculates two moving averages: short-term and long-term.
//  2. If the short-term moving average crosses above the long-term average, it signals a "buy".
//  3. If the short-term moving average crosses below the long-term average, it signals a "sell".
func simpleMovingAverageStrategy(api market.MarketAPI, symbol string, shortWindow, longWindow int, endTime int64) Action {
	startTime := endTime - int64(longWindow*60)
	log.Printf("Query kline data start Time: %s, end Time: %s", time.Unix(startTime, 0), time.Unix(endTime, 0))

	getKlineReq := market.NewGetKlinesReqBuilder().SetSymbol(symbol).SetType("1min").SetStartAt(startTime).SetEndAt(endTime).Build()

	resp, err := api.GetKlines(getKlineReq, context.Background())
	if err != nil {
		fmt.Printf("Error fetching Klines: %v\n", err)
		panic(err)
	}

	var prices []float64
	for _, kline := range resp.Data {
		// Use close price
		closePrice, err := strconv.ParseFloat(kline[2], 64)
		if err != nil {
			fmt.Printf("Error parsing kline data: %v\n", err)
			panic(err)
		}
		prices = append(prices, closePrice)
	}

	shortSum := 0.0
	longSum := 0.0
	for i := len(prices) - shortWindow; i < len(prices); i++ {
		shortSum += prices[i]
	}
	for i := len(prices) - longWindow; i < len(prices); i++ {
		longSum += prices[i]
	}

	shortMA := shortSum / float64(shortWindow)
	longMA := longSum / float64(longWindow)

	log.Printf("Short MA: %.4f, Long MA: %.4f\n", shortMA, longMA)

	if shortMA > longMA {
		log.Printf("%s: Short MA > Long MA. Should place a BUY order.\n", symbol)
		return BUY
	} else if shortMA < longMA {
		log.Printf("%s: Short MA < Long MA. Should place a SELL order.\n", symbol)
		return SELL
	}
	return SKIP
}

// Fetches the last traded price of a specific symbol
func getLastTradePrice(api market.MarketAPI, symbol string) float64 {
	resp, err := api.Get24hrStats(market.NewGet24hrStatsReqBuilder().SetSymbol(symbol).Build(), context.Background())
	if err != nil {
		fmt.Printf("Error fetching stats: %v\n", err)
		panic(err)
	}
	last, err := strconv.ParseFloat(resp.Last, 64)
	if err != nil {
		fmt.Printf("Error parsing last trade price: %v\n", err)
		panic(err)
	}

	return last
}

// Checks if the available balance is sufficient for the trade.
func checkAvailableBalance(api account.AccountAPI, lastTradePrice, amount float64, action Action) bool {
	currency := "USDT"
	if action == SELL {
		currency = "DOGE"
	}
	log.Printf("Checking balance for currency: %s\n", currency)

	resp, err := api.GetSpotAccountList(account.NewGetSpotAccountListReqBuilder().SetType("trade").SetCurrency(currency).Build(), context.Background())
	if err != nil {
		fmt.Printf("Error fetching balance: %v\n", err)
		panic(err)
	}

	availableBalance := 0.0
	for _, acc := range resp.Data {
		available, err := strconv.ParseFloat(acc.Available, 64)
		if err != nil {
			fmt.Printf("Error parsing available: %v\n", err)
			panic(err)
		}
		availableBalance += available
	}

	tradeValue := lastTradePrice * amount
	if action == BUY {
		if tradeValue <= availableBalance {
			log.Printf("Balance is sufficient for the trade: %.4f %s required.\n", tradeValue, currency)
			return true
		}
		log.Printf("Insufficient balance: %.4f required, but only %.4f available.\n", tradeValue, availableBalance)
		return false
	}
	return amount <= availableBalance
}

// Places a limit order after handling any existing open orders.
func placeOrder(api order.OrderAPI, symbol string, action Action, lastTradePrice, amount, priceDelta float64) {
	openOrders, err := api.GetOpenOrders(order.NewGetOpenOrdersReqBuilder().SetSymbol(symbol).Build(), context.Background())
	if err != nil {
		fmt.Printf("Error fetching open orders: %v", err)
	}

	if len(openOrders.Data) > 0 {
		log.Printf("Found %d open orders. Cancelling all...\n", len(openOrders.Data))
		_, err = api.CancelAllOrders(context.Background())
		if err != nil {
			fmt.Printf("Error canceling all orders: %v\n", err)
			panic(err)
		}
	}

	price := lastTradePrice * (1 - priceDelta)
	side := "buy"
	if action == SELL {
		side = "sell"
		price = lastTradePrice * (1 + priceDelta)
	}

	log.Printf("Placing a %s order at %.4f for %s.", side, price, symbol)
	resp, err := api.AddOrderSync(order.NewAddOrderSyncReqBuilder().SetClientOid(uuid.NewString()).SetSide(side).
		SetSymbol(symbol).SetType("limit").SetPrice(fmt.Sprintf("%.4f", price)).
		SetSize(fmt.Sprintf("%.4f", amount)).Build(), context.Background())
	if err != nil {
		fmt.Printf("Error placing order: %v\n", err)
	}
	log.Printf("Order placed successfully with ID: %s", resp.OrderId)
}

func MAStrategyExample() {
	// Use the default logger or supply your custom logger
	defaultLogger := logger.NewDefaultLogger()
	logger.SetLogger(defaultLogger)

	// Retrieve API secret information from environment variables
	key := os.Getenv("API_KEY")
	secret := os.Getenv("API_SECRET")
	passphrase := os.Getenv("API_PASSPHRASE")

	// Optional: Retrieve broker secret information from environment variables; applicable for broker API only
	brokerName := os.Getenv("BROKER_NAME")
	brokerKey := os.Getenv("BROKER_KEY")
	brokerPartner := os.Getenv("BROKER_PARTNER")

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
		WithBrokerKey(brokerKey).
		WithBrokerName(brokerName).
		WithBrokerPartner(brokerPartner).
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

	accountApi := kuCoinRestService.GetAccountService().GetAccountAPI()
	marketApi := kuCoinRestService.GetSpotService().GetMarketAPI()
	orderApi := kuCoinRestService.GetSpotService().GetOrderAPI()

	symbol := "DOGE-USDT"
	orderAmount := 10.0
	priceDelta := 0.1
	interval := time.Minute
	currentTime := time.Now().Unix() / 60 * 60

	log.Println("Starting the moving average strategy using K-line data. Press Ctrl+C to stop.")
	stop := make(chan os.Signal, 1)
	signal.Notify(stop, os.Interrupt)

	for {
		select {
		case <-stop:
			log.Println("Strategy stopped by user.")
			return
		default:
			action := simpleMovingAverageStrategy(marketApi, symbol, 10, 30, currentTime)
			if action != SKIP {
				lastPrice := getLastTradePrice(marketApi, symbol)
				log.Printf("Last trade price for %s: %.4f", symbol, lastPrice)
				if checkAvailableBalance(accountApi, lastPrice, orderAmount, action) {
					log.Println("Sufficient balance available. Attempting to place the order...")
					placeOrder(orderApi, symbol, action, lastPrice, orderAmount, priceDelta)
				} else {
					log.Println("Insufficient balance. Skipping the trade...")
				}
			}
			log.Println("Waiting for 1 minute before the next run...")
			time.Sleep(interval)
			currentTime += 60
		}
	}
}
