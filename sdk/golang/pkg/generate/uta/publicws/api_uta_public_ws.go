// Code generated from the UTA Public WebSocket schema; DO NOT EDIT.

// Package publicws provides direct UTA public push WebSocket APIs.
package publicws

import (
	"encoding/json"
	"errors"
	"strings"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/infra"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

// PushTradeType selects the UTA public push endpoint.
type PushTradeType string

const (
	PushTradeTypeSpot    PushTradeType = "SPOT"
	PushTradeTypeFutures PushTradeType = "FUTURES"
)

// KlineInterval is a UTA kline period.
type KlineInterval string

const (
	KlineInterval1Min   KlineInterval = "1min"
	KlineInterval3Min   KlineInterval = "3min"
	KlineInterval5Min   KlineInterval = "5min"
	KlineInterval15Min  KlineInterval = "15min"
	KlineInterval30Min  KlineInterval = "30min"
	KlineInterval1Hour  KlineInterval = "1hour"
	KlineInterval2Hour  KlineInterval = "2hour"
	KlineInterval4Hour  KlineInterval = "4hour"
	KlineInterval6Hour  KlineInterval = "6hour"
	KlineInterval8Hour  KlineInterval = "8hour"
	KlineInterval12Hour KlineInterval = "12hour"
	KlineInterval1Day   KlineInterval = "1day"
	KlineInterval1Week  KlineInterval = "1week"
	KlineInterval1Month KlineInterval = "1month"
)

// OrderbookDepth selects the UTA orderbook channel depth.
type OrderbookDepth string

const (
	OrderbookDepth1             OrderbookDepth = "1"
	OrderbookDepth5             OrderbookDepth = "5"
	OrderbookDepth50            OrderbookDepth = "50"
	OrderbookDepthIncrement     OrderbookDepth = "increment"
	OrderbookDepthIncrement10MS OrderbookDepth = "increment@10ms"
)

// OrderbookRpiFilter controls inclusion of RPI orders for supported Futures depth streams.
type OrderbookRpiFilter int

const (
	OrderbookRpiExcluded OrderbookRpiFilter = 0
	OrderbookRpiIncluded OrderbookRpiFilter = 1
)

// Event envelope types and their callback signatures.
type TickerEvent struct {
	Topic    string     `json:"T"`
	Sequence int64      `json:"P"`
	Data     TickerData `json:"d"`
}

type TickerData struct {
	BestAskPrice string `json:"a"`
	BestAskSize  string `json:"A"`
	BestBidPrice string `json:"b"`
	BestBidSize  string `json:"B"`
	LastPrice    string `json:"l"`
	LastSize     string `json:"q"`
	Symbol       string `json:"s"`
	Side         string `json:"S"`
	EventTime    int64  `json:"E"`
	MatchingTime int64  `json:"M"`
}

type TickerEventCallback func(topic string, data *TickerEvent) error

type KlineEvent struct {
	Topic    string    `json:"T"`
	Sequence int64     `json:"P"`
	Data     KlineData `json:"d"`
}

type KlineData struct {
	Open      string `json:"o"`
	Close     string `json:"c"`
	Low       string `json:"l"`
	High      string `json:"h"`
	Closed    bool   `json:"S"`
	Volume    string `json:"v"`
	Interval  string `json:"i"`
	Amount    string `json:"a"`
	CloseTime int64  `json:"C"`
	Symbol    string `json:"s"`
	OpenTime  int64  `json:"O"`
}

type KlineEventCallback func(topic string, data *KlineEvent) error

type TradeEvent struct {
	Topic    string    `json:"T"`
	Sequence int64     `json:"P"`
	Data     TradeData `json:"d"`
}

type TradeData struct {
	Price        string      `json:"p"`
	Quantity     string      `json:"q"`
	Symbol       string      `json:"s"`
	Side         string      `json:"S"`
	EventTime    int64       `json:"E"`
	MatchingTime int64       `json:"M"`
	TradeID      json.Number `json:"ti"`
	Rpi          bool        `json:"rpi"`
}

type TradeEventCallback func(topic string, data *TradeEvent) error

type OrderbookEvent struct {
	Topic      string        `json:"T"`
	UpdateType string        `json:"t"`
	Sequence   int64         `json:"P"`
	Depth      string        `json:"dp"`
	Data       OrderbookData `json:"d"`
}

type OrderbookData struct {
	SequenceEnd   int64      `json:"C"`
	SequenceStart int64      `json:"O"`
	MatchingTime  int64      `json:"M"`
	Asks          [][]string `json:"a"`
	Bids          [][]string `json:"b"`
	Symbol        string     `json:"s"`
}

type OrderbookEventCallback func(topic string, data *OrderbookEvent) error

type MarkPriceEvent struct {
	Topic    string        `json:"T"`
	Sequence int64         `json:"P"`
	Data     MarkPriceData `json:"d"`
}

type MarkPriceData struct {
	Symbol       string `json:"s"`
	MarkPrice    string `json:"mp"`
	IndexPrice   string `json:"ip"`
	OpenInterest string `json:"oi"`
	Timestamp    int64  `json:"ts"`
}

type MarkPriceEventCallback func(topic string, data *MarkPriceEvent) error

type FundingFeeEvent struct {
	Topic    string         `json:"T"`
	Sequence int64          `json:"P"`
	Data     FundingFeeData `json:"d"`
}

type FundingFeeData struct {
	Symbol          string `json:"s"`
	FundingRate     string `json:"fr"`
	FundingTime     int64  `json:"ft"`
	LastFundingRate string `json:"lfr"`
	NextFundingTime int64  `json:"nt"`
	FundingInterval int64  `json:"gl"`
	FundingCap      string `json:"fc"`
	FundingFloor    string `json:"ff"`
}

type FundingFeeEventCallback func(topic string, data *FundingFeeEvent) error

type FundingFeeAllSymbolsEvent struct {
	Topic    string           `json:"T"`
	Sequence int64            `json:"P"`
	Data     []FundingFeeData `json:"d"`
}

type FundingFeeAllSymbolsEventCallback func(topic string, data *FundingFeeAllSymbolsEvent) error

type CallAuctionInfoEvent struct {
	Topic      string              `json:"T"`
	UpdateType string              `json:"t"`
	Sequence   int64               `json:"P"`
	Data       CallAuctionInfoData `json:"d"`
}

// json.Number accepts both the numeric and quoted-decimal forms sent by this channel.
type CallAuctionInfoData struct {
	Symbol                  string      `json:"s"`
	SellOrderRangeLowPrice  json.Number `json:"slp"`
	BuyOrderRangeLowPrice   json.Number `json:"blp"`
	SellOrderRangeHighPrice json.Number `json:"shp"`
	BuyOrderRangeHighPrice  json.Number `json:"bhp"`
	EstimatedPrice          json.Number `json:"eq"`
	EstimatedSize           json.Number `json:"es"`
	Timestamp               int64       `json:"ts"`
}

type CallAuctionInfoEventCallback func(topic string, data *CallAuctionInfoEvent) error

// UtaPublicWS is the direct UTA public push API. A service instance is either SPOT or FUTURES.
type UtaPublicWS interface {
	Ticker(symbol string, callback TickerEventCallback) (id string, err error)
	Tickers(symbols []string, callback TickerEventCallback) (id string, err error)
	Kline(symbol string, interval KlineInterval, callback KlineEventCallback) (id string, err error)
	Trade(symbol string, callback TradeEventCallback) (id string, err error)
	Orderbook(symbol string, depth OrderbookDepth, callback OrderbookEventCallback) (id string, err error)
	OrderbookWithRpi(symbol string, depth OrderbookDepth, rpiFilter OrderbookRpiFilter, callback OrderbookEventCallback) (id string, err error)
	MarkPrice(symbol string, callback MarkPriceEventCallback) (id string, err error)
	FundingFee(symbol string, callback FundingFeeEventCallback) (id string, err error)
	FundingFees(symbols []string, callback FundingFeeEventCallback) (id string, err error)
	FundingFeeAllSymbols(callback FundingFeeAllSymbolsEventCallback) (id string, err error)
	CallAuctionInfo(symbol string, callback CallAuctionInfoEventCallback) (id string, err error)
	UnSubscribe(id string) error
	Start() error
	Stop() error
}

// UtaPublicWSImpl is a UtaPublicWS implementation.
type UtaPublicWSImpl struct {
	service   *infra.UtaPushWsService
	tradeType PushTradeType
	createErr error
}

// NewUtaPublicWSImpl creates a direct UTA public WebSocket API. Invalid trade types are reported by Start.
func NewUtaPublicWSImpl(option *types.WebSocketClientOption, tradeType PushTradeType) *UtaPublicWSImpl {
	service, err := infra.NewUtaPublicPushWsService(option, string(tradeType))
	return &UtaPublicWSImpl{service: service, tradeType: tradeType, createErr: err}
}

func (impl *UtaPublicWSImpl) Start() error {
	if impl.createErr != nil {
		return impl.createErr
	}
	return impl.service.Start()
}

func (impl *UtaPublicWSImpl) Stop() error {
	if impl.service == nil {
		return nil
	}
	return impl.service.Stop()
}

func (impl *UtaPublicWSImpl) UnSubscribe(id string) error {
	if err := impl.ready(); err != nil {
		return err
	}
	return impl.service.Unsubscribe(id)
}

func (impl *UtaPublicWSImpl) Ticker(symbol string, callback TickerEventCallback) (string, error) {
	return impl.Tickers([]string{symbol}, callback)
}

func (impl *UtaPublicWSImpl) Tickers(symbols []string, callback TickerEventCallback) (string, error) {
	if err := requireSymbols(symbols); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("ticker callback must not be nil")
	}
	return impl.subscribe("ticker", symbols, nil, true, func(payload []byte) error {
		var event TickerEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) Kline(symbol string, interval KlineInterval, callback KlineEventCallback) (string, error) {
	if err := requireSymbol(symbol); err != nil {
		return "", err
	}
	if interval == "" {
		return "", errors.New("kline interval must not be blank")
	}
	if impl.tradeType == PushTradeTypeFutures && interval == KlineInterval6Hour {
		return "", errors.New("6hour kline is not supported for FUTURES")
	}
	if callback == nil {
		return "", errors.New("kline callback must not be nil")
	}
	return impl.subscribe("kline", []string{symbol}, map[string]any{"interval": string(interval)}, true, func(payload []byte) error {
		var event KlineEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) Trade(symbol string, callback TradeEventCallback) (string, error) {
	if err := requireSymbol(symbol); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("trade callback must not be nil")
	}
	return impl.subscribe("trade", []string{symbol}, nil, true, func(payload []byte) error {
		var event TradeEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) Orderbook(symbol string, depth OrderbookDepth, callback OrderbookEventCallback) (string, error) {
	return impl.OrderbookWithRpi(symbol, depth, OrderbookRpiExcluded, callback)
}

func (impl *UtaPublicWSImpl) OrderbookWithRpi(symbol string, depth OrderbookDepth, rpiFilter OrderbookRpiFilter, callback OrderbookEventCallback) (string, error) {
	if err := requireSymbol(symbol); err != nil {
		return "", err
	}
	if depth == "" {
		return "", errors.New("orderbook depth must not be blank")
	}
	if rpiFilter != OrderbookRpiExcluded && rpiFilter != OrderbookRpiIncluded {
		return "", errors.New("orderbook RPI filter must be 0 or 1")
	}
	if rpiFilter == OrderbookRpiIncluded && (impl.tradeType != PushTradeTypeFutures || (depth != OrderbookDepth5 && depth != OrderbookDepth50)) {
		return "", errors.New("RPI orderbook data is supported only for FUTURES depth 5 or 50")
	}
	if callback == nil {
		return "", errors.New("orderbook callback must not be nil")
	}
	params := map[string]any{"depth": string(depth), "rpiFilter": int(rpiFilter)}
	return impl.subscribe("obu", []string{symbol}, params, true, func(payload []byte) error {
		var event OrderbookEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) MarkPrice(symbol string, callback MarkPriceEventCallback) (string, error) {
	if impl.tradeType != PushTradeTypeFutures {
		return "", errors.New("mark-price is available only for FUTURES")
	}
	if err := requireSymbol(symbol); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("mark-price callback must not be nil")
	}
	return impl.subscribe("mark-price", []string{symbol}, nil, false, func(payload []byte) error {
		var event MarkPriceEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) FundingFee(symbol string, callback FundingFeeEventCallback) (string, error) {
	return impl.FundingFees([]string{symbol}, callback)
}

func (impl *UtaPublicWSImpl) FundingFees(symbols []string, callback FundingFeeEventCallback) (string, error) {
	if impl.tradeType != PushTradeTypeFutures {
		return "", errors.New("funding-fee is available only for FUTURES")
	}
	if err := requireSymbols(symbols); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("funding-fee callback must not be nil")
	}
	return impl.subscribe("funding-fee", symbols, nil, false, func(payload []byte) error {
		var event FundingFeeEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) FundingFeeAllSymbols(callback FundingFeeAllSymbolsEventCallback) (string, error) {
	if impl.tradeType != PushTradeTypeFutures {
		return "", errors.New("funding-fee-all-symbols is available only for FUTURES")
	}
	if callback == nil {
		return "", errors.New("funding-fee-all-symbols callback must not be nil")
	}
	return impl.subscribe("funding-fee-all-symbols", nil, nil, false, func(payload []byte) error {
		var event FundingFeeAllSymbolsEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) CallAuctionInfo(symbol string, callback CallAuctionInfoEventCallback) (string, error) {
	if impl.tradeType != PushTradeTypeSpot {
		return "", errors.New("callAuctionInfo is available only for SPOT")
	}
	if err := requireSymbol(symbol); err != nil {
		return "", err
	}
	if callback == nil {
		return "", errors.New("callAuctionInfo callback must not be nil")
	}
	return impl.subscribe("callAuctionInfo", []string{symbol}, nil, false, func(payload []byte) error {
		var event CallAuctionInfoEvent
		if err := json.Unmarshal(payload, &event); err != nil {
			return err
		}
		return callback(event.Topic, &event)
	})
}

func (impl *UtaPublicWSImpl) subscribe(channel string, symbols []string, params map[string]any, includeTradeType bool, callback func([]byte) error) (string, error) {
	if err := impl.ready(); err != nil {
		return "", err
	}
	return impl.service.Subscribe(infra.UtaPushSubscription{
		Channel:          channel,
		Symbols:          symbols,
		Params:           params,
		IncludeTradeType: includeTradeType,
		Callback:         callback,
	})
}

func (impl *UtaPublicWSImpl) ready() error {
	if impl.createErr != nil {
		return impl.createErr
	}
	if impl.service == nil {
		return errors.New("UTA public WebSocket service is unavailable")
	}
	return nil
}

func requireSymbol(symbol string) error {
	if strings.TrimSpace(symbol) == "" {
		return errors.New("symbol must not be blank")
	}
	return nil
}

func requireSymbols(symbols []string) error {
	if len(symbols) == 0 {
		return errors.New("at least one symbol is required")
	}
	for _, symbol := range symbols {
		if err := requireSymbol(symbol); err != nil {
			return err
		}
	}
	return nil
}

var _ UtaPublicWS = (*UtaPublicWSImpl)(nil)
