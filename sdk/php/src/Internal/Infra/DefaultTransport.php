<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;
use InvalidArgumentException;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Interfaces\Request;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Internal\Interfaces\Transport;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\ClientOption;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\HttpRequest;
use KuCoin\UniversalSDK\Model\HttpResponse;
use KuCoin\UniversalSDK\Model\RestError;
use KuCoin\UniversalSDK\Model\RateLimit;
use KuCoin\UniversalSDK\Model\RestResponse;
use KuCoin\UniversalSDK\Model\TransportOption;
use ReflectionClass;
use ReflectionObject;
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

    /** @var HttpClientInterface $httpClient */
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

    private function createHttpClient(TransportOption $option): HttpClientInterface
    {
        if ($option->useCoroutineHttp) {
            if (!extension_loaded('swoole')) {
                throw new \RuntimeException("ext-swoole is required when useCoroutineHttp = true.");
            }

            if (!class_exists(\Swlib\Saber::class)) {
                throw new \RuntimeException("useCoroutineHttp = true requires `swlib/saber` and `ext-swoole`.");
            }
            return new SaberHttpClient($option);
        }

        return new GuzzleHttpClient($option);
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

    function buildQueryFromRequest(object $requestObj, array $pathVarFields): array
    {
        $queryParts = [];
        $rawParts = [];

        $ref = new ReflectionObject($requestObj);
        foreach ($ref->getProperties() as $prop) {
            $prop->setAccessible(true);
            $value = $prop->getValue($requestObj);
            $propName = $prop->getName();

            if ($value === null || array_key_exists($propName, $pathVarFields) || $propName === "pathVarMapping") {
                continue;
            }

            // parse @SerializedName("xxx")
            $docComment = $prop->getDocComment();
            $serializedName = $propName;
            if ($docComment && preg_match('/@SerializedName\("([^"]+)"\)/', $docComment, $matches)) {
                $serializedName = $matches[1];
            }

            if (!is_scalar($value)) {
                throw new RuntimeException("Unexpected value type for '{$serializedName}'");
            }

            $stringValue = (string)$value;
            if (is_bool($value)) {
                $stringValue = $value ? 'true' : 'false';
            }

            $queryParts[] = urlencode($serializedName) . '=' . urlencode($stringValue);
            $rawParts[] = $serializedName . '=' . $stringValue;
        }

        if (empty($queryParts)) {
            return [];
        }

        return [implode('&', $queryParts), implode('&', $rawParts)];
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

        if ($requestAsJson) {
            if (!is_null($requestObj)) {
                $body = $requestObj->jsonSerialize($this->serializer);
            }
        } else {
            if ($method === 'GET' || $method === 'DELETE') {
                if (!is_null($requestObj)) {
                    $paths = $this->buildQueryFromRequest($requestObj, $pathVarFields);
                    if (!empty($paths)) {
                        $path .= '?' . $paths[0];
                        $rawPath .= '?' . $paths[1];
                    }
                }
            } elseif ($method === 'POST') {
                if (!is_null($requestObj)) {
                    $body = $requestObj->jsonSerialize($this->serializer);
                }
            } else {
                throw new RuntimeException('Invalid request method');
            }
        }


        $fullUrl = $endpoint . $path;
        $this->processHeaders($body, $rawPath, $headers, $method, $broker);

        return new HttpRequest(strtoupper($method), $fullUrl, $headers, $body);
    }

    /**
     * @param HttpResponse $response
     * @param class-string<Response> $responseClass
     * @return mixed
     * @throws Exception
     */
    private function processResponse($response, $responseClass)
    {
        $body = (string)$response->body;
        $statusCode = $response->status;

        if ($statusCode !== 200) {
            throw new RuntimeException("Invalid status code: $statusCode, body: $body");
        }

        $commonResponse = RestResponse::jsonDeserialize($body, $this->serializer);

        $headers = $response->headers;
        $rateLimit = new RateLimit(
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
        $method = strtoupper($method);

        $interceptorContext = [];
        for ($i = 0; $i < count($this->transportOption->interceptors); $i++) {
            $interceptorContext[$i] = [];
        }
        $exception = null;
        $response = null;

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


            $index = 0;
            foreach ($this->transportOption->interceptors as $interceptor) {
                $interceptor->before($req, $interceptorContext[$index]);
                $index++;
            }

            $response = $this->httpClient->request($req);
        } catch (RestError $e) {
            $exception = $e;
            throw $e;
        } catch (Exception $ee) {
            $e = new RestError(null, $ee);
            $exception = $e;
            throw $e;
        } finally {
            $index = 0;
            foreach ($this->transportOption->interceptors as $interceptor) {
                $interceptor->after($response, $exception, $interceptorContext[$index]);
                $index++;
            }
        }

        return $this->processResponse($response, $responseClass);
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
        $this->httpClient->close();
        $this->httpClient = null;
    }
}
