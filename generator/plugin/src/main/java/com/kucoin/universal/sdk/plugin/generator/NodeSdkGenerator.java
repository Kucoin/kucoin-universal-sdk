package com.kucoin.universal.sdk.plugin.generator;

import com.kucoin.universal.sdk.plugin.model.EnumEntry;
import com.kucoin.universal.sdk.plugin.model.Meta;
import com.kucoin.universal.sdk.plugin.model.ModeSwitch;
import com.kucoin.universal.sdk.plugin.service.NameService;
import com.kucoin.universal.sdk.plugin.service.OperationService;
import com.kucoin.universal.sdk.plugin.service.SchemaService;
import com.kucoin.universal.sdk.plugin.service.impl.OperationServiceImpl;
import com.kucoin.universal.sdk.plugin.service.impl.SchemaServiceImpl;
import com.kucoin.universal.sdk.plugin.util.NodeAutoCasesGenerator;
import com.kucoin.universal.sdk.plugin.util.SpecificationUtil;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
import io.swagger.v3.oas.models.media.Schema;
import io.swagger.v3.oas.models.servers.Server;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.StringUtils;
import org.apache.commons.lang3.tuple.Pair;
import org.openapitools.codegen.*;
import org.openapitools.codegen.languages.AbstractTypeScriptClientCodegen;
import org.openapitools.codegen.model.ModelMap;
import org.openapitools.codegen.model.ModelsMap;
import org.openapitools.codegen.model.OperationMap;
import org.openapitools.codegen.model.OperationsMap;
import org.openapitools.codegen.utils.CamelizeOption;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.util.*;
import java.util.stream.Collectors;

import static org.openapitools.codegen.utils.StringUtils.camelize;
import static org.openapitools.codegen.utils.StringUtils.underscore;

@Slf4j
public class NodeSdkGenerator extends AbstractTypeScriptClientCodegen implements NameService {

    private static class ImportModel {
        public String className;
        public Set<String> component;

        public ImportModel(String className) {
            this.className = className;
            this.component = new HashSet<>();
        }

        public String toImport() {
            if (component.isEmpty()) {
                return String.format("import \"%s\"", className);
            }

            // 对组件按字母排序，保证生成的导入语句稳定
            List<String> sortedComponents = new ArrayList<>(component);
            Collections.sort(sortedComponents);
            return String.format("import { %s } from \"%s\"", String.join(", ", sortedComponents), className);
        }
    }

    private SchemaService schemaService;
    private OperationService operationService;
    private ModeSwitch modeSwitch;

    private String service;
    private String subService;
    private Set<String> exports = new LinkedHashSet<>();
    private Set<String> serviceExportsTemplate = new HashSet<>();
    private static final Set<String> wsServices = Set.of("spot", "futures", "margin");

    // 用于追踪模型导入的映射
    private Map<String, Set<String>> circularImports = new HashMap<>();

    public CodegenType getTag() {
        return CodegenType.OTHER;
    }

    public String getName() {
        return "node-sdk";
    }

    public String getHelp() {
        return "Generates a node-sdk library.";
    }

    public NodeSdkGenerator() {
        super();
        cliOptions.add(ModeSwitch.option);
    }

    @Override
    public void processOpts() {
        super.processOpts();
        modeSwitch = new ModeSwitch(additionalProperties);
        service = openAPI.getInfo().getTitle();
        subService = openAPI.getInfo().getDescription();

        if (modeSwitch.getMode() == ModeSwitch.ModeEnum.AUTO_CASES) {
            try {
                filterPaths(openAPI);
                String outputPath = outputFolder + File.separator + "AutoCases.ts";
                NodeAutoCasesGenerator.generate(openAPI, outputPath);
                log.info("AutoCases.ts generated successfully at: {}", outputPath);
            } catch (Exception e) {
                log.error("Failed to generate AutoCases.ts", e);
                throw new RuntimeException("Failed to generate AutoCases.ts", e);
            }
            return;
        }

        switch (modeSwitch.getMode()) {
            case API: {
                modelTemplateFiles.put("model.mustache", ".ts");
                apiTemplateFiles.put("api.mustache", ".ts");
                supportingFiles.add(new SupportingFile("module.mustache", String.format("./%s/%s/index.ts", service, formatPackage(subService))));
                supportingFiles.add(new SupportingFile("module_exports_template.mustache", String.format("./%s/%s/export.template", service, formatPackage(subService))));
                break;
            }
            case WS: {
                modelTemplateFiles.put("model_ws.mustache", ".ts");
                apiTemplateFiles.put("api_ws.mustache", ".ts");
                additionalProperties.put("WS_MODE", "true");
                supportingFiles.add(new SupportingFile("module.mustache", String.format("./%s/%s/index.ts", service, formatPackage(subService))));
                supportingFiles.add(new SupportingFile("module_exports_template.mustache", String.format("./%s/%s/export.template", service, formatPackage(subService))));
                break;
            }
            default:
                throw new RuntimeException("unsupported mode");
        }

        supportingFiles.add(new SupportingFile("version.mustache", "version.ts"));

        templateDir = "node-sdk";

        // override parent properties
        enablePostProcessFile = true;

        inlineSchemaOption.put("SKIP_SCHEMA_REUSE", "true");
    }

