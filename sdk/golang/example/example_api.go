package main

import (
	"context"
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/account/fee"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/futures/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/service"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"os"
	"strings"
	"time"
)

func RestExample() {
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

	accountServiceExample(kuCoinRestService.GetAccountService())
	spotServiceExample(kuCoinRestService.GetSpotService())
	futuresServiceExample(kuCoinRestService.GetFuturesService())

}

func accountServiceExample(accountService service.AccountService) {
	{
		// Get account api
		accountApi := accountService.GetAccountAPI()
		// Override the global timeout
		ctx, cancel := context.WithTimeout(context.Background(), 5*time.Second)
		defer cancel()
		// Get summary information
		resp, err := accountApi.GetAccountInfo(ctx)
		if err != nil {
			panic(err)
		}
		logger.GetLogger().Infof("account info: level:%d, SubAccountSize:%d", resp.Level, resp.SubQuantity)
		// Other Account APIs...
	}
	{
		// Get fee api
		feeApi := accountService.GetFeeAPI()
		// Get the actual fee rate of the trading pair
		resp, err := feeApi.GetSpotActualFee(fee.NewGetSpotActualFeeReqBuilder().SetSymbols("BTC-USDT,ETH-USDT").Build(), context.Background())
		if err != nil {
			panic(err)
		}
		for _, feeData := range resp.Data {
			logger.GetLogger().Infof("fee info: symbol:%s, TakerFee:%s, MakerFee:%s", feeData.Symbol, feeData.TakerFeeRate, feeData.MakerFeeRate)
		}
		// Other Fee APIs...
	}
	// Other APIs related to account...
}

func spotServiceExample(spotService service.SpotService) {
	orderApi := spotService.GetOrderAPI()

	// Add limit order
	addOrderReq := order.NewAddOrderSyncReqBuilder().
		SetClientOid(uuid.NewString()).
		SetSide("buy").
		SetSymbol("BTC-USDT").
		SetType("limit").
		SetRemark("sdk_example").
		SetPrice("10000").
		SetSize("0.001").
		Build()

	resp, err := orderApi.AddOrderSync(addOrderReq, context.Background())
	if err != nil {
		panic(err)
	}
	logger.GetLogger().Infof("add order success, id:%s, oid:%s", resp.OrderId, resp.OrderId)

	// Query order detail
	queryOrderDetailReq := order.NewGetOrderByOrderIdReqBuilder().SetOrderId(resp.OrderId).SetSymbol("BTC-USDT").Build()
	orderDetailResp, err := orderApi.GetOrderByOrderId(queryOrderDetailReq, context.Background())
	if err != nil {
		panic(err)
	}
	logger.GetLogger().Infof("order detail: %+v", orderDetailResp.ToMap())

	// Cancel order
	cancelOrderReq := order.NewCancelOrderByOrderIdSyncReqBuilder().SetOrderId(resp.OrderId).SetSymbol("BTC-USDT").Build()
	cancelOrderResp, err := orderApi.CancelOrderByOrderIdSync(cancelOrderReq, context.Background())
	if err != nil {
		panic(err)
	}
	logger.GetLogger().Infof("cancel order success, id:%s", cancelOrderResp.OrderId)
}

func futuresServiceExample(futuresService service.FuturesService) {
	marketApi := futuresService.GetMarketAPI()

	// Query all symbols
	allSymbolResp, err := marketApi.GetAllSymbols(context.Background())
	if err != nil {
		panic(err)
	}

	maxQuery := min(len(allSymbolResp.Data), 10)
	for i := 0; i < maxQuery; i++ {
		symbol := allSymbolResp.Data[i]
		// Query the Kline of the symbol
		start := time.Now().Add(-time.Minute*10).UnixNano() / int64(time.Millisecond)
		end := time.Now().UnixNano() / int64(time.Millisecond)
		getKlineReq := market.NewGetKlinesReqBuilder().SetSymbol(symbol.Symbol).SetGranularity(1).SetFrom(start).SetTo(end).Build()
		getKlineResp, err := marketApi.GetKlines(getKlineReq, context.Background())
		if err != nil {
			panic(err)
		}
		var rows []string
		for _, row := range getKlineResp.Data {
			timestamp := time.Unix(int64(row[0]/1000), 0).Format("2006-01-02 15:04:05")

			formattedRow := fmt.Sprintf(
				"[Time: %s, Open: %.2f, High: %.2f, Low: %.2f, Close: %.2f, Volume:%.2f]",
				timestamp, row[1], row[2], row[3], row[4], row[5],
			)
			rows = append(rows, formattedRow)
		}
		logger.GetLogger().Infof("symbol:%s, kline:%+v", symbol.Symbol, strings.Join(rows, ","))
	}
}
