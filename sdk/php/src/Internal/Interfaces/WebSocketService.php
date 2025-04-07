<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

interface WebSocketService
{
    /**
     * Starts the WebSocket service and handles incoming WebSocket messages.
     *
     * @return \Exception|null Exception if an error occurs, otherwise null.
     */
    public function start();

    /**
     * Stops the WebSocket service.
     *
     * @return \Exception|null Exception if an error occurs, otherwise null.
     */
    public function stop();

    /**
     * Subscribes to a topic with a provided message callback.
     *
     * @param string $topicPrefix The topic to subscribe to
     * @param string[] $args Arguments for the subscription
     * @param WebSocketMessageCallback $callback A callback for handling messages on this topic
     * @return string Subscription ID
     */
    public function subscribe($topicPrefix, array $args, $callback);

    /**
     * Unsubscribes from a topic.
     *
     * @param string $id The subscription ID
     * @return \Exception|null Exception if an error occurs, otherwise null.
     */
    public function unsubscribe($id);
}
