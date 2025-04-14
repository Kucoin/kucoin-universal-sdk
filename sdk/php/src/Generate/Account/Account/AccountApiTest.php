<?php
namespace KuCoin\UniversalSDK\Generate\Account\Account;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AccountApiTest extends TestCase
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
     * getAccountInfo Request
     * Get Account Summary Info
     * /api/v2/user-info
     */
    public function testGetAccountInfoRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getAccountInfo Response
     * Get Account Summary Info
     * /api/v2/user-info
     */
    public function testGetAccountInfoResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"level\": 0,\n        \"subQuantity\": 3,\n        \"spotSubQuantity\": 3,\n        \"marginSubQuantity\": 2,\n        \"futuresSubQuantity\": 2,\n        \"optionSubQuantity\": 0,\n        \"maxSubQuantity\": 5,\n        \"maxDefaultSubQuantity\": 5,\n        \"maxSpotSubQuantity\": 0,\n        \"maxMarginSubQuantity\": 0,\n        \"maxFuturesSubQuantity\": 0,\n        \"maxOptionSubQuantity\": 0\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetAccountInfoResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getApikeyInfo Request
     * Get Apikey Info
     * /api/v1/user/api-key
     */
    public function testGetApikeyInfoRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getApikeyInfo Response
     * Get Apikey Info
     * /api/v1/user/api-key
     */
    public function testGetApikeyInfoResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"remark\": \"account1\",\n        \"apiKey\": \"6705f5c311545b000157d3eb\",\n        \"apiVersion\": 3,\n        \"permission\": \"General,Futures,Spot,Earn,InnerTransfer,Transfer,Margin\",\n        \"ipWhitelist\": \"203.**.154,103.**.34\",\n        \"createdAt\": 1728443843000,\n        \"uid\": 165111215,\n        \"isMaster\": true\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetApikeyInfoResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotAccountType Request
     * Get Account Type - Spot
     * /api/v1/hf/accounts/opened
     */
    public function testGetSpotAccountTypeRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getSpotAccountType Response
     * Get Account Type - Spot
     * /api/v1/hf/accounts/opened
     */
    public function testGetSpotAccountTypeResponse()
    {
        $data = "{\"code\":\"200000\",\"data\":false}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotAccountTypeResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotAccountList Request
     * Get Account List - Spot
     * /api/v1/accounts
     */
    public function testGetSpotAccountListRequest()
    {
        $data = "{\"currency\": \"USDT\", \"type\": \"main\"}";
        $req = GetSpotAccountListReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotAccountList Response
     * Get Account List - Spot
     * /api/v1/accounts
     */
    public function testGetSpotAccountListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"548674591753\",\n            \"currency\": \"USDT\",\n            \"type\": \"trade\",\n            \"balance\": \"26.66759503\",\n            \"available\": \"26.66759503\",\n            \"holds\": \"0\"\n        },\n        {\n            \"id\": \"63355cd156298d0001b66e61\",\n            \"currency\": \"USDT\",\n            \"type\": \"main\",\n            \"balance\": \"0.01\",\n            \"available\": \"0.01\",\n            \"holds\": \"0\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotAccountListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotAccountDetail Request
     * Get Account Detail - Spot
     * /api/v1/accounts/{accountId}
     */
    public function testGetSpotAccountDetailRequest()
    {
        $data = "{\"accountId\": \"548674591753\"}";
        $req = GetSpotAccountDetailReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotAccountDetail Response
     * Get Account Detail - Spot
     * /api/v1/accounts/{accountId}
     */
    public function testGetSpotAccountDetailResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"currency\":\"USDT\",\"balance\":\"26.66759503\",\"available\":\"26.66759503\",\"holds\":\"0\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotAccountDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getCrossMarginAccount Request
     * Get Account - Cross Margin
     * /api/v3/margin/accounts
     */
    public function testGetCrossMarginAccountRequest()
    {
        $data = "{\"quoteCurrency\": \"USDT\", \"queryType\": \"MARGIN\"}";
        $req = GetCrossMarginAccountReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getCrossMarginAccount Response
     * Get Account - Cross Margin
     * /api/v3/margin/accounts
     */
    public function testGetCrossMarginAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"totalAssetOfQuoteCurrency\": \"0.02\",\n        \"totalLiabilityOfQuoteCurrency\": \"0\",\n        \"debtRatio\": \"0\",\n        \"status\": \"EFFECTIVE\",\n        \"accounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"total\": \"0.02\",\n                \"available\": \"0.02\",\n                \"hold\": \"0\",\n                \"liability\": \"0\",\n                \"maxBorrowSize\": \"0\",\n                \"borrowEnabled\": true,\n                \"transferInEnabled\": true\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetCrossMarginAccountResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getIsolatedMarginAccount Request
     * Get Account - Isolated Margin
     * /api/v3/isolated/accounts
     */
    public function testGetIsolatedMarginAccountRequest()
    {
        $data =
            "{\"symbol\": \"example_string_default_value\", \"quoteCurrency\": \"USDT\", \"queryType\": \"ISOLATED\"}";
        $req = GetIsolatedMarginAccountReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getIsolatedMarginAccount Response
     * Get Account - Isolated Margin
     * /api/v3/isolated/accounts
     */
    public function testGetIsolatedMarginAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"totalAssetOfQuoteCurrency\": \"0.01\",\n        \"totalLiabilityOfQuoteCurrency\": \"0\",\n        \"timestamp\": 1728725465994,\n        \"assets\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"status\": \"EFFECTIVE\",\n                \"debtRatio\": \"0\",\n                \"baseAsset\": {\n                    \"currency\": \"BTC\",\n                    \"borrowEnabled\": true,\n                    \"transferInEnabled\": true,\n                    \"liability\": \"0\",\n                    \"total\": \"0\",\n                    \"available\": \"0\",\n                    \"hold\": \"0\",\n                    \"maxBorrowSize\": \"0\"\n                },\n                \"quoteAsset\": {\n                    \"currency\": \"USDT\",\n                    \"borrowEnabled\": true,\n                    \"transferInEnabled\": true,\n                    \"liability\": \"0\",\n                    \"total\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"hold\": \"0\",\n                    \"maxBorrowSize\": \"0\"\n                }\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetIsolatedMarginAccountResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFuturesAccount Request
     * Get Account - Futures
     * /api/v1/account-overview
     */
    public function testGetFuturesAccountRequest()
    {
        $data = "{\"currency\": \"USDT\"}";
        $req = GetFuturesAccountReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFuturesAccount Response
     * Get Account - Futures
     * /api/v1/account-overview
     */
    public function testGetFuturesAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"accountEquity\": 394.439280806,\n        \"unrealisedPNL\": 20.15278,\n        \"marginBalance\": 371.394298816,\n        \"positionMargin\": 102.20664159,\n        \"orderMargin\": 10.06002012,\n        \"frozenFunds\": 0.0,\n        \"availableBalance\": 290.326799096,\n        \"currency\": \"USDT\",\n        \"riskRatio\": 0.0065289525,\n        \"maxWithdrawAmount\": 290.326419096\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFuturesAccountResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotLedger Request
     * Get Account Ledgers - Spot/Margin
     * /api/v1/accounts/ledgers
     */
    public function testGetSpotLedgerRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"direction\": \"in\", \"bizType\": \"TRANSFER\", \"startAt\": 1728663338000, \"endAt\": 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
        $req = GetSpotLedgerReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotLedger Response
     * Get Account Ledgers - Spot/Margin
     * /api/v1/accounts/ledgers
     */
    public function testGetSpotLedgerResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 50,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"id\": \"265329987780896\",\n                \"currency\": \"USDT\",\n                \"amount\": \"0.01\",\n                \"fee\": \"0\",\n                \"balance\": \"0\",\n                \"accountType\": \"TRADE\",\n                \"bizType\": \"SUB_TRANSFER\",\n                \"direction\": \"out\",\n                \"createdAt\": 1728658481484,\n                \"context\": \"\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotLedgerResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotHFLedger Request
     * Get Account Ledgers - Trade_hf
     * /api/v1/hf/accounts/ledgers
     */
    public function testGetSpotHFLedgerRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"direction\": \"in\", \"bizType\": \"TRANSFER\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetSpotHFLedgerReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotHFLedger Response
     * Get Account Ledgers - Trade_hf
     * /api/v1/hf/accounts/ledgers
     */
    public function testGetSpotHFLedgerResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"id\": \"254062248624417\",\n            \"currency\": \"USDT\",\n            \"amount\": \"1.59760080\",\n            \"fee\": \"0.00159920\",\n            \"tax\": \"0\",\n            \"balance\": \"26.73759503\",\n            \"accountType\": \"TRADE_HF\",\n            \"bizType\": \"TRADE_EXCHANGE\",\n            \"direction\": \"in\",\n            \"createdAt\": \"1728443957539\",\n            \"context\": \"{\\\"symbol\\\":\\\"KCS-USDT\\\",\\\"orderId\\\":\\\"6705f6350dc7210007d6a36d\\\",\\\"tradeId\\\":\\\"10046097631627265\\\"}\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotHFLedgerResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarginHFLedger Request
     * Get Account Ledgers - Margin_hf
     * /api/v3/hf/margin/account/ledgers
     */
    public function testGetMarginHFLedgerRequest()
    {
        $data =
            "{\"currency\": \"BTC\", \"direction\": \"in\", \"bizType\": \"TRANSFER\", \"lastId\": 254062248624417, \"limit\": 100, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetMarginHFLedgerReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getMarginHFLedger Response
     * Get Account Ledgers - Margin_hf
     * /api/v3/hf/margin/account/ledgers
     */
    public function testGetMarginHFLedgerResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":[{\"id\":1949641706720,\"currency\":\"USDT\",\"amount\":\"0.01000000\",\"fee\":\"0.00000000\",\"balance\":\"0.01000000\",\"accountType\":\"MARGIN_V2\",\"bizType\":\"TRANSFER\",\"direction\":\"in\",\"createdAt\":1728664091208,\"context\":\"{}\",\"tax\":\"0.00000000\"}]}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarginHFLedgerResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFuturesLedger Request
     * Get Account Ledgers - Futures
     * /api/v1/transaction-history
     */
    public function testGetFuturesLedgerRequest()
    {
        $data =
            "{\"currency\": \"XBT\", \"type\": \"Transferin\", \"offset\": 254062248624417, \"forward\": true, \"maxCount\": 50, \"startAt\": 1728663338000, \"endAt\": 1728692138000}";
        $req = GetFuturesLedgerReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFuturesLedger Response
     * Get Account Ledgers - Futures
     * /api/v1/transaction-history
     */
    public function testGetFuturesLedgerResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"dataList\": [\n            {\n                \"time\": 1728665747000,\n                \"type\": \"TransferIn\",\n                \"amount\": 0.01,\n                \"fee\": 0.0,\n                \"accountEquity\": 14.02924938,\n                \"status\": \"Completed\",\n                \"remark\": \"Transferred from High-Frequency Trading Account\",\n                \"offset\": 51360793,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"time\": 1728648000000,\n                \"type\": \"RealisedPNL\",\n                \"amount\": 0.00630042,\n                \"fee\": 0.0,\n                \"accountEquity\": 20.0,\n                \"status\": \"Completed\",\n                \"remark\": \"XBTUSDTM\",\n                \"offset\": 51352430,\n                \"currency\": \"USDT\"\n            }\n        ],\n        \"hasMore\": false\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFuturesLedgerResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getMarginAccountDetail Request
     * Get Account Detail - Margin
     * /api/v1/margin/account
     */
    public function testGetMarginAccountDetailRequest()
    {
        $this->assertTrue(true);
    }

    /**
     * getMarginAccountDetail Response
     * Get Account Detail - Margin
     * /api/v1/margin/account
     */
    public function testGetMarginAccountDetailResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"debtRatio\": \"0\",\n        \"accounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"totalBalance\": \"0.03\",\n                \"availableBalance\": \"0.02\",\n                \"holdBalance\": \"0.01\",\n                \"liability\": \"0\",\n                \"maxBorrowSize\": \"0\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetMarginAccountDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getIsolatedMarginAccountListV1 Request
     * Get Account List - Isolated Margin - V1
     * /api/v1/isolated/accounts
     */
    public function testGetIsolatedMarginAccountListV1Request()
    {
        $data = "{\"balanceCurrency\": \"USDT\"}";
        $req = GetIsolatedMarginAccountListV1Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getIsolatedMarginAccountListV1 Response
     * Get Account List - Isolated Margin - V1
     * /api/v1/isolated/accounts
     */
    public function testGetIsolatedMarginAccountListV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"totalConversionBalance\": \"0.01\",\n        \"liabilityConversionBalance\": \"0\",\n        \"assets\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"status\": \"CLEAR\",\n                \"debtRatio\": \"0\",\n                \"baseAsset\": {\n                    \"currency\": \"BTC\",\n                    \"totalBalance\": \"0\",\n                    \"holdBalance\": \"0\",\n                    \"availableBalance\": \"0\",\n                    \"liability\": \"0\",\n                    \"interest\": \"0\",\n                    \"borrowableAmount\": \"0\"\n                },\n                \"quoteAsset\": {\n                    \"currency\": \"USDT\",\n                    \"totalBalance\": \"0.01\",\n                    \"holdBalance\": \"0\",\n                    \"availableBalance\": \"0.01\",\n                    \"liability\": \"0\",\n                    \"interest\": \"0\",\n                    \"borrowableAmount\": \"0\"\n                }\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetIsolatedMarginAccountListV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getIsolatedMarginAccountDetailV1 Request
     * Get Account Detail - Isolated Margin - V1
     * /api/v1/isolated/account/{symbol}
     */
    public function testGetIsolatedMarginAccountDetailV1Request()
    {
        $data = "{\"symbol\": \"example_string_default_value\"}";
        $req = GetIsolatedMarginAccountDetailV1Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getIsolatedMarginAccountDetailV1 Response
     * Get Account Detail - Isolated Margin - V1
     * /api/v1/isolated/account/{symbol}
     */
    public function testGetIsolatedMarginAccountDetailV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"BTC-USDT\",\n        \"status\": \"CLEAR\",\n        \"debtRatio\": \"0\",\n        \"baseAsset\": {\n            \"currency\": \"BTC\",\n            \"totalBalance\": \"0\",\n            \"holdBalance\": \"0\",\n            \"availableBalance\": \"0\",\n            \"liability\": \"0\",\n            \"interest\": \"0\",\n            \"borrowableAmount\": \"0\"\n        },\n        \"quoteAsset\": {\n            \"currency\": \"USDT\",\n            \"totalBalance\": \"0.01\",\n            \"holdBalance\": \"0\",\n            \"availableBalance\": \"0.01\",\n            \"liability\": \"0\",\n            \"interest\": \"0\",\n            \"borrowableAmount\": \"0\"\n        }\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetIsolatedMarginAccountDetailV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
