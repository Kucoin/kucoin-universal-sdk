<?php
namespace KuCoin\UniversalSDK\Generate\Account\Deposit;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class DepositApiTest extends TestCase
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
     * addDepositAddressV3 Request
     * Add Deposit Address (V3)
     * /api/v3/deposit-address/create
     */
    public function testAddDepositAddressV3Request()
    {
        $data =
            "{\"currency\": \"TON\", \"chain\": \"ton\", \"to\": \"trade\"}";
        $req = AddDepositAddressV3Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addDepositAddressV3 Response
     * Add Deposit Address (V3)
     * /api/v3/deposit-address/create
     */
    public function testAddDepositAddressV3Response()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"address\":\"EQCA1BI4QRZ8qYmskSRDzJmkucGodYRTZCf_b9hckjla6dZl\",\"memo\":\"2090821203\",\"chainId\":\"ton\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"TON\",\"chainName\":\"TON\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddDepositAddressV3Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositAddressV3 Request
     * Get Deposit Address (V3)
     * /api/v3/deposit-addresses
     */
    public function testGetDepositAddressV3Request()
    {
        $data =
            "{\"currency\": \"BTC\", \"amount\": \"example_string_default_value\", \"chain\": \"eth\"}";
        $req = GetDepositAddressV3Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositAddressV3 Response
     * Get Deposit Address (V3)
     * /api/v3/deposit-addresses
     */
    public function testGetDepositAddressV3Response()
    {
        $data =
            "{\"code\":\"200000\",\"data\":[{\"address\":\"TSv3L1fS7yA3SxzKD8c1qdX4nLP6rqNxYz\",\"memo\":\"\",\"chainId\":\"trx\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t\",\"chainName\":\"TRC20\"},{\"address\":\"0x551e823a3b36865e8c5dc6e6ac6cc0b00d98533e\",\"memo\":\"\",\"chainId\":\"kcc\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"0x0039f574ee5cc39bdd162e9a88e3eb1f111baf48\",\"chainName\":\"KCC\"},{\"address\":\"EQCA1BI4QRZ8qYmskSRDzJmkucGodYRTZCf_b9hckjla6dZl\",\"memo\":\"2085202643\",\"chainId\":\"ton\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"EQCxE6mUtQJKFnGfaROTKOt1lZbDiiX1kCixRv7Nw2Id_sDs\",\"chainName\":\"TON\"},{\"address\":\"0x0a2586d5a901c8e7e68f6b0dc83bfd8bd8600ff5\",\"memo\":\"\",\"chainId\":\"eth\",\"to\":\"MAIN\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"0xdac17f958d2ee523a2206206994597c13d831ec7\",\"chainName\":\"ERC20\"}]}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositAddressV3Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositHistory Request
     * Get Deposit History
     * /api/v1/deposits
     */
    public function testGetDepositHistoryRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetDepositHistoryReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositHistory Response
     * Get Deposit History
     * /api/v1/deposits
     */
    public function testGetDepositHistoryResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 5,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"currency\": \"USDT\",\n                \"chain\": \"\",\n                \"status\": \"SUCCESS\",\n                \"address\": \"a435*****@gmail.com\",\n                \"memo\": \"\",\n                \"isInner\": true,\n                \"amount\": \"1.00000000\",\n                \"fee\": \"0.00000000\",\n                \"walletTxId\": null,\n                \"createdAt\": 1728555875000,\n                \"updatedAt\": 1728555875000,\n                \"remark\": \"\",\n                \"arrears\": false\n            },\n            {\n                \"currency\": \"USDT\",\n                \"chain\": \"trx\",\n                \"status\": \"SUCCESS\",\n                \"address\": \"TSv3L1fS7******X4nLP6rqNxYz\",\n                \"memo\": \"\",\n                \"isInner\": true,\n                \"amount\": \"6.00000000\",\n                \"fee\": \"0.00000000\",\n                \"walletTxId\": null,\n                \"createdAt\": 1721730920000,\n                \"updatedAt\": 1721730920000,\n                \"remark\": \"\",\n                \"arrears\": false\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositHistoryResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositAddressV2 Request
     * Get Deposit Addresses (V2)
     * /api/v2/deposit-addresses
     */
    public function testGetDepositAddressV2Request()
    {
        $data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}";
        $req = GetDepositAddressV2Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositAddressV2 Response
     * Get Deposit Addresses (V2)
     * /api/v2/deposit-addresses
     */
    public function testGetDepositAddressV2Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"address\": \"0x02028456*****87ede7a73d7c\",\n            \"memo\": \"\",\n            \"chain\": \"ERC20\",\n            \"chainId\": \"eth\",\n            \"to\": \"MAIN\",\n            \"currency\": \"ETH\",\n            \"contractAddress\": \"\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositAddressV2Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositAddressV1 Request
     * Get Deposit Addresses - V1
     * /api/v1/deposit-addresses
     */
    public function testGetDepositAddressV1Request()
    {
        $data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}";
        $req = GetDepositAddressV1Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositAddressV1 Response
     * Get Deposit Addresses - V1
     * /api/v1/deposit-addresses
     */
    public function testGetDepositAddressV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"address\": \"0xea220bf61c3c2b0adc2cfa29fec3d2677745a379\",\n        \"memo\": \"\",\n        \"chain\": \"ERC20\",\n        \"chainId\": \"eth\",\n        \"to\": \"MAIN\",\n        \"currency\": \"USDT\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositAddressV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getDepositHistoryOld Request
     * Get Deposit History - Old
     * /api/v1/hist-deposits
     */
    public function testGetDepositHistoryOldRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetDepositHistoryOldReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getDepositHistoryOld Response
     * Get Deposit History - Old
     * /api/v1/hist-deposits
     */
    public function testGetDepositHistoryOldResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 0,\n        \"totalPage\": 0,\n        \"items\": [\n            {\n                \"currency\": \"BTC\",\n                \"createAt\": 1528536998,\n                \"amount\": \"0.03266638\",\n                \"walletTxId\": \"55c643bc2c68d6f17266383ac1be9e454038864b929ae7cee0bc408cc5c869e8@12ffGWmMMD1zA1WbFm7Ho3JZ1w6NYXjpFk@234\",\n                \"isInner\": false,\n                \"status\": \"SUCCESS\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetDepositHistoryOldResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addDepositAddressV1 Request
     * Add Deposit Address - V1
     * /api/v1/deposit-addresses
     */
    public function testAddDepositAddressV1Request()
    {
        $data = "{\"currency\": \"ETH\", \"chain\": \"eth\"}";
        $req = AddDepositAddressV1Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addDepositAddressV1 Response
     * Add Deposit Address - V1
     * /api/v1/deposit-addresses
     */
    public function testAddDepositAddressV1Response()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"address\":\"0x02028456f38e78609904e8a002c787ede7a73d7c\",\"memo\":null,\"chain\":\"ERC20\",\"chainId\":\"eth\",\"to\":\"MAIN\",\"currency\":\"ETH\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddDepositAddressV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
