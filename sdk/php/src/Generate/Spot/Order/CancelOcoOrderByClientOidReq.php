<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Order;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class CancelOcoOrderByClientOidReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [
        "clientOid" => "clientOid",
    ];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * Client Order Id，unique identifier created by the user
     * @var string|null $clientOid
     * @Type("string")
     * @SerializedName("clientOid")
     * @Exclude()
     */
    public $clientOid;

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
            CancelOcoOrderByClientOidReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `CancelOcoOrderByClientOidReq` class.
     * The builder pattern allows step-by-step construction of a `CancelOcoOrderByClientOidReq` object.
     * @return CancelOcoOrderByClientOidReqBuilder
     */
    public static function builder()
    {
        return new CancelOcoOrderByClientOidReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `CancelOcoOrderByClientOidReq` class with the given data.
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

class CancelOcoOrderByClientOidReqBuilder
{
    /**
     * @var CancelOcoOrderByClientOidReq $obj
     */
    private $obj;

    public function __construct(CancelOcoOrderByClientOidReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * Client Order Id，unique identifier created by the user
     * @param string $value
     * @return self
     */
    public function setClientOid($value)
    {
        $this->obj->clientOid = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return CancelOcoOrderByClientOidReq
     */
    public function build()
    {
        return $this->obj;
    }
}
