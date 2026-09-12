<?php

namespace KuCoin\UniversalSDK\Internal\Ws;

use KuCoin\UniversalSDK\Api\KucoinWSService;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPrivate\FuturesPrivateWs;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPrivate\FuturesPrivateWsImpl;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPublic\FuturesPublicWs;
use KuCoin\UniversalSDK\Generate\Futures\FuturesPublic\FuturesPublicWsImpl;
use KuCoin\UniversalSDK\Generate\Margin\MarginPrivate\MarginPrivateWs;
use KuCoin\UniversalSDK\Generate\Margin\MarginPrivate\MarginPrivateWsImpl;
use KuCoin\UniversalSDK\Generate\Margin\MarginPublic\MarginPublicWs;
use KuCoin\UniversalSDK\Generate\Margin\MarginPublic\MarginPublicWsImpl;
use KuCoin\UniversalSDK\Generate\Spot\SpotPrivate\SpotPrivateWs;
use KuCoin\UniversalSDK\Generate\Spot\SpotPrivate\SpotPrivateWsImpl;
use KuCoin\UniversalSDK\Generate\Spot\SpotPublic\SpotPublicWs;
use KuCoin\UniversalSDK\Generate\Spot\SpotPublic\SpotPublicWsImpl;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateTradeWs;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateTradeWsImpl;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateWs;
use KuCoin\UniversalSDK\Generate\Uta\PrivateWs\UtaPrivateWsImpl;
use KuCoin\UniversalSDK\Generate\Uta\PublicWs\UtaPublicWs;
use KuCoin\UniversalSDK\Generate\Uta\PublicWs\UtaPublicWsImpl;
use KuCoin\UniversalSDK\Generate\Version;
use KuCoin\UniversalSDK\Internal\Infra\DefaultWsService;
use KuCoin\UniversalSDK\Internal\Infra\UtaPrivateTradeWsService;
use KuCoin\UniversalSDK\Internal\Infra\UtaPushWsService;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\Constants;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class DefaultKucoinWsImpl implements KucoinWSService
{
    /**
     * @var ClientOption $clientOption
     */
    private $clientOption;


    /**
     * @var LoopInterface $loop
     */
    private $loop;

    public function __construct(ClientOption $clientOption, ?LoopInterface $loop = null)
    {
        $this->clientOption = $clientOption;
        $this->loop = $loop ?: Loop::get();
    }

    public function startEventLoop()
    {
        $this->loop->run();
    }

    public function stopEventLoop()
    {
        $this->loop->stop();
    }

    public function getLoop(): LoopInterface
    {
        return $this->loop;
    }


    public function newSpotPublicWS(): SpotPublicWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,
            Constants::DOMAIN_TYPE_SPOT,
            false,
            Version::SDK_VERSION);

        return new SpotPublicWsImpl($wsService);
    }

    public function newSpotPrivateWS(): SpotPrivateWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,

            Constants::DOMAIN_TYPE_SPOT,
            true,
            Version::SDK_VERSION);

        return new SpotPrivateWsImpl($wsService);
    }

    public function newMarginPublicWS(): MarginPublicWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,
            Constants::DOMAIN_TYPE_SPOT,
            false,
            Version::SDK_VERSION);

        return new MarginPublicWsImpl($wsService);
    }

    public function newMarginPrivateWS(): MarginPrivateWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,
            Constants::DOMAIN_TYPE_SPOT,
            true,
            Version::SDK_VERSION);

        return new MarginPrivateWsImpl($wsService);
    }

    public function newFuturesPublicWS(): FuturesPublicWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,
            Constants::DOMAIN_TYPE_FUTURES,
            false,
            Version::SDK_VERSION);

        return new FuturesPublicWsImpl($wsService);
    }

    public function newFuturesPrivateWS(): FuturesPrivateWs
    {
        $wsService = new DefaultWsService(
            $this->clientOption,
            $this->loop,
            Constants::DOMAIN_TYPE_FUTURES,
            true,
            Version::SDK_VERSION);

        return new FuturesPrivateWsImpl($wsService);
    }

    public function newUtaPublicWS(string $tradeType): UtaPublicWs
    {
        return new UtaPublicWsImpl(
            new UtaPushWsService($this->clientOption, $this->loop, false, $tradeType),
            $tradeType
        );
    }

    public function newUtaPrivateWS(): UtaPrivateWs
    {
        return new UtaPrivateWsImpl(new UtaPushWsService($this->clientOption, $this->loop, true));
    }

    public function newUtaPrivateTradeWS(): UtaPrivateTradeWs
    {
        return new UtaPrivateTradeWsImpl(new UtaPrivateTradeWsService($this->clientOption, $this->loop));
    }
}
