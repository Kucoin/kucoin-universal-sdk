<?php

/**
 * DISCLAIMER:
 * This strategy is provided for educational and illustrative purposes only. It is not intended to be used as financial
 * or investment advice. Trading cryptocurrencies involves significant risk, and you should carefully consider your
 * investment objectives, level of experience, and risk appetite. Past performance of any trading strategy is not
 * indicative of future results.
 *
 * The authors and contributors of this example are not responsible for any financial losses or damages that may occur
 * from using this code. Use it at your own discretion and consult with a professional financial advisor if necessary.
 */

use KuCoin\UniversalSDK\Api\DefaultClient;
use KuCoin\UniversalSDK\Generate\Account\Account\AccountApi;
use KuCoin\UniversalSDK\Generate\Account\Account\GetSpotAccountListReq;
use KuCoin\UniversalSDK\Generate\Spot\Market\Get24hrStatsReq;
use KuCoin\UniversalSDK\Generate\Spot\Market\GetKlinesReq;
use KuCoin\UniversalSDK\Generate\Spot\Market\MarketApi;
use KuCoin\UniversalSDK\Generate\Spot\Order\AddOrderSyncReq;
use KuCoin\UniversalSDK\Generate\Spot\Order\CancelAllOrdersBySymbolReq;
use KuCoin\UniversalSDK\Generate\Spot\Order\GetOpenOrdersReq;
use KuCoin\UniversalSDK\Generate\Spot\Order\OrderApi;
use KuCoin\UniversalSDK\Generate\Spot\Order\SetDCPReq;
use KuCoin\UniversalSDK\Model\ClientOptionBuilder;
use KuCoin\UniversalSDK\Model\Constants;
use KuCoin\UniversalSDK\Model\TransportOptionBuilder;

include '../vendor/autoload.php';


class Action
{
    const BUY = 'buy';
    const SELL = 'sell';
    const SKIP = 'skip';
}

function simpleMovingAverageStrategy(MarketAPI $marketApi, string $symbol, int $shortWindow, int $longWindow, int $endTime): string
{
    $startTime = $endTime - $longWindow * 60;
    error_log("Query kline data start Time: " . date('Y-m-d H:i:s', $startTime) . ", end Time: " . date('Y-m-d H:i:s', $endTime));

    $getKlineReq = GetKlinesReq::builder()
        ->setSymbol($symbol)
        ->setType('1min')
        ->setStartAt($startTime)
        ->setEndAt($endTime)
        ->build();

    $klineResp = $marketApi->getKlines($getKlineReq);

    $prices = [];
    foreach ($klineResp->data as $kline) {
        $prices[] = floatval($kline[2]);
    }

    $shortMA = array_sum(array_slice($prices, -$shortWindow)) / $shortWindow;
    $longMA = array_sum(array_slice($prices, -$longWindow)) / $longWindow;

    error_log("Short MA: {$shortMA}, Long MA: {$longMA}");

    if ($shortMA > $longMA) {
        error_log("{$symbol}: Short MA > Long MA. Should place a BUY order.");
        return Action::BUY;
    } elseif ($shortMA < $longMA) {
        error_log("{$symbol}: Short MA < Long MA. Should place a SELL order.");
        return Action::SELL;
    } else {
        return Action::SKIP;
    }
}

function getLastTradePrice(MarketApi $marketApi, string $symbol): float
{
    $req = Get24hrStatsReq::builder()->setSymbol($symbol)->build();
    $resp = $marketApi->get24hrStats($req);
    return floatval($resp->last);
}

function checkAvailableBalance(AccountApi $accountApi, float $lastPrice, float $amount, $action): string
{
    $tradeValue = $lastPrice * $amount;
    $currency = $action === Action::BUY ? 'USDT' : 'DOGE';
    error_log("Checking balance for currency: {$currency}");

    $req = GetSpotAccountListReq::builder()
        ->setType('trade')
        ->setCurrency($currency)
        ->build();
    $resp = $accountApi->getSpotAccountList($req);

    $available = 0.0;
    foreach ($resp->data as $acc) {
        $available += floatval($acc->available);
    }

    error_log("Available {$currency} balance: {$available}");

    if ($action === Action::BUY) {
        if ($tradeValue <= $available) {
            error_log("Balance is sufficient for the trade: {$tradeValue} {$currency} required.");
            return true;
        } else {
            error_log("Insufficient balance: {$tradeValue} {$currency} required, but only {$available} available.");
            return false;
        }
    } else {
        return $amount <= $available;
    }
}

