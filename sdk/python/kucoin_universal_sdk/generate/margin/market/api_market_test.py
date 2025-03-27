import unittest
from .model_get_cross_margin_symbols_req import GetCrossMarginSymbolsReq
from .model_get_cross_margin_symbols_resp import GetCrossMarginSymbolsResp
from .model_get_etf_info_req import GetEtfInfoReq
from .model_get_etf_info_resp import GetEtfInfoResp
from .model_get_isolated_margin_symbols_resp import GetIsolatedMarginSymbolsResp
from .model_get_margin_config_resp import GetMarginConfigResp
from .model_get_mark_price_detail_req import GetMarkPriceDetailReq
from .model_get_mark_price_detail_resp import GetMarkPriceDetailResp
from .model_get_mark_price_list_resp import GetMarkPriceListResp
from kucoin_universal_sdk.model.common import RestResponse


class MarketAPITest(unittest.TestCase):

    def test_get_cross_margin_symbols_req_model(self):
        """
       get_cross_margin_symbols
       Get Symbols - Cross Margin
       /api/v3/margin/symbols
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetCrossMarginSymbolsReq.from_json(data)

    def test_get_cross_margin_symbols_resp_model(self):
        """
        get_cross_margin_symbols
        Get Symbols - Cross Margin
        /api/v3/margin/symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"timestamp\": 1729665839353,\n        \"items\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"name\": \"BTC-USDT\",\n                \"enableTrading\": true,\n                \"market\": \"USDS\",\n                \"baseCurrency\": \"BTC\",\n                \"quoteCurrency\": \"USDT\",\n                \"baseIncrement\": \"0.00000001\",\n                \"baseMinSize\": \"0.00001\",\n                \"baseMaxSize\": \"10000000000\",\n                \"quoteIncrement\": \"0.000001\",\n                \"quoteMinSize\": \"0.1\",\n                \"quoteMaxSize\": \"99999999\",\n                \"priceIncrement\": \"0.1\",\n                \"feeCurrency\": \"USDT\",\n                \"priceLimitRate\": \"0.1\",\n                \"minFunds\": \"0.1\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetCrossMarginSymbolsResp.from_dict(common_response.data)

    def test_get_etf_info_req_model(self):
        """
       get_etf_info
       Get ETF Info
       /api/v3/etf/info
       """
        data = "{\"currency\": \"BTCUP\"}"
        req = GetEtfInfoReq.from_json(data)

    def test_get_etf_info_resp_model(self):
        """
        get_etf_info
        Get ETF Info
        /api/v3/etf/info
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"currency\": \"BTCUP\",\n            \"netAsset\": \"33.846\",\n            \"targetLeverage\": \"2-4\",\n            \"actualLeverage\": \"2.1648\",\n            \"issuedSize\": \"107134.87655291\",\n            \"basket\": \"118.324559 XBTUSDTM\"\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetEtfInfoResp.from_dict(common_response.data)

    def test_get_mark_price_detail_req_model(self):
        """
       get_mark_price_detail
       Get Mark Price Detail
       /api/v1/mark-price/{symbol}/current
       """
        data = "{\"symbol\": \"USDT-BTC\"}"
        req = GetMarkPriceDetailReq.from_json(data)

    def test_get_mark_price_detail_resp_model(self):
        """
        get_mark_price_detail
        Get Mark Price Detail
        /api/v1/mark-price/{symbol}/current
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"USDT-BTC\",\n        \"timePoint\": 1729676888000,\n        \"value\": 1.5045E-5\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetMarkPriceDetailResp.from_dict(common_response.data)

    def test_get_margin_config_req_model(self):
        """
       get_margin_config
       Get Margin Config
       /api/v1/margin/config
       """

    def test_get_margin_config_resp_model(self):
        """
        get_margin_config
        Get Margin Config
        /api/v1/margin/config
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"maxLeverage\": 5,\n        \"warningDebtRatio\": \"0.95\",\n        \"liqDebtRatio\": \"0.97\",\n        \"currencyList\": [\n            \"VRA\",\n            \"APT\",\n            \"IOTX\",\n            \"SHIB\",\n            \"KDA\",\n            \"BCHSV\",\n            \"NEAR\",\n            \"CLV\",\n            \"AUDIO\",\n            \"AIOZ\",\n            \"FLOW\",\n            \"WLD\",\n            \"COMP\",\n            \"MEME\",\n            \"SLP\",\n            \"STX\",\n            \"ZRO\",\n            \"QI\",\n            \"PYTH\",\n            \"RUNE\",\n            \"DGB\",\n            \"IOST\",\n            \"SUI\",\n            \"BCH\",\n            \"CAKE\",\n            \"DOT\",\n            \"OMG\",\n            \"POL\",\n            \"GMT\",\n            \"1INCH\",\n            \"RSR\",\n            \"NKN\",\n            \"BTC\",\n            \"AR\",\n            \"ARB\",\n            \"TON\",\n            \"LISTA\",\n            \"AVAX\",\n            \"SEI\",\n            \"FTM\",\n            \"ERN\",\n            \"BB\",\n            \"BTT\",\n            \"JTO\",\n            \"ONE\",\n            \"RLC\",\n            \"ANKR\",\n            \"SUSHI\",\n            \"CATI\",\n            \"ALGO\",\n            \"PEPE2\",\n            \"ATOM\",\n            \"LPT\",\n            \"BIGTIME\",\n            \"CFX\",\n            \"DYM\",\n            \"VELO\",\n            \"XPR\",\n            \"SNX\",\n            \"JUP\",\n            \"MANA\",\n            \"API3\",\n            \"PYR\",\n            \"ROSE\",\n            \"GLMR\",\n            \"SATS\",\n            \"TIA\",\n            \"GALAX\",\n            \"SOL\",\n            \"DAO\",\n            \"FET\",\n            \"ETC\",\n            \"MKR\",\n            \"WOO\",\n            \"DODO\",\n            \"OGN\",\n            \"BNB\",\n            \"ICP\",\n            \"BLUR\",\n            \"ETH\",\n            \"ZEC\",\n            \"NEO\",\n            \"CELO\",\n            \"REN\",\n            \"MANTA\",\n            \"LRC\",\n            \"STRK\",\n            \"ADA\",\n            \"STORJ\",\n            \"REQ\",\n            \"TAO\",\n            \"VET\",\n            \"FITFI\",\n            \"USDT\",\n            \"DOGE\",\n            \"HBAR\",\n            \"SXP\",\n            \"NEIROCTO\",\n            \"CHR\",\n            \"ORDI\",\n            \"DASH\",\n            \"PEPE\",\n            \"ONDO\",\n            \"ILV\",\n            \"WAVES\",\n            \"CHZ\",\n            \"DOGS\",\n            \"XRP\",\n            \"CTSI\",\n            \"JASMY\",\n            \"FLOKI\",\n            \"TRX\",\n            \"KAVA\",\n            \"SAND\",\n            \"C98\",\n            \"UMA\",\n            \"NOT\",\n            \"IMX\",\n            \"WIF\",\n            \"ENA\",\n            \"EGLD\",\n            \"BOME\",\n            \"LTC\",\n            \"USDC\",\n            \"METIS\",\n            \"WIN\",\n            \"THETA\",\n            \"FXS\",\n            \"ENJ\",\n            \"CRO\",\n            \"AEVO\",\n            \"INJ\",\n            \"LTO\",\n            \"CRV\",\n            \"GRT\",\n            \"DYDX\",\n            \"FLUX\",\n            \"ENS\",\n            \"WAX\",\n            \"MASK\",\n            \"POND\",\n            \"UNI\",\n            \"AAVE\",\n            \"LINA\",\n            \"TLM\",\n            \"BONK\",\n            \"QNT\",\n            \"LDO\",\n            \"ALICE\",\n            \"XLM\",\n            \"LINK\",\n            \"CKB\",\n            \"LUNC\",\n            \"YFI\",\n            \"ETHW\",\n            \"XTZ\",\n            \"LUNA\",\n            \"OP\",\n            \"SUPER\",\n            \"EIGEN\",\n            \"KSM\",\n            \"ELON\",\n            \"EOS\",\n            \"FIL\",\n            \"ZETA\",\n            \"SKL\",\n            \"BAT\",\n            \"APE\",\n            \"HMSTR\",\n            \"YGG\",\n            \"MOVR\",\n            \"PEOPLE\",\n            \"KCS\",\n            \"AXS\",\n            \"ARPA\",\n            \"ZIL\"\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetMarginConfigResp.from_dict(common_response.data)

    def test_get_mark_price_list_req_model(self):
        """
       get_mark_price_list
       Get Mark Price List
       /api/v3/mark-price/all-symbols
       """

    def test_get_mark_price_list_resp_model(self):
        """
        get_mark_price_list
        Get Mark Price List
        /api/v3/mark-price/all-symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"USDT-BTC\",\n            \"timePoint\": 1729676522000,\n            \"value\": 1.504E-5\n        },\n        {\n            \"symbol\": \"USDC-BTC\",\n            \"timePoint\": 1729676522000,\n            \"value\": 1.5049024E-5\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetMarkPriceListResp.from_dict(common_response.data)

    def test_get_isolated_margin_symbols_req_model(self):
        """
       get_isolated_margin_symbols
       Get Symbols - Isolated Margin
       /api/v1/isolated/symbols
       """

    def test_get_isolated_margin_symbols_resp_model(self):
        """
        get_isolated_margin_symbols
        Get Symbols - Isolated Margin
        /api/v1/isolated/symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"symbolName\": \"BTC-USDT\",\n            \"baseCurrency\": \"BTC\",\n            \"quoteCurrency\": \"USDT\",\n            \"maxLeverage\": 10,\n            \"flDebtRatio\": \"0.97\",\n            \"tradeEnable\": true,\n            \"autoRenewMaxDebtRatio\": \"0.96\",\n            \"baseBorrowEnable\": true,\n            \"quoteBorrowEnable\": true,\n            \"baseTransferInEnable\": true,\n            \"quoteTransferInEnable\": true,\n            \"baseBorrowCoefficient\": \"1\",\n            \"quoteBorrowCoefficient\": \"1\"\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetIsolatedMarginSymbolsResp.from_dict(common_response.data)
