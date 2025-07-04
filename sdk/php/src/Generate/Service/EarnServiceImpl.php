<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Service;

use KuCoin\UniversalSDK\Generate\Earn\Earn\EarnApi;
use KuCoin\UniversalSDK\Generate\Earn\Earn\EarnApiImpl;

class EarnServiceImpl implements EarnService
{
    private $transport;
    private $earn;

    public function __construct($transport)
    {
        $this->transport = $transport;
        $this->earn = new EarnApiImpl($transport);
    }

    public function getEarnApi(): EarnApi
    {
        return $this->earn;
    }
}
