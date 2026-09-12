<?php

namespace KuCoin\UniversalSDK\Generate\Uta\VIPLending;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * @method UtaResponse getAccounts($request = null)
 * @method UtaResponse getDiscountRateConfigs($request = null)
 * @method UtaResponse getLoanInfo($request = null)
 */
interface VIPLendingApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
