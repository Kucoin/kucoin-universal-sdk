package com.kucoin.universal.sdk.plugin.generator;

import com.kucoin.universal.sdk.plugin.model.EnumEntry;
import com.kucoin.universal.sdk.plugin.model.Meta;
import com.kucoin.universal.sdk.plugin.model.ModeSwitch;
import com.kucoin.universal.sdk.plugin.service.NameService;
import com.kucoin.universal.sdk.plugin.service.OperationService;
import com.kucoin.universal.sdk.plugin.service.SchemaService;
import com.kucoin.universal.sdk.plugin.service.impl.OperationServiceImpl;
import com.kucoin.universal.sdk.plugin.service.impl.SchemaServiceImpl;
import com.kucoin.universal.sdk.plugin.util.KeywordsUtil;
import com.kucoin.universal.sdk.plugin.util.SpecificationUtil;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.media.Schema;
import io.swagger.v3.oas.models.media.StringSchema;
import io.swagger.v3.oas.models.servers.Server;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.StringUtils;
import org.openapitools.codegen.*;
import org.openapitools.codegen.languages.AbstractPhpCodegen;
import org.openapitools.codegen.model.ModelMap;
import org.openapitools.codegen.model.ModelsMap;
import org.openapitools.codegen.model.OperationMap;
import org.openapitools.codegen.model.OperationsMap;
import org.openapitools.codegen.utils.CamelizeOption;
import org.openapitools.codegen.utils.ModelUtils;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.io.File;
import java.util.*;

import static org.openapitools.codegen.utils.StringUtils.camelize;

/**
 * @author isaac.tang
 */
@Slf4j
public class PhpSdkGenerator extends AbstractPhpCodegen implements NameService {
    private final Logger LOGGER = LoggerFactory.getLogger(PhpSdkGenerator.class);

    private SchemaService schemaService;
    private OperationService operationService;
    private ModeSwitch modeSwitch;

    private String service;
    private String subService;

    public CodegenType getTag() {
        return CodegenType.OTHER;
    }

    public String getName() {
        return "php-sdk";
    }

    public String getHelp() {
        return "Generates a php-sdk library.";
    }

    public PhpSdkGenerator() {
        super();
        cliOptions.add(ModeSwitch.option);
        setParameterNamingConvention("camelCase");
        this.modelTemplateFiles.clear();
        this.apiTemplateFiles.clear();
        this.apiTestTemplateFiles.clear();
        this.modelDocTemplateFiles.clear();
        this.apiDocTemplateFiles.clear();
    }

    @Override
    public void processOpts() {
        super.processOpts();
        this.supportingFiles.clear();
        modeSwitch = new ModeSwitch(additionalProperties);
        service = KeywordsUtil.getKeyword(camelize(openAPI.getInfo().getTitle(), CamelizeOption.UPPERCASE_FIRST_CHAR));
        subService = camelize(openAPI.getInfo().getDescription(), CamelizeOption.UPPERCASE_FIRST_CHAR);
        apiPackage = String.format("KuCoin\\UniversalSDK\\Generate\\%s\\%s", service, subService);
        modelPackage = String.format("KuCoin\\UniversalSDK\\Generate\\%s\\%s", service, subService);

        switch (modeSwitch.getMode()) {
            case API: {
                modelTemplateFiles.put("model.mustache", ".php");
                apiTemplateFiles.put("api.mustache", ".php");
                apiTemplateFiles.put("api_impl.mustache", "Impl.php");
                break;
            }
            case TEST: {
                apiTemplateFiles.put("api_test.mustache", "Test.php");
                break;
            }
            case TEST_TEMPLATE: {
                apiTemplateFiles.put("api_test_template.mustache", ".template");
                break;
            }
            case ENTRY: {
                apiTemplateFiles.put("api_entry.mustache", ".php");
                apiTemplateFiles.put("api_entry_impl.mustache", "Impl.php");
                break;
            }
            case WS: {
                modelTemplateFiles.put("model_ws.mustache", ".php");
                apiTemplateFiles.put("api_ws.mustache", ".php");
                apiTemplateFiles.put("api_ws_impl.mustache", "Impl.php");
                additionalProperties.put("WS_MODE", "true");
                break;
            }
            case WS_UNIFIED: {
                apiTemplateFiles.put("api_ws_unified.mustache", ".php");
                apiTemplateFiles.put("api_ws_unified_impl.mustache", "Impl.php");
                break;
            }
            case WS_TEST: {
                additionalProperties.put("WS_MODE", "true");
                apiTemplateFiles.put("api_ws_test.mustache", "Test.php");
                break;
            }
            case WS_TEST_TEMPLATE: {
                additionalProperties.put("WS_MODE", "true");
                apiTemplateFiles.put("ws_test_template.mustache", ".template");
                break;
            }
            default:
                throw new RuntimeException("unsupported mode");
        }

        supportingFiles.add(new SupportingFile("version.mustache", "Version.php"));

        templateDir = "php-sdk";

        // override parent properties
        enablePostProcessFile = true;

        inlineSchemaOption.put("SKIP_SCHEMA_REUSE", "true");
    }

