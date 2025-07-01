package com.kucoin.universal.sdk.model;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.Data;
import lombok.Getter;

@Data
public class RestRateLimit {

    @JsonProperty("limit")
    private final int limit;

    @JsonProperty("remaining")
    private final int remaining;

    @JsonProperty("reset")
    private final int reset;

    @JsonCreator
    public RestRateLimit(
            @JsonProperty("limit") int limit,
            @JsonProperty("remaining") int remaining,
            @JsonProperty("reset") int reset
    ) {
        this.limit = limit;
        this.remaining = remaining;
        this.reset = reset;
    }
}
