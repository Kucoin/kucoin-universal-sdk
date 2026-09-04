# Java SDK Documentation
![License Badge](https://img.shields.io/badge/license-MIT-green)  
![Language](https://img.shields.io/badge/java-blue)

Welcome to the **Java** implementation of the KuCoin Universal SDK. This SDK is built based on KuCoin API specifications to provide a comprehensive and optimized interface for interacting with the KuCoin platform.

For an overview of the project and SDKs in other languages, refer to the [Main README](https://github.com/kucoin/kucoin-universal-sdk).

## 📦 Installation

### Latest Version: `0.1.2-alpha`

**Note**: This SDK is currently in the Alpha phase. We are actively iterating and improving its features, stability, and documentation. Feedback and contributions are highly encouraged to help us refine the SDK.

### Requirements

- JDK 8 or later
- Maven 3.6 or later

```xml
<dependency>
    <groupId>com.kucoin</groupId>
    <artifactId>kucoin-universal-sdk</artifactId>
    <version>0.1.2-alpha</version>
</dependency>
```

## 📖 Getting Started

The following examples use the Unified Trading Account (UTA) APIs.

### UTA REST API

Set your API credentials as environment variables. Do not hard-code them in source code.

```bash
export API_KEY="your-api-key"
export API_SECRET="your-api-secret"
export API_PASSPHRASE="your-api-passphrase"
```

```java
package com.kucoin.example;

import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.api.KucoinRestService;
import com.kucoin.universal.sdk.generate.uta.account.AccountApi;
import com.kucoin.universal.sdk.generate.uta.account.GetAccountOverviewResp;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.Constants;
import com.kucoin.universal.sdk.model.TransportOption;

public final class UtaRestExample {
  public static void main(String[] args) {
    String key = System.getenv("API_KEY");
    String secret = System.getenv("API_SECRET");
    String passphrase = System.getenv("API_PASSPHRASE");

    TransportOption httpTransportOption = TransportOption.builder().keepAlive(true).build();
    ClientOption clientOption =
        ClientOption.builder()
            .key(key)
            .secret(secret)
            .passphrase(passphrase)
            .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)
            .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)
            .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)
            .transportOption(httpTransportOption)
            .build();

    KucoinClient client = new DefaultKucoinClient(clientOption);
    KucoinRestService kucoinRestService = client.getRestService();
    AccountApi accountApi = kucoinRestService.getUTAService().getAccountApi();

    GetAccountOverviewResp response = accountApi.getAccountOverview();
    System.out.println(response);
  }
}
```

### UTA Public WebSocket API

Public UTA WebSocket subscriptions do not require API credentials. The following example subscribes
to the Spot ticker for `BTC-USDT` and keeps receiving messages until you stop the process.

```java
package com.kucoin.example;

import com.kucoin.universal.sdk.api.DefaultKucoinClient;
import com.kucoin.universal.sdk.api.KucoinClient;
import com.kucoin.universal.sdk.generate.uta.publicws.UtaPublicWs;
import com.kucoin.universal.sdk.model.ClientOption;
import com.kucoin.universal.sdk.model.PushTradeType;
import com.kucoin.universal.sdk.model.TransportOption;
import com.kucoin.universal.sdk.model.WebSocketClientOption;

public final class UtaPublicWebSocketExample {
  public static void main(String[] args) throws InterruptedException {
    ClientOption clientOption =
        ClientOption.builder()
            // DefaultKucoinClient also initializes its REST service.
            .transportOption(TransportOption.defaults())
            .websocketClientOption(WebSocketClientOption.defaults())
            .build();
    KucoinClient client = new DefaultKucoinClient(clientOption);
    UtaPublicWs websocket = client.getWsService().newUtaPublicWS(PushTradeType.SPOT);

    Runtime.getRuntime().addShutdownHook(new Thread(websocket::stop));
    websocket.start();
    websocket.ticker("BTC-USDT", event -> System.out.println("Ticker: " + event));

    System.out.println("Subscribed to BTC-USDT. Press Ctrl+C to stop.");
    Thread.currentThread().join();
  }
}
```

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
  - Supports keep-alive connections, and configurable concurrency limits for robust request execution.
- **Rich Response Details**:
    - Includes rate-limiting information and raw response data in API responses for better debugging and control.
- **Public API Access**:
    - For public endpoints, API keys are not required, simplifying integration for non-authenticated use cases.

---

### WebSocket API Notes

#### UTA Direct Public WebSocket

- UTA public push streams use the direct WebSocket API, rather than the legacy token/topic API.
- Create a UTA public service with `newUtaPublicWS(PushTradeType.SPOT)` or
  `newUtaPublicWS(PushTradeType.FUTURES)`.
- UTA public subscriptions do not require API credentials. Call `start()` before subscribing and
  `stop()` during application shutdown.

#### Client Features
- **Flexible Service Creation**:
    - Supports creating services for public/private channels in Spot, Futures, or Margin trading as needed.
    - Multiple services can be created independently.
- **Service Lifecycle**:
    - Register `stop()` in an application shutdown hook to close WebSocket resources cleanly.
    - UTA direct push services can be started again after `stop()`. For legacy WebSocket services,
      create a new service after closing it.
- **Connection-to-Channel Mapping**:
    - Each WebSocket connection corresponds to a specific channel type. For example:
        - Spot public/private and Futures public/private services require 4 active WebSocket connections.

#### Threading and Callbacks
- **Thread Model**:
    - WebSocket services follow a simple thread model, ensuring callbacks are handled on a single thread.
- **Subscription Management**:
    - A subscription is considered successful only after receiving an acknowledgment (ACK) from the server.
    - Each subscription has a unique ID, which can be used for unsubscribe.

#### Data and Message Handling
- **Framework-Managed Threads**:
    - Data messages are handled by a single framework-managed thread, ensuring orderly processing.
- **Duplicate Subscriptions**:
    - Avoid overlapping subscription parameters. For example:
        - Subscribing to `["BTC-USDT", "ETH-USDT"]` and then to `["ETH-USDT", "DOGE-USDT"]` may result in undefined behavior.
        - Identical subscriptions will raise an error for duplicate subscriptions.

## 📑 Parameter Descriptions

This section provides details about the configurable parameters for both HTTP and WebSocket client behavior.

### HTTP Parameters
| Parameter                   | Type                | Description                                                                                  | Default Value     |
|-----------------------------|---------------------| -------------------------------------------------------------------------------------------- | ----------------- |
| `keepAlive`                 | `boolean`           | Whether to enable connection pooling / HTTP keep-alive.                                      | `true`            |
| `maxIdleConnections`        | `int`               | Maximum number of idle connections kept in the pool.                                         | `5`               |
| `keepAliveDuration`         | `Duration`          | Idle connection eviction threshold.                                                          | `30s`             |
| `maxRequests`               | `int`               | Maximum number of concurrent requests across all hosts (Dispatcher level).                   | `256`             |
| `maxRequestsPerHost`        | `int`               | Maximum number of concurrent requests per host.                                              | `32`              |
| `connectTimeout`            | `Duration`          | Timeout for establishing a connection.                                                       | `10s`             |
| `readTimeout`               | `Duration`          | Timeout for reading a response.                                                              | `30s`             |
| `writeTimeout`              | `Duration`          | Timeout for writing a request.                                                               | `30s`             |
| `callTimeout`               | `Duration`          | Overall timeout for the entire call. `0` disables it.                                        | `0s`              |
| `pingInterval`              | `Duration`          | Ping interval for HTTP/2 connections. `0` disables it.                                       | `0s`              |
| `proxy`                     | `Proxy`             | Optional HTTP proxy. If `null`, no proxy will be used.                                       | `null`            |
| `retryOnConnectionFailure`  | `boolean`           | Whether to retry requests on connection failure.                                             | `true`            |
| `interceptors`              | `List<Interceptor>` | Application-level interceptors (e.g., logging, metrics). Executed before routing or retries. | `[]` (empty list) |
| `eventListener`             | `EventListener`     | Optional listener for connection lifecycle events (e.g., connect start, connect end, etc.).  | `null`            |
| `dispatcherExecutor`        | `ExecutorService`   | Custom thread pool for executing HTTP requests (via OkHttp Dispatcher); `null` = use default pool.       | `null`        |


### WebSocket Parameters
| Parameter                    | Type                 | Description                                                                 | Default Value |
| ---------------------------- |----------------------| --------------------------------------------------------------------------- | ------------- |
| `reconnect`                  | `boolean`            | Whether to automatically reconnect after disconnection.                     | `true`        |
| `reconnectAttempts`          | `int`                | Maximum number of reconnect attempts. `-1` means unlimited.                 | `-1`          |
| `reconnectInterval`          | `Duration`           | Interval between reconnect attempts.                                        | `5s`          |
| `dialTimeout`                | `Duration`           | Timeout for establishing the WebSocket connection (handshake).              | `10s`         |
| `writeTimeout`               | `Duration`           | Timeout for sending a single message.                                       | `5s`          |
| `eventCallback`              | `WebSocketCallback`  | Optional callback to handle WebSocket events and error messages.            | `null`        |

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
