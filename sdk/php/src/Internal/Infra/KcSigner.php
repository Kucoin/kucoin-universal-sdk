<?php

namespace KuCoin\UniversalSDK\Internal\Infra;

use Exception;

/**
 * KcSigner handles KuCoin request signing for both user and broker modes.
 */
class KcSigner
{
    /** @var string */
    private $apiKey;

    /** @var string */
    private $apiSecret;

    /** @var string */
    private $apiPassphrase;

    /** @var string */
    private $brokerName;

    /** @var string */
    private $brokerPartner;

    /** @var string */
    private $brokerKey;

    public function __construct(
        $apiKey = '',
        $apiSecret = '',
        $apiPassphrase = '',
        $brokerName = '',
        $brokerPartner = '',
        $brokerKey = ''
    )
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiPassphrase = ($apiPassphrase && $apiSecret)
            ? $this->sign($apiPassphrase, $apiSecret)
            : $apiPassphrase;

        $this->brokerName = $brokerName;
        $this->brokerPartner = $brokerPartner;
        $this->brokerKey = $brokerKey;

        if (empty($apiKey) || empty($apiSecret) || empty($apiPassphrase)) {
            error_log('[AUTH WARNING] API credentials incomplete. Access is restricted to public interfaces only.');
        }
    }

    /**
     * Generate HMAC-SHA256 signature and return base64-encoded string
     *
     * @param string $plain
     * @param string $key
     * @return string
     */
    public function sign($plain, $key)
    {
        return base64_encode(hash_hmac('sha256', $plain, $key, true));
    }

    /**
     * Return headers for general signed API requests
     *
     * @param string $plain
     * @return array
     */
    public function headers($plain)
    {
        $timestamp = (string)(int)(microtime(true) * 1000);
        $signatureInput = $timestamp . $plain;
        $signature = $this->sign($signatureInput, $this->apiSecret);

        return [
            'KC-API-KEY' => $this->apiKey,
            'KC-API-PASSPHRASE' => $this->apiPassphrase,
            'KC-API-TIMESTAMP' => $timestamp,
            'KC-API-SIGN' => $signature,
            'KC-API-KEY-VERSION' => '3',
        ];
    }

    /**
     * Return broker-specific headers including partner signature
     *
     * @param string $plain
     * @return array
     * @throws Exception
     */
    public function brokerHeaders($plain)
    {
        if (empty($this->brokerPartner) || empty($this->brokerName)) {
            error_log('[BROKER ERROR] Missing broker information');
            throw new \RuntimeException('Broker information cannot be empty');
        }

        $timestamp = (string)(int)(microtime(true) * 1000);
        $signatureInput = $timestamp . $plain;
        $signature = $this->sign($signatureInput, $this->apiSecret);

        $partnerInput = $timestamp . $this->brokerPartner . $this->apiKey;
        $partnerSignature = $this->sign($partnerInput, $this->brokerKey);

        return [
            'KC-API-KEY' => $this->apiKey,
            'KC-API-PASSPHRASE' => $this->apiPassphrase,
            'KC-API-TIMESTAMP' => $timestamp,
            'KC-API-SIGN' => $signature,
            'KC-API-KEY-VERSION' => '3',
            'KC-API-PARTNER' => $this->brokerPartner,
            'KC-BROKER-NAME' => $this->brokerName,
            'KC-API-PARTNER-VERIFY' => 'true',
            'KC-API-PARTNER-SIGN' => $partnerSignature,
        ];
    }
}
