package com.kucoin.universal.sdk.plugin.util;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
import io.swagger.v3.oas.models.parameters.Parameter;
import io.swagger.v3.oas.models.responses.ApiResponse;
import io.swagger.v3.oas.models.responses.ApiResponses;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.StringUtils;

import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.*;

@Slf4j
public class NodeAutoCasesGenerator {

    private static final ObjectMapper mapper = new ObjectMapper();

    private static final boolean LOCAL_DEV_MODE = true;

    public static void generate(OpenAPI openAPI, String outputPath) throws Exception {
        List<ApiInfo> apiList = parseOpenAPI(openAPI);
        generateAutoCases(apiList, outputPath);
    }

    private static List<ApiInfo> parseOpenAPI(OpenAPI openAPI) {
        List<ApiInfo> apiList = new ArrayList<>();

        Paths paths = openAPI.getPaths();
        if (paths == null) {
            return apiList;
        }

        for (Map.Entry<String, PathItem> pathEntry : paths.entrySet()) {
            String path = pathEntry.getKey();
            PathItem pathItem = pathEntry.getValue();

            for (Map.Entry<PathItem.HttpMethod, Operation> opEntry : pathItem.readOperationsMap().entrySet()) {
                Operation operation = opEntry.getValue();
                if (hasMainAndAllTags(operation)) {
                    String httpMethod = opEntry.getKey().name().toLowerCase();
                    ApiInfo info = extractApiInfo(path, httpMethod, operation);
                    if (info != null) {
                        apiList.add(info);
                    }
                }
            }
        }

        return apiList;
    }

    private static boolean hasMainAndAllTags(Operation operation) {
        List<String> tags = operation.getTags();
        if (tags == null || tags.isEmpty()) {
            return false;
        }
        return tags.contains("MAIN") && tags.contains("ALL");
    }

    private static ApiInfo extractApiInfo(String path, String httpMethod, Operation operation) {
        Map<String, Object> extensions = operation.getExtensions();
        if (extensions == null) {
            return null;
        }

        String service = getExtensionString(extensions, "x-sdk-service");
        String subService = getExtensionString(extensions, "x-sdk-sub-service");
        String methodName = getExtensionString(extensions, "x-sdk-method-name");

        if (StringUtils.isEmpty(service) || StringUtils.isEmpty(subService) || StringUtils.isEmpty(methodName)) {
            log.warn("Missing x-sdk-* extensions for path: {}, method: {}", path, httpMethod);
            return null;
        }

        ApiInfo info = new ApiInfo();
        info.path = path;
        info.httpMethod = httpMethod.toLowerCase();
        info.service = service;
        info.subService = subService;
        info.methodName = methodName;

        info.requestClassName = capitalizeFirst(methodName) + "Req";
        info.responseClassName = capitalizeFirst(methodName) + "Resp";
        info.namespace = capitalizeFirst(service) + "." + capitalizeFirst(subService);
        info.hasRequest = hasRequestParams(operation, httpMethod);

        info.expects = extractExpects(operation);
        info.requestExample = extractRequestExample(operation, httpMethod);
        info.fieldTypes = extractFieldTypes(operation, httpMethod);
        info.fieldEnumTypes = extractFieldEnumTypes(operation, httpMethod, info.requestClassName);

        return info;
    }

