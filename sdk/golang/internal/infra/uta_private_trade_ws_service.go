package infra

import (
	"encoding/json"
	"errors"
	"fmt"
	"net/url"
	"sync"
	"time"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/google/uuid"
	"github.com/gorilla/websocket"
)

const utaPrivateTradeEndpoint = "wss://wsapi.kucoin.com/v1/private"

// UtaPrivateTradeWsService implements KuCoin's direct authenticated UTA trading WebSocket.
// The gateway first sends an authentication challenge which must be signed with the raw API
// secret, then accepts uta.order, uta.cancel, and uta.amend commands.
type UtaPrivateTradeWsService struct {
	option    *types.WebSocketClientOption
	signer    *KcSigner
	apiKey    string
	apiSecret string

	mu           sync.RWMutex
	writeMu      sync.Mutex
	conn         *websocket.Conn
	started      bool
	connected    bool
	shuttingDown bool
	reconnecting bool
	welcome      chan error
	pending      map[string]chan utaTradeResult
}

type utaTradeResult struct {
	payload []byte
	err     error
}

// NewUtaPrivateTradeWsService creates the UTA trading transport.
func NewUtaPrivateTradeWsService(clientOption *types.ClientOption) (*UtaPrivateTradeWsService, error) {
	if clientOption == nil || blank(clientOption.Key) || blank(clientOption.Secret) || blank(clientOption.Passphrase) {
		return nil, errors.New("API key, secret and passphrase are required for UTA private trade WebSocket")
	}
	option := clientOption.WebSocketClientOption
	if option == nil {
		option = types.NewWebSocketClientOption()
	}
	return &UtaPrivateTradeWsService{
		option: option,
		signer: NewKcSigner(
			clientOption.Key,
			clientOption.Secret,
			clientOption.Passphrase,
			clientOption.BrokerName,
			clientOption.BrokerPartner,
			clientOption.BrokerKey,
		),
		apiKey:    clientOption.Key,
		apiSecret: clientOption.Secret,
		pending:   make(map[string]chan utaTradeResult),
	}, nil
}

// Start connects to and authenticates the UTA private trading endpoint.
func (s *UtaPrivateTradeWsService) Start() error {
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
	s.notifyEvent(types.EventConnected, "UTA_PRIVATE_TRADE")
	return nil
}

// Stop closes the direct trading connection and fails outstanding commands.
func (s *UtaPrivateTradeWsService) Stop() error {
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
	pending := s.pending
	s.pending = make(map[string]chan utaTradeResult)
	s.mu.Unlock()

	if conn != nil {
		_ = conn.WriteControl(websocket.CloseMessage, websocket.FormatCloseMessage(websocket.CloseNormalClosure, "shutdown"), time.Now().Add(time.Second))
		_ = conn.Close()
	}
	for _, result := range pending {
		result <- utaTradeResult{err: errors.New("UTA private trade WebSocket stopped")}
	}
	s.notifyEvent(types.EventClientShutdown, "")
	return nil
}

// Call sends one UTA WebSocket trade operation and waits for the matching response.
func (s *UtaPrivateTradeWsService) Call(operation string, args any) ([]byte, error) {
	if args == nil {
		return nil, errors.New("trade request must not be nil")
	}
	s.mu.RLock()
	connected := s.connected
	s.mu.RUnlock()
	if !connected {
		return nil, errors.New("UTA private trade WebSocket is not connected; call Start first")
	}

	encodedArgs, err := json.Marshal(args)
	if err != nil {
		return nil, fmt.Errorf("serialize %s arguments: %w", operation, err)
	}
	var objectArgs map[string]any
	if err = json.Unmarshal(encodedArgs, &objectArgs); err != nil {
		return nil, fmt.Errorf("serialize %s arguments: %w", operation, err)
	}
	if operation == "uta.order" {
		removeUnsupportedTriggerTypes(objectArgs)
	}

	id := uuid.NewString()
	result := make(chan utaTradeResult, 1)
	s.mu.Lock()
	if !s.connected || s.conn == nil {
		s.mu.Unlock()
		return nil, errors.New("UTA private trade WebSocket is not connected")
	}
	s.pending[id] = result
	s.mu.Unlock()
	defer func() {
		s.mu.Lock()
		delete(s.pending, id)
		s.mu.Unlock()
	}()

	if err = s.writeJSON(map[string]any{"id": id, "op": operation, "args": objectArgs}); err != nil {
		return nil, fmt.Errorf("%s failed: %w", operation, err)
	}
	select {
	case response := <-result:
		if response.err != nil {
			return nil, fmt.Errorf("%s failed: %w", operation, response.err)
		}
		return response.payload, nil
	case <-time.After(s.option.WriteTimeout):
		return nil, fmt.Errorf("%s response timed out", operation)
	}
}

