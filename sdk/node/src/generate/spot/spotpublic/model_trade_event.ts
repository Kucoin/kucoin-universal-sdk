// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { WsMessage } from '@model/common';
import { WebSocketMessageCallback } from '@internal/interfaces/websocket';
import { Response } from '@internal/interfaces/response';

export class TradeEvent implements Response<TradeEvent, WsMessage> {
    /**
     *
     */
    makerOrderId?: string;
    /**
     *
     */
    price?: string;
    /**
     *
     */
    sequence?: string;
    /**
     *
     */
    side?: string;
    /**
     *
     */
    size?: string;
    /**
     *
     */
    symbol?: string;
    /**
     *
     */
    takerOrderId?: string;
    /**
     *
     */
    time?: string;
    /**
     *
     */
    tradeId?: string;
    /**
     *
     */
    type?: string;

    /**
     * common response
     */
    @Exclude()
    private commonResponse?: WsMessage;

    setCommonResponse(response: WsMessage): void {
        this.commonResponse = response;
    }

    fromJson(input: string): TradeEvent {
        const jsonObject = JSON.parse(input);
        return plainToInstance(TradeEvent, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): TradeEvent {
        return plainToInstance(TradeEvent, jsonObject);
    }
}

export type TradeEventCallback = (topic: string, subject: string, data: TradeEvent) => void;

export class TradeEventCallbackWrapper implements WebSocketMessageCallback {
    constructor(private callback: TradeEventCallback) {
        this.callback = callback;
    }

    onMessage(msg: WsMessage): void {
        let event = new TradeEvent().fromObject(msg.rawData);
        event.setCommonResponse(msg);
        this.callback(msg.topic, msg.subject, event);
    }
}