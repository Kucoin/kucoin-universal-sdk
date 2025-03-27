<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

/**
 * Interface Response
 * Represents a serializable response with a method to set common response data.
 */
interface Response extends Serializable
{
    /**
     * Set common response data.
     *
     * @param mixed $response
     * @return void
     */
    public function setCommonResponse($response);
}
