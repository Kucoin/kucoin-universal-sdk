<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Order;

use KuCoin\UniversalSDK\Generate\Uta\Common\MappedUtaApi;

class OrderApiImpl extends MappedUtaApi implements OrderApi
{
    protected const ENDPOINTS = [
        'batchCancelOrdersBySymbol' => ['POST', '/api/ua/v2/unified/order/cancel-all'],
        'batchCancelOrdersById' => ['POST', '/api/ua/v2/unified/order/cancel-batch'],
        'cancelOrder' => ['POST', '/api/ua/v2/unified/order/cancel'],
        'getOrderDetails' => ['GET', '/api/ua/v2/unified/order/detail'],
        'getTradeHistory' => ['GET', '/api/ua/v2/unified/order/execution'],
        'getOrderHistory' => ['GET', '/api/ua/v2/unified/order/history'],
        'getOpenOrderList' => ['GET', '/api/ua/v2/unified/order/open-list'],
        'placeOrder' => ['POST', '/api/ua/v2/unified/order/place'],
        'amendOrder' => ['POST', '/api/ua/v2/unified/order/amend'],
    ];
}
