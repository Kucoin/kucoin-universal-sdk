import unittest
from .model_get24hr_stats_req import Get24hrStatsReq
from .model_get24hr_stats_resp import Get24hrStatsResp
from .model_get_all_currencies_resp import GetAllCurrenciesResp
from .model_get_all_symbols_req import GetAllSymbolsReq
from .model_get_all_symbols_resp import GetAllSymbolsResp
from .model_get_all_tickers_resp import GetAllTickersResp
from .model_get_announcements_req import GetAnnouncementsReq
from .model_get_announcements_resp import GetAnnouncementsResp
from .model_get_call_auction_info_req import GetCallAuctionInfoReq
from .model_get_call_auction_info_resp import GetCallAuctionInfoResp
from .model_get_call_auction_part_order_book_req import GetCallAuctionPartOrderBookReq
from .model_get_call_auction_part_order_book_resp import GetCallAuctionPartOrderBookResp
from .model_get_client_ip_address_resp import GetClientIpAddressResp
from .model_get_currency_req import GetCurrencyReq
from .model_get_currency_resp import GetCurrencyResp
from .model_get_fiat_price_req import GetFiatPriceReq
from .model_get_fiat_price_resp import GetFiatPriceResp
from .model_get_full_order_book_req import GetFullOrderBookReq
from .model_get_full_order_book_resp import GetFullOrderBookResp
from .model_get_klines_req import GetKlinesReq
from .model_get_klines_resp import GetKlinesResp
from .model_get_market_list_resp import GetMarketListResp
from .model_get_part_order_book_req import GetPartOrderBookReq
from .model_get_part_order_book_resp import GetPartOrderBookResp
from .model_get_private_token_resp import GetPrivateTokenResp
from .model_get_public_token_resp import GetPublicTokenResp
from .model_get_server_time_resp import GetServerTimeResp
from .model_get_service_status_resp import GetServiceStatusResp
from .model_get_symbol_req import GetSymbolReq
from .model_get_symbol_resp import GetSymbolResp
from .model_get_ticker_req import GetTickerReq
from .model_get_ticker_resp import GetTickerResp
from .model_get_trade_history_req import GetTradeHistoryReq
from .model_get_trade_history_resp import GetTradeHistoryResp
from kucoin_universal_sdk.model.common import RestResponse


