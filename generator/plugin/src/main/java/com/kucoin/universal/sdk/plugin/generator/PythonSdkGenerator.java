package com.kucoin.universal.sdk.plugin.generator;

import com.kucoin.universal.sdk.plugin.model.EnumEntry;
import com.kucoin.universal.sdk.plugin.model.Meta;
import com.kucoin.universal.sdk.plugin.model.ModeSwitch;
import com.kucoin.universal.sdk.plugin.service.NameService;
import com.kucoin.universal.sdk.plugin.service.OperationService;
import com.kucoin.universal.sdk.plugin.service.SchemaService;
import com.kucoin.universal.sdk.plugin.service.impl.OperationServiceImpl;
import com.kucoin.universal.sdk.plugin.service.impl.SchemaServiceImpl;
import com.kucoin.universal.sdk.plugin.util.PythonAutoCasesGenerator;
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
import org.openapitools.codegen.languages.AbstractPythonCodegen;
import org.openapitools.codegen.model.ModelMap;
import org.openapitools.codegen.model.ModelsMap;
import org.openapitools.codegen.model.OperationMap;
import org.openapitools.codegen.model.OperationsMap;
import org.openapitools.codegen.utils.CamelizeOption;
import org.openapitools.codegen.utils.ModelUtils;

import javax.annotation.Nullable;
import java.io.File;
import java.util.*;

import static org.openapitools.codegen.utils.CamelizeOption.LOWERCASE_FIRST_LETTER;
import static org.openapitools.codegen.utils.StringUtils.camelize;
import static org.openapitools.codegen.utils.StringUtils.underscore;


@Slf4j
public class PythonSdkGenerator extends AbstractPythonCodegen implements NameService {

    private SchemaService schemaService;
    private OperationService operationService;
    private ModeSwitch modeSwitch;
    // map of set (model imports)
    private HashMap<String, HashSet<String>> circularImports = new HashMap<>();
    // map of codegen models
    private HashMap<String, CodegenModel> codegenModelMap = new HashMap<>();

    // model export(init.py)
    private Set<String> exports = new LinkedHashSet<>();

    private String service;
    private String subService;


    public CodegenType getTag() {
        return CodegenType.OTHER;
    }

    public String getName() {
        return "python-sdk";
    }

    public String getHelp() {
        return "Generates a python-sdk library.";
    }

    public PythonSdkGenerator() {
        super();
        cliOptions.add(ModeSwitch.option);
        typeMapping.put("Bigint", "int");
        typeMapping.put("bigint", "int");
        typeMapping.put("number", "float");
        typeMapping.put("integer", "int");
        typeMapping.put("anytype", "object");
    }

    @Override
    public void processOpts() {
        super.processOpts();
        modeSwitch = new ModeSwitch(additionalProperties);

        service = openAPI.getInfo().getTitle();
        subService = openAPI.getInfo().getDescription();

        // AUTO_CASES 模式
        if (modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            try {
                filterPaths(openAPI);
                String outputPath = outputFolder + File.separator + "AutoCases.py";
                PythonAutoCasesGenerator.generate(openAPI, outputPath);
                log.info("AutoCases.py generated successfully at: {}", outputPath);
            } catch (Exception e) {
                log.error("Failed to generate AutoCases.py", e);
                throw new RuntimeException("Failed to generate AutoCases.py", e);
            }
            return;
        }

        switch (modeSwitch.getMode()) {
            case WS: {
                modelTemplateFiles.put("model_ws.mustache", ".py");
                apiTemplateFiles.put("api_ws.mustache", ".py");
                additionalProperties.put("WS_MODE", "true");
                supportingFiles.add(new SupportingFile("module.mustache", String.format("./%s/%s/__init__.py", service, formatPackage(subService))));
                break;
            }
            case WS_TEST: {
                apiTemplateFiles.put("api_ws_test.mustache", ".py");
                break;
            }
            case API: {
                modelTemplateFiles.put("model.mustache", ".py");
                apiTemplateFiles.put("api.mustache", ".py");
                supportingFiles.add(new SupportingFile("module.mustache", String.format("./%s/%s/__init__.py", service, formatPackage(subService))));
                break;
            }
            case TEST_TEMPLATE: {
                apiTemplateFiles.put("api_test_template.mustache", ".template");
                break;
            }
            case ENTRY: {
                apiTemplateFiles.put("api_entry.mustache", ".py");
                supportingFiles.add(new SupportingFile("module_service.mustache", String.format("./%s/__init__.py", "service")));
                break;
            }
            case TEST: {
                apiTemplateFiles.put("api_test.mustache", ".py");
                break;
            }
            default:
                throw new RuntimeException("unsupported mode");
        }

        supportingFiles.add(new SupportingFile("version.mustache", "version.py"));
        supportingFiles.add(new SupportingFile("module_empty.mustache", "__init__.py"));
        supportingFiles.add(new SupportingFile("module_empty.mustache", String.format("./%s/__init__.py", service)));

        templateDir = "python-sdk";

        // override parent properties
        enablePostProcessFile = true;
        packageName = "";

        inlineSchemaOption.put("SKIP_SCHEMA_REUSE", "true");
    }

