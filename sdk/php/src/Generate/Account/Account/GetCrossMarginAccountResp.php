<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Account\Account;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Response;
use KuCoin\UniversalSDK\Model\RestResponse;

class GetCrossMarginAccountResp implements Response
{
    /**
     * Total Assets in Quote Currency
     * @var string $totalAssetOfQuoteCurrency
     * @Type("string")
     * @SerializedName("totalAssetOfQuoteCurrency")
     */
    public $totalAssetOfQuoteCurrency;
    /**
     * Total Liability in Quote Currency
     * @var string $totalLiabilityOfQuoteCurrency
     * @Type("string")
     * @SerializedName("totalLiabilityOfQuoteCurrency")
     */
    public $totalLiabilityOfQuoteCurrency;
    /**
     * debt ratio
     * @var string $debtRatio
     * @Type("string")
     * @SerializedName("debtRatio")
     */
    public $debtRatio;
    /**
     * Position status; EFFECTIVE-effective, BANKRUPTCY-bankruptcy liquidation, LIQUIDATION-closing, REPAY-repayment, BORROW-borrowing
     * @var string $status
     * @Type("string")
     * @SerializedName("status")
     */
    public $status;
    /**
     * Margin account list
     * @var GetCrossMarginAccountAccounts[] $accounts
     * @Type("array<KuCoin\UniversalSDK\Generate\Account\Account\GetCrossMarginAccountAccounts>")
     * @SerializedName("accounts")
     */
    public $accounts;

    /**
     * common response
     * @Exclude()
     * @var RestResponse $commonResponse
     */
    public $commonResponse;

    public function setCommonResponse($response): void
    {
        $this->commonResponse = $response;
    }

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
            GetCrossMarginAccountResp::class,
            "json"
        );
    }
}
