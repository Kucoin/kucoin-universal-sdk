<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Common;

use KuCoin\UniversalSDK\Internal\Interfaces\Request;

/**
 * Flexible request object used by UTA REST endpoints.
 *
 * UTA endpoint schemas evolve independently and several fields accept values with different
 * shapes. Keeping the request as an associative array prevents a generated default value from
 * accidentally being sent (for example an unsupported TP/SL trigger type).
 */
class UtaRequest implements Request
{
    /** @var array */
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public static function create(array $data = []): self
    {
        return new self($data);
    }

    public function data(): array
    {
        return $this->data;
    }

    /**
     * DefaultTransport uses this method to build query strings without reflecting the wrapper
     * object's private fields.
     */
    public function queryParameters(): array
    {
        return $this->data;
    }

    public function pathVarMapping(): array
    {
        return [];
    }

    public function jsonSerialize($serializer): string
    {
        return json_encode($this->withoutNulls($this->data), JSON_PRESERVE_ZERO_FRACTION);
    }

    public static function jsonDeserialize($json, $serializer): self
    {
        if ($json === null || $json === '') {
            return new self();
        }
        $decoded = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        if (!is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Unable to decode UTA request data: ' . json_last_error_msg());
        }
        return new self($decoded);
    }

    private function withoutNulls(array $values): array
    {
        $result = [];
        foreach ($values as $key => $value) {
            if ($value === null) {
                continue;
            }
            $result[$key] = is_array($value) && !$this->isList($value)
                ? $this->withoutNulls($value)
                : $value;
        }
        return $result;
    }

    /** Compatible with the PHP 7.4 minimum version supported by this SDK. */
    private function isList(array $values): bool
    {
        $index = 0;
        foreach ($values as $key => $_) {
            if ($key !== $index++) {
                return false;
            }
        }
        return true;
    }
}
