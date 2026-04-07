package infra

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"io"
	"net"
	"net/http"
	"net/url"
	"reflect"
	"sort"
	"strconv"
	"strings"
	"time"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/common/logger"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/go-querystring/query"
)

type DefaultTransport struct {
	clientOption    *types.ClientOption
	transportOption *types.TransportOption
	sdkVersion      string
	singer          *KcSigner
	httpClient      *http.Client
}

func NewDefaultTransport(clientOption *types.ClientOption, sdkVersion string) *DefaultTransport {
	option := clientOption.TransportOption
	if option == nil {
		option = types.NewTransportOption()
	}
	if option.SnitchProxyURL == "" {
		option.SnitchProxyURL = clientOption.SnitchProxyURL
	}
	if len(option.SnitchConfig) == 0 && len(clientOption.SnitchConfig) > 0 {
		option.SnitchConfig = clientOption.SnitchConfig
	}

	if clientOption.Key == "" || clientOption.Secret == "" || clientOption.Passphrase == "" {
		logger.GetLogger().Warnf("no secret information provided, only the public channel API is accessible")
	}

	t := &DefaultTransport{
		clientOption:    clientOption,
		transportOption: option,
		sdkVersion:      sdkVersion,
		singer: NewKcSigner(clientOption.Key, clientOption.Secret, clientOption.Passphrase,
			clientOption.BrokerName, clientOption.BrokerPartner, clientOption.BrokerKey),
	}
	t.httpClient = &http.Client{
		Transport: t.applyOption(&http.Transport{}),
		Timeout:   t.transportOption.Timeout,
	}
	return t
}

func (t *DefaultTransport) applyOption(transport *http.Transport) *http.Transport {
	transport.DisableKeepAlives = !t.transportOption.KeepAlive
	transport.MaxIdleConns = t.transportOption.MaxIdleConns
	transport.MaxIdleConnsPerHost = t.transportOption.MaxIdleConnsPerHost
	transport.MaxConnsPerHost = t.transportOption.MaxConnsPerHost
	transport.IdleConnTimeout = t.transportOption.IdleConnTimeout
	transport.TLSHandshakeTimeout = t.transportOption.TLSHandshakeTimeout
	transport.DialContext = (&net.Dialer{Timeout: t.transportOption.Timeout}).DialContext
	if t.transportOption.Proxy != nil {
		transport.Proxy = t.transportOption.Proxy
	}
	return transport
}

func (t *DefaultTransport) DoWithRetry(req *http.Request) (resp *http.Response, err error) {
	if t.transportOption.Interceptors != nil {

		for _, interceptor := range t.transportOption.Interceptors {
			req, err = interceptor.Before(req)
			if err != nil {
				return
			}
		}

		defer func() {
			for _, interceptor := range t.transportOption.Interceptors {
				resp, err = interceptor.After(req, resp, err)
				if err != nil {
					return
				}
			}
		}()
	}

	for attempt := 0; attempt <= t.transportOption.MaxRetries; attempt++ {
		resp, err = t.httpClient.Do(req)
		if err == nil {
			return resp, nil
		}

		if attempt < t.transportOption.MaxRetries && t.shouldRetry(err) {
			logger.GetLogger().Errorf("http request failed, reason %s, attemp %d, max %d, retry in %f seconds...", err.Error(), attempt+1, t.transportOption.MaxRetries, t.transportOption.RetryDelay.Seconds())
			time.Sleep(t.transportOption.RetryDelay)
		}
	}

	return nil, errors.New("http request failed after maximum retries, last error: " + err.Error())
}

func (t *DefaultTransport) shouldRetry(err error) bool {
	if err != nil {
		var netErr net.Error
		if errors.As(err, &netErr) && (netErr.Temporary() || netErr.Timeout()) {
			return true
		}
	}

	return false
}

func (t *DefaultTransport) processPathVariable(path string, request interface{}) string {
	hasQueryVariable := false
	variableName := ""
	idx := strings.Index(path, "{")
	if idx != -1 && idx != len(path)-1 {
		path := path[idx+1:]
		idx = strings.Index(path, "}")
		if idx != -1 {
			hasQueryVariable = true
			variableName = path[:idx]
		}
	}

	if hasQueryVariable && request != nil && variableName != "" {
		val := reflect.ValueOf(request)
		if val.Kind() == reflect.Ptr {
			val = val.Elem()
		}
		if val.Kind() == reflect.Struct {
			for i := 0; i < val.Type().NumField(); i++ {
				tag := val.Type().Field(i).Tag.Get("path")
				if tag == variableName {
					fieldValue := val.Field(i)
					if fieldValue.Kind() == reflect.Ptr && !fieldValue.IsNil() {
						fieldValue = fieldValue.Elem()
					}
					variableValue := fmt.Sprintf("%v", fieldValue.Interface())
					path = strings.Replace(path, "{"+variableName+"}", variableValue, -1)
					break
				}
			}
		}
	}

	return path
}

func (t *DefaultTransport) processHeaders(method string, broker bool, rawPath string, body []byte, r *http.Request) {
	r.Header.Set("Content-Type", "application/json")
	r.Header.Set("User-Agent", "Kucoin-Universal-Go-SDK/"+t.sdkVersion)
	var b bytes.Buffer
	b.WriteString(method)
	b.WriteString(rawPath)
	b.Write(body)

	if broker {
		h := t.singer.BrokerHeaders(b.String())
		for k, v := range h {
			r.Header.Set(k, v)
		}
	} else {
		h := t.singer.Headers(b.String())
		for k, v := range h {
			r.Header.Set(k, v)
		}
	}
}

