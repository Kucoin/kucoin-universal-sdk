import { TransportOption } from './transport_option';
import { WebSocketClientOption } from './websocket_option';

/**
 * ClientOption holds the configuration details for a client including authentication keys, API endpoints, and transport options.
 */
export interface ClientOption {
    /**
     * Key is the authentication key for the client
     */
    key?: string;
    /**
     * Secret is the authentication secret for the client
     */
    secret?: string;
    /**
     * Passphrase is the authentication passphrase for the client
     */
    passphrase?: string;
    /**
     * BrokerName The name of the broker
     */
    brokerName?: string;
    /**
     * BrokerPartner The partner associated with the broker
     */
    brokerPartner?: string;
    /**
     * BrokerKey The secret key for the broker
     */
    brokerKey?: string;
    /**
     * SpotEndpoint is the spot market API endpoint for the client
     */
    spotEndpoint?: string;
    /**
     * FuturesEndpoint is the futures market API endpoint for the client
     */
    futuresEndpoint?: string;
    /**
     * BrokerEndpoint is the broker API endpoint for the client
     */
    brokerEndpoint?: string;
    /**
     * Unified private WebSocket API endpoint
     */
    unifiedWsEndpoint?: string;
    /**
     * TransportOption is an optional configuration for HTTP network transport
     */
    transportOption?: TransportOption;
    /**
     * WebSocketClientOption is an optional configuration for websocket transport
     */
    webSocketClientOption?: WebSocketClientOption;
}

/**
 * ClientOptionBuilder is the builder for ClientOption
 */
export class ClientOptionBuilder {
    private clientOption: ClientOption;

    constructor() {
        this.clientOption = {
            key: '',
            secret: '',
            passphrase: '',
            brokerName: '',
            brokerPartner: '',
            brokerKey: '',
            spotEndpoint: '',
            futuresEndpoint: '',
            brokerEndpoint: '',
            unifiedWsEndpoint: '',
        };
    }

    /**
     * setKey sets the authentication key
     */
    setKey(key: string): ClientOptionBuilder {
        this.clientOption.key = key;
        return this;
    }

    /**
     * setSecret sets the authentication secret
     */
    setSecret(secret: string): ClientOptionBuilder {
        this.clientOption.secret = secret;
        return this;
    }

    /**
     * setPassphrase sets the authentication passphrase
     */
    setPassphrase(passphrase: string): ClientOptionBuilder {
        this.clientOption.passphrase = passphrase;
        return this;
    }

    /**
     * setBrokerName sets the broker name
     */
    setBrokerName(brokerName: string): ClientOptionBuilder {
        this.clientOption.brokerName = brokerName;
        return this;
    }

    /**
     * setBrokerPartner sets the broker partner
     */
    setBrokerPartner(brokerPartner: string): ClientOptionBuilder {
        this.clientOption.brokerPartner = brokerPartner;
        return this;
    }

    /**
     * setBrokerKey sets the broker key
     */
    setBrokerKey(brokerKey: string): ClientOptionBuilder {
        this.clientOption.brokerKey = brokerKey;
        return this;
    }

    /**
     * setSpotEndpoint sets the spot market API endpoint
     */
    setSpotEndpoint(endpoint: string): ClientOptionBuilder {
        this.clientOption.spotEndpoint = endpoint;
        return this;
    }

    /**
     * setFuturesEndpoint sets the futures market API endpoint
     */
    setFuturesEndpoint(endpoint: string): ClientOptionBuilder {
        this.clientOption.futuresEndpoint = endpoint;
        return this;
    }

    /**
     * setBrokerEndpoint sets the broker API endpoint
     */
    setBrokerEndpoint(endpoint: string): ClientOptionBuilder {
        this.clientOption.brokerEndpoint = endpoint;
        return this;
    }

    /**
     * setUnifiedWsEndpoint sets the unified private WebSocket API endpoint
     */
    setUnifiedWsEndpoint(endpoint: string): ClientOptionBuilder {
        this.clientOption.unifiedWsEndpoint = endpoint;
        return this;
    }

    /**
     * setTransportOption sets the HTTP transport options
     */
    setTransportOption(option: TransportOption): ClientOptionBuilder {
        this.clientOption.transportOption = option;
        return this;
    }

    /**
     * setWebSocketClientOption sets the WebSocket client options
     */
    setWebSocketClientOption(option: WebSocketClientOption): ClientOptionBuilder {
        this.clientOption.webSocketClientOption = option;
        return this;
    }

    /**
     * Build builds and returns the ClientOption
     */
    build(): ClientOption {
        return this.clientOption;
    }
}