    private static Map<String, Object> extractRequestExample(Operation operation, String httpMethod) {
        Map<String, Object> example = new LinkedHashMap<>();

        if ("get".equalsIgnoreCase(httpMethod) || "delete".equalsIgnoreCase(httpMethod)) {
            List<Parameter> parameters = operation.getParameters();
            if (parameters != null) {
                for (Parameter param : parameters) {
                    String name = param.getName();
                    if (StringUtils.isNotEmpty(name)) {
                        Object value = param.getExample();
                        if (value == null && param.getSchema() != null) {
                            value = param.getSchema().getExample();
                        }
                        if (value != null) {
                            example.put(name, value);
                        }
                    }
                }
            }
        } else if ("post".equalsIgnoreCase(httpMethod) || "put".equalsIgnoreCase(httpMethod)) {
            var requestBody = operation.getRequestBody();
            if (requestBody != null) {
                var content = requestBody.getContent();
                if (content != null) {
                    var mediaType = content.get("application/json");
                    if (mediaType != null) {
                        var examples = mediaType.getExamples();
                        if (examples != null && !examples.isEmpty()) {
                            var firstExample = examples.values().iterator().next();
                            if (firstExample != null) {
                                var value = firstExample.getValue();
                                if (value != null) {
                                    try {
                                        JsonNode node = mapper.readTree(value.toString());
                                        if (node.isObject()) {
                                            Iterator<Map.Entry<String, JsonNode>> fields = node.fields();
                                            while (fields.hasNext()) {
                                                Map.Entry<String, JsonNode> field = fields.next();
                                                String key = field.getKey();
                                                JsonNode fieldValue = field.getValue();
                                                if (fieldValue.isArray() || fieldValue.isObject()) {
                                                    example.put(key, fieldValue.toString());
                                                } else {
                                                    example.put(key, fieldValue.asText());
                                                }
                                            }
                                        }
                                    } catch (Exception e) {
                                        log.warn("Failed to parse example: {}", e.getMessage());
                                    }
                                }
                            }
                        }
                        if (example.isEmpty()) {
                            var exampleObj = mediaType.getExample();
                            if (exampleObj != null) {
                                try {
                                    JsonNode node = mapper.readTree(exampleObj.toString());
                                    if (node.isObject()) {
                                        Iterator<Map.Entry<String, JsonNode>> fields = node.fields();
                                        while (fields.hasNext()) {
                                            Map.Entry<String, JsonNode> field = fields.next();
                                            String key = field.getKey();
                                            JsonNode fieldValue = field.getValue();
                                            if (fieldValue.isArray() || fieldValue.isObject()) {
                                                example.put(key, fieldValue.toString());
                                            } else {
                                                example.put(key, fieldValue.asText());
                                            }
                                        }
                                    }
                                } catch (Exception e) {
                                    log.warn("Failed to parse example: {}", e.getMessage());
                                }
                            }
                        }
                    }
                }
            }
        }

        return example;
    }