    @Override
    public void preprocessOpenAPI(OpenAPI openAPI) {
        super.preprocessOpenAPI(openAPI);

        // parse and update operations and models
        schemaService = new SchemaServiceImpl(openAPI);
        operationService = new OperationServiceImpl(openAPI, this);

        operationService.parseOperation();
        schemaService.parseSchema();
    }

    @Override
    public String formatParamName(String name) {
        return toParamName(name);
    }

    @Override
    public String formatMethodName(String name) {
        return camelize(sanitizeName(name), CamelizeOption.LOWERCASE_FIRST_CHAR);
    }

    @Override
    public String formatService(String name) {
        return camelize(name);
    }

    @Override
    public String formatPackage(String name) {
        return formatService(name).toLowerCase();
    }

    @Override
    public CodegenProperty fromProperty(String name, Schema p, boolean required) {
        CodegenProperty prop = super.fromProperty(name, p, required);
        if (prop.defaultValue != null && prop.defaultValue.equalsIgnoreCase("undefined")) {
            prop.defaultValue = null;
        }

        if (prop.isEnum) {
            List<EnumEntry> enums = new ArrayList<>();

            List<Map<String, Object>> enumList;
            if (prop.openApiType.equalsIgnoreCase("array")) {
                enumList = (List<Map<String, Object>>) prop.mostInnerItems.vendorExtensions.get("x-api-enum");
            } else {
                enumList = (List<Map<String, Object>>) prop.vendorExtensions.get("x-api-enum");
            }


            List<String> names = new ArrayList<>();
            List<String> values = new ArrayList<>();
            List<String> description = new ArrayList<>();

            enumList.forEach(e -> {
                Object enumValueOriginal = e.get("value");

                String enumValueNameGauss;
                if (enumValueOriginal instanceof Integer) {
                    enumValueNameGauss = "_" + e.get("value");
                } else if (enumValueOriginal instanceof String) {
                    enumValueNameGauss = enumValueOriginal.toString();
                } else {
                    throw new IllegalArgumentException("unknown enum value type..." + e.get("value"));
                }

                String enumName = (String) e.get("name");
                if (StringUtils.isEmpty(enumName)) {
                    enumName = enumValueNameGauss;
                }

                enumName = toVarName(enumName).toUpperCase();
                String enumValue = toEnumValue(enumValueOriginal.toString().trim(), typeMapping.get(p.getType()));

                names.add(enumName);
                values.add(enumValueOriginal.toString().trim());
                description.add(e.get("description").toString());

                enums.add(new EnumEntry(enumName, enumValue, enumValueOriginal, (String) e.get("description"), enumValueOriginal instanceof String));
            });

            // update internal enum support
            prop._enum = values;
            prop.allowableValues.put("values", values);
            prop.vendorExtensions.put("x-enum-varnames", names);
            prop.vendorExtensions.put("x-enum-descriptions", description);
            prop.vendorExtensions.put("x-enums", enums);
        }

        String annoType = getTypeAnnotationString(prop);
        prop.vendorExtensions.put("annotationType", annoType);

        return prop;
    }

    @Override
    public String toEnumDefaultValue(String value, String datatype) {
        return value;
    }

    @Override
    public String toEnumDefaultValue(CodegenProperty property, String value) {
        return property.defaultValue;
    }

    private String getTypeAnnotationString(CodegenProperty prop) {
        if (prop == null) {
            return "mixed";
        }

        if (prop.isArray) {
            if (prop.items != null && !"mixed".equalsIgnoreCase(prop.items.dataType)) {
                return String.format("array<%s>", getTypeAnnotationString(prop.items));
            } else {
                return "array";
            }
        }

        if (prop.isMap) {
            if (prop.items != null) {
                return String.format("array<string, %s>", getTypeAnnotationString(prop.items));
            } else {
                return "array<string, mixed>";
            }
        }

        if (prop.isPrimitiveType) {
            return normalizePrimitiveType(prop.dataType);
        }

        if (prop.isModel) {
            return String.format("%s\\%s", modelPackage, prop.complexType);
        }

        return "mixed";
    }

