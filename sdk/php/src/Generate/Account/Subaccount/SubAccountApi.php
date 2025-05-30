<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

interface SubAccountApi
{
    /**
     * Add sub-account
     *
     * This endpoint can be used to create sub-accounts.
     * @see: https://www.kucoin.com/docs-new/api-3470135
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 15         |
     * +-----------------------+------------+
     */
    public function addSubAccount(AddSubAccountReq $req): AddSubAccountResp;

    /**
     * Add sub-account Margin Permission
     *
     * This endpoint can be used to add sub-account Margin permissions. Before using this endpoint, you need to ensure that the master account apikey has Margin permissions and the Margin function has been activated.
     * @see: https://www.kucoin.com/docs-new/api-3470331
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | MARGIN     |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 15         |
     * +-----------------------+------------+
     */
    public function addSubAccountMarginPermission(
        AddSubAccountMarginPermissionReq $req
    ): AddSubAccountMarginPermissionResp;

    /**
     * Add sub-account Futures Permission
     *
     * This endpoint can be used to add sub-account Futures permissions. Before using this endpoint, you need to ensure that the master account apikey has Futures permissions and the Futures function has been activated.
     * @see: https://www.kucoin.com/docs-new/api-3470332
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | FUTURES    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 15         |
     * +-----------------------+------------+
     */
    public function addSubAccountFuturesPermission(
        AddSubAccountFuturesPermissionReq $req
    ): AddSubAccountFuturesPermissionResp;

    /**
     * Get sub-account List - Summary Info
     *
     * This endpoint can be used to get a paginated list of sub-accounts. Pagination is required.
     * @see: https://www.kucoin.com/docs-new/api-3470131
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function getSpotSubAccountsSummaryV2(
        GetSpotSubAccountsSummaryV2Req $req
    ): GetSpotSubAccountsSummaryV2Resp;

    /**
     * Get sub-account Detail - Balance
     *
     * This endpoint returns the account info of a sub-user specified by the subUserId.
     * @see: https://www.kucoin.com/docs-new/api-3470132
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 15         |
     * +-----------------------+------------+
     */
    public function getSpotSubAccountDetail(
        GetSpotSubAccountDetailReq $req
    ): GetSpotSubAccountDetailResp;

    /**
     * Get sub-account List - Spot Balance (V2)
     *
     * This endpoint can be used to get paginated Spot sub-account information. Pagination is required.
     * @see: https://www.kucoin.com/docs-new/api-3470133
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function getSpotSubAccountListV2(
        GetSpotSubAccountListV2Req $req
    ): GetSpotSubAccountListV2Resp;

    /**
     * Get sub-account List - Futures Balance (V2)
     *
     * This endpoint can be used to get Futures sub-account information.
     * @see: https://www.kucoin.com/docs-new/api-3470134
     *
     * +-----------------------+---------+
     * | Extra API Info        | Value   |
     * +-----------------------+---------+
     * | API-DOMAIN            | FUTURES |
     * | API-CHANNEL           | PRIVATE |
     * | API-PERMISSION        | GENERAL |
     * | API-RATE-LIMIT-POOL   | FUTURES |
     * | API-RATE-LIMIT-WEIGHT | 6       |
     * +-----------------------+---------+
     */
    public function getFuturesSubAccountListV2(
        GetFuturesSubAccountListV2Req $req
    ): GetFuturesSubAccountListV2Resp;

    /**
     * Add sub-account API
     *
     * This endpoint can be used to create APIs for sub-accounts.
     * @see: https://www.kucoin.com/docs-new/api-3470138
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function addSubAccountApi(
        AddSubAccountApiReq $req
    ): AddSubAccountApiResp;

    /**
     * Modify sub-account API
     *
     * This endpoint can be used to modify sub-account APIs.
     * @see: https://www.kucoin.com/docs-new/api-3470139
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 30         |
     * +-----------------------+------------+
     */
    public function modifySubAccountApi(
        ModifySubAccountApiReq $req
    ): ModifySubAccountApiResp;

    /**
     * Get sub-account API List
     *
     * This endpoint can be used to obtain a list of APIs pertaining to a sub-account (not including ND broker sub-accounts).
     * @see: https://www.kucoin.com/docs-new/api-3470136
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function getSubAccountApiList(
        GetSubAccountApiListReq $req
    ): GetSubAccountApiListResp;

    /**
     * Delete sub-account API
     *
     * This endpoint can be used to delete sub-account APIs.
     * @see: https://www.kucoin.com/docs-new/api-3470137
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 30         |
     * +-----------------------+------------+
     */
    public function deleteSubAccountApi(
        DeleteSubAccountApiReq $req
    ): DeleteSubAccountApiResp;

    /**
     * Get sub-account List - Summary Info (V1)
     *
     * You can get the user info of all sub-account via this interface; it is recommended to use the GET /api/v2/sub/user interface for paging query
     * @deprecated
     * @see: https://www.kucoin.com/docs-new/api-3470298
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function getSpotSubAccountsSummaryV1(): GetSpotSubAccountsSummaryV1Resp;

    /**
     * Get sub-account List - Spot Balance (V1)
     *
     * This endpoint returns the account info of all sub-users.
     * @deprecated
     * @see: https://www.kucoin.com/docs-new/api-3470299
     *
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    public function getSpotSubAccountListV1(): GetSpotSubAccountListV1Resp;
}
