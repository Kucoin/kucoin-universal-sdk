# Node.js SDK Documentation
![License Badge](https://img.shields.io/badge/license-MIT-green)  
![Language](https://img.shields.io/badge/nodejs-blue)

Welcome to the **Node.js** implementation of the KuCoin Universal SDK. This SDK is built based on KuCoin API specifications to provide a comprehensive and optimized interface for interacting with the KuCoin platform.

For an overview of the project and SDKs in other languages, refer to the [Main README](https://github.com/kucoin/kucoin-universal-sdk).

## 📦 Installation

### Latest Version: `1.3.2`
Install the SDK using `npm`:

```bash
npm install kucoin-universal-sdk
```

## 📖 Getting Started

Here's a quick example to get you started with the SDK in **TypeScript**.

```ts
import {
    ClientOptionBuilder,
    DefaultClient,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    Spot,
    TransportOptionBuilder
} from 'kucoin-universal-sdk';

function example() {
    // Retrieve API secret information from environment variables
    const key = process.env.API_KEY || '';
    const secret = process.env.API_SECRET || '';
    const passphrase = process.env.API_PASSPHRASE || '';

    // Set specific options, others will fall back to default values
    const httpTransportOption = new TransportOptionBuilder()
        .setKeepAlive(true)
        .setMaxConnsPerHost(10)
        .setMaxIdleConns(10)
        .build();

    // Create a client using the specified options
    const clientOption = new ClientOptionBuilder()
        .setKey(key)
        .setSecret(secret)
        .setPassphrase(passphrase)
        .setSpotEndpoint(GlobalApiEndpoint)
        .setFuturesEndpoint(GlobalFuturesApiEndpoint)
        .setBrokerEndpoint(GlobalBrokerApiEndpoint)
        .setTransportOption(httpTransportOption)
        .build();

    const client = new DefaultClient(clientOption);

    // Get the Restful Service
    const kucoinRestService = client.restService();

    const spotMarketApi = kucoinRestService.getSpotService().getMarketApi();

    // Create request by interface
    let request = Spot.Market.GetPartOrderBookReq.create({
        'symbol': 'BTC-USDT',
        'size': '20',
    })

    // Or create request by builder
    request = Spot.Market.GetPartOrderBookReq.builder().setSize('20').setSymbol('BTC-USDT').build();

    // Query for part orderbook depth data. (aggregated by price)
    spotMarketApi.getPartOrderBook(request).then((result) => {
        console.log(`Time: ${result.time}, Seq: ${result.sequence}, Bids: ${result.bids}, Asks: ${result.asks}`);
    }).catch((err) => {
        console.error('fail to get part order book', err);
    })
}


example()
```

## UTA APIs

UTA REST responses keep the server's original `data` shape. This is intentional: some endpoints
return an array in one account mode and an object in another, and numeric fields can be represented
as either JSON numbers or strings.

```ts
import {
    ClientOptionBuilder,
    DefaultClient,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    TransportOptionBuilder,
} from 'kucoin-universal-sdk';

async function main() {
    const client = new DefaultClient(
        new ClientOptionBuilder()
            .setKey(process.env.API_KEY || '')
            .setSecret(process.env.API_SECRET || '')
            .setPassphrase(process.env.API_PASSPHRASE || '')
            .setSpotEndpoint(GlobalApiEndpoint)
            .setFuturesEndpoint(GlobalFuturesApiEndpoint)
            .setBrokerEndpoint(GlobalBrokerApiEndpoint)
            .setTransportOption(new TransportOptionBuilder().setKeepAlive(true).build())
            .build(),
    );

    const utaMarketApi = client.restService().getUTAService().getMarketApi();
    const ticker = await utaMarketApi.getTicker({ tradeType: 'SPOT', symbol: 'BTC-USDT' });
    console.log(ticker.data);
}

void main();
```

### UTA Public WebSocket

UTA public streams use direct push endpoints instead of the legacy token WebSocket. Call `start()`
before subscribing and `stop()` when the connection is no longer needed.

```ts
import {
    ClientOptionBuilder,
    DefaultClient,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    PushTradeType,
    WebSocketClientOptionBuilder,
} from 'kucoin-universal-sdk';

async function main() {
    const client = new DefaultClient(
        new ClientOptionBuilder()
            .setSpotEndpoint(GlobalApiEndpoint)
            .setFuturesEndpoint(GlobalFuturesApiEndpoint)
            .setBrokerEndpoint(GlobalBrokerApiEndpoint)
            .setWebSocketClientOption(new WebSocketClientOptionBuilder().build())
            .build(),
    );

    const ws = client.wsService().newUtaPublicWS(PushTradeType.SPOT);
    await ws.start();
    await ws.ticker('BTC-USDT', (event) => {
        console.log(event.T, event.d);
    });

    // Stop later, for example during application shutdown.
    // await ws.stop();
}

void main();
```

`newUtaPrivateWS()` provides private push subscriptions (`execution`, `order`, `balance`,
`position`, `leverage`, and `lw`). `newUtaPrivateTradeWS()` provides `uta.order`, `uta.cancel`,
and `uta.amend`; those methods can create, cancel, or amend real orders and therefore require API
credentials with the appropriate permission.

## 📚 Documentation
Official Documentation: [KuCoin API Docs](https://www.kucoin.com/docs-new)

## 📂 Examples

Explore more examples in the [example/](example/) directory for advanced usage.

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
- **Thread Model**:
    - WebSocket services follow a simple thread model, ensuring callbacks are handled on a single thread.
    - Although the above callback ensures single-threaded execution (guaranteed by Node.js's single-threaded model), the management of WebSocket connections, as well as message reception and transmission, is handled by a separate worker thread.
- **Subscription Management**:
    - A subscription is considered successful only after receiving an acknowledgment (ACK) from the server.
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

| Parameter                  | Type                   | Description                                                       | Default Value                         |
|----------------------------|------------------------|-------------------------------------------------------------------|---------------------------------------|
| `timeout`                  | `number`               | Request timeout duration in milliseconds.                         | 30000 (30 seconds)                    |
| `keepAlive`                | `boolean`              | Enables keep-alive for persistent connections.                    | true                                  |
| `maxIdleConns`             | `number`               | Maximum number of idle (keep-alive) connections across all hosts. | 100                                   |
| `maxIdleConnsPerHost`      | `number`               | Maximum idle connections per host.                                | 2                                     |
| `maxConnsPerHost`          | `number`               | Total number of connections per host.                             | 10                                    |
| `idleConnTimeout`          | `number`               | Maximum time an idle connection will remain idle in milliseconds. | 90000 (90 seconds)                    |
| `proxy`                    | `Optional<ProxyOption>` | HTTP(s) proxy settings.                                          | None                                  |
| `maxRetries`               | `number`               | Maximum number of retry attempts.                                 | 3                                     |
| `retryDelay`               | `number`               | Delay duration between retries in milliseconds.                   | 2000 (2 seconds)                      |
| `interceptors`             | `Optional<Interceptor[]>` | List of HTTP interceptors.                                     | An empty list (`[]`)                  |


### WebSocket Parameters

| Parameter               | Type                      | Description                                                                                     | Default Value |
|-------------------------|---------------------------|-------------------------------------------------------------------------------------------------|---------------|
| `reconnect`             | `boolean`                 | Enables automatic reconnection if the connection is lost.                                       | true          |
| `reconnectAttempts`     | `number`                  | Maximum number of reconnection attempts; `-1` for unlimited attempts.                           | -1            |
| `reconnectInterval`     | `number`                  | Interval between reconnection attempts in milliseconds.                                         | 5000 (5 seconds) |
| `dialTimeout`           | `number`                  | Timeout duration for establishing a WebSocket connection in milliseconds.                      | 10000 (10 seconds) |
| `readMessageBuffer`     | `number`                  | Buffer size for reading messages in the queue.                                                 | 1024          |
| `writeTimeout`          | `number`                  | Timeout for sending messages in milliseconds.                                                  | 30000 (30 seconds) |
| `eventCallback`         | `Optional<WebSocketCallback>` | A callback function to handle WebSocket events.                                                 | None          |


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
