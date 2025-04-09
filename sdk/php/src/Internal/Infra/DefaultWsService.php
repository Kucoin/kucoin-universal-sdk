<?php


namespace KuCoin\UniversalSDK\Internal\Infra;


use KuCoin\UniversalSDK\Internal\Interfaces\WebSocketService;
use KuCoin\UniversalSDK\Model\ClientOption;

class DefaultWsService implements WebSocketService
{


    public function __construct(ClientOption $option,
                                string       $domainType,
                                bool         $privateChannel,
                                string       $versionString)
    {
    }

    public function start()
    {
        // TODO: Implement start() method.
    }

    public function stop()
    {
        // TODO: Implement stop() method.
    }

    public function subscribe($topicPrefix, array $args, $callback)
    {
        // TODO: Implement subscribe() method.
    }

    public function unsubscribe($id)
    {
        // TODO: Implement unsubscribe() method.
    }
}
