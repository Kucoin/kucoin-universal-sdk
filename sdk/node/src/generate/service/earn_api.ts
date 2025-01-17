// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';

import { EarnAPIImpl, EarnAPI } from '@generate/earn/earn/api_earn';

export interface EarnService {
    getEarnApi(): EarnAPI;
}

export class EarnServiceImpl implements EarnService {
    private readonly transport: Transport;
    private readonly earn: EarnAPI;

    constructor(transport: Transport) {
        this.transport = transport;
        this.earn = new EarnAPIImpl(transport);
    }

    getEarnApi(): EarnAPI {
        return this.earn;
    }
}