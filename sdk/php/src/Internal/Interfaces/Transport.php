<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

/**
 * Interface Transport
 * Defines a transport layer abstraction for remote calls.
 *
 * This interface should be implemented by actual HTTP/WebSocket transport providers.
 */
interface Transport
{
    /**
     * Executes a remote call using the specified method, path, and request data,
     * and populates the provided response object with the result.
     *
     * @param string $domain Which endpoint to use (e.g., spot, futures, broker)
     * @param bool $broker Whether this is a broker service request
     * @param string $method HTTP method such as GET, POST, etc.
     * @param string $path Path or endpoint of the request
     * @param Request $requestObj The request payload (array or object)
     * @param class-string<Response> $responseClass The response class to populate
     * @param bool $requestAsJson Whether to serialize the request as JSON
     * @param array $options Optional arguments (headers, query params, etc.)
     *
     * @return mixed Final result from the response (typically parsed)
     *
     * @throws \Exception If the remote call fails or response is invalid
     */
    public function call(
        $domain,
        $broker,
        $method,
        $path,
        $requestObj,
        $responseClass,
        $requestAsJson,
        array $options = []
    );

    /**
     * Clean up resources or close the connection, if necessary.
     *
     * @return void
     */
    public function close();
}
