// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, Exclude, plainToClassFromExist } from 'class-transformer';
import { WsMessage } from '@model/common';
import { WebSocketMessageCallback } from '@internal/interfaces/websocket';
import { Response } from '@internal/interfaces/serializable';

export class StopOrderEvent implements Response<WsMessage> {
    /**
     * Order created time (milliseconds)
     */
    createdAt: number;
    /**
     * The unique order id generated by the trading system
     */
    orderId: string;
    /**
     * Price
     */
    orderPrice: string;
    /**
     * User-specified order type
     */
    orderType: StopOrderEvent.OrderTypeEnum;
    /**
     * buy or sell
     */
    side: StopOrderEvent.SideEnum;
    /**
     * User-specified order size
     */
    size: string;
    /**
     * Order type
     */
    stop: StopOrderEvent.StopEnum;
    /**
     * Stop Price
     */
    stopPrice: string;
    /**
     * symbol
     */
    symbol: string;
    /**
     * The type of trading: TRADE (Spot), MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
     */
    tradeType: StopOrderEvent.TradeTypeEnum;
    /**
     * Push time (nanoseconds)
     */
    ts: number;
    /**
     * Order Type
     */
    type: StopOrderEvent.TypeEnum;

    private constructor() {
        // @ts-ignore
        this.createdAt = null;
        // @ts-ignore
        this.orderId = null;
        // @ts-ignore
        this.orderPrice = null;
        // @ts-ignore
        this.orderType = null;
        // @ts-ignore
        this.side = null;
        // @ts-ignore
        this.size = null;
        // @ts-ignore
        this.stop = null;
        // @ts-ignore
        this.stopPrice = null;
        // @ts-ignore
        this.symbol = null;
        // @ts-ignore
        this.tradeType = null;
        // @ts-ignore
        this.ts = null;
        // @ts-ignore
        this.type = null;
    }
    /**
     * common response
     */
    @Exclude()
    commonResponse?: WsMessage;

    setCommonResponse(response: WsMessage): void {
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
    static fromJson(input: string): StopOrderEvent {
        return this.fromObject(JSON.parse(input));
    }
    /**
     * Create an object from Js Object.
     */
    static fromObject(jsonObject: Object): StopOrderEvent {
        return plainToClassFromExist(new StopOrderEvent(), jsonObject);
    }
}

export namespace StopOrderEvent {
    export enum OrderTypeEnum {
        /**
         * stop
         */
        STOP = <any>'stop',
    }
    export enum SideEnum {
        /**
         * buy
         */
        BUY = <any>'buy',
        /**
         * sell
         */
        SELL = <any>'sell',
    }
    export enum StopEnum {
        /**
         * stop loss order
         */
        LOSS = <any>'loss',
        /**
         * Take profit order
         */
        ENTRY = <any>'entry',
        /**
         * Limit stop loss OCO order
         */
        L_L_O = <any>'l_l_o',
        /**
         * Trigger stop loss OCO order
         */
        L_S_O = <any>'l_s_o',
        /**
         * Limit stop profit OCO order
         */
        E_L_O = <any>'e_l_o',
        /**
         * Trigger stop profit OCO order
         */
        E_S_O = <any>'e_s_o',
        /**
         * Moving stop loss order
         */
        TSO = <any>'tso',
    }
    export enum TradeTypeEnum {
        /**
         * Spot
         */
        TRADE = <any>'TRADE',
        /**
         * Spot margin trade
         */
        MARGIN_TRADE = <any>'MARGIN_TRADE',
        /**
         * Spot margin isolated trade
         */
        MARGIN_ISOLATED_TRADE = <any>'MARGIN_ISOLATED_TRADE',
    }
    export enum TypeEnum {
        /**
         * The order is in the order book (maker order)
         */
        OPEN = <any>'open',
        /**
         * The message sent when the order is matched, 1. When the status is open and the type is match, it is a maker match.  2. When the status is match and the type is match, it is a taker match.
         */
        MATCH = <any>'match',
        /**
         * The message sent due to the order being modified: STP triggering, partial cancellation of the order. Includes these three scenarios:  1. When the status is open and the type is update: partial amounts of the order have been canceled, or STP triggers  2. When the status is match and the type is update: STP triggers  3. When the status is done and the type is update: partial amounts of the order have been filled and the unfilled part got canceled, or STP is triggered.
         */
        UPDATE = <any>'update',
        /**
         * The message sent when the status of the order changes to DONE after the transaction
         */
        FILLED = <any>'filled',
        /**
         * The message sent when the status of the order changes to DONE due to being canceled
         */
        CANCEL = <any>'cancel',
        /**
         * The message sent when the order enters the matching system. When the order has just entered the matching system and has not yet done matching logic with the counterparty, a private message with the message type &quot;received&quot; and the order status &quot;new&quot; will be pushed.
         */
        RECEIVED = <any>'received',
    }
}

export type StopOrderEventCallback = (topic: string, subject: string, data: StopOrderEvent) => void;

export class StopOrderEventCallbackWrapper implements WebSocketMessageCallback {
    constructor(private callback: StopOrderEventCallback) {
        this.callback = callback;
    }

    onMessage(msg: WsMessage): void {
        let event = StopOrderEvent.fromObject(msg.data);
        event.setCommonResponse(msg);
        this.callback(msg.topic, msg.subject, event);
    }
}