func encodeRaw(v url.Values) string {
	if len(v) == 0 {
		return ""
	}
	var buf strings.Builder
	keys := make([]string, 0, len(v))
	for k := range v {
		keys = append(keys, k)
	}
	sort.Strings(keys)
	for _, k := range keys {
		vs := v[k]
		for _, v := range vs {
			if buf.Len() > 0 {
				buf.WriteByte('&')
			}
			buf.WriteString(k)
			buf.WriteByte('=')
			buf.WriteString(v)
		}
	}
	return buf.String()
}

func (t *DefaultTransport) processRequest(ctx context.Context, broker bool, endpoint, method string,
	path string, request interface{}, requestJson bool) (*http.Request, error) {
	method = strings.ToUpper(method)
	path = t.processPathVariable(path, request)
	rawPath := path

	var reqBody []byte
	var err error

	if requestJson {
		if request != nil {
			reqBody, err = json.Marshal(request)
			if err != nil {
				return nil, err
			}
		}
	} else {
		switch method {
		case http.MethodGet:
			fallthrough
		case http.MethodDelete:
			{
				if request != nil {
					values, err := query.Values(request)
					if err != nil {
						return nil, err
					}
					if len(values) > 0 {
						path += "?" + values.Encode()
						rawPath += "?" + encodeRaw(values)
					}
				}

				break
			}
		case http.MethodPost:
			{
				if request != nil {
					reqBody, err = json.Marshal(request)
					if err != nil {
						return nil, err
					}
				}
				break
			}
		default:
			return nil, fmt.Errorf("invalid method: %s", method)
		}
	}

	fullPath := fmt.Sprintf("%s%s", endpoint, path)
	requestURL := fullPath
	if t.transportOption.SnitchProxyURL != "" {
		requestURL = t.transportOption.SnitchProxyURL
	}

	req, err := http.NewRequestWithContext(ctx, method, requestURL, bytes.NewBuffer(reqBody))
	if err != nil {
		return nil, fmt.Errorf("failed to create request: %w", err)
	}

	t.processHeaders(method, broker, rawPath, reqBody, req)
	if t.transportOption.SnitchProxyURL != "" {
		req.Header.Set("X-Proxy-To", fullPath)

		if len(t.transportOption.SnitchConfig) > 0 {
			configJSON, err := json.Marshal(t.transportOption.SnitchConfig)
			if err != nil {
				return nil, fmt.Errorf("failed to marshal snitch proxy config: %w", err)
			}
			req.Header.Set("X-Proxy-Config", string(configJSON))
		}
	}
	return req, nil
}

func (t *DefaultTransport) processLimit(resp *http.Response) *types.RestRateLimit {
	limit, err := strconv.ParseInt(resp.Header.Get("gw-ratelimit-limit"), 10, 64)
	if err != nil {
		limit = -1
	}
	remaining, err := strconv.ParseInt(resp.Header.Get("gw-ratelimit-remaining"), 10, 64)
	if err != nil {
		remaining = -1
	}
	reset, err := strconv.ParseInt(resp.Header.Get("gw-ratelimit-reset"), 10, 64)
	if err != nil {
		reset = -1
	}

	return &types.RestRateLimit{
		Limit:     limit,
		Remaining: remaining,
		Reset:     reset,
	}
}

func (t *DefaultTransport) processResponse(resp *http.Response, responseObj interfaces.Response) error {
	defer resp.Body.Close()
	respBody, err := io.ReadAll(resp.Body)
	if err != nil {
		return fmt.Errorf("failed to read response body: %w", err)
	}

	if resp.StatusCode != http.StatusOK {
		return fmt.Errorf("invalid status code: %d, msg: %s", resp.StatusCode, respBody)
	}

	commonResponse := &types.RestResponse{}

	err = json.Unmarshal(respBody, commonResponse)
	if err != nil {
		return fmt.Errorf("failed to unmarshal common response: %w", err)
	}

	// fast gc
	respBody = nil

	commonResponse.RateLimit = t.processLimit(resp)
	responseObj.SetCommonResponse(commonResponse)
	err = commonResponse.Error()
	if err != nil {
		return err
	}

	if len(commonResponse.Data) == 0 {
		return nil
	}

	err = json.Unmarshal(commonResponse.Data, responseObj)
	if err != nil {
		return fmt.Errorf("failed to unmarshal response: %w", err)
	}

	return nil
}

func (t *DefaultTransport) Call(ctx context.Context, domain string, broker bool, method string, path string,
	requestObj interface{}, responseObj interfaces.Response, requestJson bool) error {
	endpoint := t.clientOption.SpotEndpoint

	domain = strings.ToLower(domain)

	switch domain {
	case types.DomainTypeSpot:
		{
			endpoint = t.clientOption.SpotEndpoint
			break
		}

	case types.DomainTypeFutures:
		{
			endpoint = t.clientOption.FuturesEndpoint
			break
		}
	case types.DomainTypeBroker:
		{
			endpoint = t.clientOption.BrokerEndpoint
			break
		}
	default:
		return fmt.Errorf("invalid domain: %s", domain)
	}

	req, err := t.processRequest(ctx, broker, endpoint, method, path, requestObj, requestJson)
	if err != nil {
		return err
	}

	resp, err := t.DoWithRetry(req)
	if err != nil {
		return fmt.Errorf("request failed: %w", err)
	}

	return t.processResponse(resp, responseObj)
}

func (t *DefaultTransport) Close() error {
	t.httpClient.CloseIdleConnections()
	return nil
}
