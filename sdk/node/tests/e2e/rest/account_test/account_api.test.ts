import {
    ClientOptionBuilder,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    TransportOptionBuilder,
} from '@model/index';
import {
    AccountAPI,
    GetCrossMarginAccountReq,
    GetFuturesAccountReq,
    GetFuturesLedgerReq,
    GetIsolatedMarginAccountDetailV1Req,
    GetIsolatedMarginAccountListV1Req,
    GetIsolatedMarginAccountReq,
    GetMarginHFLedgerReq,
    GetSpotAccountDetailReq,
    GetSpotAccountListReq,
    GetSpotHFLedgerReq,
    GetSpotLedgerReq,
} from '@src/generate/account/account';
import { DefaultClient } from '@api/index';

describe('Auto Test', () => {
    let api: AccountAPI;

    beforeAll(() => {
        const key = process.env.API_KEY || '';
        const secret = process.env.API_SECRET || '';
        const passphrase = process.env.API_PASSPHRASE || '';

        // Set specific options, others will fall back to default values
        const httpTransportOption = new TransportOptionBuilder()
            .setKeepAlive(true)
            .setMaxConnsPerHost(10)
            .setMaxIdleConns(10)
            .build();

        // Create a client using the specified options
        const clientOption = new ClientOptionBuilder()
            .setKey(key)
            .setSecret(secret)
            .setPassphrase(passphrase)
            .setSpotEndpoint(GlobalApiEndpoint)
            .setFuturesEndpoint(GlobalFuturesApiEndpoint)
            .setBrokerEndpoint(GlobalBrokerApiEndpoint)
            .setTransportOption(httpTransportOption)
            .build();

        const client = new DefaultClient(clientOption);

        // Get the Restful Service
        const kucoinRestService = client.restService();
        api = kucoinRestService.getAccountService().getAccountApi();
    });
    test('getAccountInfo request test', () => {
        /**
         * getAccountInfo
         * Get Account Summary Info
         * /api/v2/user-info
         */
        let resp = api.getAccountInfo();
        return resp.then((result) => {
            expect(result.level).toEqual(expect.anything());
            expect(result.subQuantity).toEqual(expect.anything());
            expect(result.spotSubQuantity).toEqual(expect.anything());
            expect(result.marginSubQuantity).toEqual(expect.anything());
            expect(result.futuresSubQuantity).toEqual(expect.anything());
            expect(result.optionSubQuantity).toEqual(expect.anything());
            expect(result.maxSubQuantity).toEqual(expect.anything());
            expect(result.maxDefaultSubQuantity).toEqual(expect.anything());
            expect(result.maxSpotSubQuantity).toEqual(expect.anything());
            expect(result.maxMarginSubQuantity).toEqual(expect.anything());
            expect(result.maxFuturesSubQuantity).toEqual(expect.anything());
            expect(result.maxOptionSubQuantity).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getApikeyInfo request test', () => {
        /**
         * getApikeyInfo
         * Get Apikey Info
         * /api/v1/user/api-key
         */
        let resp = api.getApikeyInfo();
        return resp.then((result) => {
            expect(result.remark).toEqual(expect.anything());
            expect(result.apiKey).toEqual(expect.anything());
            expect(result.apiVersion).toEqual(expect.anything());
            expect(result.permission).toEqual(expect.anything());
            expect(result.ipWhitelist).toEqual(expect.anything());
            expect(result.createdAt).toEqual(expect.anything());
            expect(result.uid).toEqual(expect.anything());
            expect(result.isMaster).toEqual(expect.anything());
            expect(result.subName).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSpotAccountType request test', () => {
        /**
         * getSpotAccountType
         * Get Account Type - Spot
         * /api/v1/hf/accounts/opened
         */
        let resp = api.getSpotAccountType();
        return resp.then((result) => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSpotAccountList request test', () => {
        /**
         * getSpotAccountList
         * Get Account List - Spot
         * /api/v1/accounts
         */
        let builder = GetSpotAccountListReq.builder();
        builder.setType(GetSpotAccountListReq.TypeEnum.MAIN);
        let req = builder.build();
        let resp = api.getSpotAccountList(req);
        return resp.then(result => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSpotAccountDetail request test', () => {
        /**
         * getSpotAccountDetail
         * Get Account Detail - Spot
         * /api/v1/accounts/{accountId}
         */
        let builder = GetSpotAccountDetailReq.builder();
        builder.setAccountId('671badb050647f0007d94011');
        let req = builder.build();
        let resp = api.getSpotAccountDetail(req);
        return resp.then(result => {
            expect(result.currency).toEqual(expect.anything());
            expect(result.balance).toEqual(expect.anything());
            expect(result.available).toEqual(expect.anything());
            expect(result.holds).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getCrossMarginAccount request test', () => {
        /**
         * getCrossMarginAccount
         * Get Account - Cross Margin
         * /api/v3/margin/accounts
         */
        let builder = GetCrossMarginAccountReq.builder();
        builder.setQuoteCurrency(GetCrossMarginAccountReq.QuoteCurrencyEnum.USDT).setQueryType(GetCrossMarginAccountReq.QueryTypeEnum.MARGIN);
        let req = builder.build();
        let resp = api.getCrossMarginAccount(req);
        return resp.then(result => {
            expect(result.totalAssetOfQuoteCurrency).toEqual(expect.anything());
            expect(result.totalLiabilityOfQuoteCurrency).toEqual(expect.anything());
            expect(result.debtRatio).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            expect(result.accounts).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getIsolatedMarginAccount request test', () => {
        /**
         * getIsolatedMarginAccount
         * Get Account - Isolated Margin
         * /api/v3/isolated/accounts
         */
        let builder = GetIsolatedMarginAccountReq.builder();
        builder.setSymbol('BTC-USDT').setQuoteCurrency(GetIsolatedMarginAccountReq.QuoteCurrencyEnum.USDT).setQueryType(GetIsolatedMarginAccountReq.QueryTypeEnum.ISOLATED);
        let req = builder.build();
        let resp = api.getIsolatedMarginAccount(req);
        return resp.then(result => {
            expect(result.totalAssetOfQuoteCurrency).toEqual(expect.anything());
            expect(result.totalLiabilityOfQuoteCurrency).toEqual(expect.anything());
            expect(result.timestamp).toEqual(expect.anything());
            expect(result.assets).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getFuturesAccount request test', () => {
        /**
         * getFuturesAccount
         * Get Account - Futures
         * /api/v1/account-overview
         */
        let builder = GetFuturesAccountReq.builder();
        builder.setCurrency('XBT');
        let req = builder.build();
        let resp = api.getFuturesAccount(req);
        return resp.then(result => {
            expect(result.accountEquity).toEqual(expect.anything());
            expect(result.unrealisedPNL).toEqual(expect.anything());
            expect(result.marginBalance).toEqual(expect.anything());
            expect(result.positionMargin).toEqual(expect.anything());
            expect(result.orderMargin).toEqual(expect.anything());
            expect(result.frozenFunds).toEqual(expect.anything());
            expect(result.availableBalance).toEqual(expect.anything());
            expect(result.currency).toEqual(expect.anything());
            expect(result.riskRatio).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSpotLedger request test', () => {
        /**
         * getSpotLedger
         * Get Account Ledgers - Spot/Margin
         * /api/v1/accounts/ledgers
         */
        let builder = GetSpotLedgerReq.builder();
        builder.setCurrency('USDT').setStartAt(1732032000000).setEndAt(1732118400000).setCurrentPage(1).setPageSize(100);
        let req = builder.build();
        let resp = api.getSpotLedger(req);
        return resp.then(result => {
            expect(result.currentPage).toEqual(expect.anything());
            expect(result.pageSize).toEqual(expect.anything());
            expect(result.totalNum).toEqual(expect.anything());
            expect(result.totalPage).toEqual(expect.anything());
            expect(result.items).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getSpotHFLedger request test', () => {
        /**
         * getSpotHFLedger
         * Get Account Ledgers - Trade_hf
         * /api/v1/hf/accounts/ledgers
         */
        let builder = GetSpotHFLedgerReq.builder();
        builder.setCurrency('USDT').setDirection(GetSpotHFLedgerReq.DirectionEnum.OUT).setBizType(GetSpotHFLedgerReq.BizTypeEnum.TRANSFER)
        let req = builder.build();
        let resp = api.getSpotHFLedger(req);
        return resp.then(result => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getMarginHFLedger request test', () => {
        /**
         * getMarginHFLedger
         * Get Account Ledgers - Margin_hf
         * /api/v3/hf/margin/account/ledgers
         */
        let builder = GetMarginHFLedgerReq.builder();
        builder.setCurrency('USDT')
        let req = builder.build();
        let resp = api.getMarginHFLedger(req);
        return resp.then(result => {
            expect(result.data).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getFuturesLedger request test', () => {
        /**
         * getFuturesLedger
         * Get Account Ledgers - Futures
         * /api/v1/transaction-history
         */
        let builder = GetFuturesLedgerReq.builder();
        builder.setCurrency('DOT').setType('RealisedPNL')
        let req = builder.build();
        let resp = api.getFuturesLedger(req);
        return resp.then(result => {
            expect(result.dataList).toEqual(expect.anything());
            expect(result.hasMore).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getMarginAccountDetail request test', () => {
        /**
         * getMarginAccountDetail
         * Get Account Detail - Margin
         * /api/v1/margin/account
         */
        let resp = api.getMarginAccountDetail();
        return resp.then(result => {
            expect(result.debtRatio).toEqual(expect.anything());
            expect(result.accounts).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getIsolatedMarginAccountListV1 request test', () => {
        /**
         * getIsolatedMarginAccountListV1
         * Get Account List - Isolated Margin - V1
         * /api/v1/isolated/accounts
         */
        let builder = GetIsolatedMarginAccountListV1Req.builder();
        builder.setBalanceCurrency(GetIsolatedMarginAccountListV1Req.BalanceCurrencyEnum.BTC);
        let req = builder.build();
        let resp = api.getIsolatedMarginAccountListV1(req);
        return resp.then(result => {
            expect(result.totalConversionBalance).toEqual(expect.anything());
            expect(result.liabilityConversionBalance).toEqual(expect.anything());
            expect(result.assets).toEqual(expect.anything());
            console.log(resp);
        });
    });

    test('getIsolatedMarginAccountDetailV1 request test', () => {
        /**
         * getIsolatedMarginAccountDetailV1
         * Get Account Detail - Isolated Margin - V1
         * /api/v1/isolated/account/{symbol}
         */
        let builder = GetIsolatedMarginAccountDetailV1Req.builder();
        builder.setSymbol('BTC-USDT');
        let req = builder.build();
        let resp = api.getIsolatedMarginAccountDetailV1(req);
        return resp.then(result => {
            expect(result.symbol).toEqual(expect.anything());
            expect(result.status).toEqual(expect.anything());
            expect(result.debtRatio).toEqual(expect.anything());
            expect(result.baseAsset).toEqual(expect.anything());
            expect(result.quoteAsset).toEqual(expect.anything());
            console.log(resp);
        });
    });
});