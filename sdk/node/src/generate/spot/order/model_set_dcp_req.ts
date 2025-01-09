// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class SetDCPReq implements Serializable<SetDCPReq> {
    /**
     * Auto cancel order trigger setting time, the unit is second. range: timeout=-1 (meaning unset) or 5 <= timeout <= 86400. For example, timeout=5 means that the order will be automatically canceled if no user request is received for more than 5 seconds. When this parameter is changed, the previous setting will be overwritten.
     */
    timeout?: number;
    /**
     * List of trading pairs. When this parameter is not empty, separate it with commas and support up to 50 trading pairs. Empty means all trading pairs. When this parameter is changed, the previous setting will be overwritten.
     */
    symbols?: string;

    /**
     * Creates a new instance of the `SetDCPReq` class.
     * The builder pattern allows step-by-step construction of a `SetDCPReq` object.
     */
    static builder(): SetDCPReqBuilder {
        return new SetDCPReqBuilder();
    }

    /**
     * Creates a new instance of the `SetDCPReq` class with the given data.
     */
    static create(data: {
        /**
         * Auto cancel order trigger setting time, the unit is second. range: timeout=-1 (meaning unset) or 5 <= timeout <= 86400. For example, timeout=5 means that the order will be automatically canceled if no user request is received for more than 5 seconds. When this parameter is changed, the previous setting will be overwritten.
         */
        timeout?: number;
        /**
         * List of trading pairs. When this parameter is not empty, separate it with commas and support up to 50 trading pairs. Empty means all trading pairs. When this parameter is changed, the previous setting will be overwritten.
         */
        symbols?: string;
    }): SetDCPReq {
        let obj = new SetDCPReq();
        obj.timeout = data.timeout;
        obj.symbols = data.symbols;
        return obj;
    }

    fromJson(input: string): SetDCPReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(SetDCPReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): SetDCPReq {
        return plainToInstance(SetDCPReq, jsonObject);
    }
}

export class SetDCPReqBuilder {
    obj: SetDCPReq = new SetDCPReq();
    /**
     * Auto cancel order trigger setting time, the unit is second. range: timeout=-1 (meaning unset) or 5 <= timeout <= 86400. For example, timeout=5 means that the order will be automatically canceled if no user request is received for more than 5 seconds. When this parameter is changed, the previous setting will be overwritten.
     */
    setTimeout(value: number): SetDCPReqBuilder {
        this.obj.timeout = value;
        return this;
    }

    /**
     * List of trading pairs. When this parameter is not empty, separate it with commas and support up to 50 trading pairs. Empty means all trading pairs. When this parameter is changed, the previous setting will be overwritten.
     */
    setSymbols(value: string): SetDCPReqBuilder {
        this.obj.symbols = value;
        return this;
    }

    build(): SetDCPReq {
        return this.obj;
    }
}