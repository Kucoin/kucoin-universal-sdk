// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package credit

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type CreditAPI interface {

	// GetLoanMarket Get Loan Market
	// Description: This API endpoint is used to get the information about the currencies available for lending.
	// Documentation: https://www.kucoin.com/docs-new/api-3470212
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 10      |
	// +-----------------------+---------+
	GetLoanMarket(req *GetLoanMarketReq, ctx context.Context) (*GetLoanMarketResp, error)

	// GetLoanMarketInterestRate Get Loan Market Interest Rate
	// Description: This API endpoint is used to get the interest rates of the margin lending market over the past 7 days.
	// Documentation: https://www.kucoin.com/docs-new/api-3470215
	// +-----------------------+--------+
	// | Extra API Info        | Value  |
	// +-----------------------+--------+
	// | API-DOMAIN            | SPOT   |
	// | API-CHANNEL           | PUBLIC |
	// | API-PERMISSION        | NULL   |
	// | API-RATE-LIMIT-POOL   | PUBLIC |
	// | API-RATE-LIMIT-WEIGHT | 5      |
	// +-----------------------+--------+
	GetLoanMarketInterestRate(req *GetLoanMarketInterestRateReq, ctx context.Context) (*GetLoanMarketInterestRateResp, error)

	// Purchase Purchase
	// Description: Invest credit in the market and earn interest
	// Documentation: https://www.kucoin.com/docs-new/api-3470216
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 15      |
	// +-----------------------+---------+
	Purchase(req *PurchaseReq, ctx context.Context) (*PurchaseResp, error)

	// ModifyPurchase Modify Purchase
	// Description: This API endpoint is used to update the interest rates of subscription orders, which will take effect at the beginning of the next hour. Please ensure that the funds are in the main (funding) account.
	// Documentation: https://www.kucoin.com/docs-new/api-3470217
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 10      |
	// +-----------------------+---------+
	ModifyPurchase(req *ModifyPurchaseReq, ctx context.Context) (*ModifyPurchaseResp, error)

	// GetPurchaseOrders Get Purchase Orders
	// Description: This API endpoint provides a pagination query for the purchase orders.
	// Documentation: https://www.kucoin.com/docs-new/api-3470213
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 10      |
	// +-----------------------+---------+
	GetPurchaseOrders(req *GetPurchaseOrdersReq, ctx context.Context) (*GetPurchaseOrdersResp, error)

	// Redeem Redeem
	// Description: Redeem your loan order.
	// Documentation: https://www.kucoin.com/docs-new/api-3470218
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | MARGIN  |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 15      |
	// +-----------------------+---------+
	Redeem(req *RedeemReq, ctx context.Context) (*RedeemResp, error)

	// GetRedeemOrders Get Redeem Orders
	// Description: This API endpoint provides pagination query for the redeem orders.
	// Documentation: https://www.kucoin.com/docs-new/api-3470214
	// +-----------------------+---------+
	// | Extra API Info        | Value   |
	// +-----------------------+---------+
	// | API-DOMAIN            | SPOT    |
	// | API-CHANNEL           | PRIVATE |
	// | API-PERMISSION        | GENERAL |
	// | API-RATE-LIMIT-POOL   | SPOT    |
	// | API-RATE-LIMIT-WEIGHT | 10      |
	// +-----------------------+---------+
	GetRedeemOrders(req *GetRedeemOrdersReq, ctx context.Context) (*GetRedeemOrdersResp, error)
}

type CreditAPIImpl struct {
	transport interfaces.Transport
}

func NewCreditAPIImp(transport interfaces.Transport) *CreditAPIImpl {
	return &CreditAPIImpl{transport: transport}
}

func (impl *CreditAPIImpl) GetLoanMarket(req *GetLoanMarketReq, ctx context.Context) (*GetLoanMarketResp, error) {
	resp := &GetLoanMarketResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/project/list", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) GetLoanMarketInterestRate(req *GetLoanMarketInterestRateReq, ctx context.Context) (*GetLoanMarketInterestRateResp, error) {
	resp := &GetLoanMarketInterestRateResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/project/marketInterestRate", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) Purchase(req *PurchaseReq, ctx context.Context) (*PurchaseResp, error) {
	resp := &PurchaseResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/purchase", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) ModifyPurchase(req *ModifyPurchaseReq, ctx context.Context) (*ModifyPurchaseResp, error) {
	resp := &ModifyPurchaseResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/lend/purchase/update", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) GetPurchaseOrders(req *GetPurchaseOrdersReq, ctx context.Context) (*GetPurchaseOrdersResp, error) {
	resp := &GetPurchaseOrdersResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/purchase/orders", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) Redeem(req *RedeemReq, ctx context.Context) (*RedeemResp, error) {
	resp := &RedeemResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/redeem", req, resp, false)
	return resp, err
}

func (impl *CreditAPIImpl) GetRedeemOrders(req *GetRedeemOrdersReq, ctx context.Context) (*GetRedeemOrdersResp, error) {
	resp := &GetRedeemOrdersResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v3/redeem/orders", req, resp, false)
	return resp, err
}
