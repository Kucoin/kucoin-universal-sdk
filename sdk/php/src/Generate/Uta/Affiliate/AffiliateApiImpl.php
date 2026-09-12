<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Affiliate;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class AffiliateApiImpl extends MappedUtaApi implements AffiliateApi
{
    protected const ENDPOINTS = [
        'getInvited' => ['GET', '/api/ua/v2/affiliate/queryInvitees'],
        'getKumining' => ['GET', '/api/ua/v2/affiliate/queryKumining'],
        'getCommission' => ['GET', '/api/ua/v2/affiliate/queryMyCommission'],
        'getTransaction' => ['GET', '/api/ua/v2/affiliate/queryTransactionByTime'],
        'getTradeHistory' => ['GET', '/api/ua/v2/affiliate/queryTransactionByUid'],
    ];
}
