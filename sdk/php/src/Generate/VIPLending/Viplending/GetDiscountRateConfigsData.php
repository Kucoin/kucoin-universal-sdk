<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\VIPLending\Viplending;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetDiscountRateConfigsData implements Serializable
{
    /**
     * Currency
     * @var string $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Gradient configuration list, amount converted into USDT
     * @var GetDiscountRateConfigsDataUsdtLevels[] $usdtLevels
     * @Type("array<KuCoin\UniversalSDK\Generate\VIPLending\Viplending\GetDiscountRateConfigsDataUsdtLevels>")
     * @SerializedName("usdtLevels")
     */
    public $usdtLevels;

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
            GetDiscountRateConfigsData::class,
            "json"
        );
    }
}
