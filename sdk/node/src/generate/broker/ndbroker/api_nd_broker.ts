// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';
import { GetSubAccountResp } from './model_get_sub_account_resp';
import { GetRebaseResp } from './model_get_rebase_resp';
import { AddSubAccountApiResp } from './model_add_sub_account_api_resp';
import { AddSubAccountApiReq } from './model_add_sub_account_api_req';
import { GetSubAccountAPIReq } from './model_get_sub_account_api_req';
import { GetRebaseReq } from './model_get_rebase_req';
import { DeleteSubAccountAPIReq } from './model_delete_sub_account_api_req';
import { GetWithdrawDetailReq } from './model_get_withdraw_detail_req';
import { GetDepositDetailResp } from './model_get_deposit_detail_resp';
import { GetDepositDetailReq } from './model_get_deposit_detail_req';
import { TransferResp } from './model_transfer_resp';
import { GetWithdrawDetailResp } from './model_get_withdraw_detail_resp';
import { DeleteSubAccountAPIResp } from './model_delete_sub_account_api_resp';
import { GetTransferHistoryResp } from './model_get_transfer_history_resp';
import { GetDepositListResp } from './model_get_deposit_list_resp';
import { ModifySubAccountApiResp } from './model_modify_sub_account_api_resp';
import { AddSubAccountReq } from './model_add_sub_account_req';
import { GetSubAccountReq } from './model_get_sub_account_req';
import { GetSubAccountAPIResp } from './model_get_sub_account_api_resp';
import { GetBrokerInfoResp } from './model_get_broker_info_resp';
import { GetTransferHistoryReq } from './model_get_transfer_history_req';
import { AddSubAccountResp } from './model_add_sub_account_resp';
import { GetDepositListReq } from './model_get_deposit_list_req';
import { GetBrokerInfoReq } from './model_get_broker_info_req';
import { ModifySubAccountApiReq } from './model_modify_sub_account_api_req';
import { TransferReq } from './model_transfer_req';

export interface NDBrokerAPI {
    /**
     * getBrokerInfo Get Broker Info
     * Description: This endpoint supports querying the basic information of the current Broker
     * Documentation: https://www.kucoin.com/docs-new/api-3470282
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 2       |
     * +---------------------+---------+
     */
    getBrokerInfo(req: GetBrokerInfoReq): Promise<GetBrokerInfoResp>;

    /**
     * addSubAccount Add SubAccount
     * Description: This endpoint supports Broker users to create sub-accounts
     * Documentation: https://www.kucoin.com/docs-new/api-3470290
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 3       |
     * +---------------------+---------+
     */
    addSubAccount(req: AddSubAccountReq): Promise<AddSubAccountResp>;

    /**
     * getSubAccount Get SubAccount
     * Description: This interface supports querying sub-accounts created by Broker
     * Documentation: https://www.kucoin.com/docs-new/api-3470283
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 2       |
     * +---------------------+---------+
     */
    getSubAccount(req: GetSubAccountReq): Promise<GetSubAccountResp>;

    /**
     * addSubAccountApi Add SubAccount API
     * Description: This interface supports the creation of Broker sub-account APIKEY
     * Documentation: https://www.kucoin.com/docs-new/api-3470291
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 3       |
     * +---------------------+---------+
     */
    addSubAccountApi(req: AddSubAccountApiReq): Promise<AddSubAccountApiResp>;

    /**
     * getSubAccountAPI Get SubAccount API
     * Description: This interface supports querying the Broker’s sub-account APIKEY
     * Documentation: https://www.kucoin.com/docs-new/api-3470284
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 2       |
     * +---------------------+---------+
     */
    getSubAccountAPI(req: GetSubAccountAPIReq): Promise<GetSubAccountAPIResp>;

    /**
     * modifySubAccountApi Modify SubAccount API
     * Description: This interface supports modify the Broker’s sub-account APIKEY
     * Documentation: https://www.kucoin.com/docs-new/api-3470292
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 3       |
     * +---------------------+---------+
     */
    modifySubAccountApi(req: ModifySubAccountApiReq): Promise<ModifySubAccountApiResp>;

    /**
     * deleteSubAccountAPI Delete SubAccount API
     * Description: This interface supports deleting Broker’s sub-account APIKEY
     * Documentation: https://www.kucoin.com/docs-new/api-3470289
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 3       |
     * +---------------------+---------+
     */
    deleteSubAccountAPI(req: DeleteSubAccountAPIReq): Promise<DeleteSubAccountAPIResp>;

    /**
     * transfer Transfer
     * Description: This endpoint supports fund transfer between Broker account and Broker sub-accounts.  Please be aware that withdrawal from sub-account is not directly supported. Broker has to transfer funds from broker sub-account to broker account to initiate the withdrawals.
     * Documentation: https://www.kucoin.com/docs-new/api-3470293
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 1       |
     * +---------------------+---------+
     */
    transfer(req: TransferReq): Promise<TransferResp>;

