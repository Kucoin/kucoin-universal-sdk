<?php

namespace KuCoin\UniversalSDK\Generate\Uta\Order;

use KuCoin\UniversalSDK\Generate\Uta\Common\UtaResponse;

/**
 * @method UtaResponse batchCancelOrdersBySymbol($request)
 * @method UtaResponse batchCancelOrdersById($request)
 * @method UtaResponse cancelOrder($request)
 * @method UtaResponse getOrderDetails($request = null)
 * @method UtaResponse getTradeHistory($request = null)
 * @method UtaResponse getOrderHistory($request = null)
 * @method UtaResponse getOpenOrderList($request = null)
 * @method UtaResponse placeOrder($request)
 * @method UtaResponse amendOrder($request)
 */
interface OrderApi
{
    public function call(string $operation, $request = null): UtaResponse;
    public function operations(): array;
}
