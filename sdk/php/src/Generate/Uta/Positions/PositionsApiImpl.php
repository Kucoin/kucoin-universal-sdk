<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Positions;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class PositionsApiImpl extends MappedUtaApi implements PositionsApi
{
    protected const ENDPOINTS = [
        'getPrivateFundingFeeHistory' => ['GET', '/api/ua/v2/position/funding-history'],
        'getPositionsHistory' => ['GET', '/api/ua/v2/position/history'],
        'getMarginMode' => ['GET', '/api/ua/v2/unified/position/margin-mode'],
        'getPositionList' => ['GET', '/api/ua/v2/unified/position/open-list'],
        'modifyMarginMode' => ['POST', '/api/ua/v2/unified/position/margin-mode'],
        'modifyIsolatedFuturesMargin' => ['POST', '/api/ua/v2/unified/position/modify-margin'],
    ];
}
