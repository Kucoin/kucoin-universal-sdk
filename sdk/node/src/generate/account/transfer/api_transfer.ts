// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';
import { GetFuturesAccountTransferOutLedgerResp } from './model_get_futures_account_transfer_out_ledger_resp';
import { FuturesAccountTransferInResp } from './model_futures_account_transfer_in_resp';
import { InnerTransferResp } from './model_inner_transfer_resp';
import { InnerTransferReq } from './model_inner_transfer_req';
import { SubAccountTransferResp } from './model_sub_account_transfer_resp';
import { FlexTransferResp } from './model_flex_transfer_resp';
import { SubAccountTransferReq } from './model_sub_account_transfer_req';
import { GetTransferQuotasResp } from './model_get_transfer_quotas_resp';
import { GetTransferQuotasReq } from './model_get_transfer_quotas_req';
import { FuturesAccountTransferOutResp } from './model_futures_account_transfer_out_resp';
import { FuturesAccountTransferOutReq } from './model_futures_account_transfer_out_req';
import { FlexTransferReq } from './model_flex_transfer_req';
import { FuturesAccountTransferInReq } from './model_futures_account_transfer_in_req';
import { GetFuturesAccountTransferOutLedgerReq } from './model_get_futures_account_transfer_out_ledger_req';

export interface TransferAPI {
    /**
     * getTransferQuotas Get Transfer Quotas
     * Description: This endpoint returns the transferable balance of a specified account.
     * Documentation: https://www.kucoin.com/docs-new/api-3470148
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
    getTransferQuotas(req: GetTransferQuotasReq): Promise<GetTransferQuotasResp>;

    /**
     * flexTransfer Flex Transfer
     * Description: This interface can be used for transfers between master- and sub-accounts and transfers
     * Documentation: https://www.kucoin.com/docs-new/api-3470147
     * +-----------------------+---------------+
     * | Extra API Info        | Value         |
     * +-----------------------+---------------+
     * | API-DOMAIN            | SPOT          |
     * | API-CHANNEL           | PRIVATE       |
     * | API-PERMISSION        | FLEXTRANSFERS |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT    |
     * | API-RATE-LIMIT-WEIGHT | 4             |
     * +-----------------------+---------------+
     */
    flexTransfer(req: FlexTransferReq): Promise<FlexTransferResp>;

    /**
     * @deprecated
     * subAccountTransfer Sub-account Transfer
     * Description: Funds in the main account, trading account and margin account of a Master Account can be transferred to the main account, trading account, futures account and margin account of its Sub-Account. The futures account of both the Master Account and Sub-Account can only accept funds transferred in from the main account, trading account and margin account and cannot transfer out to these accounts.
     * Documentation: https://www.kucoin.com/docs-new/api-3470301
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | SPOT       |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 30         |
     * +-----------------------+------------+
     */
    subAccountTransfer(req: SubAccountTransferReq): Promise<SubAccountTransferResp>;

    /**
     * @deprecated
     * innerTransfer Internal Transfer
     * Description: This API endpoint can be used to transfer funds between accounts internally. Users can transfer funds between their accounts free of charge.
     * Documentation: https://www.kucoin.com/docs-new/api-3470302
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | SPOT       |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 10         |
     * +-----------------------+------------+
     */
    innerTransfer(req: InnerTransferReq): Promise<InnerTransferResp>;

    /**
     * @deprecated
     * getFuturesAccountTransferOutLedger Get Futures Account Transfer Out Ledger
     * Description: Futures account transfer out ledgers can be obtained at this endpoint.
     * Documentation: https://www.kucoin.com/docs-new/api-3470307
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | FUTURES    |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | GENERAL    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    getFuturesAccountTransferOutLedger(
        req: GetFuturesAccountTransferOutLedgerReq,
    ): Promise<GetFuturesAccountTransferOutLedgerResp>;

    /**
     * @deprecated
     * futuresAccountTransferOut Futures Account Transfer Out
     * Description: The amount to be transferred will be deducted from the KuCoin Futures Account. Please ensure that you have sufficient funds in your KuCoin Futures Account, or the transfer will fail.
     * Documentation: https://www.kucoin.com/docs-new/api-3470303
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | FUTURES    |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | FUTURES    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    futuresAccountTransferOut(
        req: FuturesAccountTransferOutReq,
    ): Promise<FuturesAccountTransferOutResp>;

    /**
     * @deprecated
     * futuresAccountTransferIn Futures Account Transfer In
     * Description: The amount to be transferred will be deducted from the payAccount. Please ensure that you have sufficient funds in your payAccount account, or the transfer will fail.
     * Documentation: https://www.kucoin.com/docs-new/api-3470304
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | FUTURES    |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | FUTURES    |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    futuresAccountTransferIn(
        req: FuturesAccountTransferInReq,
    ): Promise<FuturesAccountTransferInResp>;
}

export class TransferAPIImpl implements TransferAPI {
    constructor(private transport: Transport) {}

    getTransferQuotas(req: GetTransferQuotasReq): Promise<GetTransferQuotasResp> {
        return this.transport.call(
            'spot',
            false,
            'GET',
            '/api/v1/accounts/transferable',
            req,
            GetTransferQuotasResp,
            false,
        );
    }

    flexTransfer(req: FlexTransferReq): Promise<FlexTransferResp> {
        return this.transport.call(
            'spot',
            false,
            'POST',
            '/api/v3/accounts/universal-transfer',
            req,
            FlexTransferResp,
            false,
        );
    }

    subAccountTransfer(req: SubAccountTransferReq): Promise<SubAccountTransferResp> {
        return this.transport.call(
            'spot',
            false,
            'POST',
            '/api/v2/accounts/sub-transfer',
            req,
            SubAccountTransferResp,
            false,
        );
    }

    innerTransfer(req: InnerTransferReq): Promise<InnerTransferResp> {
        return this.transport.call(
            'spot',
            false,
            'POST',
            '/api/v2/accounts/inner-transfer',
            req,
            InnerTransferResp,
            false,
        );
    }

    getFuturesAccountTransferOutLedger(
        req: GetFuturesAccountTransferOutLedgerReq,
    ): Promise<GetFuturesAccountTransferOutLedgerResp> {
        return this.transport.call(
            'futures',
            false,
            'GET',
            '/api/v1/transfer-list',
            req,
            GetFuturesAccountTransferOutLedgerResp,
            false,
        );
    }

    futuresAccountTransferOut(
        req: FuturesAccountTransferOutReq,
    ): Promise<FuturesAccountTransferOutResp> {
        return this.transport.call(
            'futures',
            false,
            'POST',
            '/api/v3/transfer-out',
            req,
            FuturesAccountTransferOutResp,
            false,
        );
    }

    futuresAccountTransferIn(
        req: FuturesAccountTransferInReq,
    ): Promise<FuturesAccountTransferInResp> {
        return this.transport.call(
            'futures',
            false,
            'POST',
            '/api/v1/transfer-in',
            req,
            FuturesAccountTransferInResp,
            false,
        );
    }
}
