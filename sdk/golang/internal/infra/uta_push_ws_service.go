package infra

import (
	"encoding/json"
	"errors"
	"fmt"
	"strings"
	"sync"
	"time"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"github.com/gorilla/websocket"
)

const (
	utaPublicSpotEndpoint    = "wss://x-push-spot.kucoin.com"
	utaPublicFuturesEndpoint = "wss://x-push-futures.kucoin.com"
	utaPrivatePushEndpoint   = "wss://wsapi-push.kucoin.com"
	utaPrivateAuthPlaintext  = "POST/api/websocket/users/verify"
)

// UtaPushSubscription describes one direct UTA push subscription.
// Callback receives the complete WebSocket event envelope.
type UtaPushSubscription struct {
	Channel          string
	Symbols          []string
	Params           map[string]any
	TradeType        string
	AccountType      string
	IncludeTradeType bool
	Callback         func([]byte) error
}

// UtaPushWsService implements the direct UTA public and private push protocols.
// Unlike the legacy SDK WebSocket transport, these endpoints do not use a token API.
type UtaPushWsService struct {
	endpoint        string
	publicTradeType string
	private         bool
	option          *types.WebSocketClientOption
	signer          *KcSigner

	mu            sync.RWMutex
	writeMu       sync.Mutex
	conn          *websocket.Conn
	started       bool
	connected     bool
	shuttingDown  bool
	reconnecting  bool
	welcome       chan error
	pending       map[string]chan error
	subscriptions map[string]*UtaPushSubscription
	pingStop      chan struct{}
	pingTimeoutAt *time.Timer
	pendingPingID string
	pingInterval  time.Duration
	pingTimeout   time.Duration
}

// NewUtaPublicPushWsService creates a direct UTA public WebSocket service for SPOT or FUTURES.
func NewUtaPublicPushWsService(option *types.WebSocketClientOption, tradeType string) (*UtaPushWsService, error) {
	tradeType = strings.ToUpper(strings.TrimSpace(tradeType))
	endpoint := ""
	switch tradeType {
	case "SPOT":
		endpoint = utaPublicSpotEndpoint
	case "FUTURES":
		endpoint = utaPublicFuturesEndpoint
	default:
		return nil, fmt.Errorf("unsupported UTA public trade type: %s", tradeType)
	}
	return newUtaPushWsService(endpoint, tradeType, false, option, nil), nil
}

// NewUtaPrivatePushWsService creates an authenticated direct UTA private push service.
func NewUtaPrivatePushWsService(clientOption *types.ClientOption) (*UtaPushWsService, error) {
	if clientOption == nil || blank(clientOption.Key) || blank(clientOption.Secret) || blank(clientOption.Passphrase) {
		return nil, errors.New("API key, secret and passphrase are required for UTA private WebSocket")
	}
	return newUtaPushWsService(
		utaPrivatePushEndpoint,
		"",
		true,
		clientOption.WebSocketClientOption,
		NewKcSigner(
			clientOption.Key,
			clientOption.Secret,
			clientOption.Passphrase,
			clientOption.BrokerName,
			clientOption.BrokerPartner,
			clientOption.BrokerKey,
		),
	), nil
}

func newUtaPushWsService(endpoint, publicTradeType string, private bool, option *types.WebSocketClientOption, signer *KcSigner) *UtaPushWsService {
	if option == nil {
		option = types.NewWebSocketClientOption()
	}
	return &UtaPushWsService{
		endpoint:        endpoint,
		publicTradeType: publicTradeType,
		private:         private,
		option:          option,
		signer:          signer,
		pending:         make(map[string]chan error),
		subscriptions:   make(map[string]*UtaPushSubscription),
		pingInterval:    18 * time.Second,
		pingTimeout:     10 * time.Second,
	}
}

// Start connects to the UTA push endpoint and waits for its welcome frame.
func (s *UtaPushWsService) Start() error {
	s.mu.Lock()
	if s.started {
		s.mu.Unlock()
		return nil
	}
	s.started = true
	s.shuttingDown = false
	s.mu.Unlock()

	if err := s.dial(); err != nil {
		s.mu.Lock()
		s.started = false
		s.mu.Unlock()
		return err
	}
	return nil
}

