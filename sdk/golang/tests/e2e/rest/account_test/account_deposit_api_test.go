package account_test

import (
	"context"
	"encoding/json"
	"fmt"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/extension/interceptor"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/account/deposit"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"os"
	"testing"
)

var depositApi deposit.DepositAPI

func init() {
	key := os.Getenv("API_KEY")
	secret := os.Getenv("API_SECRET")
	passphrase := os.Getenv("API_PASSPHRASE")

	defaultLogger := logger.NewDefaultLogger()
	logger.SetLogger(defaultLogger)

	httpOptionBuilder := types.NewTransportOptionBuilder().
		SetKeepAlive(true).
		AddInterceptors(interceptor.NewLoggingInterceptor(false, defaultLogger))

	option := types.NewClientOptionBuilder().
		WithKey(key).
		WithSecret(secret).
		WithPassphrase(passphrase).
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithTransportOption(httpOptionBuilder.Build()).
		Build()

	client := api.NewClient(option)

	depositApi = client.RestService().GetAccountService().GetDepositAPI()
}

func TestDepositGetDepositAddressV1Req(t *testing.T) {
	// GetDepositAddressV1
	// Get Deposit Addresses(V1)
	// /api/v1/deposit-addresses

	builder := deposit.NewGetDepositAddressV1ReqBuilder()
	builder.SetCurrency("USDT").SetChain("eth")
	req := builder.Build()

	resp, err := depositApi.GetDepositAddressV1(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestDepositAddDepositAddressV1Req(t *testing.T) {
	// AddDepositAddressV1
	// Add Deposit Address(V1)
	// /api/v1/deposit-addresses

	builder := deposit.NewAddDepositAddressV1ReqBuilder()
	builder.SetCurrency("ETH").SetChain("eth").SetTo("trade")
	req := builder.Build()

	resp, err := depositApi.AddDepositAddressV1(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestDepositGetDepositHistoryReq(t *testing.T) {
	// GetDepositHistory
	// Get Deposit History
	// /api/v1/deposits

	builder := deposit.NewGetDepositHistoryReqBuilder()
	builder.SetCurrency("USDT").SetStartAt(1673496371000).SetEndAt(1705032371000)
	req := builder.Build()

	resp, err := depositApi.GetDepositHistory(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

// TODO empty data
func TestDepositGetDepositHistoryOldReq(t *testing.T) {
	// GetDepositHistoryOld
	// Get Deposit History(OLD)
	// /api/v1/hist-deposits

	builder := deposit.NewGetDepositHistoryOldReqBuilder()
	builder.SetStartAt(1714492800000).SetEndAt(1732982400000)
	req := builder.Build()

	resp, err := depositApi.GetDepositHistoryOld(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestDepositGetDepositAddressV2Req(t *testing.T) {
	// GetDepositAddressV2
	// Get Deposit Addresses(V2)
	// /api/v2/deposit-addresses

	builder := deposit.NewGetDepositAddressV2ReqBuilder()
	builder.SetCurrency("USDT").SetChain("SOL")
	req := builder.Build()

	resp, err := depositApi.GetDepositAddressV2(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestDepositGetDepositAddressV3Req(t *testing.T) {
	// GetDepositAddressV3
	// Get Deposit Addresses(V3)
	// /api/v3/deposit-addresses

	builder := deposit.NewGetDepositAddressV3ReqBuilder()
	builder.SetCurrency("ETH").SetAmount("1").SetChain("eth")
	req := builder.Build()

	resp, err := depositApi.GetDepositAddressV3(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}

func TestDepositAddDepositAddressV3Req(t *testing.T) {
	// AddDepositAddressV3
	// Add Deposit Address(V3)
	// /v3/deposit-address/create

	builder := deposit.NewAddDepositAddressV3ReqBuilder()
	builder.SetCurrency("MNT").SetChain("eth").SetTo("trade")
	req := builder.Build()

	resp, err := depositApi.AddDepositAddressV3(req, context.TODO())
	if err != nil {
		panic(err)
	}
	data, err := json.Marshal(resp.ToMap())
	if err != nil {
		panic(err)
	}
	fmt.Println("code:", resp.CommonResponse.Code)
	fmt.Println("message:", resp.CommonResponse.Message)
	fmt.Println("data:", string(data))
}
