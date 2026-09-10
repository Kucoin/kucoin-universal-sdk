import {
    UtaPushCallback,
    UtaPushEvent,
    UtaPushSubscription,
    UtaPushWsService,
    UtaWsValue,
} from '@internal/infra/uta_push_ws_service';

export enum ExecutionLiteTradeType {
    SPOT = 'SPOT',
    ISOLATED = 'ISOLATED',
    CROSS = 'CROSS',
    FUTURES = 'FUTURES',
    UNIFIED = 'UNIFIED',
}

export enum BalanceAccountType {
    UNIFIED = 'UNIFIED',
    FUNDING = 'FUNDING',
    ISOLATED = 'ISOLATED',
}

export type UtaPrivateEvent<T extends Record<string, UtaWsValue> = Record<string, UtaWsValue>> =
    UtaPushEvent<T>;
export type ExecutionEvent = UtaPrivateEvent;
export type ExecutionLiteEvent = UtaPrivateEvent;
export type OrderEvent = UtaPrivateEvent;
export type BalanceEvent = UtaPrivateEvent;
export type PositionEvent = UtaPrivateEvent;
export type LeverageEvent = UtaPrivateEvent;
export type LiquidationWarningEvent = UtaPrivateEvent;
export type UtaPrivateEventCallback<
    T extends Record<string, UtaWsValue> = Record<string, UtaWsValue>,
> = (event: UtaPrivateEvent<T>) => void | Promise<void>;

/** Direct UTA private push WebSocket API. */
export interface UtaPrivateWS {
    execution(callback: UtaPrivateEventCallback): Promise<string>;
    executionLite(
        tradeType: ExecutionLiteTradeType | string,
        callback: UtaPrivateEventCallback,
    ): Promise<string>;
    orderAll(callback: UtaPrivateEventCallback): Promise<string>;
    order(symbol: string, callback: UtaPrivateEventCallback): Promise<string>;
    balance(
        accountType: BalanceAccountType | string,
        callback: UtaPrivateEventCallback,
    ): Promise<string>;
    positionAll(callback: UtaPrivateEventCallback): Promise<string>;
    position(symbol: string, callback: UtaPrivateEventCallback): Promise<string>;
    leverage(callback: UtaPrivateEventCallback): Promise<string>;
    liquidationWarning(callback: UtaPrivateEventCallback): Promise<string>;
    unSubscribe(id: string): Promise<void>;
    start(): Promise<void>;
    stop(): Promise<void>;
}

export class UtaPrivateWSImpl implements UtaPrivateWS {
    constructor(private readonly wsService: UtaPushWsService) {}

    execution(callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'execution', tradeType: 'UNIFIED', callback });
    }

    executionLite(
        tradeType: ExecutionLiteTradeType | string,
        callback: UtaPrivateEventCallback,
    ): Promise<string> {
        return this.subscribe({ channel: 'execution.lite', tradeType, callback });
    }

    orderAll(callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'orderAll', tradeType: 'UNIFIED', callback });
    }

    order(symbol: string, callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'order', tradeType: 'UNIFIED', symbol, callback });
    }

    balance(
        accountType: BalanceAccountType | string,
        callback: UtaPrivateEventCallback,
    ): Promise<string> {
        return this.subscribe({ channel: 'balance', accountType, callback });
    }

    positionAll(callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'positionAll', tradeType: 'UNIFIED', callback });
    }

    position(symbol: string, callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'position', tradeType: 'UNIFIED', symbol, callback });
    }

    leverage(callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'leverage', tradeType: 'UNIFIED', callback });
    }

    liquidationWarning(callback: UtaPrivateEventCallback): Promise<string> {
        return this.subscribe({ channel: 'lw', tradeType: 'UNIFIED', callback });
    }

    unSubscribe(id: string): Promise<void> {
        return this.wsService.unsubscribe(id);
    }

    start(): Promise<void> {
        return this.wsService.start();
    }

    stop(): Promise<void> {
        return this.wsService.stop();
    }

    private subscribe(subscription: UtaPushSubscription): Promise<string> {
        return this.wsService.subscribe({
            ...subscription,
            callback: subscription.callback as UtaPushCallback,
        });
    }
}
