<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\CurlMultiHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InvalidArgumentException;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Interfaces\Request;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Internal\Interfaces\Transport;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\RestError;
use KuCoin\UniversalSDK\Model\RestRateLimit;
use KuCoin\UniversalSDK\Model\RestResponse;
use KuCoin\UniversalSDK\Model\TransportOption;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use RuntimeException;

class DefaultTransport implements Transport
{
    /** @var ClientOption $option */
    private $option;

    /** @var string $version */
    private $version;

    /** @var TransportOption $transportOption */
    private $transportOption;

    /** @var KcSigner $signer */
    private $signer;

    /** @var Client $httpClient */
    private $httpClient;

    /** @var Serializer $serializer */
    private $serializer;

    public function __construct(ClientOption $option, $version)
    {
        $this->option = $option;
        $this->version = $version;
        $this->transportOption = $option->transportOption ?: new TransportOption();

        $this->signer = new KcSigner(
            $option->key,
            $option->secret,
            $option->passphrase,
            $option->brokerName,
            $option->brokerPartner,
            $option->brokerKey
        );

        $this->httpClient = $this->createHttpClient($this->transportOption);
        $this->serializer = SerializerBuilder::create()->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(new JsonSerializedHandler());
            })->build();
    }

    private function createHttpClient(TransportOption $option): Client
    {
        $handlerOptions = [];
        if ($option->maxConnections > 0) {
            $handlerOptions['max_connections'] = $option->maxConnections;
        }

        $handler = new CurlMultiHandler($handlerOptions);
        $handlerStack = HandlerStack::create($handler);

        // Interceptors
        foreach ($option->interceptors as $interceptor) {
            if (method_exists($interceptor, 'middleware')) {
                $handlerStack->push($interceptor->middleware());
            }
        }

        // Retry middleware
        if ($option->maxRetries > 0) {
            $handlerStack->push(Middleware::retry(
                function ($retries, $request, $response, $exception) use ($option) {
                    if ($retries >= $option->maxRetries) return false;
                    if ($exception instanceof ConnectException) return true;
                    if ($response && $response->getStatusCode() >= 500) return true;
                    return false;
                },
                function () use ($option) {
                    return $option->retryDelay * 1000;
                }
            ));
        }

        $config = [
            'handler' => $handlerStack,
            'timeout' => $option->readTimeout,
            'connect_timeout' => $option->connectTimeout,
            'headers' => [
                'Connection' => $option->keepAlive ? 'keep-alive' : 'close',
            ],
        ];

        // Proxy support
        if (is_array($option->proxy)) {
            $proxyParts = [];
            if (isset($option->proxy['http'])) {
                $proxyParts['http'] = $option->proxy['http'];
            }
            if (isset($option->proxy['https'])) {
                $proxyParts['https'] = $option->proxy['https'];
            }
            if (!empty($proxyParts)) {
                $config['proxy'] = $proxyParts;
            }
        }

        return new Client($config);
    }

    /**
     * @param string $path
     * @param Request $requestObj
     * @return mixed
     */
    private function processPathVariable($path, $requestObj)
    {
        if (!$requestObj) {
            return [$path, []];
        }

        $pathVarMapping = $requestObj->pathVarMapping();
        $pathVarFields = [];

        return [preg_replace_callback('/{(.*?)}/', function ($matches) use ($pathVarMapping, &$pathVarFields, &$requestObj) {
            $key = $matches[1];
            if (!array_key_exists($key, $pathVarMapping)) {
                throw new RuntimeException("Path variable '{$key}' is not defined in pathVarMapping");
            }

            $fieldName = $pathVarMapping[$key];
            $ref = new ReflectionClass($requestObj);
            $prop = $ref->getProperty($fieldName);
            $prop->setAccessible(true);
            $value = $prop->getValue($requestObj);
            $pathVarFields[$fieldName] = $key;

            return urlencode($value);
        }, $path), $pathVarFields];
    }


    private function processHeaders($body, $rawUrl, array &$headers, $method, $broker)
    {
        $payload = $method . $rawUrl . ($body ?: '');
        $signedHeaders = $broker
            ? $this->signer->brokerHeaders($payload)
            : $this->signer->headers($payload);

        $headers = array_merge($headers, $signedHeaders);
    }

    private function processRequest(
        $requestObj,
        $broker,
        $path,
        $pathVarFields,
        $endpoint,
        $method,
        $requestAsJson
    )
    {
        $rawPath = $path;
        $body = '';
        $headers = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'Kucoin-Universal-PHP-SDK/' . $this->version,
        ];

        if (!$requestAsJson && ($method === 'GET' || $method === 'DELETE')) {
            $queryParts = [];
            $rawParts = [];

            if ($requestObj) {
                foreach ((array)$requestObj as $k => $v) {
                    if ($v === null) {
                        continue;
                    }

                    if (array_key_exists($k, $pathVarFields)) {
                        continue;
                    }

                    $queryParts[] = urlencode($k) . '=' . urlencode($v);
                    $rawParts[] = $k . '=' . $v;
                }

                if (!empty($queryParts)) {
                    $path .= '?' . implode('&', $queryParts);
                    $rawPath .= '?' . implode('&', $rawParts);
                }
            }
        } elseif ($method === 'POST' && $requestObj) {
            $body = $requestObj->jsonSerialize($this->serializer);
        }

        $fullUrl = $endpoint . $path;
        $this->processHeaders($body, $rawPath, $headers, $method, $broker);

        return [
            'method' => strtoupper($method),
            'url' => $fullUrl,
            'headers' => $headers,
            'body' => $body,
        ];
    }

    /**
     * @param ResponseInterface $response
     * @param class-string<Response> $responseClass
     * @return mixed
     * @throws Exception
     */
    private function processResponse($response, $responseClass)
    {
        $body = (string)$response->getBody();
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            throw new RuntimeException("Invalid status code: $statusCode, body: $body");
        }

        $commonResponse = RestResponse::jsonDeserialize($body, $this->serializer);

        $headers = $response->getHeaders();
        $rateLimit = new RestRateLimit(
            isset($headers['gw-ratelimit-limit'][0]) ? (int)$headers['gw-ratelimit-limit'][0] : -1,
            isset($headers['gw-ratelimit-remaining'][0]) ? (int)$headers['gw-ratelimit-remaining'][0] : -1,
            isset($headers['gw-ratelimit-reset'][0]) ? (int)$headers['gw-ratelimit-reset'][0] : -1
        );
        $commonResponse->rateLimit = $rateLimit;
        $commonResponse->checkError();

        $data = $commonResponse->data === null ? null : $this->serializer->serialize($commonResponse->data, 'json');
        /**@var Response $responseObj */
        $responseObj = $responseClass::jsonDeserialize($data, $this->serializer);
        $responseObj->setCommonResponse($commonResponse);
        return $responseObj;
    }


    public function call(
        $domain,
        $broker,
        $method,
        $path,
        $requestObj,
        $responseClass,
        $requestAsJson,
        array $options = []
    )
    {
        try {
            $endpoint = $this->getEndpoint($domain);
            [$processedPath, $pathVarFields] = $this->processPathVariable($path, $requestObj);

            $req = $this->processRequest(
                $requestObj,
                $broker,
                $processedPath,
                $pathVarFields,
                $endpoint,
                $method,
                $requestAsJson
            );

            $response = $this->httpClient->request(
                $req['method'],
                $req['url'],
                [
                    'headers' => $req['headers'],
                    'body' => $req['body'],
                ]
            );
            return $this->processResponse($response, $responseClass);
        } catch (Exception $e) {
            throw new RestError(null, $e);
        }
    }

    private function getEndpoint($domain): string
    {
        switch (strtolower($domain)) {
            case Constants::DOMAIN_TYPE_SPOT:
                return $this->option->spotEndpoint;
            case Constants::DOMAIN_TYPE_FUTURES:
                return $this->option->futuresEndpoint;
            case Constants::DOMAIN_TYPE_BROKER:
                return $this->option->brokerEndpoint;
            default:
                throw new InvalidArgumentException("Invalid domain: $domain");
        }
    }


    public function close()
    {
        $this->httpClient = null;
    }
}
