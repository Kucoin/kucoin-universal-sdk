// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package deposit

// GetDepositAddressV2Data struct for GetDepositAddressV2Data
type GetDepositAddressV2Data struct {
	// Deposit address
	Address *string `json:"address,omitempty"`
	// Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to KuCoin, you need to fill in memo(tag). Be careful: If you do not fill in memo(tag), your deposit may not be available.
	Memo *string `json:"memo,omitempty"`
	// The chainName of currency
	Chain *string `json:"chain,omitempty"`
	// The chainId of currency
	ChainId *string `json:"chainId,omitempty"`
	// Deposit account type: main (funding account), trade (spot trading account)
	To *string `json:"to,omitempty"`
	// currency
	Currency *string `json:"currency,omitempty"`
	// The token contract address.
	ContractAddress *string `json:"contractAddress,omitempty"`
}

// NewGetDepositAddressV2Data instantiates a new GetDepositAddressV2Data object
// This constructor will assign default values to properties that have it defined
func NewGetDepositAddressV2Data() *GetDepositAddressV2Data {
	this := GetDepositAddressV2Data{}
	return &this
}

// NewGetDepositAddressV2DataWithDefaults instantiates a new GetDepositAddressV2Data object
// This constructor will only assign default values to properties that have it defined,
func NewGetDepositAddressV2DataWithDefaults() *GetDepositAddressV2Data {
	this := GetDepositAddressV2Data{}
	return &this
}

func (o *GetDepositAddressV2Data) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["address"] = o.Address
	toSerialize["memo"] = o.Memo
	toSerialize["chain"] = o.Chain
	toSerialize["chainId"] = o.ChainId
	toSerialize["to"] = o.To
	toSerialize["currency"] = o.Currency
	toSerialize["contractAddress"] = o.ContractAddress
	return toSerialize
}
