// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package account

// GetCrossMarginAccountAccounts struct for GetCrossMarginAccountAccounts
type GetCrossMarginAccountAccounts struct {
	// currency
	Currency string `json:"currency,omitempty"`
	// Total Assets
	Total string `json:"total,omitempty"`
	// Account available assets (total assets - frozen)
	Available string `json:"available,omitempty"`
	// Account frozen assets
	Hold string `json:"hold,omitempty"`
	// Liabilities
	Liability string `json:"liability,omitempty"`
	// The user's remaining maximum loan amount
	MaxBorrowSize string `json:"maxBorrowSize,omitempty"`
	// Support borrow or not
	BorrowEnabled bool `json:"borrowEnabled,omitempty"`
	// Support transfer or not
	TransferInEnabled bool `json:"transferInEnabled,omitempty"`
	// Outstanding principal – the unpaid loan amount
	LiabilityPrincipal string `json:"liabilityPrincipal,omitempty"`
	// Accrued interest – the unpaid interest amount
	LiabilityInterest string `json:"liabilityInterest,omitempty"`
}

// NewGetCrossMarginAccountAccounts instantiates a new GetCrossMarginAccountAccounts object
// This constructor will assign default values to properties that have it defined
func NewGetCrossMarginAccountAccounts(currency string, total string, available string, hold string, liability string, maxBorrowSize string, borrowEnabled bool, transferInEnabled bool, liabilityPrincipal string, liabilityInterest string) *GetCrossMarginAccountAccounts {
	this := GetCrossMarginAccountAccounts{}
	this.Currency = currency
	this.Total = total
	this.Available = available
	this.Hold = hold
	this.Liability = liability
	this.MaxBorrowSize = maxBorrowSize
	this.BorrowEnabled = borrowEnabled
	this.TransferInEnabled = transferInEnabled
	this.LiabilityPrincipal = liabilityPrincipal
	this.LiabilityInterest = liabilityInterest
	return &this
}

// NewGetCrossMarginAccountAccountsWithDefaults instantiates a new GetCrossMarginAccountAccounts object
// This constructor will only assign default values to properties that have it defined,
func NewGetCrossMarginAccountAccountsWithDefaults() *GetCrossMarginAccountAccounts {
	this := GetCrossMarginAccountAccounts{}
	return &this
}

func (o *GetCrossMarginAccountAccounts) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["total"] = o.Total
	toSerialize["available"] = o.Available
	toSerialize["hold"] = o.Hold
	toSerialize["liability"] = o.Liability
	toSerialize["maxBorrowSize"] = o.MaxBorrowSize
	toSerialize["borrowEnabled"] = o.BorrowEnabled
	toSerialize["transferInEnabled"] = o.TransferInEnabled
	toSerialize["liabilityPrincipal"] = o.LiabilityPrincipal
	toSerialize["liabilityInterest"] = o.LiabilityInterest
	return toSerialize
}
