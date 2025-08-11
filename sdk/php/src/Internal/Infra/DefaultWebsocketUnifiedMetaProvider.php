<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;
use JMS\Serializer\SerializerInterface;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketHandshake;
use KuCoin\UniversalSDK\Internal\Interfaces\WebsocketMetaProvider;
use KuCoin\UniversalSDK\Internal\Interfaces\WsParsedMessage;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\UnifiedWsMessage;
use Ratchet\Client\WebSocket;

/**
 * Implementation of WebsocketMetaProvider for the unified WebSocket API.
 */
class DefaultWebsocketUnifiedMetaProvider implements WebsocketMetaProvider
{
    /**
     * @var ClientOption
     */
    private $clientOption;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var KcSigner
     */
    private $signer;

    /**
     * @var int
     */
    private $pingInterval = 30000; // Default ping interval in milliseconds

    /**
     * @var int
     */
    private $pingTimeout = 10000; // Default ping timeout in milliseconds

    /**
     * @param ClientOption $clientOption
     * @param SerializerInterface $serializer
     */
    public function __construct(ClientOption $clientOption, SerializerInterface $serializer)
    {
        $this->clientOption = $clientOption;
        $this->serializer = $serializer;
        $this->signer = new KcSigner(
            $clientOption->key,
            $clientOption->secret,
            $clientOption->passphrase
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function handshakes(): array
    {
        return [
            $this->createAuthHandshake(),
            $this->createWelcomeHandshake()
        ];
    }

    /**
     * Create the authentication handshake handler
     * 
     * @return WebsocketHandshake
     */
    private function createAuthHandshake(): WebsocketHandshake
    {
        $signer = $this->signer;
        $secret = $this->clientOption->secret;
        $serializer = $this->serializer;
        
        return new class($signer, $secret, $serializer) implements WebsocketHandshake {
            private $signer;
            private $secret;
            private $serializer;
            
            public function __construct(KcSigner $signer, string $secret, SerializerInterface $serializer)
            {
                $this->signer = $signer;
                $this->secret = $secret;
                $this->serializer = $serializer;
            }
            
            public function invoke(WebSocket $socket, string $text): void
            {
                Logger::info('Received auth message: ' . $text);
                $data = $this->serializer->deserialize($text, 'array', 'json');
                
                if (isset($data['code']) && $data['code'] !== Constants::RESULT_CODE_SUCCESS) {
                    throw new Exception('Expected auth success, but got: ' . $text);
                }
                
                // Sign the message using the KcSigner
                $signature = $this->signer->sign($text, $this->secret);
                $socket->send($signature);
            }
        };
    }

    /**
     * Create the welcome message handshake handler
     * 
     * @return WebsocketHandshake
     */
    private function createWelcomeHandshake(): WebsocketHandshake
    {
        $provider = $this;

        $serializer = $this->serializer;
        
        return new class($provider, $serializer) implements WebsocketHandshake {
            private $provider;

            private $serializer;

            public function __construct(DefaultWebsocketUnifiedMetaProvider $provider, SerializerInterface $serializer)
            {
                $this->provider = $provider;
                $this->serializer = $serializer;
            }
            
            public function invoke(WebSocket $socket, string $text): void
            {
                $data = $this->serializer->deserialize($text, 'array', 'json');
                
                if (!isset($data['data']) || $data['data'] !== Constants::WS_MESSAGE_TYPE_WELCOME) {
                    throw new Exception('Expected welcome message, but got: ' . $text);
                }
                
                Logger::info('Received welcome message: ' . $text);
                
                // Store ping interval and timeout if provided
                if (isset($data['pingInterval'])) {
                    $this->provider->setPingInterval((int)$data['pingInterval']);
                }
                
                if (isset($data['pingTimeout'])) {
                    $this->provider->setPingTimeout((int)$data['pingTimeout']);
                }
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    public function parseMessage(string $text): WsParsedMessage
    {
        // @var UnifiedWsMessage
        $message = $this->serializer->deserialize($text, UnifiedWsMessage::class, 'json');
        
        $type = '';
        $ack = false;

        switch ($message->op) {
            case Constants::WS_MESSAGE_TYPE_PONG:
                $type = Constants::WS_MESSAGE_TYPE_PONG;
                break;
            default:
                $type = Constants::WS_MESSAGE_TYPE_MESSAGE;
                $ack = true;
                break;
        }

        return new WsParsedMessage($type, $message->id ?? '', $message, $ack);
    }

    /**
     * {@inheritdoc}
     */
    public function buildUri(): string
    {
        $timestamp = time() * 1000;
        $endpoint = $this->clientOption->unifiedWsEndpoint;
        
        if (empty($endpoint)) {
            throw new Exception('Missing unified WebSocket endpoint');
        }
        
        $uri = $endpoint . '/v1/private?';
        
        // Create signature using the sign method
        $sign = $this->signer->sign($this->clientOption->key . $timestamp, $this->clientOption->secret);
        $passphrase = $this->signer->sign($this->clientOption->passphrase, $this->clientOption->secret);
        
        $params = [
            'apikey' => $this->clientOption->key,
            'sign' => $sign,
            'passphrase' => $passphrase,
            'timestamp' => (string)$timestamp
        ];
        
        $queryString = http_build_query($params);
        
        return $uri . $queryString;
    }

    /**
     * {@inheritdoc}
     */
    public function pingInterval(): int
    {
        return $this->pingInterval;
    }

    /**
     * {@inheritdoc}
     */
    public function pingTimeout(): int
    {
        return $this->pingTimeout;
    }

    /**
     * {@inheritdoc}
     */
    public function pingMessage(): array
    {
        $id = uniqid('ping-', true);
        $ping = [
            'id' => $id,
            'op' => 'ping',
            'timestamp' => (string)(time() * 1000)
        ];
        
        return [$id, $ping];
    }

    /**
     * {@inheritdoc}
     */
    public function close(): void
    {
        // No resources to release
    }
    
    /**
     * Set the ping interval
     * 
     * @param int $interval Ping interval in milliseconds
     */
    public function setPingInterval(int $interval): void
    {
        $this->pingInterval = $interval;
    }
    
    /**
     * Set the ping timeout
     * 
     * @param int $timeout Ping timeout in milliseconds
     */
    public function setPingTimeout(int $timeout): void
    {
        $this->pingTimeout = $timeout;
    }
}