import { RateLimit } from '@model/common';

export interface UnifiedWsArgs {
    /** user-defined id */
    id?: string;
    /** operation */
    op: string;
    /** business params */
    args: Record<string, any>;
}

export interface UnifiedWsMessage {
    /** echo id */
    id: string;
    /** response data */
    data?: Record<string, any>;
    /** operation */
    op?: string;
    /** gateway code */
    code?: string;
    /** error message */
    msg?: string;
    /** inTime */
    inTime?: number;
    /** outTime */
    outTime?: number;
    /** user rate limit */
    userRateLimit?: RateLimit;
}
