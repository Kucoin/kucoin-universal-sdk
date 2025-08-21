import * as crypto from 'crypto';
import { logger } from '@src/common';

/**
 * KcSigner contains information about `apiKey`, `apiSecret`, `apiPassPhrase`, and `apiKeyVersion`
 * and provides methods to sign and generate headers for API requests.
 */
export class KcSigner {
    private readonly apiKey: string;
    private readonly apiSecret: string;
    private readonly apiPassphrase: string;
    private readonly brokerName: string;
    private readonly brokerPartner: string;
    private readonly brokerKey: string;

    constructor(
        apiKey: string = '',
        apiSecret: string = '',
        apiPassphrase: string = '',
        brokerName: string = '',
        brokerPartner: string = '',
        brokerKey: string = '',
    ) {
        this.apiKey = apiKey;
        this.apiSecret = apiSecret;
        this.apiPassphrase =
            apiPassphrase && apiSecret
                ? KcSigner.sign(Buffer.from(apiPassphrase), Buffer.from(apiSecret))
                : apiPassphrase;
        this.brokerName = brokerName;
        this.brokerPartner = brokerPartner;
        this.brokerKey = brokerKey;

        if (!apiKey || !apiSecret || !apiPassphrase) {
            logger.warn(
                '[AUTH WARNING] API credentials incomplete. Access is restricted to public interfaces only.',
            );
        }
    }

    /**
     * Sign the input data with the given key using HMAC-SHA256
     */
    public static signString(plain: String, key: String): string {
        return KcSigner.sign(Buffer.from(plain), Buffer.from(key));
    }

    /**
     * Sign the input data with the given key using HMAC-SHA256
     */
    public static sign(plain: Buffer, key: Buffer): string {
        const hmac = crypto.createHmac('sha256', key);
        hmac.update(plain);
        const digest = hmac.digest();
        return digest.toString('base64');
    }

    /**
     * Headers method generates and returns a map of signature headers needed for API authorization
     * It takes a plain string as an argument to help form the signature
     */
    public headers(plain: string): Record<string, string> {
        const timestamp = Date.now().toString();
        const signatureInput = timestamp + plain;
        const signature = KcSigner.sign(Buffer.from(signatureInput), Buffer.from(this.apiSecret));

        const headers = {
            'KC-API-KEY': this.apiKey,
            'KC-API-PASSPHRASE': this.apiPassphrase,
            'KC-API-TIMESTAMP': timestamp,
            'KC-API-SIGN': signature,
            'KC-API-KEY-VERSION': '3',
        };

        return headers;
    }

    /**
     * Generate broker-specific headers including partner verification
     */
    public brokerHeaders(plain: string): Record<string, string> {
        if (!this.brokerPartner || !this.brokerName) {
            logger.error('[BROKER ERROR] Missing broker information');
            throw new Error('Broker information cannot be empty');
        }

        const timestamp = Date.now().toString();
        const signatureInput = timestamp + plain;
        const signature = KcSigner.sign(Buffer.from(signatureInput), Buffer.from(this.apiSecret));

        const partnerInput = timestamp + this.brokerPartner + this.apiKey;
        const partnerSignature = KcSigner.sign(Buffer.from(partnerInput), Buffer.from(this.apiSecret));

        const headers = {
            'KC-API-KEY': this.apiKey,
            'KC-API-PASSPHRASE': this.apiPassphrase,
            'KC-API-TIMESTAMP': timestamp,
            'KC-API-SIGN': signature,
            'KC-API-KEY-VERSION': '3',
            'KC-API-PARTNER': this.brokerPartner,
            'KC-BROKER-NAME': this.brokerName,
            'KC-API-PARTNER-VERIFY': 'true',
            'KC-API-PARTNER-SIGN': partnerSignature,
        };

        return headers;
    }
}
