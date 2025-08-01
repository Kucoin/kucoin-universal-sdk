<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Account;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetIsolatedMarginAccountAssetsBaseAsset implements Serializable
{
    /**
     * currency
     * @var string $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * Support borrow or not
     * @var bool $borrowEnabled
     * @Type("bool")
     * @SerializedName("borrowEnabled")
     */
    public $borrowEnabled;
    /**
     * Support transfer or not
     * @var bool $transferInEnabled
     * @Type("bool")
     * @SerializedName("transferInEnabled")
     */
    public $transferInEnabled;
    /**
     * Liabilities
     * @var string $liability
     * @Type("string")
     * @SerializedName("liability")
     */
    public $liability;
    /**
     * Total Assets
     * @var string $total
     * @Type("string")
     * @SerializedName("total")
     */
    public $total;
    /**
     * Account available assets (total assets - frozen)
     * @var string $available
     * @Type("string")
     * @SerializedName("available")
     */
    public $available;
    /**
     * Account frozen assets
     * @var string $hold
     * @Type("string")
     * @SerializedName("hold")
     */
    public $hold;
    /**
     * The user's remaining maximum loan amount
     * @var string $maxBorrowSize
     * @Type("string")
     * @SerializedName("maxBorrowSize")
     */
    public $maxBorrowSize;
    /**
     * Outstanding principal
     * @var string $liabilityPrincipal
     * @Type("string")
     * @SerializedName("liabilityPrincipal")
     */
    public $liabilityPrincipal;
    /**
     * Outstanding interest
     * @var string $liabilityInterest
     * @Type("string")
     * @SerializedName("liabilityInterest")
     */
    public $liabilityInterest;

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
            GetIsolatedMarginAccountAssetsBaseAsset::class,
            "json"
        );
    }
}