// Stop closes the connection and stops reconnecting.
func (s *UtaPushWsService) Stop() error {
	s.mu.Lock()
	if !s.started {
		s.mu.Unlock()
		return nil
	}
	s.started = false
	s.shuttingDown = true
	conn := s.conn
	s.conn = nil
	s.connected = false
	s.stopPingLocked()
	s.mu.Unlock()

	if conn != nil {
		_ = conn.WriteControl(websocket.CloseMessage, websocket.FormatCloseMessage(websocket.CloseNormalClosure, "shutdown"), time.Now().Add(time.Second))
		_ = conn.Close()
	}
	s.notifyEvent(types.EventClientShutdown, "")
	return nil
}

// Subscribe registers a callback and waits for the server subscription acknowledgement.
func (s *UtaPushWsService) Subscribe(subscription UtaPushSubscription) (string, error) {
	if subscription.Callback == nil {
		return "", errors.New("callback must not be nil")
	}
	if blank(subscription.Channel) {
		return "", errors.New("channel must not be blank")
	}

	id := uuid.NewString()
	copy := subscription
	copy.Symbols = append([]string(nil), subscription.Symbols...)
	if subscription.Params != nil {
		copy.Params = make(map[string]any, len(subscription.Params))
		for key, value := range subscription.Params {
			copy.Params[key] = value
		}
	}

	s.mu.Lock()
	if !s.connected {
		s.mu.Unlock()
		return "", errors.New("UTA WebSocket is not connected; call Start first")
	}
	s.subscriptions[id] = &copy
	s.mu.Unlock()

	if err := s.sendSubscription(id, "subscribe", &copy); err != nil {
		s.mu.Lock()
		delete(s.subscriptions, id)
		s.mu.Unlock()
		return "", err
	}
	return id, nil
}

// Unsubscribe removes a previously registered subscription after its acknowledgement.
func (s *UtaPushWsService) Unsubscribe(id string) error {
	s.mu.RLock()
	subscription := s.subscriptions[id]
	s.mu.RUnlock()
	if subscription == nil {
		return nil
	}
	if err := s.sendSubscription(id, "unsubscribe", subscription); err != nil {
		return err
	}
	s.mu.Lock()
	delete(s.subscriptions, id)
	s.mu.Unlock()
	return nil
}

func (s *UtaPushWsService) dial() error {
	dialer := websocket.Dialer{
		HandshakeTimeout: s.option.DialTimeout,
		ReadBufferSize:   s.option.ReadBufferBytes,
		WriteBufferSize:  s.option.ReadBufferBytes,
	}
	conn, _, err := dialer.Dial(s.endpoint, nil)
	if err != nil {
		return fmt.Errorf("UTA WebSocket connection failed: %w", err)
	}

	welcome := make(chan error, 1)
	s.mu.Lock()
	s.conn = conn
	s.welcome = welcome
	s.pendingPingID = ""
	s.mu.Unlock()
	go s.readLoop(conn)

	select {
	case err := <-welcome:
		if err != nil {
			s.closeDialConnection(conn)
			return err
		}
	case <-time.After(s.option.DialTimeout):
		s.closeDialConnection(conn)
		return errors.New("welcome not received before dial timeout")
	}

	if s.private {
		if err := s.authenticate(); err != nil {
			s.closeDialConnection(conn)
			return err
		}
	}

	s.mu.Lock()
	if s.conn != conn {
		s.mu.Unlock()
		return errors.New("UTA WebSocket disconnected during dial")
	}
	s.connected = true
	s.startPingLocked(conn)
	s.mu.Unlock()
	if s.private {
		s.notifyEvent(types.EventConnected, "UTA_PRIVATE")
	} else {
		s.notifyEvent(types.EventConnected, s.publicTradeType)
	}
	return nil
}

