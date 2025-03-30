<?php

namespace KuCoin\UniversalSDK\Api;

use KuCoin\UniversalSDK\Generate\Spot\SpotPublicWS;
use KuCoin\UniversalSDK\Generate\Spot\SpotPrivateWS;
use KuCoin\UniversalSDK\Generate\Margin\MarginPublicWS;
use KuCoin\UniversalSDK\Generate\Margin\MarginPrivateWS;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPublicWS;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPrivateWS;

/**
 * KucoinWSService provides WebSocket interfaces for Spot, Margin, and Futures trading.
 */
interface KucoinWSService
{
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
}
