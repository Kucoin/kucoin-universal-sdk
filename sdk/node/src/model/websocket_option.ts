/**
 * WebSocketEvent defines the types of WebSocket events
 */
export enum WebSocketEvent {
    EventConnected = 'EventConnected',
    EventDisconnected = 'EventDisconnected',
    EventTryReconnect = 'EventTryReconnect',
    EventMessageReceived = 'EventMessageReceived',
    EventErrorReceived = 'EventErrorReceived',
    EventPongReceived = 'EventPongReceived',
    EventReadBufferFull = 'EventReadBufferFull',
    EventWriteBufferFull = 'EventWriteBufferFull',
    EventCallbackError = 'EventCallbackError',
    EventReSubscribeOK = 'EventReSubscribeOK',
    EventReSubscribeError = 'EventReSubscribeError',
    EventClientFail = 'EventClientFail',
    EventClientShutdown = 'EventClientShutdown',
}

/**
 * WebSocketCallback is a generic callback function type that handles all WebSocket events
 */
export type WebSocketCallback = (event: WebSocketEvent, msg: string) => void;

/**
 * WebSocketClientOption contains the settings for the WebSocket client
 */
export interface WebSocketClientOption {
    /**
     * Enable auto-reconnect; default: true
     */
    reconnect: boolean;
    /**
     * Maximum reconnect attempts, -1 means forever; default: -1
     */
    reconnectAttempts: number;
    /**
     * Interval between reconnect attempts (milliseconds); default: 5000
     */
    reconnectInterval: number;
    /**
     * Timeout for establishing a WebSocket connection (milliseconds); default: 10000
     */
    dialTimeout: number;
    /**
     * Write timeout (milliseconds); default: 30000
     */
    writeTimeout: number;
    /**
     * General callback function to handle all WebSocket events
     */
    eventCallback?: WebSocketCallback;
}

/**
 * Default values for WebSocketClientOption
 */
export const DEFAULT_WEBSOCKET_CLIENT_OPTION: WebSocketClientOption = {
    reconnect: true,
    reconnectAttempts: -1,
    reconnectInterval: 5000, // 5 seconds
    dialTimeout: 10000, // 10 seconds
    writeTimeout: 30000, // 30 seconds
};

/**
 * WebSocketClientOptionBuilder is a builder for WebSocketClientOption
 */
export class WebSocketClientOptionBuilder {
    private option: WebSocketClientOption;

    constructor() {
        this.option = { ...DEFAULT_WEBSOCKET_CLIENT_OPTION };
    }

    /**
     * Set whether to enable auto-reconnect
     */
    withReconnect(reconnect: boolean): WebSocketClientOptionBuilder {
        this.option.reconnect = reconnect;
        return this;
    }

    /**
     * Set the maximum reconnect attempts
     */
    withReconnectAttempts(attempts: number): WebSocketClientOptionBuilder {
        this.option.reconnectAttempts = attempts;
        return this;
    }

    /**
     * Set the interval between reconnect attempts (milliseconds)
     */
    withReconnectInterval(interval: number): WebSocketClientOptionBuilder {
        this.option.reconnectInterval = interval;
        return this;
    }

    /**
     * Set the timeout for establishing a WebSocket connection (milliseconds)
     */
    withDialTimeout(timeout: number): WebSocketClientOptionBuilder {
        this.option.dialTimeout = timeout;
        return this;
    }

    /**
     * Set the write timeout (milliseconds)
     */
    withWriteTimeout(timeout: number): WebSocketClientOptionBuilder {
        this.option.writeTimeout = timeout;
        return this;
    }

    /**
     * Set the callback function to handle WebSocket events
     */
    withEventCallback(callback: WebSocketCallback): WebSocketClientOptionBuilder {
        this.option.eventCallback = callback;
        return this;
    }

    /**
     * Build and return the WebSocketClientOption instance
     */
    build(): WebSocketClientOption {
        return this.option;
    }
}