func (s *UtaPushWsService) authenticate() error {
	headers := s.signer.Headers(utaPrivateAuthPlaintext)
	id := uuid.NewString()
	return s.sendAndAwaitAck(id, map[string]any{
		"id":                id,
		"op":                "auth",
		"kc-api-key":        headers["KC-API-KEY"],
		"kc-api-sign":       headers["KC-API-SIGN"],
		"kc-api-timestamp":  headers["KC-API-TIMESTAMP"],
		"kc-api-passphrase": headers["KC-API-PASSPHRASE"],
	}, "authentication")
}

func (s *UtaPushWsService) sendSubscription(id, action string, subscription *UtaPushSubscription) error {
	request := map[string]any{
		"id":      id,
		"action":  action,
		"channel": subscription.Channel,
	}
	if subscription.AccountType != "" {
		request["accountType"] = subscription.AccountType
	} else if subscription.IncludeTradeType {
		tradeType := subscription.TradeType
		if tradeType == "" {
			tradeType = s.publicTradeType
		}
		request["tradeType"] = tradeType
	}
	if len(subscription.Symbols) == 1 {
		request["symbol"] = subscription.Symbols[0]
	} else if len(subscription.Symbols) > 1 {
		request["symbols"] = subscription.Symbols
	}
	for key, value := range subscription.Params {
		request[key] = value
	}
	return s.sendAndAwaitAck(id, request, action+" "+subscription.Channel)
}

func (s *UtaPushWsService) sendAndAwaitAck(id string, request map[string]any, operation string) error {
	ack := make(chan error, 1)
	s.mu.Lock()
	if s.conn == nil {
		s.mu.Unlock()
		return errors.New("UTA WebSocket is not connected")
	}
	s.pending[id] = ack
	s.mu.Unlock()

	defer func() {
		s.mu.Lock()
		delete(s.pending, id)
		s.mu.Unlock()
	}()
	if err := s.writeJSON(request); err != nil {
		return err
	}

	select {
	case err := <-ack:
		if err != nil {
			return fmt.Errorf("%s failed: %w", operation, err)
		}
		return nil
	case <-time.After(s.option.WriteTimeout):
		return fmt.Errorf("%s acknowledgement timed out", operation)
	}
}

func (s *UtaPushWsService) writeJSON(message any) error {
	payload, err := json.Marshal(message)
	if err != nil {
		return err
	}
	s.writeMu.Lock()
	defer s.writeMu.Unlock()
	s.mu.RLock()
	conn := s.conn
	s.mu.RUnlock()
	if conn == nil {
		return errors.New("UTA WebSocket is not connected")
	}
	_ = conn.SetWriteDeadline(time.Now().Add(s.option.WriteTimeout))
	return conn.WriteMessage(websocket.TextMessage, payload)
}

func (s *UtaPushWsService) readLoop(conn *websocket.Conn) {
	for {
		_, payload, err := conn.ReadMessage()
		if err != nil {
			s.signalWelcome(err)
			s.onDisconnected(conn, err)
			return
		}
		s.handleMessage(payload)
	}
}

func (s *UtaPushWsService) handleMessage(payload []byte) {
	var frame struct {
		ID           string          `json:"id"`
		Result       json.RawMessage `json:"result"`
		Message      string          `json:"message"`
		Op           string          `json:"op"`
		Type         string          `json:"type"`
		Data         json.RawMessage `json:"data"`
		Topic        string          `json:"T"`
		EventData    json.RawMessage `json:"d"`
		PingInterval int64           `json:"pingInterval"`
		PingTimeout  int64           `json:"pingTimeout"`
	}
	if err := json.Unmarshal(payload, &frame); err != nil {
		s.notifyEvent(types.EventErrorReceived, err.Error())
		return
	}
	if isUtaWelcome(frame.Message, frame.Op, frame.Type, frame.Data) {
		s.mu.Lock()
		if frame.PingInterval > 0 {
			s.pingInterval = time.Duration(frame.PingInterval) * time.Millisecond
		}
		if frame.PingTimeout > 0 {
			s.pingTimeout = time.Duration(frame.PingTimeout) * time.Millisecond
		}
		welcome := s.welcome
		s.mu.Unlock()
		if welcome != nil {
			select {
			case welcome <- nil:
			default:
			}
		}
		return
	}
	if strings.EqualFold(frame.Op, "pong") {
		s.mu.Lock()
		s.pendingPingID = ""
		if s.pingTimeoutAt != nil {
			s.pingTimeoutAt.Stop()
			s.pingTimeoutAt = nil
		}
		s.mu.Unlock()
		s.notifyEvent(types.EventPongReceived, "")
		return
	}
	if frame.ID != "" && frame.Result != nil {
		s.resolveAck(frame.ID, frame.Result, payload)
		return
	}
	if frame.Topic != "" && frame.EventData != nil {
		s.dispatch(frame.Topic, frame.EventData, payload)
	}
}

