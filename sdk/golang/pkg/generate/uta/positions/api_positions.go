// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package positions

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type PositionsAPI interface {
	GetPrivateFundingFeeHistory(req *GetPrivateFundingFeeHistoryReq, ctx context.Context) (*GetPrivateFundingFeeHistoryResp, error)
	GetPositionsHistory(req *GetPositionsHistoryReq, ctx context.Context) (*GetPositionsHistoryResp, error)
	GetMarginMode(req *GetMarginModeReq, ctx context.Context) (*GetMarginModeResp, error)
	GetPositionList(req *GetPositionListReq, ctx context.Context) (*GetPositionListResp, error)
	ModifyMarginMode(req *ModifyMarginModeReq, ctx context.Context) (*ModifyMarginModeResp, error)
	ModifyIsolatedFuturesMargin(req *ModifyIsolatedFuturesMarginReq, ctx context.Context) (*ModifyIsolatedFuturesMarginResp, error)
}

type PositionsAPIImpl struct {
	transport interfaces.Transport
}

func NewPositionsAPIImp(transport interfaces.Transport) *PositionsAPIImpl {
	return &PositionsAPIImpl{transport: transport}
}

func (impl *PositionsAPIImpl) GetPrivateFundingFeeHistory(req *GetPrivateFundingFeeHistoryReq, ctx context.Context) (*GetPrivateFundingFeeHistoryResp, error) {
	resp := &GetPrivateFundingFeeHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/position/funding-history", req, resp, false)
	return resp, err
}

func (impl *PositionsAPIImpl) GetPositionsHistory(req *GetPositionsHistoryReq, ctx context.Context) (*GetPositionsHistoryResp, error) {
	resp := &GetPositionsHistoryResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/position/history", req, resp, false)
	return resp, err
}

func (impl *PositionsAPIImpl) GetMarginMode(req *GetMarginModeReq, ctx context.Context) (*GetMarginModeResp, error) {
	resp := &GetMarginModeResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/position/margin-mode", req, resp, false)
	return resp, err
}

func (impl *PositionsAPIImpl) GetPositionList(req *GetPositionListReq, ctx context.Context) (*GetPositionListResp, error) {
	resp := &GetPositionListResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/unified/position/open-list", req, resp, false)
	return resp, err
}

func (impl *PositionsAPIImpl) ModifyMarginMode(req *ModifyMarginModeReq, ctx context.Context) (*ModifyMarginModeResp, error) {
	resp := &ModifyMarginModeResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/position/margin-mode", req, resp, false)
	return resp, err
}

func (impl *PositionsAPIImpl) ModifyIsolatedFuturesMargin(req *ModifyIsolatedFuturesMarginReq, ctx context.Context) (*ModifyIsolatedFuturesMarginResp, error) {
	resp := &ModifyIsolatedFuturesMarginResp{}
	err := impl.transport.Call(ctx, "spot", false, "Post", "/api/ua/v2/unified/position/modify-margin", req, resp, false)
	return resp, err
}
