package types

// ClientOption holds the configuration details for a client including authentication keys, API endpoints and transport options.
type ClientOption struct {
	// Secrets
	Key        string // Key is the authentication key for the client
	Secret     string // Secret is the authentication secret for the client
	Passphrase string // Passphrase  is the authentication passphrase for the client
	// Snitch proxy
	SnitchProxyURL string         // SnitchProxyURL is the snitch proxy endpoint that all REST requests must use
	SnitchConfig   map[string]any // SnitchConfig holds proxy-specific request config shared across requests
	// Broker related secret
	BrokerName    string // BrokerName The name of the broker
	BrokerPartner string // BrokerPartner The partner associated with the broker
	BrokerKey     string // BrokerKey The secret key for the broker
	// Endpoints
	SpotEndpoint    string // SpotEndpoint is the spot market API endpoint for the client
	FuturesEndpoint string // FuturesEndpoint is the futures market API endpoint for the client
	BrokerEndpoint  string // BrokerEndpoint is the broker API endpoint for the client
	// Options
	TransportOption       *TransportOption       // TransportOption is an optional configuration for http network transport
	WebSocketClientOption *WebSocketClientOption // WebSocketClientOption is an optional configuration for websocket transport
}

// ClientOptionBuilder is the builder for ClientOption
type ClientOptionBuilder struct {
	clientOption *ClientOption
}

// NewClientOptionBuilder creates a new instance of ClientOptionBuilder
func NewClientOptionBuilder() *ClientOptionBuilder {
	return &ClientOptionBuilder{
		clientOption: &ClientOption{},
	}
}

// WithKey sets the authentication key
func (b *ClientOptionBuilder) WithKey(key string) *ClientOptionBuilder {
	b.clientOption.Key = key
	return b
}

// WithSecret sets the authentication secret
func (b *ClientOptionBuilder) WithSecret(secret string) *ClientOptionBuilder {
	b.clientOption.Secret = secret
	return b
}

// WithPassphrase sets the authentication passphrase
func (b *ClientOptionBuilder) WithPassphrase(passphrase string) *ClientOptionBuilder {
	b.clientOption.Passphrase = passphrase
	return b
}

// WithSnitchProxyURL sets the snitch proxy endpoint.
func (b *ClientOptionBuilder) WithSnitchProxyURL(proxyURL string) *ClientOptionBuilder {
	b.clientOption.SnitchProxyURL = proxyURL
	return b
}

// WithSnitchConfig sets proxy-specific request config shared across requests.
func (b *ClientOptionBuilder) WithSnitchConfig(config map[string]any) *ClientOptionBuilder {
	b.clientOption.SnitchConfig = config
	return b
}

// WithBrokerName sets the broker name
func (b *ClientOptionBuilder) WithBrokerName(brokerName string) *ClientOptionBuilder {
	b.clientOption.BrokerName = brokerName
	return b
}

// WithBrokerPartner sets the broker partner
func (b *ClientOptionBuilder) WithBrokerPartner(brokerPartner string) *ClientOptionBuilder {
	b.clientOption.BrokerPartner = brokerPartner
	return b
}

// WithBrokerKey sets the broker key
func (b *ClientOptionBuilder) WithBrokerKey(brokerKey string) *ClientOptionBuilder {
	b.clientOption.BrokerKey = brokerKey
	return b
}

// WithSpotEndpoint sets the spot market API endpoint
func (b *ClientOptionBuilder) WithSpotEndpoint(endpoint string) *ClientOptionBuilder {
	b.clientOption.SpotEndpoint = endpoint
	return b
}

// WithFuturesEndpoint sets the futures market API endpoint
func (b *ClientOptionBuilder) WithFuturesEndpoint(endpoint string) *ClientOptionBuilder {
	b.clientOption.FuturesEndpoint = endpoint
	return b
}

// WithBrokerEndpoint sets the broker API endpoint
func (b *ClientOptionBuilder) WithBrokerEndpoint(endpoint string) *ClientOptionBuilder {
	b.clientOption.BrokerEndpoint = endpoint
	return b
}

// WithTransportOption sets the HTTP transport options
func (b *ClientOptionBuilder) WithTransportOption(option *TransportOption) *ClientOptionBuilder {
	b.clientOption.TransportOption = option
	return b
}

// WithWebSocketClientOption sets the WebSocket client options
func (b *ClientOptionBuilder) WithWebSocketClientOption(option *WebSocketClientOption) *ClientOptionBuilder {
	b.clientOption.WebSocketClientOption = option
	return b
}

// Build builds and returns the ClientOption
func (b *ClientOptionBuilder) Build() *ClientOption {
	return b.clientOption
}
