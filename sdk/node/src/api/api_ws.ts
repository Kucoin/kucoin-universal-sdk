import { SpotPublicWS } from '@generate/spot/spotpublic';
import { SpotPrivateWS } from '@generate/spot/spotprivate';
import { MarginPublicWS } from '@generate/margin/marginpublic';
import { MarginPrivateWS } from '@generate/margin/marginprivate';
import { FuturesPublicWS } from '@generate/futures/futurespublic';
import { FuturesPrivateWS } from '@generate/futures/futuresprivate';
import { UnifiedPrivateWS } from '@generate/unified/unifiedws';

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

    /**
     * Returns the interface to interact with the Unified Trading WebSocket (private) API of KuCoin.
     */
    newUnifiedPrivateWS(): UnifiedPrivateWS;
}
