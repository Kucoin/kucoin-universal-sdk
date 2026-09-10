import { Response, Serializable, StaticDeserializable } from '@internal/interfaces/serializable';
import { Transport } from '@internal/interfaces/transport';
import { RestResponse } from '@model/common';

/** JSON-compatible UTA request and response values. */
export type UtaPrimitive = string | number | boolean | null;
export type UtaValue = UtaPrimitive | UtaValue[] | { [key: string]: UtaValue | undefined };
export type UtaRequestData = { [key: string]: UtaValue | undefined };
export type UtaRecord = { [key: string]: UtaValue | undefined };

/**
 * Serializes a plain UTA request object for DefaultTransport.
 *
 * Undefined and null parameters are intentionally omitted. This prevents optional values from
 * becoming `key=undefined` or `key=null` in signed GET/DELETE query strings.
 */
export class UtaRequest implements Serializable {
    [key: string]: unknown;

    constructor(data?: UtaRequestData) {
        if (!data) {
            return;
        }
        for (const [key, value] of Object.entries(data)) {
            if (value !== undefined && value !== null) {
                this[key] = value;
            }
        }
    }

    toJson(): string {
        return JSON.stringify({ ...this });
    }
}

/**
 * Generic UTA REST result wrapper.
 *
 * UTA responses are intentionally not forced through class-transformer. The API can return a
 * list for one account mode and an object for another, and can represent numeric fields as either
 * JSON numbers or strings. Keeping the raw `data` shape prevents the array/object and
 * number/string deserialization failures seen in rigid generated models.
 */
export class UtaRestResponse<T = unknown> implements Response<RestResponse> {
    data: T;
    commonResponse?: RestResponse;

    private constructor(data: T) {
        this.data = data;
    }

    setCommonResponse(response: RestResponse): void {
        this.commonResponse = response;
    }

    toJson(): string {
        return JSON.stringify(this.data);
    }

    static fromJson<T = unknown>(input: string): UtaRestResponse<T> {
        return UtaRestResponse.fromObject<T>(JSON.parse(input));
    }

    static fromObject<T = unknown>(data: object): UtaRestResponse<T> {
        return new UtaRestResponse(data as T);
    }
}

/** Shared direct REST caller for all UTA API groups. */
export abstract class UtaApiBase {
    protected constructor(protected readonly transport: Transport) {}

    protected call<T = any>(
        method: 'GET' | 'POST' | 'DELETE',
        path: string,
        request?: UtaRequestData,
    ): Promise<UtaRestResponse<T>> {
        const payload = request ? new UtaRequest(request) : null;
        return this.transport.call(
            'spot',
            false,
            method,
            path,
            payload,
            UtaRestResponse as unknown as StaticDeserializable<UtaRestResponse<T>>,
            false,
        ) as Promise<UtaRestResponse<T>>;
    }
}
