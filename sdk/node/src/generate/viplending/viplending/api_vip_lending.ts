// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';
import { GetLoanInfoResp } from './model_get_loan_info_resp';
import { GetDiscountRateConfigsResp } from './model_get_discount_rate_configs_resp';
import { GetAccountsResp } from './model_get_accounts_resp';

export interface VIPLendingAPI {
    /**
     * getDiscountRateConfigs Get Discount Rate Configs
     * Description: Get the gradient discount rate of each currency
     * Documentation: https://www.kucoin.com/docs-new/api-3471463
     * +-----------------------+---------+
     * | Extra API Info        | Value   |
     * +-----------------------+---------+
     * | API-DOMAIN            | SPOT    |
     * | API-CHANNEL           | PRIVATE |
     * | API-PERMISSION        | NULL    |
     * | API-RATE-LIMIT-POOL   | PUBLIC  |
     * | API-RATE-LIMIT-WEIGHT | 10      |
     * +-----------------------+---------+
     */
    getDiscountRateConfigs(): Promise<GetDiscountRateConfigsResp>;

    /**
     * getLoanInfo Get Loan Info
     * Description: The following information is only applicable to loans.  Get information on off-exchange funding and loans. This endpoint is only for querying accounts that are currently involved in loans.
     * Documentation: https://www.kucoin.com/docs-new/api-3470277
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | SPOT       |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 5          |
     * +-----------------------+------------+
     */
    getLoanInfo(): Promise<GetLoanInfoResp>;

    /**
     * getAccounts Get Accounts
     * Description: Accounts participating in OTC lending. This interface is only for querying accounts currently running OTC lending.
     * Documentation: https://www.kucoin.com/docs-new/api-3470278
     * +-----------------------+------------+
     * | Extra API Info        | Value      |
     * +-----------------------+------------+
     * | API-DOMAIN            | SPOT       |
     * | API-CHANNEL           | PRIVATE    |
     * | API-PERMISSION        | SPOT       |
     * | API-RATE-LIMIT-POOL   | MANAGEMENT |
     * | API-RATE-LIMIT-WEIGHT | 20         |
     * +-----------------------+------------+
     */
    getAccounts(): Promise<GetAccountsResp>;
}

export class VIPLendingAPIImpl implements VIPLendingAPI {
    constructor(private transport: Transport) {}

    getDiscountRateConfigs(): Promise<GetDiscountRateConfigsResp> {
        return this.transport.call(
            'spot',
            false,
            'GET',
            '/api/v1/otc-loan/discount-rate-configs',
            null,
            GetDiscountRateConfigsResp,
            false,
        );
    }

    getLoanInfo(): Promise<GetLoanInfoResp> {
        return this.transport.call(
            'spot',
            false,
            'GET',
            '/api/v1/otc-loan/loan',
            null,
            GetLoanInfoResp,
            false,
        );
    }

    getAccounts(): Promise<GetAccountsResp> {
        return this.transport.call(
            'spot',
            false,
            'GET',
            '/api/v1/otc-loan/accounts',
            null,
            GetAccountsResp,
            false,
        );
    }
}
