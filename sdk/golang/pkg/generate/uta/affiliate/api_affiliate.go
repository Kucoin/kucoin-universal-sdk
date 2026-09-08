// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package affiliate

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type AffiliateAPI interface {
	GetInvited(req *GetInvitedReq, ctx context.Context) (*GetInvitedResp, error)
	GetKumining(req *GetKuminingReq, ctx context.Context) (*GetKuminingResp, error)
	GetCommission(req *GetCommissionReq, ctx context.Context) (*GetCommissionResp, error)
	GetTransaction(req *GetTransactionReq, ctx context.Context) (*GetTransactionResp, error)
	GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error)
}

type AffiliateAPIImpl struct {
	transport interfaces.Transport
}

func NewAffiliateAPIImp(transport interfaces.Transport) *AffiliateAPIImpl {
	return &AffiliateAPIImpl{transport: transport}
}

func (impl *AffiliateAPIImpl) GetInvited(req *GetInvitedReq, ctx context.Context) (*GetInvitedResp, error) {
	resp := &GetInvitedResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/affiliate/queryInvitees", req, resp, false)
	return resp, err
}

func (impl *AffiliateAPIImpl) GetKumining(req *GetKuminingReq, ctx context.Context) (*GetKuminingResp, error) {
	resp := &GetKuminingResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/affiliate/queryKumining", req, resp, false)
	return resp, err
}

func (impl *AffiliateAPIImpl) GetCommission(req *GetCommissionReq, ctx context.Context) (*GetCommissionResp, error) {
	resp := &GetCommissionResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/affiliate/queryMyCommission", req, resp, false)
	return resp, err
}

func (impl *AffiliateAPIImpl) GetTransaction(req *GetTransactionReq, ctx context.Context) (*GetTransactionResp, error) {
	resp := &GetTransactionResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/affiliate/queryTransactionByTime", req, resp, false)
	return resp, err
}

func (impl *AffiliateAPIImpl) GetTradeHistory(req *GetTradeHistoryReq, ctx context.Context) (*GetTradeHistoryResp, error) {
	resp := &GetTradeHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/affiliate/queryTransactionByUid", req, resp, false)
	return resp, err
}
