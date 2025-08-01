// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { RestResponse } from '@model/common';
import { Response } from '@internal/interfaces/serializable';

export class GetCurrentFundingRateResp implements Response<RestResponse> {
    /**
     * Funding Rate Symbol
     */
    symbol: string;

    /**
     * Granularity (milliseconds)
     */
    granularity: number;

    /**
     * The funding rate settlement time point of the previous cycle (milliseconds) Before going live, the system will pre-generate the first funding rate record to ensure the billing cycle can start immediately after the contract is launched.  The timePoint field represents the time the funding rate data was generated, not the actual time it takes effect or is settled.  The first actual settlement will occur at the designated settlement time (00:00 / 08:00 / 14:00) after the contract goes live.
     */
    timePoint: number;

    /**
     * Current cycle funding rate
     */
    value: number;

    /**
     * Predicted funding rate
     */
    predictedValue: number;

    /**
     * Maximum Funding Rate
     */
    fundingRateCap: number;

    /**
     * Minimum Funding Rate
     */
    fundingRateFloor: number;

    /**
     * Indicates whether the current funding fee is charged within this cycle
     */
    period: GetCurrentFundingRateResp.PeriodEnum;

    /**
     * Indicates the next funding fee settlement time point, which can be used to synchronize periodic settlement timing.
     */
    fundingTime: number;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.granularity = null;
        // @ts-ignore
        this.timePoint = null;
        // @ts-ignore
        this.value = null;
        // @ts-ignore
        this.predictedValue = null;
        // @ts-ignore
        this.fundingRateCap = null;
        // @ts-ignore
        this.fundingRateFloor = null;
        // @ts-ignore
        this.period = null;
        // @ts-ignore
        this.fundingTime = null;
    }
    /**
     * common response
     */
    @Exclude()
    commonResponse?: RestResponse;

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    /**
     * Convert the object to a JSON string.
     */
    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }
    /**
     * Create an object from a JSON string.
     */
    static fromJson(input: string): GetCurrentFundingRateResp {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetCurrentFundingRateResp {
        return plainToClassFromExist(new GetCurrentFundingRateResp(), jsonObject);
    }
}

export namespace GetCurrentFundingRateResp {
    export enum PeriodEnum {
        /**
         * Indicates that funding will be charged in the current cycle
         */
        _1 = <any>1,
        /**
         * Indicates a cross-cycle expense record that is not charged in the current cycle.
         */
        _0 = <any>0,
    }
}
