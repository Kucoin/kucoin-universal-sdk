package main

import (
	"context"
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/account/account"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/fundingfees"
	futuresMarket "github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/market"
	futuresOrder "github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/order"
	marginOrder "github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/margin/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/service"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"math"
	"os"
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

const (
	SPOT_SYMBOL                   = "DOGE-USDT"
	FUTURES_SYMBOL                = "DOGEUSDTM"
	BASE_CURRENCY                 = "USDT"
	MAX_PLACE_ORDER_WAIT_TIME_SEC = 15
)

type MarketType string

const (
	SPOT    MarketType = "SPOT"
	MARGIN  MarketType = "MARGIN"
	FUTURES MarketType = "FUTURES"
)

func parseOrPanic(value string) float64 {
	f, err := strconv.ParseFloat(value, 64)
	if err != nil {
		fmt.Printf("prase value error, %+v\n", err)
		panic(err)
	}
	return f
}

func checkAccountAvailableBalance(accountApi account.AccountAPI, price float64, amount float64, marketType MarketType) bool {
	tradeValue := price * amount

	if marketType == SPOT {
		// Check spot account
		getSpotAccountReq := account.NewGetSpotAccountListReqBuilder().
			SetType("trade").
			SetCurrency(BASE_CURRENCY).
			Build()

		getSpotAccountResp, err := accountApi.GetSpotAccountList(getSpotAccountReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching spot account balance: %v\n", err)
			panic(err)
		}

		spotAvailableBalance := 0.0
		for _, accountData := range getSpotAccountResp.Data {
			spotAvailableBalance += parseOrPanic(accountData.Available)
		}
		fmt.Printf("[SPOT] Available %s balance: %.2f, Required: %.2f\n", BASE_CURRENCY, spotAvailableBalance, tradeValue)
		return spotAvailableBalance >= tradeValue

	} else if marketType == FUTURES {
		// Check futures account
		getFuturesAccountReq := account.NewGetFuturesAccountReqBuilder().
			SetCurrency(BASE_CURRENCY).
			Build()

		getFuturesAccountResp, err := accountApi.GetFuturesAccount(getFuturesAccountReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching futures account balance: %v\n", err)
			panic(err)
		}

		futuresAvailableBalance := float64(getFuturesAccountResp.AvailableBalance)
		fmt.Printf("[FUTURES] Available %s balance: %.2f, Required: %.2f\n", BASE_CURRENCY, futuresAvailableBalance, tradeValue)
		return futuresAvailableBalance >= tradeValue

	} else {
		// Check margin account
		getMarginAccountReq := account.NewGetCrossMarginAccountReqBuilder().
			SetQueryType("MARGIN").
			SetQuoteCurrency("USDT").
			Build()

		getMarginAccountResp, err := accountApi.GetCrossMarginAccount(getMarginAccountReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching margin account balance: %v\n", err)
			panic(err)
		}

		marginAvailableBalance := parseOrPanic(getMarginAccountResp.TotalAssetOfQuoteCurrency)
		fmt.Printf("[MARGIN] Available %s balance: %.2f, Required: %.2f\n", BASE_CURRENCY, marginAvailableBalance, tradeValue)
		return marginAvailableBalance >= tradeValue
	}
}

func getLastTradedPrice(spotApi market.MarketAPI, futuresApi futuresMarket.MarketAPI) (float64, float64) {
	// Fetch the last traded price for spot market
	getSpotTickerReq := market.NewGetTickerReqBuilder().
		SetSymbol(SPOT_SYMBOL).
		Build()

	getSpotTickerResp, err := spotApi.GetTicker(getSpotTickerReq, context.Background())
	if err != nil {
		fmt.Printf("Error fetching spot ticker: %v\n", err)
		panic(err)
	}
	spotPrice := parseOrPanic(getSpotTickerResp.Price)

	// Fetch the last traded price for futures market
	getFuturesSymbolReq := futuresMarket.NewGetSymbolReqBuilder().
		SetSymbol(FUTURES_SYMBOL).
		Build()

	getFuturesSymbolResp, err := futuresApi.GetSymbol(getFuturesSymbolReq, context.Background())
	if err != nil {
		fmt.Printf("Error fetching futures symbol: %v\n", err)
		panic(err)
	}
	futuresPrice := float64(getFuturesSymbolResp.LastTradePrice)

	fmt.Printf("[PRICE] Spot Price: %.5f, Futures Price: %.5f\n", spotPrice, futuresPrice)

	return spotPrice, futuresPrice
}

// Strategy Logic:
//  1. Fetch the funding rate for the specified futures symbol.
//  2. If the funding rate's absolute value is below the specified threshold, exit the strategy.
//  3. If the funding rate is positive:
//     - LONG the spot market and SHORT the futures market.
//  4. If the funding rate is negative:
//     - SHORT the margin market and LONG the futures market.
//  5. Ensure sufficient balance in each account before placing orders.
//  6. Monitor order status, and cancel unfilled orders after a timeout.
func fundingRateArbitrageStrategy(futuresService service.FuturesService, spotService service.SpotService,
	marginService service.MarginService, accountService service.AccountService, amount, threshold float64) {
	// Step 1: Fetch funding rate
	fundingRateReq := fundingfees.NewGetCurrentFundingRateReqBuilder().
		SetSymbol(FUTURES_SYMBOL).
		Build()

	fundingRateResp, err := futuresService.GetFundingFeesAPI().GetCurrentFundingRate(fundingRateReq, context.Background())
	if err != nil {
		fmt.Printf("Error fetching funding rate: %v\n", err)
		panic(err)
	}
	fundingRate := fundingRateResp.Value * 100
	fmt.Printf("[STRATEGY] Funding rate for %s: %.6f%%\n", FUTURES_SYMBOL, fundingRate)

	// Step 2: Check if funding rate meets the threshold for arbitrage
	if math.Abs(float64(fundingRate)) < float64(threshold) {
		fmt.Printf("[STRATEGY] No arbitrage opportunity: Funding rate (%.6f%%) below threshold (%.6f%%).\n", fundingRate, threshold)
		return
	}

	// Step 3: Fetch the latest spot and futures prices
	spotPrice, futuresPrice := getLastTradedPrice(spotService.GetMarketAPI(), futuresService.GetMarketAPI())

	// Calculate futures order amount in contracts
	getFuturesSymbolReq := futuresMarket.NewGetSymbolReqBuilder().
		SetSymbol(FUTURES_SYMBOL).
		Build()
	futuresSymbolResp, err := futuresService.GetMarketAPI().GetSymbol(getFuturesSymbolReq, context.Background())
	if err != nil {
		fmt.Printf("Error fetching futures symbol multiplier: %v\n", err)
		panic(err)
	}
	futuresMultiplier := float64(futuresSymbolResp.Multiplier)
	futuresAmount := int(math.Ceil(amount / futuresMultiplier))

	// Step 4: Execute arbitrage based on funding rate direction
	if fundingRate > 0 {
		fmt.Println("[STRATEGY] Positive funding rate detected. Executing LONG spot and SHORT futures arbitrage.")

		// Ensure sufficient balance for the spot and futures accounts
		if !checkAccountAvailableBalance(accountService.GetAccountAPI(), spotPrice, amount, SPOT) {
			fmt.Println("[STRATEGY] Insufficient balance in spot account.")
			return
		}
		if !checkAccountAvailableBalance(accountService.GetAccountAPI(), futuresPrice, amount, FUTURES) {
			fmt.Println("[STRATEGY] Insufficient balance in futures account.")
			return
		}

		// Execute orders
		if !addSpotOrderWaitFill(spotService.GetOrderAPI(), SPOT_SYMBOL, BUY, amount, spotPrice) {
			fmt.Println("[STRATEGY] Failed to execute spot order.")
			return
		}
		if !addFuturesOrderWaitFill(futuresService.GetOrderAPI(), FUTURES_SYMBOL, SELL, futuresAmount, futuresPrice) {
			fmt.Println("[STRATEGY] Failed to execute futures order.")
			return
		}
	} else {
		fmt.Println("[STRATEGY] Negative funding rate detected. Executing SHORT margin and LONG futures arbitrage.")

		// Ensure sufficient balance for the margin and futures accounts
		if !checkAccountAvailableBalance(accountService.GetAccountAPI(), spotPrice, amount, MARGIN) {
			fmt.Println("[STRATEGY] Insufficient balance in margin account.")
			return
		}
		if !checkAccountAvailableBalance(accountService.GetAccountAPI(), futuresPrice, amount, FUTURES) {
			fmt.Println("[STRATEGY] Insufficient balance in futures account.")
			return
		}

		// Execute orders
		if !addMarginOrderWaitFill(marginService.GetOrderAPI(), SPOT_SYMBOL, amount, spotPrice) {
			fmt.Println("[STRATEGY] Failed to execute margin order.")
			return
		}
		if !addFuturesOrderWaitFill(futuresService.GetOrderAPI(), FUTURES_SYMBOL, BUY, futuresAmount, futuresPrice) {
			fmt.Println("[STRATEGY] Failed to execute futures order.")
			return
		}
	}

	fmt.Println("[STRATEGY] Arbitrage execution completed successfully.")
}

func addSpotOrderWaitFill(orderApi order.OrderAPI, symbol string, side Action, amount, price float64) bool {
	sideArg := "buy"
	if side == SELL {
		sideArg = "sell"
	}

	// Build and place the spot order
	addOrderSyncReq := order.NewAddOrderSyncReqBuilder().
		SetClientOid(uuid.NewString()).
		SetSide(sideArg).
		SetSymbol(symbol).
		SetType("limit").
		SetRemark("arbitrage").
		SetPrice(fmt.Sprintf("%.4f", price)).
		SetSize(fmt.Sprintf("%.4f", amount)).
		Build()

	orderResp, err := orderApi.AddOrderSync(addOrderSyncReq, context.Background())
	if err != nil {
		fmt.Printf("Error placing spot order: %v\n", err)
		panic(err)
	}
	fmt.Printf("[SPOT ORDER] Placed %s order for %.4f %s at %.6f. Order ID: %s\n", side, amount, symbol, price, orderResp.OrderId)

	// Wait for the order to be filled within the timeout period
	deadline := time.Now().Add(time.Duration(MAX_PLACE_ORDER_WAIT_TIME_SEC) * time.Second)
	for time.Now().Before(deadline) {
		// Wait before checking order status again
		fmt.Println("[SPOT ORDER] Checking order status in 1 second...")
		time.Sleep(1 * time.Second)
		getOrderReq := order.NewGetOrderByOrderIdReqBuilder().
			SetSymbol(symbol).
			SetOrderId(orderResp.OrderId).
			Build()

		orderDetail, err := orderApi.GetOrderByOrderId(getOrderReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching order status: %v\n", err)
			panic(err)
		}

		if !orderDetail.Active {
			fmt.Printf("[SPOT ORDER] Order filled successfully: %s %.4f %s. Order ID: %s\n", side, amount, symbol, orderResp.OrderId)
			return true
		}
	}

	// Cancel the order if it was not filled within the timeout period
	fmt.Printf("[SPOT ORDER] Order not filled within %d seconds. Cancelling order...\n", MAX_PLACE_ORDER_WAIT_TIME_SEC)
	cancelOrderReq := order.NewCancelOrderByOrderIdSyncReqBuilder().
		SetOrderId(orderResp.OrderId).
		SetSymbol(symbol).
		Build()

	cancelResp, err := orderApi.CancelOrderByOrderIdSync(cancelOrderReq, context.Background())
	if err != nil || cancelResp.Status != "done" {
		fmt.Printf("[SPOT ORDER] Failed to cancel order. Order ID: %s\n", orderResp.OrderId)
		panic(err)
	}

	fmt.Printf("[SPOT ORDER] Order cancelled successfully. Order ID: %s\n", orderResp.OrderId)
	return false
}

func addFuturesOrderWaitFill(orderApi futuresOrder.OrderAPI, symbol string, side Action, amount int, price float64) bool {
	sideArg := "buy"
	if side == SELL {
		sideArg = "sell"
	}
	// Build and place the futures order
	addOrderReq := futuresOrder.NewAddOrderReqBuilder().
		SetClientOid(uuid.NewString()).
		SetSide(sideArg).
		SetSymbol(symbol).
		SetType("limit").
		SetRemark("arbitrage").
		SetPrice(fmt.Sprintf("%.4f", price)).
		SetLeverage(1).
		SetSize(int32(amount)).
		Build()

	orderResp, err := orderApi.AddOrder(addOrderReq, context.Background())
	if err != nil {
		fmt.Printf("Error placing futures order: %v\n", err)
		panic(err)
	}
	fmt.Printf("[FUTURES ORDER] Placed %s order for %d %s at %.6f. Order ID: %s\n", side, amount, symbol, price, orderResp.OrderId)

	// Wait for the order to be filled within the timeout period
	deadline := time.Now().Add(time.Duration(MAX_PLACE_ORDER_WAIT_TIME_SEC) * time.Second)
	for time.Now().Before(deadline) {
		// Wait before checking order status again
		fmt.Println("[FUTURES ORDER] Checking order status in 1 second...")
		time.Sleep(1 * time.Second)
		getOrderReq := futuresOrder.NewGetOrderByOrderIdReqBuilder().
			SetOrderId(orderResp.OrderId).
			Build()

		orderDetail, err := orderApi.GetOrderByOrderId(getOrderReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching futures order status: %v\n", err)
			panic(err)
		}

		if orderDetail.Status == "done" {
			fmt.Printf("[FUTURES ORDER] Order filled successfully: %s %d %s. Order ID: %s\n", side, amount, symbol, orderResp.OrderId)
			return true
		}
	}

	// Cancel the order if it was not filled within the timeout period
	fmt.Printf("[FUTURES ORDER] Order not filled within %d seconds. Cancelling order...\n", MAX_PLACE_ORDER_WAIT_TIME_SEC)
	cancelOrderReq := futuresOrder.NewCancelOrderByIdReqBuilder().
		SetOrderId(orderResp.OrderId).
		Build()

	cancelResp, err := orderApi.CancelOrderById(cancelOrderReq, context.Background())
	if err != nil || !contains(cancelResp.CancelledOrderIds, orderResp.OrderId) {
		fmt.Printf("[FUTURES ORDER] Failed to cancel order. Order ID: %s\n", orderResp.OrderId)
		panic(err)
	}

	fmt.Printf("[FUTURES ORDER] Order cancelled successfully. Order ID: %s\n", orderResp.OrderId)
	return false
}

func contains(slice []string, item string) bool {
	for _, s := range slice {
		if s == item {
			return true
		}
	}
	return false
}

func addMarginOrderWaitFill(marginService marginOrder.OrderAPI, symbol string, amount, price float64) bool {

	// Build and place the margin order
	addOrderSyncReq := marginOrder.NewAddOrderReqBuilder().
		SetClientOid(uuid.NewString()).
		SetSide("buy").
		SetSymbol(symbol).
		SetType("limit").
		SetIsIsolated(false).
		SetAutoBorrow(true).
		SetAutoRepay(true).
		SetPrice(fmt.Sprintf("%.4f", price)).
		SetSize(fmt.Sprintf("%.4f", amount)).
		Build()

	orderResp, err := marginService.AddOrder(addOrderSyncReq, context.Background())
	if err != nil {
		fmt.Printf("Error placing margin order: %v\n", err)
		panic(err)
	}
	fmt.Printf("[MARGIN ORDER] Placed BUY order for %.4f %s at %.6f. Order ID: %s\n", amount, symbol, price, orderResp.OrderId)

	// Wait for the order to be filled within the timeout period
	deadline := time.Now().Add(time.Duration(MAX_PLACE_ORDER_WAIT_TIME_SEC) * time.Second)
	for time.Now().Before(deadline) {
		// Wait before checking order status again
		fmt.Println("[MARGIN ORDER] Checking order status in 1 second...")
		time.Sleep(1 * time.Second)

		getOrderReq := marginOrder.NewGetOrderByOrderIdReqBuilder().
			SetSymbol(symbol).
			SetOrderId(orderResp.OrderId).
			Build()

		orderDetail, err := marginService.GetOrderByOrderId(getOrderReq, context.Background())
		if err != nil {
			fmt.Printf("Error fetching margin order status: %v\n", err)
			panic(err)
		}

		if !orderDetail.Active {
			fmt.Printf("[MARGIN ORDER] Order filled successfully: BUY %.4f %s. Order ID: %s\n", amount, symbol, orderResp.OrderId)
			return true
		}

	}

	// Cancel the order if it was not filled within the timeout period
	fmt.Printf("[MARGIN ORDER] Order not filled within %d seconds. Cancelling order...\n", MAX_PLACE_ORDER_WAIT_TIME_SEC)
	cancelOrderReq := marginOrder.NewCancelOrderByOrderIdReqBuilder().
		SetOrderId(orderResp.OrderId).
		SetSymbol(symbol).
		Build()

	cancelResp, err := marginService.CancelOrderByOrderId(cancelOrderReq, context.Background())
	if err != nil || cancelResp.OrderId != orderResp.OrderId {
		fmt.Printf("[MARGIN ORDER] Failed to cancel order. Order ID: %s\n", orderResp.OrderId)
		panic(err)
	}

	fmt.Printf("[MARGIN ORDER] Order cancelled successfully. Order ID: %s\n", orderResp.OrderId)
	return false
}

func ArbitrageStrategyExample() {
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
	kuCoinRestService := client.RestService()
	//  Amount to trade
	amount := 100.0
	// Minimum profit threshold
	threshold := 0.00

	fmt.Println("Starting funding rate arbitrage strategy...")
	fundingRateArbitrageStrategy(kuCoinRestService.GetFuturesService(), kuCoinRestService.GetSpotService(),
		kuCoinRestService.GetMarginService(), kuCoinRestService.GetAccountService(), amount, threshold)

}
