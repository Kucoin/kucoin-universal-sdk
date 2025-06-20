// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package withdrawal

// WithdrawalV3Req struct for WithdrawalV3Req
type WithdrawalV3Req struct {
	// currency
	Currency string `json:"currency,omitempty"`
	// The chainId of currency, For a currency with multiple chains, it is recommended to specify the chain parameter instead of using the default chain; you can query the chainId through the response of the GET /api/v3/currencies/{currency} interface.
	Chain *string `json:"chain,omitempty"`
	// Withdrawal amount, a positive number which is a multiple of the amount precision
	Amount string `json:"amount,omitempty"`
	// Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to KuCoin, you need to fill in memo(tag). Be careful: If you do not fill in memo(tag), your deposit may not be available.
	Memo *string `json:"memo,omitempty"`
	// Internal withdrawal or not. Default: False
	IsInner *bool `json:"isInner,omitempty"`
	// Remark
	Remark *string `json:"remark,omitempty"`
	// Withdrawal fee deduction type: INTERNAL, EXTERNAL, or not specified  1. INTERNAL: Deduct the transaction fees from your withdrawal amount 2. EXTERNAL: Deduct the transaction fees from your main account 3. If you don't specify the feeDeductType parameter, when the balance in your main account is sufficient to support the withdrawal, the system will initially deduct the transaction fees from your main account. But if the balance in your main account is not sufficient to support the withdrawal, the system will deduct the fees from your withdrawal amount. For example: Suppose you are going to withdraw 1 BTC from the KuCoin platform (transaction fee: 0.0001BTC), if the balance in your main account is insufficient, the system will deduct the transaction fees from your withdrawal amount. In this case, you will be receiving 0.9999BTC.
	FeeDeductType *string `json:"feeDeductType,omitempty"`
	// Withdrawal address
	ToAddress string `json:"toAddress,omitempty"`
	// Withdrawal type, ADDRESS (withdrawal address), UID, MAIL (email), PHONE (mobile phone number). Note: If you withdraw by uid/mail/phone, there will be rate limits: 3 times/10 seconds, 50 times/24 hours (calculated on a rolling basis based on the first request time)
	WithdrawType string `json:"withdrawType,omitempty"`
}

// NewWithdrawalV3Req instantiates a new WithdrawalV3Req object
// This constructor will assign default values to properties that have it defined
func NewWithdrawalV3Req(currency string, amount string, toAddress string, withdrawType string) *WithdrawalV3Req {
	this := WithdrawalV3Req{}
	this.Currency = currency
	var chain string = "eth"
	this.Chain = &chain
	this.Amount = amount
	var isInner bool = false
	this.IsInner = &isInner
	this.ToAddress = toAddress
	this.WithdrawType = withdrawType
	return &this
}

// NewWithdrawalV3ReqWithDefaults instantiates a new WithdrawalV3Req object
// This constructor will only assign default values to properties that have it defined,
func NewWithdrawalV3ReqWithDefaults() *WithdrawalV3Req {
	this := WithdrawalV3Req{}
	var chain string = "eth"
	this.Chain = &chain
	var isInner bool = false
	this.IsInner = &isInner
	return &this
}

func (o *WithdrawalV3Req) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["currency"] = o.Currency
	toSerialize["chain"] = o.Chain
	toSerialize["amount"] = o.Amount
	toSerialize["memo"] = o.Memo
	toSerialize["isInner"] = o.IsInner
	toSerialize["remark"] = o.Remark
	toSerialize["feeDeductType"] = o.FeeDeductType
	toSerialize["toAddress"] = o.ToAddress
	toSerialize["withdrawType"] = o.WithdrawType
	return toSerialize
}

type WithdrawalV3ReqBuilder struct {
	obj *WithdrawalV3Req
}

func NewWithdrawalV3ReqBuilder() *WithdrawalV3ReqBuilder {
	return &WithdrawalV3ReqBuilder{obj: NewWithdrawalV3ReqWithDefaults()}
}

// currency
func (builder *WithdrawalV3ReqBuilder) SetCurrency(value string) *WithdrawalV3ReqBuilder {
	builder.obj.Currency = value
	return builder
}

// The chainId of currency, For a currency with multiple chains, it is recommended to specify the chain parameter instead of using the default chain; you can query the chainId through the response of the GET /api/v3/currencies/{currency} interface.
func (builder *WithdrawalV3ReqBuilder) SetChain(value string) *WithdrawalV3ReqBuilder {
	builder.obj.Chain = &value
	return builder
}

// Withdrawal amount, a positive number which is a multiple of the amount precision
func (builder *WithdrawalV3ReqBuilder) SetAmount(value string) *WithdrawalV3ReqBuilder {
	builder.obj.Amount = value
	return builder
}

// Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to KuCoin, you need to fill in memo(tag). Be careful: If you do not fill in memo(tag), your deposit may not be available.
func (builder *WithdrawalV3ReqBuilder) SetMemo(value string) *WithdrawalV3ReqBuilder {
	builder.obj.Memo = &value
	return builder
}

// Internal withdrawal or not. Default: False
func (builder *WithdrawalV3ReqBuilder) SetIsInner(value bool) *WithdrawalV3ReqBuilder {
	builder.obj.IsInner = &value
	return builder
}

// Remark
func (builder *WithdrawalV3ReqBuilder) SetRemark(value string) *WithdrawalV3ReqBuilder {
	builder.obj.Remark = &value
	return builder
}

// Withdrawal fee deduction type: INTERNAL, EXTERNAL, or not specified  1. INTERNAL: Deduct the transaction fees from your withdrawal amount 2. EXTERNAL: Deduct the transaction fees from your main account 3. If you don't specify the feeDeductType parameter, when the balance in your main account is sufficient to support the withdrawal, the system will initially deduct the transaction fees from your main account. But if the balance in your main account is not sufficient to support the withdrawal, the system will deduct the fees from your withdrawal amount. For example: Suppose you are going to withdraw 1 BTC from the KuCoin platform (transaction fee: 0.0001BTC), if the balance in your main account is insufficient, the system will deduct the transaction fees from your withdrawal amount. In this case, you will be receiving 0.9999BTC.
func (builder *WithdrawalV3ReqBuilder) SetFeeDeductType(value string) *WithdrawalV3ReqBuilder {
	builder.obj.FeeDeductType = &value
	return builder
}

// Withdrawal address
func (builder *WithdrawalV3ReqBuilder) SetToAddress(value string) *WithdrawalV3ReqBuilder {
	builder.obj.ToAddress = value
	return builder
}

// Withdrawal type, ADDRESS (withdrawal address), UID, MAIL (email), PHONE (mobile phone number). Note: If you withdraw by uid/mail/phone, there will be rate limits: 3 times/10 seconds, 50 times/24 hours (calculated on a rolling basis based on the first request time)
func (builder *WithdrawalV3ReqBuilder) SetWithdrawType(value string) *WithdrawalV3ReqBuilder {
	builder.obj.WithdrawType = value
	return builder
}

func (builder *WithdrawalV3ReqBuilder) Build() *WithdrawalV3Req {
	return builder.obj
}