func removeUnsupportedTriggerTypes(args map[string]any) {
	if value, ok := args["tpTriggerPrice"]; !ok || blank(fmt.Sprint(value)) {
		delete(args, "tpTriggerPriceType")
	}
	if value, ok := args["slTriggerPrice"]; !ok || blank(fmt.Sprint(value)) {
		delete(args, "slTriggerPriceType")
	}
}

func (s *UtaPrivateTradeWsService) dial() error {
	headers := s.signer.Headers("")
	values := url.Values{}
	values.Set("apikey", s.apiKey)
	values.Set("timestamp", headers["KC-API-TIMESTAMP"])
	values.Set("sign", string(Sign([]byte(s.apiKey+headers["KC-API-TIMESTAMP"]), []byte(s.apiSecret))))
	values.Set("passphrase", headers["KC-API-PASSPHRASE"])
	endpoint := utaPrivateTradeEndpoint + "?" + values.Encode()

	dialer := websocket.Dialer{
		HandshakeTimeout: s.option.DialTimeout,
		ReadBufferSize:   s.option.ReadBufferBytes,
		WriteBufferSize:  s.option.ReadBufferBytes,
	}
	conn, _, err := dialer.Dial(endpoint, nil)
	if err != nil {
		return fmt.Errorf("UTA private trade WebSocket connection failed: %w", err)
	}
	welcome := make(chan error, 1)
	s.mu.Lock()
	s.conn = conn
	s.welcome = welcome
	s.mu.Unlock()
	go s.readLoop(conn)

	select {
	case err = <-welcome:
		if err != nil {
			s.closeDialConnection(conn)
			return err
		}
	case <-time.After(s.option.DialTimeout):
		s.closeDialConnection(conn)
		return errors.New("welcome not received before dial timeout")
	}
	s.mu.Lock()
	if s.conn != conn {
		s.mu.Unlock()
		return errors.New("UTA private trade WebSocket disconnected during dial")
	}
	s.connected = true
	s.mu.Unlock()
	return nil
}

func (s *UtaPrivateTradeWsService) writeJSON(message any) error {
	payload, err := json.Marshal(message)
	if err != nil {
		return err
	}
	return s.writeText(string(payload))
}

func (s *UtaPrivateTradeWsService) writeText(payload string) error {
	s.writeMu.Lock()
	defer s.writeMu.Unlock()
	s.mu.RLock()
	conn := s.conn
	s.mu.RUnlock()
	if conn == nil {
		return errors.New("UTA private trade WebSocket is not connected")
	}
	_ = conn.SetWriteDeadline(time.Now().Add(s.option.WriteTimeout))
	return conn.WriteMessage(websocket.TextMessage, []byte(payload))
}

