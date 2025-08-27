import {
    ClientOptionBuilder,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    UnifiedWsArgs,
    UnifiedWsMessage,
    WebSocketClientOptionBuilder,
} from '@model/index';
import { UnifiedPrivateWS } from '@src/generate/unified/unifiedws';
import { DefaultClient } from '@api/index';
import { randomUUID } from 'crypto';
import { GlobalUnifiedWsApiEndpoint } from '../../../../src';

jest.setTimeout(300000);

describe('Spot Private WebSocket API Tests', () => {
    let api: UnifiedPrivateWS;

    beforeAll(async () => {
        const key = process.env.API_KEY || '';
        const secret = process.env.API_SECRET || '';
        const passphrase = process.env.API_PASSPHRASE || '';

        const websocketClientOption = new WebSocketClientOptionBuilder().build();

        const clientOption = new ClientOptionBuilder()
            .setKey(key)
            .setSecret(secret)
            .setPassphrase(passphrase)
            .setSpotEndpoint(GlobalApiEndpoint)
            .setFuturesEndpoint(GlobalFuturesApiEndpoint)
            .setBrokerEndpoint(GlobalBrokerApiEndpoint)
            .setUnifiedWsEndpoint(GlobalUnifiedWsApiEndpoint)
            .setWebSocketClientOption(websocketClientOption)
            .build();

        const client = new DefaultClient(clientOption);
        const wsService = client.wsService();
        api = wsService.newUnifiedPrivateWS();
        await api.start();
    });

    afterAll(() => {
        return api.stop();
    });

    test('place test', async () => {
        const tasks: Array<Promise<UnifiedWsMessage | void>> = [];

        for (let i = 0; i < 5; i++) {
            const placeArgs: UnifiedWsArgs = {
                id: randomUUID(),
                op: 'spot.order',
                args: {
                    clientOid: randomUUID(),
                    side: 'buy',
                    symbol: 'BTC-USDT',
                    type: 'limit',
                    remark: 'test',
                    price: '1',
                    size: '2',
                },
            };

            const p = api.unifiedTrading(placeArgs).then((msg) => {
                const orderId = msg?.data?.orderId ?? msg?.data?.orderID ?? msg?.data?.id;
                if (!orderId) {
                    throw new Error(
                        `Place order ok but no orderId in response: ${JSON.stringify(msg)}`,
                    );
                }

                const cancelArgs: UnifiedWsArgs = {
                    id: randomUUID(),
                    op: 'spot.cancel',
                    args: {
                        orderId,
                        symbol: 'BTC-USDT',
                    },
                };

                return api.unifiedTrading(cancelArgs).then((cancelMsg) => {
                    return cancelMsg;
                });
            });

            tasks.push(p);
        }

        await Promise.all(tasks);
    }, 60_000);

    test('do nothing (sleep 30s)', async () => {
        await new Promise((r) => setTimeout(r, 30_000));
    }, 35_000);
});
