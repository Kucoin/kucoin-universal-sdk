// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { Type, instanceToPlain, Exclude, plainToInstance } from 'class-transformer';
import { AccountRelationContext } from './model_account_relation_context';
import { WsMessage } from '@model/common';
import { WebSocketMessageCallback } from '@internal/interfaces/websocket';
import { Response } from '@internal/interfaces/response';

export class AccountEvent implements Response<AccountEvent, WsMessage> {
    /**
     * Account ID
     */
    accountId?: string;
    /**
     * Funds available to withdraw or trade
     */
    available?: string;
    /**
     * The change of available Funds
     */
    availableChange?: string;
    /**
     * currency
     */
    currency?: string;
    /**
     * Funds on hold (not available for use)
     */
    hold?: string;
    /**
     * The change of hold funds
     */
    holdChange?: string;
    /**
     *
     */
    relationContext?: AccountRelationContext;
    /**
     * Relation event
     */
    relationEvent?: string;
    /**
     * Relation event Id
     */
    relationEventId?: string;
    /**
     *
     */
    time?: string;
    /**
     * Total balance = available + hold
     */
    total?: string;

    /**
     * common response
     */
    @Exclude()
    private commonResponse?: WsMessage;

    setCommonResponse(response: WsMessage): void {
        this.commonResponse = response;
    }

    fromJson(input: string): AccountEvent {
        const jsonObject = JSON.parse(input);
        return plainToInstance(AccountEvent, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): AccountEvent {
        return plainToInstance(AccountEvent, jsonObject);
    }
}

export type AccountEventCallback = (topic: string, subject: string, data: AccountEvent) => void;

export class AccountEventCallbackWrapper implements WebSocketMessageCallback {
    constructor(private callback: AccountEventCallback) {
        this.callback = callback;
    }

    onMessage(msg: WsMessage): void {
        let event = new AccountEvent().fromObject(msg.rawData);
        event.setCommonResponse(msg);
        this.callback(msg.topic, msg.subject, event);
    }
}