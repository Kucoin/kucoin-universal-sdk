// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package market

import (
	"encoding/json"

	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
)

func unmarshalFlexibleFloat64(data json.RawMessage, target *float64) error {
	if len(data) == 0 || string(data) == "null" {
		return nil
	}

	var value json.Number
	if err := json.Unmarshal(data, &value); err != nil {
		return err
	}

	parsed, err := value.Float64()
	if err != nil {
		return err
	}
	*target = parsed
	return nil
}

// GenericResultQueryUaInterestRateIndexResponse is ported from the Java UTA SDK model.
type GenericResultQueryUaInterestRateIndexResponse struct {
	Msg  string                           `json:"msg,omitempty" url:"msg,omitempty"`
	Code string                           `json:"code,omitempty" url:"code,omitempty"`
	Data QueryUaInterestRateIndexResponse `json:"data,omitempty" url:"data,omitempty"`
}

// GetAnnouncementsList is ported from the Java UTA SDK model.
type GetAnnouncementsList struct {
	Id          int64    `json:"id,omitempty" url:"id,omitempty"`
	Title       string   `json:"title,omitempty" url:"title,omitempty"`
	Type        []string `json:"type,omitempty" url:"type,omitempty"`
	Description string   `json:"description,omitempty" url:"description,omitempty"`
	ReleaseTime int64    `json:"releaseTime,omitempty" url:"releaseTime,omitempty"`
	Language    string   `json:"language,omitempty" url:"language,omitempty"`
	Url         string   `json:"url,omitempty" url:"url,omitempty"`
}

// GetAnnouncementsReq is ported from the Java UTA SDK model.
type GetAnnouncementsReq struct {
	Language   string `json:"language,omitempty" url:"language,omitempty"`
	Type       string `json:"type,omitempty" url:"type,omitempty"`
	PageNumber int64  `json:"pageNumber,omitempty" url:"pageNumber,omitempty"`
	PageSize   int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	StartTime  int64  `json:"startTime,omitempty" url:"startTime,omitempty"`
	EndTime    int64  `json:"endTime,omitempty" url:"endTime,omitempty"`
}

