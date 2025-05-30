<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Fee;
use KuCoin\UniversalSDK\Internal\Interfaces\Transport;

class FeeApiImpl implements FeeApi
{
    private $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function getBasicFee(GetBasicFeeReq $req): GetBasicFeeResp
    {
        return $this->transport->call(
            "spot",
            false,
            "GET",
            "/api/v1/base-fee",
            $req,
            GetBasicFeeResp::class,
            false
        );
    }

    public function getSpotActualFee(
        GetSpotActualFeeReq $req
    ): GetSpotActualFeeResp {
        return $this->transport->call(
            "spot",
            false,
            "GET",
            "/api/v1/trade-fees",
            $req,
            GetSpotActualFeeResp::class,
            false
        );
    }

    public function getFuturesActualFee(
        GetFuturesActualFeeReq $req
    ): GetFuturesActualFeeResp {
        return $this->transport->call(
            "futures",
            false,
            "get",
            "/api/v1/trade-fees",
            $req,
            GetFuturesActualFeeResp::class,
            false
        );
    }
}
