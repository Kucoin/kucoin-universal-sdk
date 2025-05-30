// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetPurchaseOrdersReq implements Serializable {
    /**
     * DONE-completed; PENDING-settling
     */
    status?: GetPurchaseOrdersReq.StatusEnum;

    /**
     * Currency
     */
    currency?: string;

    /**
     * Purchase order ID
     */
    purchaseOrderNo?: string;

    /**
     * Current page; default is 1
     */
    currentPage?: number = 1;

    /**
     * Page size; 1<=pageSize<=50; default is 50
     */
    pageSize?: number = 50;

    /**
     * Private constructor, please use the corresponding static methods to construct the object.
     */
    private constructor() {}
    /**
     * Creates a new instance of the `GetPurchaseOrdersReq` class.
     * The builder pattern allows step-by-step construction of a `GetPurchaseOrdersReq` object.
     */
    static builder(): GetPurchaseOrdersReqBuilder {
        return new GetPurchaseOrdersReqBuilder(new GetPurchaseOrdersReq());
    }

    /**
     * Creates a new instance of the `GetPurchaseOrdersReq` class with the given data.
     */
    static create(data: {
        /**
         * DONE-completed; PENDING-settling
         */
        status?: GetPurchaseOrdersReq.StatusEnum;
        /**
         * Currency
         */
        currency?: string;
        /**
         * Purchase order ID
         */
        purchaseOrderNo?: string;
        /**
         * Current page; default is 1
         */
        currentPage?: number;
        /**
         * Page size; 1<=pageSize<=50; default is 50
         */
        pageSize?: number;
    }): GetPurchaseOrdersReq {
        let obj = new GetPurchaseOrdersReq();
        obj.status = data.status;
        obj.currency = data.currency;
        obj.purchaseOrderNo = data.purchaseOrderNo;
        if (data.currentPage) {
            obj.currentPage = data.currentPage;
        } else {
            obj.currentPage = 1;
        }
        if (data.pageSize) {
            obj.pageSize = data.pageSize;
        } else {
            obj.pageSize = 50;
        }
        return obj;
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
    static fromJson(input: string): GetPurchaseOrdersReq {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): GetPurchaseOrdersReq {
        return plainToClassFromExist(new GetPurchaseOrdersReq(), jsonObject);
    }
}

export namespace GetPurchaseOrdersReq {
    export enum StatusEnum {
        /**
         * completed
         */
        DONE = <any>'DONE',
        /**
         * settling
         */
        PENDING = <any>'PENDING',
    }
}

export class GetPurchaseOrdersReqBuilder {
    constructor(readonly obj: GetPurchaseOrdersReq) {
        this.obj = obj;
    }
    /**
     * DONE-completed; PENDING-settling
     */
    setStatus(value: GetPurchaseOrdersReq.StatusEnum): GetPurchaseOrdersReqBuilder {
        this.obj.status = value;
        return this;
    }

    /**
     * Currency
     */
    setCurrency(value: string): GetPurchaseOrdersReqBuilder {
        this.obj.currency = value;
        return this;
    }

    /**
     * Purchase order ID
     */
    setPurchaseOrderNo(value: string): GetPurchaseOrdersReqBuilder {
        this.obj.purchaseOrderNo = value;
        return this;
    }

    /**
     * Current page; default is 1
     */
    setCurrentPage(value: number): GetPurchaseOrdersReqBuilder {
        this.obj.currentPage = value;
        return this;
    }

    /**
     * Page size; 1<=pageSize<=50; default is 50
     */
    setPageSize(value: number): GetPurchaseOrdersReqBuilder {
        this.obj.pageSize = value;
        return this;
    }

    /**
     * Get the final object.
     */
    build(): GetPurchaseOrdersReq {
        return this.obj;
    }
}