// GetAnnouncementsResp is ported from the Java UTA SDK model.
type GetAnnouncementsResp struct {
	CommonResponse *types.RestResponse    `json:"-"`
	TotalNumber    int64                  `json:"totalNumber,omitempty" url:"totalNumber,omitempty"`
	TotalPage      int64                  `json:"totalPage,omitempty" url:"totalPage,omitempty"`
	PageNumber     int64                  `json:"pageNumber,omitempty" url:"pageNumber,omitempty"`
	PageSize       int64                  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	List           []GetAnnouncementsList `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetAnnouncementsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetBorrowableCurrenciesData is ported from the Java UTA SDK model.
type GetBorrowableCurrenciesData struct {
	Currency string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetBorrowableCurrenciesResp is ported from the Java UTA SDK model.
type GetBorrowableCurrenciesResp struct {
	CommonResponse *types.RestResponse           `json:"-"`
	Data           []GetBorrowableCurrenciesData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetBorrowableCurrenciesResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetBorrowableCurrenciesResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetCallAuctionInfoReq is ported from the Java UTA SDK model.
type GetCallAuctionInfoReq struct {
	Symbol string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetCallAuctionInfoResp is ported from the Java UTA SDK model.
type GetCallAuctionInfoResp struct {
	CommonResponse          *types.RestResponse `json:"-"`
	Symbol                  string              `json:"symbol,omitempty" url:"symbol,omitempty"`
	EstimatedSize           string              `json:"estimatedSize,omitempty" url:"estimatedSize,omitempty"`
	EstimatedPrice          string              `json:"estimatedPrice,omitempty" url:"estimatedPrice,omitempty"`
	BuyOrderRangeLowPrice   string              `json:"buyOrderRangeLowPrice,omitempty" url:"buyOrderRangeLowPrice,omitempty"`
	BuyOrderRangeHighPrice  string              `json:"buyOrderRangeHighPrice,omitempty" url:"buyOrderRangeHighPrice,omitempty"`
	SellOrderRangeLowPrice  string              `json:"sellOrderRangeLowPrice,omitempty" url:"sellOrderRangeLowPrice,omitempty"`
	SellOrderRangeHighPrice string              `json:"sellOrderRangeHighPrice,omitempty" url:"sellOrderRangeHighPrice,omitempty"`
	Time                    int64               `json:"time,omitempty" url:"time,omitempty"`
}

func (o *GetCallAuctionInfoResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetClientIPAddressResp is ported from the Java UTA SDK model.
type GetClientIPAddressResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           string              `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetClientIPAddressResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data string, matching the Java @JsonCreator model.
func (o *GetClientIPAddressResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetCollateralRatioData is ported from the Java UTA SDK model.
type GetCollateralRatioData struct {
	Currency   string                             `json:"currency,omitempty" url:"currency,omitempty"`
	CdrConfigs []GetCollateralRatioDataCdrConfigs `json:"cdrConfigs,omitempty" url:"cdrConfigs,omitempty"`
}

// GetCollateralRatioDataCdrConfigs is ported from the Java UTA SDK model.
type GetCollateralRatioDataCdrConfigs struct {
	Tier      int64  `json:"tier,omitempty" url:"tier,omitempty"`
	Min       string `json:"min,omitempty" url:"min,omitempty"`
	Max       string `json:"max,omitempty" url:"max,omitempty"`
	Cdr       string `json:"cdr,omitempty" url:"cdr,omitempty"`
	CdrEquity string `json:"cdrEquity,omitempty" url:"cdrEquity,omitempty"`
}

// GetCollateralRatioResp is ported from the Java UTA SDK model.
type GetCollateralRatioResp struct {
	CommonResponse *types.RestResponse      `json:"-"`
	Data           []GetCollateralRatioData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetCollateralRatioResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetCollateralRatioResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetCurrenciesData is ported from the Java UTA SDK model.
type GetCurrenciesData struct {
	Currency  string                  `json:"currency,omitempty" url:"currency,omitempty"`
	Name      string                  `json:"name,omitempty" url:"name,omitempty"`
	FullName  string                  `json:"fullName,omitempty" url:"fullName,omitempty"`
	Precision int64                   `json:"precision,omitempty" url:"precision,omitempty"`
	List      []GetCurrenciesDataList `json:"list,omitempty" url:"list,omitempty"`
}

// GetCurrenciesDataList is ported from the Java UTA SDK model.
type GetCurrenciesDataList struct {
	Chain             string `json:"chain,omitempty" url:"chain,omitempty"`
	ChainName         string `json:"chainName,omitempty" url:"chainName,omitempty"`
	IsDepositEnabled  bool   `json:"isDepositEnabled,omitempty" url:"isDepositEnabled,omitempty"`
	IsWithdrawEnabled bool   `json:"isWithdrawEnabled,omitempty" url:"isWithdrawEnabled,omitempty"`
	IsMemoRequired    bool   `json:"isMemoRequired,omitempty" url:"isMemoRequired,omitempty"`
	PreConfirms       int64  `json:"preConfirms,omitempty" url:"preConfirms,omitempty"`
	AddressRegex      string `json:"addressRegex,omitempty" url:"addressRegex,omitempty"`
	MemoRegex         string `json:"memoRegex,omitempty" url:"memoRegex,omitempty"`
	DepositFeeRate    string `json:"depositFeeRate,omitempty" url:"depositFeeRate,omitempty"`
	DepositTierFee    string `json:"depositTierFee,omitempty" url:"depositTierFee,omitempty"`
	FixedDepositFee   string `json:"fixedDepositFee,omitempty" url:"fixedDepositFee,omitempty"`
	MaxDepositFee     string `json:"maxDepositFee,omitempty" url:"maxDepositFee,omitempty"`
	MinDepositSize    string `json:"minDepositSize,omitempty" url:"minDepositSize,omitempty"`
	MaxDepositSize    string `json:"maxDepositSize,omitempty" url:"maxDepositSize,omitempty"`
	WithdrawFeeRate   string `json:"withdrawFeeRate,omitempty" url:"withdrawFeeRate,omitempty"`
	WithdrawPrecision int64  `json:"withdrawPrecision,omitempty" url:"withdrawPrecision,omitempty"`
	MinWithdrawSize   string `json:"minWithdrawSize,omitempty" url:"minWithdrawSize,omitempty"`
	MaxWithdrawSize   string `json:"maxWithdrawSize,omitempty" url:"maxWithdrawSize,omitempty"`
	MinWithdrawFee    string `json:"minWithdrawFee,omitempty" url:"minWithdrawFee,omitempty"`
	MaxWithdrawFee    string `json:"maxWithdrawFee,omitempty" url:"maxWithdrawFee,omitempty"`
}

// GetCurrenciesReq is ported from the Java UTA SDK model.
type GetCurrenciesReq struct {
	Chain        string   `json:"chain,omitempty" url:"chain,omitempty"`
	CurrencyList []string `json:"currencyList,omitempty" url:"currencyList,omitempty"`
}

// GetCurrenciesResp is ported from the Java UTA SDK model.
type GetCurrenciesResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           []GetCurrenciesData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetCurrenciesResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetCurrenciesResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetCurrencyList is ported from the Java UTA SDK model.
type GetCurrencyList struct {
	Chain             string `json:"chain,omitempty" url:"chain,omitempty"`
	ChainName         string `json:"chainName,omitempty" url:"chainName,omitempty"`
	IsDepositEnabled  bool   `json:"isDepositEnabled,omitempty" url:"isDepositEnabled,omitempty"`
	IsWithdrawEnabled bool   `json:"isWithdrawEnabled,omitempty" url:"isWithdrawEnabled,omitempty"`
	IsMemoRequired    bool   `json:"isMemoRequired,omitempty" url:"isMemoRequired,omitempty"`
	Confirms          int64  `json:"confirms,omitempty" url:"confirms,omitempty"`
	PreConfirms       int64  `json:"preConfirms,omitempty" url:"preConfirms,omitempty"`
	AddressRegex      string `json:"addressRegex,omitempty" url:"addressRegex,omitempty"`
	MemoRegex         string `json:"memoRegex,omitempty" url:"memoRegex,omitempty"`
	ContractAddress   string `json:"contractAddress,omitempty" url:"contractAddress,omitempty"`
	DepositFeeRate    string `json:"depositFeeRate,omitempty" url:"depositFeeRate,omitempty"`
	DepositTierFee    string `json:"depositTierFee,omitempty" url:"depositTierFee,omitempty"`
	FixedDepositFee   string `json:"fixedDepositFee,omitempty" url:"fixedDepositFee,omitempty"`
	MaxDepositFee     string `json:"maxDepositFee,omitempty" url:"maxDepositFee,omitempty"`
	MinDepositSize    string `json:"minDepositSize,omitempty" url:"minDepositSize,omitempty"`
	MaxDepositSize    string `json:"maxDepositSize,omitempty" url:"maxDepositSize,omitempty"`
	WithdrawFeeRate   string `json:"withdrawFeeRate,omitempty" url:"withdrawFeeRate,omitempty"`
	WithdrawPrecision int64  `json:"withdrawPrecision,omitempty" url:"withdrawPrecision,omitempty"`
	MinWithdrawSize   string `json:"minWithdrawSize,omitempty" url:"minWithdrawSize,omitempty"`
	MaxWithdrawSize   string `json:"maxWithdrawSize,omitempty" url:"maxWithdrawSize,omitempty"`
	MinWithdrawFee    string `json:"minWithdrawFee,omitempty" url:"minWithdrawFee,omitempty"`
	MaxWithdrawFee    string `json:"maxWithdrawFee,omitempty" url:"maxWithdrawFee,omitempty"`
}

// GetCurrencyReq is ported from the Java UTA SDK model.
type GetCurrencyReq struct {
	Chain    string `json:"chain,omitempty" url:"chain,omitempty"`
	Currency string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetCurrencyResp is ported from the Java UTA SDK model.
type GetCurrencyResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Currency       string              `json:"currency,omitempty" url:"currency,omitempty"`
	Name           string              `json:"name,omitempty" url:"name,omitempty"`
	FullName       string              `json:"fullName,omitempty" url:"fullName,omitempty"`
	Precision      int64               `json:"precision,omitempty" url:"precision,omitempty"`
	List           []GetCurrencyList   `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetCurrencyResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetCurrentFundingRatesData is ported from the Java UTA SDK model.
type GetCurrentFundingRatesData struct {
	Symbol                  string `json:"symbol,omitempty" url:"symbol,omitempty"`
	FundingTime             int64  `json:"fundingTime,omitempty" url:"fundingTime,omitempty"`
	FundingRateCap          string `json:"fundingRateCap,omitempty" url:"fundingRateCap,omitempty"`
	NewGranularity          int64  `json:"newGranularity,omitempty" url:"newGranularity,omitempty"`
	NextFundingRate         string `json:"nextFundingRate,omitempty" url:"nextFundingRate,omitempty"`
	FundingRateFloor        string `json:"fundingRateFloor,omitempty" url:"fundingRateFloor,omitempty"`
	CurrentGranularity      int64  `json:"currentGranularity,omitempty" url:"currentGranularity,omitempty"`
	NewGranularityStartTime int64  `json:"newGranularityStartTime,omitempty" url:"newGranularityStartTime,omitempty"`
}

// GetCurrentFundingRatesReq is ported from the Java UTA SDK model.
type GetCurrentFundingRatesReq struct {
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
	ProductType string `json:"productType,omitempty" url:"productType,omitempty"`
}

// GetCurrentFundingRatesResp is ported from the Java UTA SDK model.
type GetCurrentFundingRatesResp struct {
	CommonResponse *types.RestResponse          `json:"-"`
	Data           []GetCurrentFundingRatesData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetCurrentFundingRatesResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetCurrentFundingRatesResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetFiatPriceReq is ported from the Java UTA SDK model.
type GetFiatPriceReq struct {
	Base       string   `json:"base,omitempty" url:"base,omitempty"`
	Currencies []string `json:"currencies,omitempty" url:"currencies,omitempty"`
}

// GetFiatPriceResp is ported from the Java UTA SDK model.
type GetFiatPriceResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	BTC            string              `json:"BTC,omitempty" url:"BTC,omitempty"`
	ETH            string              `json:"ETH,omitempty" url:"ETH,omitempty"`
	USDT           string              `json:"USDT,omitempty" url:"USDT,omitempty"`
}

func (o *GetFiatPriceResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetHistoryFundingRateList is ported from the Java UTA SDK model.
type GetHistoryFundingRateList struct {
	FundingRate float64 `json:"fundingRate,omitempty" url:"fundingRate,omitempty"`
	Ts          int64   `json:"ts,omitempty" url:"ts,omitempty"`
}

// UnmarshalJSON accepts both JSON numbers and numeric strings, as Jackson does for Double.
func (o *GetHistoryFundingRateList) UnmarshalJSON(data []byte) error {
	type alias GetHistoryFundingRateList
	var wire struct {
		*alias
		FundingRate json.RawMessage `json:"fundingRate"`
	}
	wire.alias = (*alias)(o)
	if err := json.Unmarshal(data, &wire); err != nil {
		return err
	}
	return unmarshalFlexibleFloat64(wire.FundingRate, &o.FundingRate)
}

// GetHistoryFundingRateReq is ported from the Java UTA SDK model.
type GetHistoryFundingRateReq struct {
	Symbol  string `json:"symbol,omitempty" url:"symbol,omitempty"`
	StartAt int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt   int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
}

// GetHistoryFundingRateResp is ported from the Java UTA SDK model.
type GetHistoryFundingRateResp struct {
	CommonResponse *types.RestResponse         `json:"-"`
	Symbol         string                      `json:"symbol,omitempty" url:"symbol,omitempty"`
	List           []GetHistoryFundingRateList `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetHistoryFundingRateResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetIndexPriceItems is ported from the Java UTA SDK model.
type GetIndexPriceItems struct {
	Symbol            string                                `json:"symbol,omitempty" url:"symbol,omitempty"`
	Granularity       int64                                 `json:"granularity,omitempty" url:"granularity,omitempty"`
	Ts                int64                                 `json:"ts,omitempty" url:"ts,omitempty"`
	IndexPrice        float64                               `json:"indexPrice,omitempty" url:"indexPrice,omitempty"`
	DecompositionList []GetIndexPriceItemsDecompositionList `json:"decompositionList,omitempty" url:"decompositionList,omitempty"`
}

// UnmarshalJSON accepts both JSON numbers and numeric strings, as Jackson does for Double.
func (o *GetIndexPriceItems) UnmarshalJSON(data []byte) error {
	type alias GetIndexPriceItems
	var wire struct {
		*alias
		IndexPrice json.RawMessage `json:"indexPrice"`
	}
	wire.alias = (*alias)(o)
	if err := json.Unmarshal(data, &wire); err != nil {
		return err
	}
	return unmarshalFlexibleFloat64(wire.IndexPrice, &o.IndexPrice)
}

// GetIndexPriceItemsDecompositionList is ported from the Java UTA SDK model.
type GetIndexPriceItemsDecompositionList struct {
	Exchange string  `json:"exchange,omitempty" url:"exchange,omitempty"`
	Price    float64 `json:"price,omitempty" url:"price,omitempty"`
	Weight   float64 `json:"weight,omitempty" url:"weight,omitempty"`
}

// UnmarshalJSON accepts both JSON numbers and numeric strings, as Jackson does for Double.
func (o *GetIndexPriceItemsDecompositionList) UnmarshalJSON(data []byte) error {
	type alias GetIndexPriceItemsDecompositionList
	var wire struct {
		*alias
		Price  json.RawMessage `json:"price"`
		Weight json.RawMessage `json:"weight"`
	}
	wire.alias = (*alias)(o)
	if err := json.Unmarshal(data, &wire); err != nil {
		return err
	}
	if err := unmarshalFlexibleFloat64(wire.Price, &o.Price); err != nil {
		return err
	}
	return unmarshalFlexibleFloat64(wire.Weight, &o.Weight)
}

// GetIndexPriceReq is ported from the Java UTA SDK model.
type GetIndexPriceReq struct {
	Symbol   string `json:"symbol,omitempty" url:"symbol,omitempty"`
	StartAt  int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt    int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	PageSize int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
	LastId   int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// GetIndexPriceResp is ported from the Java UTA SDK model.
type GetIndexPriceResp struct {
	CommonResponse *types.RestResponse  `json:"-"`
	Items          []GetIndexPriceItems `json:"items,omitempty" url:"items,omitempty"`
	LastId         int64                `json:"lastId,omitempty" url:"lastId,omitempty"`
}

func (o *GetIndexPriceResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetInterestRateIndexItems is ported from the Java UTA SDK model.
type GetInterestRateIndexItems struct {
	Ts           int64  `json:"ts,omitempty" url:"ts,omitempty"`
	Symbol       string `json:"symbol,omitempty" url:"symbol,omitempty"`
	InterestRate string `json:"interestRate,omitempty" url:"interestRate,omitempty"`
}

// GetInterestRateIndexReq is ported from the Java UTA SDK model.
type GetInterestRateIndexReq struct {
	Symbol   string `json:"symbol,omitempty" url:"symbol,omitempty"`
	StartAt  int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt    int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
	LastId   int64  `json:"lastId,omitempty" url:"lastId,omitempty"`
	PageSize int64  `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetInterestRateIndexResp is ported from the Java UTA SDK model.
type GetInterestRateIndexResp struct {
	CommonResponse *types.RestResponse         `json:"-"`
	Items          []GetInterestRateIndexItems `json:"items,omitempty" url:"items,omitempty"`
	LastId         int64                       `json:"lastId,omitempty" url:"lastId,omitempty"`
}

func (o *GetInterestRateIndexResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetKYCRegionsData is ported from the Java UTA SDK model.
type GetKYCRegionsData struct {
	Code   string `json:"code,omitempty" url:"code,omitempty"`
	EnName string `json:"enName,omitempty" url:"enName,omitempty"`
}

// GetKYCRegionsResp is ported from the Java UTA SDK model.
type GetKYCRegionsResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Data           []GetKYCRegionsData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetKYCRegionsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetKYCRegionsResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetKlinesReq is ported from the Java UTA SDK model.
type GetKlinesReq struct {
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	KlineType string `json:"klineType,omitempty" url:"klineType,omitempty"`
	Interval  string `json:"interval,omitempty" url:"interval,omitempty"`
	StartAt   int64  `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt     int64  `json:"endAt,omitempty" url:"endAt,omitempty"`
}

// GetKlinesResp is ported from the Java UTA SDK model.
type GetKlinesResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol         string              `json:"symbol,omitempty" url:"symbol,omitempty"`
	List           [][]string          `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetKlinesResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts numeric timestamp cells in the API's kline rows.
// Jackson coerces these values to String in the Java List<List<String>> model;
// preserve the same public Go representation.
func (o *GetKlinesResp) UnmarshalJSON(data []byte) error {
	var wire struct {
		TradeType string              `json:"tradeType"`
		Symbol    string              `json:"symbol"`
		List      [][]json.RawMessage `json:"list"`
	}
	if err := json.Unmarshal(data, &wire); err != nil {
		return err
	}

	o.TradeType = wire.TradeType
	o.Symbol = wire.Symbol
	o.List = make([][]string, len(wire.List))
	for i, row := range wire.List {
		o.List[i] = make([]string, len(row))
		for j, value := range row {
			if string(value) == "null" {
				continue
			}
			if err := json.Unmarshal(value, &o.List[i][j]); err != nil {
				o.List[i][j] = string(value)
			}
		}
	}
	return nil
}

// GetMaxOrderQuantityReq is ported from the Java UTA SDK model.
type GetMaxOrderQuantityReq struct {
	Price     float64 `json:"price,omitempty" url:"price,omitempty"`
	Symbol    string  `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType string  `json:"tradeType,omitempty" url:"tradeType,omitempty"`
}

// GetMaxOrderQuantityResp is ported from the Java UTA SDK model.
type GetMaxOrderQuantityResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	Symbol         string              `json:"symbol,omitempty" url:"symbol,omitempty"`
	MaxBuySize     string              `json:"maxBuySize,omitempty" url:"maxBuySize,omitempty"`
	MaxSellSize    string              `json:"maxSellSize,omitempty" url:"maxSellSize,omitempty"`
}

func (o *GetMaxOrderQuantityResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetOEScurrencyData is ported from the Java UTA SDK model.
type GetOEScurrencyData struct {
	Custodian string `json:"custodian,omitempty" url:"custodian,omitempty"`
	Currency  string `json:"currency,omitempty" url:"currency,omitempty"`
	Precision int64  `json:"precision,omitempty" url:"precision,omitempty"`
}

// GetOEScurrencyReq is ported from the Java UTA SDK model.
type GetOEScurrencyReq struct {
	Custodian string `json:"custodian,omitempty" url:"custodian,omitempty"`
	Currency  string `json:"currency,omitempty" url:"currency,omitempty"`
}

// GetOEScurrencyResp is ported from the Java UTA SDK model.
type GetOEScurrencyResp struct {
	CommonResponse *types.RestResponse  `json:"-"`
	Data           []GetOEScurrencyData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetOEScurrencyResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetOEScurrencyResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetOpenInterestData is ported from the Java UTA SDK model.
type GetOpenInterestData struct {
	OpenInterest string `json:"openInterest,omitempty" url:"openInterest,omitempty"`
	Ts           int64  `json:"ts,omitempty" url:"ts,omitempty"`
}

// GetOpenInterestReq is ported from the Java UTA SDK model.
type GetOpenInterestReq struct {
	Symbol   []string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Interval string   `json:"interval,omitempty" url:"interval,omitempty"`
	StartAt  int64    `json:"startAt,omitempty" url:"startAt,omitempty"`
	EndAt    int64    `json:"endAt,omitempty" url:"endAt,omitempty"`
	PageSize int64    `json:"pageSize,omitempty" url:"pageSize,omitempty"`
}

// GetOpenInterestResp is ported from the Java UTA SDK model.
type GetOpenInterestResp struct {
	CommonResponse *types.RestResponse   `json:"-"`
	Data           []GetOpenInterestData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetOpenInterestResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetOpenInterestResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetOrderBookReq is ported from the Java UTA SDK model.
type GetOrderBookReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Limit     string `json:"limit,omitempty" url:"limit,omitempty"`
	RpiFilter string `json:"rpiFilter,omitempty" url:"rpiFilter,omitempty"`
}

// GetOrderBookResp is ported from the Java UTA SDK model.
type GetOrderBookResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol         string              `json:"symbol,omitempty" url:"symbol,omitempty"`
	Sequence       int64               `json:"sequence,omitempty" url:"sequence,omitempty"`
	Bids           [][]string          `json:"bids,omitempty" url:"bids,omitempty"`
	Asks           [][]string          `json:"asks,omitempty" url:"asks,omitempty"`
}

func (o *GetOrderBookResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetPositionTiersData is ported from the Java UTA SDK model.
type GetPositionTiersData struct {
	Currency           string `json:"currency,omitempty" url:"currency,omitempty"`
	Symbol             string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Tier               int64  `json:"tier,omitempty" url:"tier,omitempty"`
	MinSize            string `json:"minSize,omitempty" url:"minSize,omitempty"`
	MaxSize            string `json:"maxSize,omitempty" url:"maxSize,omitempty"`
	MaxLeverage        string `json:"maxLeverage,omitempty" url:"maxLeverage,omitempty"`
	MaintainMarginRate string `json:"maintainMarginRate,omitempty" url:"maintainMarginRate,omitempty"`
	QuickCalOffset     string `json:"quickCalOffset,omitempty" url:"quickCalOffset,omitempty"`
}

// GetPositionTiersReq is ported from the Java UTA SDK model.
type GetPositionTiersReq struct {
	TradeType   string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Currency    string `json:"currency,omitempty" url:"currency,omitempty"`
	MarginMode  string `json:"marginMode,omitempty" url:"marginMode,omitempty"`
	Data        string `json:"data,omitempty" url:"data,omitempty"`
	AccountType string `json:"accountType,omitempty" url:"accountType,omitempty"`
	Symbol      string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetPositionTiersResp is ported from the Java UTA SDK model.
type GetPositionTiersResp struct {
	CommonResponse *types.RestResponse    `json:"-"`
	Data           []GetPositionTiersData `json:"data,omitempty" url:"data,omitempty"`
}

func (o *GetPositionTiersResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// UnmarshalJSON accepts the API's direct data array, matching the Java @JsonCreator model.
func (o *GetPositionTiersResp) UnmarshalJSON(data []byte) error {
	return json.Unmarshal(data, &o.Data)
}

// GetServiceStatusReq is ported from the Java UTA SDK model.
type GetServiceStatusReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
}

// GetServiceStatusResp is ported from the Java UTA SDK model.
type GetServiceStatusResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	ServerStatus   string              `json:"serverStatus,omitempty" url:"serverStatus,omitempty"`
	Msg            string              `json:"msg,omitempty" url:"msg,omitempty"`
}

func (o *GetServiceStatusResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetSymbolList is ported from the Java UTA SDK model.
type GetSymbolList struct {
	Symbol                          string   `json:"symbol,omitempty" url:"symbol,omitempty"`
	Name                            string   `json:"name,omitempty" url:"name,omitempty"`
	BaseCurrency                    string   `json:"baseCurrency,omitempty" url:"baseCurrency,omitempty"`
	QuoteCurrency                   string   `json:"quoteCurrency,omitempty" url:"quoteCurrency,omitempty"`
	Market                          string   `json:"market,omitempty" url:"market,omitempty"`
	FeeCurrency                     string   `json:"feeCurrency,omitempty" url:"feeCurrency,omitempty"`
	TradingStatus                   string   `json:"tradingStatus,omitempty" url:"tradingStatus,omitempty"`
	PriceLimitRatio                 string   `json:"priceLimitRatio,omitempty" url:"priceLimitRatio,omitempty"`
	FeeCategory                     string   `json:"feeCategory,omitempty" url:"feeCategory,omitempty"`
	MakerFeeCoefficient             string   `json:"makerFeeCoefficient,omitempty" url:"makerFeeCoefficient,omitempty"`
	TakerFeeCoefficient             string   `json:"takerFeeCoefficient,omitempty" url:"takerFeeCoefficient,omitempty"`
	St                              bool     `json:"st,omitempty" url:"st,omitempty"`
	MinBaseOrderSize                string   `json:"minBaseOrderSize,omitempty" url:"minBaseOrderSize,omitempty"`
	MaxBaseOrderSize                string   `json:"maxBaseOrderSize,omitempty" url:"maxBaseOrderSize,omitempty"`
	BaseOrderStep                   string   `json:"baseOrderStep,omitempty" url:"baseOrderStep,omitempty"`
	MinQuoteOrderSize               string   `json:"minQuoteOrderSize,omitempty" url:"minQuoteOrderSize,omitempty"`
	MaxQuoteOrderSize               string   `json:"maxQuoteOrderSize,omitempty" url:"maxQuoteOrderSize,omitempty"`
	QuoteOrderStep                  string   `json:"quoteOrderStep,omitempty" url:"quoteOrderStep,omitempty"`
	TickSize                        string   `json:"tickSize,omitempty" url:"tickSize,omitempty"`
	MinFunds                        string   `json:"minFunds,omitempty" url:"minFunds,omitempty"`
	CallauctionIsEnabled            bool     `json:"callauctionIsEnabled,omitempty" url:"callauctionIsEnabled,omitempty"`
	CallauctionPriceFloor           string   `json:"callauctionPriceFloor,omitempty" url:"callauctionPriceFloor,omitempty"`
	CallauctionPriceCeiling         string   `json:"callauctionPriceCeiling,omitempty" url:"callauctionPriceCeiling,omitempty"`
	CallauctionFirstStageStartTime  string   `json:"callauctionFirstStageStartTime,omitempty" url:"callauctionFirstStageStartTime,omitempty"`
	CallauctionSecondStageStartTime string   `json:"callauctionSecondStageStartTime,omitempty" url:"callauctionSecondStageStartTime,omitempty"`
	CallauctionThirdStageStartTime  string   `json:"callauctionThirdStageStartTime,omitempty" url:"callauctionThirdStageStartTime,omitempty"`
	TradingStartTime                int64    `json:"tradingStartTime,omitempty" url:"tradingStartTime,omitempty"`
	MaxLeverage                     string   `json:"maxLeverage,omitempty" url:"maxLeverage,omitempty"`
	BuyLimit                        string   `json:"buyLimit,omitempty" url:"buyLimit,omitempty"`
	DisplayBaseCurrency             string   `json:"displayBaseCurrency,omitempty" url:"displayBaseCurrency,omitempty"`
	ExpiryTime                      string   `json:"expiryTime,omitempty" url:"expiryTime,omitempty"`
	IsInverse                       bool     `json:"isInverse,omitempty" url:"isInverse,omitempty"`
	LotSize                         string   `json:"lotSize,omitempty" url:"lotSize,omitempty"`
	MaxMarketOrderSize              string   `json:"maxMarketOrderSize,omitempty" url:"maxMarketOrderSize,omitempty"`
	MakerFeeRate                    string   `json:"makerFeeRate,omitempty" url:"makerFeeRate,omitempty"`
	MarketStage                     string   `json:"marketStage,omitempty" url:"marketStage,omitempty"`
	MarketType                      string   `json:"marketType,omitempty" url:"marketType,omitempty"`
	MaxPrice                        string   `json:"maxPrice,omitempty" url:"maxPrice,omitempty"`
	PreMarketToPerpDate             string   `json:"preMarketToPerpDate,omitempty" url:"preMarketToPerpDate,omitempty"`
	UnitSize                        string   `json:"unitSize,omitempty" url:"unitSize,omitempty"`
	IndexSourceExchanges            []string `json:"indexSourceExchanges,omitempty" url:"indexSourceExchanges,omitempty"`
	TakerFeeRate                    string   `json:"takerFeeRate,omitempty" url:"takerFeeRate,omitempty"`
	SettlementFeeRate               string   `json:"settlementFeeRate,omitempty" url:"settlementFeeRate,omitempty"`
	SettlementTime                  string   `json:"settlementTime,omitempty" url:"settlementTime,omitempty"`
	SettlementCurrency              string   `json:"settlementCurrency,omitempty" url:"settlementCurrency,omitempty"`
	SellLimit                       string   `json:"sellLimit,omitempty" url:"sellLimit,omitempty"`
	IndexPriceTickSize              string   `json:"indexPriceTickSize,omitempty" url:"indexPriceTickSize,omitempty"`
	ContractType                    string   `json:"contractType,omitempty" url:"contractType,omitempty"`
}

// GetSymbolReq is ported from the Java UTA SDK model.
type GetSymbolReq struct {
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
}

// GetSymbolResp is ported from the Java UTA SDK model.
type GetSymbolResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	List           []GetSymbolList     `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetSymbolResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTickerList is ported from the Java UTA SDK model.
type GetTickerList struct {
	Symbol             string `json:"symbol,omitempty" url:"symbol,omitempty"`
	Name               string `json:"name,omitempty" url:"name,omitempty"`
	BestBidPrice       string `json:"bestBidPrice,omitempty" url:"bestBidPrice,omitempty"`
	BestBidSize        string `json:"bestBidSize,omitempty" url:"bestBidSize,omitempty"`
	BestAskPrice       string `json:"bestAskPrice,omitempty" url:"bestAskPrice,omitempty"`
	BestAskSize        string `json:"bestAskSize,omitempty" url:"bestAskSize,omitempty"`
	LastPrice          string `json:"lastPrice,omitempty" url:"lastPrice,omitempty"`
	Size               string `json:"size,omitempty" url:"size,omitempty"`
	Open               string `json:"open,omitempty" url:"open,omitempty"`
	High               string `json:"high,omitempty" url:"high,omitempty"`
	Low                string `json:"low,omitempty" url:"low,omitempty"`
	BaseVolume         string `json:"baseVolume,omitempty" url:"baseVolume,omitempty"`
	QuoteVolume        string `json:"quoteVolume,omitempty" url:"quoteVolume,omitempty"`
	PriceChange        string `json:"priceChange,omitempty" url:"priceChange,omitempty"`
	PriceChangePercent string `json:"priceChangePercent,omitempty" url:"priceChangePercent,omitempty"`
	IndexPrice         string `json:"indexPrice,omitempty" url:"indexPrice,omitempty"`
	MarkPrice          string `json:"markPrice,omitempty" url:"markPrice,omitempty"`
}

// GetTickerReq is ported from the Java UTA SDK model.
type GetTickerReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetTickerResp is ported from the Java UTA SDK model.
type GetTickerResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Ts             int64               `json:"ts,omitempty" url:"ts,omitempty"`
	List           []GetTickerList     `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetTickerResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTradeList is ported from the Java UTA SDK model.
type GetTradeList struct {
	Sequence   int64  `json:"sequence,omitempty" url:"sequence,omitempty"`
	TradeId    string `json:"tradeId,omitempty" url:"tradeId,omitempty"`
	Price      string `json:"price,omitempty" url:"price,omitempty"`
	Size       string `json:"size,omitempty" url:"size,omitempty"`
	Side       string `json:"side,omitempty" url:"side,omitempty"`
	Ts         int64  `json:"ts,omitempty" url:"ts,omitempty"`
	IsRpiTrade bool   `json:"isRpiTrade,omitempty" url:"isRpiTrade,omitempty"`
}

// GetTradeReq is ported from the Java UTA SDK model.
type GetTradeReq struct {
	TradeType string `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	Symbol    string `json:"symbol,omitempty" url:"symbol,omitempty"`
}

// GetTradeResp is ported from the Java UTA SDK model.
type GetTradeResp struct {
	CommonResponse *types.RestResponse `json:"-"`
	TradeType      string              `json:"tradeType,omitempty" url:"tradeType,omitempty"`
	List           []GetTradeList      `json:"list,omitempty" url:"list,omitempty"`
}

func (o *GetTradeResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTradeStatisticsFutures is ported from the Java UTA SDK model.
type GetTradeStatisticsFutures struct {
	TurnoverOf24h string `json:"turnoverOf24h,omitempty" url:"turnoverOf24h,omitempty"`
}

// GetTradeStatisticsResp is ported from the Java UTA SDK model.
type GetTradeStatisticsResp struct {
	CommonResponse *types.RestResponse       `json:"-"`
	Spot           GetTradeStatisticsSpot    `json:"spot,omitempty" url:"spot,omitempty"`
	Futures        GetTradeStatisticsFutures `json:"futures,omitempty" url:"futures,omitempty"`
}

func (o *GetTradeStatisticsResp) SetCommonResponse(response *types.RestResponse) {
	o.CommonResponse = response
}

// GetTradeStatisticsSpot is ported from the Java UTA SDK model.
type GetTradeStatisticsSpot struct {
	TurnoverOf24h string `json:"turnoverOf24h,omitempty" url:"turnoverOf24h,omitempty"`
}

// QueryUaInterestRateIndexResponse is ported from the Java UTA SDK model.
type QueryUaInterestRateIndexResponse struct {
	Items  []UaInterestRateIndex `json:"items,omitempty" url:"items,omitempty"`
	LastId int64                 `json:"lastId,omitempty" url:"lastId,omitempty"`
}

// UaInterestRateIndex is ported from the Java UTA SDK model.
type UaInterestRateIndex struct {
	Ts           int64  `json:"ts,omitempty" url:"ts,omitempty"`
	Symbol       string `json:"symbol,omitempty" url:"symbol,omitempty"`
	InterestRate string `json:"interestRate,omitempty" url:"interestRate,omitempty"`
}
