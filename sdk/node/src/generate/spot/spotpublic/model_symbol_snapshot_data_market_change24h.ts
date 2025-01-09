// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { WsMessage } from '@model/common';
import { WebSocketMessageCallback } from '@internal/interfaces/websocket';
import { Serializable } from '@internal/interfaces/serializable';

export class SymbolSnapshotDataMarketChange24h
    implements Serializable<SymbolSnapshotDataMarketChange24h>
{
    /**
     *
     */
    changePrice?: number;
    /**
     *
     */
    changeRate?: number;
    /**
     *
     */
    high?: number;
    /**
     *
     */
    low?: number;
    /**
     *
     */
    open?: number;
    /**
     *
     */
    vol?: number;
    /**
     *
     */
    volValue?: number;

    fromJson(input: string): SymbolSnapshotDataMarketChange24h {
        const jsonObject = JSON.parse(input);
        return plainToInstance(SymbolSnapshotDataMarketChange24h, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): SymbolSnapshotDataMarketChange24h {
        return plainToInstance(SymbolSnapshotDataMarketChange24h, jsonObject);
    }
}