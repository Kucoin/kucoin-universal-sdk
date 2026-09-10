import { SpotPublicWS } from '@generate/spot/spotpublic';
import { SpotPrivateWS } from '@generate/spot/spotprivate';
import { MarginPublicWS } from '@generate/margin/marginpublic';
import { MarginPrivateWS } from '@generate/margin/marginprivate';
import { FuturesPublicWS } from '@generate/futures/futurespublic';
import { FuturesPrivateWS } from '@generate/futures/futuresprivate';
import { UtaPublicWS } from '@generate/uta/publicws';
import { UtaPrivateTradeWS, UtaPrivateWS } from '@generate/uta/privatews';
import { PushTradeType } from '@model/push_trade_type';

export interface KucoinWSService {
    /**
     * Returns the interface to interact with the Spot Trading WebSocket (public channel) API of KuCoin.
     */
    newSpotPublicWS(): SpotPublicWS;

    /**
     * Returns the interface to interact with the Spot Trading WebSocket (private channel) API of KuCoin.
     */
    newSpotPrivateWS(): SpotPrivateWS;

    /**
     * Returns the interface to interact with the Margin Trading WebSocket (public channel) API of KuCoin.
     */
    newMarginPublicWS(): MarginPublicWS;

    /**
     * Returns the interface to interact with the Margin Trading WebSocket (private channel) API of KuCoin.
     */
    newMarginPrivateWS(): MarginPrivateWS;

    /**
     * Returns the interface to interact with the Futures Trading WebSocket (public channel) API of KuCoin.
     */
    newFuturesPublicWS(): FuturesPublicWS;

    /**
     * Returns the interface to interact with the Futures Trading WebSocket (private channel) API of KuCoin.
     */
    newFuturesPrivateWS(): FuturesPrivateWS;

    /** Returns a direct UTA public push WebSocket for Spot or Futures. */
    newUtaPublicWS(tradeType: PushTradeType): UtaPublicWS;

    /** Returns the authenticated direct UTA private push WebSocket. */
    newUtaPrivateWS(): UtaPrivateWS;

    /** Returns the authenticated direct UTA trading WebSocket. */
    newUtaPrivateTradeWS(): UtaPrivateTradeWS;
}
