// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import 'reflect-metadata';
import { Serializable } from '@internal/interfaces/serializable';

export class GetOcoOrderByClientOidReq implements Serializable<GetOcoOrderByClientOidReq> {
    /**
     * Client Order Id，unique identifier created by the user
     */
    @Reflect.metadata('path', 'clientOid')
    clientOid?: string;

    /**
     * Creates a new instance of the `GetOcoOrderByClientOidReq` class.
     * The builder pattern allows step-by-step construction of a `GetOcoOrderByClientOidReq` object.
     */
    static builder(): GetOcoOrderByClientOidReqBuilder {
        return new GetOcoOrderByClientOidReqBuilder();
    }

    /**
     * Creates a new instance of the `GetOcoOrderByClientOidReq` class with the given data.
     */
    static create(data: {
        /**
         * Client Order Id，unique identifier created by the user
         */
        clientOid?: string;
    }): GetOcoOrderByClientOidReq {
        let obj = new GetOcoOrderByClientOidReq();
        obj.clientOid = data.clientOid;
        return obj;
    }

    fromJson(input: string): GetOcoOrderByClientOidReq {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetOcoOrderByClientOidReq, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetOcoOrderByClientOidReq {
        return plainToInstance(GetOcoOrderByClientOidReq, jsonObject);
    }
}

export class GetOcoOrderByClientOidReqBuilder {
    obj: GetOcoOrderByClientOidReq = new GetOcoOrderByClientOidReq();
    /**
     * Client Order Id，unique identifier created by the user
     */
    setClientOid(value: string): GetOcoOrderByClientOidReqBuilder {
        this.obj.clientOid = value;
        return this;
    }

    build(): GetOcoOrderByClientOidReq {
        return this.obj;
    }
}