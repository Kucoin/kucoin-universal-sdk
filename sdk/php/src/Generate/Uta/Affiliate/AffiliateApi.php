<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Affiliate;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * @method UtaResponse getInvited($request = null)
 * @method UtaResponse getKumining($request = null)
 * @method UtaResponse getCommission($request = null)
 * @method UtaResponse getTransaction($request = null)
 * @method UtaResponse getTradeHistory($request = null)
 */
interface AffiliateApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
