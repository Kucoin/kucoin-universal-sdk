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
import com.kucoin.universal.sdk.plugin.util.PhpAutoCasesGenerator;
import com.kucoin.universal.sdk.plugin.util.SpecificationUtil;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
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
        // 对齐 Java 的 typeMapping
        typeMapping.put("number", "float");
        typeMapping.put("integer", "int");
        typeMapping.put("any", "mixed");
        typeMapping.put("object", "mixed");
        typeMapping.put("array", "array");
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

        // ==================== AUTO_CASES 模式 ====================
        if (modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            try {
                // 先初始化 schemaService 避免 NPE
                schemaService = new SchemaServiceImpl(openAPI);
                String outputPath = outputFolder + File.separator + "AutoCases.php";
                PhpAutoCasesGenerator.generate(openAPI, outputPath);
                LOGGER.info("AutoCases.php generated successfully at: {}", outputPath);
            } catch (Exception e) {
                LOGGER.error("Failed to generate AutoCases.php", e);
                throw new RuntimeException("Failed to generate AutoCases.php", e);
            }
            return;
        }
        // =============================================================

        // 注意：这里不再直接初始化 schemaService，而是交给 preprocessOpenAPI
        // 因为 preprocessOpenAPI 会在模型生成前被框架调用

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

    /**
     * 重写 preprocessOpenAPI，与 Java 版本保持一致
     * 在模型生成之前执行，初始化 schemaService 和 operationService
     */
    @Override
    public void preprocessOpenAPI(OpenAPI openAPI) {
        super.preprocessOpenAPI(openAPI);

        filterPaths(openAPI);
        schemaService = new SchemaServiceImpl(openAPI);
        operationService = new OperationServiceImpl(openAPI, this);

        operationService.parseOperation();
        schemaService.parseSchema();
    }

    /**
     * 对齐 Java 的 filterPaths 逻辑
     * 过滤 paths，只保留同时包含 MAIN 和 ALL 标签的接口
     */
    private void filterPaths(OpenAPI openAPI) {
        Paths paths = openAPI.getPaths();
        if (paths == null) {
            return;
        }

        Map<String, PathItem> filteredPaths = new LinkedHashMap<>();

        for (Map.Entry<String, PathItem> pathEntry : paths.entrySet()) {
            String path = pathEntry.getKey();
            PathItem pathItem = pathEntry.getValue();

            Map<PathItem.HttpMethod, Operation> operations = pathItem.readOperationsMap();
            boolean hasValidOperation = false;

            for (Map.Entry<PathItem.HttpMethod, Operation> opEntry : operations.entrySet()) {
                if (hasMainAndAllTags(opEntry.getValue())) {
                    hasValidOperation = true;
                    break;
                }
            }

            if (hasValidOperation) {
                filteredPaths.put(path, pathItem);
            }
        }

        Paths newPaths = new Paths();
        newPaths.putAll(filteredPaths);
        openAPI.setPaths(newPaths);
    }

    /**
     * 检查 Operation 是否同时包含 MAIN 和 ALL 标签
     */
    private boolean hasMainAndAllTags(Operation operation) {
        List<String> tags = operation.getTags();
        if (tags == null || tags.isEmpty()) {
            return false;
        }
        return tags.contains("MAIN") && tags.contains("ALL");
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
        return cleanUsing(camelize(name));
    }

    @Override
    public String formatPackage(String name) {
        return formatService(name).toLowerCase();
    }

    @Override
    public CodegenProperty fromProperty(String name, Schema p, boolean required) {
        // 对齐 Java 的处理：处理 anytype
        if (p.getType() != null) {
            if (p.getType().equalsIgnoreCase("anytype") || p.getType().equalsIgnoreCase("any")) {
                p.setType("object");
            }
        }

        CodegenProperty prop = super.fromProperty(name, p, required);
        if (prop.defaultValue != null && prop.defaultValue.equalsIgnoreCase("undefined")) {
            prop.defaultValue = null;
        }

        // 对齐 Java 的 Long 类型处理
        if ("integer".equalsIgnoreCase(prop.openApiType)) {
            prop.dataType = "int";
            prop.datatypeWithEnum = "int";
            prop.baseType = "int";
        }

        if (prop.isEnum) {
            List<EnumEntry> enums = new ArrayList<>();

            List<Map<String, Object>> enumList;
            CodegenProperty realEnumProp = null;
            Schema enumSchema = p;
            if (prop.openApiType.equalsIgnoreCase("array")) {
                if (prop.mostInnerItems != null && prop.mostInnerItems.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.mostInnerItems.vendorExtensions.get("x-api-enum");
                } else {
                    enumList = null;
                }
                realEnumProp = prop.mostInnerItems;
                enumSchema = getMostInnerItemsSchema(p);
            } else {
                if (prop.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.vendorExtensions.get("x-api-enum");
                } else {
                    enumList = null;
                }
                realEnumProp = prop;
            }

            // 如果 enumList 为 null，从标准 OpenAPI enum 构建
            if (enumList == null) {
                enumList = buildEnumListFromStandardOpenApiEnum(enumSchema, realEnumProp);
            }

            // 如果 enumList 仍然为 null，创建一个空的列表避免 NPE
            if (enumList == null) {
                enumList = new ArrayList<>();
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

    /**
     * 获取最内层的 Schema
     */
    private Schema getMostInnerItemsSchema(Schema schema) {
        Schema current = schema;
        while (current != null && current.getItems() != null) {
            current = current.getItems();
        }
        return current;
    }

    /**
     * 从标准 OpenAPI enum 构建 enumList
     */
    private List<Map<String, Object>> buildEnumListFromStandardOpenApiEnum(Schema enumSchema, CodegenProperty realEnumProp) {
        List<?> values = enumSchema == null ? null : enumSchema.getEnum();
        if (values == null || values.isEmpty()) {
            values = realEnumProp._enum;
        }
        if (values == null || values.isEmpty()) {
            return new ArrayList<>();
        }

        List<Map<String, Object>> enumList = new ArrayList<>();
        for (Object value : values) {
            Map<String, Object> entry = new HashMap<>();
            entry.put("value", value);
            entry.put("name", value == null ? "" : value.toString());
            entry.put("description", "");
            enumList.add(entry);
        }
        return enumList;
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
        // AUTO_CASES 模式直接返回原名称，不依赖 schemaService
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return name;
        }
        return formatService(schemaService.getGeneratedModelName(name));
    }

    @Override
    public String toApiName(String name) {
        return camelize(name + "_" + (modeSwitch.isWs() || modeSwitch.isWsTest() ? "Ws" : "Api"));
    }

    @Override
    public String toModelFilename(String name) {
        // AUTO_CASES 模式直接返回原名称，不依赖 schemaService
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return name;
        }
        name = schemaService.getGeneratedModelName(name);
        name = formatService(name);
        return name;
    }

    @Override
    public String modelFileFolder() {
        // AUTO_CASES 模式返回默认值
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return outputFolder;
        }
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
            case WS_TEST_TEMPLATE: {
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
        // AUTO_CASES 模式直接返回
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return outputFolder + File.separator + "AutoCases.php";
        }
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
        // AUTO_CASES 模式跳过
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return objs;
        }
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
                // 检查是否有 data 字段
                boolean hasDataField = false;
                for (CodegenProperty var : codegenModel.getVars()) {
                    if ("data".equals(var.name) || "Data".equals(var.name)) {
                        hasDataField = true;
                        break;
                    }
                }

                // 如果是响应模型且有 data 字段，标记为包装响应
                if (codegenModel.getVendorExtensions().containsKey("x-response-model") && hasDataField) {
                    codegenModel.getVendorExtensions().put("x-has-data-wrapper", true);
                }

                codegenModel.getVendorExtensions().put("x-imports", imports);
            }
        }
        return objs;
    }

    @Override
    public OperationsMap postProcessOperationsWithModels(OperationsMap objs, List<ModelMap> allModels) {
        // AUTO_CASES 模式跳过
        if (modeSwitch != null && modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            return objs;
        }
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

                        // 找到请求模型
                        allModels.stream().filter(m -> reqName.equalsIgnoreCase((String) m.get("importPath"))).
                                forEach(m -> op.vendorExtensions.put("x-request-model", m.getModel()));

                        // 查找响应模型
                        Optional<ModelMap> responseModelOpt = allModels.stream()
                                .filter(m -> responseName.equalsIgnoreCase((String) m.get("importPath")))
                                .findFirst();

                        if (responseModelOpt.isPresent()) {
                            CodegenModel model = responseModelOpt.get().getModel();

                            // 尝试找到 data 字段
                            CodegenProperty dataField = null;
                            for (CodegenProperty var : model.vars) {
                                if ("data".equals(var.name) || "Data".equals(var.name)) {
                                    dataField = var;
                                    break;
                                }
                            }

                            if (dataField != null) {
                                // 有 data 字段，处理 data 的内部类型
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
                                op.vendorExtensions.put("x-response-model", dataField);
                            } else {
                                // 没有 data 字段，直接使用整个响应模型
                                op.vendorExtensions.put("x-response-model", model);
                                // 标记没有 data 包装
                                op.vendorExtensions.put("x-no-data-wrapper", true);
                            }
                        }
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

    private String cleanUsing(String name) {
        if (name == null) {
            return null;
        }
        return name.replaceAll("(?i)Using(?:GET|POST|PUT|DELETE|PATCH)\\d+", "")
                .replaceAll("_+", "_")
                .replaceAll("^_|_$", "");
    }

}
