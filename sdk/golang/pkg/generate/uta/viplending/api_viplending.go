// Code generated from the Java UTA SDK sources; DO NOT EDIT.

package viplending

import (
	"context"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/internal/interfaces"
)

type VIPLendingAPI interface {
	GetAccounts(req *GetAccountsReq, ctx context.Context) (*GetAccountsResp, error)
	GetDiscountRateConfigs(req *GetDiscountRateConfigsReq, ctx context.Context) (*GetDiscountRateConfigsResp, error)
	GetLoanInfo(req *GetLoanInfoReq, ctx context.Context) (*GetLoanInfoResp, error)
}

type VIPLendingAPIImpl struct {
	transport interfaces.Transport
}

func NewVIPLendingAPIImp(transport interfaces.Transport) *VIPLendingAPIImpl {
	return &VIPLendingAPIImpl{transport: transport}
}

func (impl *VIPLendingAPIImpl) GetAccounts(req *GetAccountsReq, ctx context.Context) (*GetAccountsResp, error) {
	resp := &GetAccountsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/otc-loan/account", req, resp, false)
	return resp, err
}

func (impl *VIPLendingAPIImpl) GetDiscountRateConfigs(req *GetDiscountRateConfigsReq, ctx context.Context) (*GetDiscountRateConfigsResp, error) {
	resp := &GetDiscountRateConfigsResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/otc-loan/discount-rate", req, resp, false)
	return resp, err
}

func (impl *VIPLendingAPIImpl) GetLoanInfo(req *GetLoanInfoReq, ctx context.Context) (*GetLoanInfoResp, error) {
	resp := &GetLoanInfoResp{}
	err := impl.transport.Call(ctx, "spot", false, "Get", "/api/ua/v2/otc-loan/loan", req, resp, false)
	return resp, err
}
