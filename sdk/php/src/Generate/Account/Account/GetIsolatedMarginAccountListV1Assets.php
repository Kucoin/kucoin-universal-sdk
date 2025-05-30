<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Account;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetIsolatedMarginAccountListV1Assets implements Serializable
{
    /**
     * Symbol
     * @var string $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Position status: Existing liabilities-DEBT, No liabilities-CLEAR, Bankrupcy (after position enters a negative balance)-BANKRUPTCY, Existing borrowings-IN_BORROW, Existing repayments-IN_REPAY, Under liquidation-IN_LIQUIDATION, Under auto-renewal assets-IN_AUTO_RENEW .
     * - 'DEBT' :
     * - 'CLEAR' :
     * - 'BANKRUPTCY' :
     * - 'IN_BORROW' :
     * - 'IN_REPAY' :
     * - 'IN_LIQUIDATION' :
     * - 'IN_AUTO_RENEW' :
     * @var string $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;
    /**
     * debt ratio
     * @var string $debtRatio
     * @Type("string")
     * @SerializedName("debtRatio")
     */
    public $debtRatio;
    /**
     *
     * @var GetIsolatedMarginAccountListV1AssetsBaseAsset $baseAsset
     * @Type("KuCoin\UniversalSDK\Generate\Account\Account\GetIsolatedMarginAccountListV1AssetsBaseAsset")
     * @SerializedName("baseAsset")
     */
    public $baseAsset;
    /**
     *
     * @var GetIsolatedMarginAccountListV1AssetsQuoteAsset $quoteAsset
     * @Type("KuCoin\UniversalSDK\Generate\Account\Account\GetIsolatedMarginAccountListV1AssetsQuoteAsset")
     * @SerializedName("quoteAsset")
     */
    public $quoteAsset;

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
            GetIsolatedMarginAccountListV1Assets::class,
            "json"
        );
    }
}
