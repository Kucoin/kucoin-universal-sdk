package subaccount

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestSubAccountAddSubAccountReqModel(t *testing.T) {
	// AddSubAccount
	// Add sub-account
	// /api/v2/sub/user/created

	data := "{\"password\": \"1234567\", \"remarks\": \"TheRemark\", \"subName\": \"Name1234567\", \"access\": \"Spot\"}"
	req := &AddSubAccountReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountRespModel(t *testing.T) {
	// AddSubAccount
	// Add sub-account
	// /api/v2/sub/user/created

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"userId\": \"63743f07e0c5230001761d08\",\n                \"uid\": 169579801,\n                \"subName\": \"testapi6\",\n                \"status\": 2,\n                \"type\": 0,\n                \"access\": \"All\",\n                \"createdAt\": 1668562696000,\n                \"remarks\": \"remarks\",\n                \"tradeTypes\": [\n                    \"Spot\",\n                    \"Futures\",\n                    \"Margin\"\n                ],\n                \"openedTradeTypes\": [\n                    \"Spot\"\n                ],\n                \"hostedStatus\": null\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddSubAccountResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountMarginPermissionReqModel(t *testing.T) {
	// AddSubAccountMarginPermission
	// Add sub-account Margin Permission
	// /api/v3/sub/user/margin/enable

	data := "{\"uid\": \"169579801\"}"
	req := &AddSubAccountMarginPermissionReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountMarginPermissionRespModel(t *testing.T) {
	// AddSubAccountMarginPermission
	// Add sub-account Margin Permission
	// /api/v3/sub/user/margin/enable

	data := "{\n    \"code\": \"200000\",\n    \"data\": null\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddSubAccountMarginPermissionResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountFuturesPermissionReqModel(t *testing.T) {
	// AddSubAccountFuturesPermission
	// Add sub-account Futures Permission
	// /api/v3/sub/user/futures/enable

	data := "{\"uid\": \"169579801\"}"
	req := &AddSubAccountFuturesPermissionReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountFuturesPermissionRespModel(t *testing.T) {
	// AddSubAccountFuturesPermission
	// Add sub-account Futures Permission
	// /api/v3/sub/user/futures/enable

	data := "{\n    \"code\": \"200000\",\n    \"data\": null\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddSubAccountFuturesPermissionResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountsSummaryV2ReqModel(t *testing.T) {
	// GetSpotSubAccountsSummaryV2
	// Get sub-account List - Summary Info
	// /api/v2/sub/user

	data := "{\"currentPage\": 1, \"pageSize\": 10}"
	req := &GetSpotSubAccountsSummaryV2Req{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountsSummaryV2RespModel(t *testing.T) {
	// GetSpotSubAccountsSummaryV2
	// Get sub-account List - Summary Info
	// /api/v2/sub/user

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 1,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"userId\": \"63743f07e0c5230001761d08\",\n                \"uid\": 169579801,\n                \"subName\": \"testapi6\",\n                \"status\": 2,\n                \"type\": 0,\n                \"access\": \"All\",\n                \"createdAt\": 1668562696000,\n                \"remarks\": \"remarks\",\n                \"tradeTypes\": [\n                    \"Spot\",\n                    \"Futures\",\n                    \"Margin\"\n                ],\n                \"openedTradeTypes\": [\n                    \"Spot\"\n                ],\n                \"hostedStatus\": null\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotSubAccountsSummaryV2Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountDetailReqModel(t *testing.T) {
	// GetSpotSubAccountDetail
	// Get sub-account Detail - Balance
	// /api/v1/sub-accounts/{subUserId}

	data := "{\"subUserId\": \"63743f07e0c5230001761d08\", \"includeBaseAmount\": true, \"baseCurrency\": \"example_string_default_value\", \"baseAmount\": \"example_string_default_value\"}"
	req := &GetSpotSubAccountDetailReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountDetailRespModel(t *testing.T) {
	// GetSpotSubAccountDetail
	// Get sub-account Detail - Balance
	// /api/v1/sub-accounts/{subUserId}

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subUserId\": \"63743f07e0c5230001761d08\",\n        \"subName\": \"testapi6\",\n        \"mainAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"tradeAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"marginAccounts\": [\n            {\n                \"currency\": \"USDT\",\n                \"balance\": \"0.01\",\n                \"available\": \"0.01\",\n                \"holds\": \"0\",\n                \"baseCurrency\": \"BTC\",\n                \"baseCurrencyPrice\": \"62384.3\",\n                \"baseAmount\": \"0.00000016\",\n                \"tag\": \"DEFAULT\"\n            }\n        ],\n        \"tradeHFAccounts\": []\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotSubAccountDetailResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountListV2ReqModel(t *testing.T) {
	// GetSpotSubAccountListV2
	// Get sub-account List - Spot Balance (V2)
	// /api/v2/sub-accounts

	data := "{\"currentPage\": 1, \"pageSize\": 10}"
	req := &GetSpotSubAccountListV2Req{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountListV2RespModel(t *testing.T) {
	// GetSpotSubAccountListV2
	// Get sub-account List - Spot Balance (V2)
	// /api/v2/sub-accounts

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"currentPage\": 1,\n        \"pageSize\": 10,\n        \"totalNum\": 3,\n        \"totalPage\": 1,\n        \"items\": [\n            {\n                \"subUserId\": \"63743f07e0c5230001761d08\",\n                \"subName\": \"testapi6\",\n                \"mainAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"tradeAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"marginAccounts\": [\n                    {\n                        \"currency\": \"USDT\",\n                        \"balance\": \"0.01\",\n                        \"available\": \"0.01\",\n                        \"holds\": \"0\",\n                        \"baseCurrency\": \"BTC\",\n                        \"baseCurrencyPrice\": \"62514.5\",\n                        \"baseAmount\": \"0.00000015\",\n                        \"tag\": \"DEFAULT\"\n                    }\n                ],\n                \"tradeHFAccounts\": []\n            },\n            {\n                \"subUserId\": \"670538a31037eb000115b076\",\n                \"subName\": \"Name1234567\",\n                \"mainAccounts\": [],\n                \"tradeAccounts\": [],\n                \"marginAccounts\": [],\n                \"tradeHFAccounts\": []\n            },\n            {\n                \"subUserId\": \"66b0c0905fc1480001c14c36\",\n                \"subName\": \"LTkucoin1491\",\n                \"mainAccounts\": [],\n                \"tradeAccounts\": [],\n                \"marginAccounts\": [],\n                \"tradeHFAccounts\": []\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotSubAccountListV2Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetFuturesSubAccountListV2ReqModel(t *testing.T) {
	// GetFuturesSubAccountListV2
	// Get sub-account List - Futures Balance (V2)
	// /api/v1/account-overview-all

	data := "{\"currency\": \"USDT\"}"
	req := &GetFuturesSubAccountListV2Req{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetFuturesSubAccountListV2RespModel(t *testing.T) {
	// GetFuturesSubAccountListV2
	// Get sub-account List - Futures Balance (V2)
	// /api/v1/account-overview-all

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"summary\": {\n            \"accountEquityTotal\": 103.899081508,\n            \"unrealisedPNLTotal\": 38.81075,\n            \"marginBalanceTotal\": 65.336985668,\n            \"positionMarginTotal\": 68.9588320683,\n            \"orderMarginTotal\": 0,\n            \"frozenFundsTotal\": 0,\n            \"availableBalanceTotal\": 67.2492494397,\n            \"currency\": \"USDT\"\n        },\n        \"accounts\": [\n            {\n                \"accountName\": \"Name1234567\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"LTkucoin1491\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"manage112233\",\n                \"accountEquity\": 0,\n                \"unrealisedPNL\": 0,\n                \"marginBalance\": 0,\n                \"positionMargin\": 0,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 0,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"testapi6\",\n                \"accountEquity\": 27.30545128,\n                \"unrealisedPNL\": 22.549,\n                \"marginBalance\": 4.75645128,\n                \"positionMargin\": 24.1223749975,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 25.7320762825,\n                \"currency\": \"USDT\"\n            },\n            {\n                \"accountName\": \"main\",\n                \"accountEquity\": 76.593630228,\n                \"unrealisedPNL\": 16.26175,\n                \"marginBalance\": 60.580534388,\n                \"positionMargin\": 44.8364570708,\n                \"orderMargin\": 0,\n                \"frozenFunds\": 0,\n                \"availableBalance\": 41.5171731572,\n                \"currency\": \"USDT\"\n            }\n        ]\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetFuturesSubAccountListV2Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountApiReqModel(t *testing.T) {
	// AddSubAccountApi
	// Add sub-account API
	// /api/v1/sub/api-key

	data := "{\"subName\": \"testapi6\", \"passphrase\": \"11223344\", \"remark\": \"TheRemark\", \"permission\": \"General,Spot,Futures\"}"
	req := &AddSubAccountApiReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountAddSubAccountApiRespModel(t *testing.T) {
	// AddSubAccountApi
	// Add sub-account API
	// /api/v1/sub/api-key

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subName\": \"testapi6\",\n        \"remark\": \"TheRemark\",\n        \"apiKey\": \"670621e3a25958000159c82f\",\n        \"apiSecret\": \"46fd8974******896f005b2340\",\n        \"apiVersion\": 3,\n        \"passphrase\": \"11223344\",\n        \"permission\": \"General,Futures\",\n        \"createdAt\": 1728455139000\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &AddSubAccountApiResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountModifySubAccountApiReqModel(t *testing.T) {
	// ModifySubAccountApi
	// Modify sub-account API
	// /api/v1/sub/api-key/update

	data := "{\"subName\": \"testapi6\", \"apiKey\": \"670621e3a25958000159c82f\", \"passphrase\": \"11223344\", \"permission\": \"General,Spot,Futures\"}"
	req := &ModifySubAccountApiReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountModifySubAccountApiRespModel(t *testing.T) {
	// ModifySubAccountApi
	// Modify sub-account API
	// /api/v1/sub/api-key/update

	data := "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"subName\": \"testapi6\",\n        \"apiKey\": \"670621e3a25958000159c82f\",\n        \"permission\": \"General,Futures,Spot\"\n    }\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &ModifySubAccountApiResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSubAccountApiListReqModel(t *testing.T) {
	// GetSubAccountApiList
	// Get sub-account API List
	// /api/v1/sub/api-key

	data := "{\"apiKey\": \"example_string_default_value\", \"subName\": \"testapi6\"}"
	req := &GetSubAccountApiListReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSubAccountApiListRespModel(t *testing.T) {
	// GetSubAccountApiList
	// Get sub-account API List
	// /api/v1/sub/api-key

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"subName\": \"apiSdkTest\",\n            \"remark\": \"sdk_test_integration\",\n            \"apiKey\": \"673eab2a955ebf000195d7e4\",\n            \"apiVersion\": 3,\n            \"permission\": \"General\",\n            \"ipWhitelist\": \"10.**.1\",\n            \"createdAt\": 1732160298000,\n            \"uid\": 215112467,\n            \"isMaster\": false\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSubAccountApiListResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountDeleteSubAccountApiReqModel(t *testing.T) {
	// DeleteSubAccountApi
	// Delete sub-account API
	// /api/v1/sub/api-key

	data := "{\"apiKey\": \"670621e3a25958000159c82f\", \"subName\": \"testapi6\", \"passphrase\": \"11223344\"}"
	req := &DeleteSubAccountApiReq{}
	err := json.Unmarshal([]byte(data), req)
	req.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountDeleteSubAccountApiRespModel(t *testing.T) {
	// DeleteSubAccountApi
	// Delete sub-account API
	// /api/v1/sub/api-key

	data := "{\"code\":\"200000\",\"data\":{\"subName\":\"testapi6\",\"apiKey\":\"670621e3a25958000159c82f\"}}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &DeleteSubAccountApiResp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountsSummaryV1ReqModel(t *testing.T) {
	// GetSpotSubAccountsSummaryV1
	// Get sub-account List - Summary Info (V1)
	// /api/v1/sub/user

}

func TestSubAccountGetSpotSubAccountsSummaryV1RespModel(t *testing.T) {
	// GetSpotSubAccountsSummaryV1
	// Get sub-account List - Summary Info (V1)
	// /api/v1/sub/user

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"userId\": \"63743f07e0c5230001761d08\",\n            \"uid\": 169579801,\n            \"subName\": \"testapi6\",\n            \"type\": 0,\n            \"remarks\": \"remarks\",\n            \"access\": \"All\"\n        },\n        {\n            \"userId\": \"670538a31037eb000115b076\",\n            \"uid\": 225139445,\n            \"subName\": \"Name1234567\",\n            \"type\": 0,\n            \"remarks\": \"TheRemark\",\n            \"access\": \"All\"\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotSubAccountsSummaryV1Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}

func TestSubAccountGetSpotSubAccountListV1ReqModel(t *testing.T) {
	// GetSpotSubAccountListV1
	// Get sub-account List - Spot Balance (V1)
	// /api/v1/sub-accounts

}

func TestSubAccountGetSpotSubAccountListV1RespModel(t *testing.T) {
	// GetSpotSubAccountListV1
	// Get sub-account List - Spot Balance (V1)
	// /api/v1/sub-accounts

	data := "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"subUserId\": \"63743f07e0c5230001761d08\",\n            \"subName\": \"testapi6\",\n            \"mainAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"tradeAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"marginAccounts\": [\n                {\n                    \"currency\": \"USDT\",\n                    \"balance\": \"0.01\",\n                    \"available\": \"0.01\",\n                    \"holds\": \"0\",\n                    \"baseCurrency\": \"BTC\",\n                    \"baseCurrencyPrice\": \"62489.8\",\n                    \"baseAmount\": \"0.00000016\",\n                    \"tag\": \"DEFAULT\"\n                }\n            ],\n            \"tradeHFAccounts\": []\n        },\n        {\n            \"subUserId\": \"670538a31037eb000115b076\",\n            \"subName\": \"Name1234567\",\n            \"mainAccounts\": [],\n            \"tradeAccounts\": [],\n            \"marginAccounts\": [],\n            \"tradeHFAccounts\": []\n        },\n        {\n            \"subUserId\": \"66b0c0905fc1480001c14c36\",\n            \"subName\": \"LTkucoin1491\",\n            \"mainAccounts\": [],\n            \"tradeAccounts\": [],\n            \"marginAccounts\": [],\n            \"tradeHFAccounts\": []\n        }\n    ]\n}"
	commonResp := &types.RestResponse{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.Data)
	resp := &GetSpotSubAccountListV1Resp{}
	err = json.Unmarshal([]byte(commonResp.Data), resp)
	resp.ToMap()
	assert.Nil(t, err)
}
