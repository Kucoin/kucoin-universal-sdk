<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Positions;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * @method UtaResponse getPrivateFundingFeeHistory($request = null)
 * @method UtaResponse getPositionsHistory($request = null)
 * @method UtaResponse getMarginMode($request = null)
 * @method UtaResponse getPositionList($request = null)
 * @method UtaResponse modifyMarginMode($request)
 * @method UtaResponse modifyIsolatedFuturesMargin($request)
 */
interface PositionsApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