class MarketAPITest(unittest.TestCase):

    def test_get_announcements_req_model(self):
        """
       get_announcements
       Get Announcements
       /api/v3/announcements
       """
        data = "{\"currentPage\": 1, \"pageSize\": 50, \"annType\": \"latest-announcements\", \"lang\": \"en_US\", \"startTime\": 1729594043000, \"endTime\": 1729697729000}"
        req = GetAnnouncementsReq.from_json(data)

    def test_get_announcements_resp_model(self):
        """
        get_announcements
        Get Announcements
        /api/v3/announcements
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"totalNum\": 195,\n        \"totalPage\": 13,\n        \"currentPage\": 1,\n        \"pageSize\": 15,\n        \"items\": [\n            {\n                \"annId\": 129045,\n                \"annTitle\": \"KuCoin Isolated Margin Adds the Scroll (SCR) Trading Pair\",\n                \"annType\": [\n                    \"latest-announcements\"\n                ],\n                \"annDesc\": \"To enrich the variety of assets available,\xa0KuCoin\u2019s Isolated Margin Trading platform has added the Scroll (SCR)\xa0asset and trading pair.\",\n                \"cTime\": 1729594043000,\n                \"language\": \"en_US\",\n                \"annUrl\": \"https://www.kucoin.com/announcement/kucoin-isolated-margin-adds-scr?lang=en_US\"\n            },\n            {\n                \"annId\": 129001,\n                \"annTitle\": \"DAPP-30D Fixed Promotion, Enjoy an APR of 200%!\u200b\",\n                \"annType\": [\n                    \"latest-announcements\",\n                    \"activities\"\n                ],\n                \"annDesc\": \"KuCoin Earn will be launching the DAPP Fixed Promotion at 10:00:00 on October 22, 2024 (UTC). The available product is \u201cDAPP-30D'' with an APR of 200%.\",\n                \"cTime\": 1729588460000,\n                \"language\": \"en_US\",\n                \"annUrl\": \"https://www.kucoin.com/announcement/dapp-30d-fixed-promotion-enjoy?lang=en_US\"\n            },\n            {\n                \"annId\": 128581,\n                \"annTitle\": \"NAYM (NAYM) Gets Listed on KuCoin! World Premiere!\",\n                \"annType\": [\n                    \"latest-announcements\",\n                    \"new-listings\"\n                ],\n                \"annDesc\": \"Trading:\xa011:00 on October 22, 2024 (UTC)\",\n                \"cTime\": 1729497729000,\n                \"language\": \"en_US\",\n                \"annUrl\": \"https://www.kucoin.com/announcement/en-naym-naym-gets-listed-on-kucoin-world-premiere?lang=en_US\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetAnnouncementsResp.from_dict(common_response.data)

    def test_get_currency_req_model(self):
        """
       get_currency
       Get Currency
       /api/v3/currencies/{currency}
       """
        data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}"
        req = GetCurrencyReq.from_json(data)

    def test_get_currency_resp_model(self):
        """
        get_currency
        Get Currency
        /api/v3/currencies/{currency}
        """
        data = "{\"code\":\"200000\",\"data\":{\"currency\":\"BTC\",\"name\":\"BTC\",\"fullName\":\"Bitcoin\",\"precision\":8,\"confirms\":null,\"contractAddress\":null,\"isMarginEnabled\":true,\"isDebitEnabled\":true,\"chains\":[{\"chainName\":\"BTC\",\"withdrawalMinSize\":\"0.001\",\"depositMinSize\":\"0.0002\",\"withdrawFeeRate\":\"0\",\"withdrawalMinFee\":\"0.0005\",\"isWithdrawEnabled\":true,\"isDepositEnabled\":true,\"confirms\":3,\"preConfirms\":1,\"contractAddress\":\"\",\"withdrawPrecision\":8,\"maxWithdraw\":null,\"maxDeposit\":null,\"needTag\":false,\"chainId\":\"btc\"},{\"chainName\":\"Lightning Network\",\"withdrawalMinSize\":\"0.00001\",\"depositMinSize\":\"0.00001\",\"withdrawFeeRate\":\"0\",\"withdrawalMinFee\":\"0.000015\",\"isWithdrawEnabled\":true,\"isDepositEnabled\":true,\"confirms\":1,\"preConfirms\":1,\"contractAddress\":\"\",\"withdrawPrecision\":8,\"maxWithdraw\":null,\"maxDeposit\":\"0.03\",\"needTag\":false,\"chainId\":\"btcln\"},{\"chainName\":\"KCC\",\"withdrawalMinSize\":\"0.0008\",\"depositMinSize\":null,\"withdrawFeeRate\":\"0\",\"withdrawalMinFee\":\"0.00002\",\"isWithdrawEnabled\":true,\"isDepositEnabled\":true,\"confirms\":20,\"preConfirms\":20,\"contractAddress\":\"0xfa93c12cd345c658bc4644d1d4e1b9615952258c\",\"withdrawPrecision\":8,\"maxWithdraw\":null,\"maxDeposit\":null,\"needTag\":false,\"chainId\":\"kcc\"},{\"chainName\":\"BTC-Segwit\",\"withdrawalMinSize\":\"0.0008\",\"depositMinSize\":\"0.0002\",\"withdrawFeeRate\":\"0\",\"withdrawalMinFee\":\"0.0005\",\"isWithdrawEnabled\":false,\"isDepositEnabled\":true,\"confirms\":2,\"preConfirms\":2,\"contractAddress\":\"\",\"withdrawPrecision\":8,\"maxWithdraw\":null,\"maxDeposit\":null,\"needTag\":false,\"chainId\":\"bech32\"}]}}"
        common_response = RestResponse.from_json(data)
        resp = GetCurrencyResp.from_dict(common_response.data)

    def test_get_all_currencies_req_model(self):
        """
       get_all_currencies
       Get All Currencies
       /api/v3/currencies
       """

    def test_get_all_currencies_resp_model(self):
        """
        get_all_currencies
        Get All Currencies
        /api/v3/currencies
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"currency\": \"BTC\",\n            \"name\": \"BTC\",\n            \"fullName\": \"Bitcoin\",\n            \"precision\": 8,\n            \"confirms\": null,\n            \"contractAddress\": null,\n            \"isMarginEnabled\": true,\n            \"isDebitEnabled\": true,\n            \"chains\": [\n                {\n                    \"chainName\": \"BTC\",\n                    \"withdrawalMinSize\": \"0.001\",\n                    \"depositMinSize\": \"0.0002\",\n                    \"withdrawFeeRate\": \"0\",\n                    \"withdrawalMinFee\": \"0.0005\",\n                    \"isWithdrawEnabled\": true,\n                    \"isDepositEnabled\": true,\n                    \"confirms\": 3,\n                    \"preConfirms\": 1,\n                    \"contractAddress\": \"\",\n                    \"withdrawPrecision\": 8,\n                    \"maxWithdraw\": null,\n                    \"maxDeposit\": null,\n                    \"needTag\": false,\n                    \"chainId\": \"btc\"\n                },\n                {\n                    \"chainName\": \"Lightning Network\",\n                    \"withdrawalMinSize\": \"0.00001\",\n                    \"depositMinSize\": \"0.00001\",\n                    \"withdrawFeeRate\": \"0\",\n                    \"withdrawalMinFee\": \"0.000015\",\n                    \"isWithdrawEnabled\": true,\n                    \"isDepositEnabled\": true,\n                    \"confirms\": 1,\n                    \"preConfirms\": 1,\n                    \"contractAddress\": \"\",\n                    \"withdrawPrecision\": 8,\n                    \"maxWithdraw\": null,\n                    \"maxDeposit\": \"0.03\",\n                    \"needTag\": false,\n                    \"chainId\": \"btcln\"\n                },\n                {\n                    \"chainName\": \"KCC\",\n                    \"withdrawalMinSize\": \"0.0008\",\n                    \"depositMinSize\": null,\n                    \"withdrawFeeRate\": \"0\",\n                    \"withdrawalMinFee\": \"0.00002\",\n                    \"isWithdrawEnabled\": true,\n                    \"isDepositEnabled\": true,\n                    \"confirms\": 20,\n                    \"preConfirms\": 20,\n                    \"contractAddress\": \"0xfa93c12cd345c658bc4644d1d4e1b9615952258c\",\n                    \"withdrawPrecision\": 8,\n                    \"maxWithdraw\": null,\n                    \"maxDeposit\": null,\n                    \"needTag\": false,\n                    \"chainId\": \"kcc\"\n                },\n                {\n                    \"chainName\": \"BTC-Segwit\",\n                    \"withdrawalMinSize\": \"0.0008\",\n                    \"depositMinSize\": \"0.0002\",\n                    \"withdrawFeeRate\": \"0\",\n                    \"withdrawalMinFee\": \"0.0005\",\n                    \"isWithdrawEnabled\": false,\n                    \"isDepositEnabled\": true,\n                    \"confirms\": 2,\n                    \"preConfirms\": 2,\n                    \"contractAddress\": \"\",\n                    \"withdrawPrecision\": 8,\n                    \"maxWithdraw\": null,\n                    \"maxDeposit\": null,\n                    \"needTag\": false,\n                    \"chainId\": \"bech32\"\n                }\n            ]\n        },\n        {\n            \"currency\": \"BTCP\",\n            \"name\": \"BTCP\",\n            \"fullName\": \"Bitcoin Private\",\n            \"precision\": 8,\n            \"confirms\": null,\n            \"contractAddress\": null,\n            \"isMarginEnabled\": false,\n            \"isDebitEnabled\": false,\n            \"chains\": [\n                {\n                    \"chainName\": \"BTCP\",\n                    \"withdrawalMinSize\": \"0.100000\",\n                    \"depositMinSize\": null,\n                    \"withdrawFeeRate\": \"0\",\n                    \"withdrawalMinFee\": \"0.010000\",\n                    \"isWithdrawEnabled\": false,\n                    \"isDepositEnabled\": false,\n                    \"confirms\": 6,\n                    \"preConfirms\": 6,\n                    \"contractAddress\": \"\",\n                    \"withdrawPrecision\": 8,\n                    \"maxWithdraw\": null,\n                    \"maxDeposit\": null,\n                    \"needTag\": false,\n                    \"chainId\": \"btcp\"\n                }\n            ]\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetAllCurrenciesResp.from_dict(common_response.data)

    def test_get_symbol_req_model(self):
        """
       get_symbol
       Get Symbol 
       /api/v2/symbols/{symbol}
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetSymbolReq.from_json(data)

    def test_get_symbol_resp_model(self):
        """
        get_symbol
        Get Symbol 
        /api/v2/symbols/{symbol}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"BTC-USDT\",\n        \"name\": \"BTC-USDT\",\n        \"baseCurrency\": \"BTC\",\n        \"quoteCurrency\": \"USDT\",\n        \"feeCurrency\": \"USDT\",\n        \"market\": \"USDS\",\n        \"baseMinSize\": \"0.00001\",\n        \"quoteMinSize\": \"0.1\",\n        \"baseMaxSize\": \"10000000000\",\n        \"quoteMaxSize\": \"99999999\",\n        \"baseIncrement\": \"0.00000001\",\n        \"quoteIncrement\": \"0.000001\",\n        \"priceIncrement\": \"0.1\",\n        \"priceLimitRate\": \"0.1\",\n        \"minFunds\": \"0.1\",\n        \"isMarginEnabled\": true,\n        \"enableTrading\": true,\n        \"feeCategory\": 1,\n        \"makerFeeCoefficient\": \"1.00\",\n        \"takerFeeCoefficient\": \"1.00\",\n        \"st\": false,\n        \"callauctionIsEnabled\": false,\n        \"callauctionPriceFloor\": null,\n        \"callauctionPriceCeiling\": null,\n        \"callauctionFirstStageStartTime\": null,\n        \"callauctionSecondStageStartTime\": null,\n        \"callauctionThirdStageStartTime\": null,\n        \"tradingStartTime\": null\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetSymbolResp.from_dict(common_response.data)

    def test_get_all_symbols_req_model(self):
        """
       get_all_symbols
       Get All Symbols
       /api/v2/symbols
       """
        data = "{\"market\": \"ALTS\"}"
        req = GetAllSymbolsReq.from_json(data)

    def test_get_all_symbols_resp_model(self):
        """
        get_all_symbols
        Get All Symbols
        /api/v2/symbols
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"symbol\": \"BTC-USDT\",\n            \"name\": \"BTC-USDT\",\n            \"baseCurrency\": \"BTC\",\n            \"quoteCurrency\": \"USDT\",\n            \"feeCurrency\": \"USDT\",\n            \"market\": \"USDS\",\n            \"baseMinSize\": \"0.00001\",\n            \"quoteMinSize\": \"0.1\",\n            \"baseMaxSize\": \"10000000000\",\n            \"quoteMaxSize\": \"99999999\",\n            \"baseIncrement\": \"0.00000001\",\n            \"quoteIncrement\": \"0.000001\",\n            \"priceIncrement\": \"0.1\",\n            \"priceLimitRate\": \"0.1\",\n            \"minFunds\": \"0.1\",\n            \"isMarginEnabled\": true,\n            \"enableTrading\": true,\n            \"feeCategory\": 1,\n            \"makerFeeCoefficient\": \"1.00\",\n            \"takerFeeCoefficient\": \"1.00\",\n            \"st\": false,\n            \"callauctionIsEnabled\": false,\n            \"callauctionPriceFloor\": null,\n            \"callauctionPriceCeiling\": null,\n            \"callauctionFirstStageStartTime\": null,\n            \"callauctionSecondStageStartTime\": null,\n            \"callauctionThirdStageStartTime\": null,\n            \"tradingStartTime\": null\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetAllSymbolsResp.from_dict(common_response.data)

    def test_get_ticker_req_model(self):
        """
       get_ticker
       Get Ticker
       /api/v1/market/orderbook/level1
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetTickerReq.from_json(data)

    def test_get_ticker_resp_model(self):
        """
        get_ticker
        Get Ticker
        /api/v1/market/orderbook/level1
        """
        data = "{\"code\":\"200000\",\"data\":{\"time\":1729172965609,\"sequence\":\"14609309753\",\"price\":\"67269\",\"size\":\"0.000025\",\"bestBid\":\"67267.5\",\"bestBidSize\":\"0.000025\",\"bestAsk\":\"67267.6\",\"bestAskSize\":\"1.24808993\"}}"
        common_response = RestResponse.from_json(data)
        resp = GetTickerResp.from_dict(common_response.data)

    def test_get_all_tickers_req_model(self):
        """
       get_all_tickers
       Get All Tickers
       /api/v1/market/allTickers
       """

    def test_get_all_tickers_resp_model(self):
        """
        get_all_tickers
        Get All Tickers
        /api/v1/market/allTickers
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"time\": 1729173207043,\n        \"ticker\": [\n            {\n                \"symbol\": \"BTC-USDT\",\n                \"symbolName\": \"BTC-USDT\",\n                \"buy\": \"67192.5\",\n                \"bestBidSize\": \"0.000025\",\n                \"sell\": \"67192.6\",\n                \"bestAskSize\": \"1.24949204\",\n                \"changeRate\": \"-0.0014\",\n                \"changePrice\": \"-98.5\",\n                \"high\": \"68321.4\",\n                \"low\": \"66683.3\",\n                \"vol\": \"1836.03034612\",\n                \"volValue\": \"124068431.06726933\",\n                \"last\": \"67193\",\n                \"averagePrice\": \"67281.21437289\",\n                \"takerFeeRate\": \"0.001\",\n                \"makerFeeRate\": \"0.001\",\n                \"takerCoefficient\": \"1\",\n                \"makerCoefficient\": \"1\"\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetAllTickersResp.from_dict(common_response.data)

    def test_get_trade_history_req_model(self):
        """
       get_trade_history
       Get Trade History
       /api/v1/market/histories
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetTradeHistoryReq.from_json(data)

    def test_get_trade_history_resp_model(self):
        """
        get_trade_history
        Get Trade History
        /api/v1/market/histories
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        {\n            \"sequence\": \"10976028003549185\",\n            \"price\": \"67122\",\n            \"size\": \"0.000025\",\n            \"side\": \"buy\",\n            \"time\": 1729177117877000000\n        },\n        {\n            \"sequence\": \"10976028003549188\",\n            \"price\": \"67122\",\n            \"size\": \"0.01792257\",\n            \"side\": \"buy\",\n            \"time\": 1729177117877000000\n        },\n        {\n            \"sequence\": \"10976028003549191\",\n            \"price\": \"67122.9\",\n            \"size\": \"0.05654289\",\n            \"side\": \"buy\",\n            \"time\": 1729177117877000000\n        }\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetTradeHistoryResp.from_dict(common_response.data)

    def test_get_klines_req_model(self):
        """
       get_klines
       Get Klines
       /api/v1/market/candles
       """
        data = "{\"symbol\": \"BTC-USDT\", \"type\": \"1min\", \"startAt\": 1566703297, \"endAt\": 1566789757}"
        req = GetKlinesReq.from_json(data)

    def test_get_klines_resp_model(self):
        """
        get_klines
        Get Klines
        /api/v1/market/candles
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": [\n        [\n            \"1566789720\",\n            \"10411.5\",\n            \"10401.9\",\n            \"10411.5\",\n            \"10396.3\",\n            \"29.11357276\",\n            \"302889.301529914\"\n        ],\n        [\n            \"1566789660\",\n            \"10416\",\n            \"10411.5\",\n            \"10422.3\",\n            \"10411.5\",\n            \"15.61781842\",\n            \"162703.708997029\"\n        ],\n        [\n            \"1566789600\",\n            \"10408.6\",\n            \"10416\",\n            \"10416\",\n            \"10405.4\",\n            \"12.45584973\",\n            \"129666.51508559\"\n        ]\n    ]\n}"
        common_response = RestResponse.from_json(data)
        resp = GetKlinesResp.from_dict(common_response.data)

    def test_get_part_order_book_req_model(self):
        """
       get_part_order_book
       Get Part OrderBook
       /api/v1/market/orderbook/level2_{size}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"size\": \"20\"}"
        req = GetPartOrderBookReq.from_json(data)

    def test_get_part_order_book_resp_model(self):
        """
        get_part_order_book
        Get Part OrderBook
        /api/v1/market/orderbook/level2_{size}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"time\": 1729176273859,\n        \"sequence\": \"14610502970\",\n        \"bids\": [\n            [\n                \"66976.4\",\n                \"0.69109872\"\n            ],\n            [\n                \"66976.3\",\n                \"0.14377\"\n            ]\n        ],\n        \"asks\": [\n            [\n                \"66976.5\",\n                \"0.05408199\"\n            ],\n            [\n                \"66976.8\",\n                \"0.0005\"\n            ]\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetPartOrderBookResp.from_dict(common_response.data)

    def test_get_full_order_book_req_model(self):
        """
       get_full_order_book
       Get Full OrderBook
       /api/v3/market/orderbook/level2
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetFullOrderBookReq.from_json(data)

    def test_get_full_order_book_resp_model(self):
        """
        get_full_order_book
        Get Full OrderBook
        /api/v3/market/orderbook/level2
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"time\": 1729176273859,\n        \"sequence\": \"14610502970\",\n        \"bids\": [\n            [\n                \"66976.4\",\n                \"0.69109872\"\n            ],\n            [\n                \"66976.3\",\n                \"0.14377\"\n            ]\n        ],\n        \"asks\": [\n            [\n                \"66976.5\",\n                \"0.05408199\"\n            ],\n            [\n                \"66976.8\",\n                \"0.0005\"\n            ]\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetFullOrderBookResp.from_dict(common_response.data)

    def test_get_call_auction_part_order_book_req_model(self):
        """
       get_call_auction_part_order_book
       Get Call Auction Part OrderBook
       /api/v1/market/orderbook/callauction/level2_{size}
       """
        data = "{\"symbol\": \"BTC-USDT\", \"size\": \"20\"}"
        req = GetCallAuctionPartOrderBookReq.from_json(data)

    def test_get_call_auction_part_order_book_resp_model(self):
        """
        get_call_auction_part_order_book
        Get Call Auction Part OrderBook
        /api/v1/market/orderbook/callauction/level2_{size}
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"time\": 1729176273859,\n        \"sequence\": \"14610502970\",\n        \"bids\": [\n            [\n                \"66976.4\",\n                \"0.69109872\"\n            ],\n            [\n                \"66976.3\",\n                \"0.14377\"\n            ]\n        ],\n        \"asks\": [\n            [\n                \"66976.5\",\n                \"0.05408199\"\n            ],\n            [\n                \"66976.8\",\n                \"0.0005\"\n            ]\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetCallAuctionPartOrderBookResp.from_dict(common_response.data)

    def test_get_call_auction_info_req_model(self):
        """
       get_call_auction_info
       Get Call Auction Info
       /api/v1/market/callauctionData
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = GetCallAuctionInfoReq.from_json(data)

    def test_get_call_auction_info_resp_model(self):
        """
        get_call_auction_info
        Get Call Auction Info
        /api/v1/market/callauctionData
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"symbol\": \"BTC-USDT\",\n        \"estimatedPrice\": \"0.17\",\n        \"estimatedSize\": \"0.03715004\",\n        \"sellOrderRangeLowPrice\": \"1.788\",\n        \"sellOrderRangeHighPrice\": \"2.788\",\n        \"buyOrderRangeLowPrice\": \"1.788\",\n        \"buyOrderRangeHighPrice\": \"2.788\",\n        \"time\": 1550653727731\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetCallAuctionInfoResp.from_dict(common_response.data)

    def test_get_fiat_price_req_model(self):
        """
       get_fiat_price
       Get Fiat Price
       /api/v1/prices
       """
        data = "{\"base\": \"USD\", \"currencies\": \"example_string_default_value\"}"
        req = GetFiatPriceReq.from_json(data)

    def test_get_fiat_price_resp_model(self):
        """
        get_fiat_price
        Get Fiat Price
        /api/v1/prices
        """
        data = "{\"code\":\"200000\",\"data\":{\"AGLD\":\"1.1174410000000001\",\"DFI\":\"0.0168915500000000\",\"PYTHUP\":\"0.0397880960000000\",\"ISLM\":\"0.0606196750000000\",\"NEAR\":\"4.7185395500000000\",\"AIOZ\":\"0.4862867350000000\",\"AUDIO\":\"0.1219390000000000\",\"BBL\":\"0.0067766100000000\",\"WLD\":\"2.2893547500000000\",\"HNT\":\"5.8990489999999984\",\"ETHFI\":\"1.5892050000000000\",\"DMAIL\":\"0.2726636000000000\",\"OPUP\":\"0.0986506500000000\",\"VET3S\":\"0.0003700448850000\",\"MANA3S\":\"0.0006056970000000\",\"TIDAL\":\"0.0001154422500000\",\"HALO\":\"0.0058270850000000\",\"OPUL\":\"0.0839480050000000\",\"MANA3L\":\"0.0029569407900000\",\"DGB\":\"0.0066556705000000\",\"AA\":\"0.2406796000000000\",\"BCH\":\"366.2167999999996484\",\"GMEE\":\"0.0113333305000000\",\"JST\":\"0.0302348750000000\",\"PBUX\":\"0.0208795550000000\",\"AR\":\"18.5457224999999909\",\"SEI\":\"0.4332832500000000\",\"PSTAKE\":\"0.0493153300000000\",\"LMWR\":\"0.1618190500000000\",\"UNFIDOWN\":\"0.0062058955000000\",\"BB\":\"0.3245376500000000\",\"JTO\":\"2.1239375000000002\",\"WEMIX\":\"0.7916040000000000\",\"G\":\"0.0324037900000000\",\"MARSH\":\"0.0617591050000000\",\"BN\":\"0.0036961510000000\",\"FLIP\":\"1.0976509000000000\",\"FLR\":\"0.0144827550000000\",\"BIGTIME\":\"0.1238780300000000\",\"FLY\":\"0.0005157420000000\",\"T\":\"0.0233483200000000\",\"W\":\"0.2865566500000000\",\"BDX\":\"0.0774012800000000\",\"BABYDOGE\":\"0.0000000029375305\",\"SFP\":\"0.7256370000000000\",\"DIA\":\"0.9179408000000000\",\"ISME\":\"0.0022388800000000\",\"LYM\":\"0.0010155919500000\",\"VET3L\":\"0.0000289755050000\",\"JUP\":\"0.8230882500000000\",\"LYX\":\"1.4501745500000001\",\"AIEPK\":\"0.0050094940000000\",\"SILLY\":\"0.0159420250000000\",\"SCPT\":\"0.0122038950000000\",\"WOO\":\"0.1796601250000000\",\"BLUR\":\"0.2462768000000000\",\"STRK\":\"0.3963117450000000\",\"BFC\":\"0.0383608100000000\",\"DC\":\"0.0003097450500000\",\"KARATE\":\"0.0007296350000000\",\"SUSHI3L\":\"0.5115441000000000\",\"NETVR\":\"0.0976111700000000\",\"WAVES\":\"1.0806594000000000\",\"LITH\":\"0.0001520239500000\",\"HAPI\":\"8.6533711499999987\",\"SUSHI3S\":\"1.2752620500000000\",\"CEEK\":\"0.0294852500000000\",\"FLOKI\":\"0.0001414292500000\",\"SHR\":\"0.0012463765000000\",\"SAND\":\"0.2566616050000000\",\"TURT\":\"0.0020889550000000\",\"UMA\":\"2.5207390000000000\",\"BEPRO\":\"0.0003955021500000\",\"SCRT\":\"0.1995002000000000\",\"TUSD\":\"0.9945025000000000\",\"COOKIE\":\"0.0220089900000000\",\"LRDS\":\"0.6218889000000000\",\"SIN\":\"0.0033633175000000\",\"OAS\":\"0.0331933950000000\",\"ROOT\":\"0.0183108400000000\",\"ADA3L\":\"0.0046396790000000\",\"TIAUP\":\"0.1228385500000000\",\"HTR\":\"0.0353023400000000\",\"UNB\":\"0.0003837080500000\",\"UNA\":\"0.0164917500000000\",\"HARD\":\"0.1087056200000000\",\"G3\":\"0.0502648550000000\",\"ADA3S\":\"0.0006191202850000\",\"MYRO\":\"0.1071863800000000\",\"HTX\":\"0.0000013693150000\",\"FT\":\"0.3585206500000000\",\"BTCDOWN\":\"0.1065467000000000\",\"UNI\":\"7.3571195999999993\",\"FX\":\"0.1379310000000000\",\"OBI\":\"0.0079030465000000\",\"UNO\":\"0.0137131400000000\",\"WRX\":\"0.1221389000000000\",\"TIADOWN\":\"0.0000914642450000\",\"ETHDOWN\":\"0.1306346500000000\",\"WELL\":\"0.0471244260000000\",\"SWFTC\":\"0.0028966509500000\",\"SKL\":\"0.0362418700000000\",\"UOS\":\"0.0867765900000000\",\"AIPAD\":\"0.0478660550000000\",\"BRETT\":\"0.1037481000000000\",\"SKY\":\"0.0520139800000000\",\"FRM\":\"0.0153123400000000\",\"VISION\":\"0.0014451770500000\",\"LENDS\":\"0.0047276350000000\",\"SLF\":\"0.3318340000000000\",\"BULL\":\"0.0023988000000000\",\"FLOW\":\"0.5372312500000000\",\"ODDZ\":\"0.0063368300000000\",\"SLN\":\"0.2804597000000000\",\"UPO\":\"0.0440779500000000\",\"SLP\":\"0.0023997995000000\",\"ID\":\"0.3718140000000000\",\"SLIM\":\"0.0906446550000000\",\"SPOT\":\"0.0021289350000000\",\"DOP\":\"0.0023028480000000\",\"ISSP\":\"0.0000874562500000\",\"UQC\":\"3.2339822000000003\",\"IO\":\"1.8185902499999999\",\"DOT\":\"4.2022978000000005\",\"1INCH\":\"0.2645676500000000\",\"SMH\":\"0.3448275000000000\",\"MAK\":\"0.0396701550000000\",\"TOKO\":\"0.0005923037000000\",\"TURBO\":\"0.0108085930000000\",\"UNFI\":\"2.8555714999999996\",\"MAN\":\"0.0210764565000000\",\"EVER\":\"0.0332733550000000\",\"FTM\":\"0.7259068650000000\",\"SHRAP\":\"0.0476361700000000\",\"MAV\":\"0.1738130500000000\",\"MAX\":\"0.2864966800000000\",\"DPR\":\"0.0018240875000000\",\"FTT\":\"2.0559715000000002\",\"ARKM\":\"1.7444273499999999\",\"ATOM\":\"4.2954512000000002\",\"PENDLE\":\"4.1554212500000007\",\"QUICK\":\"0.0365317250000000\",\"BLZ\":\"0.1217191100000000\",\"BOBA\":\"0.2014092450000000\",\"MBL\":\"0.0027856065000000\",\"OFN\":\"0.1252373500000000\",\"UNIO\":\"0.0025487250000000\",\"SNS\":\"0.0200899500000000\",\"SNX\":\"1.4282854999999999\",\"NXRA\":\"0.0272763550000000\",\"TAIKO\":\"1.4392800000000001\",\"AVAX3L\":\"0.1410875109550000\",\"L3\":\"0.0608395650000000\",\"API3\":\"1.3728132500000001\",\"XRP3S\":\"0.0028095945000000\",\"QKC\":\"0.0085157400000000\",\"AVAX3S\":\"0.5148424500000000\",\"ROSE\":\"0.0693453100000000\",\"SATS\":\"0.0000002701648500\",\"BMX\":\"0.3100449000000000\",\"PORTAL\":\"0.2811593500000000\",\"TOMI\":\"0.0309045400000000\",\"XRP3L\":\"2.1586201500000002\",\"SOL\":\"151.7250995000003583\",\"SON\":\"0.0002421788500000\",\"BNC\":\"0.1882058500000000\",\"SOCIAL\":\"0.0026486750000000\",\"CGPT\":\"0.1305147100000000\",\"CELR\":\"0.0127736100000000\",\"BNB\":\"591.0973035000118935\",\"OGN\":\"0.0852573500000000\",\"CELO\":\"0.7711142500000000\",\"AUCTION\":\"13.1634150000000014\",\"MANTA\":\"0.7564216000000000\",\"LAYER\":\"0.0372713550000000\",\"AERO\":\"1.3783104999999999\",\"CETUS\":\"0.1808295400000000\",\"LL\":\"0.0201199350000000\",\"SPA\":\"0.0067426270000000\",\"PYTHDOWN\":\"0.0011834080000000\",\"NEIROCTO\":\"0.0019964013000000\",\"UTK\":\"0.0365217300000000\",\"GMRX\":\"0.0007386305000000\",\"BOB\":\"0.0000380619595000\",\"HOTCROSS\":\"0.0056491740000000\",\"AERGO\":\"0.1007595950000000\",\"MOCA\":\"0.0783608000000000\",\"SQD\":\"0.0380809500000000\",\"MV\":\"0.0081359300000000\",\"BNB3L\":\"0.2761618500000000\",\"BNB3S\":\"0.0008545725000000\",\"GALAX3L\":\"0.0057571999600000\",\"KAI\":\"0.0020080954500000\",\"SQR\":\"0.0470764500000000\",\"GALAX3S\":\"0.1933033000000000\",\"EGLD\":\"25.5272299999999713\",\"ZBCN\":\"0.0010404795000000\",\"KAS\":\"0.1216691350000000\",\"MEW\":\"0.0086176890000000\",\"PUNDIX\":\"0.4130933500000000\",\"LOOKS\":\"0.0392803500000000\",\"FXS\":\"1.9060465000000000\",\"BOSON\":\"0.2732633000000000\",\"BRISE\":\"0.0000000860569500\",\"AEVO\":\"0.3388305000000000\",\"FLUX\":\"0.5276360500000000\",\"PRCL\":\"0.1969015000000000\",\"UNFIUP\":\"0.0011654170000000\",\"SEIDOWN\":\"0.0442778500000000\",\"DOAI\":\"0.0052363805000000\",\"QNT\":\"65.4312679999998206\",\"REDO\":\"0.2837580500000000\",\"STRIKE\":\"6.8225869999999997\",\"ETHW\":\"3.2418782499999998\",\"OM\":\"1.5396797750000000\",\"OP\":\"1.6911539999999999\",\"WHALE\":\"0.8134930500000000\",\"1CAT\":\"0.0018460765000000\",\"NEON\":\"0.4446775500000000\",\"GTAI\":\"0.7786105000000000\",\"SSV\":\"21.2393749999999841\",\"ETH2\":\"2601.6678843156403923\",\"KCS\":\"8.7646155000000020\",\"ARPA\":\"0.0393882960000000\",\"ARTFI\":\"0.0141029450000000\",\"BRL\":\"0.1742807323452485\",\"ALEX\":\"0.0924537500000000\",\"STG\":\"0.2943527500000000\",\"SHIB\":\"0.0000178060925000\",\"IOTX\":\"0.0394202800000000\",\"OLE\":\"0.0171414250000000\",\"KDA\":\"0.5653172000000000\",\"CERE\":\"0.0022548720000000\",\"DOCK\":\"0.0018990500000000\",\"STX\":\"1.8157916500000000\",\"OLT\":\"0.0007596200000000\",\"QI\":\"0.0131754090000000\",\"SDAO\":\"0.2748625000000000\",\"BLAST\":\"0.0087636160000000\",\"LINK3S\":\"0.0000702948350000\",\"IOST\":\"0.0049745115000000\",\"SUI\":\"2.0589700000000000\",\"CAKE\":\"1.7941024999999999\",\"BSW\":\"0.0586706500000000\",\"OMG\":\"0.2597700500000000\",\"VOLT\":\"0.0000002716641000\",\"LINK3L\":\"1.3408292499999999\",\"GEEQ\":\"0.0385607100000000\",\"PYUSD\":\"0.9988003500000000\",\"SUN\":\"0.0186106900000000\",\"TOWER\":\"0.0014812590000000\",\"BTC\":\"67133.4165000832051564\",\"IOTA\":\"0.1189405000000000\",\"REEF\":\"0.0019960015000000\",\"TRIAS\":\"3.3683149999999998\",\"KEY\":\"0.0037594713240047\",\"ETH3L\":\"0.0003305946200000\",\"BTT\":\"0.0000009117439000\",\"ONE\":\"0.0132003965000000\",\"RENDER\":\"5.2263854999999995\",\"ETH3S\":\"0.5517240000000000\",\"ANKR\":\"0.0264867500000000\",\"ALGO\":\"0.1188405500000000\",\"SYLO\":\"0.0007600198000000\",\"ZCX\":\"0.0784707450000000\",\"SD\":\"0.3851073500000000\",\"ONT\":\"0.1877960550000000\",\"MJT\":\"0.0132433750000000\",\"DYM\":\"1.6659666000000001\",\"DYP\":\"0.0205397250000000\",\"BAKEUP\":\"0.0389894955000000\",\"OOE\":\"0.0079360300000000\",\"ZELIX\":\"0.0000649675000000\",\"DOGE3L\":\"0.3837080500000000\",\"ARTY\":\"0.3980009000000000\",\"QORPO\":\"0.1204297550000000\",\"ICE\":\"0.0051504235000000\",\"NOTAI\":\"0.0000892753400000\",\"DOGE3S\":\"0.2291853500000000\",\"NAKA\":\"1.0695649500000000\",\"GALAX\":\"0.0212893500000000\",\"MKR\":\"1245.8767500000163833\",\"DODO\":\"0.1152423500000000\",\"ICP\":\"7.6731615000000027\",\"ZEC\":\"35.9400209999999543\",\"ZEE\":\"0.0065767100000000\",\"ICX\":\"0.1383308000000000\",\"KMNO\":\"0.0921499020000000\",\"TT\":\"0.0033883050000000\",\"DOT3L\":\"0.1454272500000000\",\"XAI\":\"0.2038980000000000\",\"ZEN\":\"8.0149905000000007\",\"DOGE\":\"0.1213093150000000\",\"ALPHA\":\"0.0567416150000000\",\"DUSK\":\"0.1964517250000000\",\"DOT3S\":\"0.0053613180000000\",\"SXP\":\"0.2538730000000000\",\"HBAR\":\"0.0510044850000000\",\"SYNT\":\"0.0467166300000000\",\"ZEX\":\"0.0571714000000000\",\"BONDLY\":\"0.0022208890000000\",\"MLK\":\"0.2080859050000000\",\"KICKS\":\"0.0001301249050000\",\"PEPE\":\"0.0000100249850000\",\"OUSD\":\"0.9982006500000000\",\"LUNCDOWN\":\"0.0000733333150000\",\"DOGS\":\"0.0007086455000000\",\"REV3L\":\"0.0094672640000000\",\"CTSI\":\"0.1257371000000000\",\"C98\":\"0.1219390000000000\",\"OSMO\":\"0.5370313500000000\",\"NTRN\":\"0.3869064500000000\",\"CFX2S\":\"0.0084757600000000\",\"SYN\":\"0.5636180500000000\",\"VIDT\":\"0.0308745550000000\",\"SYS\":\"0.0997501000000000\",\"GAS\":\"4.3029474500000008\",\"BOME\":\"0.0087336310000000\",\"COMBO\":\"0.4068964500000000\",\"XCH\":\"14.9825050000000010\",\"VR\":\"0.0063538215000000\",\"CFX2L\":\"0.0499660045000000\",\"VSYS\":\"0.0005201398000000\",\"PANDORA\":\"1629.2949450001102772\",\"THETA\":\"1.2461766000000000\",\"XCN\":\"0.0012699647000000\",\"NEXG\":\"0.0039180400000000\",\"MELOS\":\"0.0021244372500000\",\"XCV\":\"0.0013253370000000\",\"ORN\":\"0.8797599000000000\",\"WLKN\":\"0.0010624685000000\",\"AAVE\":\"154.2708259999996162\",\"MNT\":\"0.6168914000000000\",\"BONK\":\"0.0000227296295000\",\"PERP\":\"0.6037979500000000\",\"XDC\":\"0.0276361750000000\",\"MNW\":\"0.3681158500000000\",\"XDB\":\"0.0002578710000000\",\"BOND\":\"1.5662165000000000\",\"SUIA\":\"0.0809595000000000\",\"MOG\":\"0.0000019330330000\",\"SUTER\":\"0.0001840079500000\",\"TIME\":\"16.2648634999999969\",\"RACA\":\"0.0001949025000000\",\"BICO\":\"0.2021988500000000\",\"MON\":\"0.1066466500000000\",\"SWEAT\":\"0.0063718125000000\",\"MOXIE\":\"0.0022088950000000\",\"BABYBNB\":\"0.0289755050000000\",\"IGU\":\"0.0050674650000000\",\"HMSTR\":\"0.0037990995000000\",\"XEC\":\"0.0000354722550000\",\"MONI\":\"0.0058470750000000\",\"XR\":\"0.2374812000000000\",\"PEOPLE\":\"0.0796601500000000\",\"PUMLX\":\"0.0054572700000000\",\"ZIL\":\"0.0145927000000000\",\"WLDDOWN\":\"0.2089954500000000\",\"VAI\":\"0.0799999800000000\",\"XEN\":\"0.0000000839580000\",\"MPC\":\"0.1001499000000000\",\"XEM\":\"0.0176951480000000\",\"JASMY3S\":\"0.0019670160000000\",\"OTK\":\"0.0290464695000000\",\"TRAC\":\"0.4521738000000000\",\"DFYN\":\"0.0070664650000000\",\"BIDP\":\"0.0001939030000000\",\"JASMY3L\":\"0.0001653772700000\",\"INJDOWN\":\"0.0000194902500000\",\"KLV\":\"0.0019310340000000\",\"WAXL\":\"0.7858069000000000\",\"TRBDOWN\":\"0.0023138425000000\",\"BCH3L\":\"4.6390663064999996\",\"GMT3S\":\"0.0000457771000000\",\"KMD\":\"0.2493752500000000\",\"BCH3S\":\"0.9634180500000000\",\"ECOX\":\"0.0987506000000000\",\"AAVE3S\":\"0.0560719500000000\",\"GMT3L\":\"0.0053983694650000\",\"EPIK\":\"0.0045857060000000\",\"SUIP\":\"0.1067565950000000\",\"AAVE3L\":\"0.3638687346200000\",\"ZK\":\"0.1262368500000000\",\"ZKF\":\"0.0008595700000000\",\"OMNIA\":\"0.7624186000000000\",\"ZKJ\":\"1.1124435000000000\",\"ZKL\":\"0.1255372000000000\",\"GAFI\":\"3.0634675000000001\",\"CARV\":\"0.8703646000000000\",\"KNC\":\"0.4433782000000000\",\"CATS\":\"0.0000599700000000\",\"PROM\":\"5.2833570000000006\",\"ALEPH\":\"0.1756121500000000\",\"PONKE\":\"0.3958020000000000\",\"OVR\":\"0.1553223000000000\",\"CATI\":\"0.4105146400000000\",\"ORDER\":\"0.1183008200000000\",\"GFT\":\"0.0166616650000000\",\"BIFI\":\"0.0020489750000000\",\"GGC\":\"6.9965029985000000\",\"GGG\":\"0.0403798000000000\",\"DAPPX\":\"0.0043788095000000\",\"SUKU\":\"0.0618790450000000\",\"ULTI\":\"0.0168015950000000\",\"CREDI\":\"0.0192903500000000\",\"ERTHA\":\"0.0010014990000000\",\"FURY\":\"0.1405297000000000\",\"KARRAT\":\"0.5577210000000000\",\"MOBILE\":\"0.0009005495000000\",\"SIDUS\":\"0.0037671155000000\",\"NAVI\":\"0.1254672350000000\",\"TAO\":\"583.4081500000051807\",\"USDJ\":\"1.1386304000000001\",\"MTL\":\"0.9563216000000000\",\"VET\":\"0.0225387250000000\",\"FITFI\":\"0.0036421780000000\",\"USDT\":\"0.9995000000000000\",\"OXT\":\"0.0695652000000000\",\"CANDY\":\"0.0005597200000000\",\"USDP\":\"0.9932031500000000\",\"MTS\":\"0.0027516235000000\",\"TADA\":\"0.0283858000000000\",\"MTV\":\"0.0006559718500000\",\"NAVX\":\"0.1342228550000000\",\"ILV\":\"35.6771524999999671\",\"VINU\":\"0.0000000109045450\",\"GHX\":\"0.0903548000000000\",\"EDU\":\"0.5167415000000000\",\"HYVE\":\"0.0137331300000000\",\"BTC3L\":\"0.0058620675000000\",\"ANYONE\":\"0.9015490000000000\",\"BEAT\":\"0.0012593700000000\",\"KING\":\"0.0004821588000000\",\"CREAM\":\"15.6541689999999973\",\"CAS\":\"0.0038590695000000\",\"IMX\":\"1.4944524000000000\",\"CAT\":\"0.0000256981445000\",\"BTC3S\":\"0.0014142925000000\",\"USDE\":\"0.9985005000000000\",\"USDD\":\"1.0000997000000000\",\"CWAR\":\"0.0037981000000000\",\"USDC\":\"0.9997998500000000\",\"KRL\":\"0.3543127550000000\",\"INJ\":\"21.7691100000000194\",\"GAME\":\"0.0139630150000000\",\"TRIBL\":\"1.0994500000000000\",\"XLM\":\"0.0948525500000000\",\"TRBUP\":\"0.0012293850000000\",\"VRADOWN\":\"0.0013433280000000\",\"SUPER\":\"1.2853570000000000\",\"EIGEN\":\"3.1536223999999999\",\"IOI\":\"0.0146926500000000\",\"KSM\":\"17.5212350000000129\",\"CCD\":\"0.0034832575000000\",\"EGO\":\"0.0093553200000000\",\"EGP\":\"2.7946019999999998\",\"MXC\":\"0.0066866550000000\",\"TEL\":\"0.0014432780000000\",\"MOVR\":\"9.1340307000000027\",\"XMR\":\"155.5421899999990755\",\"MXM\":\"0.0092853550000000\",\"OORT\":\"0.1099949750000000\",\"GLM\":\"0.3231383500000000\",\"RAY\":\"2.0228880499999998\",\"XTAG\":\"0.0218190850000000\",\"GLQ\":\"0.0854572500000000\",\"CWEB\":\"0.0038480750000000\",\"REVU\":\"0.0105047450000000\",\"REVV\":\"0.0039760110000000\",\"ZRO\":\"3.7952014499999994\",\"XNL\":\"0.0093853050000000\",\"XNO\":\"0.8496749500000000\",\"SAROS\":\"0.0019290350000000\",\"KACE\":\"2.1165411999999998\",\"ZRX\":\"0.3186406000000000\",\"WLTH\":\"0.0374312750000000\",\"ATOM3L\":\"0.0321719060000000\",\"GMM\":\"0.0001497251000000\",\"BEER\":\"0.0000138670630000\",\"GMT\":\"0.1275362000000000\",\"HEART\":\"0.0159920000000000\",\"GMX\":\"22.7186349999999882\",\"ABBC\":\"0.0061769100000000\",\"OMNI\":\"8.9235359999999970\",\"ATOM3S\":\"0.0007945225400000\",\"IRL\":\"0.0099650150000000\",\"CFG\":\"0.3248375000000000\",\"WSDM\":\"0.0139830050000000\",\"GNS\":\"1.8390800000000001\",\"VANRY\":\"0.0809295150000000\",\"CFX\":\"0.1595202000000000\",\"GRAIL\":\"817.1212349999937891\",\"BEFI\":\"0.0175712100000000\",\"VELO\":\"0.0132043945000000\",\"XPR\":\"0.0008077959000000\",\"DOVI\":\"0.0584707500000000\",\"ACE\":\"0.0021349320000000\",\"ACH\":\"0.0190534685000000\",\"ISP\":\"0.0012161916000000\",\"XCAD\":\"0.2834582000000000\",\"MINA\":\"0.5630183500000000\",\"TIA\":\"5.9318325999999999\",\"DRIFT\":\"0.4350823500000000\",\"ACQ\":\"0.0056981495000000\",\"ACS\":\"0.0014917537500000\",\"MIND\":\"0.0018920535000000\",\"STORE\":\"0.0062358805000000\",\"REN\":\"0.0351224300000000\",\"ELA\":\"1.7282354500000000\",\"DREAMS\":\"0.0002498750000000\",\"ADA\":\"0.3463267500000000\",\"ELF\":\"0.3777110500000000\",\"REQ\":\"0.0959919800000000\",\"STORJ\":\"0.5662167500000000\",\"LADYS\":\"0.0000000837581000\",\"PAXG\":\"2697.9303600003123340\",\"REZ\":\"0.0409795000000000\",\"XRD\":\"0.0157821050000000\",\"CHO\":\"0.0205097400000000\",\"CHR\":\"0.1769115000000000\",\"ADS\":\"0.1889055000000000\",\"CHZ\":\"0.0738030800000000\",\"ADX\":\"0.1575212000000000\",\"XRP\":\"0.5525036100000000\",\"JASMY\":\"0.0188615645000000\",\"KAGI\":\"0.1834582250000000\",\"FIDA\":\"0.2282858000000000\",\"PBR\":\"0.0291953950000000\",\"AEG\":\"0.0093453250000000\",\"H2O\":\"0.1610194500000000\",\"CHMB\":\"0.0001715641750000\",\"SAND3L\":\"0.0015447972150000\",\"PBX\":\"0.0006879558500000\",\"SOLVE\":\"0.0084557700000000\",\"DECHAT\":\"0.1512243500000000\",\"GARI\":\"0.0076861550000000\",\"SHIB2L\":\"1.1996998499999999\",\"SHIB2S\":\"0.0240879500000000\",\"ENA\":\"0.3942028000000000\",\"VEMP\":\"0.0029335325000000\",\"ENJ\":\"0.1467266000000000\",\"AFG\":\"0.0072163900000000\",\"RATS\":\"0.0001211593900000\",\"GRT\":\"0.1646076550000000\",\"FORWARD\":\"0.0012873560000000\",\"TFUEL\":\"0.0598800450000000\",\"ENS\":\"17.0634640000000052\",\"KASDOWN\":\"0.0258770550000000\",\"XTM\":\"0.0251074400000000\",\"DEGEN\":\"0.0084857550000000\",\"TLM\":\"0.0100449750000000\",\"DYDXDOWN\":\"0.1042598440000000\",\"CKB\":\"0.0146026950000000\",\"LUNC\":\"0.0000889255150000\",\"AURORA\":\"0.1204397500000000\",\"LUNA\":\"0.3624187000000000\",\"XTZ\":\"0.6776610000000000\",\"ELON\":\"0.0000001410294500\",\"DMTR\":\"0.0891554000000000\",\"EOS\":\"0.4759619000000000\",\"GST\":\"0.0118940500000000\",\"FORT\":\"0.1155422000000000\",\"FLAME\":\"0.0247076400000000\",\"PATEX\":\"0.9605195000000000\",\"DEEP\":\"0.0328885475000000\",\"ID3L\":\"0.0016201895000000\",\"GTC\":\"0.6625685500000000\",\"ID3S\":\"0.0071674145000000\",\"RIO\":\"0.7616190000000000\",\"CLH\":\"0.0008555720000000\",\"BURGER\":\"0.4016990500000000\",\"VRA\":\"0.0029765110000000\",\"SUNDOG\":\"0.2173912500000000\",\"GTT\":\"0.0002038980000000\",\"INJUP\":\"0.2327835500000000\",\"CPOOL\":\"0.1557720750000000\",\"EPX\":\"0.0000740629500000\",\"CLV\":\"0.0329835000000000\",\"FEAR\":\"0.0560519600000000\",\"MEME\":\"0.0124847545000000\",\"ROOBEE\":\"0.0004520738500000\",\"DEFI\":\"0.0192903500000000\",\"TOKEN\":\"0.0477361200000000\",\"GRAPE\":\"0.0020599695000000\",\"KASUP\":\"0.3996001000000000\",\"XWG\":\"0.0003843077500000\",\"SKEY\":\"0.0621289200000000\",\"SFUND\":\"1.3243375000000000\",\"EQX\":\"0.0032823580000000\",\"ORDIUP\":\"0.0548315705000000\",\"TON\":\"5.1857058499999995\",\"DEGO\":\"2.2667660500000001\",\"IZI\":\"0.0088455750000000\",\"ERG\":\"0.6605695500000000\",\"ERN\":\"1.9255367500000001\",\"VENOM\":\"0.0817591000000000\",\"VOXEL\":\"0.1497251000000000\",\"RLC\":\"1.4649671500000000\",\"PHA\":\"0.1093453000000000\",\"DYDXUP\":\"0.0112573685000000\",\"APE3S\":\"0.0008475760000000\",\"ORBS\":\"0.0288955450000000\",\"OPDOWN\":\"0.6758619000000000\",\"ESE\":\"0.0139130400000000\",\"APE3L\":\"0.1339330000000000\",\"HMND\":\"0.0982208650000000\",\"COQ\":\"0.0000014432780000\",\"AURY\":\"0.3340329000000000\",\"CULT\":\"0.0000028025980000\",\"AKT\":\"2.4642672500000001\",\"GLMR\":\"0.1606196500000000\",\"XYM\":\"0.0142528700000000\",\"ORAI\":\"6.1769100000000012\",\"XYO\":\"0.0058680645000000\",\"ETC\":\"18.8458723500000169\",\"LAI\":\"0.0142828550000000\",\"PIP\":\"0.0178310800000000\",\"ETH\":\"2607.6655149998362673\",\"NEO\":\"10.3575186499999991\",\"RMV\":\"0.0081659150000000\",\"KLAY\":\"0.1251374000000000\",\"PIT\":\"0.0000000003268365\",\"TARA\":\"0.0043978000000000\",\"KALT\":\"0.1128735350000000\",\"PIX\":\"0.0001023687900000\",\"ETN\":\"0.0021579205000000\",\"CSIX\":\"0.0141729100000000\",\"TRADE\":\"0.4708644500000000\",\"MAVIA\":\"1.3592200500000001\",\"HIGH\":\"1.3043474999999999\",\"TRB\":\"62.5387150000000006\",\"ORDI\":\"35.7421200000000126\",\"TRVL\":\"0.0373643085000000\",\"AMB\":\"0.0059670150000000\",\"TRU\":\"0.0762018800000000\",\"LOGX\":\"0.0271963950000000\",\"FINC\":\"0.0362018900000000\",\"INFRA\":\"0.1978010500000000\",\"NATIX\":\"0.0008729633000000\",\"NFP\":\"0.2152923000000000\",\"TRY\":\"0.0292166033323590\",\"TRX\":\"0.1597201000000000\",\"LBP\":\"0.0001243378000000\",\"LBR\":\"0.0595702000000000\",\"EUL\":\"2.9735125000000000\",\"NFT\":\"0.0000004077960000\",\"SEIUP\":\"0.0478110825000000\",\"PUFFER\":\"0.3676161000000000\",\"EUR\":\"1.0811249323958897\",\"ORCA\":\"2.0664662499999999\",\"NEAR3L\":\"0.0117010765350000\",\"AMP\":\"0.0038330825000000\",\"XDEFI\":\"0.0472563600000000\",\"HIFI\":\"0.4947525000000000\",\"TRUF\":\"0.0459570100000000\",\"AITECH\":\"0.1045477000000000\",\"AMU\":\"0.0043978000000000\",\"USTC\":\"0.0214692600000000\",\"KNGL\":\"0.0499750000000000\",\"FOXY\":\"0.0102686631000000\",\"NGC\":\"0.0147935995000000\",\"TENET\":\"0.0043278350000000\",\"NEAR3S\":\"0.0072553705000000\",\"MAHA\":\"1.1904045000000000\",\"NGL\":\"0.0701748950000000\",\"TST\":\"0.0080359800000000\",\"HIPPO\":\"0.0104447750000000\",\"AXS3S\":\"0.0308705570000000\",\"CRO\":\"0.0781409100000000\",\"ZPAY\":\"0.0050574700000000\",\"MNDE\":\"0.1026786350000000\",\"CRV\":\"0.2534732000000000\",\"SWASH\":\"0.0056271850000000\",\"AXS3L\":\"0.0106388779000000\",\"VERSE\":\"0.0001803098000000\",\"RPK\":\"0.0049975000000000\",\"RPL\":\"10.9745099999999958\",\"AZERO\":\"0.3789104500000000\",\"SOUL\":\"0.0534332700000000\",\"VXV\":\"0.2619689500000000\",\"LDO\":\"1.0885554500000000\",\"MAGIC\":\"0.3390304000000000\",\"ALICE\":\"1.0324835000000000\",\"SEAM\":\"1.1933030499999999\",\"PLU\":\"1.9300345000000001\",\"AOG\":\"0.0031224380000000\",\"SMOLE\":\"0.0000387806000000\",\"EWT\":\"1.1094450000000000\",\"TSUGT\":\"0.0029185400000000\",\"PMG\":\"0.0800599500000000\",\"OPAI\":\"0.0006826585000000\",\"LOCUS\":\"0.0216591650000000\",\"CTA\":\"0.0825087250000000\",\"NIM\":\"0.0013673160000000\",\"CTC\":\"0.4033982000000000\",\"APE\":\"0.7035480500000000\",\"MERL\":\"0.2720639000000000\",\"JAM\":\"0.0004770613500000\",\"CTI\":\"0.0130314810000000\",\"APP\":\"0.0021989000000000\",\"APT\":\"9.9947001500000000\",\"WLDUP\":\"0.0093043455000000\",\"ZEND\":\"0.1280759300000000\",\"FIRE\":\"0.9113441000000000\",\"DENT\":\"0.0008630682500000\",\"PYTH\":\"0.3390603850000000\",\"LFT\":\"0.0155322300000000\",\"DPET\":\"0.0319040400000000\",\"ORDIDOWN\":\"0.3788105000000000\",\"KPOL\":\"0.0029175405000000\",\"ETHUP\":\"8.4971493000000032\",\"BAND\":\"1.0939527500000001\",\"POL\":\"0.3656171000000000\",\"ASTR\":\"0.0582608550000000\",\"NKN\":\"0.0691654000000000\",\"RSR\":\"0.0068055955000000\",\"DVPN\":\"0.0005979009000000\",\"TWT\":\"1.1119437500000000\",\"ARB\":\"0.5510243500000000\",\"CVC\":\"0.1409801746501747\",\"ARC\":\"0.0300849500000000\",\"XETA\":\"0.0022888550000000\",\"MTRG\":\"0.4007995000000000\",\"LOKA\":\"0.1867066000000000\",\"LPOOL\":\"0.0660069800000000\",\"TURBOS\":\"0.0034812585000000\",\"CVX\":\"1.7816087499999999\",\"ARX\":\"0.0007556220000000\",\"MPLX\":\"0.4355221300000000\",\"SUSHI\":\"0.7011492500000000\",\"NLK\":\"0.0114442750000000\",\"PEPE2\":\"0.0000000313843000\",\"WBTC\":\"66881.4425499645548419\",\"SUI3L\":\"0.0211204345000000\",\"CWS\":\"0.1927036000000000\",\"SUI3S\":\"0.0000579110300000\",\"INSP\":\"0.0264167850000000\",\"MANA\":\"0.2945026750000000\",\"VRTX\":\"0.0641679000000000\",\"CSPR\":\"0.0116441750000000\",\"ATA\":\"0.0785007300000000\",\"OPEN\":\"0.0080049955000000\",\"HAI\":\"0.0448275750000000\",\"NMR\":\"14.7436245000000072\",\"ATH\":\"0.0540929400000000\",\"LIT\":\"0.6282857000000000\",\"TLOS\":\"0.3263467450000000\",\"TNSR\":\"0.3662168000000000\",\"CXT\":\"0.0871364100000000\",\"POLYX\":\"0.2346826000000000\",\"ZERO\":\"0.0002507745500000\",\"ROUTE\":\"0.0610694500000000\",\"LOOM\":\"0.0580009850000000\",\"PRE\":\"0.0078680640000000\",\"VRAUP\":\"0.0134652640000000\",\"HBB\":\"0.0714742450000000\",\"RVN\":\"0.0165017450000000\",\"PRQ\":\"0.0715741950000000\",\"ONDO\":\"0.7134930750000000\",\"PEPEDOWN\":\"0.0000155022450000\",\"WOOP\":\"0.0020179905000000\",\"LUNCUP\":\"0.0168355780000000\",\"KAVA\":\"0.3522238000000000\",\"LKI\":\"0.0104187880000000\",\"AVA\":\"0.4857570000000000\",\"NOM\":\"0.0233883000000000\",\"MAPO\":\"0.0089015470000000\",\"PEPEUP\":\"0.0114252845000000\",\"STRAX\":\"0.0487156300000000\",\"NOT\":\"0.0078670645000000\",\"ZERC\":\"0.1108245600000000\",\"BCUT\":\"0.0255672100000000\",\"MASA\":\"0.0691354150000000\",\"WAN\":\"0.1785077544737212\",\"WAT\":\"0.0003273762300000\",\"WAX\":\"0.0327636100000000\",\"MASK\":\"2.2259864500000002\",\"EOS3L\":\"0.0002122138400000\",\"IDEA\":\"0.0005887055000000\",\"EOS3S\":\"0.0034472755000000\",\"YFI\":\"4919.4290549999908843\",\"MOODENG\":\"0.0774612500000000\",\"XCUR\":\"0.0048845565000000\",\"HYDRA\":\"0.2225886500000000\",\"POPCAT\":\"1.3382305500000000\",\"LQTY\":\"0.7848074000000000\",\"PIXEL\":\"0.1406596350000000\",\"LMR\":\"0.0145437245000000\",\"ZETA\":\"0.5997999500000000\",\"YGG\":\"0.4717640000000000\",\"AXS\":\"4.6006985000000006\",\"BCHSV\":\"49.8250749999999370\",\"NRN\":\"0.0395802000000000\",\"FTON\":\"0.0091954000000000\",\"COMP\":\"43.6581599999999881\",\"XPRT\":\"0.1819090000000000\",\"HFT\":\"0.1443278000000000\",\"UXLINK\":\"0.5085456000000000\",\"STAMP\":\"0.0335032400000000\",\"RUNE\":\"4.9233370999999996\",\"ZEUS\":\"0.2587705500000000\",\"LTC3L\":\"1.8294848000000001\",\"DAPP\":\"0.1763118000000000\",\"FORTH\":\"2.9508238500000004\",\"ALPINE\":\"1.5322335000000000\",\"SENSO\":\"0.0328835500000000\",\"LTC3S\":\"0.0006986505000000\",\"DEXE\":\"8.3795081500000028\",\"GOAL\":\"0.0175912000000000\",\"AVAX\":\"27.5602130000000058\",\"LISTA\":\"0.3782108000000000\",\"AMPL\":\"1.3743124999999999\",\"WORK\":\"0.1384307500000000\",\"BRWL\":\"0.0017391300000000\",\"BANANA\":\"57.1314200000001362\",\"PUSH\":\"0.0750624500000000\",\"WEN\":\"0.0001015492000000\",\"NEIRO\":\"0.0879560000000000\",\"BTCUP\":\"34.7711057499999789\",\"SOL3S\":\"0.0007816090000000\",\"BRAWL\":\"0.0004776610500000\",\"LAY3R\":\"0.2161918500000000\",\"LPT\":\"11.9304317999999945\",\"GODS\":\"0.1807096000000000\",\"SAND3S\":\"4.6152911999999992\",\"RDNT\":\"0.0640679500000000\",\"SOL3L\":\"1.8351913752850000\",\"NIBI\":\"0.0653772950000000\",\"NUM\":\"0.0436181800000000\",\"PYR\":\"2.5590198499999997\",\"DAG\":\"0.0226176855000000\",\"DAI\":\"0.9989006596042375\",\"HIP\":\"0.0034982500000000\",\"DAO\":\"0.2848575000000000\",\"AVAIL\":\"0.1300929210000000\",\"DAR\":\"0.1512243500000000\",\"FET\":\"1.3760116500000000\",\"FCON\":\"0.0001197600900000\",\"XAVA\":\"0.3789104500000000\",\"LRC\":\"0.1208395500000000\",\"UNI3S\":\"0.0000653573050000\",\"PZP\":\"0.0599600050000000\",\"POKT\":\"0.0424787500000000\",\"DASH\":\"23.6881500000000109\",\"BAKEDOWN\":\"0.0003324636850000\",\"POLC\":\"0.0061389290000000\",\"DBR\":\"0.0377671070000000\",\"CIRUS\":\"0.0055772100000000\",\"UNI3L\":\"0.0993921490650000\",\"NWC\":\"0.0681659000000000\",\"POLK\":\"0.0142628650000000\",\"LSD\":\"0.9420287500000000\",\"MARS4\":\"0.0005878059500000\",\"LSK\":\"0.8080957500000000\",\"BLOCK\":\"0.0261869000000000\",\"ANALOS\":\"0.0000446776500000\",\"SAFE\":\"0.8779608000000000\",\"DCK\":\"0.0234082900000000\",\"LSS\":\"0.0562718500000000\",\"DCR\":\"12.4337799999999929\",\"LIKE\":\"0.0559720000000000\",\"DATA\":\"0.0361819000000000\",\"WIF\":\"2.5696145499999999\",\"BLOK\":\"0.0006546725000000\",\"LTC\":\"71.6261690000000611\",\"METIS\":\"42.0289750000000612\",\"WIN\":\"0.0000868365600000\",\"HLG\":\"0.0018790600000000\",\"LTO\":\"0.1166116650000000\",\"DYDX\":\"0.9341327000000000\",\"ARB3S\":\"0.0509025360000000\",\"MUBI\":\"0.0303848000000000\",\"ARB3L\":\"0.0025917035000000\",\"RBTC1\":\"0.0000039480250000\",\"POND\":\"0.0118640650000000\",\"LINA\":\"0.0037771105000000\",\"MYRIA\":\"0.0025337325000000\",\"LINK\":\"11.0244849999999944\",\"QTUM\":\"2.4262016723130069\",\"TUNE\":\"0.0148025950000000\",\"UFO\":\"0.0000006479758500\",\"CYBER\":\"2.8755615000000001\",\"WILD\":\"0.2433782500000000\",\"POLS\":\"0.2809594500000000\",\"NYM\":\"0.0719640000000000\",\"FIL\":\"3.6786597500000005\",\"BAL\":\"2.0099945000000000\",\"SCA\":\"0.3999999000000000\",\"STND\":\"0.0133123405000000\",\"WMTX\":\"0.2138930000000000\",\"SCLP\":\"0.1545227000000000\",\"MANEKI\":\"0.0073963000000000\",\"BAT\":\"0.1721139000000000\",\"AKRO\":\"0.0042302838000000\",\"FTM3L\":\"8.2574692000000024\",\"BAX\":\"0.0000709645000000\",\"FTM3S\":\"0.0000255072400000\",\"COTI\":\"0.0951524000000000\"}}"
        common_response = RestResponse.from_json(data)
        resp = GetFiatPriceResp.from_dict(common_response.data)

    def test_get24hr_stats_req_model(self):
        """
       get24hr_stats
       Get 24hr Stats
       /api/v1/market/stats
       """
        data = "{\"symbol\": \"BTC-USDT\"}"
        req = Get24hrStatsReq.from_json(data)

    def test_get24hr_stats_resp_model(self):
        """
        get24hr_stats
        Get 24hr Stats
        /api/v1/market/stats
        """
        data = "{\"code\":\"200000\",\"data\":{\"time\":1729175612158,\"symbol\":\"BTC-USDT\",\"buy\":\"66982.4\",\"sell\":\"66982.5\",\"changeRate\":\"-0.0114\",\"changePrice\":\"-778.1\",\"high\":\"68107.7\",\"low\":\"66683.3\",\"vol\":\"1738.02898182\",\"volValue\":\"117321982.415978333\",\"last\":\"66981.5\",\"averagePrice\":\"67281.21437289\",\"takerFeeRate\":\"0.001\",\"makerFeeRate\":\"0.001\",\"takerCoefficient\":\"1\",\"makerCoefficient\":\"1\"}}"
        common_response = RestResponse.from_json(data)
        resp = Get24hrStatsResp.from_dict(common_response.data)

    def test_get_market_list_req_model(self):
        """
       get_market_list
       Get Market List
       /api/v1/markets
       """

    def test_get_market_list_resp_model(self):
        """
        get_market_list
        Get Market List
        /api/v1/markets
        """
        data = "{\"code\":\"200000\",\"data\":[\"USDS\",\"TON\",\"AI\",\"DePIN\",\"PoW\",\"BRC-20\",\"ETF\",\"KCS\",\"Meme\",\"Solana\",\"FIAT\",\"VR&AR\",\"DeFi\",\"Polkadot\",\"BTC\",\"ALTS\",\"Layer 1\"]}"
        common_response = RestResponse.from_json(data)
        resp = GetMarketListResp.from_dict(common_response.data)

    def test_get_client_ip_address_req_model(self):
        """
       get_client_ip_address
       Get Client IP Address
       /api/v1/my-ip
       """

    def test_get_client_ip_address_resp_model(self):
        """
        get_client_ip_address
        Get Client IP Address
        /api/v1/my-ip
        """
        data = "{\"code\":\"200000\",\"data\":\"20.***.***.128\"}"
        common_response = RestResponse.from_json(data)
        resp = GetClientIpAddressResp.from_dict(common_response.data)

    def test_get_server_time_req_model(self):
        """
       get_server_time
       Get Server Time
       /api/v1/timestamp
       """

    def test_get_server_time_resp_model(self):
        """
        get_server_time
        Get Server Time
        /api/v1/timestamp
        """
        data = "{\"code\":\"200000\",\"data\":1729100692873}"
        common_response = RestResponse.from_json(data)
        resp = GetServerTimeResp.from_dict(common_response.data)

    def test_get_service_status_req_model(self):
        """
       get_service_status
       Get Service Status
       /api/v1/status
       """

    def test_get_service_status_resp_model(self):
        """
        get_service_status
        Get Service Status
        /api/v1/status
        """
        data = "{\"code\":\"200000\",\"data\":{\"status\":\"open\",\"msg\":\"\"}}"
        common_response = RestResponse.from_json(data)
        resp = GetServiceStatusResp.from_dict(common_response.data)

    def test_get_public_token_req_model(self):
        """
       get_public_token
       Get Public Token - Spot/Margin
       /api/v1/bullet-public
       """

    def test_get_public_token_resp_model(self):
        """
        get_public_token
        Get Public Token - Spot/Margin
        /api/v1/bullet-public
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"token\": \"2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ93g2WHl-j4M7tCZ_S21PuIByWXUJFDywtiYB9J6i9GjsxUuhPw3Blq6rhZlGykT3Vp1phUafnulOOpts-MEmEF-3bpfetLOAq79RbGaLlE4JBvJHl5Vs9Y=.ymP9jIr6v-vucrZr8761yA==\",\n        \"instanceServers\": [\n            {\n                \"endpoint\": \"wss://ws-api-spot.kucoin.com/\",\n                \"encrypt\": true,\n                \"protocol\": \"websocket\",\n                \"pingInterval\": 18000,\n                \"pingTimeout\": 10000\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetPublicTokenResp.from_dict(common_response.data)

    def test_get_private_token_req_model(self):
        """
       get_private_token
       Get Private Token - Spot/Margin
       /api/v1/bullet-private
       """

    def test_get_private_token_resp_model(self):
        """
        get_private_token
        Get Private Token - Spot/Margin
        /api/v1/bullet-private
        """
        data = "{\n    \"code\": \"200000\",\n    \"data\": {\n        \"token\": \"2neAiuYvAU737TOajb2U3uT8AEZqSWYe0fBD4LoHuXJDSC7gIzJiH4kNTWhCPISWo6nDpAe7aUaaHJ4fG8oRjFgMfUI2sM4IySWHrBceFocY8pKy2REU1HwZIngtMdMrjqPnP-biofFWbNaP1cl0X1pZc2SQ-33hDH1LgNP-yg80ZJv_Ctaj8sAFhTOZ8m1L.jut4vBQxXAseWKxODdGVGg==\",\n        \"instanceServers\": [\n            {\n                \"endpoint\": \"wss://ws-api-spot.kucoin.com/\",\n                \"encrypt\": true,\n                \"protocol\": \"websocket\",\n                \"pingInterval\": 18000,\n                \"pingTimeout\": 10000\n            }\n        ]\n    }\n}"
        common_response = RestResponse.from_json(data)
        resp = GetPrivateTokenResp.from_dict(common_response.data)
