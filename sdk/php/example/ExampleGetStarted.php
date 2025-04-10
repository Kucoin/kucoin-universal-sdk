<?php


use KuCoin\UniversalSDK\Api\DefaultClient;
use KuCoin\UniversalSDK\Generate\Spot\Market\GetPartOrderBookReq;
use KuCoin\UniversalSDK\Model\ClientOptionBuilder;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\TransportOptionBuilder;

include '../vendor/autoload.php';


function stringifyDepth($depth): string
{
    return implode(', ', array_map(function ($row) {
        return '[' . implode(', ', $row) . ']';
    }, $depth));
}

function example()
{

    // Logger configuration
    date_default_timezone_set('UTC');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Retrieve API secret information from environment variables
    $key = getenv('API_KEY') ?: '';
    $secret = getenv('API_SECRET') ?: '';
    $passphrase = getenv('API_PASSPHRASE') ?: '';

    // Set specific options, others will fall back to default values
    $httpTransportOption = (new TransportOptionBuilder())
        ->setKeepAlive(true)
        ->setMaxPoolSize(10)
        ->setMaxConnectionPerPool(10)
        ->build();

    // Create a client using the specified options
    $clientOption = (new ClientOptionBuilder())
        ->setKey($key)
        ->setSecret($secret)
        ->setPassphrase($passphrase)
        ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)
        ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)
        ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)
        ->setTransportOption($httpTransportOption)
        ->build();

    $client = new DefaultClient($clientOption);

    // Get the Restful Service
    $kucoinRestService = $client->restService();

    $spotMarketApi = $kucoinRestService->getSpotService()->getMarketApi();

    // Query for part orderbook depth data. (aggregated by price)
    $request = GetPartOrderBookReq::builder()
        ->setSymbol("BTC-USDT")
        ->setSize("20")
        ->build();

    $response = $spotMarketApi->getPartOrderBook($request);

    error_log(sprintf(
        "time=%d, sequence=%d, bids=%s, asks=%s",
        $response->time,
        $response->sequence,
        stringifyDepth($response->bids),
        stringifyDepth($response->asks)
    ));
}

if (php_sapi_name() === 'cli') {
    example();
}