    /**
     * getTransferHistory Get Transfer History
     * Description: This endpoint supports querying transfer records of the broker itself and its created sub-accounts.
     * Documentation: https://www.kucoin.com/docs-new/api-3470286
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 1       |
     * +---------------------+---------+
     */
    getTransferHistory(req: GetTransferHistoryReq): Promise<GetTransferHistoryResp>;

    /**
     * getDepositList Get Deposit List
     * Description: This endpoint can obtain the deposit records of each sub-account under the ND Broker.
     * Documentation: https://www.kucoin.com/docs-new/api-3470285
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 10      |
     * +---------------------+---------+
     */
    getDepositList(req: GetDepositListReq): Promise<GetDepositListResp>;

    /**
     * getDepositDetail Get Deposit Detail
     * Description: This endpoint supports querying the deposit record of sub-accounts created by a Broker (excluding main account of nd broker)
     * Documentation: https://www.kucoin.com/docs-new/api-3470288
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 1       |
     * +---------------------+---------+
     */
    getDepositDetail(req: GetDepositDetailReq): Promise<GetDepositDetailResp>;

    /**
     * getWithdrawDetail Get Withdraw Detail
     * Description: This endpoint supports querying the withdrawal records of sub-accounts created by a Broker (excluding main account of nd broker).
     * Documentation: https://www.kucoin.com/docs-new/api-3470287
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 1       |
     * +---------------------+---------+
     */
    getWithdrawDetail(req: GetWithdrawDetailReq): Promise<GetWithdrawDetailResp>;

    /**
     * getRebase Get Broker Rebate
     * Description: This interface supports downloading Broker rebate orders
     * Documentation: https://www.kucoin.com/docs-new/api-3470281
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | BROKER  |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | BROKER  |
     * | API-RATE-LIMIT      | 3       |
     * +---------------------+---------+
     */
    getRebase(req: GetRebaseReq): Promise<GetRebaseResp>;
}

export class NDBrokerAPIImpl implements NDBrokerAPI {
    constructor(private transport: Transport) {}

    getBrokerInfo(req: GetBrokerInfoReq): Promise<GetBrokerInfoResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v1/broker/nd/info',
            req,
            new GetBrokerInfoResp(),
            false,
        );
    }

    addSubAccount(req: AddSubAccountReq): Promise<AddSubAccountResp> {
        return this.transport.call(
            'broker',
            true,
            'POST',
            '/api/v1/broker/nd/account',
            req,
            new AddSubAccountResp(),
            false,
        );
    }

    getSubAccount(req: GetSubAccountReq): Promise<GetSubAccountResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v1/broker/nd/account',
            req,
            new GetSubAccountResp(),
            false,
        );
    }

    addSubAccountApi(req: AddSubAccountApiReq): Promise<AddSubAccountApiResp> {
        return this.transport.call(
            'broker',
            true,
            'POST',
            '/api/v1/broker/nd/account/apikey',
            req,
            new AddSubAccountApiResp(),
            false,
        );
    }

    getSubAccountAPI(req: GetSubAccountAPIReq): Promise<GetSubAccountAPIResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v1/broker/nd/account/apikey',
            req,
            new GetSubAccountAPIResp(),
            false,
        );
    }

    modifySubAccountApi(req: ModifySubAccountApiReq): Promise<ModifySubAccountApiResp> {
        return this.transport.call(
            'broker',
            true,
            'POST',
            '/api/v1/broker/nd/account/update-apikey',
            req,
            new ModifySubAccountApiResp(),
            false,
        );
    }

    deleteSubAccountAPI(req: DeleteSubAccountAPIReq): Promise<DeleteSubAccountAPIResp> {
        return this.transport.call(
            'broker',
            true,
            'DELETE',
            '/api/v1/broker/nd/account/apikey',
            req,
            new DeleteSubAccountAPIResp(),
            false,
        );
    }

    transfer(req: TransferReq): Promise<TransferResp> {
        return this.transport.call(
            'broker',
            true,
            'POST',
            '/api/v1/broker/nd/transfer',
            req,
            new TransferResp(),
            false,
        );
    }

    getTransferHistory(req: GetTransferHistoryReq): Promise<GetTransferHistoryResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v3/broker/nd/transfer/detail',
            req,
            new GetTransferHistoryResp(),
            false,
        );
    }

    getDepositList(req: GetDepositListReq): Promise<GetDepositListResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v1/asset/ndbroker/deposit/list',
            req,
            new GetDepositListResp(),
            false,
        );
    }

    getDepositDetail(req: GetDepositDetailReq): Promise<GetDepositDetailResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v3/broker/nd/deposit/detail',
            req,
            new GetDepositDetailResp(),
            false,
        );
    }

    getWithdrawDetail(req: GetWithdrawDetailReq): Promise<GetWithdrawDetailResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v3/broker/nd/withdraw/detail',
            req,
            new GetWithdrawDetailResp(),
            false,
        );
    }

    getRebase(req: GetRebaseReq): Promise<GetRebaseResp> {
        return this.transport.call(
            'broker',
            true,
            'GET',
            '/api/v1/broker/nd/rebase/download',
            req,
            new GetRebaseResp(),
            false,
        );
    }
}