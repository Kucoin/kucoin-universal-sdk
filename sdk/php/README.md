# PHP SDK Documentation
![License Badge](https://img.shields.io/badge/license-MIT-green)  
![Language](https://img.shields.io/badge/php-blue)

Welcome to the **PHP** implementation of the KuCoin Universal SDK. This SDK is built based on KuCoin API specifications to provide a comprehensive and optimized interface for interacting with the KuCoin platform.

> **Note**  
> This PHP SDK is maintained in two repositories:
> - [`kucoin/kucoin-universal-sdk`](https://github.com/kucoin/kucoin-universal-sdk): the main monorepo with SDKs for multiple languages. The PHP code resides in `/sdk/php`.
> - [`kucoin/kucoin-universal-php-sdk`](https://github.com/kucoin/kucoin-universal-php-sdk): a standalone mirror for Composer/Packagist publishing. It is synced from the main repo using Git Subtree.

For an overview of the project and SDKs in other languages, refer to the [Main README](https://github.com/kucoin/kucoin-universal-sdk).

## 📦 Installation

### Latest Version: `0.1.1-alpha`

**Note**: This SDK is currently in the Alpha phase. We are actively iterating and improving its features, stability, and documentation. Feedback and contributions are highly encouraged to help us refine the SDK.

Install the SDK using `composer`:

```bash
composer require kucoin/kucoin-universal-sdk=0.1.1-alpha
```

## 📖 Getting Started

Here's a quick example to get you started with the SDK in **PHP**.

```php
<?php


use KuCoin\UniversalSDK\Api\DefaultClient;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Generate\Spot\Market\GetPartOrderBookReq;
use KuCoin\UniversalSDK\Model\ClientOptionBuilder;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\TransportOptionBuilder;

include '../vendor/autoload.php';


function stringifyDepth($depth): string
{
    return implode(', ', array_map(function ($row) {
        return '[' . implode(', ', $row) . ']';
    }, $depth));
}

function example()
{
    // Retrieve API secret information from environment variables
    $key = getenv('API_KEY') ?: '';
    $secret = getenv('API_SECRET') ?: '';
    $passphrase = getenv('API_PASSPHRASE') ?: '';

    // Set specific options, others will fall back to default values
    $httpTransportOption = (new TransportOptionBuilder())
        ->setKeepAlive(true)
        ->setMaxConnections(10)
        ->build();

    // Create a client using the specified options
    $clientOption = (new ClientOptionBuilder())
        ->setKey($key)
        ->setSecret($secret)
        ->setPassphrase($passphrase)
        ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)
        ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)
        ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)
        ->setTransportOption($httpTransportOption)
        ->build();

    $client = new DefaultClient($clientOption);

    // Get the Restful Service
    $kucoinRestService = $client->restService();

    $spotMarketApi = $kucoinRestService->getSpotService()->getMarketApi();

    // Query partial order book depth data (aggregated by price).
    // Build the request using the builder pattern.
    $request = GetPartOrderBookReq::builder()
        ->setSymbol("BTC-USDT")
        ->setSize("20")
        ->build();

    // Or build the request using an array.
    // Ensure that the keys in the array match the field names in the API documentation,
    // not the variable names in the class. This is useful when migrating code from an older SDK.
    $request = GetPartOrderBookReq::create(["symbol" => "BTC-USDT", "size" => "20"]);

    $response = $spotMarketApi->getPartOrderBook($request);

    Logger::info(sprintf(
        "time=%d, sequence=%d, bids=%s, asks=%s",
        $response->time,
        $response->sequence,
        stringifyDepth($response->bids),
        stringifyDepth($response->asks)
    ));
}

if (php_sapi_name() === 'cli') {
    example();
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
  - Supports retries, keep-alive connections, and configurable concurrency limits for robust request execution.
  - Supports both [Guzzle](https://github.com/guzzle/guzzle) and [Saber (Swoole)](https://github.com/swlib/saber) as underlying HTTP clients.
  - Use `useCoroutineHttp=true` to enable high-performance coroutine HTTP requests (requires `ext-swoole` and `swlib/saber`).

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

| Parameter        | Type                  | Description                                                                                                                    | Default Value |
|------------------|-----------------------|--------------------------------------------------------------------------------------------------------------------------------|----------------|
| `keepAlive`      | `boolean`             | Whether to enable persistent HTTP connections (`Connection: keep-alive`).                                                      | `true`         |
| `maxConnections` | `integer`             | Maximum number of concurrent HTTP connections across all domains. Use `0` to disable the limit| `100`          |
| `totalTimeout`   | `float` (seconds)     | Total timeout of the request in seconds.                                                                                       | `30`           |
| `maxRetries`     | `integer`             | Maximum number of retry attempts upon failure.                                                                                 | `3`            |
| `retryDelay`     | `float` (seconds)     | Delay in seconds between retry attempts.                                                                                       | `2`            |
| `useCoroutineHttp` | `boolean`           | Use coroutine-based HTTP transport (Saber + Swoole). Requires `ext-swoole` and `swlib/saber`.                                 | `false`        |
| `extraOptions`   | `array<string, mixed>`| Extra client-specific options for Guzzle or Saber. See official docs for details.                                              | `[]`           |
| `interceptors`   | `InterceptorInterface[]` | Custom interceptors to hook into HTTP request/response lifecycle (e.g., logging, metrics).                             | `[]`           |

### WebSocket Parameters

| Parameter            | Type              | Description                                                                                       | Default Value |
|----------------------|-------------------|---------------------------------------------------------------------------------------------------|---------------|
| `reconnect`          | `bool`            | Whether to automatically reconnect when the WebSocket connection is lost.                         | `true`        |
| `reconnectAttempts`  | `int`             | Maximum number of reconnection attempts. Use `-1` for unlimited retries.                          | `-1`          |
| `reconnectInterval`  | `float` (seconds) | Time interval between reconnection attempts.                                                     | `5.0`         |
| `dialTimeout`        | `float` (seconds) | Timeout for establishing the WebSocket connection.                                               | `10.0`        |
| `writeTimeout`       | `float` (seconds) | Timeout for sending messages over the WebSocket connection.                                      | `5.0`         |
| `eventCallback`      | `callable\|null`  | A user-defined callback function to handle WebSocket events.<br>Signature: `function(string $eventType, string $eventMessage): void` | `null`        |

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