func (s *UtaPrivateTradeWsService) readLoop(conn *websocket.Conn) {
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

func (s *UtaPrivateTradeWsService) handleMessage(payload []byte) {
	var frame struct {
		ID        string          `json:"id"`
		Code      json.RawMessage `json:"code"`
		Message   string          `json:"message"`
		Op        string          `json:"op"`
		Type      string          `json:"type"`
		Data      json.RawMessage `json:"data"`
		SessionID string          `json:"sessionId"`
		Timestamp json.RawMessage `json:"timestamp"`
	}
	if err := json.Unmarshal(payload, &frame); err != nil {
		s.failAll(fmt.Errorf("decode UTA trade response: %w", err))
		return
	}
	if isUtaWelcome(frame.Message, frame.Op, frame.Type, frame.Data) {
		s.signalWelcome(nil)
		return
	}
	if frame.SessionID != "" && frame.Timestamp != nil && frame.Data == nil {
		if err := s.writeText(string(Sign(payload, []byte(s.apiSecret)))); err != nil {
			s.signalWelcome(fmt.Errorf("UTA trade challenge authentication failed: %w", err))
		}
		return
	}
	if frame.ID == "" {
		if frame.Code != nil {
			s.signalWelcome(errors.New(string(payload)))
		}
		return
	}

	var code string
	if json.Unmarshal(frame.Code, &code) != nil {
		var numeric json.Number
		if json.Unmarshal(frame.Code, &numeric) == nil {
			code = numeric.String()
		}
	}
	s.mu.RLock()
	pending := s.pending[frame.ID]
	s.mu.RUnlock()
	if pending == nil {
		return
	}
	if code == "200000" {
		pending <- utaTradeResult{payload: append([]byte(nil), payload...)}
	} else {
		pending <- utaTradeResult{err: errors.New(string(payload))}
	}
}

func (s *UtaPrivateTradeWsService) signalWelcome(err error) {
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

func (s *UtaPrivateTradeWsService) closeDialConnection(conn *websocket.Conn) {
	s.mu.Lock()
	if s.conn == conn {
		s.conn = nil
		s.connected = false
	}
	s.mu.Unlock()
	_ = conn.Close()
}

func (s *UtaPrivateTradeWsService) onDisconnected(conn *websocket.Conn, cause error) {
	s.mu.Lock()
	if s.conn != conn {
		s.mu.Unlock()
		return
	}
	wasConnected := s.connected
	s.conn = nil
	s.connected = false
	started := s.started
	shuttingDown := s.shuttingDown
	pending := s.pending
	s.pending = make(map[string]chan utaTradeResult)
	s.mu.Unlock()
	_ = conn.Close()
	for _, result := range pending {
		result <- utaTradeResult{err: cause}
	}
	if !wasConnected {
		s.signalWelcome(cause)
	}
	if started && !shuttingDown && wasConnected {
		s.notifyEvent(types.EventDisconnected, cause.Error())
		if s.option.Reconnect {
			s.mu.Lock()
			if !s.reconnecting {
				s.reconnecting = true
				go s.reconnect()
			}
			s.mu.Unlock()
		}
	}
}

func (s *UtaPrivateTradeWsService) reconnect() {
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
			if active && limit >= 0 && attempt >= limit {
				s.notifyEvent(types.EventClientFail, "maximum reconnect attempts exceeded")
			}
			return
		}
		s.notifyEvent(types.EventTryReconnect, fmt.Sprintf("attempt %d", attempt))
		if err := s.dial(); err == nil {
			s.notifyEvent(types.EventReSubscribeOK, "UTA_PRIVATE_TRADE")
			return
		} else {
			s.notifyEvent(types.EventReSubscribeError, err.Error())
		}
		time.Sleep(s.option.ReconnectInterval)
	}
}

func (s *UtaPrivateTradeWsService) failAll(err error) {
	s.mu.Lock()
	pending := s.pending
	s.pending = make(map[string]chan utaTradeResult)
	s.mu.Unlock()
	for _, result := range pending {
		result <- utaTradeResult{err: err}
	}
}

func (s *UtaPrivateTradeWsService) notifyEvent(event types.WebSocketEvent, message string) {
	if s.option.EventCallback != nil {
		s.option.EventCallback(event, message)
	}
}
