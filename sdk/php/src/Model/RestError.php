<?php

namespace KuCoin\UniversalSDK\Model;

use Exception;

/**
 * Class RestError
 * Represents an exception for REST requests.
 */
class RestError extends Exception
{
    /**
     * @var RestResponse|null
     */
    private $response;

    /**
     * @var Exception|null
     */
    private $err;

    public function __construct(?RestResponse $response = null, ?Exception $err = null)
    {
        parent::__construct($err ? $err->getMessage() : 'unknown');
        $this->response = $response;
        $this->err = $err;
    }

    public function __toString()
    {
        if ($this->response) {
            return sprintf(
                'request error, server code: %s, server msg: %s, context msg: %s',
                $this->response->getCode(),
                $this->response->getMsg(),
                $this->err ? $this->err->getMessage() : 'unknown'
            );
        }
        return 'request error, ' . ($this->err ? $this->err->__toString() : 'unknown');
    }

    public function getError(): ?Exception
    {
        return $this->err;
    }

    public function getCommonResponse(): ?RestResponse
    {
        return $this->response;
    }
}