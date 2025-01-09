// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Transport } from '@internal/interfaces/transport';

import { NDBrokerAPI, NDBrokerAPIImpl } from '@generate/broker/ndbroker/api_nd_broker';
import { APIBrokerAPIImpl, APIBrokerAPI } from '@generate/broker/apibroker/api_api_broker';

export interface BrokerService {
    getAPIBrokerApi(): APIBrokerAPI;

    getNDBrokerApi(): NDBrokerAPI;
}

export class BrokerServiceImpl implements BrokerService {
    private readonly transport: Transport;
    private readonly APIBroker: APIBrokerAPI;
    private readonly NDBroker: NDBrokerAPI;

    constructor(transport: Transport) {
        this.transport = transport;
        this.APIBroker = new APIBrokerAPIImpl(transport);
        this.NDBroker = new NDBrokerAPIImpl(transport);
    }

    getAPIBrokerApi(): APIBrokerAPI {
        return this.APIBroker;
    }

    getNDBrokerApi(): NDBrokerAPI {
        return this.NDBroker;
    }
}