<?php

namespace KuCoin\UniversalSDK\Internal\Interfaces;

/**
 * Interface Response
 * Represents a serializable response with a method to set common response data.
 */
interface Request extends Serializable
{
    /**
     * @return void
     * @return array
     */
    public function pathVarMapping();
}
