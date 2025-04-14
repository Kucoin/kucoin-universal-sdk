<?php
namespace KuCoin\UniversalSDK\Generate\Account\Withdrawal;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class WithdrawalApiTest extends TestCase
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
     * getWithdrawalQuotas Request
     * Get Withdrawal Quotas
     * /api/v1/withdrawals/quotas
     */
    public function testGetWithdrawalQuotasRequest()
    {
        $data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}";
        $req = GetWithdrawalQuotasReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getWithdrawalQuotas Response
     * Get Withdrawal Quotas
     * /api/v1/withdrawals/quotas
     */
    public function testGetWithdrawalQuotasResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"currency\":\"BTC\",\"limitBTCAmount\":\"15.79590095\",\"usedBTCAmount\":\"0.00000000\",\"quotaCurrency\":\"USDT\",\"limitQuotaCurrencyAmount\":\"999999.00000000\",\"usedQuotaCurrencyAmount\":\"0\",\"remainAmount\":\"15.79590095\",\"availableAmount\":\"0\",\"withdrawMinFee\":\"0.0005\",\"innerWithdrawMinFee\":\"0\",\"withdrawMinSize\":\"0.001\",\"isWithdrawEnabled\":true,\"precision\":8,\"chain\":\"BTC\",\"reason\":null,\"lockedAmount\":\"0\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetWithdrawalQuotasResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * withdrawalV3 Request
     * Withdraw (V3)
     * /api/v3/withdrawals
     */
    public function testWithdrawalV3Request()
    {
        $data =
            "{\"currency\": \"USDT\", \"toAddress\": \"TKFRQXSDcY****GmLrjJggwX8\", \"amount\": 3, \"withdrawType\": \"ADDRESS\", \"chain\": \"trx\", \"isInner\": true, \"remark\": \"this is Remark\"}";
        $req = WithdrawalV3Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * withdrawalV3 Response
     * Withdraw (V3)
     * /api/v3/withdrawals
     */
    public function testWithdrawalV3Response()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"withdrawalId\":\"670deec84d64da0007d7c946\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = WithdrawalV3Resp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * cancelWithdrawal Request
     * Cancel Withdrawal
     * /api/v1/withdrawals/{withdrawalId}
     */
    public function testCancelWithdrawalRequest()
    {
        $data = "{\"withdrawalId\": \"670b891f7e0f440007730692\"}";
        $req = CancelWithdrawalReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * cancelWithdrawal Response
     * Cancel Withdrawal
     * /api/v1/withdrawals/{withdrawalId}
     */
    public function testCancelWithdrawalResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":null}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = CancelWithdrawalResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getWithdrawalHistory Request
     * Get Withdrawal History
     * /api/v1/withdrawals
     */
    public function testGetWithdrawalHistoryRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetWithdrawalHistoryReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getWithdrawalHistory Response
     * Get Withdrawal History
     * /api/v1/withdrawals
     */
    public function testGetWithdrawalHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 5,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"currency\": \"USDT\",\n                \"chain\": \"\",\n                \"status\": \"SUCCESS\",\n                \"address\": \"a435*****@gmail.com\",\n                \"memo\": \"\",\n                \"isInner\": true,\n                \"amount\": \"1.00000000\",\n                \"fee\": \"0.00000000\",\n                \"walletTxId\": null,\n                \"createdAt\": 1728555875000,\n                \"updatedAt\": 1728555875000,\n                \"remark\": \"\",\n                \"arrears\": false\n            },\n            {\n                \"currency\": \"USDT\",\n                \"chain\": \"trx\",\n                \"status\": \"SUCCESS\",\n                \"address\": \"TSv3L1fS7******X4nLP6rqNxYz\",\n                \"memo\": \"\",\n                \"isInner\": true,\n                \"amount\": \"6.00000000\",\n                \"fee\": \"0.00000000\",\n                \"walletTxId\": null,\n                \"createdAt\": 1721730920000,\n                \"updatedAt\": 1721730920000,\n                \"remark\": \"\",\n                \"arrears\": false\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetWithdrawalHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getWithdrawalHistoryOld Request
     * Get Withdrawal History - Old
     * /api/v1/hist-withdrawals
     */
    public function testGetWithdrawalHistoryOldRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetWithdrawalHistoryOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getWithdrawalHistoryOld Response
     * Get Withdrawal History - Old
     * /api/v1/hist-withdrawals
     */
    public function testGetWithdrawalHistoryOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"currency\": \"BTC\",\n                \"createAt\": 1526723468,\n                \"amount\": \"0.534\",\n                \"address\": \"33xW37ZSW4tQvg443Pc7NLCAs167Yc2XUV\",\n                \"walletTxId\": \"aeacea864c020acf58e51606169240e96774838dcd4f7ce48acf38e3651323f4\",\n                \"isInner\": false,\n                \"status\": \"SUCCESS\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetWithdrawalHistoryOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * withdrawalV1 Request
     * Withdraw - V1
     * /api/v1/withdrawals
     */
    public function testWithdrawalV1Request()
    {
        $data =
            "{\"currency\": \"USDT\", \"address\": \"TKFRQXSDc****16GmLrjJggwX8\", \"amount\": 3, \"chain\": \"trx\", \"isInner\": true}";
        $req = WithdrawalV1Req::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * withdrawalV1 Response
     * Withdraw - V1
     * /api/v1/withdrawals
     */
    public function testWithdrawalV1Response()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"withdrawalId\":\"670a973cf07b3800070e216c\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = WithdrawalV1Resp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
