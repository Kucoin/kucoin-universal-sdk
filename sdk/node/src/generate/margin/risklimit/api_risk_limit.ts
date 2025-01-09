// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';
import { GetMarginRiskLimitResp } from './model_get_margin_risk_limit_resp';
import { GetMarginRiskLimitReq } from './model_get_margin_risk_limit_req';

export interface RiskLimitAPI {
    /**
     * getMarginRiskLimit Get Margin Risk Limit
     * Description: Request via this endpoint to get the Configure and Risk limit info of the margin.
     * Documentation: https://www.kucoin.com/docs-new/api-3470219
     * +---------------------+---------+
     * | Extra API Info      | Value   |
     * +---------------------+---------+
     * | API-DOMAIN          | SPOT    |
     * | API-CHANNEL         | PRIVATE |
     * | API-PERMISSION      | GENERAL |
     * | API-RATE-LIMIT-POOL | SPOT    |
     * | API-RATE-LIMIT      | 20      |
     * +---------------------+---------+
     */
    getMarginRiskLimit(req: GetMarginRiskLimitReq): Promise<GetMarginRiskLimitResp>;
}

export class RiskLimitAPIImpl implements RiskLimitAPI {
    constructor(private transport: Transport) {}

    getMarginRiskLimit(req: GetMarginRiskLimitReq): Promise<GetMarginRiskLimitResp> {
        return this.transport.call(
            'spot',
            false,
            'GET',
            '/api/v3/margin/currencies',
            req,
            new GetMarginRiskLimitResp(),
            false,
        );
    }
}