<?php

use KuCoin\UniversalSDK\Api\DefaultClient;
use KuCoin\UniversalSDK\Generate\Account\Fee\GetSpotActualFeeReq;
use KuCoin\UniversalSDK\Generate\Futures\Market\GetKlinesReq;
use KuCoin\UniversalSDK\Generate\Service\AccountService;
use KuCoin\UniversalSDK\Generate\Service\FuturesService;
use KuCoin\UniversalSDK\Generate\Service\SpotService;
use KuCoin\UniversalSDK\Generate\Spot\Order\AddOrderSyncReq;
use KuCoin\UniversalSDK\Generate\Spot\Order\CancelOrderByOrderIdSyncReq;
use KuCoin\UniversalSDK\Generate\Spot\Order\GetOrderByOrderIdReq;
use KuCoin\UniversalSDK\Model\ClientOptionBuilder;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\TransportOptionBuilder;

include '../vendor/autoload.php';


function rest_example()
{
    date_default_timezone_set('UTC');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $key = getenv('API_KEY') ?: '';
    $secret = getenv('API_SECRET') ?: '';
    $passphrase = getenv('API_PASSPHRASE') ?: '';

    $brokerName = getenv('BROKER_NAME');
    $brokerKey = getenv('BROKER_KEY');
    $brokerPartner = getenv('BROKER_PARTNER');

    $httpTransportOption = (new TransportOptionBuilder())
        ->setKeepAlive(true)
        ->setMaxPoolSize(10)
        ->setMaxConnectionPerPool(10)
        ->build();

    $clientOption = (new ClientOptionBuilder())
        ->setKey($key)
        ->setSecret($secret)
        ->setPassphrase($passphrase)
        ->setBrokerName($brokerName)
        ->setBrokerKey($brokerKey)
        ->setBrokerPartner($brokerPartner)
        ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)
        ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)
        ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)
        ->setTransportOption($httpTransportOption)
        ->build();

    $client = new DefaultClient($clientOption);
    $kucoinRestService = $client->restService();

    account_service_example($kucoinRestService->getAccountService());
    spot_service_example($kucoinRestService->getSpotService());
    futures_service_example($kucoinRestService->getFuturesService());
}

function account_service_example(AccountService $accountService)
{
    $accountApi = $accountService->getAccountApi();
    $accountInfoResp = $accountApi->getAccountInfo();
    error_log("account info: level: {$accountInfoResp->level}, SubAccountSize: {$accountInfoResp->subQuantity}");

    $feeApi = $accountService->getFeeApi();
    $getActualFeeReq = GetSpotActualFeeReq::builder()
        ->setSymbols("BTC-USDT,ETH-USDT")
        ->build();

    $getActualFeeResp = $feeApi->getSpotActualFee($getActualFeeReq);

    foreach ($getActualFeeResp->data as $feeData) {
        error_log("Fee info: symbol: {$feeData->symbol}, TakerFee: {$feeData->takerFeeRate}, MakerFee: {$feeData->makerFeeRate}");
    }
}

function spot_service_example(SpotService $spotService)
{
    $orderApi = $spotService->getOrderApi();

    $addOrderReq = AddOrderSyncReq::builder()
        ->setClientOid(uniqid('', true))
        ->setSide('buy')
        ->setSymbol("BTC-USDT")
        ->setType('limit')
        ->setRemark("sdk_example")
        ->setPrice("10000")
        ->setSize("0.001")
        ->build();

    $resp = $orderApi->addOrderSync($addOrderReq);
    error_log("Add order success, id: {$resp->orderId}, oid: {$resp->clientOid}");

    $queryOrderDetailReq = GetOrderByOrderIdReq::builder()
        ->setOrderId($resp->orderId)
        ->setSymbol("BTC-USDT")
        ->build();
    $orderDetailResp = $orderApi->getOrderByOrderId($queryOrderDetailReq);
    error_log("Order detail: " . $orderDetailResp->jsonSerialize(JMS\Serializer\SerializerBuilder::create()->build()));

    $cancelOrderReq = CancelOrderByOrderIdSyncReq::builder()
        ->setOrderId($resp->orderId)
        ->setSymbol("BTC-USDT")
        ->build();
    $cancelOrderResp = $orderApi->cancelOrderByOrderIdSync($cancelOrderReq);
    error_log("Cancel order success, id: {$cancelOrderResp->orderId}");
}

function futures_service_example(FuturesService $futuresService)
{
    $marketApi = $futuresService->getMarketApi();

    $allSymbolResp = $marketApi->getAllSymbols();
    $maxQuery = min(count($allSymbolResp->data), 10);

    for ($i = 0; $i < $maxQuery; $i++) {
        $symbol = $allSymbolResp->data[$i];

        $start = (int)((microtime(true) - 600) * 1000);
        $end = (int)(microtime(true) * 1000);

        $getKlineReq = GetKlinesReq::builder()
            ->setSymbol($symbol->symbol)
            ->setGranularity(1)
            ->setFrom($start)
            ->setTo($end)
            ->build();

        $getKlineResp = $marketApi->getKlines($getKlineReq);
        $rows = [];


        foreach ($getKlineResp->data as $row) {
            $timestamp = date("Y-m-d H:i:s", $row[0] / 1000);
            $formattedRow = sprintf(
                "[Time: %s, Open: %.2f, High: %.2f, Low: %.2f, Close: %.2f, Volume: %.2f]",
                $timestamp, $row[1], $row[2], $row[3], $row[4], $row[5]
            );
            $rows[] = $formattedRow;
        }

        error_log("Symbol: {$symbol->symbol}, Kline: " . implode(', ', $rows));
    }
}

if (php_sapi_name() === 'cli') {
    rest_example();
}