    private static Map<String, String> extractFieldTypes(Operation operation, String httpMethod) {
        Map<String, String> fieldTypes = new LinkedHashMap<>();

        try {
            if ("get".equalsIgnoreCase(httpMethod) || "delete".equalsIgnoreCase(httpMethod)) {
                List<Parameter> parameters = operation.getParameters();
                if (parameters != null) {
                    for (Parameter param : parameters) {
                        String name = param.getName();
                        if (StringUtils.isNotEmpty(name) && param.getSchema() != null) {
                            String type = param.getSchema().getType();
                            if (type != null) {
                                // 检查是否是数组
                                if ("array".equals(type)) {
                                    fieldTypes.put(name, "array");
                                } else {
                                    fieldTypes.put(name, type);
                                }
                            }
                        }
                    }
                }
            } else if ("post".equalsIgnoreCase(httpMethod) || "put".equalsIgnoreCase(httpMethod)) {
                var requestBody = operation.getRequestBody();
                if (requestBody != null) {
                    var content = requestBody.getContent();
                    if (content != null) {
                        var mediaType = content.get("application/json");
                        if (mediaType != null) {
                            var schema = mediaType.getSchema();
                            if (schema != null) {
                                var properties = schema.getProperties();
                                if (properties != null) {
                                    Iterator<?> iterator = properties.entrySet().iterator();
                                    while (iterator.hasNext()) {
                                        Map.Entry<?, ?> entry = (Map.Entry<?, ?>) iterator.next();
                                        Object keyObj = entry.getKey();
                                        Object valueObj = entry.getValue();
                                        if (keyObj instanceof String && valueObj instanceof io.swagger.v3.oas.models.media.Schema) {
                                            String propName = (String) keyObj;
                                            io.swagger.v3.oas.models.media.Schema propSchema = (io.swagger.v3.oas.models.media.Schema) valueObj;
                                            String type = propSchema.getType();
                                            if (type != null) {
                                                // 检查是否是数组
                                                if ("array".equals(type)) {
                                                    fieldTypes.put(propName, "array");
                                                } else {
                                                    fieldTypes.put(propName, type);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception e) {
            log.warn("Failed to extract field types: {}", e.getMessage());
        }

        return fieldTypes;
    }

    /**
     * 提取枚举类型信息
     */
    private static Map<String, String> extractFieldEnumTypes(Operation operation, String httpMethod, String requestClassName) {
        Map<String, String> fieldEnumTypes = new LinkedHashMap<>();

        try {
            if ("get".equalsIgnoreCase(httpMethod) || "delete".equalsIgnoreCase(httpMethod)) {
                List<Parameter> parameters = operation.getParameters();
                if (parameters != null) {
                    for (Parameter param : parameters) {
                        String name = param.getName();
                        if (StringUtils.isNotEmpty(name) && param.getSchema() != null) {
                            if (param.getSchema().getEnum() != null && !param.getSchema().getEnum().isEmpty()) {
                                fieldEnumTypes.put(name, requestClassName + "." + capitalizeFirst(name) + "Enum");
                            }
                        }
                    }
                }
            } else if ("post".equalsIgnoreCase(httpMethod) || "put".equalsIgnoreCase(httpMethod)) {
                var requestBody = operation.getRequestBody();
                if (requestBody != null) {
                    var content = requestBody.getContent();
                    if (content != null) {
                        var mediaType = content.get("application/json");
                        if (mediaType != null) {
                            var schema = mediaType.getSchema();
                            if (schema != null) {
                                var properties = schema.getProperties();
                                if (properties != null) {
                                    Iterator<?> iterator = properties.entrySet().iterator();
                                    while (iterator.hasNext()) {
                                        Map.Entry<?, ?> entry = (Map.Entry<?, ?>) iterator.next();
                                        Object keyObj = entry.getKey();
                                        Object valueObj = entry.getValue();
                                        if (keyObj instanceof String && valueObj instanceof io.swagger.v3.oas.models.media.Schema) {
                                            String propName = (String) keyObj;
                                            io.swagger.v3.oas.models.media.Schema propSchema = (io.swagger.v3.oas.models.media.Schema) valueObj;
                                            if (propSchema.getEnum() != null && !propSchema.getEnum().isEmpty()) {
                                                fieldEnumTypes.put(propName, requestClassName + "." + capitalizeFirst(propName) + "Enum");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception e) {
            log.warn("Failed to extract enum types: {}", e.getMessage());
        }

        return fieldEnumTypes;
    }

    private static Map<String, String> extractExpects(Operation operation) {
        Map<String, String> expects = new LinkedHashMap<>();
        expects.put("$.commonResponse.code", "200000");
        String responseAssert = extractResponseAssert(operation);
        expects.put("$", responseAssert);
        return expects;
    }

    private static String extractResponseAssert(Operation operation) {
        ApiResponses responses = operation.getResponses();
        if (responses == null) {
            return ":notnull";
        }

        ApiResponse response200 = responses.get("200");
        if (response200 == null) {
            return ":notnull";
        }

        JsonNode example = extractExample(response200);
        if (example == null) {
            return ":notnull";
        }

        if (example.isArray()) {
            return example.size() > 0 ? ":isnotempty" : ":isempty";
        } else {
            return ":notnull";
        }
    }

    private static JsonNode extractExample(ApiResponse response) {
        try {
            var content = response.getContent();
            if (content == null) {
                return null;
            }

            var mediaType = content.get("application/json");
            if (mediaType == null) {
                return null;
            }

            var examples = mediaType.getExamples();
            if (examples != null && !examples.isEmpty()) {
                var firstExample = examples.values().iterator().next();
                if (firstExample != null) {
                    var value = firstExample.getValue();
                    if (value != null) {
                        return mapper.readTree(value.toString());
                    }
                }
            }

            var example = mediaType.getExample();
            if (example != null) {
                return mapper.readTree(example.toString());
            }

            return null;
        } catch (Exception e) {
            log.warn("Failed to extract example from response: {}", e.getMessage());
            return null;
        }
    }

    private static String capitalizeFirst(String str) {
        if (StringUtils.isEmpty(str)) {
            return str;
        }
        return str.substring(0, 1).toUpperCase() + str.substring(1);
    }

    private static String toCamelCase(String str) {
        if (StringUtils.isEmpty(str)) {
            return str;
        }
        StringBuilder result = new StringBuilder();
        boolean capitalizeNext = false;
        for (int i = 0; i < str.length(); i++) {
            char c = str.charAt(i);
            if (c == '_') {
                capitalizeNext = true;
            } else {
                if (capitalizeNext) {
                    result.append(Character.toUpperCase(c));
                    capitalizeNext = false;
                } else {
                    result.append(c);
                }
            }
        }
        return result.toString();
    }

    private static boolean hasRequestParams(Operation operation, String httpMethod) {
        if ("get".equalsIgnoreCase(httpMethod) || "delete".equalsIgnoreCase(httpMethod)) {
            return operation.getParameters() != null && !operation.getParameters().isEmpty();
        } else if ("post".equalsIgnoreCase(httpMethod) || "put".equalsIgnoreCase(httpMethod)) {
            return operation.getRequestBody() != null;
        }
        return false;
    }

    private static String getExtensionString(Map<String, Object> extensions, String key) {
        Object value = extensions.get(key);
        if (value == null) {
            return null;
        }
        return value.toString();
    }

    private static String getServiceGetter(String service) {
        return "get" + capitalizeFirst(service.toLowerCase()) + "Service";
    }

    private static String getApiGetter(String subService) {
        return "get" + capitalizeFirst(subService) + "Api";
    }

    private static String getApiVariableName(String subService) {
        return subService.toLowerCase() + "Api";
    }

    private static String generateMethodName(String path, String httpMethod, String methodName, Map<String, Integer> nameCounter) {
        String prefix = httpMethod.toLowerCase();
        String baseName = prefix + "Create" + capitalizeFirst(toCamelCase(methodName)) + "Request";

        if (nameCounter.containsKey(baseName)) {
            int count = nameCounter.get(baseName) + 1;
            nameCounter.put(baseName, count);
            return baseName + count;
        } else {
            nameCounter.put(baseName, 1);
            return baseName;
        }
    }

    private static String formatValueForTypeScript(Object value, String fieldType, String enumClassName) {
        if (value == null) {
            return "undefined";
        }

        if (enumClassName != null && !enumClassName.isEmpty()) {
            String enumValue = value.toString();
            enumValue = enumValue.toUpperCase();
            if (enumValue.matches("^\\d.*$")) {
                enumValue = "_" + enumValue;
            }
            return enumClassName + "." + enumValue;
        }

        if ("boolean".equals(fieldType) || "bool".equals(fieldType)) {
            boolean boolValue = false;
            if (value instanceof Boolean) {
                boolValue = (Boolean) value;
            } else if (value instanceof String) {
                boolValue = "true".equalsIgnoreCase((String) value);
            }
            return boolValue ? "true" : "false";
        }

        if ("integer".equals(fieldType) || "number".equals(fieldType)) {
            return value.toString();
        }

        if (value instanceof String) {
            String strValue = (String) value;
            if ((strValue.startsWith("[") && strValue.endsWith("]")) ||
                    (strValue.startsWith("{") && strValue.endsWith("}"))) {
                return strValue;
            }
            return "\"" + escapeString(strValue) + "\"";
        }

        if (value instanceof Number) {
            return value.toString();
        }

        if (value instanceof Boolean) {
            return (Boolean) value ? "true" : "false";
        }

        return "\"" + escapeString(value.toString()) + "\"";
    }

    private static String escapeString(String str) {
        if (str == null) {
            return "";
        }
        return str.replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t");
    }

    private static void generateAutoCases(List<ApiInfo> apiList, String outputPath) throws Exception {

        try (PrintWriter out = new PrintWriter(new FileWriter(outputPath))) {

            out.println("// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.");
            out.println();
            out.println("// ============================================================");
            out.println("// LOCAL DEV MODE: Using relative imports for local debugging");
            out.println("// To use published package, change LOCAL_DEV_MODE to false");
            out.println("// ============================================================");
            out.println();

            if (LOCAL_DEV_MODE) {
                out.println("import {");
                out.println("    ClientOptionBuilder,");
                out.println("    DefaultClient,");
                out.println("    GlobalApiEndpoint,");
                out.println("    GlobalBrokerApiEndpoint,");
                out.println("    GlobalFuturesApiEndpoint,");
                out.println("    TransportOptionBuilder");
                out.println("} from '../';");
                out.println();
            } else {
                out.println("import {");
                out.println("    ClientOptionBuilder,");
                out.println("    DefaultClient,");
                out.println("    GlobalApiEndpoint,");
                out.println("    GlobalBrokerApiEndpoint,");
                out.println("    GlobalFuturesApiEndpoint,");
                out.println("    TransportOptionBuilder");
                out.println("} from 'kucoin-universal-sdk';");
                out.println();
            }

            // 收集所有唯一的服务名，从顶层导入
            Set<String> uniqueServices = new TreeSet<>();
            for (ApiInfo api : apiList) {
                uniqueServices.add(capitalizeFirst(api.service));
            }

            for (String service : uniqueServices) {
                if (LOCAL_DEV_MODE) {
                    out.println("import { " + service + " } from './" + service.toLowerCase() + "';");
                } else {
                    out.println("import { " + service + " } from 'kucoin-universal-sdk';");
                }
            }

            out.println();
            out.println();

            // AutoCases 类
            out.println("export class AutoCases {");
            out.println("    private routeMap: Map<string, (request?: any) => Promise<any>> = new Map();");
            out.println("    private expectMap: Map<string, Record<string, string>> = new Map();");
            out.println("    private restService: any;");
            out.println();
            out.println("    constructor(client: DefaultClient) {");
            out.println("        this.restService = client.restService();");
            out.println("        this.initRouteMap();");
            out.println("        this.initExpectMap();");
            out.println("    }");
            out.println();

            // initRouteMap
            out.println("    private initRouteMap(): void {");

            Map<String, String> apiVariables = new LinkedHashMap<>();
            for (ApiInfo api : apiList) {
                String serviceName = api.service;
                String subServiceName = api.subService;
                String apiVarName = getApiVariableName(subServiceName);

                String serviceGetter = getServiceGetter(serviceName);
                String apiGetter = getApiGetter(subServiceName);

                if (!apiVariables.containsKey(apiVarName)) {
                    out.println("        const " + apiVarName + " = this.restService." + serviceGetter + "()." + apiGetter + "();");
                    apiVariables.put(apiVarName, apiVarName);
                }
            }

            out.println();

            for (ApiInfo api : apiList) {
                String apiVarName = getApiVariableName(api.subService);
                String methodCall = toCamelCase(api.methodName);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        const handler" + capitalizeFirst(toCamelCase(api.methodName)) + " = async (request?: any): Promise<any> => {");

                if (api.hasRequest) {
                    out.println("            if (!request) {");
                    out.println("                throw new Error(`Request is required for " + routeKey + "`);");
                    out.println("            }");
                    out.println("            return " + apiVarName + "." + methodCall + "(request);");
                } else {
                    out.println("            return " + apiVarName + "." + methodCall + "();");
                }
                out.println("        };");
                out.println("        this.routeMap.set(\"" + routeKey + "\", handler" + capitalizeFirst(toCamelCase(api.methodName)) + ");");
                out.println();
            }

            out.println("    }");
            out.println();

            // initExpectMap
            out.println("    private initExpectMap(): void {");

            int index = 0;
            for (ApiInfo api : apiList) {
                String varName = "expects" + (index == 0 ? "" : String.valueOf(index));
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        const " + varName + ": Record<string, string> = {");
                for (Map.Entry<String, String> expect : api.expects.entrySet()) {
                    out.println("            \"" + expect.getKey() + "\": \"" + expect.getValue() + "\",");
                }
                out.println("        };");
                out.println("        this.expectMap.set(\"" + routeKey + "\", " + varName + ");");
                out.println();
                index++;
            }

            out.println("    }");
            out.println();

            // 预置请求方法
            out.println("    // ==================== Predefined Request Methods ====================");
            out.println();

            for (ApiInfo api : apiList) {
                if (api.requestExample == null || api.requestExample.isEmpty()) {
                    continue;
                }

                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, new HashMap<>());
                String ns = api.namespace;
                String requestClassName = api.requestClassName;

                out.println("    " + methodName + "(): " + ns + "." + requestClassName + " {");
                out.println("        // Create request by builder pattern");
                out.println("        let builder = " + ns + "." + requestClassName + ".builder();");

                for (Map.Entry<String, Object> entry : api.requestExample.entrySet()) {
                    String key = entry.getKey();
                    Object value = entry.getValue();
                    String fieldName = toCamelCase(key);
                    String fieldType = api.fieldTypes.get(key);

                    // 获取枚举类名 - 只从 fieldEnumTypes 获取，不做猜测
                    String enumClassName = null;
                    if (api.fieldEnumTypes != null && api.fieldEnumTypes.containsKey(key)) {
                        enumClassName = api.fieldEnumTypes.get(key);
                        // 加上命名空间前缀
                        if (enumClassName != null && !enumClassName.startsWith(ns + ".")) {
                            enumClassName = ns + "." + enumClassName;
                        }
                    }

                    String formattedValue;
                    // 处理数组类型的字段
                    if ("list".equals(key) && value instanceof String) {
                        formattedValue = convertJsonArrayToBuilders((String) value, ns, "SetRateLimitList");
                    } else {
                        formattedValue = formatValueForTypeScript(value, fieldType, enumClassName);
                    }

                    String setterName = "set" + capitalizeFirst(fieldName);
                    out.println("        builder = builder." + setterName + "(" + formattedValue + ");");
                }

                out.println("        return builder.build();");
                out.println("    }");
                out.println();
            }

            out.println("    public safeToDict(obj: any): any {");
            out.println("        if (obj === null || obj === undefined) {");
            out.println("            return null;");
            out.println("        }");
            out.println("        if (typeof obj === 'object' && obj.constructor === Object) {");
            out.println("            const result: Record<string, any> = {};");
            out.println("            for (const [key, value] of Object.entries(obj)) {");
            out.println("                if (!key.startsWith('_') && typeof value !== 'function') {");
            out.println("                    result[key] = this.safeToDict(value);");
            out.println("                }");
            out.println("            }");
            out.println("            return result;");
            out.println("        }");
            out.println("        if (Array.isArray(obj)) {");
            out.println("            return obj.map(item => this.safeToDict(item));");
            out.println("        }");
            out.println("        if (typeof obj === 'object' && obj !== null) {");
            out.println("            const result: Record<string, any> = {};");
            out.println("            const proto = Object.getPrototypeOf(obj);");
            out.println("            for (const key of Object.keys(obj)) {");
            out.println("                if (!key.startsWith('_') && typeof obj[key] !== 'function') {");
            out.println("                    result[key] = this.safeToDict(obj[key]);");
            out.println("                }");
            out.println("            }");
            out.println("            for (const key of Object.getOwnPropertyNames(proto)) {");
            out.println("                if (!key.startsWith('_') && key !== 'constructor' && typeof obj[key] !== 'function') {");
            out.println("                    const descriptor = Object.getOwnPropertyDescriptor(proto, key);");
            out.println("                    if (descriptor && descriptor.get) {");
            out.println("                        try {");
            out.println("                            result[key] = this.safeToDict(obj[key]);");
            out.println("                        } catch (e) {");
            out.println("                            // Ignore getter errors");
            out.println("                        }");
            out.println("                    }");
            out.println("                }");
            out.println("            }");
            out.println("            return result;");
            out.println("        }");
            out.println("        return obj;");
            out.println("    }");
            out.println();

            // toSnakeCase 辅助方法
            out.println("    private toSnakeCase(name: string): string {");
            out.println("        if (!name) {");
            out.println("            return name;");
            out.println("        }");
            out.println("        return name.replace(/([A-Z])/g, (match, p1, offset) => {");
            out.println("            return (offset > 0 ? '_' : '') + p1.toLowerCase();");
            out.println("        });");
            out.println("    }");
            out.println();

            // extractValueByPath
            out.println("    private extractValueByPath(data: any, path: string): any {");
            out.println("        if (path === '$') {");
            out.println("            return data;");
            out.println("        }");
            out.println("        if (path === '$.commonResponse.code' || path === '$.code' || path === '$.common_response.code') {");
            out.println("            const possibleKeys = ['commonResponse', 'common_response', 'CommonResponse'];");
            out.println("            for (const key of possibleKeys) {");
            out.println("                if (data && data[key] && typeof data[key] === 'object') {");
            out.println("                    if (data[key].code !== undefined) {");
            out.println("                        return data[key].code;");
            out.println("                    }");
            out.println("                }");
            out.println("            }");
            out.println("            if (data && data.code !== undefined) {");
            out.println("                return data.code;");
            out.println("            }");
            out.println("            return null;");
            out.println("        }");
            out.println("        const parts = path.substring(2).split('.');");
            out.println("        let current = data;");
            out.println("        for (const part of parts) {");
            out.println("            if (current === null || current === undefined) {");
            out.println("                return null;");
            out.println("            }");
            out.println("            if (typeof current === 'object') {");
            out.println("                let found = false;");
            out.println("                if (current[part] !== undefined) {");
            out.println("                    current = current[part];");
            out.println("                    found = true;");
            out.println("                } else {");
            out.println("                    const partLower = part.toLowerCase();");
            out.println("                    for (const key of Object.keys(current)) {");
            out.println("                        if (key.toLowerCase() === partLower) {");
            out.println("                            current = current[key];");
            out.println("                            found = true;");
            out.println("                            break;");
            out.println("                        }");
            out.println("                    }");
            out.println("                    if (!found) {");
            out.println("                        const snakePart = this.toSnakeCase(part);");
            out.println("                        if (current[snakePart] !== undefined) {");
            out.println("                            current = current[snakePart];");
            out.println("                            found = true;");
            out.println("                        }");
            out.println("                    }");
            out.println("                }");
            out.println("                if (!found) {");
            out.println("                    return null;");
            out.println("                }");
            out.println("            } else {");
            out.println("                return null;");
            out.println("            }");
            out.println("        }");
            out.println("        return current;");
            out.println("    }");
            out.println();

            // assertValue
            out.println("    private assertValue(actual: any, expected: string, jsonPath: string): void {");
            out.println("        if (expected.startsWith(':')) {");
            out.println("            const operator = expected.substring(1);");
            out.println("            switch (operator) {");
            out.println("                case 'notnull':");
            out.println("                    if (actual === null || actual === undefined) {");
            out.println("                        throw new Error(`${jsonPath} should not be null, but was null`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isnull':");
            out.println("                    if (actual !== null && actual !== undefined) {");
            out.println("                        throw new Error(`${jsonPath} should be null, but was: ${JSON.stringify(actual)}`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isempty':");
            out.println("                    if (actual === null || actual === undefined) {");
            out.println("                        return;");
            out.println("                    }");
            out.println("                    if (Array.isArray(actual) && actual.length !== 0) {");
            out.println("                        throw new Error(`${jsonPath} should be empty array, but size: ${actual.length}`);");
            out.println("                    } else if (typeof actual === 'object' && Object.keys(actual).length !== 0) {");
            out.println("                        throw new Error(`${jsonPath} should be empty object, but size: ${Object.keys(actual).length}`);");
            out.println("                    } else if (typeof actual === 'string' && actual !== '') {");
            out.println("                        throw new Error(`${jsonPath} should be empty string, but was: ${actual}`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isnotempty':");
            out.println("                    if (actual === null || actual === undefined) {");
            out.println("                        throw new Error(`${jsonPath} should not be null`);");
            out.println("                    }");
            out.println("                    if (Array.isArray(actual) && actual.length === 0) {");
            out.println("                        throw new Error(`${jsonPath} should not be empty array`);");
            out.println("                    } else if (typeof actual === 'object' && Object.keys(actual).length === 0) {");
            out.println("                        throw new Error(`${jsonPath} should not be empty object`);");
            out.println("                    } else if (typeof actual === 'string' && actual === '') {");
            out.println("                        throw new Error(`${jsonPath} should not be empty string`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'gtzero':");
            out.println("                    if (actual === null || actual === undefined) {");
            out.println("                        throw new Error(`${jsonPath} should not be null`);");
            out.println("                    }");
            out.println("                    if (typeof actual === 'number' && actual <= 0) {");
            out.println("                        throw new Error(`${jsonPath} should be > 0, but was: ${actual}`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'gezero':");
            out.println("                    if (actual === null || actual === undefined) {");
            out.println("                        throw new Error(`${jsonPath} should not be null`);");
            out.println("                    }");
            out.println("                    if (typeof actual === 'number' && actual < 0) {");
            out.println("                        throw new Error(`${jsonPath} should be >= 0, but was: ${actual}`);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                default:");
            out.println("                    throw new Error(`Unknown operator: ${operator}`);");
            out.println("            }");
            out.println("        } else {");
            out.println("            if (actual === null || actual === undefined) {");
            out.println("                throw new Error(`${jsonPath} should be '${expected}', but was null`);");
            out.println("            }");
            out.println("            if (String(actual) !== expected) {");
            out.println("                throw new Error(`${jsonPath} expected: '${expected}', but was: '${String(actual)}'`);");
            out.println("            }");
            out.println("        }");
            out.println("    }");
            out.println();

            // executeWithAssert
            out.println("    async executeWithAssert(routeKey: string, request?: any): Promise<any> {");
            out.println("        if (!this.routeMap.has(routeKey)) {");
            out.println("            throw new Error(`No route found for: ${routeKey}`);");
            out.println("        }");
            out.println("        const handler = this.routeMap.get(routeKey)!;");
            out.println("        const response = await handler(request);");
            out.println("        if (this.expectMap.has(routeKey)) {");
            out.println("            const expects = this.expectMap.get(routeKey)!;");
            out.println("            const responseDict = this.safeToDict(response);");
            out.println("            for (const [jsonPath, expectedValue] of Object.entries(expects)) {");
            out.println("                const actualValue = this.extractValueByPath(responseDict, jsonPath);");
            out.println("                this.assertValue(actualValue, expectedValue, jsonPath);");
            out.println("            }");
            out.println("        }");
            out.println("        return response;");
            out.println("    }");
            out.println("}");
            out.println();

            // 导出测试函数
            out.println("export async function runAutoCases(): Promise<void> {");
            out.println("    const key = process.env.API_KEY || '';");
            out.println("    const secret = process.env.API_SECRET || '';");
            out.println("    const passphrase = process.env.API_PASSPHRASE || '';");
            out.println();
            out.println("    if (!key || !secret || !passphrase) {");
            out.println("        console.error('Please set API_KEY, API_SECRET, API_PASSPHRASE environment variables');");
            out.println("        return;");
            out.println("    }");
            out.println();
            out.println("    const httpTransportOption = new TransportOptionBuilder()");
            out.println("        .setKeepAlive(true)");
            out.println("        .setMaxConnsPerHost(10)");
            out.println("        .setMaxIdleConns(10)");
            out.println("        .build();");
            out.println();
            out.println("    const clientOption = new ClientOptionBuilder()");
            out.println("        .setKey(key)");
            out.println("        .setSecret(secret)");
            out.println("        .setPassphrase(passphrase)");
            out.println("        .setSpotEndpoint(GlobalApiEndpoint)");
            out.println("        .setFuturesEndpoint(GlobalFuturesApiEndpoint)");
            out.println("        .setBrokerEndpoint(GlobalBrokerApiEndpoint)");
            out.println("        .setTransportOption(httpTransportOption)");
            out.println("        .build();");
            out.println();
            out.println("    const client = new DefaultClient(clientOption);");
            out.println("    const autoCases = new AutoCases(client);");
            out.println();

            // 生成所有接口的调用
            for (ApiInfo api : apiList) {
                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, new HashMap<>());
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();
                String displayPath = api.path + " (" + api.httpMethod.toUpperCase() + ")";

                out.println("    // ==================== " + displayPath + " ====================");
                out.println("    try {");
                if (api.hasRequest) {
                    out.println("        const request = autoCases." + methodName + "();");
                    out.println("        console.log(`Request " + displayPath + ": ${JSON.stringify(autoCases.safeToDict(request), null, 2)}`);");
                    out.println("        const response = await autoCases.executeWithAssert(\"" + routeKey + "\", request);");
                } else {
                    out.println("        const response = await autoCases.executeWithAssert(\"" + routeKey + "\");");
                }
                out.println("        console.log(`Response " + displayPath + ": ${JSON.stringify(autoCases.safeToDict(response), null, 2)}`);");
                out.println("    } catch (error) {");
                out.println("        console.error(`FAILED " + displayPath + ":`, error);");
                out.println("    }");
                out.println();
            }

            out.println("}");
            out.println();
            out.println("// Run when this file is executed directly");
            out.println("if (require.main === module) {");
            out.println("    runAutoCases().catch(console.error);");
            out.println("}");
        }

        log.info("NodeAutoCases.ts generated successfully at: {}", outputPath);
    }

    private static String convertJsonArrayToBuilders(String jsonArray, String ns, String className) {
        if (jsonArray == null || jsonArray.isEmpty()) {
            return "[]";
        }
        return jsonArray.replace("{", ns + "." + className + ".fromObject({")
                .replace("}", "})");

    }

    static class ApiInfo {
        String path;
        String httpMethod;
        String service;
        String subService;
        String methodName;
        String requestClassName;
        String responseClassName;
        String namespace;
        boolean hasRequest;
        Map<String, String> expects = new LinkedHashMap<>();
        Map<String, Object> requestExample = new LinkedHashMap<>();
        Map<String, String> fieldTypes = new LinkedHashMap<>();
        Map<String, String> fieldEnumTypes = new LinkedHashMap<>();  // 字段名 -> 枚举类名
    }
}
