<?php
namespace KuCoin\UniversalSDK\Generate\Account\Transfer;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TransferApiTest extends TestCase
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
     * getTransferQuotas Request
     * Get Transfer Quotas
     * /api/v1/accounts/transferable
     */
    public function testGetTransferQuotasRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"type\": \"MAIN\", \"tag\": \"ETH-USDT\"}";
        $req = GetTransferQuotasReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getTransferQuotas Response
     * Get Transfer Quotas
     * /api/v1/accounts/transferable
     */
    public function testGetTransferQuotasResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"currency\":\"USDT\",\"balance\":\"10.5\",\"available\":\"10.5\",\"holds\":\"0\",\"transferable\":\"10.5\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetTransferQuotasResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * flexTransfer Request
     * Flex Transfer
     * /api/v3/accounts/universal-transfer
     */
    public function testFlexTransferRequest()
    {
        $data =
            "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"type\": \"PARENT_TO_SUB\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"fromAccountType\": \"TRADE\", \"toUserId\": \"63743f07e0c5230001761d08\", \"toAccountType\": \"TRADE\"}";
        $req = FlexTransferReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * flexTransfer Response
     * Flex Transfer
     * /api/v3/accounts/universal-transfer
     */
    public function testFlexTransferResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"orderId\": \"6705f7248c6954000733ecac\"\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = FlexTransferResp::jsonDeserialize($respData, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * subAccountTransfer Request
     * Sub-account Transfer
     * /api/v2/accounts/sub-transfer
     */
    public function testSubAccountTransferRequest()
    {
        $data =
            "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"direction\": \"OUT\", \"accountType\": \"MAIN\", \"subAccountType\": \"MAIN\", \"subUserId\": \"63743f07e0c5230001761d08\"}";
        $req = SubAccountTransferReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * subAccountTransfer Response
     * Sub-account Transfer
     * /api/v2/accounts/sub-transfer
     */
    public function testSubAccountTransferResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"670be6b0b1b9080007040a9b\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = SubAccountTransferResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * innerTransfer Request
     * Internal Transfer
     * /api/v2/accounts/inner-transfer
     */
    public function testInnerTransferRequest()
    {
        $data =
            "{\"clientOid\": \"64ccc0f164781800010d8c09\", \"currency\": \"USDT\", \"amount\": \"0.01\", \"from\": \"main\", \"to\": \"trade\"}";
        $req = InnerTransferReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * innerTransfer Response
     * Internal Transfer
     * /api/v2/accounts/inner-transfer
     */
    public function testInnerTransferResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"orderId\":\"670beb3482a1bb0007dec644\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = InnerTransferResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFuturesAccountTransferOutLedger Request
     * Get Futures Account Transfer Out Ledger
     * /api/v1/transfer-list
     */
    public function testGetFuturesAccountTransferOutLedgerRequest()
    {
        $data =
            "{\"currency\": \"XBT\", \"type\": \"MAIN\", \"tag\": [\"mock_a\", \"mock_b\"], \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetFuturesAccountTransferOutLedgerReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFuturesAccountTransferOutLedger Response
     * Get Futures Account Transfer Out Ledger
     * /api/v1/transfer-list
     */
    public function testGetFuturesAccountTransferOutLedgerResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"currentPage\":1,\"pageSize\":50,\"totalNum\":1,\"totalPage\":1,\"items\":[{\"applyId\":\"670bf84c577f6c00017a1c48\",\"currency\":\"USDT\",\"recRemark\":\"\",\"recSystem\":\"KUCOIN\",\"status\":\"SUCCESS\",\"amount\":\"0.01\",\"reason\":\"\",\"offset\":1519769124134806,\"createdAt\":1728837708000,\"remark\":\"\"}]}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFuturesAccountTransferOutLedgerResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * futuresAccountTransferOut Request
     * Futures Account Transfer Out
     * /api/v3/transfer-out
     */
    public function testFuturesAccountTransferOutRequest()
    {
        $data =
            "{\"currency\": \"USDT\", \"amount\": 0.01, \"recAccountType\": \"MAIN\"}";
        $req = FuturesAccountTransferOutReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * futuresAccountTransferOut Response
     * Futures Account Transfer Out
     * /api/v3/transfer-out
     */
    public function testFuturesAccountTransferOutResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"applyId\": \"670bf84c577f6c00017a1c48\",\n        \"bizNo\": \"670bf84c577f6c00017a1c47\",\n        \"payAccountType\": \"CONTRACT\",\n        \"payTag\": \"DEFAULT\",\n        \"remark\": \"\",\n        \"recAccountType\": \"MAIN\",\n        \"recTag\": \"DEFAULT\",\n        \"recRemark\": \"\",\n        \"recSystem\": \"KUCOIN\",\n        \"status\": \"PROCESSING\",\n        \"currency\": \"USDT\",\n        \"amount\": \"0.01\",\n        \"fee\": \"0\",\n        \"sn\": 1519769124134806,\n        \"reason\": \"\",\n        \"createdAt\": 1728837708000,\n        \"updatedAt\": 1728837708000\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = FuturesAccountTransferOutResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * futuresAccountTransferIn Request
     * Futures Account Transfer In
     * /api/v1/transfer-in
     */
    public function testFuturesAccountTransferInRequest()
    {
        $data =
            "{\"currency\": \"USDT\", \"amount\": 0.01, \"payAccountType\": \"MAIN\"}";
        $req = FuturesAccountTransferInReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * futuresAccountTransferIn Response
     * Futures Account Transfer In
     * /api/v1/transfer-in
     */
    public function testFuturesAccountTransferInResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":null}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = FuturesAccountTransferInResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
