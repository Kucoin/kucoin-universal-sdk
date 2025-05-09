// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToClassFromExist } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class SymbolSnapshotDataMarketChange1h implements Serializable {
    /**
     *
     */
    changePrice: number;
    /**
     *
     */
    changeRate: number;
    /**
     *
     */
    high: number;
    /**
     *
     */
    low: number;
    /**
     *
     */
    open: number;
    /**
     *
     */
    vol: number;
    /**
     *
     */
    volValue: number;

    private constructor() {
        // @ts-ignore
        this.changePrice = null;
        // @ts-ignore
        this.changeRate = null;
        // @ts-ignore
        this.high = null;
        // @ts-ignore
        this.low = null;
        // @ts-ignore
        this.open = null;
        // @ts-ignore
        this.vol = null;
        // @ts-ignore
        this.volValue = null;
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
    static fromJson(input: string): SymbolSnapshotDataMarketChange1h {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): SymbolSnapshotDataMarketChange1h {
        return plainToClassFromExist(new SymbolSnapshotDataMarketChange1h(), jsonObject);
    }
}