    @Override
    public void preprocessOpenAPI(OpenAPI openAPI) {
        super.preprocessOpenAPI(openAPI);

        // 过滤路径：只保留包含 MAIN 和 ALL 标签的操作
        filterPaths(openAPI);

        // parse and update operations and models
        schemaService = new SchemaServiceImpl(openAPI);
        operationService = new OperationServiceImpl(openAPI, this);

        operationService.parseOperation();
        schemaService.parseSchema();
    }

    /**
     * 过滤路径，只保留包含 MAIN 和 ALL 标签的操作
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
     * 检查操作是否包含 MAIN 和 ALL 标签
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
        CodegenProperty prop = super.fromProperty(name, p, required);
        if (prop.defaultValue != null && prop.defaultValue.equalsIgnoreCase("undefined")) {
            prop.defaultValue = null;
        }

        if (prop.isEnum) {
            List<EnumEntry> enums = new ArrayList<>();

            List<Map<String, Object>> enumList;
            if (prop.openApiType.equalsIgnoreCase("array")) {
                if (prop.mostInnerItems != null && prop.mostInnerItems.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.mostInnerItems.vendorExtensions.get("x-api-enum");
                } else {
                    enumList = null;
                }
            } else {
                if (prop.vendorExtensions != null) {
                    enumList = (List<Map<String, Object>>) prop.vendorExtensions.get("x-api-enum");
                } else {
                    enumList = null;
                }
            }

            // 如果 enumList 为空，从标准 OpenAPI enum 构建
            if (enumList == null || enumList.isEmpty()) {
                enumList = buildEnumListFromStandardOpenApiEnum(p, prop);
            }

            // 如果 enumList 仍然为空，创建一个空的列表避免 NPE
            if (enumList == null) {
                enumList = new ArrayList<>();
            }

            List<String> names = new ArrayList<>();
            List<String> values = new ArrayList<>();
            List<String> description = new ArrayList<>();

            for (Map<String, Object> e : enumList) {
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
                description.add(e.get("description") != null ? e.get("description").toString() : "");

                enums.add(new EnumEntry(enumName, enumValue, enumValueOriginal,
                        (String) e.get("description"), enumValueOriginal instanceof String));
            }

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
        return datatype + "." + value;
    }

    @Override
    public String getEnumDefaultValue(String defaultValue, String dataType) {
        return defaultValue;
    }

    @Override
    public String toModelName(String name) {
        String cleaned = cleanUsing(schemaService.getGeneratedModelName(name));
        return formatService(cleaned);
    }

    @Override
    public String toApiName(String name) {
        return camelize(name + "_" + (modeSwitch.isWs() ? "WS" : "API"));
    }

    @Override
    public String toModelFilename(String name) {
        name = cleanUsing(schemaService.getGeneratedModelName(name));
        name = underscore("model_" + name);
        return name;
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
    public String toApiFilename(String name) {
        String apiName = name.replaceAll("-", "_");
        switch (modeSwitch.getMode()) {
            case WS:
            case API:
            case ENTRY:
            case TEST_TEMPLATE: {
                apiName = "api_" + underscore(apiName);
                break;
            }
            case TEST: {
                apiName = "api_" + underscore(apiName) + ".test";
                break;
            }
            case WS_TEST: {
                apiName = "ws_" + underscore(apiName) + ".test";
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

    @Override
    public CodegenOperation fromOperation(String path, String httpMethod, Operation operation, List<Server> servers) {
        CodegenOperation result = super.fromOperation(path, httpMethod, operation, servers);
        if (httpMethod.equalsIgnoreCase("patch")) {
            result.httpMethod = (String) operation.getExtensions().get("x-original-method");
        }
        return result;
    }

    /**
     * 生成 API 导入语句
     */
    private void generateApiImport(Meta meta, boolean req, Map<String, ImportModel> imports) {
        switch (modeSwitch.getMode()) {
            case API:
            case TEST: {
                String suffix = "resp";
                if (req) {
                    suffix = "req";
                }
                String fileName = "./" + toModelFilename(meta.getMethod()) + "_" + suffix;
                String serviceName = formatService(meta.getMethod() + camelize(suffix));

                imports.computeIfAbsent(fileName, ImportModel::new).component.add(serviceName);
                break;
            }
            case WS: {
                String suffix = "event";
                String fileName = "./" + toModelFilename(meta.getMethod()) + "_" + suffix;
                String service1 = formatService(meta.getMethod() + camelize(suffix + "Callback"));
                String service2 = formatService(meta.getMethod() + camelize(suffix + "CallbackWrapper"));

                imports.computeIfAbsent(fileName, ImportModel::new).component.addAll(Arrays.asList(service1, service2));
                break;

            }
            case WS_TEST: {
                String suffix = "event";
                String fileName = "./" + toModelFilename(meta.getMethod()) + "_" + suffix;
                String serviceName = formatService(meta.getMethod() + camelize(suffix));
                imports.computeIfAbsent(fileName, ImportModel::new).component.add(serviceName);
                break;
            }
            case ENTRY: {
                operationService.getServiceMeta().forEach((k, v) -> {
                    if (v.getService().equalsIgnoreCase(meta.getService())) {
                        List<String> services = Arrays.asList(formatService(k + "API"), formatService(k + "APIImpl"));
                        String fileName = String.format("@generate/%s/%s/%s", formatPackage(v.getService()),
                                formatPackage(v.getSubService()), toApiFilename(sanitizeName(k)));
                        imports.computeIfAbsent(fileName, ImportModel::new).component.addAll(services);
                    }
                });
                break;
            }
            default: {
                throw new RuntimeException("unsupported mode");
            }
        }
    }

