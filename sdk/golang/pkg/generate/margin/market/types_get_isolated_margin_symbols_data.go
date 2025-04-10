// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package market

// GetIsolatedMarginSymbolsData struct for GetIsolatedMarginSymbolsData
type GetIsolatedMarginSymbolsData struct {
	// symbol
	Symbol string `json:"symbol,omitempty"`
	// Symbol name
	SymbolName string `json:"symbolName,omitempty"`
	// Base currency, e.g. BTC.
	BaseCurrency string `json:"baseCurrency,omitempty"`
	// Quote currency, e.g. USDT.
	QuoteCurrency string `json:"quoteCurrency,omitempty"`
	// Max. leverage of this symbol
	MaxLeverage            int32  `json:"maxLeverage,omitempty"`
	FlDebtRatio            string `json:"flDebtRatio,omitempty"`
	TradeEnable            bool   `json:"tradeEnable,omitempty"`
	AutoRenewMaxDebtRatio  string `json:"autoRenewMaxDebtRatio,omitempty"`
	BaseBorrowEnable       bool   `json:"baseBorrowEnable,omitempty"`
	QuoteBorrowEnable      bool   `json:"quoteBorrowEnable,omitempty"`
	BaseTransferInEnable   bool   `json:"baseTransferInEnable,omitempty"`
	QuoteTransferInEnable  bool   `json:"quoteTransferInEnable,omitempty"`
	BaseBorrowCoefficient  string `json:"baseBorrowCoefficient,omitempty"`
	QuoteBorrowCoefficient string `json:"quoteBorrowCoefficient,omitempty"`
}

// NewGetIsolatedMarginSymbolsData instantiates a new GetIsolatedMarginSymbolsData object
// This constructor will assign default values to properties that have it defined
func NewGetIsolatedMarginSymbolsData(symbol string, symbolName string, baseCurrency string, quoteCurrency string, maxLeverage int32, flDebtRatio string, tradeEnable bool, autoRenewMaxDebtRatio string, baseBorrowEnable bool, quoteBorrowEnable bool, baseTransferInEnable bool, quoteTransferInEnable bool, baseBorrowCoefficient string, quoteBorrowCoefficient string) *GetIsolatedMarginSymbolsData {
	this := GetIsolatedMarginSymbolsData{}
	this.Symbol = symbol
	this.SymbolName = symbolName
	this.BaseCurrency = baseCurrency
	this.QuoteCurrency = quoteCurrency
	this.MaxLeverage = maxLeverage
	this.FlDebtRatio = flDebtRatio
	this.TradeEnable = tradeEnable
	this.AutoRenewMaxDebtRatio = autoRenewMaxDebtRatio
	this.BaseBorrowEnable = baseBorrowEnable
	this.QuoteBorrowEnable = quoteBorrowEnable
	this.BaseTransferInEnable = baseTransferInEnable
	this.QuoteTransferInEnable = quoteTransferInEnable
	this.BaseBorrowCoefficient = baseBorrowCoefficient
	this.QuoteBorrowCoefficient = quoteBorrowCoefficient
	return &this
}

// NewGetIsolatedMarginSymbolsDataWithDefaults instantiates a new GetIsolatedMarginSymbolsData object
// This constructor will only assign default values to properties that have it defined,
func NewGetIsolatedMarginSymbolsDataWithDefaults() *GetIsolatedMarginSymbolsData {
	this := GetIsolatedMarginSymbolsData{}
	return &this
}

func (o *GetIsolatedMarginSymbolsData) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["symbol"] = o.Symbol
	toSerialize["symbolName"] = o.SymbolName
	toSerialize["baseCurrency"] = o.BaseCurrency
	toSerialize["quoteCurrency"] = o.QuoteCurrency
	toSerialize["maxLeverage"] = o.MaxLeverage
	toSerialize["flDebtRatio"] = o.FlDebtRatio
	toSerialize["tradeEnable"] = o.TradeEnable
	toSerialize["autoRenewMaxDebtRatio"] = o.AutoRenewMaxDebtRatio
	toSerialize["baseBorrowEnable"] = o.BaseBorrowEnable
	toSerialize["quoteBorrowEnable"] = o.QuoteBorrowEnable
	toSerialize["baseTransferInEnable"] = o.BaseTransferInEnable
	toSerialize["quoteTransferInEnable"] = o.QuoteTransferInEnable
	toSerialize["baseBorrowCoefficient"] = o.BaseBorrowCoefficient
	toSerialize["quoteBorrowCoefficient"] = o.QuoteBorrowCoefficient
	return toSerialize
}
