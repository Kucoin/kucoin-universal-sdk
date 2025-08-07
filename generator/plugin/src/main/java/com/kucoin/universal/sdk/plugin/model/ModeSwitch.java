package com.kucoin.universal.sdk.plugin.model;

import lombok.Getter;
import org.apache.commons.lang3.StringUtils;
import org.openapitools.codegen.CliOption;

import java.util.Map;

/**
 * @author isaac.tang
 */
@Getter
public class ModeSwitch {

    private static final String MODE_KEY = "GEN_MODE";

    public static final CliOption option = CliOption.newString("GEN_MODE", "generate mode, option: api,test,test_template,entry,ws,ws_test");

    public enum ModeEnum {
        API,
        TEST,
        TEST_TEMPLATE,
        ENTRY,
        WS,
        WS_TEST,
        WS_TEST_TEMPLATE,
        WS_UNIFIED
    }

    private final ModeEnum mode;

    private boolean api;

    private boolean ws;

    private boolean entry;

    private boolean test;

    private boolean testTemplate;

    private boolean wsTest;

    private boolean wsTestTemplate;

    private boolean wsUnified;

    public ModeSwitch(Map<String, Object> properties) {
        String modeStr = (String) properties.get(MODE_KEY);
        if (StringUtils.isEmpty(modeStr)) {
            throw new RuntimeException("GEN_MODE required");
        }
        mode = ModeEnum.valueOf(modeStr.toUpperCase());

        switch (mode) {
            case WS: {
                ws = true;
            }
            case API: {
                api = true;
                break;
            }
            case ENTRY: {
                entry = true;
                break;
            }
            case TEST: {
                test = true;
                break;
            }
            case WS_TEST: {
                wsTest = true;
                break;
            }
            case TEST_TEMPLATE: {
                testTemplate = true;
                break;
            }
            case WS_TEST_TEMPLATE: {
                wsTestTemplate = true;
                break;
            }
            case WS_UNIFIED: {
                wsUnified = true;
                break;
            }
            default:
                throw new RuntimeException("unsupported mode");
        }
    }

}
