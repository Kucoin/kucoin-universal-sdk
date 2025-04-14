<?php
namespace KuCoin\UniversalSDK\Generate\Earn\Earn;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class EarnApiTest extends TestCase
{
    /**
     * @var Serializer $serializer
     */
    private $serializer;

    protected function setUp(): void
    {
        $this->serializer = SerializerBuilder::create()
            ->addDefaultHandlers()
            ->configureHandlers(function ($handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(
                    new JsonSerializedHandler()
                );
            })
            ->build();
    }

    function hasAnyNoneNull($object): bool
    {
        $refClass = new ReflectionClass($object);
        $props = $refClass->getProperties();

        $excludeSize = 0;
        $totalSize = sizeof($props);
        foreach ($props as $prop) {
            $doc = $prop->getDocComment();

            if ($doc !== false && strpos($doc, "@Exclude") !== false) {
                $excludeSize++;
                continue;
            }

            $prop->setAccessible(true);

            $value = $prop->getValue($object);
            if ($value !== null) {
                return true;
            }
        }
        return $excludeSize === $totalSize;
    }

    /**
     * purchase Request
     * Purchase
     * /api/v1/earn/orders
     */
    public function testPurchaseRequest()
    {
        $data =
            "{\"productId\": \"2611\", \"amount\": \"1\", \"accountType\": \"TRADE\"}";
        $req = PurchaseReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * purchase Response
     * Purchase
     * /api/v1/earn/orders
     */
    public function testPurchaseResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"2767291\",\n        \"orderTxId\": \"6603694\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = PurchaseResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRedeemPreview Request
     * Get Redeem Preview
     * /api/v1/earn/redeem-preview
     */
    public function testGetRedeemPreviewRequest()
    {
        $data = "{\"orderId\": \"2767291\", \"fromAccountType\": \"MAIN\"}";
        $req = GetRedeemPreviewReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRedeemPreview Response
     * Get Redeem Preview
     * /api/v1/earn/redeem-preview
     */
    public function testGetRedeemPreviewResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currency\": \"KCS\",\n        \"redeemAmount\": \"1\",\n        \"penaltyInterestAmount\": \"0\",\n        \"redeemPeriod\": 3,\n        \"deliverTime\": 1729518951000,\n        \"manualRedeemable\": true,\n        \"redeemAll\": false\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRedeemPreviewResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * redeem Request
     * Redeem
     * /api/v1/earn/orders
     */
    public function testRedeemRequest()
    {
        $data =
            "{\"orderId\": \"2767291\", \"amount\": \"example_string_default_value\", \"fromAccountType\": \"MAIN\", \"confirmPunishRedeem\": \"1\"}";
        $req = RedeemReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * redeem Response
     * Redeem
     * /api/v1/earn/orders
     */
    public function testRedeemResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderTxId\": \"6603700\",\n        \"deliverTime\": 1729517805000,\n        \"status\": \"PENDING\",\n        \"amount\": \"1\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = RedeemResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSavingsProducts Request
     * Get Savings Products
     * /api/v1/earn/saving/products
     */
    public function testGetSavingsProductsRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetSavingsProductsReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSavingsProducts Response
     * Get Savings Products
     * /api/v1/earn/saving/products
     */
    public function testGetSavingsProductsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"2172\",\n            \"currency\": \"BTC\",\n            \"category\": \"DEMAND\",\n            \"type\": \"DEMAND\",\n            \"precision\": 8,\n            \"productUpperLimit\": \"480\",\n            \"productRemainAmount\": \"132.36153083\",\n            \"userUpperLimit\": \"20\",\n            \"userLowerLimit\": \"0.01\",\n            \"redeemPeriod\": 0,\n            \"lockStartTime\": 1644807600000,\n            \"lockEndTime\": null,\n            \"applyStartTime\": 1644807600000,\n            \"applyEndTime\": null,\n            \"returnRate\": \"0.00047208\",\n            \"incomeCurrency\": \"BTC\",\n            \"earlyRedeemSupported\": 0,\n            \"status\": \"ONGOING\",\n            \"redeemType\": \"MANUAL\",\n            \"incomeReleaseType\": \"DAILY\",\n            \"interestDate\": 1729267200000,\n            \"duration\": 0,\n            \"newUserOnly\": 0\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSavingsProductsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getPromotionProducts Request
     * Get Promotion Products
     * /api/v1/earn/promotion/products
     */
    public function testGetPromotionProductsRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetPromotionProductsReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getPromotionProducts Response
     * Get Promotion Products
     * /api/v1/earn/promotion/products
     */
    public function testGetPromotionProductsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"2685\",\n            \"currency\": \"BTC\",\n            \"category\": \"ACTIVITY\",\n            \"type\": \"TIME\",\n            \"precision\": 8,\n            \"productUpperLimit\": \"50\",\n            \"userUpperLimit\": \"1\",\n            \"userLowerLimit\": \"0.001\",\n            \"redeemPeriod\": 0,\n            \"lockStartTime\": 1702371601000,\n            \"lockEndTime\": 1729858405000,\n            \"applyStartTime\": 1702371600000,\n            \"applyEndTime\": null,\n            \"returnRate\": \"0.03\",\n            \"incomeCurrency\": \"BTC\",\n            \"earlyRedeemSupported\": 0,\n            \"productRemainAmount\": \"49.78203998\",\n            \"status\": \"ONGOING\",\n            \"redeemType\": \"TRANS_DEMAND\",\n            \"incomeReleaseType\": \"DAILY\",\n            \"interestDate\": 1729253605000,\n            \"duration\": 7,\n            \"newUserOnly\": 1\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetPromotionProductsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getStakingProducts Request
     * Get Staking Products
     * /api/v1/earn/staking/products
     */
    public function testGetStakingProductsRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetStakingProductsReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getStakingProducts Response
     * Get Staking Products
     * /api/v1/earn/staking/products
     */
    public function testGetStakingProductsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"2535\",\n            \"currency\": \"STX\",\n            \"category\": \"STAKING\",\n            \"type\": \"DEMAND\",\n            \"precision\": 8,\n            \"productUpperLimit\": \"1000000\",\n            \"userUpperLimit\": \"10000\",\n            \"userLowerLimit\": \"1\",\n            \"redeemPeriod\": 14,\n            \"lockStartTime\": 1688614514000,\n            \"lockEndTime\": null,\n            \"applyStartTime\": 1688614512000,\n            \"applyEndTime\": null,\n            \"returnRate\": \"0.045\",\n            \"incomeCurrency\": \"BTC\",\n            \"earlyRedeemSupported\": 0,\n            \"productRemainAmount\": \"254032.90178701\",\n            \"status\": \"ONGOING\",\n            \"redeemType\": \"MANUAL\",\n            \"incomeReleaseType\": \"DAILY\",\n            \"interestDate\": 1729267200000,\n            \"duration\": 0,\n            \"newUserOnly\": 0\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetStakingProductsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getKcsStakingProducts Request
     * Get KCS Staking Products
     * /api/v1/earn/kcs-staking/products
     */
    public function testGetKcsStakingProductsRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetKcsStakingProductsReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getKcsStakingProducts Response
     * Get KCS Staking Products
     * /api/v1/earn/kcs-staking/products
     */
    public function testGetKcsStakingProductsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"2611\",\n            \"currency\": \"KCS\",\n            \"category\": \"KCS_STAKING\",\n            \"type\": \"DEMAND\",\n            \"precision\": 8,\n            \"productUpperLimit\": \"100000000\",\n            \"userUpperLimit\": \"100000000\",\n            \"userLowerLimit\": \"1\",\n            \"redeemPeriod\": 3,\n            \"lockStartTime\": 1701252000000,\n            \"lockEndTime\": null,\n            \"applyStartTime\": 1701252000000,\n            \"applyEndTime\": null,\n            \"returnRate\": \"0.03471727\",\n            \"incomeCurrency\": \"KCS\",\n            \"earlyRedeemSupported\": 0,\n            \"productRemainAmount\": \"58065850.54998251\",\n            \"status\": \"ONGOING\",\n            \"redeemType\": \"MANUAL\",\n            \"incomeReleaseType\": \"DAILY\",\n            \"interestDate\": 1729267200000,\n            \"duration\": 0,\n            \"newUserOnly\": 0\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetKcsStakingProductsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getETHStakingProducts Request
     * Get ETH Staking Products
     * /api/v1/earn/eth-staking/products
     */
    public function testGetETHStakingProductsRequest()
    {
        $data = "{\"currency\": \"BTC\"}";
        $req = GetETHStakingProductsReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getETHStakingProducts Response
     * Get ETH Staking Products
     * /api/v1/earn/eth-staking/products
     */
    public function testGetETHStakingProductsResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"ETH2\",\n            \"category\": \"ETH2\",\n            \"type\": \"DEMAND\",\n            \"precision\": 8,\n            \"currency\": \"ETH\",\n            \"incomeCurrency\": \"ETH2\",\n            \"returnRate\": \"0.028\",\n            \"userLowerLimit\": \"0.01\",\n            \"userUpperLimit\": \"8557.3597075\",\n            \"productUpperLimit\": \"8557.3597075\",\n            \"productRemainAmount\": \"8557.3597075\",\n            \"redeemPeriod\": 5,\n            \"redeemType\": \"MANUAL\",\n            \"incomeReleaseType\": \"DAILY\",\n            \"applyStartTime\": 1729255485000,\n            \"applyEndTime\": null,\n            \"lockStartTime\": 1729255485000,\n            \"lockEndTime\": null,\n            \"interestDate\": 1729267200000,\n            \"newUserOnly\": 0,\n            \"earlyRedeemSupported\": 0,\n            \"duration\": 0,\n            \"status\": \"ONGOING\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetETHStakingProductsResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getAccountHolding Request
     * Get Account Holding
     * /api/v1/earn/hold-assets
     */
    public function testGetAccountHoldingRequest()
    {
        $data =
            "{\"currency\": \"KCS\", \"productId\": \"example_string_default_value\", \"productCategory\": \"DEMAND\", \"currentPage\": 1, \"pageSize\": 10}";
        $req = GetAccountHoldingReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getAccountHolding Response
     * Get Account Holding
     * /api/v1/earn/hold-assets
     */
    public function testGetAccountHoldingResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"currentPage\": 1,\n        \"pageSize\": 15,\n        \"items\": [\n            {\n                \"orderId\": \"2767291\",\n                \"productId\": \"2611\",\n                \"productCategory\": \"KCS_STAKING\",\n                \"productType\": \"DEMAND\",\n                \"currency\": \"KCS\",\n                \"incomeCurrency\": \"KCS\",\n                \"returnRate\": \"0.03471727\",\n                \"holdAmount\": \"1\",\n                \"redeemedAmount\": \"0\",\n                \"redeemingAmount\": \"1\",\n                \"lockStartTime\": 1701252000000,\n                \"lockEndTime\": null,\n                \"purchaseTime\": 1729257513000,\n                \"redeemPeriod\": 3,\n                \"status\": \"REDEEMING\",\n                \"earlyRedeemSupported\": 0\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAccountHoldingResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