    private String normalizePrimitiveType(String dataType) {
        switch (dataType) {
            case "integer":
            case "int":
                return "int";
            case "number":
            case "double":
            case "float":
                return "float";
            case "boolean":
            case "bool":
                return "bool";
            case "string":
            case "DateTime":
            case "date":
                return "string";
            default:
                return dataType != null ? dataType : "mixed";
        }
    }


    @Override
    public String getTypeDeclaration(Schema p) {
        if (ModelUtils.isArraySchema(p)) {
            Schema inner = ModelUtils.getSchemaItems(p);
            if (inner == null) {
                this.LOGGER.warn("{}(array property) does not have a proper inner type defined.Default to string", p.getName());
                inner = (new StringSchema()).description("TODO default missing array inner type to string");
            }

            return this.getTypeDeclaration(inner) + "[]";
        } else if (ModelUtils.isMapSchema(p)) {
            Schema inner = ModelUtils.getAdditionalProperties(p);
            if (inner == null) {
                this.LOGGER.warn("{}(map property) does not have a proper inner type defined. Default to string", p.getName());
                inner = (new StringSchema()).description("TODO default missing map inner type to string");
            }

            return this.getSchemaType(p) + "<string," + this.getTypeDeclaration(inner) + ">";
        } else if (StringUtils.isNotBlank(p.get$ref())) {
            String oasType = this.getSchemaType(p);
            return this.typeMapping.containsKey(oasType) ? (String) this.typeMapping.get(oasType) : oasType;
        } else {
            return super.getTypeDeclaration(p);
        }
    }

    @Override
    public String toModelName(String name) {
        return formatService(schemaService.getGeneratedModelName(name));
    }

    @Override
    public String toApiName(String name) {
        return camelize(name + "_" + (modeSwitch.isWs() || modeSwitch.isWsTest() || modeSwitch.isWsUnified() ? "Ws" : "Api"));
    }

    @Override
    public String toModelFilename(String name) {
        name = schemaService.getGeneratedModelName(name);
        name = formatService(name);
        return name;
    }

    @Override
    public String modelFileFolder() {
        switch (modeSwitch.getMode()) {
            case ENTRY:
                return outputFolder + File.separator + "Service";
            default:
                return outputFolder + File.separator + service + File.separator + subService;
        }
    }

    @Override
    public String toApiFilename(String name) {
        String apiName = name.replaceAll("-", "_");
        switch (modeSwitch.getMode()) {
            case API:
            case ENTRY:
            case TEST_TEMPLATE:
            case TEST: {
                apiName = apiName + "Api";
                break;
            }
            case WS:
            case WS_TEST:
            case WS_TEST_TEMPLATE:
            case WS_UNIFIED:{
                apiName = apiName + "Ws";
                break;
            }
        }

        return apiName;
    }

    @Override
    public String modelFilename(String templateName, String name) {
        String suffix = modelTemplateFiles().get(templateName);
        return modelFileFolder() + File.separator + toModelFilename(name) + suffix;
    }

    @Override
    public String apiFilename(String templateName, String tag) {
        String suffix = apiTemplateFiles().get(templateName);
        if (modeSwitch.isEntry()) {
            String entryType = service + "Service";
            return modelFileFolder() + File.separator + entryType + suffix;
        }
        return modelFileFolder() + File.separator + toApiFilename(tag) + suffix;
    }

    @Override
    public CodegenOperation fromOperation(String path, String httpMethod, Operation operation, List<Server> servers) {
        CodegenOperation result = super.fromOperation(path, httpMethod, operation, servers);
        if (httpMethod.equalsIgnoreCase("patch")) {
            result.httpMethod = (String) operation.getExtensions().get("x-original-method");
        }
        return result;
    }


    @Override
    public ModelsMap postProcessModels(ModelsMap objs) {
        objs = super.postProcessModels(objs);

        Set<String> imports = new TreeSet<>();

        List<ModelMap> models = objs.getModels();
        imports.add("use JMS\\Serializer\\Annotation\\SerializedName;");
        imports.add("use JMS\\Serializer\\Annotation\\Exclude;");
        imports.add("use JMS\\Serializer\\Annotation\\Type;");
        imports.add("use JMS\\Serializer\\Serializer;");

        if (models != null) {
            for (ModelMap model : models) {
                CodegenModel codegenModel = model.getModel();
                codegenModel.getVendorExtensions().put("x-imports", imports);
            }
        }
        return objs;
    }

