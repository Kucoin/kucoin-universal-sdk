import { plainToInstance } from 'class-transformer';

/**
 * RestRateLimit represents the rate limiting information for a REST API.
 */
export interface RateLimit {
    /**
     * Total resource pool quota
     */
    limit: number;
    /**
     * Resource pool remaining quota
     */
    remaining: number;
    /**
     * Resource pool quota reset countdown (milliseconds)
     */
    reset: number;
}

/**
 * RestResponse represents a generic response from the REST API.
 */
export class RestResponse {
    /**
     * Optional rate limit information
     */
    rateLimit?: RateLimit;
    /**
     * Response code
     */
    code?: string;
    /**
     * Response data (typed)
     */
    data?: any;
    /**
     * Optional response message
     */
    msg?: string;

    static fromJson(json: string): RestResponse {
        return plainToInstance(RestResponse, JSON.parse(json));
    }

    checkRestResponseError() {
        /**
         * Code for success
         */
        const CodeSuccess = '200000';
        if (this.code === CodeSuccess) {
            return;
        }
        throw new RestError(
            this,
            new Error(`Server returned error, code: {${this.code}}, message: {${this.msg || 'unknown'}}`),
        );
    }
}

export class RestError extends Error {
    constructor(
        private response: RestResponse | null,
        private err?: Error,
    ) {
        super(err?.message || 'unknown');
    }

    toString() {
        if (this.response) {
            return `request error, server code: ${this.response.code}, server msg: ${this.response.msg}, context msg: ${this.err?.message || 'unknown'}`;
        }
        return `request error, ${this.err}`;
    }

    getError() {
        return this.err;
    }

    getCommonResponse() {
        return this.response;
    }
}

/**
 * WsMessage represents a message between the WebSocket client and server.
 */
export class WsMessage {
    /**
     * A unique identifier for the message
     */
    id: string;
    /**
     * The type of the message (e.g., WelcomeMessage)
     */
    type?: string;
    /**
     * Sequence number to track the order of messages
     */
    sn?: number;
    /**
     * The topic or channel the message is associated with
     */
    topic: string;
    /**
     * The subject of the message, providing additional context
     */
    subject: string;
    /**
     * Indicates if the message belongs to a private channel
     */
    privateChannel?: boolean;
    /**
     * Specifies whether the message is a response
     */
    response?: boolean;
    /**
     * Raw JSON payload containing additional message data
     */
    data: any;

    constructor() {
        this.id = ''
        this.topic = '';
        this.subject = '';
    }

    static fromJson(json: string): WsMessage {
        return plainToInstance(WsMessage, JSON.parse(json));
    }
}
