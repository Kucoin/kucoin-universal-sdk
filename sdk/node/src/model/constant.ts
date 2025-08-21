/**
 * Global API endpoints
 */
export const GlobalApiEndpoint = 'https://api.kucoin.com';
export const GlobalFuturesApiEndpoint = 'https://api-futures.kucoin.com';
export const GlobalBrokerApiEndpoint = 'https://api-broker.kucoin.com';
export const GlobalUnifiedWsApiEndpoint = 'wss://wsapi.kucoin.com';

/**
 * Domain types
 */
export enum DomainType {
    /**
     * Spot domain type
     */
    Spot = 'spot',
    /**
     * Futures domain type
     */
    Futures = 'futures',
    /**
     * Broker domain type
     */
    Broker = 'broker',
}

/**
 * MessageType defines various types of messages that can be sent or received
 */
export enum MessageType {
    /**
     * Welcome message type
     */
    WelcomeMessage = 'welcome',
    /**
     * Ping message type
     */
    PingMessage = 'ping',
    /**
     * Pong message type
     */
    PongMessage = 'pong',
    /**
     * Subscribe message type
     */
    SubscribeMessage = 'subscribe',
    /**
     * Acknowledgment message type
     */
    AckMessage = 'ack',
    /**
     * Unsubscribe message type
     */
    UnsubscribeMessage = 'unsubscribe',
    /**
     * Error message type
     */
    ErrorMessage = 'error',
    /**
     * General message type
     */
    Message = 'message',
    /**
     * Notice message type
     */
    Notice = 'notice',
    /**
     * Command message type
     */
    Command = 'command',
}

/**
 * API result codes
 */
export const CodeSuccess = '200000';
