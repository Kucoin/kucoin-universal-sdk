<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Common;

/**
 * Base class for UTA REST service groups.
 *
 * Each generated group exposes all Java-parity operation names through __call. The endpoint map
 * keeps the implementation maintainable while retaining the public operation names in PHPDoc for
 * IDE completion. Requests can be passed either as an associative array or UtaRequest.
 */
abstract class MappedUtaApi extends UtaApi
{
    /** @var array<string, array{0:string,1:string}> */
    protected const ENDPOINTS = [];

    public function call(string $operation, $request = null): UtaResponse
    {
        if (!isset(static::ENDPOINTS[$operation])) {
            throw new \BadMethodCallException('Unknown UTA operation: ' . $operation);
        }
        [$httpMethod, $path] = static::ENDPOINTS[$operation];
        return $this->callUta($httpMethod, $path, $request);
    }

    public function __call($operation, $arguments): UtaResponse
    {
        if (count($arguments) > 1) {
            throw new \InvalidArgumentException($operation . ' accepts at most one request argument');
        }
        return $this->call($operation, $arguments[0] ?? null);
    }

    public function operations(): array
    {
        return static::ENDPOINTS;
    }
}