func (s *UtaPushWsService) resolveAck(id string, result json.RawMessage, payload []byte) {
	var accepted bool
	if err := json.Unmarshal(result, &accepted); err != nil {
		var text string
		if json.Unmarshal(result, &text) == nil {
			accepted = strings.EqualFold(text, "true")
		}
	}
	s.mu.RLock()
	ack := s.pending[id]
	s.mu.RUnlock()
	if ack == nil {
		return
	}
	if accepted {
		ack <- nil
	} else {
		ack <- errors.New(string(payload))
	}
}

func (s *UtaPushWsService) dispatch(topic string, eventData, payload []byte) {
	channel := topic
	if strings.HasPrefix(channel, "execution.lite.") {
		channel = "execution.lite"
	} else if index := strings.IndexByte(channel, '.'); index >= 0 {
		channel = channel[:index]
	}
	var data struct {
		Symbol string `json:"s"`
	}
	_ = json.Unmarshal(eventData, &data)

	s.mu.RLock()
	subscriptions := make([]*UtaPushSubscription, 0, len(s.subscriptions))
	for _, subscription := range s.subscriptions {
		subscriptions = append(subscriptions, subscription)
	}
	s.mu.RUnlock()
	for _, subscription := range subscriptions {
		if !subscriptionMatches(subscription, channel, topic, data.Symbol) {
			continue
		}
		if err := subscription.Callback(payload); err != nil {
			s.notifyEvent(types.EventCallbackError, err.Error())
		}
	}
}

func subscriptionMatches(subscription *UtaPushSubscription, eventChannel, topic, symbol string) bool {
	channelMatches := subscription.Channel == eventChannel ||
		(subscription.Channel == "orderAll" && eventChannel == "order") ||
		(subscription.Channel == "positionAll" && eventChannel == "position")
	if !channelMatches {
		return false
	}
	if subscription.AccountType != "" && !strings.EqualFold(topic, subscription.Channel+"."+subscription.AccountType) {
		return false
	}
	if len(subscription.Symbols) == 0 {
		return true
	}
	for _, expected := range subscription.Symbols {
		if expected == symbol {
			return true
		}
	}
	return false
}

func (s *UtaPushWsService) startPingLocked(conn *websocket.Conn) {
	s.stopPingLocked()
	stop := make(chan struct{})
	s.pingStop = stop
	interval := s.pingInterval
	if interval < time.Second {
		interval = time.Second
	}
	go func() {
		ticker := time.NewTicker(interval)
		defer ticker.Stop()
		for {
			select {
			case <-stop:
				return
			case <-ticker.C:
				s.mu.Lock()
				if s.conn != conn || !s.connected {
					s.mu.Unlock()
					return
				}
				if s.pendingPingID != "" {
					s.mu.Unlock()
					s.onDisconnected(conn, errors.New("pong timeout"))
					return
				}
				id := uuid.NewString()
				s.pendingPingID = id
				timeout := s.pingTimeout
				if timeout <= 0 {
					timeout = 10 * time.Second
				}
				s.pingTimeoutAt = time.AfterFunc(timeout, func() {
					s.mu.Lock()
					expired := s.conn == conn && s.pendingPingID == id
					s.mu.Unlock()
					if expired {
						s.onDisconnected(conn, errors.New("pong timeout"))
					}
				})
				s.mu.Unlock()
				if err := s.writeJSON(map[string]any{"id": id, "op": "ping", "timestamp": time.Now().UnixMilli()}); err != nil {
					s.onDisconnected(conn, err)
					return
				}
			}
		}
	}()
}

