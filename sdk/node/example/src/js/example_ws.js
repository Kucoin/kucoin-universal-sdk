const {
    ClientOptionBuilder,
    DefaultClient,
    GlobalApiEndpoint,
    GlobalBrokerApiEndpoint,
    GlobalFuturesApiEndpoint,
    WebSocketClientOptionBuilder,
} = require("kucoin-universal-sdk");

function delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

function wsExample() {
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
        .setWebSocketClientOption(websocketClientOption)
        .build();

    const client = new DefaultClient(clientOption);
    const wsService = client.wsService();

    spotWsExample(wsService.newSpotPublicWS());
}

/** @typedef {import('kucoin-universal-sdk').Spot.SpotPublicWS}  SpotPublicWS*/
/**
 * @param {SpotPublicWS} spotPublic 
 */
async function spotWsExample(spotPublic) {
    await spotPublic.start();

    let subid = spotPublic.allTickers((topic, subject, data) => {
        console.log(data);
    });

    await subid
        .then(async (id) => {
            await delay(5000);
            return id;
        })
        .then((id) => {
            return spotPublic.unSubscribe(id);
        })
        .then(() => {
            return spotPublic.stop();
        });
}

wsExample();
