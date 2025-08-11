<?php


use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Api\DefaultClient;
use KuCoin\UniversalSDK\Common\Logger;
use KuCoin\UniversalSDK\Generate\Unified\UnifiedWs\UnifiedPrivateWs;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\ClientOptionBuilder;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\TransportOptionBuilder;
use KuCoin\UniversalSDK\Model\UnifiedWsArgs;
use KuCoin\UniversalSDK\Model\UnifiedWsMessage;
use KuCoin\UniversalSDK\Model\WebSocketClientOptionBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use React\EventLoop\Loop;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use function React\Async\await;
use function React\Promise\all;


/**
 * Create a Promise that resolves after N seconds.
 */
function waitFor(float $seconds, $result): PromiseInterface
{
    $deferred = new Deferred();

    Loop::get()->addTimer($seconds, function () use ($result, $deferred) {
        $deferred->resolve($result);
    });

    return $deferred->promise();
}

class UnifiedPrivateTest extends TestCase
{
    /**
     * @var UnifiedPrivateWs $unifiedPrivate
     */
    private static $unifiedPrivate;

    /**
     * @var Serializer $serializer
     */
    private static $serializer;

    /**
     * @var Loop $loop
     */
    private static $loop;

    /**
     * @throws Throwable
     */
    public static function setUpBeforeClass(): void
    {
        self::$serializer = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(
                    new JsonSerializedHandler()
                );
            })
            ->build();

        // Retrieve API secret information from environment variables
        $key = getenv('API_KEY') ?: '';
        $secret = getenv('API_SECRET') ?: '';
        $passphrase = getenv('API_PASSPHRASE') ?: '';

        // Optional: Retrieve broker secret information from environment variables; applicable for broker API only
        $brokerName = getenv('BROKER_NAME');
        $brokerKey = getenv('BROKER_KEY');
        $brokerPartner = getenv('BROKER_PARTNER');

        // Set specific options, others will fall back to default values
        $httpTransportOption = (new TransportOptionBuilder())
            ->setKeepAlive(true)
            ->setMaxConnections(10)
            ->build();

        $websocketTransportOption = (new WebSocketClientOptionBuilder())->build();

        // Create a client using the specified options
        $clientOption = (new ClientOptionBuilder())
            ->setKey($key)
            ->setSecret($secret)
            ->setPassphrase($passphrase)
            ->setBrokerName($brokerName)
            ->setBrokerKey($brokerKey)
            ->setBrokerPartner($brokerPartner)
            ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)
            ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)
            ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)
            ->setUnifiedWsEndpoint(Constants::GLOBAL_UNIFIED_WS_API_ENDPOINT)
            ->setTransportOption($httpTransportOption)
            ->setWebSocketClientOption($websocketTransportOption)
            ->build();

        self::$loop = Loop::get();

        $client = new DefaultClient($clientOption, self::$loop);
        $kucoinWsService = $client->wsService();
        self::$unifiedPrivate = $kucoinWsService->newUnifiedPrivateWS();

        register_shutdown_function(function () {
            self::$loop->run();
        });


        await(self::$unifiedPrivate->start()->then(
            function () {
                Logger::info("unified ws started");
            },
            function (Exception $e) {
                Logger::error("Failed to start", ['error' => $e->getMessage()]);
                self::fail($e->getMessage());
            }
        ));
    }

    /**
     * @throws Throwable
     */
    public static function tearDownAfterClass(): void
    {
        await(self::$unifiedPrivate->stop()->then(
            function () {
                Logger::info("unified ws stopped");
                self::$loop->stop();
            },
            function (Exception $e) {
                Logger::error("Failed to stop", ['error' => $e->getMessage()]);
                self::fail($e->getMessage());
            }
        ));
    }


    public function testCall()
    {
        $promises = [];
        for ($i = 0; $i < 5; $i++) {
            $orderParams = [
                'clientOid' => Uuid::uuid4()->toString(),
                'side' => 'buy',
                'symbol' => 'BTC-USDT',
                'type' => 'limit',
                'remark' => 'test',
                'price' => '1',
                'size' => '2'
            ];

            $args = new UnifiedWsArgs();
            $args->id = Uuid::uuid4()->toString();
            $args->op = 'spot.order';
            $args->args = $orderParams;

            $promises[] = self::$unifiedPrivate->unifiedTrading($args)
                ->then(function (UnifiedWsMessage $msg) {
                    Logger::info("add order response", ['response' => $this::$serializer->serialize($msg, 'json')]);

                    self::assertTrue(true);

                    $cancelParams = [
                        'orderId' => $msg->data['orderId'],
                        'symbol' => 'BTC-USDT'
                    ];

                    $cancelArgs = new UnifiedWsArgs();
                    $cancelArgs->id = Uuid::uuid4()->toString();
                    $cancelArgs->op = 'spot.cancel';
                    $cancelArgs->args = $cancelParams;

                    return self::$unifiedPrivate->unifiedTrading($cancelArgs)
                        ->then(function (UnifiedWsMessage $cancelMsg) {
                            Logger::info("cancel order response", ['response' => $this::$serializer->serialize($cancelMsg, 'json')]);
                            return $cancelMsg;
                        });
                })->catch(function ($e) {
                    Logger::error("Failed to call", ['error' => $e->getMessage()]);
                    self::fail($e->getMessage());
                });
        }

        await(all($promises));
    }

}