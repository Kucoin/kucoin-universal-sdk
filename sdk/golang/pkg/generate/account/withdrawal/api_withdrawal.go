// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package withdrawal

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type WithdrawalAPI interface {

	// GetWithdrawalQuotas Get Withdrawal Quotas
	// Description: This interface can obtain the withdrawal quota information of this currency.
	// Documentation: https://www.kucoin.com/docs-new/api-3470143
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | GENERAL    |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 20         |
	// +-----------------------+------------+
	GetWithdrawalQuotas(req *GetWithdrawalQuotasReq, ctx context.Context) (*GetWithdrawalQuotasResp, error)

	// WithdrawalV3 Withdraw (V3)
	// Description: Use this interface to withdraw the specified currency.
	// Documentation: https://www.kucoin.com/docs-new/api-3470146
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | WITHDRAWAL |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 5          |
	// +-----------------------+------------+
	WithdrawalV3(req *WithdrawalV3Req, ctx context.Context) (*WithdrawalV3Resp, error)

	// CancelWithdrawal Cancel Withdrawal
	// Description: This interface can cancel the withdrawal. Only withdrawal requests with PROCESSING status can be canceled.
	// Documentation: https://www.kucoin.com/docs-new/api-3470144
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | WITHDRAWAL |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 20         |
	// +-----------------------+------------+
	CancelWithdrawal(req *CancelWithdrawalReq, ctx context.Context) (*CancelWithdrawalResp, error)

	// GetWithdrawalHistory Get Withdrawal History
	// Description: Request a withdrawal list via this endpoint. Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page.
	// Documentation: https://www.kucoin.com/docs-new/api-3470145
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | GENERAL    |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 20         |
	// +-----------------------+------------+
	GetWithdrawalHistory(req *GetWithdrawalHistoryReq, ctx context.Context) (*GetWithdrawalHistoryResp, error)

	// GetWithdrawalHistoryById Get Withdrawal History By ID
	// Description: Request a withdrawal history by id via this endpoint.
	// Documentation: https://www.kucoin.com/docs-new/api-3471890
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | GENERAL    |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 20         |
	// +-----------------------+------------+
	GetWithdrawalHistoryById(req *GetWithdrawalHistoryByIdReq, ctx context.Context) (*GetWithdrawalHistoryByIdResp, error)

	// GetWithdrawalHistoryOld Get Withdrawal History - Old
	// Description: Request a deposit list via this endpoint. Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page.
	// Documentation: https://www.kucoin.com/docs-new/api-3470308
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | GENERAL    |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 20         |
	// +-----------------------+------------+
	// Deprecated
	GetWithdrawalHistoryOld(req *GetWithdrawalHistoryOldReq, ctx context.Context) (*GetWithdrawalHistoryOldResp, error)

	// WithdrawalV1 Withdraw - V1
	// Description: Use this interface to withdraw the specified currency.
	// Documentation: https://www.kucoin.com/docs-new/api-3470310
	// +-----------------------+------------+
	// | Extra API Info        | Value      |
	// +-----------------------+------------+
	// | API-DOMAIN            | SPOT       |
	// | API-CHANNEL           | PRIVATE    |
	// | API-PERMISSION        | WITHDRAWAL |
	// | API-RATE-LIMIT-POOL   | MANAGEMENT |
	// | API-RATE-LIMIT-WEIGHT | 5          |
	// +-----------------------+------------+
	// Deprecated
	WithdrawalV1(req *WithdrawalV1Req, ctx context.Context) (*WithdrawalV1Resp, error)
}

type WithdrawalAPIImpl struct {
	transport interfaces.Transport
}

func NewWithdrawalAPIImp(transport interfaces.Transport) *WithdrawalAPIImpl {
	return &WithdrawalAPIImpl{transport: transport}
}

func (impl *WithdrawalAPIImpl) GetWithdrawalQuotas(req *GetWithdrawalQuotasReq, ctx context.Context) (*GetWithdrawalQuotasResp, error) {
	resp := &GetWithdrawalQuotasResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v1/withdrawals/quotas", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) WithdrawalV3(req *WithdrawalV3Req, ctx context.Context) (*WithdrawalV3Resp, error) {
	resp := &WithdrawalV3Resp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v3/withdrawals", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) CancelWithdrawal(req *CancelWithdrawalReq, ctx context.Context) (*CancelWithdrawalResp, error) {
	resp := &CancelWithdrawalResp{}
	err := impl.transport.Call(ctx, "spot", false, "Delete", "/api/v1/withdrawals/{withdrawalId}", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) GetWithdrawalHistory(req *GetWithdrawalHistoryReq, ctx context.Context) (*GetWithdrawalHistoryResp, error) {
	resp := &GetWithdrawalHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v1/withdrawals", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) GetWithdrawalHistoryById(req *GetWithdrawalHistoryByIdReq, ctx context.Context) (*GetWithdrawalHistoryByIdResp, error) {
	resp := &GetWithdrawalHistoryByIdResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v1/withdrawals/{withdrawalId}", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) GetWithdrawalHistoryOld(req *GetWithdrawalHistoryOldReq, ctx context.Context) (*GetWithdrawalHistoryOldResp, error) {
	resp := &GetWithdrawalHistoryOldResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/v1/hist-withdrawals", req, resp, false)
	return resp, err
}

func (impl *WithdrawalAPIImpl) WithdrawalV1(req *WithdrawalV1Req, ctx context.Context) (*WithdrawalV1Resp, error) {
	resp := &WithdrawalV1Resp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/v1/withdrawals", req, resp, false)
	return resp, err
}
