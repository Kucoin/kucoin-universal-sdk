<?php

namespace KuCoin\UniversalSDK\Model;

use Exception;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class RestResponse
 * Represents a generic response from the REST API.
 */
class RestResponse
{
    /**
     * Response code
     * @var string $code
     * @Type("string")
     * @SerializedName("code")
     */
    public $code;

    /**
     * Response data
     * @var mixed $data
     * @Type("JsonSerialized")
     * @SerializedName("data")
     */
    public $data;

    /**
     * Error message
     * @var string $message
     * @Type("string")
     * @SerializedName("msg")
     */
    public $message;

    /**
     * RateLimit info
     * @var RateLimit $rateLimit
     * @Type("RateLimit")
     * @SerializedName("rateLimit")
     */
    public $rateLimit;

    /**
     * Check if the response is an error
     * @throws Exception
     */
    public function checkError()
    {
        if ($this->code !== Constants::RESULT_CODE_SUCCESS) {
            throw new RestError($this, new Exception("Server returned an error, code: {$this->code}, msg: {$this->message}"));
        }
    }

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize(string $json, Serializer $serializer): RestResponse
    {
        return $serializer->deserialize($json, self::class, 'json');
    }
}
