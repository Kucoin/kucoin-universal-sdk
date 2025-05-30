<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Margin\Risklimit;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetMarginRiskLimitData implements Serializable
{
    /**
     * Time stamp
     * @var int|null $timestamp
     * @Type("int")
     * @SerializedName("timestamp")
     */
    public $timestamp;
    /**
     * CROSS MARGIN RESPONSES, Currency
     * @var string|null $currency
     * @Type("string")
     * @SerializedName("currency")
     */
    public $currency;
    /**
     * CROSS MARGIN RESPONSES, Maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     * @var string|null $borrowMaxAmount
     * @Type("string")
     * @SerializedName("borrowMaxAmount")
     */
    public $borrowMaxAmount;
    /**
     * CROSS MARGIN RESPONSES, Maximum buy amount
     * @var string|null $buyMaxAmount
     * @Type("string")
     * @SerializedName("buyMaxAmount")
     */
    public $buyMaxAmount;
    /**
     * CROSS MARGIN RESPONSES, Maximum holding amount
     * @var string|null $holdMaxAmount
     * @Type("string")
     * @SerializedName("holdMaxAmount")
     */
    public $holdMaxAmount;
    /**
     * CROSS MARGIN RESPONSES, [Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $borrowCoefficient
     * @Type("string")
     * @SerializedName("borrowCoefficient")
     */
    public $borrowCoefficient;
    /**
     * CROSS MARGIN RESPONSES, [Margin Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $marginCoefficient
     * @Type("string")
     * @SerializedName("marginCoefficient")
     */
    public $marginCoefficient;
    /**
     * CROSS MARGIN RESPONSES, Currency precision. The minimum repayment amount of a single transaction should be >= currency precision. For example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     * @var int|null $precision
     * @Type("int")
     * @SerializedName("precision")
     */
    public $precision;
    /**
     * CROSS MARGIN RESPONSES, Minimum personal borrow amount
     * @var string|null $borrowMinAmount
     * @Type("string")
     * @SerializedName("borrowMinAmount")
     */
    public $borrowMinAmount;
    /**
     * CROSS MARGIN RESPONSES, Minimum unit for borrowing; the borrowed amount must be an integer multiple of this value
     * @var string|null $borrowMinUnit
     * @Type("string")
     * @SerializedName("borrowMinUnit")
     */
    public $borrowMinUnit;
    /**
     * CROSS MARGIN RESPONSES, Whether to support borrowing
     * @var bool|null $borrowEnabled
     * @Type("bool")
     * @SerializedName("borrowEnabled")
     */
    public $borrowEnabled;
    /**
     * ISOLATED MARGIN RESPONSES, Symbol
     * @var string|null $symbol
     * @Type("string")
     * @SerializedName("symbol")
     */
    public $symbol;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     * @var string|null $baseMaxBorrowAmount
     * @Type("string")
     * @SerializedName("baseMaxBorrowAmount")
     */
    public $baseMaxBorrowAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     * @var string|null $quoteMaxBorrowAmount
     * @Type("string")
     * @SerializedName("quoteMaxBorrowAmount")
     */
    public $quoteMaxBorrowAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum buy amount
     * @var string|null $baseMaxBuyAmount
     * @Type("string")
     * @SerializedName("baseMaxBuyAmount")
     */
    public $baseMaxBuyAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum buy amount
     * @var string|null $quoteMaxBuyAmount
     * @Type("string")
     * @SerializedName("quoteMaxBuyAmount")
     */
    public $quoteMaxBuyAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum holding amount
     * @var string|null $baseMaxHoldAmount
     * @Type("string")
     * @SerializedName("baseMaxHoldAmount")
     */
    public $baseMaxHoldAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum holding amount
     * @var string|null $quoteMaxHoldAmount
     * @Type("string")
     * @SerializedName("quoteMaxHoldAmount")
     */
    public $quoteMaxHoldAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Base currency precision. The minimum repayment amount of a single transaction should be >= currency precision. For example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     * @var int|null $basePrecision
     * @Type("int")
     * @SerializedName("basePrecision")
     */
    public $basePrecision;
    /**
     * ISOLATED MARGIN RESPONSES, Quote currency precision. The minimum repayment amount of a single transaction should be >= currency precision. For example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     * @var int|null $quotePrecision
     * @Type("int")
     * @SerializedName("quotePrecision")
     */
    public $quotePrecision;
    /**
     * ISOLATED MARGIN RESPONSES, Base minimum personal borrow amount
     * @var string|null $baseBorrowMinAmount
     * @Type("string")
     * @SerializedName("baseBorrowMinAmount")
     */
    public $baseBorrowMinAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Quote minimum personal borrow amount
     * @var string|null $quoteBorrowMinAmount
     * @Type("string")
     * @SerializedName("quoteBorrowMinAmount")
     */
    public $quoteBorrowMinAmount;
    /**
     * ISOLATED MARGIN RESPONSES, Base minimum unit for borrowing, the borrowed amount must be an integer multiple of this value
     * @var string|null $baseBorrowMinUnit
     * @Type("string")
     * @SerializedName("baseBorrowMinUnit")
     */
    public $baseBorrowMinUnit;
    /**
     * ISOLATED MARGIN RESPONSES, Quote minimum unit for borrowing, the borrowed amount must be an integer multiple of this value
     * @var string|null $quoteBorrowMinUnit
     * @Type("string")
     * @SerializedName("quoteBorrowMinUnit")
     */
    public $quoteBorrowMinUnit;
    /**
     * ISOLATED MARGIN RESPONSES, Base whether to support borrowing
     * @var bool|null $baseBorrowEnabled
     * @Type("bool")
     * @SerializedName("baseBorrowEnabled")
     */
    public $baseBorrowEnabled;
    /**
     * ISOLATED MARGIN RESPONSES, Quote whether to support borrowing
     * @var bool|null $quoteBorrowEnabled
     * @Type("bool")
     * @SerializedName("quoteBorrowEnabled")
     */
    public $quoteBorrowEnabled;
    /**
     * ISOLATED MARGIN RESPONSES, [Base Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $baseBorrowCoefficient
     * @Type("string")
     * @SerializedName("baseBorrowCoefficient")
     */
    public $baseBorrowCoefficient;
    /**
     * ISOLATED MARGIN RESPONSES, [Quote Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $quoteBorrowCoefficient
     * @Type("string")
     * @SerializedName("quoteBorrowCoefficient")
     */
    public $quoteBorrowCoefficient;
    /**
     * ISOLATED MARGIN RESPONSES, [Base Margin Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $baseMarginCoefficient
     * @Type("string")
     * @SerializedName("baseMarginCoefficient")
     */
    public $baseMarginCoefficient;
    /**
     * ISOLATED MARGIN RESPONSES, [Quote Margin Coefficient](https://www.kucoin.com/land/price-protect)
     * @var string|null $quoteMarginCoefficient
     * @Type("string")
     * @SerializedName("quoteMarginCoefficient")
     */
    public $quoteMarginCoefficient;

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
            GetMarginRiskLimitData::class,
            "json"
        );
    }
}
