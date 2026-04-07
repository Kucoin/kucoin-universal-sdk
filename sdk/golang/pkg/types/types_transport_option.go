package types

import (
	"net/http"
	"net/url"
	"time"
)

// Interceptor is an interface for defining HTTP request interceptors.
type Interceptor interface {
	// Before the request is sent. Allows modification of the request before sending
	Before(req *http.Request) (*http.Request, error)

	// After the request is completed. Allows processing of the response or error.
	After(req *http.Request, resp *http.Response, err error) (*http.Response, error)
}

// TransportOption is a struct for storing various HTTP request configurations.
type TransportOption struct {
	Timeout             time.Duration                         // Request timeout duration; default: 30s
	KeepAlive           bool                                  // Whether to enable keep-alive (persistent connection); default: true
	MaxIdleConns        int                                   // Controls the maximum number of idle (keep-alive) connections across all hosts. Zero means no limit; default: 100
	MaxIdleConnsPerHost int                                   // Controls the maximum idle(keep-alive) connections to keep per-host; default: 2
	MaxConnsPerHost     int                                   // Limits the total number of connections per host; Zero means no limit. default: 10
	TLSHandshakeTimeout time.Duration                         // specifies the maximum amount of time to wait for a TLS handshake. Zero means no timeout. default:10s
	IdleConnTimeout     time.Duration                         // Maximum amount of time an idle(keep-alive) connection will remain idle before closing itself. Zero means no limit. default:90s
	Proxy               func(*http.Request) (*url.URL, error) // HTTP proxy function
	SnitchProxyURL      string                                // SnitchProxyURL is the application-level proxy endpoint that receives SDK requests
	SnitchConfig        map[string]any                        // SnitchConfig holds proxy-specific request config shared across requests
	MaxRetries          int                                   // Maximum number of retry attempts; default: 3
	RetryDelay          time.Duration                         // Delay duration between retries; default: 2s
	Interceptors        []Interceptor                         // Http interceptor.
}

// NewTransportOption creates a new TransportOption with default values.
func NewTransportOption() *TransportOption {
	return &TransportOption{
		Timeout:             30 * time.Second,
		KeepAlive:           true,
		MaxIdleConns:        100,
		MaxIdleConnsPerHost: 2,
		MaxConnsPerHost:     10,
		TLSHandshakeTimeout: 10 * time.Second,
		IdleConnTimeout:     90 * time.Second,
		Proxy:               nil,
		SnitchProxyURL:      "",
		SnitchConfig:        nil,
		MaxRetries:          3,
		RetryDelay:          2 * time.Second,
		Interceptors:        nil,
	}
}

// TransportOptionBuilder is a builder for TransportOption.
type TransportOptionBuilder struct {
	option *TransportOption
}

// NewTransportOptionBuilder creates a new TransportOptionBuilder.
func NewTransportOptionBuilder() *TransportOptionBuilder {
	return &TransportOptionBuilder{
		option: NewTransportOption(),
	}
}

// SetTimeout sets the timeout duration.
func (b *TransportOptionBuilder) SetTimeout(timeout time.Duration) *TransportOptionBuilder {
	b.option.Timeout = timeout
	return b
}

// SetKeepAlive sets the keep-alive option.
func (b *TransportOptionBuilder) SetKeepAlive(keepAlive bool) *TransportOptionBuilder {
	b.option.KeepAlive = keepAlive
	return b
}

// SetMaxIdleConns sets the maximum number of idle connections.
func (b *TransportOptionBuilder) SetMaxIdleConns(maxIdleConns int) *TransportOptionBuilder {
	b.option.MaxIdleConns = maxIdleConns
	return b
}

// SetMaxIdleConnsPerHost sets the maximum number of idle connections per host.
func (b *TransportOptionBuilder) SetMaxIdleConnsPerHost(maxIdleConnsPerHost int) *TransportOptionBuilder {
	b.option.MaxIdleConnsPerHost = maxIdleConnsPerHost
	return b
}

// SetMaxConnsPerHost sets the maximum number of connections per host.
func (b *TransportOptionBuilder) SetMaxConnsPerHost(maxConnsPerHost int) *TransportOptionBuilder {
	b.option.MaxConnsPerHost = maxConnsPerHost
	return b
}

// SetIdleConnTimeout sets the idle connection timeout duration.
func (b *TransportOptionBuilder) SetIdleConnTimeout(idleConnTimeout time.Duration) *TransportOptionBuilder {
	b.option.IdleConnTimeout = idleConnTimeout
	return b
}

// SetTLSHandshakeTimeout sets the TLS handshake timeout duration.
func (b *TransportOptionBuilder) SetTLSHandshakeTimeout(tlsHandshakeTimeout time.Duration) *TransportOptionBuilder {
	b.option.TLSHandshakeTimeout = tlsHandshakeTimeout
	return b
}

// SetProxy sets the proxy function.
func (b *TransportOptionBuilder) SetProxy(proxy func(*http.Request) (*url.URL, error)) *TransportOptionBuilder {
	b.option.Proxy = proxy
	return b
}

// SetMaxRetries sets the maximum number of retries.
func (b *TransportOptionBuilder) SetMaxRetries(maxRetries int) *TransportOptionBuilder {
	b.option.MaxRetries = maxRetries
	return b
}

// SetRetryDelay sets the delay duration between retries.
func (b *TransportOptionBuilder) SetRetryDelay(retryDelay time.Duration) *TransportOptionBuilder {
	b.option.RetryDelay = retryDelay
	return b
}

// SetInterceptors sets http interceptors
func (b *TransportOptionBuilder) SetInterceptors(interceptors []Interceptor) *TransportOptionBuilder {
	b.option.Interceptors = interceptors
	return b
}

// AddInterceptors add http interceptor
func (b *TransportOptionBuilder) AddInterceptors(interceptors Interceptor) *TransportOptionBuilder {
	if b.option.Interceptors == nil {
		b.option.Interceptors = make([]Interceptor, 0)
	}
	b.option.Interceptors = append(b.option.Interceptors, interceptors)
	return b
}

// Build builds the TransportOption.
func (b *TransportOptionBuilder) Build() *TransportOption {
	return b.option
}
