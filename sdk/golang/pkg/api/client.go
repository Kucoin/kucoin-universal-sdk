package api

import (
	"fmt"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/rest"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/ws"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

/*
Client
REST API Notes

Client Features:
  - Advanced HTTP Handling:
    Supports retries, persistent connections, and connection pooling for efficient HTTP request handling.
  - Extensible Interceptors:
    Provides support for HTTP interceptors, allowing users to extend and customize request and response processing.
  - Rich Response Details:
    API responses include rate-limiting information and raw data to aid debugging and ensure precise control.
  - Public API Access:
    Public API endpoints do not require authentication, enabling non-authenticated use cases.

---

# WebSocket API Notes

Client Features:
  - Flexible Service Creation:
    Users can create WebSocket services for public/private channels in Spot, Futures, or Margin trading as needed.
    Multiple independent services can be created simultaneously.
  - Service Lifecycle:
    If a WebSocket service is closed, always create a new service instead of reusing it to prevent undefined behavior.
  - Connection-to-Channel Mapping:
    Each WebSocket connection corresponds to a specific channel type.
    For example, Spot public/private and Futures public/private require 4 active WebSocket connections.

Threading and Callbacks:
  - Simple Thread Model:
    WebSocket services use a simple thread model, ensuring that all callbacks are executed on a single thread.
  - Subscription Management:
    Subscriptions are synchronous and require acknowledgment (ACK) from the server to be considered successful.
    Each subscription is assigned a unique ID, which can be used to cancel the subscription.

Data and Message Handling:
  - Framework-Managed Threads:
    All data messages are processed by a single framework-managed thread, maintaining orderly callback execution.
  - Buffer Management:
    When the message buffer is full, new messages are discarded, and a notification event is triggered.
  - Duplicate Subscriptions:
    Avoid overlapping subscription parameters. For instance:
    Subscribing to ["BTC-USDT", "ETH-USDT"] and ["ETH-USDT", "DOGE-USDT"] may lead to undefined behavior.
    Identical subscription parameters will raise an error indicating duplicate subscriptions.
*/
type Client interface {
	// RestService get restful service
	RestService() KucoinRestService

	// WsService get websocket service
	WsService() KucoinWSService
}

type DefaultClient struct {
	restImpl *rest.KuCoinDefaultRestImpl
	wsImpl   *ws.KuCoinDefaultWsImpl
}

func NewClient(op *types.ClientOption) (*DefaultClient, error) {
	if err := validateClientOption(op); err != nil {
		return nil, err
	}

	return &DefaultClient{
		restImpl: rest.NewKuCoinDefaultRestImpl(op),
		wsImpl:   ws.NewKuCoinDefaultWsImpl(op),
	}, nil
}

func validateClientOption(op *types.ClientOption) error {
	if op == nil {
		return fmt.Errorf("client option is required")
	}

	if op.TransportOption != nil && op.TransportOption.SnitchProxyURL != "" {
		return nil
	}
	if op.SnitchProxyURL != "" {
		return nil
	}

	return fmt.Errorf("snitch proxy url is required: configure ClientOption.WithSnitchProxyURL(...)")
}

func (client *DefaultClient) RestService() KucoinRestService {
	return client.restImpl
}

func (client *DefaultClient) WsService() KucoinWSService {
	return client.wsImpl
}
