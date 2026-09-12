<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Account;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * UTA account REST APIs. Each operation accepts array|UtaRequest|null and returns UtaResponse.
 *
 * @method UtaResponse getInterestHistory($request = null)
 * @method UtaResponse getBorrowingRatesAndLimits($request = null)
 * @method UtaResponse getAccountMode()
 * @method UtaResponse setAccountMode($request)
 * @method UtaResponse getOESCustodyQuota($request = null)
 * @method UtaResponse setSubAccountTransferPermission($request)
 * @method UtaResponse getAccount()
 * @method UtaResponse getLeverage($request = null)
 * @method UtaResponse modifyMarginCrossLeverage($request)
 * @method UtaResponse modifyLeverage($request)
 * @method UtaResponse getAccountOverview()
 * @method UtaResponse getApikeyInfo()
 * @method UtaResponse addSubAccountApi($request)
 * @method UtaResponse getFeeRate($request = null)
 * @method UtaResponse modifySubAccountApi($request)
 * @method UtaResponse deleteSubAccountApi($request)
 * @method UtaResponse getSubAccountApiList($request = null)
 * @method UtaResponse addSubAccount($request)
 * @method UtaResponse getAccountLedger($request = null)
 * @method UtaResponse getClassicAccountBalance($request = null)
 * @method UtaResponse getDepositAddress($request = null)
 * @method UtaResponse getDepositHistory($request = null)
 * @method UtaResponse getSubAccountBalance($request = null)
 * @method UtaResponse getTransferQuota($request = null)
 * @method UtaResponse getWithdrawalQuotas($request = null)
 * @method UtaResponse getWithdrawalHistory($request = null)
 * @method UtaResponse getAllRateLimit()
 * @method UtaResponse getRateLimitCap()
 * @method UtaResponse getSubAccountList($request = null)
 * @method UtaResponse getRateLimit($request = null)
 * @method UtaResponse setRateLimit($request)
 * @method UtaResponse flexTransfer($request)
 * @method UtaResponse setKcsFeeDeduction($request = null)
 * @method UtaResponse cancelWithdrawal($request)
 * @method UtaResponse withdrawalV3($request)
 */
interface AccountApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
