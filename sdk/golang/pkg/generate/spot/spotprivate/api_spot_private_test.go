package spotprivate

import (
	"encoding/json"
	"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestSpotPrivateAccountRespModel(t *testing.T) {
	// Account
	// Get Account Balance

	data := "{\"topic\":\"/account/balance\",\"type\":\"message\",\"subject\":\"account.balance\",\"id\":\"354689988084000\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"accountId\":\"548674591753\",\"currency\":\"USDT\",\"total\":\"21.133773386762\",\"available\":\"20.132773386762\",\"hold\":\"1.001\",\"availableChange\":\"-0.5005\",\"holdChange\":\"0.5005\",\"relationContext\":{\"symbol\":\"BTC-USDT\",\"orderId\":\"6721d0632db25b0007071fdc\"},\"relationEvent\":\"trade.hold\",\"relationEventId\":\"354689988084000\",\"time\":\"1730269283892\"}}"

	commonResp := &types.WsMessage{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.RawData)
	obj := &AccountEvent{}
	err = json.Unmarshal(commonResp.RawData, obj)
	assert.Nil(t, err)
}

func TestSpotPrivateOrderV1RespModel(t *testing.T) {
	// OrderV1
	// Get Order(V1)

	data := "{\"topic\":\"/spotMarket/tradeOrdersV2\",\"type\":\"message\",\"subject\":\"orderChange\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"canceledSize\":\"0\",\"clientOid\":\"5c52e11203aa677f33e493fb\",\"filledSize\":\"0\",\"orderId\":\"6720ecd9ec71f4000747731a\",\"orderTime\":1730211033305,\"orderType\":\"limit\",\"originSize\":\"0.00001\",\"price\":\"50000\",\"remainSize\":\"0.00001\",\"side\":\"buy\",\"size\":\"0.00001\",\"status\":\"open\",\"symbol\":\"BTC-USDT\",\"ts\":1730211033335000000,\"type\":\"open\"}}"

	commonResp := &types.WsMessage{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.RawData)
	obj := &OrderV1Event{}
	err = json.Unmarshal(commonResp.RawData, obj)
	assert.Nil(t, err)
}

func TestSpotPrivateOrderV2RespModel(t *testing.T) {
	// OrderV2
	// Get Order(V2)

	data := "{\"topic\":\"/spotMarket/tradeOrdersV2\",\"type\":\"message\",\"subject\":\"orderChange\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"clientOid\":\"5c52e11203aa677f33e493fc\",\"orderId\":\"6720da3fa30a360007f5f832\",\"orderTime\":1730206271588,\"orderType\":\"market\",\"originSize\":\"0.00001\",\"side\":\"buy\",\"status\":\"new\",\"symbol\":\"BTC-USDT\",\"ts\":1730206271616000000,\"type\":\"received\"}}"

	commonResp := &types.WsMessage{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.RawData)
	obj := &OrderV2Event{}
	err = json.Unmarshal(commonResp.RawData, obj)
	assert.Nil(t, err)
}

func TestSpotPrivateStopOrderRespModel(t *testing.T) {
	// StopOrder
	// Get Stop Order

	data := "{\"topic\":\"/spotMarket/advancedOrders\",\"type\":\"message\",\"subject\":\"stopOrder\",\"userId\":\"633559791e1cbc0001f319bc\",\"channelType\":\"private\",\"data\":{\"orderId\":\"vs93gpupfa48anof003u85mb\",\"orderPrice\":\"70000\",\"orderType\":\"stop\",\"side\":\"buy\",\"size\":\"0.00007142\",\"stop\":\"loss\",\"stopPrice\":\"71000\",\"symbol\":\"BTC-USDT\",\"tradeType\":\"TRADE\",\"type\":\"open\",\"createdAt\":1742305928064,\"ts\":1742305928091268493}}"

	commonResp := &types.WsMessage{}
	err := json.Unmarshal([]byte(data), commonResp)
	assert.Nil(t, err)
	assert.NotNil(t, commonResp.RawData)
	obj := &StopOrderEvent{}
	err = json.Unmarshal(commonResp.RawData, obj)
	assert.Nil(t, err)
}
