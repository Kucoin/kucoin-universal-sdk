// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package subaccount

// GetSpotSubAccountDetailMainAccounts struct for GetSpotSubAccountDetailMainAccounts
type GetSpotSubAccountDetailMainAccounts struct {
	// Currency
	Currency *string `json:"currency,omitempty"`
	// Total funds in an account.
	Balance *string `json:"balance,omitempty"`
	// Funds available to withdraw or trade.
	Available *string `json:"available,omitempty"`
	// Funds on hold (not available for use).
	Holds *string `json:"holds,omitempty"`
	// Calculated on this currency.
	BaseCurrency *string `json:"baseCurrency,omitempty"`
	// The base currency price.
	BaseCurrencyPrice *string `json:"baseCurrencyPrice,omitempty"`
	// The base currency amount.
	BaseAmount *string `json:"baseAmount,omitempty"`
	Tag        *string `json:"tag,omitempty"`
}

// NewGetSpotSubAccountDetailMainAccounts instantiates a new GetSpotSubAccountDetailMainAccounts object
// This constructor will assign default values to properties that have it defined
func NewGetSpotSubAccountDetailMainAccounts() *GetSpotSubAccountDetailMainAccounts {
	this := GetSpotSubAccountDetailMainAccounts{}
	return &this
}

// NewGetSpotSubAccountDetailMainAccountsWithDefaults instantiates a new GetSpotSubAccountDetailMainAccounts object
// This constructor will only assign default values to properties that have it defined,
func NewGetSpotSubAccountDetailMainAccountsWithDefaults() *GetSpotSubAccountDetailMainAccounts {
	this := GetSpotSubAccountDetailMainAccounts{}
	return &this
}

func (o *GetSpotSubAccountDetailMainAccounts) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["balance"] = o.Balance
	toSerialize["available"] = o.Available
	toSerialize["holds"] = o.Holds
	toSerialize["baseCurrency"] = o.BaseCurrency
	toSerialize["baseCurrencyPrice"] = o.BaseCurrencyPrice
	toSerialize["baseAmount"] = o.BaseAmount
	toSerialize["tag"] = o.Tag
	return toSerialize
}
