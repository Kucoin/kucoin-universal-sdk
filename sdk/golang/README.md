# Go SDK Documentation
![License Badge](https://img.shields.io/badge/license-MIT-green)  
![Language](https://img.shields.io/badge/Go-blue)

Welcome to the **Go** implementation of the KuCoin Universal SDK. This SDK is built based on KuCoin API specifications to provide a comprehensive and optimized interface for interacting with the KuCoin platform.

For an overview of the project and SDKs in other languages, refer to the [Main README](https://github.com/kucoin/kucoin-universal-sdk).


## 📦 Installation

### Latest Version: `1.3.2`
Install the Golang SDK using `go get`:

```bash
go get github.com/Kucoin/kucoin-universal-sdk/sdk/golang
go mod tidy
```

## 📖 Getting Started

The examples below use the Unified Trading Account (UTA) APIs. For authenticated REST and private WebSocket APIs, configure credentials through environment variables rather than hard-coding them:

```bash
export API_KEY="your-api-key"
export API_SECRET="your-api-secret"
export API_PASSPHRASE="your-api-passphrase"
```

### UTA REST API

This example queries the UTA account overview with `GET /api/ua/v2/unified/account/overview`.

```golang
package main

import (
	"context"
	"fmt"
	"os"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func main() {
	httpOption := types.NewTransportOptionBuilder().
		SetKeepAlive(true).
		SetMaxIdleConnsPerHost(10).
		Build()

	option := types.NewClientOptionBuilder().
		WithKey(os.Getenv("API_KEY")).
		WithSecret(os.Getenv("API_SECRET")).
		WithPassphrase(os.Getenv("API_PASSPHRASE")).
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithTransportOption(httpOption).
		Build()
	client := api.NewClient(option)

	accountAPI := client.RestService().GetUTAService().GetAccountAPI()
	response, err := accountAPI.GetAccountOverview(context.Background())
	if err != nil {
		panic(err)
	}
	fmt.Printf("UTA account overview: %+v\n", response)
}
```

### UTA Public WebSocket API

UTA public WebSocket channels do not require API credentials. Start the service before subscribing and keep the process alive to receive events.

```golang
package main

import (
	"fmt"
	"os"
	"os/signal"
	"syscall"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/publicws"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func main() {
	client := api.NewClient(types.NewClientOptionBuilder().
		WithTransportOption(types.NewTransportOption()).
		WithWebSocketClientOption(types.NewWebSocketClientOption()).
		Build())

	ws := client.WsService().NewUtaPublicWS(publicws.PushTradeTypeSpot)
	if err := ws.Start(); err != nil {
		panic(err)
	}
	defer ws.Stop()

	if _, err := ws.Ticker("BTC-USDT", func(topic string, event *publicws.TickerEvent) error {
		fmt.Printf("[%s] %s last=%s\n", topic, event.Data.Symbol, event.Data.LastPrice)
		return nil
	}); err != nil {
		panic(err)
	}

	fmt.Println("Subscribed to UTA SPOT ticker. Press Ctrl+C to stop.")
	stop := make(chan os.Signal, 1)
	signal.Notify(stop, os.Interrupt, syscall.SIGTERM)
	<-stop
}
```

Use `publicws.PushTradeTypeFutures` for Futures channels. The UTA public service also supports `Kline`, `Trade`, `Orderbook`, `OrderbookWithRpi`, `MarkPrice`, `FundingFee`, `FundingFees`, `FundingFeeAllSymbols`, and `CallAuctionInfo` subscriptions.

### UTA Private Push WebSocket API

Private push channels require the API credentials configured above. The following example listens for UTA execution events; it receives events only after a matching account event occurs and does not provide an initial snapshot.

```golang
package main

import (
	"fmt"
	"os"
	"os/signal"
	"syscall"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/privatews"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func main() {
	client := api.NewClient(types.NewClientOptionBuilder().
		WithKey(os.Getenv("API_KEY")).
		WithSecret(os.Getenv("API_SECRET")).
		WithPassphrase(os.Getenv("API_PASSPHRASE")).
		WithTransportOption(types.NewTransportOption()).
		WithWebSocketClientOption(types.NewWebSocketClientOption()).
		Build())

	ws := client.WsService().NewUtaPrivateWS()
	if err := ws.Start(); err != nil {
		panic(err)
	}
	defer ws.Stop()

	if _, err := ws.Execution(func(topic string, event *privatews.ExecutionEvent) error {
		fmt.Printf("[%s] order=%s symbol=%s price=%s size=%s\n",
			topic, event.Data.OrderID, event.Data.Symbol, event.Data.Price, event.Data.Quantity)
		return nil
	}); err != nil {
		panic(err)
	}

	fmt.Println("Subscribed to UTA execution events. Press Ctrl+C to stop.")
	stop := make(chan os.Signal, 1)
	signal.Notify(stop, os.Interrupt, syscall.SIGTERM)
	<-stop
}
```

The UTA private push service also supports `ExecutionLite`, `OrderAll`, `Order`, `Balance`, `PositionAll`, `Position`, `Leverage`, and `LiquidationWarning`.

### UTA Private Trade WebSocket API

`NewUtaPrivateTradeWS` sends authenticated `uta.order`, `uta.cancel`, and `uta.amend` commands. Calling `PlaceOrder` creates a real order. The safe example below only opens the connection; replace the request values and explicitly uncomment the call after verifying the account, symbol, price, and size.

```golang
package main

import (
	"fmt"
	"os"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func main() {
	client := api.NewClient(types.NewClientOptionBuilder().
		WithKey(os.Getenv("API_KEY")).
		WithSecret(os.Getenv("API_SECRET")).
		WithPassphrase(os.Getenv("API_PASSPHRASE")).
		WithTransportOption(types.NewTransportOption()).
		WithWebSocketClientOption(types.NewWebSocketClientOption()).
		Build())

	ws := client.WsService().NewUtaPrivateTradeWS()
	if err := ws.Start(); err != nil {
		panic(err)
	}
	defer ws.Stop()

	request := &order.PlaceOrderReq{
		TradeType:  "SPOT",
		Symbol:     "BTC-USDT",
		ClientOid:  "replace-with-a-unique-client-oid",
		Side:       "BUY",
		OrderType:  "LIMIT",
		Price:      "replace-with-a-safe-limit-price",
		Size:       "replace-with-a-valid-size",
		SizeUnit:   "BASECCY",
		PostOnly:   true,
		TimeInForce: "GTC",
	}

	// response, err := ws.PlaceOrder(request) // Sends a real order.
	// if err != nil { panic(err) }
	// fmt.Printf("UTA order response: %+v\n", response)
	_ = request
	fmt.Println("UTA private trading WebSocket connected; no order was sent.")
}
```

## 📚 Documentation
Official Documentation: [KuCoin API Docs](https://www.kucoin.com/docs-new)
 
## 📋 Changelog

For a detailed list of changes, see the [Changelog](./CHANGELOG.md).

## 📌 Special Notes on APIs

This section provides specific considerations and recommendations for using the REST and WebSocket APIs.

### REST API Notes

#### Client Features
- **Advanced HTTP Handling**:
  - Supports retries, persistent connections, and connection pooling for efficient request handling.
- **Extensible Interceptors**:
  - Provides HTTP interceptors that users can extend to customize request and response processing.
- **Rich Response Details**:
  - Includes rate-limiting information and raw response data in API responses for better debugging and control.
- **Public API Access**:
  - For public endpoints, API keys are not required, simplifying integration for non-authenticated use cases.

---

### WebSocket API Notes

#### UTA Direct WebSocket Services
- **Public Push**: Create a service with `NewUtaPublicWS(publicws.PushTradeTypeSpot)` or `NewUtaPublicWS(publicws.PushTradeTypeFutures)`. Public channels do not require API credentials.
- **Private Push**: Create a service with `NewUtaPrivateWS()`. API key, secret, and passphrase are required; subscriptions deliver account changes and do not return an initial state snapshot.
- **Private Trading**: Create a service with `NewUtaPrivateTradeWS()`. Its `PlaceOrder`, `CancelOrder`, and `AmendOrder` methods send real trading commands rather than subscriptions.
- **Lifecycle**: Call `Start()` successfully before subscribing or sending a trading command, and call `Stop()` when the application exits. `UnSubscribe(id)` removes a public or private push subscription by the ID returned from the subscribe method.

#### Client Features
- **Flexible Service Creation**:
  - Supports creating services for public/private channels in Spot, Futures, or Margin trading as needed.
  - Multiple services can be created independently.
- **Service Lifecycle**:
  - If a service is closed, create a new service instead of reusing it to avoid undefined behavior.
- **Connection-to-Channel Mapping**:
  - Each WebSocket connection corresponds to a specific channel type. For example:
    - Spot public/private and Futures public/private services require 4 active WebSocket connections.

#### Threading and Callbacks
- **Simple Thread Model**:
  - WebSocket services follow a simple thread model, ensuring callbacks are handled on a single thread.
- **Subscription Management**:
  - Subscriptions are synchronous. A subscription is considered successful only after receiving an acknowledgment (ACK) from the server.
  - Each subscription has a unique ID, which can be used for unsubscribe.

#### Data and Message Handling
- **Framework-Managed Threads**:
  - Data messages are handled by a single framework-managed thread, ensuring orderly processing.
- **Buffer Management**:
  - When the message buffer is full, excess messages are dropped, and a notification event is sent.
- **Duplicate Subscriptions**:
  - Avoid overlapping subscription parameters. For example:
    - Subscribing to `["BTC-USDT", "ETH-USDT"]` and then to `["ETH-USDT", "DOGE-USDT"]` may result in undefined behavior.
    - Identical subscriptions will raise an error for duplicate subscriptions.

## 📑 Parameter Descriptions

This section provides details about the configurable parameters for both HTTP and WebSocket client behavior.

### HTTP Parameters
| Parameter             | Type                           | Description                                                                                       | Default Value |
|-----------------------|--------------------------------|---------------------------------------------------------------------------------------------------|---------------|
| `Timeout`             | `time.Duration`               | Request timeout duration.                                                                         | 30s           |
| `KeepAlive`           | `bool`                        | Enables keep-alive (persistent connection).                                                      | true          |
| `MaxIdleConns`        | `int`                         | Maximum number of idle (keep-alive) connections across all hosts. Zero means no limit.            | 100           |
| `MaxIdleConnsPerHost` | `int`                         | Maximum idle (keep-alive) connections per host.                                                   | 2             |
| `MaxConnsPerHost`     | `int`                         | Limits the total number of connections per host. Zero means no limit.                             | 10            |
| `TLSHandshakeTimeout` | `time.Duration`               | Maximum time to wait for a TLS handshake. Zero means no timeout.                                  | 10s           |
| `IdleConnTimeout`     | `time.Duration`               | Maximum time an idle (keep-alive) connection remains idle before closing. Zero means no limit.    | 90s           |
| `Proxy`               | `func(*http.Request) (*url.URL, error)` | HTTP proxy function.                                                                             | N/A           |
| `MaxRetries`          | `int`                         | Maximum number of retry attempts.                                                                | 3             |
| `RetryDelay`          | `time.Duration`               | Delay duration between retries.                                                                  | 2s            |
| `Interceptors`        | `[]Interceptor`               | List of HTTP interceptors for customizing request and response handling.                         | N/A           |

### WebSocket Parameters
| Parameter              | Type                  | Description                                                                                                  | Default Value |
|------------------------|-----------------------|--------------------------------------------------------------------------------------------------------------|---------------|
| `Reconnect`            | `bool`               | Enables automatic reconnection if the connection is lost.                                                   | true          |
| `ReconnectAttempts`    | `int`                | Maximum number of reconnection attempts; `-1` means unlimited attempts.                                      | -1            |
| `ReconnectInterval`    | `time.Duration`      | Interval between reconnection attempts.                                                                      | 5s            |
| `DialTimeout`          | `time.Duration`      | Timeout for establishing a WebSocket connection.                                                            | 10s           |
| `ReadBufferBytes`      | `int`                | Specifies I/O buffer sizes in bytes; does not limit the size of messages sent or received.                   | 2048000       |
| `ReadMessageBuffer`    | `int`                | Buffer size for reading messages; messages will be discarded if the buffer becomes full.                     | 1024          |
| `WriteMessageBuffer`   | `int`                | Buffer size for writing messages; messages will be discarded if the buffer becomes full.                     | 256           |
| `WriteTimeout`         | `time.Duration`      | Write timeout duration.                                                                                      | 30s           |
| `EventCallback`        | `WebSocketCallback`  | General callback function to handle all WebSocket events.                                                   | N/A           |



## 📝 License

This project is licensed under the MIT License. For more details, see the [LICENSE](LICENSE) file.

## 📧 Contact Support

If you encounter any issues or have questions, feel free to reach out through:
- GitHub Issues: [Submit an Issue](https://github.com/kucoin/kucoin-universal-sdk/issues)  

## ⚠️ Disclaimer

- **Financial Risk**: This SDK is provided as a development tool to integrate with KuCoin's trading platform. It does not provide financial advice. Trading cryptocurrencies involves substantial risk, including the risk of loss. Users should assess their financial circumstances and consult with financial advisors before engaging in trading.
  
- **No Warranty**: The SDK is provided "as is" without any guarantees of accuracy, reliability, or suitability for a specific purpose. Use it at your own risk.

- **Compliance**: Users are responsible for ensuring compliance with all applicable laws and regulations in their jurisdiction when using this SDK.

By using this SDK, you acknowledge that you have read, understood, and agreed to this disclaimer.
