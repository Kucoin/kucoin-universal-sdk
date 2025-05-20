package com.kucoin.universal.sdk.plugin;

import org.junit.jupiter.api.Test;
import org.openapitools.codegen.ClientOptInput;
import org.openapitools.codegen.DefaultGenerator;
import org.openapitools.codegen.config.CodegenConfigurator;

public class SdkGeneratorTest {

    private static final String SDK_NAME = "php-sdk";
    private static final String SPEC_NAME = "../../spec/rest/api/openapi-account-fee.json";
    private static final String SPEC_ENTRY_NAME = "../../spec/rest/entry/openapi-spot.json";
    private static final String WS_SPEC_NAME = "../../spec/ws/openapi-margin-private.json";
    private static final String OUTPUT_DIR = "./out";
    private static final String CSV_PATH = "../../spec";

    @Test
    public void launchCodeGenerator() {
        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "API")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }
        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(SPEC_ENTRY_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "ENTRY")
                    .addAdditionalProperty("CSV_PATH", CSV_PATH)
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }

        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "TEST")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }
    }

    @Test
    public void launchCodeGeneratorWs() {
        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(WS_SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "WS")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }

        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(WS_SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "WS_TEST")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }
    }

    @Test
    public void launchCodeGeneratorTemplate() {
        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "test_template")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }

        {
            final CodegenConfigurator configurator = new CodegenConfigurator()
                    .setGeneratorName(SDK_NAME)
                    .setInputSpec(WS_SPEC_NAME)
                    .setValidateSpec(false)
                    .addAdditionalProperty("GEN_MODE", "WS_TEST_TEMPLATE")
                    .setOutputDir(OUTPUT_DIR);

            final ClientOptInput clientOptInput = configurator.toClientOptInput();
            DefaultGenerator generator = new DefaultGenerator();
            generator.opts(clientOptInput).generate();
        }
    }
}