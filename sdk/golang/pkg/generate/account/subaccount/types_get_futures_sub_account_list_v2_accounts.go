// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package subaccount

// GetFuturesSubAccountListV2Accounts struct for GetFuturesSubAccountListV2Accounts
type GetFuturesSubAccountListV2Accounts struct {
	// Account name, main account is main
	AccountName      string  `json:"accountName,omitempty"`
	AccountEquity    float32 `json:"accountEquity,omitempty"`
	UnrealisedPNL    float32 `json:"unrealisedPNL,omitempty"`
	MarginBalance    float32 `json:"marginBalance,omitempty"`
	PositionMargin   float32 `json:"positionMargin,omitempty"`
	OrderMargin      float32 `json:"orderMargin,omitempty"`
	FrozenFunds      float32 `json:"frozenFunds,omitempty"`
	AvailableBalance float32 `json:"availableBalance,omitempty"`
	// currency
	Currency string `json:"currency,omitempty"`
}

// NewGetFuturesSubAccountListV2Accounts instantiates a new GetFuturesSubAccountListV2Accounts object
// This constructor will assign default values to properties that have it defined
func NewGetFuturesSubAccountListV2Accounts(accountName string, accountEquity float32, unrealisedPNL float32, marginBalance float32, positionMargin float32, orderMargin float32, frozenFunds float32, availableBalance float32, currency string) *GetFuturesSubAccountListV2Accounts {
	this := GetFuturesSubAccountListV2Accounts{}
	this.AccountName = accountName
	this.AccountEquity = accountEquity
	this.UnrealisedPNL = unrealisedPNL
	this.MarginBalance = marginBalance
	this.PositionMargin = positionMargin
	this.OrderMargin = orderMargin
	this.FrozenFunds = frozenFunds
	this.AvailableBalance = availableBalance
	this.Currency = currency
	return &this
}

// NewGetFuturesSubAccountListV2AccountsWithDefaults instantiates a new GetFuturesSubAccountListV2Accounts object
// This constructor will only assign default values to properties that have it defined,
func NewGetFuturesSubAccountListV2AccountsWithDefaults() *GetFuturesSubAccountListV2Accounts {
	this := GetFuturesSubAccountListV2Accounts{}
	return &this
}

func (o *GetFuturesSubAccountListV2Accounts) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["accountName"] = o.AccountName
	toSerialize["accountEquity"] = o.AccountEquity
	toSerialize["unrealisedPNL"] = o.UnrealisedPNL
	toSerialize["marginBalance"] = o.MarginBalance
	toSerialize["positionMargin"] = o.PositionMargin
	toSerialize["orderMargin"] = o.OrderMargin
	toSerialize["frozenFunds"] = o.FrozenFunds
	toSerialize["availableBalance"] = o.AvailableBalance
	toSerialize["currency"] = o.Currency
	return toSerialize
}