    private static List<File> getSubdirectories(File parentDir) {
        return Arrays.stream(Objects.requireNonNull(parentDir.listFiles(File::isDirectory)))
                .collect(Collectors.toList());
    }

    private static List<String> readExportTemplates(File parentDir) {
        List<File> subDirs = getSubdirectories(parentDir);
        List<String> contents = new LinkedList<>();

        for (File subDir : subDirs) {
            File templateFile = new File(subDir, "export.template");
            if (templateFile.exists()) {
                try {
                    String content = new String(Files.readAllBytes(templateFile.toPath())).trim();
                    if (!content.isEmpty()) {
                        contents.add(content + "\n");
                    }
                } catch (IOException e) {
                    throw new RuntimeException(e);
                }
            }
        }
        return contents;
    }

    private void generateValueExport(Meta meta, Set<String> export) {
        switch (modeSwitch.getMode()) {
            case API:
            case WS: {
                operationService.getServiceMeta().forEach((k, v) -> {
                    if (v.getService().equalsIgnoreCase(meta.getService())) {
                        export.add(String.format("export * from \"./%s\"", toApiFilename(sanitizeName(k))));
                    }
                });

                break;
            }
            case ENTRY: {
                List<Pair<String, String>> serviceAliases = new LinkedList<>();
                List<Pair<String, String>> typeAliases = new LinkedList<>();
                operationService.getServiceMeta().forEach((k, v) -> {
                    if (v.getService().equalsIgnoreCase(meta.getService())) {
                        String serviceAlias = v.getSubService().toUpperCase();
                        String exportService = camelize(v.getSubService(), CamelizeOption.UPPERCASE_FIRST_CHAR);

                        export.add(String.format("import * as %s from \"./%s\"", serviceAlias, formatPackage(v.getSubService())));
                        serviceAliases.add(Pair.of(exportService, serviceAlias));
                        typeAliases.add(Pair.of(serviceAlias, formatService(v.getSubService() + "_API")));
                    }
                });

                if (wsServices.contains(service.toLowerCase())) {
                    String privateService = service.toUpperCase() + "PRIVATE";
                    String publicService = service.toUpperCase() + "PUBLIC";

                    export.add(String.format("import * as %s from \"./%s\"", privateService, formatPackage(privateService)));
                    export.add(String.format("import * as %s from \"./%s\"", publicService, formatPackage(publicService)));

                    String exportService = camelize(service.toLowerCase(), CamelizeOption.UPPERCASE_FIRST_CHAR);

                    serviceAliases.add(Pair.of(exportService + "Private", privateService));
                    serviceAliases.add(Pair.of(exportService + "Public", publicService));

                    typeAliases.add(Pair.of(privateService, formatService(service + "PrivateWS")));
                    typeAliases.add(Pair.of(publicService, formatService(service + "PublicWS")));
                }

                String exportService = camelize(service.toLowerCase(), CamelizeOption.UPPERCASE_FIRST_CHAR);
                export.add(String.format("export const %s = \n{\n%s\n};", exportService,
                        serviceAliases.stream().map(s -> s.getKey() + ":" + s.getValue()).collect(Collectors.joining(",\n"))));

                List<String> exports = typeAliases.stream().map(s ->
                        " export type " + s.getValue() + " = " + s.getKey() + "." + s.getValue()).collect(Collectors.toList());

                String targetDir = outputFolder() + "/" + formatPackage(meta.getService());
                exports.addAll(readExportTemplates(new File(targetDir)));

                export.add(String.format("export namespace %s {\n%s\n}", exportService,
                        String.join(";\n", exports)));

                break;
            }
            case WS_TEST:
            case TEST: {
                // skip
                break;
            }
            default: {
                throw new RuntimeException("unsupported mode");
            }
        }
    }

