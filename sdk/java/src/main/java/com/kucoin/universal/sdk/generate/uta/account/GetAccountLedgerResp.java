package com.kucoin.universal.sdk.generate.uta.account;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.model.RestResponse;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@JsonIgnoreProperties(ignoreUnknown = true)
public class GetAccountLedgerResp
        implements Response<GetAccountLedgerResp, RestResponse<GetAccountLedgerResp>> {

    private Object value;

    @JsonIgnore
    private RestResponse<GetAccountLedgerResp> commonResponse;

    @JsonCreator(mode = JsonCreator.Mode.DELEGATING)
    public GetAccountLedgerResp(Object value) {
        this.value = value;
    }

    @Override
    public void setCommonResponse(RestResponse<GetAccountLedgerResp> response) {
        this.commonResponse = response;
    }
}
