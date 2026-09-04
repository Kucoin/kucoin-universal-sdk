package com.kucoin.universal.sdk.plugin.generator;

import com.kucoin.universal.sdk.plugin.model.EnumEntry;
import com.kucoin.universal.sdk.plugin.model.Meta;
import com.kucoin.universal.sdk.plugin.model.ModeSwitch;
import com.kucoin.universal.sdk.plugin.model.TopicMeta;
import com.kucoin.universal.sdk.plugin.service.NameService;
import com.kucoin.universal.sdk.plugin.service.OperationService;
import com.kucoin.universal.sdk.plugin.service.SchemaService;
import com.kucoin.universal.sdk.plugin.service.impl.OperationServiceImpl;
import com.kucoin.universal.sdk.plugin.service.impl.SchemaServiceImpl;
import com.kucoin.universal.sdk.plugin.util.GoAutoCasesGenerator;
import com.kucoin.universal.sdk.plugin.util.KeywordsUtil;
import com.kucoin.universal.sdk.plugin.util.SpecificationUtil;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
import io.swagger.v3.oas.models.media.Schema;
import io.swagger.v3.oas.models.servers.Server;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.StringUtils;
import org.openapitools.codegen.*;
import org.openapitools.codegen.languages.AbstractGoCodegen;
import org.openapitools.codegen.model.ModelMap;
import org.openapitools.codegen.model.ModelsMap;
import org.openapitools.codegen.model.OperationMap;
import org.openapitools.codegen.model.OperationsMap;
import org.openapitools.codegen.utils.CamelizeOption;
import org.openapitools.codegen.utils.ModelUtils;

import java.io.File;
import java.util.*;

import static org.openapitools.codegen.utils.CamelizeOption.LOWERCASE_FIRST_LETTER;
import static org.openapitools.codegen.utils.StringUtils.camelize;

@Slf4j
public class GolangSdkGenerator extends AbstractGoCodegen implements NameService {

    private SchemaService schemaService;
    private OperationService operationService;
    private ModeSwitch modeSwitch;

    private String service;
    private String subService;

    public CodegenType getTag() {
        return CodegenType.OTHER;
    }

    public String getName() {
        return "golang-sdk";
    }

    public String getHelp() {
        return "Generates a golang-sdk library.";
    }

    public GolangSdkGenerator() {
        super();
        cliOptions.add(ModeSwitch.option);
        // 对齐 Java 的 typeMapping
        typeMapping.put("number", "float64");
        typeMapping.put("integer", "int64");
        typeMapping.put("any", "interface{}");
        typeMapping.put("object", "interface{}");
        typeMapping.put("array", "[]interface{}");
        typeMapping.put("bigint", "int64");
    }

    @Override
    public void processOpts() {
        super.processOpts();
        this.supportingFiles.clear();
        modeSwitch = new ModeSwitch(additionalProperties);

        service = KeywordsUtil.getKeyword(camelize(openAPI.getInfo().getTitle()));
        subService = camelize(openAPI.getInfo().getDescription());

        additionalProperties.put("packageName", subService.toLowerCase());
        modelPackage = String.format("%s.%s", service.toLowerCase(), subService.toLowerCase());

        if (modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            try {
                String outputDir = outputFolder + File.separator + "testcase";
                File dir = new File(outputDir);
                if (!dir.exists()) {
                    dir.mkdirs();
                }
                String outputPath = outputDir + File.separator + "AutoCases.go";
                GoAutoCasesGenerator.generate(openAPI, outputPath);
             } catch (Exception e) {
                throw new RuntimeException("Failed to generate AutoCases.go", e);
            }
            return;
        }
        // =============================================================

        switch (modeSwitch.getMode()) {
            case API: {
                modelTemplateFiles.put("model.mustache", ".go");
                apiTemplateFiles.put("api.mustache", ".go");
                break;
            }
            case TEST: {
                apiTemplateFiles.put("api_test.mustache", ".go");
                break;
            }
            case TEST_TEMPLATE: {
                apiTemplateFiles.put("api_test_template.mustache", ".template");
                break;
            }
            case ENTRY: {
                apiTemplateFiles.put("api_entry.mustache", ".go");
                break;
            }
            case WS: {
                modelTemplateFiles.put("model_ws.mustache", ".go");
                apiTemplateFiles.put("api_ws.mustache", ".go");
                additionalProperties.put("WS_MODE", "true");
                break;
            }
            case WS_TEST: {
                apiTemplateFiles.put("api_ws_test.mustache", ".go");
                break;
            }
            default:
                throw new RuntimeException("unsupported mode");
        }

        supportingFiles.add(new SupportingFile("version.mustache", "version.go"));

        templateDir = "golang-sdk";

        // override parent properties
        generateMarshalJSON = false;
        generateUnmarshalJSON = false;
        enablePostProcessFile = true;

        inlineSchemaOption.put("SKIP_SCHEMA_REUSE", "true");
    }