    private void generateTypeExport(Meta meta, Set<String> export, List<ModelMap> allModels) {
        String service = meta.getService();
        String subService = meta.getSubService();

        List<String> exportEntry = new LinkedList<>();

        allModels.forEach(m -> {
            String modelName = (String) m.get("importPath");
            exportEntry.add(String.format("export type %s = %s.%s;", modelName, subService.toUpperCase(), modelName));
        });

        export.add(String.format("export namespace %s {\n%s\n}", subService, String.join("\n", exportEntry)));
    }

    @Override
    public OperationsMap postProcessOperationsWithModels(OperationsMap objs, List<ModelMap> allModels) {
        objs = super.postProcessOperationsWithModels(objs, allModels);

        OperationMap operationMap = objs.getOperations();

        Map<String, ImportModel> imports = new HashMap<>();

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
                                kv.put("target_service", formatService(k + "API"));
                                entryValue.add(kv);
                            }
                        });
                        Map<String, Object> apiEntryInfo = new HashMap<>();
                        apiEntryInfo.put("api_entry_name", formatService(meta.getService() + "Service"));
                        apiEntryInfo.put("api_entry_value", entryValue);
                        objs.put("api_entry", apiEntryInfo);
                        entryValue.forEach(m -> {
                            generateApiImport(meta, false, imports);
                            generateValueExport(meta, exports);
                        });
                        break;
                    }

                    case API:
                    case TEST: {
                        generateTypeExport(meta, serviceExportsTemplate, allModels);
                        allModels.forEach(m -> {
                            String path = (String) m.get("importPath");
                            path = toModelFilename(path);
                            exports.add(String.format("export * from \"./%s\"", path));
                        });

                        if (op.hasParams) {
                            generateApiImport(meta, true, imports);
                        }
                        generateApiImport(meta, false, imports);
                        generateValueExport(meta, exports);
                        break;
                    }
                    case WS:
                    case WS_TEST: {
                        generateTypeExport(meta, serviceExportsTemplate, allModels);
                        generateApiImport(meta, false, imports);
                        allModels.forEach(m -> {
                            String path = (String) m.get("importPath");
                            path = toModelFilename(path);
                            exports.add(String.format("export * from \"./%s\"", path));
                        });
                        generateValueExport(meta, exports);
                        break;
                    }
                    case TEST_TEMPLATE: {
                        String reqName = meta.getMethodServiceFmt().toLowerCase() + "Req";
                        String responseName = meta.getMethodServiceFmt().toLowerCase() + "Resp";
                        allModels.stream().filter(m -> reqName.equalsIgnoreCase((String) m.get("importPath")))
                                .forEach(m -> op.vendorExtensions.put("x-request-model", m.getModel()));
                        allModels.stream().filter(m -> responseName.equalsIgnoreCase((String) m.get("importPath")))
                                .forEach(m -> op.vendorExtensions.put("x-response-model", m.getModel()));
                        break;
                    }
                }
            }
        }

        // 对导入进行排序，保证生成结果稳定
        List<String> sortedImports = imports.values().stream()
                .map(ImportModel::toImport)
                .sorted()
                .collect(Collectors.toList());
        objs.put("imports", sortedImports);

        // 保存 exports 到 additionalProperties
        List<String> sortedExports = new ArrayList<>(exports);
        Collections.sort(sortedExports);
        additionalProperties.put("exports", sortedExports);

        return objs;
    }

    private String getInnerModelType(CodegenProperty p) {
        if (p.isArray || p.isMap) {
            return getInnerModelType(p.getItems());
        }

        if (p.isModel) {
            return p.getDataType();
        }

        return null;
    }

    @Override
    public ModelsMap postProcessModels(ModelsMap objs) {
        objs = super.postProcessModels(objs);

        Map<String, ImportModel> imports = new HashMap<>();

        List<ModelMap> models = objs.getModels();
        if (models != null) {
            for (ModelMap model : models) {
                CodegenModel codegenModel = model.getModel();
                if (codegenModel != null) {

                    imports.computeIfAbsent("class-transformer", ImportModel::new)
                            .component.addAll(Arrays.asList("plainToClassFromExist", "instanceToPlain"));

                    if (codegenModel.getVendorExtensions().containsKey("x-response-model")) {
                        imports.computeIfAbsent("class-transformer", ImportModel::new).component.add("Exclude");
                    }

                    for (CodegenProperty var : codegenModel.getVars()) {

                        String innerType = getInnerModelType(var);

                        if (innerType != null) {
                            String modelName = "./" + toModelFilename(innerType);
                            imports.computeIfAbsent(modelName, ImportModel::new).component.add(innerType);
                            imports.computeIfAbsent("class-transformer", ImportModel::new).component.add("Type");
                            var.vendorExtensions.put("x-typed", String.format("@Type(() => %s)", innerType));
                        }

                        if (var.getBaseName() != null && !var.getName().equals(var.getBaseName())) {
                            var.vendorExtensions.put("x-use-base-name", true);
                            imports.computeIfAbsent("class-transformer", ImportModel::new).component.add("Expose");
                        }

                        if (var.getVendorExtensions().containsKey("x-tag-path")) {
                            imports.computeIfAbsent("reflect-metadata", ImportModel::new);
                        }
                    }

                    // 对导入进行排序
                    List<String> sortedImports = imports.values().stream()
                            .map(ImportModel::toImport)
                            .sorted()
                            .collect(Collectors.toList());
                    codegenModel.getVendorExtensions().put("x-imports", sortedImports);
                }
            }
        }
        return objs;
    }

    @Override
    public Map<String, ModelsMap> postProcessAllModels(Map<String, ModelsMap> objs) {
        final Map<String, ModelsMap> processed = super.postProcessAllModels(objs);

        // 构建 circularImports 映射，用于处理循环引用
        for (Map.Entry<String, ModelsMap> entry : processed.entrySet()) {
            for (ModelMap model : entry.getValue().getModels()) {
                CodegenModel codegenModel = model.getModel();
                if (codegenModel != null) {
                    String modelName = codegenModel.classname;
                    Set<String> imports = new HashSet<>();
                    circularImports.put(modelName, imports);

                    // 收集该模型引用的其他模型
                    for (CodegenProperty prop : codegenModel.vars) {
                        String refModelName = getReferencedModelName(prop);
                        if (refModelName != null && !refModelName.equals(modelName)) {
                            imports.add(refModelName);
                        }
                    }
                }
            }
        }

        return processed;
    }

    private String getReferencedModelName(CodegenProperty prop) {
        if (prop == null) {
            return null;
        }

        if (prop.isArray) {
            return getReferencedModelName(prop.items);
        }

        if (prop.isMap) {
            return getReferencedModelName(prop.items);
        }

        if (prop.isModel && !prop.isPrimitiveType) {
            return prop.getDataType();
        }

        return null;
    }

    private String cleanUsing(String name) {
        if (name == null) {
            return null;
        }


        String result = name.replaceAll("(?i)Using(?:GET|POST|PUT|DELETE|PATCH)(.*?)(Response|Req|Event|Data)", "$2");
        result = result.replaceAll("(?i)_using_(?:get|post|put|delete|patch)\\d*", "");
        result = result.replaceAll("_\\d+_200", "");
        result = result.replaceAll("_200", "");

        result = result.replaceAll("__+", "_");

        return result;
    }
}
