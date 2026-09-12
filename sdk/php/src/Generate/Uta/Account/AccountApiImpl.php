<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Account;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class AccountApiImpl extends MappedUtaApi implements AccountApi
{
    protected const ENDPOINTS = [
        'getInterestHistory' => ['GET', '/api/ua/v2/account/interest-history'],
        'getBorrowingRatesAndLimits' => ['GET', '/api/ua/v2/account/interest-limits'],
        'getAccountMode' => ['GET', '/api/ua/v2/account/mode'],
        'setAccountMode' => ['POST', '/api/ua/v2/account/mode'],
        'getOESCustodyQuota' => ['GET', '/api/ua/v2/oes/custody-quota'],
        'setSubAccountTransferPermission' => ['POST', '/api/ua/v2/sub-account/canTransferOut'],
        'getAccount' => ['GET', '/api/ua/v2/unified/account/balance'],
        'getLeverage' => ['GET', '/api/ua/v2/unified/account/leverage'],
        'modifyMarginCrossLeverage' => ['POST', '/api/ua/v2/unified/account/modify-leverage-margin-cross'],
        'modifyLeverage' => ['POST', '/api/ua/v2/unified/account/modify-leverage'],
        'getAccountOverview' => ['GET', '/api/ua/v2/unified/account/overview'],
        'getApikeyInfo' => ['GET', '/api/ua/v2/user/api-key'],
        'addSubAccountApi' => ['POST', '/api/ua/v2/user/create-sub-api-key'],
        'getFeeRate' => ['GET', '/api/ua/v2/user/fee-rate'],
        'modifySubAccountApi' => ['POST', '/api/ua/v2/user/modify-sub-api-key'],
        'deleteSubAccountApi' => ['DELETE', '/api/ua/v2/user/sub-api-key'],
        'getSubAccountApiList' => ['GET', '/api/ua/v2/user/sub-api-key'],
        'addSubAccount' => ['POST', '/api/ua/v2/user/sub/create-sub-account'],
        'getAccountLedger' => ['GET', '/api/ua/v2/account/ledger'],
        'getClassicAccountBalance' => ['GET', '/api/ua/v2/account/balance'],
        'getDepositAddress' => ['GET', '/api/ua/v2/asset/deposit/address'],
        'getDepositHistory' => ['GET', '/api/ua/v2/asset/deposit/history'],
        'getSubAccountBalance' => ['GET', '/api/ua/v2/sub-account/balance'],
        'getTransferQuota' => ['GET', '/api/ua/v2/account/transfer-quota'],
        'getWithdrawalQuotas' => ['GET', '/api/ua/v2/withdrawals/quotas'],
        'getWithdrawalHistory' => ['GET', '/api/ua/v2/asset/withdrawal/history'],
        'getAllRateLimit' => ['GET', '/api/ua/v2/rate-limit/query-all'],
        'getRateLimitCap' => ['GET', '/api/ua/v2/rate-limit/query-cap'],
        'getSubAccountList' => ['GET', '/api/ua/v2/user/sub-account-list'],
        'getRateLimit' => ['GET', '/api/ua/v2/rate-limit/query'],
        'setRateLimit' => ['POST', '/api/ua/v2/rate-limit/set'],
        'flexTransfer' => ['POST', '/api/ua/v2/account/transfer'],
        'setKcsFeeDeduction' => ['GET', '/api/ua/v2/account/fee/kcs-deduct'],
        'cancelWithdrawal' => ['POST', '/api/ua/v2/asset/withdraw/cancel'],
        'withdrawalV3' => ['POST', '/api/ua/v2/asset/withdrawal'],
    ];
}
