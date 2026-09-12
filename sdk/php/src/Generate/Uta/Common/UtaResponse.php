<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Common;

use KuCoin\UniversalSDK\Internal\Interfaces\Response;

/**
 * Flexible UTA REST response.
 *
 * The server legitimately returns both objects and arrays for different UTA endpoints (and, for
 * some endpoints, for different account states). Do not replace $data with a fixed DTO type.
 */
class UtaResponse implements Response
{
    /** @var mixed */
    public $data;

    /** @var mixed */
    public $commonResponse;

    public function setCommonResponse($response): void
    {
        $this->commonResponse = $response;
    }

    public static function jsonDeserialize($json, $serializer): self
    {
        $response = new self();
        if ($json === null || $json === '') {
            return $response;
        }

        $decoded = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Unable to decode UTA response data: ' . json_last_error_msg());
        }
        $response->data = $decoded;
        return $response;
    }

    public function jsonSerialize($serializer): string
    {
        return json_encode($this->data, JSON_PRESERVE_ZERO_FRACTION);
    }
}
