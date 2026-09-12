<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Common;

use KuCoin\UniversalSDK\Internal\Interfaces\Transport;

abstract class UtaApi
{
    /** @var Transport */
    protected $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param array|UtaRequest|null $request
     */
    protected function callUta(string $httpMethod, string $path, $request = null): UtaResponse
    {
        if (is_array($request)) {
            $request = new UtaRequest($request);
        }
        if ($request !== null && !$request instanceof UtaRequest) {
            throw new \InvalidArgumentException('UTA requests must be an array, UtaRequest, or null');
        }

        return $this->transport->call(
            'spot',
            false,
            $httpMethod,
            $path,
            $request,
            UtaResponse::class,
            false
        );
    }
}