    @Override
    public void preprocessOpenAPI(OpenAPI openAPI) {
        super.preprocessOpenAPI(openAPI);
        filterPaths(openAPI);
        schemaService = new SchemaServiceImpl(openAPI);
        operationService = new OperationServiceImpl(openAPI, this);

        operationService.parseOperation();
        schemaService.parseSchema();
    }

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
        return underscore(sanitizeName(name));
    }

    @Override
    public String formatService(String name) {
        return cleanUsing(camelize(name));
    }

    @Override
    public String formatPackage(String name) {
        return name.toLowerCase();
    }

    @Override
    public String modelFileFolder() {
        switch (modeSwitch.getMode()) {
            case ENTRY:
                return outputFolder + File.separator + "service";
            default:
                return outputFolder + File.separator + service + File.separator + formatPackage(subService);
        }
    }

    @Override
    public String escapeReservedWord(String name) {
        if (this.reservedWordsMappings().containsKey(name)) {
            return this.reservedWordsMappings().get(name);
        }

        if (Character.isDigit(name.getBytes()[0])) {
            return "t_" + name;
        }

        return name + "_";
    }

    @Override
    public CodegenProperty fromProperty(String name, Schema p, boolean required) {
        if (p.getType() != null) {
            if (p.getType().equalsIgnoreCase("bigint")) {
                p.setType("integer");
            }

            if (p.getType().equalsIgnoreCase("anytype")) {
                p.setType(null);
            }
        }

        CodegenProperty prop = super.fromProperty(name, p, required);
        String cc = camelize(prop.name, LOWERCASE_FIRST_LETTER);
        if (isReservedWord(cc)) {
            cc = escapeReservedWord(cc);
        }
        prop.nameInCamelCase = cc;

        if (prop.isEnum) {
            List<EnumEntry> enums = new ArrayList<>();

            Map<String, String> builderVars = new HashMap<>();

            List<Map<String, Object>> enumList = null;
            if (prop.openApiType.equalsIgnoreCase("array")) {
                if (prop.mostInnerItems != null && prop.mostInnerItems.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.mostInnerItems.vendorExtensions.get("x-api-enum");
                }
                // list[XX.TypeEnum]
                builderVars.put("prefix", "list[");
                builderVars.put("suffix", "." + prop.enumName + "]");

            } else {
                if (prop.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.vendorExtensions.get("x-api-enum");
                }
                // XX.TypeEnum
                builderVars.put("prefix", "");
                builderVars.put("suffix", "." + prop.datatypeWithEnum);
            }

            // 如果 enumList 为空，从标准 OpenAPI enum 构建
            if (enumList == null || enumList.isEmpty()) {
                enumList = buildEnumListFromStandardOpenApiEnum(p, prop);
            }

            // 如果 enumList 仍然为空，创建一个空的列表避免 NPE
            if (enumList == null) {
                enumList = new ArrayList<>();
            }

            // 获取字段的 PascalCase 名称
            String fieldName = prop.nameInCamelCase;
            if (fieldName == null || fieldName.isEmpty()) {
                fieldName = prop.name;
            }
            String pascalName = fieldName.substring(0, 1).toUpperCase() + fieldName.substring(1);

            List<String> names = new ArrayList<>();
            List<String> values = new ArrayList<>();
            List<String> description = new ArrayList<>();

            // 确保 enumList 不为 null
            final List<Map<String, Object>> finalEnumList = enumList != null ? enumList : new ArrayList<>();
            finalEnumList.forEach(e -> {
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
            prop.vendorExtensions.put("x-enum-builder-vars", builderVars);
            prop.vendorExtensions.put("x-enums", enums);
            prop.vendorExtensions.put("x-enums-datatype", typeMapping.get(p.getType()));
        }

        return prop;
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
    public String toEnumName(CodegenProperty property) {
        return formatService(property.name + "Enum");
    }

    @Override
    public String toEnumDefaultValue(CodegenProperty property, String value) {
        return toEnumDefaultValue(value, property.datatypeWithEnum);
    }

    @Override
    public String toModelName(String name) {
        return super.toModelName(cleanUsing(schemaService.getGeneratedModelName(name)));
    }

    @Override
    public String toApiName(String name) {
        return camelize(name + "_" + (modeSwitch.isWs() ? "WS" : "API"));
    }

    @Override
    public String toModelFilename(String name) {
        name = "model_" + cleanUsing(schemaService.getGeneratedModelName(name));
        return underscore(dropDots(name));
    }

    @Override
    public String toApiFilename(String name) {
        String apiName = name.replaceAll("-", "_");
        switch (modeSwitch.getMode()) {
            case WS: {
                apiName = "ws_" + underscore(apiName);
                break;
            }
            case API:
            case ENTRY:
            case TEST_TEMPLATE: {
                apiName = "api_" + underscore(apiName);
                break;
            }
            case TEST:
            case WS_TEST: {
                apiName = "api_" + underscore(apiName) + "_test";
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
            String entryType = service + "_api";
            return modelFileFolder() + File.separator + entryType + suffix;
        }
        return modelFileFolder() + File.separator + toApiFilename(tag) + suffix;
    }

     private String generateImport(String _package, String fileName, String... target) {
        return String.format("from %s.%s import %s", packageName, fileName, String.join(",", target));
    }

    private String generateImportSimple(String from, String... target) {
        return String.format("from %s import %s", from, String.join(",", target));
    }

    private Set<String> generateApiImport(Meta meta, boolean req) {
        Set<String> imports = new HashSet<>();
        switch (modeSwitch.getMode()) {
            case API:
            case TEST: {
                String suffix = "resp";
                if (req) {
                    suffix = "req";
                }
                imports.add(generateImport(meta.getService().toLowerCase(),
                        toModelFilename(meta.getMethod()) + "_" + suffix,
                        formatService(meta.getMethod() + camelize(suffix))));
                break;
            }
            case WS: {
                String suffix = "event";
                imports.add(generateImport(meta.getService().toLowerCase(),
                        toModelFilename(meta.getMethod()) + "_" + suffix,
                        formatService(meta.getMethod() + camelize(suffix + "Callback")),
                        formatService(meta.getMethod() + camelize(suffix + "CallbackWrapper"))));

                if ((((Map<String, Object>) meta.getOtherProperties().getParas().getType()).containsKey("array"))) {
                    imports.add(generateImportSimple("typing", "List"));
                }

                break;

            }
            default: {
                throw new RuntimeException("unsupported mode");
            }
        }
        return imports;
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
    public OperationsMap postProcessOperationsWithModels(OperationsMap objs, List<ModelMap> allModels) {
        objs = super.postProcessOperationsWithModels(objs, allModels);

        OperationMap operationMap = objs.getOperations();

        Set<String> modelImport = new TreeSet<>();
        Set<String> exportsSet = new TreeSet<>();

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
                                kv.put("method_upper", camelize(formatMethodName(k), CamelizeOption.UPPERCASE_FIRST_CHAR));
                                kv.put("target_service", formatService(k + "API"));
                                entryValue.add(kv);
                            }
                        });
                        Map<String, Object> apiEntryInfo = new HashMap<>();
                        apiEntryInfo.put("api_entry_name", formatService(meta.getService() + "Service"));
                        apiEntryInfo.put("api_entry_value", entryValue);
                        objs.put("api_entry", apiEntryInfo);
                        entryValue.forEach(m -> {
                            modelImport.addAll(generateApiImport(meta, false));
                        });
                        break;
                    }

                    case API:
                    case TEST: {
                        allModels.forEach(m -> {
                            String importName = (String) m.get("importPath");
                            String fileName = m.getModel().getClassFilename();
                            exportsSet.add(String.format("from .%s import %s", fileName, importName));
                            if (m.getModel().getVendorExtensions().containsKey("x-request-model")) {
                                exportsSet.add(String.format("from .%s import %s", fileName, importName + "Builder"));
                            }
                        });
                        exportsSet.add(String.format("from .%s import %sAPI", toApiFilename(meta.getSubService()), formatService(meta.getSubService())));

                        if (op.hasParams) {
                            modelImport.addAll(generateApiImport(meta, true));
                        }
                        modelImport.addAll(generateApiImport(meta, false));

                        if (op.isDeprecated) {
                            modelImport.add(generateImportSimple("typing_extensions", "deprecated"));
                        }

                        break;
                    }
                    case WS:
                    case WS_TEST: {
                        allModels.forEach(m -> {
                            String importName = (String) m.get("importPath");
                            String fileName = m.getModel().getClassFilename();
                            exportsSet.add(String.format("from .%s import %s", fileName, importName));
                        });
                        exportsSet.add(String.format("from .%s import %sWS", toApiFilename(meta.getSubService()), formatService(meta.getSubService())));

                        modelImport.addAll(generateApiImport(meta, false));
                        break;
                    }
                    case TEST_TEMPLATE: {
                        String reqName = meta.getMethodServiceFmt().toLowerCase() + "Req";
                        allModels.stream().filter(m -> reqName.equalsIgnoreCase((String) m.get("importPath"))).
                                forEach(m -> op.vendorExtensions.put("x-request-model", m.getModel()));
                        break;
                    }
                }
            }
        }

        objs.put("imports", modelImport);
        // 保存到类成员变量和 additionalProperties
        this.exports = exportsSet;
        additionalProperties.put("exports", new ArrayList<>(exportsSet));

        return objs;
    }

    @Override
    public ModelsMap postProcessModels(ModelsMap objs) {
        objs = super.postProcessModels(objs);

        List<ModelMap> models = objs.getModels();
        if (models != null) {
            for (ModelMap model : models) {
                CodegenModel codegenModel = model.getModel();
                if (codegenModel != null) {

                    List<CodegenProperty> codegenProperties = null;
                    if (!codegenModel.oneOf.isEmpty()) {
                        codegenProperties = codegenModel.getComposedSchemas().getOneOf();
                    } else if (!codegenModel.anyOf.isEmpty()) {
                        codegenProperties = codegenModel.getComposedSchemas().getAnyOf();
                    } else {
                        // typical model
                        codegenProperties = codegenModel.vars;
                    }

                    if (codegenProperties != null) {
                        codegenProperties.forEach(c -> {
                            c.required = false;
                        });
                    }

                    Meta meta = schemaService.getMeta(codegenModel.getName());
                    if (meta != null) {
                        objs.put(CodegenConstants.PACKAGE_NAME, formatPackage(meta.getService()));
                    }
                }
            }
        }
        return objs;
    }

    @Override
    public Map<String, ModelsMap> postProcessAllModels(Map<String, ModelsMap> objs) {
        final Map<String, ModelsMap> processed = super.postProcessAllModels(objs);

        // ===== 修复父类生成的 x-py-model-imports（将 .models. 替换为 .model_）=====
        for (Map.Entry<String, ModelsMap> entry : processed.entrySet()) {
            ModelsMap modelsMap = entry.getValue();
            if (modelsMap.getModels() != null) {
                for (ModelMap model : modelsMap.getModels()) {
                    CodegenModel codegenModel = model.getModel();
                    if (codegenModel != null && codegenModel.getVendorExtensions() != null) {

                        // 修复 x-py-model-imports
                        if (codegenModel.getVendorExtensions().containsKey("x-py-model-imports")) {
                            Set<String> oldImports = (Set<String>) codegenModel.getVendorExtensions().get("x-py-model-imports");
                            Set<String> newImports = new TreeSet<>();
                            for (String imp : oldImports) {
                                newImports.add(imp.replace(".models.", ".model_"));
                            }
                            codegenModel.getVendorExtensions().put("x-py-model-imports", newImports);
                        }

                        // 修复 x-py-postponed-model-imports
                        if (codegenModel.getVendorExtensions().containsKey("x-py-postponed-model-imports")) {
                            Set<String> oldImports = (Set<String>) codegenModel.getVendorExtensions().get("x-py-postponed-model-imports");
                            Set<String> newImports = new TreeSet<>();
                            for (String imp : oldImports) {
                                newImports.add(imp.replace(".models.", ".model_"));
                            }
                            codegenModel.getVendorExtensions().put("x-py-postponed-model-imports", newImports);
                        }
                    }
                }
            }
        }
        // ==========================================================

        for (Map.Entry<String, ModelsMap> entry : objs.entrySet()) {
            // create hash map of codegen model
            CodegenModel cm = ModelUtils.getModelByName(entry.getKey(), objs);
            codegenModelMap.put(cm.classname, ModelUtils.getModelByName(entry.getKey(), objs));
        }
        for (String m : codegenModelMap.keySet()) {
            createImportMapOfSet(m, codegenModelMap);
        }

        for (Map.Entry<String, ModelsMap> entry : processed.entrySet()) {
            entry.setValue(postProcessModelsMap(entry.getValue()));
        }

        return processed;
    }

    /**
     * Update circularImports with the model name (key) and its imports gathered recursively
     *
     * @param modelName       model name
     * @param codegenModelMap a map of CodegenModel
     */
    void createImportMapOfSet(String modelName, Map<String, CodegenModel> codegenModelMap) {
        HashSet<String> imports = new HashSet<>();
        circularImports.put(modelName, imports);

        CodegenModel cm = codegenModelMap.get(modelName);

        if (cm == null) {
            log.warn("Failed to lookup model in createImportMapOfSet: " + modelName);
            return;
        }

        for (CodegenProperty cp : cm.vars) {
            String modelNameFromDataType = getModelNameFromDataType(cp);
            if (modelNameFromDataType != null) { // model
                imports.add(modelNameFromDataType); // update import
                // go through properties or sub-schemas of the model recursively to identify more (model) import if any
                updateImportsFromCodegenModel(modelNameFromDataType, codegenModelMap.get(modelNameFromDataType), imports);
            }
        }
    }

    private String getModelNameFromDataType(CodegenProperty cp) {
        if (cp.isArray) {
            return getModelNameFromDataType(cp.items);
        } else if (cp.isMap) {
            return getModelNameFromDataType(cp.items);
        } else if (!cp.isPrimitiveType || cp.isModel) {
            return cp.getDataType();
        } else {
            return null;
        }
    }

    private ModelsMap postProcessModelsMap(ModelsMap objs) {
        objs = postProcessModelsEnum(objs);

        TreeSet<String> modelImports = new TreeSet<>();
        TreeSet<String> postponedModelImports = new TreeSet<>();

        for (ModelMap m : objs.getModels()) {
            TreeSet<String> exampleImports = new TreeSet<>();
            TreeSet<String> postponedExampleImports = new TreeSet<>();
            List<String> readOnlyFields = new ArrayList<>();
            hasModelsToImport = false;

            PythonImports moduleImports = new PythonImports();
            CodegenModel model = m.getModel();

            if (modeSwitch.isWs()) {
                moduleImports.add("typing", "Callable");
            }

            PydanticType pydantic = new PydanticType(
                    modelImports,
                    exampleImports,
                    postponedModelImports,
                    postponedExampleImports,
                    moduleImports,
                    model.classname
            );

            // add Field import for response model
            if (m.getModel().getVendorExtensions() != null) {
                if (m.getModel().getVendorExtensions().containsKey("x-response-model")) {
                    moduleImports.add("pydantic", "Field");
                }
            }

            // 添加基础导入
            moduleImports.add("pydantic", "BaseModel");
            moduleImports.add("pydantic", "ConfigDict");
            moduleImports.add("pydantic", "StrictStr");

            List<CodegenProperty> codegenProperties = model.vars;

            // if model_generic.mustache is used
            if (model.oneOf.isEmpty() && model.anyOf.isEmpty() && !model.isEnum) {
                moduleImports.add("typing", "ClassVar");
                moduleImports.add("typing", "Dict");
                moduleImports.add("typing", "Any");
                if (this.disallowAdditionalPropertiesIfNotPresent || model.isAdditionalPropertiesTrue) {
                    moduleImports.add("typing", "List");
                }
            }

            // loop through properties/schemas to set up typing, pydantic
            for (CodegenProperty cp : codegenProperties) {
                // is readOnly?
                if (cp.isReadOnly) {
                    readOnlyFields.add(cp.name);
                }

                // 检查是否是枚举
                if (cp.isEnum) {
                    moduleImports.add("enum", "Enum");
                }
                // 检查数组内部元素是否是枚举
                if (cp.mostInnerItems != null && cp.mostInnerItems.isEnum) {
                    moduleImports.add("enum", "Enum");
                }

                String typing = pydantic.generatePythonType(cp);
                cp.vendorExtensions.put("x-py-typing", typing);
            }

            // set the extensions if the key is absent
            model.getVendorExtensions().putIfAbsent("x-py-readonly", readOnlyFields);

            // remove the items of postponedModelImports in modelImports to avoid circular imports error
            if (!modelImports.isEmpty() && !postponedModelImports.isEmpty()) {
                modelImports.removeAll(postponedModelImports);
            }

            if (!modelImports.isEmpty()) {
                Set<String> modelsToImport = new TreeSet<>();
                for (String modelImport : modelImports) {
                    if (modelImport.equals(model.classname)) {
                        continue;
                    }

                    Meta meta = schemaService.getMeta(model.getName());
                    if (meta != null) {
                        modelsToImport.add(generateImport(meta.getService().toLowerCase(), toModelFilename(modelImport), modelImport));
                    }
                }

                if (!modelsToImport.isEmpty()) {
                    model.getVendorExtensions().put("x-py-model-imports", modelsToImport);
                }
            }

            if (!moduleImports.isEmpty()) {
                model.getVendorExtensions().put("x-py-other-imports", moduleImports.exports());
            }

            if (!postponedModelImports.isEmpty()) {
                Set<String> modelsToImport = new TreeSet<>();
                for (String modelImport : postponedModelImports) {
                    if (modelImport.equals(model.classname)) {
                        // skip self import
                        continue;
                    }
                    Meta meta = schemaService.getMeta(model.getName());
                    if (meta != null) {
                        modelsToImport.add(generateImport(meta.getService().toLowerCase(), toModelFilename(modelImport), modelImport));
                    }
                }

                model.getVendorExtensions().putIfAbsent("x-py-postponed-model-imports", modelsToImport);
            }
        }

        return objs;
    }

    @Override
    public String toEnumValue(String value, String datatype) {
        if ("int".equals(datatype) || "float".equals(datatype)) {
            return value;
        } else {
            return "'" + escapeText(value) + "'";
        }
    }


    class PythonImports {
        private Map<String, Set<String>> imports;

        public PythonImports() {
            imports = new HashMap<>();
        }


        private void add(String from, String what) {
            // Fetch the set of all the objects already imported from `from` (if any).
            Set<String> allImportsFrom = imports.get(from);
            if (allImportsFrom == null) {
                allImportsFrom = new TreeSet<>();
            }
            // Just one more thing to import from `from`.
            allImportsFrom.add(what);
            imports.put(from, allImportsFrom);
        }

        public Set<String> exports() {
            Set<String> results = new TreeSet<>();

            for (Map.Entry<String, Set<String>> entry : imports.entrySet()) {
                String importLine = String.format(
                        Locale.ROOT, "from %s import %s",
                        entry.getKey(), StringUtils.join(entry.getValue(), ", "));
                results.add(importLine);
            }

            return results;
        }

        public boolean isEmpty() {
            return imports.isEmpty();
        }
    }


    /* The definition for a Python type.
     *
     * This encapsulate all the type definition: the actual type, and potentially:
     *
     * * its type parameters if the actual type is a generic type
     * * the additional constraints on the type
     * * the additional annotations to give extra information about the type (description, alias, etc.)
     * * a default value for the variable associated with the type
     */
    class PythonType {
        private String type;
        private List<PythonType> typeParams;
        private Map<String, Object> annotations;
        private Map<String, Object> constraints;

        private String defaultValue;

        public PythonType() {
            this(null);
        }

        public PythonType(String type) {
            this.setType(type);
            this.defaultValue = null;
            this.typeParams = new ArrayList<>();
            this.annotations = new HashMap<>();
            this.constraints = new HashMap<>();
        }

        public PythonType setType(String type) {
            this.type = type;
            return this;
        }

        public PythonType setDefaultValue(boolean value) {
            if (value) {
                defaultValue = "True";
            } else {
                defaultValue = "False";
            }
            return this;
        }

        public PythonType setDefaultValue(Object value) {
            defaultValue = value.toString();
            return this;
        }

        public PythonType constrain(String name, String value) {
            return constrain(name, value, true);
        }

        public PythonType constrain(String name, String value, boolean quote) {
            if (quote) {
                value = "\"" + value + "\"";
            }
            constraints.put(name, value);
            return this;
        }

        public PythonType constrain(String name, boolean value) {
            if (value) {
                constraints.put(name, "True");
            } else {
                constraints.put(name, "False");
            }
            return this;
        }

        public PythonType constrain(String name, Object value) {
            constraints.put(name, value);
            return this;
        }

        /* Annotate a field with extra information.
         *
         * Annotation are made to add extra information about a field.
         *
         * If the information you need to add is a type constraint (to make the
         * type more specific), use `constrain` instead.
         */
        public PythonType annotate(String name, String value) {
            return annotate(name, value, true);
        }

        public PythonType annotate(String name, String value, boolean quote) {
            if (quote) {
                value = "\"" + value + "\"";
            }
            annotations.put(name, value);
            return this;
        }

        public PythonType annotate(String name, boolean value) {
            if (value) {
                annotations.put(name, "True");
            } else {
                annotations.put(name, "False");
            }
            return this;
        }

        public PythonType annotate(String name, Object value) {
            annotations.put(name, value);
            return this;
        }

        /* A "type param" is the parameter to a generic type (the `str` in `list[str]`).
         *
         * A Python type can have multiple type parameters: it assumes the
         * Python type on which the type parameter is added to is a generic
         * type.
         *
         * Type parameters can be as simple or as complex as needed. They are just
         * another list of `PythonType`.
         */
        public PythonType addTypeParam(PythonType typeParam) {
            this.typeParams.add(typeParam);
            return this;
        }

        /* The left-hand side of:
         *
         *      my_field: TypeConstraint = TypeAnnotations
         *
         *  A "type constraint" is a Python / Pydantic type, potentially
         *  annotated with extra constraints, such as "less than", "maximum
         *  number of items", etc.
         *
         *  The Python / Pydantic type can be as expressive as needed:
         *
         *  - it could simply be `str`
         *  - or something more complex like `Optional[List[Dict[str, List[int]]]]`.
         *
         *  Note that the default value (if available) and/or the metadata about
         *  the field / variable being defined are *not* part of the
         *  constraints but part of the "type value".
         */
        public String asTypeConstraint(PythonImports imports) {
            return asTypeConstraint(imports, false);
        }

        /* Generate the Python type, constraints + annotations
         *
         * This should be mostly used to build the type definition for a
         * function/method parameter, such as :
         *
         *      def f(my_param: TypeConstrainWithAnnotations):
         *          ...
         *
         *  Note that the default value is not managed here, but directly in
         *  the Mustache template.
         */
        public String asTypeConstraintWithAnnotations(PythonImports imports) {
            return asTypeConstraint(imports, true);
        }

        private String asTypeConstraint(PythonImports imports, boolean withAnnotations) {
            String typeParam = "";
            if (this.typeParams.size() > 0) {
                List<String> types = new ArrayList<>();
                for (PythonType t : this.typeParams) {
                    types.add(t.asTypeConstraint(imports));
                }
                typeParam = "[" + StringUtils.join(types, ", ") + "]";
            }

            String currentType = this.type + typeParam;

            // Build the parameters for the `Field`, possibly associated with
            // the type definition.
            // There can be no constraints nor annotations, in which case we
            // simply won't build a Field object.
            List<String> fieldParams = new ArrayList<>();
            for (Map.Entry<String, Object> entry : this.constraints.entrySet()) {
                String ans = entry.getKey() + "=";
                ans += entry.getValue().toString();
                fieldParams.add(ans);
            }

            if (withAnnotations) {
                for (Map.Entry<String, Object> entry : this.annotations.entrySet()) {
                    String ans = entry.getKey() + "=";
                    ans += entry.getValue().toString();
                    fieldParams.add(ans);
                }
            }

            if (fieldParams.size() > 0) {
                imports.add("pydantic", "Field");
                imports.add("typing_extensions", "Annotated");
                currentType = "Annotated[" + currentType + ", Field(" + StringUtils.join(fieldParams, ", ") + ")]";
            }

            return currentType;
        }

        /* The right-hand side of:
         *
         *      my_field: TypeConstraint = TypeValue
         *
         *  A "type value" is either:
         *
         *  * The default value of a field, if no other information is available
         *  * A Pydantic `Field`, containing potentially the default value,
         *    plus all the extra metadata that defines what a field is (description, alias, etc.).
         *
         *  Constraints on the type are *not* part of the "type value", but are part of the "type constraints".
         */
        @Nullable
        public String asTypeValue(PythonImports imports) {
            String defaultValue = this.defaultValue;

            if (this.annotations.size() > 0) {
                String typeValue = "";

                List<String> ants = new ArrayList<>();

                if (defaultValue != null) {
                    // Keep the default value first, if possible.
                    ants.add("default=" + defaultValue);
                }

                for (Map.Entry<String, Object> entry : this.annotations.entrySet()) {
                    String ans = entry.getKey() + "=";
                    ans += entry.getValue().toString();
                    ants.add(ans);
                }

                imports.add("pydantic", "Field");
                typeValue = "Field(" + StringUtils.join(ants, ", ") + ")";
                return typeValue;
            }

            return defaultValue;
        }
    }


    class PydanticType {
        private Set<String> modelImports;
        private Set<String> exampleImports;
        private Set<String> postponedModelImports;
        private Set<String> postponedExampleImports;
        private PythonImports moduleImports;
        private String classname;

        public PydanticType(
                Set<String> modelImports,
                Set<String> exampleImports,
                Set<String> postponedModelImports,
                Set<String> postponedExampleImports,
                PythonImports moduleImports,
                String classname
        ) {
            this.modelImports = modelImports;
            this.exampleImports = exampleImports;
            this.postponedModelImports = postponedModelImports;
            this.postponedExampleImports = postponedExampleImports;
            this.moduleImports = moduleImports;
            this.classname = classname;
        }

        private PythonType arrayType(IJsonSchemaValidationProperties cp) {
            PythonType pt = new PythonType();
            if (cp.getMaxItems() != null) {
                pt.constrain("max_length", cp.getMaxItems());
            }
            if (cp.getMinItems() != null) {
                pt.constrain("min_length", cp.getMinItems());
            }
            if (cp.getUniqueItems()) {
                pt.setType("List");
                moduleImports.add("typing", "List");
            } else {
                pt.setType("List");
                moduleImports.add("typing", "List");
            }
            pt.addTypeParam(collectionItemType(cp.getItems()));
            return pt;
        }

        private PythonType collectionItemType(CodegenProperty itemCp) {
            PythonType itemPt = getType(itemCp);
            if (itemCp != null && !itemPt.type.equals("Any") && itemCp.isNullable) {
                moduleImports.add("typing", "Optional");
                PythonType opt = new PythonType("Optional");
                opt.addTypeParam(itemPt);
                itemPt = opt;
            }
            return itemPt;
        }

        private PythonType stringType(IJsonSchemaValidationProperties cp) {
            return new PythonType("str");
        }

        private PythonType mapType(IJsonSchemaValidationProperties cp) {
            moduleImports.add("typing", "Dict");
            PythonType pt = new PythonType("Dict");
            pt.addTypeParam(new PythonType("str"));
            pt.addTypeParam(collectionItemType(cp.getItems()));
            return pt;
        }

        private PythonType numberType(IJsonSchemaValidationProperties cp) {
            return new PythonType("float");
        }

        private PythonType intType(IJsonSchemaValidationProperties cp) {
            return new PythonType("int");
        }

        private PythonType binaryType(IJsonSchemaValidationProperties cp) {
            moduleImports.add("pydantic", "StrictBytes");
            moduleImports.add("pydantic", "StrictStr");
            moduleImports.add("typing", "Union");

            PythonType pt = new PythonType("Union");
            pt.addTypeParam(new PythonType("StrictBytes"));
            pt.addTypeParam(new PythonType("StrictStr"));
            return pt;
        }

        private PythonType boolType(IJsonSchemaValidationProperties cp) {
            return new PythonType("bool");
        }

        private PythonType decimalType(IJsonSchemaValidationProperties cp) {
            PythonType pt = new PythonType("Decimal");
            moduleImports.add("decimal", "Decimal");
            return pt;
        }

        private PythonType anyType(IJsonSchemaValidationProperties cp) {
            moduleImports.add("typing", "Any");
            return new PythonType("Any");
        }

        private PythonType dateType(IJsonSchemaValidationProperties cp) {
            if (cp.getIsDate()) {
                moduleImports.add("datetime", "date");
            }
            if (cp.getIsDateTime()) {
                moduleImports.add("datetime", "datetime");
            }

            return new PythonType(cp.getDataType());
        }

        private PythonType uuidType(IJsonSchemaValidationProperties cp) {
            return new PythonType(cp.getDataType());
        }

        private PythonType fromCommon(CodegenProperty cp) {
            if (cp == null) {
                log.warn("Codegen property is null (e.g. map/dict of undefined type). Default to typing.Any.");
                moduleImports.add("typing", "Any");
                return new PythonType("Any");
            }

            if (cp.getIsArray()) {
                return arrayType(cp);
            } else if (cp.getIsMap() || cp.getIsFreeFormObject()) {
                return mapType(cp);
            } else if (cp.getIsEnum()) {
                return new PythonType(cp.datatypeWithEnum);
            } else if (cp.getIsString()) {
                return stringType(cp);
            } else if (cp.getIsNumber() || cp.getIsFloat() || cp.getIsDouble()) {
                return numberType(cp);
            } else if (cp.getIsInteger() || cp.getIsLong() || cp.getIsShort() || cp.getIsUnboundedInteger()) {
                return intType(cp);
            } else if (cp.getIsBinary() || cp.getIsByteArray()) {
                return binaryType(cp);
            } else if (cp.getIsBoolean()) {
                return boolType(cp);
            } else if (cp.getIsDecimal()) {
                return decimalType(cp);
            } else if (cp.getIsAnyType()) {
                return anyType(cp);
            } else if (cp.getIsDate() || cp.getIsDateTime()) {
                return dateType(cp);
            } else if (cp.getIsUuid()) {
                return uuidType(cp);
            }

            return null;
        }

        public String generatePythonType(CodegenProperty cp) {
            PythonType pt = this.getType(cp);
            return this.finalizeType(cp, pt);
        }

        private PythonType getType(CodegenProperty cp) {
            PythonType result = fromCommon(cp);

            if (result == null) {
                if (!cp.isPrimitiveType || cp.isModel) { // model
                    // skip import if it's a circular reference
                    if (classname == null) {
                        // for parameter model, import directly
                        hasModelsToImport = true;
                        modelImports.add(cp.getDataType());
                        exampleImports.add(cp.getDataType());
                    } else {
                        if (circularImports.containsKey(cp.getDataType())) {
                            if (circularImports.get(cp.getDataType()).contains(classname)) {
                                hasModelsToImport = true;
                                postponedModelImports.add(cp.getDataType());
                                postponedExampleImports.add(cp.getDataType());
                                // cp.getDataType() import map of set contains this model (classname), don't import
                                log.debug("Skipped importing {} in {} due to circular import.", cp.getDataType(), classname);
                            } else {
                                // not circular import, so ok to import it
                                hasModelsToImport = true;
                                modelImports.add(cp.getDataType());
                                exampleImports.add(cp.getDataType());
                            }
                        }
                    }
                    result = new PythonType(cp.getDataType());
                } else {
                    throw new RuntimeException("Error! Codegen Property not yet supported in getPydanticType: " + cp);
                }
            }

            return result;
        }

        private String finalizeType(CodegenProperty cp, PythonType pt) {
            if (!cp.required || cp.isNullable) {
                moduleImports.add("typing", "Optional");
                PythonType opt = new PythonType("Optional");
                opt.addTypeParam(pt);
                pt = opt;
            }

            if (!StringUtils.isEmpty(cp.description)) {
                pt.annotate("description", cp.description);
            }

            // field
            if (cp.baseName != null && !cp.baseName.equals(cp.name)) {
                pt.annotate("alias", cp.baseName);
            }

            if (cp.vendorExtensions.containsKey("x-tag-path")) {
                pt.annotate("path_variable", "True");
            }

            if (!cp.required) {
                if (cp.defaultValue == null) {
                    pt.setDefaultValue("None");
                } else {
                    if (cp.isArray || cp.isMap) {
                        pt.setDefaultValue("None");
                    } else {
                        // 对于枚举类型的默认值，使用枚举类名作为前缀
                        String defaultValue = cp.defaultValue;
                        if (cp.isEnum && defaultValue != null) {
                            // 获取枚举类名
                            String enumName = getEnumClassName(cp);
                            if (enumName != null && !enumName.isEmpty()) {
                                // 检查是否已经是完整路径
                                if (!defaultValue.contains(".")) {
                                    defaultValue = enumName + "." + defaultValue;
                                }
                            }
                        }
                        pt.setDefaultValue(defaultValue);
                    }
                }
            }

            String typeConstraint = pt.asTypeConstraint(moduleImports);
            String typeValue = pt.asTypeValue(moduleImports);

            if (typeValue == null) {
                return typeConstraint;
            } else {
                return typeConstraint + " = " + typeValue;
            }
        }
    }

    private String getEnumClassName(CodegenProperty var) {
        if (var == null) {
            return "Enum";
        }

        CodegenProperty target = var;
        if (var.mostInnerItems != null && var.mostInnerItems.isEnum) {
            target = var.mostInnerItems;
        }

        String fieldName = target.nameInCamelCase;
        if (fieldName == null || fieldName.isEmpty()) {
            fieldName = target.name;
        }
        if (fieldName != null && !fieldName.isEmpty()) {
            return fieldName.substring(0, 1).toUpperCase() + fieldName.substring(1) + "Enum";
        }

        return "Enum";
    }

    private String cleanUsing(String name) {
        if (name == null) {
            return null;
        }

        String result = name.replaceAll("(?i)Using(?:GET|POST|PUT|DELETE|PATCH)(.*?)(Response|Req|Event|Data)", "$2");
        // 清理 using_get 下划线格式
        result = result.replaceAll("(?i)using_(?:get|post|put|delete|patch).*?_(response|req|event|data)", "$1");
        result = result.replaceAll("_\\d+_200", "");
        result = result.replaceAll("_200", "");
        return result;
    }
}