function placeOrder(OrderApi $orderApi, string $symbol, string $action, float $lastPrice, float $amount, float $delta)
{
    $openOrdersReq = GetOpenOrdersReq::builder()->setSymbol($symbol)->build();
    $openOrdersResp = $orderApi->getOpenOrders($openOrdersReq);

    if (!empty($openOrdersResp->data)) {
        $cancelReq = CancelAllOrdersBySymbolReq::builder()->setSymbol($symbol)->build();
        $cancelResp = $orderApi->cancelAllOrdersBySymbol($cancelReq);
        error_log("Canceled all open orders: " . $cancelResp->data);
    }

    $side = "buy";
    $price = $lastPrice * (1 - $delta);
    if ($action === Action::SELL) {
        $side = "sell";
        $price = $lastPrice * (1 + $delta);
    }

    error_log("Placing a " . strtoupper($side) . " order at {$price} for {$symbol}");

    $orderReq = AddOrderSyncReq::builder()
        ->setClientOid(uniqid('', true))
        ->setSide($side)
        ->setSymbol($symbol)
        ->setType('limit')
        ->setRemark('ma')
        ->setPrice(number_format($price, 2, '.', ''))
        ->setSize(number_format($amount, 8, '.', ''))
        ->build();

    $orderResp = $orderApi->addOrderSync($orderReq);
    error_log("Order placed successfully with ID: {$orderResp->orderId}");

    $dcpReq = SetDCPReq::builder()->setSymbols($symbol)->setTimeout(30)->build();
    $dcpResp = $orderApi->setDcp($dcpReq);
    error_log("DCP set: current_time={$dcpResp->currentTime}, trigger_time={$dcpResp->triggerTime}");
}


function example()
{
    date_default_timezone_set('UTC');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    // Entry point
    $key = getenv("API_KEY") ?: '';
    $secret = getenv("API_SECRET") ?: '';
    $passphrase = getenv("API_PASSPHRASE") ?: '';

    $transportOption = (new TransportOptionBuilder())
        ->setKeepAlive(true)
        ->setMaxPoolSize(10)
        ->setMaxConnectionPerPool(10)
        ->build();

    $clientOption = (new ClientOptionBuilder())
        ->setKey($key)
        ->setSecret($secret)
        ->setPassphrase($passphrase)
        ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)
        ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)
        ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)
        ->setTransportOption($transportOption)
        ->build();

    $client = new DefaultClient($clientOption);
    $rest = $client->restService();

    $marketApi = $rest->getSpotService()->getMarketApi();
    $orderApi = $rest->getSpotService()->getOrderApi();
    $accountApi = $rest->getAccountService()->getAccountApi();

    define('SYMBOL', 'DOGE-USDT');
    define('ORDER_AMOUNT', 10);
    define('PRICE_DELTA', 0.1);

    $currentTime = floor(time() / 60) * 60;

    error_log("Starting the moving average strategy using K-line data. Press Ctrl+C to stop.");
    while (true) {
        $action = simpleMovingAverageStrategy($marketApi, SYMBOL, 10, 30, $currentTime);
        if ($action !== Action::SKIP) {
            $lastPrice = getLastTradePrice($marketApi, SYMBOL);
            error_log("Last trade price for " . SYMBOL . ": {$lastPrice}");
            if (checkAvailableBalance($accountApi, $lastPrice, ORDER_AMOUNT, $action)) {
                error_log("Sufficient balance available. Attempting to place the order...");
                placeOrder($orderApi, SYMBOL, $action, $lastPrice, ORDER_AMOUNT, PRICE_DELTA);
            } else {
                error_log("Insufficient balance. Skipping the trade...");
            }
        }
        error_log("Waiting for 1 minute before the next run...");
        sleep(60);
        $currentTime += 60;
    }
}

if (php_sapi_name() === 'cli') {
    example();
}