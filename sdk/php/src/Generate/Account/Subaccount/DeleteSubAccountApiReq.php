<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class DeleteSubAccountApiReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * API-Key
     * @var string|null $apiKey
     * @Type("string")
     * @SerializedName("apiKey")
     */
    public $apiKey;
    /**
     * Sub-account name.
     * @var string|null $subName
     * @Type("string")
     * @SerializedName("subName")
     */
    public $subName;
    /**
     * Password (password of the API key)
     * @var string|null $passphrase
     * @Type("string")
     * @SerializedName("passphrase")
     */
    public $passphrase;

    private function __construct() {}

    /**
     * @param Serializer $serializer
     * @return string
     */
    public function jsonSerialize($serializer)
    {
        return $serializer->serialize($this, "json");
    }

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize($json, $serializer)
    {
        if ($json === null) {
            return new self();
        }
        return $serializer->deserialize(
            $json,
            DeleteSubAccountApiReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `DeleteSubAccountApiReq` class.
     * The builder pattern allows step-by-step construction of a `DeleteSubAccountApiReq` object.
     * @return DeleteSubAccountApiReqBuilder
     */
    public static function builder()
    {
        return new DeleteSubAccountApiReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `DeleteSubAccountApiReq` class with the given data.
     * Ensure that the keys in data match the target field names in the documentation,
     * rather than the variable names in the class.
     * @return self
     */
    public static function create(array $data)
    {
        $obj = new self();
        foreach ($data as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }
        return $obj;
    }
}

class DeleteSubAccountApiReqBuilder
{
    /**
     * @var DeleteSubAccountApiReq $obj
     */
    private $obj;

    public function __construct(DeleteSubAccountApiReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * API-Key
     * @param string $value
     * @return self
     */
    public function setApiKey($value)
    {
        $this->obj->apiKey = $value;
        return $this;
    }

    /**
     * Sub-account name.
     * @param string $value
     * @return self
     */
    public function setSubName($value)
    {
        $this->obj->subName = $value;
        return $this;
    }

    /**
     * Password (password of the API key)
     * @param string $value
     * @return self
     */
    public function setPassphrase($value)
    {
        $this->obj->passphrase = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return DeleteSubAccountApiReq
     */
    public function build()
    {
        return $this->obj;
    }
}