    /**
     * 重写 preprocessOpenAPI，与 Java/PHP 版本保持一致
     * 在模型生成之前执行，初始化 schemaService 和 operationService
     */
    @Override
    public void preprocessOpenAPI(OpenAPI openAPI) {
        super.preprocessOpenAPI(openAPI);

        // 过滤 paths，只保留同时包含 MAIN 和 ALL 标签的接口
        filterPaths(openAPI);

        // parse and update operations and models
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
        return camelize(sanitizeName(name), CamelizeOption.UPPERCASE_FIRST_CHAR);
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
            prop.dataType = "int64";
            prop.datatypeWithEnum = "int64";
            prop.baseType = "int64";
        }

        String cc = camelize(prop.name, LOWERCASE_FIRST_LETTER);
        if (isReservedWord(cc)) {
            cc = escapeReservedWord(cc);
        }
        prop.nameInCamelCase = cc;

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

    public boolean isDataTypeString(String dataType) {
        return "string".equals(dataType);
    }

    @Override
    public String toEnumDefaultValue(String value, String datatype) {
        return "\"" + value + "\"";
    }

    @Override
    public String toEnumDefaultValue(CodegenProperty property, String value) {
        if (property.isString) {
            return "\"" + property.getDefaultValue() + "\"";
        }

        return property.defaultValue;
    }

    @Override
    public String toDefaultValue(Schema p) {
        p = ModelUtils.getReferencedSchema(this.openAPI, p);
        if (ModelUtils.isStringSchema(p)) {
            Object defaultObj = p.getDefault();
            if (defaultObj != null) {
                return "\"" + escapeText(String.valueOf(defaultObj)) + "\"";
            }
            return null;
        }

        return super.toDefaultValue(p);
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
        name = KeywordsUtil.getKeyword(name);
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
                return outputFolder + File.separator + "service";
            default:
                return outputFolder + File.separator + service.toLowerCase() + File.separator + subService.toLowerCase();
        }
    }

    @Override
    public String toApiFilename(String name) {
        String apiName = name.replaceAll("-", "_");
        apiName = KeywordsUtil.getKeyword(apiName);
        switch (modeSwitch.getMode()) {
            case API:
            case ENTRY:
            case TEST_TEMPLATE:
            case TEST: {
                apiName = apiName + "api";
                break;
            }
            case WS:
            case WS_TEST:
            case WS_TEST_TEMPLATE: {
                apiName = apiName + "ws";
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
            return outputFolder + File.separator + "AutoCases.go";
        }
        String suffix = apiTemplateFiles().get(templateName);
        if (modeSwitch.isEntry()) {
            String entryType = resolveEntryServiceName() + "Api";
            return modelFileFolder() + File.separator + entryType + suffix;
        }
        return modelFileFolder() + File.separator + toApiFilename(tag) + suffix;
    }

    private String resolveEntryServiceName() {
        if (operationService == null || operationService.getServiceMeta() == null || operationService.getServiceMeta().isEmpty()) {
            return service;
        }

        Set<String> services = new TreeSet<>();
        operationService.getServiceMeta().values().forEach(meta -> {
            if (meta != null && StringUtils.isNotEmpty(meta.getService())) {
                services.add(meta.getService());
            }
        });

        if (services.size() == 1) {
            return services.iterator().next();
        }

        return service;
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

        List<ModelMap> models = objs.getModels();
        if (models != null) {
            for (ModelMap model : models) {
                CodegenModel codegenModel = model.getModel();
                if (codegenModel != null) {
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

                    codegenModel.getVars().forEach(var -> {
                        if (var.getDefaultValue() != null && "int64".equals(var.dataType)) {
                            // 保持原样
                        }
                    });
                }
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

        for (CodegenOperation op : operationMap.getOperation()) {
            Meta meta = SpecificationUtil.getMeta(op.vendorExtensions);
            if (meta != null) {
                switch (modeSwitch.getMode()) {
                    case ENTRY: {
                        Map<String, Object> apiEntryInfo = new HashMap<>();
                        List<Map<String, Object>> entries = new ArrayList<>();
                        String suffix = "Api";
                        apiEntryInfo.put("api_entry_name", formatService(resolveEntryServiceName()) + "Service");
                        apiEntryInfo.put("api_entry_value", entries);
                        operationService.getServiceMeta().forEach((k, v) -> {
                            Map<String, Object> entryValue = new HashMap<>();
                            entryValue.put("api_entry_target_package", v.getSubService().toLowerCase());
                            entryValue.put("api_entry_target_api", formatService(v.getSubService()) + suffix);
                            entries.add(entryValue);
                        });
                        objs.put("api_entry", apiEntryInfo);
                        break;
                    }
                    case WS: {
                        boolean needStringsImport = false;
                        for (CodegenOperation codegenOp : operationMap.getOperation()) {
                            Meta metaOp = SpecificationUtil.getMeta(codegenOp.vendorExtensions);
                            if (metaOp != null) {
                                TopicMeta topicMeta = metaOp.getOtherProperties();
                                if (topicMeta != null && ((Map) (topicMeta.getParas().getType())).containsKey("object")) {
                                    needStringsImport = true;
                                    break;
                                }
                            }
                        }
                        objs.put("api_import", needStringsImport);
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
                    default: {
                        break;
                    }
                }
            }
        }
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
