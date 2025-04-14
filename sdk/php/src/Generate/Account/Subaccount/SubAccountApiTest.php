<?php
namespace KuCoin\UniversalSDK\Generate\Account\Subaccount;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use KuCoin\UniversalSDK\Internal\Utils\JsonSerializedHandler;
use KuCoin\UniversalSDK\Model\RestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class SubAccountApiTest extends TestCase
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
     * addSubAccount Request
     * Add sub-account
     * /api/v2/sub/user/created
     */
    public function testAddSubAccountRequest()
    {
        $data =
            "{\"password\": \"1234567\", \"remarks\": \"TheRemark\", \"subName\": \"Name1234567\", \"access\": \"Spot\"}";
        $req = AddSubAccountReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccount Response
     * Add sub-account
     * /api/v2/sub/user/created
     */
    public function testAddSubAccountResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"userId\": \"63743f07e0c5230001761d08\",\n                \"uid\": 169579801,\n                \"subName\": \"testapi6\",\n                \"status\": 2,\n                \"type\": 0,\n                \"access\": \"All\",\n                \"createdAt\": 1668562696000,\n                \"remarks\": \"remarks\",\n                \"tradeTypes\": [\n                    \"Spot\",\n                    \"Futures\",\n                    \"Margin\"\n                ],\n                \"openedTradeTypes\": [\n                    \"Spot\"\n                ],\n                \"hostedStatus\": null\n            }\n        ]\n    }\n}";
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
     * addSubAccountMarginPermission Request
     * Add sub-account Margin Permission
     * /api/v3/sub/user/margin/enable
     */
    public function testAddSubAccountMarginPermissionRequest()
    {
        $data = "{\"uid\": \"169579801\"}";
        $req = AddSubAccountMarginPermissionReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccountMarginPermission Response
     * Add sub-account Margin Permission
     * /api/v3/sub/user/margin/enable
     */
    public function testAddSubAccountMarginPermissionResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": null\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddSubAccountMarginPermissionResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addSubAccountFuturesPermission Request
     * Add sub-account Futures Permission
     * /api/v3/sub/user/futures/enable
     */
    public function testAddSubAccountFuturesPermissionRequest()
    {
        $data = "{\"uid\": \"169579801\"}";
        $req = AddSubAccountFuturesPermissionReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccountFuturesPermission Response
     * Add sub-account Futures Permission
     * /api/v3/sub/user/futures/enable
     */
    public function testAddSubAccountFuturesPermissionResponse()
    {
        $data = "{\n    \"code\": \"200000\",\n    \"data\": null\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = AddSubAccountFuturesPermissionResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotSubAccountsSummaryV2 Request
     * Get sub-account List - Summary Info
     * /api/v2/sub/user
     */
    public function testGetSpotSubAccountsSummaryV2Request()
    {
        $data = "{\"currentPage\": 1, \"pageSize\": 10}";
        $req = GetSpotSubAccountsSummaryV2Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotSubAccountsSummaryV2 Response
     * Get sub-account List - Summary Info
     * /api/v2/sub/user
     */
    public function testGetSpotSubAccountsSummaryV2Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"userId\": \"63743f07e0c5230001761d08\",\n                \"uid\": 169579801,\n                \"subName\": \"testapi6\",\n                \"status\": 2,\n                \"type\": 0,\n                \"access\": \"All\",\n                \"createdAt\": 1668562696000,\n                \"remarks\": \"remarks\",\n                \"tradeTypes\": [\n                    \"Spot\",\n                    \"Futures\",\n                    \"Margin\"\n                ],\n                \"openedTradeTypes\": [\n                    \"Spot\"\n                ],\n                \"hostedStatus\": null\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotSubAccountsSummaryV2Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotSubAccountDetail Request
     * Get sub-account Detail - Balance
     * /api/v1/sub-accounts/{subUserId}
     */
    public function testGetSpotSubAccountDetailRequest()
    {
        $data =
            "{\"subUserId\": \"63743f07e0c5230001761d08\", \"includeBaseAmount\": true, \"baseCurrency\": \"example_string_default_value\", \"baseAmount\": \"example_string_default_value\"}";
        $req = GetSpotSubAccountDetailReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotSubAccountDetail Response
     * Get sub-account Detail - Balance
     * /api/v1/sub-accounts/{subUserId}
     */
    public function testGetSpotSubAccountDetailResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subUserId\": \"63743f07e0c5230001761d08\",\n        \"subName\": \"testapi6\",\n        \"mainAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"tradeAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"marginAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"tradeHFAccounts\": []\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotSubAccountDetailResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotSubAccountListV2 Request
     * Get sub-account List - Spot Balance (V2)
     * /api/v2/sub-accounts
     */
    public function testGetSpotSubAccountListV2Request()
    {
        $data = "{\"currentPage\": 1, \"pageSize\": 10}";
        $req = GetSpotSubAccountListV2Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSpotSubAccountListV2 Response
     * Get sub-account List - Spot Balance (V2)
     * /api/v2/sub-accounts
     */
    public function testGetSpotSubAccountListV2Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 3,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"subUserId\": \"63743f07e0c5230001761d08\",\n                \"subName\": \"testapi6\",\n                \"mainAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"tradeAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"marginAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"tradeHFAccounts\": []\n            },\n            {\n                \"subUserId\": \"670538a31037eb000115b076\",\n                \"subName\": \"Name1234567\",\n                \"mainAccounts\": [],\n                \"tradeAccounts\": [],\n                \"marginAccounts\": [],\n                \"tradeHFAccounts\": []\n            },\n            {\n                \"subUserId\": \"66b0c0905fc1480001c14c36\",\n                \"subName\": \"LTkucoin1491\",\n                \"mainAccounts\": [],\n                \"tradeAccounts\": [],\n                \"marginAccounts\": [],\n                \"tradeHFAccounts\": []\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotSubAccountListV2Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getFuturesSubAccountListV2 Request
     * Get sub-account List - Futures Balance (V2)
     * /api/v1/account-overview-all
     */
    public function testGetFuturesSubAccountListV2Request()
    {
        $data = "{\"currency\": \"USDT\"}";
        $req = GetFuturesSubAccountListV2Req::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getFuturesSubAccountListV2 Response
     * Get sub-account List - Futures Balance (V2)
     * /api/v1/account-overview-all
     */
    public function testGetFuturesSubAccountListV2Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"summary\": {\n            \"accountEquityTotal\": 103.899081508,\n            \"unrealisedPNLTotal\": 38.81075,\n            \"marginBalanceTotal\": 65.336985668,\n            \"positionMarginTotal\": 68.9588320683,\n            \"orderMarginTotal\": 0,\n            \"frozenFundsTotal\": 0,\n            \"availableBalanceTotal\": 67.2492494397,\n            \"currency\": \"USDT\"\n        },\n        \"accounts\": [\n            {\n                \"accountName\": \"Name1234567\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"LTkucoin1491\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"manage112233\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"testapi6\",\n                \"accountEquity\": 27.30545128,\n                \"unrealisedPNL\": 22.549,\n                \"marginBalance\": 4.75645128,\n                \"positionMargin\": 24.1223749975,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 25.7320762825,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"main\",\n                \"accountEquity\": 76.593630228,\n                \"unrealisedPNL\": 16.26175,\n                \"marginBalance\": 60.580534388,\n                \"positionMargin\": 44.8364570708,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 41.5171731572,\n                \"currency\": \"USDT\"\n            }\n        ]\n    }\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetFuturesSubAccountListV2Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * addSubAccountApi Request
     * Add sub-account API
     * /api/v1/sub/api-key
     */
    public function testAddSubAccountApiRequest()
    {
        $data =
            "{\"subName\": \"testapi6\", \"passphrase\": \"11223344\", \"remark\": \"TheRemark\", \"permission\": \"General,Spot,Futures\"}";
        $req = AddSubAccountApiReq::jsonDeserialize($data, $this->serializer);
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * addSubAccountApi Response
     * Add sub-account API
     * /api/v1/sub/api-key
     */
    public function testAddSubAccountApiResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subName\": \"testapi6\",\n        \"remark\": \"TheRemark\",\n        \"apiKey\": \"670621e3a25958000159c82f\",\n        \"apiSecret\": \"46fd8974******896f005b2340\",\n        \"apiVersion\": 3,\n        \"passphrase\": \"11223344\",\n        \"permission\": \"General,Futures\",\n        \"createdAt\": 1728455139000\n    }\n}";
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
     * modifySubAccountApi Request
     * Modify sub-account API
     * /api/v1/sub/api-key/update
     */
    public function testModifySubAccountApiRequest()
    {
        $data =
            "{\"subName\": \"testapi6\", \"apiKey\": \"670621e3a25958000159c82f\", \"passphrase\": \"11223344\", \"permission\": \"General,Spot,Futures\"}";
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
     * /api/v1/sub/api-key/update
     */
    public function testModifySubAccountApiResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subName\": \"testapi6\",\n        \"apiKey\": \"670621e3a25958000159c82f\",\n        \"permission\": \"General,Futures,Spot\"\n    }\n}";
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
     * getSubAccountApiList Request
     * Get sub-account API List
     * /api/v1/sub/api-key
     */
    public function testGetSubAccountApiListRequest()
    {
        $data =
            "{\"apiKey\": \"example_string_default_value\", \"subName\": \"testapi6\"}";
        $req = GetSubAccountApiListReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * getSubAccountApiList Response
     * Get sub-account API List
     * /api/v1/sub/api-key
     */
    public function testGetSubAccountApiListResponse()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"subName\": \"apiSdkTest\",\n            \"remark\": \"sdk_test_integration\",\n            \"apiKey\": \"673eab2a955ebf000195d7e4\",\n            \"apiVersion\": 3,\n            \"permission\": \"General\",\n            \"ipWhitelist\": \"10.**.1\",\n            \"createdAt\": 1732160298000,\n            \"uid\": 215112467,\n            \"isMaster\": false\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSubAccountApiListResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * deleteSubAccountApi Request
     * Delete sub-account API
     * /api/v1/sub/api-key
     */
    public function testDeleteSubAccountApiRequest()
    {
        $data =
            "{\"apiKey\": \"670621e3a25958000159c82f\", \"subName\": \"testapi6\", \"passphrase\": \"11223344\"}";
        $req = DeleteSubAccountApiReq::jsonDeserialize(
            $data,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($req));
        echo $req->jsonSerialize($this->serializer);
    }

    /**
     * deleteSubAccountApi Response
     * Delete sub-account API
     * /api/v1/sub/api-key
     */
    public function testDeleteSubAccountApiResponse()
    {
        $data =
            "{\"code\":\"200000\",\"data\":{\"subName\":\"testapi6\",\"apiKey\":\"670621e3a25958000159c82f\"}}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = DeleteSubAccountApiResp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotSubAccountsSummaryV1 Request
     * Get sub-account List - Summary Info (V1)
     * /api/v1/sub/user
     */
    public function testGetSpotSubAccountsSummaryV1Request()
    {
        $this->assertTrue(true);
    }

    /**
     * getSpotSubAccountsSummaryV1 Response
     * Get sub-account List - Summary Info (V1)
     * /api/v1/sub/user
     */
    public function testGetSpotSubAccountsSummaryV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"userId\": \"63743f07e0c5230001761d08\",\n            \"uid\": 169579801,\n            \"subName\": \"testapi6\",\n            \"type\": 0,\n            \"remarks\": \"remarks\",\n            \"access\": \"All\"\n        },\n        {\n            \"userId\": \"670538a31037eb000115b076\",\n            \"uid\": 225139445,\n            \"subName\": \"Name1234567\",\n            \"type\": 0,\n            \"remarks\": \"TheRemark\",\n            \"access\": \"All\"\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotSubAccountsSummaryV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
    /**
     * getSpotSubAccountListV1 Request
     * Get sub-account List - Spot Balance (V1)
     * /api/v1/sub-accounts
     */
    public function testGetSpotSubAccountListV1Request()
    {
        $this->assertTrue(true);
    }

    /**
     * getSpotSubAccountListV1 Response
     * Get sub-account List - Spot Balance (V1)
     * /api/v1/sub-accounts
     */
    public function testGetSpotSubAccountListV1Response()
    {
        $data =
            "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"subUserId\": \"63743f07e0c5230001761d08\",\n            \"subName\": \"testapi6\",\n            \"mainAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"tradeAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"marginAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"tradeHFAccounts\": []\n        },\n        {\n            \"subUserId\": \"670538a31037eb000115b076\",\n            \"subName\": \"Name1234567\",\n            \"mainAccounts\": [],\n            \"tradeAccounts\": [],\n            \"marginAccounts\": [],\n            \"tradeHFAccounts\": []\n        },\n        {\n            \"subUserId\": \"66b0c0905fc1480001c14c36\",\n            \"subName\": \"LTkucoin1491\",\n            \"mainAccounts\": [],\n            \"tradeAccounts\": [],\n            \"marginAccounts\": [],\n            \"tradeHFAccounts\": []\n        }\n    ]\n}";
        $commonResp = RestResponse::jsonDeserialize($data, $this->serializer);
        $respData = $this->serializer->serialize($commonResp->data, "json");
        $resp = GetSpotSubAccountListV1Resp::jsonDeserialize(
            $respData,
            $this->serializer
        );
        $this->assertTrue($this->hasAnyNoneNull($resp));
        echo $resp->jsonSerialize($this->serializer);
    }
}
