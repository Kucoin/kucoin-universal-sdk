// WsToken represents the token and API endpoint for a WebSocket connection
import { WsMessage } from '@model/common';
import { WebSocketEvent } from '@src/model';

// WebsocketHandshake defines methods for handling WebSocket handshakes.
export interface WebsocketHandshake {
    invoke(socket: any, text: string): Promise<void> | void;
}

// WsParsedMessage defines the structure of a parsed WebSocket message.
export interface WsParsedMessage {
    type?: string;
    id?: string;
    message: any;
    ack: boolean;
}

// WebsocketMetaProvider defines methods for managing WebSocket metadata.
export interface WebsocketMetaProvider {
    handshakes(): WebsocketHandshake[];
    parseMessage(text: string): WsParsedMessage;
    buildUri(): Promise<string>;
    pingInterval(): number;
    pingTimeout(): number;
    pingMessage(): [string, any];
    close(): Promise<void>;
}

export interface WsToken {
    token: string;
    pingInterval: number;
    endpoint: string;
    protocol: string;
    encrypt: boolean;
    pingTimeout: number;
}

// WsTokenProvider defines a method for retrieving a WebSocket token
export interface WsTokenProvider {
    /**
     * Retrieves the WebSocket token.
     * @returns A promise that resolves to an array of WsToken or rejects with an error.
     */
    getToken(): Promise<WsToken[]>;

    /**
     * Closes the token provider.
     * @returns A promise that resolves when the provider is closed.
     */
    close(): Promise<void>;
}

// WebSocketMessageCallback defines a method for handling WebSocket messages
export interface WebSocketMessageCallback {
    /**
     * Handles the incoming WebSocket messages.
     * @param message The WebSocket message.
     * @returns A promise that resolves on successful processing of the message or rejects with an error.
     */
    onMessage(message: WsMessage): void;
}

// WebSocketService defines methods for subscribing to
// and unsubscribing from topics in a WebSocket connection
export interface WebSocketService {
    /**
     * Starts the WebSocket service and handles incoming WebSocket messages.
     * @returns A promise that resolves when the service is started.
     */
    start(): Promise<void>;

    /**
     * Stops the WebSocket service.
     * @returns A promise that resolves when the service is stopped.
     */
    stop(): Promise<void>;

    /**
     * Subscribes to a topic with a provided message callback.
     * @param topic The topic to subscribe to.
     * @param args Additional arguments for the subscription.
     * @param callback The callback to handle incoming messages for the topic.
     * @returns A promise that resolves to the subscription ID or rejects with an error.
     */
    subscribe(topic: string, args: string[], callback: WebSocketMessageCallback): Promise<string>;

    /**
     * Unsubscribes from a topic.
     * @param id The subscription ID.
     * @returns A promise that resolves when the subscription is cancelled.
     */
    unsubscribe(id: string): Promise<void>;
}

export interface WebsocketTransportEvents {
    message: (data: any) => void;
    event: (event: WebSocketEvent, msg: string) => void;
    reconnected: () => void;
}

// WebsocketTransport defines methods required for managing a WebSocket connection.
export interface WebsocketTransport {
    /**
     * Starts the WebSocket connection.
     * @returns A promise that resolves when the connection is established.
     */
    start(): Promise<void>;

    /**
     * Stops the WebSocket connection.
     * @returns A promise that resolves when the connection is closed.
     */
    stop(): Promise<void>;

    /**
     * Writes a message to the WebSocket connection.
     * @param id The message id.
     * @param message The message to send.
     * @param timeout The timeout in milliseconds
     * @returns A channel (promise) that resolves when the message is sent or rejects with an error.
     */
    write(id: string, message: any, timeout: number): Promise<void>;

    /**
     * Subscribes to WebSocket events.
     * @param event The event name.
     * @param listener The callback function for the event.
     */
    on<K extends keyof WebsocketTransportEvents>(
        event: K,
        listener: WebsocketTransportEvents[K],
    ): this;
}
