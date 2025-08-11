<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use JMS\Serializer\SerializerInterface;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketHandshake;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketMetaProvider;
use KuCoin\UniversalSDK\Internal\Interfaces\WsParsedMessage;
use KuCoin\UniversalSDK\Internal\Interfaces\WsTokenProvider;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\WebSocketClientOption;
use KuCoin\UniversalSDK\Model\WsMessage;
use Ratchet\Client\WebSocket;

/**
 * Default implementation of WebsocketMetaProvider for standard WebSocket service.
 */
class DefaultWsMetaProvider implements WebsocketMetaProvider
{
    /**
     * @var WsTokenProvider
     */
    private $tokenProvider;

    /**
     * @var WebSocketClientOption
     */
    private $option;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var WsToken|null
     */
    private $tokenInfo;

    /**
     * @param WsTokenProvider $tokenProvider
     * @param WebSocketClientOption $option
     * @param SerializerInterface $serializer
     */
    public function __construct(WsTokenProvider $tokenProvider, WebSocketClientOption $option, SerializerInterface $serializer)
    {
        $this->tokenProvider = $tokenProvider;
        $this->option = $option;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function handshakes(): array
    {
        return [
            $this->createWelcomeHandshake(),
        ];
    }

    /**
     * Creates a handshake handler for the welcome message.
     *
     * @return WebsocketHandshake
     */
    private function createWelcomeHandshake(): WebsocketHandshake
    {
        $provider = $this;

        return new class($provider->serializer) implements WebsocketHandshake {

            private SerializerInterface $serializer;

            public function __construct(SerializerInterface $serializer)
            {
                $this->serializer = $serializer;
            }

            public function invoke(WebSocket $socket, string $text): void
            {
                $data = $this->serializer->deserialize($text, WsMessage::class, 'json');
                switch ($data->type) {
                    case Constants::WS_MESSAGE_TYPE_WELCOME:
                    {
                        Logger::info('Received welcome message: ' . $text);
                        break;
                    }
                    default:
                        throw new \RuntimeException("Unknown WebSocket message type: " . $data->type);

                }
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function parseMessage(string $text): WsParsedMessage
    {
        $data = $this->serializer->deserialize($text, WsMessage::class, 'json');
        return new WsParsedMessage($data->type, $data->id, $data, false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildUri(): string
    {
        $this->tokenInfo = $this->randomEndpoint($this->tokenProvider->getToken());
        if (!$this->tokenInfo) {
            throw new \RuntimeException("No valid WebSocket endpoint found");
        }
        return $this->tokenInfo->endpoint . '?token=' . $this->tokenInfo->token;
    }

    /**
     * Selects a random endpoint from the available servers.
     *
     * @param array $servers
     * @return array|null
     */
    private function randomEndpoint(array $servers)
    {
        if (empty($servers)) {
            return null;
        }

        $index = array_rand($servers);
        return $servers[$index];
    }

    /**
     * {@inheritdoc}
     */
    public function pingInterval(): int
    {
        return $this->tokenInfo->pingInterval;
    }

    /**
     * {@inheritdoc}
     */
    public function pingTimeout(): int
    {
        return $this->tokenInfo->pingTimeout;
    }

    /**
     * {@inheritdoc}
     */
    public function pingMessage(): array
    {
        $pingMsg = new WsMessage();
        $pingMsg->id = uniqid('', true);
        $pingMsg->type = Constants::WS_MESSAGE_TYPE_PING;

        return [$pingMsg->id, $pingMsg];
    }

    /**
     * {@inheritdoc}
     */
    public function close(): void
    {
        // No resources to release
    }
}