    @Override
    public OperationsMap postProcessOperationsWithModels(OperationsMap objs, List<ModelMap> allModels) {
        objs = super.postProcessOperationsWithModels(objs, allModels);

        OperationMap operationMap = objs.getOperations();


        Set<String> imports = new TreeSet<>();
        Set<String> implImports = new TreeSet<>();

        for (CodegenOperation op : operationMap.getOperation()) {
            Meta meta = SpecificationUtil.getMeta(op.vendorExtensions);
            if (meta != null) {
                switch (modeSwitch.getMode()) {
                    case ENTRY: {
                        // api entry
                        List<Map<String, String>> entryValue = new ArrayList<>();
                        operationService.getServiceMeta().forEach((k, v) -> {
                            if (v.getService().equalsIgnoreCase(meta.getService())) {
                                Map<String, String> kv = new HashMap<>();
                                kv.put("method", formatMethodName(k));
                                kv.put("methodUppercase", camelize(formatMethodName(k)));
                                kv.put("target_service", formatService(k + "Api"));
                                entryValue.add(kv);
                                String servicePath = camelize(v.getSubService().toLowerCase(), CamelizeOption.UPPERCASE_FIRST_CHAR);
                                imports.add(String.format("use KuCoin\\UniversalSDK\\Generate\\%s\\%s\\%s;", v.getService(), servicePath, formatService(k + "Api")));
                                implImports.add(String.format("use KuCoin\\UniversalSDK\\Generate\\%s\\%s\\%sImpl;", v.getService(), servicePath, formatService(k + "Api")));
                            }
                        });
                        Map<String, Object> apiEntryInfo = new HashMap<>();
                        apiEntryInfo.put("api_entry_name", formatService(meta.getService() + "Service"));
                        apiEntryInfo.put("api_entry_value", entryValue);
                        objs.put("api_entry", apiEntryInfo);
                        break;
                    }

                    case API:
                    case TEST: {
                        break;
                    }
                    case WS:
                    case WS_TEST: {

                        break;
                    }
                    case TEST_TEMPLATE: {
                        String reqName = String.format("%s.%s", modelPackage, meta.getMethodServiceFmt() + "Req");
                        String responseName = String.format("%s.%s", modelPackage, meta.getMethodServiceFmt() + "Resp");
                        allModels.stream().filter(m -> reqName.equalsIgnoreCase((String) m.get("importPath"))).
                                forEach(m -> op.vendorExtensions.put("x-request-model", m.getModel()));
                        allModels.stream().filter(m -> responseName.equalsIgnoreCase((String) m.get("importPath"))).
                                forEach(m -> {

                                    CodegenModel model = m.getModel();
                                    for (CodegenProperty var : model.vars) {
                                        if (var.isArray) {
                                            String innerDataName = String.format("%s.%s", modelPackage, var.getComplexType());
                                            CodegenModel innerClass = null;
                                            for (ModelMap map : allModels) {
                                                if (innerDataName.equalsIgnoreCase((String) map.get("importPath"))) {
                                                    innerClass = map.getModel();
                                                    break;
                                                }
                                            }

                                            if (innerClass != null) {
                                                var.vendorExtensions.put("x-response-inner-model", innerClass);
                                            }
                                        }
                                    }

                                    op.vendorExtensions.put("x-response-model", m.getModel());
                                });
                        break;
                    }
                    case WS_TEST_TEMPLATE: {
                        String eventName = String.format("%s.%s", modelPackage, meta.getMethodServiceFmt() + "Event");
                        allModels.stream().filter(m -> eventName.equalsIgnoreCase((String) m.get("importPath"))).
                                forEach(m -> {
                                    CodegenModel model = m.getModel();
                                    for (CodegenProperty var : model.vars) {
                                        if (var.isArray) {
                                            String innerDataName = String.format("%s.%s", modelPackage, var.getComplexType());
                                            CodegenModel innerClass = null;
                                            for (ModelMap map : allModels) {
                                                if (innerDataName.equalsIgnoreCase((String) map.get("importPath"))) {
                                                    innerClass = map.getModel();
                                                    break;
                                                }
                                            }

                                            if (innerClass != null) {
                                                var.vendorExtensions.put("x-response-inner-model", innerClass);
                                            }
                                        }
                                    }
                                    op.vendorExtensions.put("x-response-model", m.getModel());
                                });
                        break;
                    }
                }
            }
        }
        objs.put("imports", imports);
        objs.put("implImports", implImports);
        return objs;
    }
}
