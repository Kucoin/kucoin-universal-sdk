<?php

namespace KuCoin\UniversalSDK\Model;

/**
 * Contains API endpoints and enum-like constants for domain types, result codes, and WS message types.
 */
class Constants
{
    // ==== Global API Endpoints ====
    const GLOBAL_API_ENDPOINT = 'https://api.kucoin.com';
    const GLOBAL_FUTURES_API_ENDPOINT = 'https://api-futures.kucoin.com';
    const GLOBAL_BROKER_API_ENDPOINT = 'https://api-broker.kucoin.com';
    const GLOBAL_UNIFIED_WS_API_ENDPOINT = 'wss://wsapi.kucoin.com';

    // ==== Domain Types ====
    const DOMAIN_TYPE_SPOT = 'spot';
    const DOMAIN_TYPE_FUTURES = 'futures';
    const DOMAIN_TYPE_BROKER = 'broker';

    // ==== REST Result Codes ====
    const RESULT_CODE_SUCCESS = '200000';

    // ==== WebSocket Message Types ====
    const WS_MESSAGE_TYPE_WELCOME = 'welcome';
    const WS_MESSAGE_TYPE_PING = 'ping';
    const WS_MESSAGE_TYPE_PONG = 'pong';
    const WS_MESSAGE_TYPE_SUBSCRIBE = 'subscribe';
    const WS_MESSAGE_TYPE_ACK = 'ack';
    const WS_MESSAGE_TYPE_UNSUBSCRIBE = 'unsubscribe';
    const WS_MESSAGE_TYPE_ERROR = 'error';
    const WS_MESSAGE_TYPE_MESSAGE = 'message';
    const WS_MESSAGE_TYPE_NOTICE = 'notice';
    const WS_MESSAGE_TYPE_COMMAND = 'command';
}