func (s *UtaPushWsService) stopPingLocked() {
	if s.pingStop != nil {
		close(s.pingStop)
		s.pingStop = nil
	}
	if s.pingTimeoutAt != nil {
		s.pingTimeoutAt.Stop()
		s.pingTimeoutAt = nil
	}
	s.pendingPingID = ""
}

func (s *UtaPushWsService) onDisconnected(conn *websocket.Conn, cause error) {
	s.mu.Lock()
	if s.conn != conn {
		s.mu.Unlock()
		return
	}
	wasConnected := s.connected
	shouldReconnect := s.started && !s.shuttingDown && s.option.Reconnect && wasConnected
	s.conn = nil
	s.connected = false
	s.stopPingLocked()
	if shouldReconnect && !s.reconnecting {
		s.reconnecting = true
		go s.reconnect()
	}
	s.mu.Unlock()
	_ = conn.Close()
	if wasConnected {
		s.notifyEvent(types.EventDisconnected, cause.Error())
	}
}

func (s *UtaPushWsService) reconnect() {
	defer func() {
		s.mu.Lock()
		s.reconnecting = false
		s.mu.Unlock()
	}()
	for attempt := 0; ; attempt++ {
		s.mu.RLock()
		active := s.started && !s.shuttingDown
		limit := s.option.ReconnectAttempts
		s.mu.RUnlock()
		if !active || (limit >= 0 && attempt >= limit) {
			if limit >= 0 && attempt >= limit {
				s.notifyEvent(types.EventClientFail, "maximum reconnect attempts exceeded")
			}
			return
		}
		s.notifyEvent(types.EventTryReconnect, fmt.Sprintf("attempt %d", attempt))
		if err := s.dial(); err == nil {
			s.mu.RLock()
			items := make([]struct {
				id  string
				sub *UtaPushSubscription
			}, 0, len(s.subscriptions))
			for id, sub := range s.subscriptions {
				items = append(items, struct {
					id  string
					sub *UtaPushSubscription
				}{id, sub})
			}
			s.mu.RUnlock()
			for _, item := range items {
				if err := s.sendSubscription(item.id, "subscribe", item.sub); err != nil {
					s.notifyEvent(types.EventReSubscribeError, err.Error())
					break
				}
			}
			s.notifyEvent(types.EventReSubscribeOK, "UTA")
			return
		} else {
			s.notifyEvent(types.EventReSubscribeError, err.Error())
		}
		time.Sleep(s.option.ReconnectInterval)
	}
}

func (s *UtaPushWsService) signalWelcome(err error) {
	s.mu.RLock()
	welcome := s.welcome
	s.mu.RUnlock()
	if welcome != nil {
		select {
		case welcome <- err:
		default:
		}
	}
}

func (s *UtaPushWsService) closeDialConnection(conn *websocket.Conn) {
	s.mu.Lock()
	if s.conn == conn {
		s.conn = nil
		s.connected = false
		s.stopPingLocked()
	}
	s.mu.Unlock()
	_ = conn.Close()
}

func (s *UtaPushWsService) notifyEvent(event types.WebSocketEvent, message string) {
	if s.option.EventCallback != nil {
		s.option.EventCallback(event, message)
	}
}

func isUtaWelcome(message, op, frameType string, data json.RawMessage) bool {
	if strings.EqualFold(message, "welcome") || strings.EqualFold(op, "welcome") || strings.EqualFold(frameType, "welcome") {
		return true
	}
	var text string
	return json.Unmarshal(data, &text) == nil && strings.EqualFold(text, "welcome")
}

func blank(value string) bool { return strings.TrimSpace(value) == "" }
