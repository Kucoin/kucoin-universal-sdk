<?php

namespace KuCoin\UniversalSDK\Api;

use KuCoin\UniversalSDK\Generate\Futures\FuturesPrivate\FuturesPrivateWs;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPublic\FuturesPublicWs;
use KuCoin\UniversalSDK\Generate\Margin\MarginPrivate\MarginPrivateWs;
use KuCoin\UniversalSDK\Generate\Margin\MarginPublic\MarginPublicWs;
use KuCoin\UniversalSDK\Generate\Spot\SpotPrivate\SpotPrivateWs;
use KuCoin\UniversalSDK\Generate\Spot\SpotPublic\SpotPublicWs;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateTradeWs;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateWs;
use KuCoin\UniversalSDK\Generate\Uta\PublicWs\UtaPublicWs;
use React\EventLoop\LoopInterface;

/**
 * KucoinWSService provides WebSocket interfaces for Spot, Margin, and Futures trading.
 */
interface KucoinWSService
{
    /**
     * Starts the shared event loop to begin processing asynchronous WebSocket events.
     * Should be called once after all desired WebSocket clients are started.
     */
    public function startEventLoop();

    /**
     * Stops the shared event loop and halts all asynchronous event processing.
     */
    public function stopEventLoop();

    /**
     * Returns the shared ReactPHP event loop used by all WebSocket clients.
     *
     * @return LoopInterface
     */
    public function getLoop(): LoopInterface;

    /**
     * Returns the interface to interact with the Spot Trading WebSocket (public channel) API of KuCoin.
     *
     * @return SpotPublicWS
     */
    public function newSpotPublicWS(): SpotPublicWS;

    /**
     * Returns the interface to interact with the Spot Trading WebSocket (private channel) API of KuCoin.
     *
     * @return SpotPrivateWS
     */
    public function newSpotPrivateWS(): SpotPrivateWS;

    /**
     * Returns the interface to interact with the Margin Trading WebSocket (public channel) API of KuCoin.
     *
     * @return MarginPublicWS
     */
    public function newMarginPublicWS(): MarginPublicWS;

    /**
     * Returns the interface to interact with the Margin Trading WebSocket (private channel) API of KuCoin.
     *
     * @return MarginPrivateWS
     */
    public function newMarginPrivateWS(): MarginPrivateWS;

    /**
     * Returns the interface to interact with the Futures Trading WebSocket (public channel) API of KuCoin.
     *
     * @return FuturesPublicWS
     */
    public function newFuturesPublicWS(): FuturesPublicWS;

    /**
     * Returns the interface to interact with the Futures Trading WebSocket (private channel) API of KuCoin.
     *
     * @return FuturesPrivateWS
     */
    public function newFuturesPrivateWS(): FuturesPrivateWS;

    /** Creates a direct UTA public push WebSocket for SPOT or FUTURES. */
    public function newUtaPublicWS(string $tradeType): UtaPublicWs;

    /** Creates an authenticated direct UTA private push WebSocket. */
    public function newUtaPrivateWS(): UtaPrivateWs;

    /** Creates an authenticated direct UTA order WebSocket (uta.order/cancel/amend). */
    public function newUtaPrivateTradeWS(): UtaPrivateTradeWs;
}
