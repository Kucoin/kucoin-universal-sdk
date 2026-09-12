<?php

namespace KuCoin\UniversalSDK\Generate\Uta\VIPLending;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class VIPLendingApiImpl extends MappedUtaApi implements VIPLendingApi
{
    protected const ENDPOINTS = [
        'getAccounts' => ['GET', '/api/ua/v2/otc-loan/account'],
        'getDiscountRateConfigs' => ['GET', '/api/ua/v2/otc-loan/discount-rate'],
        'getLoanInfo' => ['GET', '/api/ua/v2/otc-loan/loan'],
    ];
}
