<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetCrossMarginSymbolsItems implements Serializable
{
    /**
     * symbol
     * @var string $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * Symbol name
     * @var string $name
     * @Type("string")
     * @SerializedName("name")
     */
    public $name;
    /**
     * Whether trading is enabled: True for enabled; false for disabled
     * @var bool $enableTrading
     * @Type("bool")
     * @SerializedName("enableTrading")
     */
    public $enableTrading;
    /**
     * Trading market
     * @var string $market
     * @Type("string")
     * @SerializedName("market")
     */
    public $market;
    /**
     * Base currency, e.g. BTC.
     * @var string $baseCurrency
     * @Type("string")
     * @SerializedName("baseCurrency")
     */
    public $baseCurrency;
    /**
     * Quote currency, e.g. USDT.
     * @var string $quoteCurrency
     * @Type("string")
     * @SerializedName("quoteCurrency")
     */
    public $quoteCurrency;
    /**
     * Quantity increment: The quantity for an order must be a positive integer multiple of this increment. Here, the size refers to the quantity of the base currency for the order. For example, for the ETH-USDT trading pair, if the baseIncrement is 0.0000001, the order quantity can be 1.0000001 but not 1.00000001.
     * @var string $baseIncrement
     * @Type("string")
     * @SerializedName("baseIncrement")
     */
    public $baseIncrement;
    /**
     * The minimum order quantity required to place an order.
     * @var string $baseMinSize
     * @Type("string")
     * @SerializedName("baseMinSize")
     */
    public $baseMinSize;
    /**
     * Quote increment: The funds for a market order must be a positive integer multiple of this increment. The funds refer to the quote currency amount. For example, for the ETH-USDT trading pair, if the quoteIncrement is 0.000001, the amount of USDT for the order can be 3000.000001 but not 3000.0000001.
     * @var string $quoteIncrement
     * @Type("string")
     * @SerializedName("quoteIncrement")
     */
    public $quoteIncrement;
    /**
     * The minimum order funds required to place a market order.
     * @var string $quoteMinSize
     * @Type("string")
     * @SerializedName("quoteMinSize")
     */
    public $quoteMinSize;
    /**
     * The maximum order size required to place an order.
     * @var string $baseMaxSize
     * @Type("string")
     * @SerializedName("baseMaxSize")
     */
    public $baseMaxSize;
    /**
     * The maximum order funds required to place a market order.
     * @var string $quoteMaxSize
     * @Type("string")
     * @SerializedName("quoteMaxSize")
     */
    public $quoteMaxSize;
    /**
     * Price increment: The price of an order must be a positive integer multiple of this increment. For example, for the ETH-USDT trading pair, if the priceIncrement is 0.01, the order price can be 3000.01 but not 3000.001.  Specifies the min. order price as well as the price increment.This also applies to quote currency.
     * @var string $priceIncrement
     * @Type("string")
     * @SerializedName("priceIncrement")
     */
    public $priceIncrement;
    /**
     * The currency of charged fees.
     * @var string $feeCurrency
     * @Type("string")
     * @SerializedName("feeCurrency")
     */
    public $feeCurrency;
    /**
     * Threshold for price protection
     * @var string $priceLimitRate
     * @Type("string")
     * @SerializedName("priceLimitRate")
     */
    public $priceLimitRate;
    /**
     * The minimum trading amounts
     * @var string $minFunds
     * @Type("string")
     * @SerializedName("minFunds")
     */
    public $minFunds;

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
            GetCrossMarginSymbolsItems::class,
            "json"
        );
    }
}
