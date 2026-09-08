// Code generated from the UTA Private WebSocket schema; DO NOT EDIT.

// Package privatews provides direct UTA private push and trading WebSocket APIs.
package privatews

import (
	"bytes"
	"encoding/json"
	"errors"
	"fmt"
	"strings"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/infra"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate/uta/order"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// FlexibleString decodes both JSON strings and JSON numbers while preserving their text form.
// Some UTA private events use a numeric value in one account mode and a string in another.
type FlexibleString string

func (value *FlexibleString) UnmarshalJSON(data []byte) error {
	if bytes.Equal(data, []byte("null")) {
		*value = ""
		return nil
	}
	var text string
	if err := json.Unmarshal(data, &text); err == nil {
		*value = FlexibleString(text)
		return nil
	}
	var number json.Number
	if err := json.Unmarshal(data, &number); err != nil {
		return err
	}
	*value = FlexibleString(number.String())
	return nil
}

func (value FlexibleString) String() string { return string(value) }

type BalanceAccountType string

const (
	BalanceAccountTypeUnified  BalanceAccountType = "UNIFIED"
	BalanceAccountTypeFunding  BalanceAccountType = "FUNDING"
	BalanceAccountTypeIsolated BalanceAccountType = "ISOLATED"
)

type ExecutionLiteTradeType string

const (
	ExecutionLiteTradeTypeSpot     ExecutionLiteTradeType = "SPOT"
	ExecutionLiteTradeTypeIsolated ExecutionLiteTradeType = "ISOLATED"
	ExecutionLiteTradeTypeCross    ExecutionLiteTradeType = "CROSS"
	ExecutionLiteTradeTypeFutures  ExecutionLiteTradeType = "FUTURES"
	ExecutionLiteTradeTypeUnified  ExecutionLiteTradeType = "UNIFIED"
)

type ExecutionEvent struct {
	Topic    string        `json:"T"`
	Sequence int64         `json:"P"`
	Data     ExecutionData `json:"d"`
}

type ExecutionData struct {
	OrderID       string         `json:"oi"`
	Symbol        string         `json:"s"`
	Side          string         `json:"S"`
	OrderType     string         `json:"oT"`
	Price         string         `json:"p"`
	Quantity      string         `json:"q"`
	TradeID       FlexibleString `json:"ti"`
	ExecutionTime int64          `json:"E"`
	LiquidityRole string         `json:"lR"`
	Fee           string         `json:"f"`
	FeeCurrency   string         `json:"fC"`
	FillType      string         `json:"fT"`
	ClientOid     string         `json:"ci"`
}

type ExecutionEventCallback func(topic string, data *ExecutionEvent) error

type ExecutionLiteEvent struct {
	Topic    string            `json:"T"`
	Sequence int64             `json:"P"`
	Data     ExecutionLiteData `json:"d"`
}

type ExecutionLiteData struct {
	ExecutionTime int64          `json:"E"`
	Side          string         `json:"S"`
	Price         string         `json:"p"`
	Quantity      string         `json:"q"`
	Symbol        string         `json:"s"`
	LiquidityRole string         `json:"lR"`
	OrderType     string         `json:"oT"`
	OrderID       string         `json:"oi"`
	TradeID       FlexibleString `json:"ti"`
}

type ExecutionLiteEventCallback func(topic string, data *ExecutionLiteEvent) error

type OrderEvent struct {
	Topic    string    `json:"T"`
	Sequence int64     `json:"P"`
	Data     OrderData `json:"d"`
}

// OrderData is the complete UTA private order lifecycle update payload.
type OrderData struct {
	TradeType           string         `json:"tT"`
	OrderID             string         `json:"oi"`
	ClientOid           string         `json:"ci"`
	OrderStatus         int64          `json:"os"`
	EventType           string         `json:"eT"`
	Symbol              string         `json:"s"`
	Side                string         `json:"S"`
	OrderType           string         `json:"oT"`
	LiquidityRole       string         `json:"lR"`
	OrderSource         string         `json:"oS"`
	Price               string         `json:"p"`
	MarginMode          string         `json:"mM"`
	TradeID             FlexibleString `json:"ti"`
	Quantity            string         `json:"q"`
	QuantityUnit        string         `json:"qU"`
	FilledSize          string         `json:"fS"`
	LastFilledSize      string         `json:"lS"`
	LastFilledValue     string         `json:"ls"`
	AveragePrice        string         `json:"aP"`
	Fee                 string         `json:"f"`
	FeeCurrency         string         `json:"fC"`
	OrderTag            string         `json:"t"`
	CancelReason        string         `json:"cR"`
	CancelStatus        string         `json:"cS"`
	RemainingSize       string         `json:"rS"`
	TriggerDirection    string         `json:"tD"`
	TriggerPrice        string         `json:"tP"`
	TriggerPriceType    string         `json:"tPT"`
	TakeProfitPrice     string         `json:"pP"`
	TakeProfitPriceType string         `json:"pPT"`
	StopLossPrice       string         `json:"lP"`
	StopLossPriceType   string         `json:"lPT"`
	TriggerOrderID      string         `json:"toi"`
	SelfTradePrevention string         `json:"stp"`
	ReduceOnly          bool           `json:"rO"`
	TimeInForce         string         `json:"tIF"`
	PostOnly            bool           `json:"pO"`
	CreatedAt           int64          `json:"O"`
	UpdatedAt           int64          `json:"U"`
}

type OrderEventCallback func(topic string, data *OrderEvent) error

type BalanceEvent struct {
	Topic    string      `json:"T"`
	Sequence int64       `json:"P"`
	Data     BalanceData `json:"d"`
}

type BalanceData struct {
	UpdateTime   FlexibleString `json:"U"`
	Available    string         `json:"a"`
	Balance      string         `json:"b"`
	Currency     string         `json:"c"`
	Equity       string         `json:"e"`
	Hold         string         `json:"h"`
	Liability    string         `json:"l"`
	ChangeStatus string         `json:"cS"`
}

type BalanceEventCallback func(topic string, data *BalanceEvent) error

type PositionEvent struct {
	Topic    string       `json:"T"`
	Sequence int64        `json:"P"`
	Data     PositionData `json:"d"`
}

type PositionData struct {
	CreatedAt             int64  `json:"O"`
	UpdatedAt             int64  `json:"U"`
	Leverage              string `json:"l"`
	Quantity              string `json:"q"`
	Symbol                string `json:"s"`
	BankruptcyPrice       string `json:"bP"`
	EntryPrice            string `json:"eP"`
	InitialMargin         string `json:"iM"`
	LiquidationPrice      string `json:"lP"`
	MarginMode            string `json:"mM"`
	MarkPrice             string `json:"mP"`
	PositionValue         string `json:"pV"`
	PositionID            string `json:"pi"`
	MaintenanceMarginRate string `json:"mmr"`
	MaintenanceMargin     string `json:"mtM"`
	RealisedPnl           string `json:"rPL"`
	UnrealisedPnl         string `json:"uPL"`
	RiskLimitLevel        string `json:"r"`
	Adl                   string `json:"adl"`
}

type PositionEventCallback func(topic string, data *PositionEvent) error

type LeverageEvent struct {
	Topic    string       `json:"T"`
	Sequence int64        `json:"P"`
	Data     LeverageData `json:"d"`
}

type LeverageData struct {
	Symbol     string `json:"s"`
	Currency   string `json:"c"`
	Leverage   string `json:"l"`
	MarginMode string `json:"mM"`
	TradeType  string `json:"tT"`
}

type LeverageEventCallback func(topic string, data *LeverageEvent) error

type LiquidationWarningEvent struct {
	Topic    string                 `json:"T"`
	Sequence int64                  `json:"P"`
	Data     LiquidationWarningData `json:"d"`
}

type LiquidationWarningData struct {
	EventType         string `json:"eT"`
	RiskRatio         string `json:"r"`
	Assets            string `json:"a"`
	InitialMargin     string `json:"iM"`
	MaintenanceMargin string `json:"mM"`
	AvailableMargin   string `json:"aM"`
	Equity            string `json:"e"`
	Liabilities       string `json:"l"`
	UpdatedAt         int64  `json:"U"`
}

type LiquidationWarningEventCallback func(topic string, data *LiquidationWarningEvent) error

// UtaPrivateWS is the direct UTA private push API.
type UtaPrivateWS interface {
	Execution(callback ExecutionEventCallback) (id string, err error)
	ExecutionLite(tradeType ExecutionLiteTradeType, callback ExecutionLiteEventCallback) (id string, err error)
	OrderAll(callback OrderEventCallback) (id string, err error)
	Order(symbol string, callback OrderEventCallback) (id string, err error)
	Balance(accountType BalanceAccountType, callback BalanceEventCallback) (id string, err error)
	PositionAll(callback PositionEventCallback) (id string, err error)
	Position(symbol string, callback PositionEventCallback) (id string, err error)
	Leverage(callback LeverageEventCallback) (id string, err error)
	LiquidationWarning(callback LiquidationWarningEventCallback) (id string, err error)
	UnSubscribe(id string) error
	Start() error
	Stop() error
}

type UtaPrivateWSImpl struct {
	service   *infra.UtaPushWsService
	createErr error
}

func NewUtaPrivateWSImpl(option *types.ClientOption) *UtaPrivateWSImpl {
	service, err := infra.NewUtaPrivatePushWsService(option)
	return &UtaPrivateWSImpl{service: service, createErr: err}
}

func (impl *UtaPrivateWSImpl) Start() error {
	if impl.createErr != nil {
		return impl.createErr
	}
	return impl.service.Start()
}

func (impl *UtaPrivateWSImpl) Stop() error {
	if impl.service == nil {
		return nil
	}
	return impl.service.Stop()
}

func (impl *UtaPrivateWSImpl) UnSubscribe(id string) error {
	if err := impl.ready(); err != nil {
		return err
	}
	return impl.service.Unsubscribe(id)
}

func (impl *UtaPrivateWSImpl) Execution(callback ExecutionEventCallback) (string, error) {
	if callback == nil {
		return "", errors.New("execution callback must not be nil")
	}
	return impl.subscribe("execution", nil, "UNIFIED", "", true, func(payload []byte) error {
		var event ExecutionEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) ExecutionLite(tradeType ExecutionLiteTradeType, callback ExecutionLiteEventCallback) (string, error) {
	if !validExecutionLiteTradeType(tradeType) {
		return "", errors.New("execution.lite trade type must be SPOT, ISOLATED, CROSS, FUTURES, or UNIFIED")
	}
	if callback == nil {
		return "", errors.New("execution.lite callback must not be nil")
	}
	return impl.subscribe("execution.lite", nil, string(tradeType), "", true, func(payload []byte) error {
		var event ExecutionLiteEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) OrderAll(callback OrderEventCallback) (string, error) {
	if callback == nil {
		return "", errors.New("orderAll callback must not be nil")
	}
	return impl.subscribe("orderAll", nil, "UNIFIED", "", true, func(payload []byte) error {
		var event OrderEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) Order(symbol string, callback OrderEventCallback) (string, error) {
	if err := requirePrivateSymbol(symbol); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("order callback must not be nil")
	}
	return impl.subscribe("order", []string{symbol}, "UNIFIED", "", true, func(payload []byte) error {
		var event OrderEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) Balance(accountType BalanceAccountType, callback BalanceEventCallback) (string, error) {
	if accountType != BalanceAccountTypeUnified && accountType != BalanceAccountTypeFunding && accountType != BalanceAccountTypeIsolated {
		return "", errors.New("balance account type must be UNIFIED, FUNDING, or ISOLATED")
	}
	if callback == nil {
		return "", errors.New("balance callback must not be nil")
	}
	return impl.subscribe("balance", nil, "", string(accountType), false, func(payload []byte) error {
		var event BalanceEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) PositionAll(callback PositionEventCallback) (string, error) {
	if callback == nil {
		return "", errors.New("positionAll callback must not be nil")
	}
	return impl.subscribe("positionAll", nil, "UNIFIED", "", true, func(payload []byte) error {
		var event PositionEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) Position(symbol string, callback PositionEventCallback) (string, error) {
	if err := requirePrivateSymbol(symbol); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("position callback must not be nil")
	}
	return impl.subscribe("position", []string{symbol}, "UNIFIED", "", true, func(payload []byte) error {
		var event PositionEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) Leverage(callback LeverageEventCallback) (string, error) {
	if callback == nil {
		return "", errors.New("leverage callback must not be nil")
	}
	return impl.subscribe("leverage", nil, "UNIFIED", "", true, func(payload []byte) error {
		var event LeverageEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) LiquidationWarning(callback LiquidationWarningEventCallback) (string, error) {
	if callback == nil {
		return "", errors.New("liquidation warning callback must not be nil")
	}
	return impl.subscribe("lw", nil, "UNIFIED", "", true, func(payload []byte) error {
		var event LiquidationWarningEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPrivateWSImpl) subscribe(channel string, symbols []string, tradeType, accountType string, includeTradeType bool, callback func([]byte) error) (string, error) {
	if err := impl.ready(); err != nil {
		return "", err
	}
	return impl.service.Subscribe(infra.UtaPushSubscription{
		Channel:          channel,
		Symbols:          symbols,
		TradeType:        tradeType,
		AccountType:      accountType,
		IncludeTradeType: includeTradeType,
		Callback:         callback,
	})
}

func (impl *UtaPrivateWSImpl) ready() error {
	if impl.createErr != nil {
		return impl.createErr
	}
	if impl.service == nil {
		return errors.New("UTA private WebSocket service is unavailable")
	}
	return nil
}

func validExecutionLiteTradeType(tradeType ExecutionLiteTradeType) bool {
	switch tradeType {
	case ExecutionLiteTradeTypeSpot, ExecutionLiteTradeTypeIsolated, ExecutionLiteTradeTypeCross, ExecutionLiteTradeTypeFutures, ExecutionLiteTradeTypeUnified:
		return true
	default:
		return false
	}
}

func requirePrivateSymbol(symbol string) error {
	if strings.TrimSpace(symbol) == "" {
		return errors.New("symbol must not be blank")
	}
	return nil
}

// UtaWsRateLimit is the optional rate-limit block returned by direct trade operations.
type UtaWsRateLimit struct {
	Limit     int64 `json:"limit"`
	Remaining int64 `json:"remaining"`
	Reset     int64 `json:"reset"`
}

type UtaPlaceOrderWsResponse struct {
	Code          string               `json:"code"`
	Msg           string               `json:"msg"`
	ID            string               `json:"id"`
	Operation     string               `json:"op"`
	Data          order.PlaceOrderResp `json:"data"`
	InTime        int64                `json:"inTime"`
	OutTime       int64                `json:"outTime"`
	UserRateLimit *UtaWsRateLimit      `json:"userRateLimit,omitempty"`
}

type UtaCancelOrderWsResponse struct {
	Code          string                `json:"code"`
	Msg           string                `json:"msg"`
	ID            string                `json:"id"`
	Operation     string                `json:"op"`
	Data          order.CancelOrderResp `json:"data"`
	InTime        int64                 `json:"inTime"`
	OutTime       int64                 `json:"outTime"`
	UserRateLimit *UtaWsRateLimit       `json:"userRateLimit,omitempty"`
}

type UtaAmendOrderWsResponse struct {
	Code          string               `json:"code"`
	Msg           string               `json:"msg"`
	ID            string               `json:"id"`
	Operation     string               `json:"op"`
	Data          order.AmendOrderResp `json:"data"`
	InTime        int64                `json:"inTime"`
	OutTime       int64                `json:"outTime"`
	UserRateLimit *UtaWsRateLimit      `json:"userRateLimit,omitempty"`
}

// UtaPrivateTradeWS sends authenticated UTA order commands through WebSocket.
type UtaPrivateTradeWS interface {
	Start() error
	PlaceOrder(request *order.PlaceOrderReq) (*UtaPlaceOrderWsResponse, error)
	CancelOrder(request *order.CancelOrderReq) (*UtaCancelOrderWsResponse, error)
	AmendOrder(request *order.AmendOrderReq) (*UtaAmendOrderWsResponse, error)
	Stop() error
}

type UtaPrivateTradeWSImpl struct {
	service   *infra.UtaPrivateTradeWsService
	createErr error
}

func NewUtaPrivateTradeWSImpl(option *types.ClientOption) *UtaPrivateTradeWSImpl {
	service, err := infra.NewUtaPrivateTradeWsService(option)
	return &UtaPrivateTradeWSImpl{service: service, createErr: err}
}

func (impl *UtaPrivateTradeWSImpl) Start() error {
	if impl.createErr != nil {
		return impl.createErr
	}
	return impl.service.Start()
}

func (impl *UtaPrivateTradeWSImpl) Stop() error {
	if impl.service == nil {
		return nil
	}
	return impl.service.Stop()
}

func (impl *UtaPrivateTradeWSImpl) PlaceOrder(request *order.PlaceOrderReq) (*UtaPlaceOrderWsResponse, error) {
	if request == nil {
		return nil, errors.New("order request must not be nil")
	}
	payload, err := impl.call("uta.order", request)
	if err != nil {
		return nil, err
	}
	response := &UtaPlaceOrderWsResponse{}
	if err = json.Unmarshal(payload, response); err != nil {
		return nil, fmt.Errorf("decode uta.order response: %w", err)
	}
	return response, nil
}

func (impl *UtaPrivateTradeWSImpl) CancelOrder(request *order.CancelOrderReq) (*UtaCancelOrderWsResponse, error) {
	if request == nil {
		return nil, errors.New("cancel request must not be nil")
	}
	if strings.TrimSpace(request.OrderId) == "" && strings.TrimSpace(request.ClientOid) == "" {
		return nil, errors.New("either orderId or clientOid must be provided")
	}
	payload, err := impl.call("uta.cancel", request)
	if err != nil {
		return nil, err
	}
	response := &UtaCancelOrderWsResponse{}
	if err = json.Unmarshal(payload, response); err != nil {
		return nil, fmt.Errorf("decode uta.cancel response: %w", err)
	}
	return response, nil
}

func (impl *UtaPrivateTradeWSImpl) AmendOrder(request *order.AmendOrderReq) (*UtaAmendOrderWsResponse, error) {
	if request == nil {
		return nil, errors.New("amend request must not be nil")
	}
	if strings.TrimSpace(request.OrderId) == "" && strings.TrimSpace(request.ClientOid) == "" {
		return nil, errors.New("either orderId or clientOid must be provided")
	}
	payload, err := impl.call("uta.amend", request)
	if err != nil {
		return nil, err
	}
	response := &UtaAmendOrderWsResponse{}
	if err = json.Unmarshal(payload, response); err != nil {
		return nil, fmt.Errorf("decode uta.amend response: %w", err)
	}
	return response, nil
}

func (impl *UtaPrivateTradeWSImpl) call(operation string, request any) ([]byte, error) {
	if impl.createErr != nil {
		return nil, impl.createErr
	}
	if impl.service == nil {
		return nil, errors.New("UTA private trade WebSocket service is unavailable")
	}
	return impl.service.Call(operation, request)
}

var _ UtaPrivateWS = (*UtaPrivateWSImpl)(nil)
var _ UtaPrivateTradeWS = (*UtaPrivateTradeWSImpl)(nil)
