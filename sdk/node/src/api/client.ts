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

import { KucoinRestService } from './api_rest';
import { KucoinWSService } from './api_ws';
import { DefaultKucoinRestAPIImpl } from '@internal/rest/default_rest_impl';
import { ClientOption } from '@model/client_option';
import { KucoinDefaultWsImpl } from '@internal/ws/default_ws_impl';

/**
 * Client interface defines the methods to get REST and WebSocket services.
 */
export interface Client {
    /**
     * Get RESTful service.
     */
    restService(): KucoinRestService;

    /**
     * Get WebSocket service.
     */
    wsService(): KucoinWSService;
}

/**
 * DefaultClient provides the default implementation of the Client interface.
 */
export class DefaultClient implements Client {
    private readonly restImpl: KucoinRestService;
    private readonly wsImpl: KucoinWSService;

    constructor(op: ClientOption) {
        this.restImpl = new DefaultKucoinRestAPIImpl(op);
        this.wsImpl = new KucoinDefaultWsImpl(op);
    }

    /**
     * Get RESTful service implementation.
     */
    restService(): KucoinRestService {
        return this.restImpl;
    }

    /**
     * Get WebSocket service implementation.
     */
    wsService(): KucoinWSService {
        return this.wsImpl;
    }
}
