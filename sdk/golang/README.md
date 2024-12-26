# Go SDK Documentation
![License Badge](https://img.shields.io/badge/license-MIT-green)  
![Language](https://img.shields.io/badge/Go-blue)

Welcome to the **Go** implementation of the KuCoin Universal SDK. This SDK is built based on KuCoin API specifications to provide a comprehensive and optimized interface for interacting with the KuCoin platform.

For an overview of the project and SDKs in other languages, refer to the [Main README](https://github.com/kucoin/kucoin-universal-sdk).


## 📦 Installation
**Note:** This SDK is currently in the **Alpha phase**. We are actively iterating and improving its features, stability, and documentation. Feedback and contributions are highly encouraged to help us refine the SDK. 

Install the Golang SDK using `go get`:

```bash
go get github.com/Kucoin/kucoin-universal-sdk/sdk/golang@v0.1.1-alpha
go mod tidy
```

## 📖 Getting Started

Here's a quick example to get you started with the SDK in **Go**.

```golang
package main

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/spot/market"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"os"
)

func example() {
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
		WithSpotEndpoint(types.GlobalApiEndpoint).
		WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).
		WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).
		WithTransportOption(httpOption).
		Build()
	client := api.NewClient(option)

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
```
## 📚 Documentation
Official Documentation: [KuCoin API Docs](https://www.kucoin.com/docs-new)  

## 📂 Examples

Explore more examples in the [example/](example/) directory for advanced usage.


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
