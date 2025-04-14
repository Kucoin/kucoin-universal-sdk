<?php
namespace KuCoin\UniversalSDK\Generate\Broker\Ndbroker;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class NDBrokerApiTest extends TestCase
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
     * getBrokerInfo Request
     * Get Broker Info
     * /api/v1/broker/nd/info
     */
    public function testGetBrokerInfoRequest()
    {
        $data =
            "{\"begin\": \"20240510\", \"end\": \"20241010\", \"tradeType\": \"1\"}";
        $req = GetBrokerInfoReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getBrokerInfo Response
     * Get Broker Info
     * /api/v1/broker/nd/info
     */
    public function testGetBrokerInfoResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"accountSize\": 0,\n        \"maxAccountSize\": null,\n        \"level\": 0\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetBrokerInfoResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addSubAccount Request
     * Add sub-account
     * /api/v1/broker/nd/account
     */
    public function testAddSubAccountRequest()
    {
        $data = "{\"accountName\": \"Account1\"}";
        $req = AddSubAccountReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccount Response
     * Add sub-account
     * /api/v1/broker/nd/account
     */
    public function testAddSubAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"accountName\": \"Account15\",\n        \"uid\": \"226383154\",\n        \"createdAt\": 1729819381908,\n        \"level\": 0\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddSubAccountResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSubAccount Request
     * Get sub-account
     * /api/v1/broker/nd/account
     */
    public function testGetSubAccountRequest()
    {
        $data =
            "{\"uid\": \"226383154\", \"currentPage\": 1, \"pageSize\": 20}";
        $req = GetSubAccountReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSubAccount Response
     * Get sub-account
     * /api/v1/broker/nd/account
     */
    public function testGetSubAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 20,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"accountName\": \"Account15\",\n                \"uid\": \"226383154\",\n                \"createdAt\": 1729819382000,\n                \"level\": 0\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSubAccountResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addSubAccountApi Request
     * Add sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testAddSubAccountApiRequest()
    {
        $data =
            "{\"uid\": \"226383154\", \"passphrase\": \"11223344\", \"ipWhitelist\": [\"127.0.0.1\", \"123.123.123.123\"], \"permissions\": [\"general\", \"spot\"], \"label\": \"This is remarks\"}";
        $req = AddSubAccountApiReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccountApi Response
     * Add sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testAddSubAccountApiResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"uid\": \"226383154\",\n        \"label\": \"This is remarks\",\n        \"apiKey\": \"671afb36cee20f00015cfaf1\",\n        \"secretKey\": \"d694df2******5bae05b96\",\n        \"apiVersion\": 3,\n        \"permissions\": [\n            \"General\",\n            \"Spot\"\n        ],\n        \"ipWhitelist\": [\n            \"127.0.0.1\",\n            \"123.123.123.123\"\n        ],\n        \"createdAt\": 1729821494000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddSubAccountApiResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSubAccountAPI Request
     * Get sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testGetSubAccountAPIRequest()
    {
        $data =
            "{\"uid\": \"226383154\", \"apiKey\": \"671afb36cee20f00015cfaf1\"}";
        $req = GetSubAccountAPIReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSubAccountAPI Response
     * Get sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testGetSubAccountAPIResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"uid\": \"226383154\",\n            \"label\": \"This is remarks\",\n            \"apiKey\": \"671afb36cee20f00015cfaf1\",\n            \"apiVersion\": 3,\n            \"permissions\": [\n                \"General\",\n                \"Spot\"\n            ],\n            \"ipWhitelist\": [\n                \"127.**.1\",\n                \"203.**.154\"\n            ],\n            \"createdAt\": 1729821494000\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSubAccountAPIResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * modifySubAccountApi Request
     * Modify sub-account API
     * /api/v1/broker/nd/account/update-apikey
     */
    public function testModifySubAccountApiRequest()
    {
        $data =
            "{\"uid\": \"226383154\", \"apiKey\": \"671afb36cee20f00015cfaf1\", \"ipWhitelist\": [\"127.0.0.1\", \"123.123.123.123\"], \"permissions\": [\"general\", \"spot\"], \"label\": \"This is remarks\"}";
        $req = ModifySubAccountApiReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * modifySubAccountApi Response
     * Modify sub-account API
     * /api/v1/broker/nd/account/update-apikey
     */
    public function testModifySubAccountApiResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"uid\": \"226383154\",\n        \"label\": \"This is remarks\",\n        \"apiKey\": \"671afb36cee20f00015cfaf1\",\n        \"apiVersion\": 3,\n        \"permissions\": [\n            \"General\",\n            \"Spot\"\n        ],\n        \"ipWhitelist\": [\n            \"127.**.1\",\n            \"123.**.123\"\n        ],\n        \"createdAt\": 1729821494000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = ModifySubAccountApiResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * deleteSubAccountAPI Request
     * Delete sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testDeleteSubAccountAPIRequest()
    {
        $data =
            "{\"uid\": \"226383154\", \"apiKey\": \"671afb36cee20f00015cfaf1\"}";
        $req = DeleteSubAccountAPIReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * deleteSubAccountAPI Response
     * Delete sub-account API
     * /api/v1/broker/nd/account/apikey
     */
    public function testDeleteSubAccountAPIResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": true\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = DeleteSubAccountAPIResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * transfer Request
     * Transfer
     * /api/v1/broker/nd/transfer
     */
    public function testTransferRequest()
    {
        $data =
            "{\"currency\": \"USDT\", \"amount\": \"1\", \"clientOid\": \"e6c24d23-6bc2-401b-bf9e-55e2daddfbc1\", \"direction\": \"OUT\", \"accountType\": \"MAIN\", \"specialUid\": \"226383154\", \"specialAccountType\": \"MAIN\"}";
        $req = TransferReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * transfer Response
     * Transfer
     * /api/v1/broker/nd/transfer
     */
    public function testTransferResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671b4600c1e3dd000726866d\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = TransferResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getTransferHistory Request
     * Get Transfer History
     * /api/v3/broker/nd/transfer/detail
     */
    public function testGetTransferHistoryRequest()
    {
        $data = "{\"orderId\": \"671b4600c1e3dd000726866d\"}";
        $req = GetTransferHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTransferHistory Response
     * Get Transfer History
     * /api/v3/broker/nd/transfer/detail
     */
    public function testGetTransferHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"671b4600c1e3dd000726866d\",\n        \"currency\": \"USDT\",\n        \"amount\": \"1\",\n        \"fromUid\": 165111215,\n        \"fromAccountType\": \"MAIN\",\n        \"fromAccountTag\": \"DEFAULT\",\n        \"toUid\": 226383154,\n        \"toAccountType\": \"MAIN\",\n        \"toAccountTag\": \"DEFAULT\",\n        \"status\": \"SUCCESS\",\n        \"reason\": null,\n        \"createdAt\": 1729840640000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTransferHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositList Request
     * Get Deposit List
     * /api/v1/asset/ndbroker/deposit/list
     */
    public function testGetDepositListRequest()
    {
        $data =
            "{\"currency\": \"USDT\", \"status\": \"SUCCESS\", \"hash\": \"example_string_default_value\", \"startTimestamp\": 123456, \"endTimestamp\": 123456, \"limit\": 100}";
        $req = GetDepositListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositList Response
     * Get Deposit List
     * /api/v1/asset/ndbroker/deposit/list
     */
    public function testGetDepositListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"uid\": 165111215,\n            \"hash\": \"6724e363a492800007ec602b\",\n            \"address\": \"xxxxxxx@gmail.com\",\n            \"memo\": \"\",\n            \"amount\": \"3.0\",\n            \"fee\": \"0.0\",\n            \"currency\": \"USDT\",\n            \"isInner\": true,\n            \"walletTxId\": \"bbbbbbbbb\",\n            \"status\": \"SUCCESS\",\n            \"chain\": \"\",\n            \"remark\": \"\",\n            \"createdAt\": 1730470760000,\n            \"updatedAt\": 1730470760000\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositDetail Request
     * Get Deposit Detail
     * /api/v3/broker/nd/deposit/detail
     */
    public function testGetDepositDetailRequest()
    {
        $data = "{\"currency\": \"USDT\", \"hash\": \"30bb0e0b***4156c5188\"}";
        $req = GetDepositDetailReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositDetail Response
     * Get Deposit Detail
     * /api/v3/broker/nd/deposit/detail
     */
    public function testGetDepositDetailResponse()
    {
        $data =
            "{\n  \"data\" : {\n    \"chain\" : \"trx\",\n    \"hash\" : \"30bb0e0b***4156c5188\",\n    \"walletTxId\" : \"30bb0***610d1030f\",\n    \"uid\" : 201496341,\n    \"updatedAt\" : 1713429174000,\n    \"amount\" : \"8.5\",\n    \"memo\" : \"\",\n    \"fee\" : \"0.0\",\n    \"address\" : \"THLPzUrbd1o***vP7d\",\n    \"remark\" : \"Deposit\",\n    \"isInner\" : false,\n    \"currency\" : \"USDT\",\n    \"status\" : \"SUCCESS\",\n    \"createdAt\" : 1713429173000\n  },\n  \"code\" : \"200000\"\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getWithdrawDetail Request
     * Get Withdraw Detail
     * /api/v3/broker/nd/withdraw/detail
     */
    public function testGetWithdrawDetailRequest()
    {
        $data = "{\"withdrawalId\": \"66617a2***3c9a\"}";
        $req = GetWithdrawDetailReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getWithdrawDetail Response
     * Get Withdraw Detail
     * /api/v3/broker/nd/withdraw/detail
     */
    public function testGetWithdrawDetailResponse()
    {
        $data =
            "{\n    \"data\": {\n        \"id\": \"66617a2***3c9a\",\n        \"chain\": \"ton\",\n        \"walletTxId\": \"AJ***eRI=\",\n        \"uid\": 157267400,\n        \"amount\": \"1.00000000\",\n        \"memo\": \"7025734\",\n        \"fee\": \"0.00000000\",\n        \"address\": \"EQDn***dKbGzr\",\n        \"remark\": \"\",\n        \"isInner\": false,\n        \"currency\": \"USDT\",\n        \"status\": \"SUCCESS\",\n        \"createdAt\": 1717664288000,\n        \"updatedAt\": 1717664375000\n    },\n    \"code\": \"200000\"\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetWithdrawDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getRebase Request
     * Get Broker Rebate
     * /api/v1/broker/nd/rebase/download
     */
    public function testGetRebaseRequest()
    {
        $data =
            "{\"begin\": \"20240610\", \"end\": \"20241010\", \"tradeType\": \"1\"}";
        $req = GetRebaseReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getRebase Response
     * Get Broker Rebate
     * /api/v1/broker/nd/rebase/download
     */
    public function testGetRebaseResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"url\": \"https://kc-v2-promotion.s3.ap-northeast-1.amazonaws.com/broker/671aec522593f600019766d0_file.csv?X-Amz-Security-Token=IQo*********2cd90f14efb\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetRebaseResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
