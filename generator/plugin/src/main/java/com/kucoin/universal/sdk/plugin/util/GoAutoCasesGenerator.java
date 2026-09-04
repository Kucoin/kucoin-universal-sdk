package com.kucoin.universal.sdk.plugin.util;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
import io.swagger.v3.oas.models.media.ArraySchema;
import io.swagger.v3.oas.models.media.Schema;
import io.swagger.v3.oas.models.parameters.Parameter;
import io.swagger.v3.oas.models.responses.ApiResponse;
import io.swagger.v3.oas.models.responses.ApiResponses;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.lang3.StringUtils;

import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.*;


@Slf4j
public class GoAutoCasesGenerator {

    private static final ObjectMapper mapper = new ObjectMapper();

    private static final String SDK_PACKAGE_PREFIX = "github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/generate";

    public static void generate(OpenAPI file, String outputPath) throws Exception {
        List<ApiInfo> apiList = parseOpenAPI(file);
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

            if (pathItem.getGet() != null) {
                Operation operation = pathItem.getGet();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "get", operation);
                    if (info != null) {
                        apiList.add(info);
                    }
                }
            }

            if (pathItem.getPost() != null) {
                Operation operation = pathItem.getPost();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "post", operation);
                    if (info != null) {
                        apiList.add(info);
                    }
                }
            }

            if (pathItem.getPut() != null) {
                Operation operation = pathItem.getPut();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "put", operation);
                    if (info != null) {
                        apiList.add(info);
                    }
                }
            }

            if (pathItem.getDelete() != null) {
                Operation operation = pathItem.getDelete();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "delete", operation);
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
        info.packageName = SDK_PACKAGE_PREFIX + "/" + service.toLowerCase() + "/" + subService.toLowerCase();
        info.hasRequest = hasRequestParams(operation, httpMethod);

        info.expects = extractExpects(operation);
        info.requestExample = extractRequestExample(operation, httpMethod);
        info.fieldTypes = extractFieldTypes(operation, httpMethod);
        info.nestedTypes = extractNestedTypes(operation, httpMethod, info.requestClassName);

        return info;
    }

    /**
     * 提取嵌套类型信息 - 从字段名推断
     */
    private static Map<String, String> extractNestedTypes(Operation operation, String httpMethod, String requestClassName) {
        Map<String, String> nestedTypes = new LinkedHashMap<>();

        try {
            if ("post".equalsIgnoreCase(httpMethod) || "put".equalsIgnoreCase(httpMethod)) {
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
                                        if (keyObj instanceof String && valueObj instanceof Schema) {
                                            String propName = (String) keyObj;
                                            Schema propSchema = (Schema) valueObj;

                                            // 检查是否是数组
                                            if (propSchema instanceof ArraySchema) {
                                                // 从请求类名推断嵌套类型名
                                                // 例如: SetRateLimitReq -> SetRateLimitList
                                                String nestedTypeName = requestClassName.replace("Req", "List");
                                                nestedTypes.put(propName, nestedTypeName);
                                                log.info("Inferred nested type: {} -> {}", propName, nestedTypeName);
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
            log.warn("Failed to extract nested types: {}", e.getMessage());
        }

        return nestedTypes;
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

    /**
     * 从 OpenAPI schema 中提取字段类型
     */
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
                                fieldTypes.put(name, type);
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
                                        if (keyObj instanceof String && valueObj instanceof Schema) {
                                            String propName = (String) keyObj;
                                            Schema propSchema = (Schema) valueObj;
                                            String type = propSchema.getType();
                                            if (type != null) {
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
        } catch (Exception e) {
            log.warn("Failed to extract field types: {}", e.getMessage());
        }

        return fieldTypes;
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

    private static String getApiVariableName(String subService) {
        return subService.substring(0, 1).toLowerCase() + subService.substring(1) + "Api";
    }

    private static String generateMethodName(String path, String httpMethod, String methodName, Map<String, Integer> nameCounter) {
        String prefix = httpMethod.toLowerCase();
        String baseName = prefix + "Create" + capitalizeFirst(methodName) + "Request";

        if (nameCounter.containsKey(baseName)) {
            int count = nameCounter.get(baseName) + 1;
            nameCounter.put(baseName, count);
            return baseName + "_" + count;
        } else {
            nameCounter.put(baseName, 1);
            return baseName;
        }
    }

    /**
     * 将 JSON 字符串转换为 Go 代码
     */
    private static String jsonToGoLiteral(String jsonStr, String packageName, String nestedTypeName) {
        try {
            JsonNode node = mapper.readTree(jsonStr);
            return jsonNodeToGoLiteral(node, packageName, nestedTypeName);
        } catch (Exception e) {
            log.warn("Failed to parse JSON: {}, using raw string", jsonStr);
            return "`" + jsonStr + "`";
        }
    }

    /**
     * 将 JsonNode 转换为 Go 代码
     */
    private static String jsonNodeToGoLiteral(JsonNode node, String packageName, String nestedTypeName) {
        if (node == null || node.isNull()) {
            return "nil";
        }

        if (node.isTextual()) {
            return "\"" + node.asText() + "\"";
        }

        if (node.isNumber()) {
            if (node.isInt() || node.isLong()) {
                return String.valueOf(node.asLong());
            } else if (node.isDouble() || node.isFloat()) {
                return String.valueOf(node.asDouble());
            }
            return node.asText();
        }

        if (node.isBoolean()) {
            return String.valueOf(node.asBoolean());
        }

        if (node.isArray()) {
            ArrayNode arrayNode = (ArrayNode) node;
            if (arrayNode.size() == 0) {
                return "[]interface{}{}";
            }

            JsonNode first = arrayNode.get(0);
            StringBuilder sb = new StringBuilder();

            if (first.isObject()) {
                // 使用嵌套类型名，如果为 null 则使用 "Struct"
                String structName = nestedTypeName != null ? nestedTypeName : "Struct";
                sb.append("[]").append(packageName).append(".").append(structName).append("{");
                for (int i = 0; i < arrayNode.size(); i++) {
                    JsonNode item = arrayNode.get(i);
                    if (i > 0) {
                        sb.append(", ");
                    }
                    sb.append(jsonNodeToGoLiteral(item, packageName, nestedTypeName));
                }
                sb.append("}");
            } else {
                sb.append("[]");
                String elemType = getGoType(first);
                sb.append(elemType).append("{");
                for (int i = 0; i < arrayNode.size(); i++) {
                    JsonNode item = arrayNode.get(i);
                    if (i > 0) {
                        sb.append(", ");
                    }
                    sb.append(jsonNodeToGoLiteral(item, packageName, null));
                }
                sb.append("}");
            }
            return sb.toString();
        }

        if (node.isObject()) {
            ObjectNode objectNode = (ObjectNode) node;
            Iterator<Map.Entry<String, JsonNode>> fields = objectNode.fields();

            String structName = nestedTypeName != null ? nestedTypeName : "Struct";

            StringBuilder sb = new StringBuilder();
            sb.append(packageName).append(".").append(structName).append("{");

            boolean first = true;
            while (fields.hasNext()) {
                Map.Entry<String, JsonNode> field = fields.next();
                String key = field.getKey();
                JsonNode value = field.getValue();

                if (!first) {
                    sb.append(", ");
                }
                first = false;

                String fieldName = capitalizeFirst(key);
                sb.append(fieldName).append(": ");
                sb.append(jsonNodeToGoLiteral(value, packageName, null));
            }
            sb.append("}");
            return sb.toString();
        }

        return "nil";
    }

    /**
     * 获取 Go 类型名称
     */
    private static String getGoType(JsonNode node) {
        if (node == null || node.isNull()) {
            return "interface{}";
        }
        if (node.isTextual()) {
            return "string";
        }
        if (node.isNumber()) {
            if (node.isInt() || node.isLong()) {
                return "int64";
            }
            return "float64";
        }
        if (node.isBoolean()) {
            return "bool";
        }
        if (node.isArray()) {
            return "[]interface{}";
        }
        if (node.isObject()) {
            return "map[string]interface{}";
        }
        return "interface{}";
    }

    private static void generateAutoCases(List<ApiInfo> apiList, String outputPath) throws Exception {

        try (PrintWriter out = new PrintWriter(new FileWriter(outputPath))) {

            out.println("// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.");
            out.println();
            out.println("package main");
            out.println();
            out.println("import (");
            out.println("    \"context\"");
            out.println("    \"encoding/json\"");
            out.println("    \"fmt\"");
            out.println("    \"os\"");
            out.println("    \"strings\"");
            out.println();
            out.println("    \"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/api\"");
            out.println("    \"github.com/Kucoin/kucoin-universal-sdk/sdk/golang/pkg/types\"");
            out.println();

            Set<String> packageImports = new TreeSet<>();
            for (ApiInfo api : apiList) {
                packageImports.add(api.packageName);
            }
            for (String pkg : packageImports) {
                out.println("    \"" + pkg + "\"");
            }

            out.println(")");
            out.println();

            Map<ApiInfo, String> methodNameMap = new LinkedHashMap<>();
            Map<String, Integer> nameCounter = new HashMap<>();
            for (ApiInfo api : apiList) {
                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, nameCounter);
                methodNameMap.put(api, methodName);
            }

            out.println("type AutoCases struct {");
            out.println("    routeMap    map[string]func(interface{}) (interface{}, error)");
            out.println("    expectMap   map[string]map[string]string");
            out.println("    restService api.KucoinRestService");
            out.println("}");
            out.println();

            out.println("func NewAutoCases(client api.Client) *AutoCases {");
            out.println("    a := &AutoCases{");
            out.println("        routeMap:    make(map[string]func(interface{}) (interface{}, error)),");
            out.println("        expectMap:   make(map[string]map[string]string),");
            out.println("        restService: client.RestService(),");
            out.println("    }");
            out.println("    a.initRouteMap()");
            out.println("    a.initExpectMap()");
            out.println("    return a");
            out.println("}");
            out.println();

            out.println("func (a *AutoCases) initRouteMap() {");

            Map<String, String> apiVariables = new LinkedHashMap<>();
            for (ApiInfo api : apiList) {
                String serviceName = api.service;
                String subServiceName = api.subService;
                String apiVarName = getApiVariableName(subServiceName);
                String apiGetter = "Get" + serviceName + "Service().Get" + subServiceName + "API";

                if (!apiVariables.containsKey(apiVarName)) {
                    out.println("    " + apiVarName + " := a.restService." + apiGetter + "()");
                    apiVariables.put(apiVarName, apiVarName);
                }
            }

            out.println();

            for (ApiInfo api : apiList) {
                String apiVarName = getApiVariableName(api.subService);
                String methodCall = capitalizeFirst(api.methodName);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                String packageName = api.packageName.substring(api.packageName.lastIndexOf("/") + 1);

                out.println("    // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("    a.routeMap[\"" + routeKey + "\"] = func(request interface{}) (interface{}, error) {");

                if (api.hasRequest) {
                    out.println("        req, ok := request.(*" + packageName + "." + api.requestClassName + ")");
                    out.println("        if !ok {");
                    out.println("            return nil, fmt.Errorf(\"invalid request type for " + routeKey + "\")");
                    out.println("        }");
                    out.println("        resp, err := " + apiVarName + "." + methodCall + "(req, context.Background())");
                } else {
                    out.println("        resp, err := " + apiVarName + "." + methodCall + "(context.Background())");
                }
                out.println("        if err != nil {");
                out.println("            return nil, err");
                out.println("        }");
                out.println("        return resp, nil");
                out.println("    }");
                out.println();
            }

            out.println("}");
            out.println();

            out.println("func (a *AutoCases) initExpectMap() {");

            int index = 0;
            for (ApiInfo api : apiList) {
                String varName = "expects" + (index == 0 ? "" : String.valueOf(index));
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("    // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("    " + varName + " := map[string]string{");
                for (Map.Entry<String, String> expect : api.expects.entrySet()) {
                    out.println("        \"" + expect.getKey() + "\": \"" + expect.getValue() + "\",");
                }
                out.println("    }");
                out.println("    a.expectMap[\"" + routeKey + "\"] = " + varName);
                out.println();
                index++;
            }

            out.println("}");
            out.println();

            out.println("// ==================== 预置请求方法 ====================");
            out.println();

            for (ApiInfo api : apiList) {
                if (api.requestExample == null || api.requestExample.isEmpty()) {
                    continue;
                }

                String methodName = methodNameMap.get(api);
                String packageName = api.packageName.substring(api.packageName.lastIndexOf("/") + 1);
                String requestClassName = api.requestClassName;

                out.println("func (a *AutoCases) " + methodName + "() *" + packageName + "." + requestClassName + " {");

                StringBuilder line = new StringBuilder();
                line.append("    return ").append(packageName).append(".New").append(requestClassName).append("Builder()");

                for (Map.Entry<String, Object> entry : api.requestExample.entrySet()) {
                    String key = entry.getKey();
                    Object value = entry.getValue();
                    String fieldName = capitalizeFirst(key);

                    String fieldType = api.fieldTypes.get(key);
                    String nestedTypeName = api.nestedTypes.get(key);

                    if ("boolean".equals(fieldType) || "bool".equals(fieldType)) {
                        boolean boolValue = false;
                        if (value instanceof Boolean) {
                            boolValue = (Boolean) value;
                        } else if (value instanceof String) {
                            String strValue = (String) value;
                            boolValue = "true".equalsIgnoreCase(strValue) || "1".equals(strValue);
                        }
                        line.append(".Set").append(fieldName).append("(").append(boolValue).append(")");
                    } else if ("integer".equals(fieldType) || "number".equals(fieldType)) {
                        line.append(".Set").append(fieldName).append("(").append(value).append(")");
                    } else if (value instanceof String) {
                        String strValue = (String) value;
                        if ((strValue.startsWith("[") && strValue.endsWith("]")) ||
                                (strValue.startsWith("{") && strValue.endsWith("}"))) {
                            String goLiteral = jsonToGoLiteral(strValue, packageName, nestedTypeName);
                            line.append(".Set").append(fieldName).append("(").append(goLiteral).append(")");
                        } else {
                            line.append(".Set").append(fieldName).append("(\"").append(strValue).append("\")");
                        }
                    } else if (value instanceof Number) {
                        line.append(".Set").append(fieldName).append("(").append(value).append(")");
                    } else if (value instanceof Boolean) {
                        line.append(".Set").append(fieldName).append("(").append(value).append(")");
                    } else {
                        line.append(".Set").append(fieldName).append("(\"").append(value).append("\")");
                    }
                }

                line.append(".Build()");
                out.println(line.toString());
                out.println("}");
                out.println();
            }

            // ExecuteWithAssert
            out.println("func (a *AutoCases) ExecuteWithAssert(routeKey string, request interface{}) (interface{}, error) {");
            out.println("    executor, ok := a.routeMap[routeKey]");
            out.println("    if !ok {");
            out.println("        return nil, fmt.Errorf(\"no route found for: %s\", routeKey)");
            out.println("    }");
            out.println("    response, err := executor(request)");
            out.println("    if err != nil {");
            out.println("        return nil, err");
            out.println("    }");
            out.println("    expects, ok := a.expectMap[routeKey]");
            out.println("    if ok {");
            out.println("        responseJSON, err := json.Marshal(response)");
            out.println("        if err != nil {");
            out.println("            return nil, err");
            out.println("        }");
            out.println("        var responseMap map[string]interface{}");
            out.println("        if err := json.Unmarshal(responseJSON, &responseMap); err != nil {");
            out.println("            return nil, err");
            out.println("        }");
            out.println("        for jsonPath, expectedValue := range expects {");
            out.println("            actualValue := extractValueByPath(responseMap, jsonPath)");
            out.println("            if err := assertValue(actualValue, expectedValue, jsonPath); err != nil {");
            out.println("                return nil, err");
            out.println("            }");
            out.println("        }");
            out.println("    }");
            out.println("    return response, nil");
            out.println("}");
            out.println();

            // extractValueByPath - 修复版本，支持大小写不敏感查找
            out.println("func extractValueByPath(data map[string]interface{}, path string) interface{} {");
            out.println("    if path == \"$\" {");
            out.println("        return data");
            out.println("    }");
            out.println();
            out.println("    // 处理 $.commonResponse.code 路径");
            out.println("    if path == \"$.commonResponse.code\" || path == \"$.code\" {");
            out.println("        // 尝试查找 code，不区分大小写");
            out.println("        for key, value := range data {");
            out.println("            if strings.EqualFold(key, \"commonResponse\") {");
            out.println("                if m, ok := value.(map[string]interface{}); ok {");
            out.println("                    for k, v := range m {");
            out.println("                        if strings.EqualFold(k, \"code\") {");
            out.println("                            return v");
            out.println("                        }");
            out.println("                    }");
            out.println("                }");
            out.println("            }");
            out.println("        }");
            out.println("        if code, ok := data[\"code\"]; ok {");
            out.println("            return code");
            out.println("        }");
            out.println("        return nil");
            out.println("    }");
            out.println();
            out.println("    parts := strings.Split(strings.TrimPrefix(path, \"$.\"), \".\")");
            out.println("    current := interface{}(data)");
            out.println("    for _, part := range parts {");
            out.println("        if current == nil {");
            out.println("            return nil");
            out.println("        }");
            out.println("        if m, ok := current.(map[string]interface{}); ok {");
            out.println("            // 不区分大小写查找");
            out.println("            found := false");
            out.println("            for key, value := range m {");
            out.println("                if strings.EqualFold(key, part) {");
            out.println("                    current = value");
            out.println("                    found = true");
            out.println("                    break");
            out.println("                }");
            out.println("            }");
            out.println("            if !found {");
            out.println("                return nil");
            out.println("            }");
            out.println("        } else {");
            out.println("            return nil");
            out.println("        }");
            out.println("    }");
            out.println("    return current");
            out.println("}");
            out.println();

            out.println("func assertValue(actual interface{}, expected string, jsonPath string) error {");
            out.println("    if strings.HasPrefix(expected, \":\") {");
            out.println("        operator := expected[1:]");
            out.println("        switch operator {");
            out.println("        case \"notnull\":");
            out.println("            if actual == nil {");
            out.println("                return fmt.Errorf(\"%s should not be null, but was null\", jsonPath)");
            out.println("            }");
            out.println("        case \"isnull\":");
            out.println("            if actual != nil {");
            out.println("                return fmt.Errorf(\"%s should be null, but was: %v\", jsonPath, actual)");
            out.println("            }");
            out.println("        case \"isempty\":");
            out.println("            if actual == nil {");
            out.println("                return nil");
            out.println("            }");
            out.println("            if arr, ok := actual.([]interface{}); ok {");
            out.println("                if len(arr) != 0 {");
            out.println("                    return fmt.Errorf(\"%s should be empty array, but size: %d\", jsonPath, len(arr))");
            out.println("                }");
            out.println("            } else if m, ok := actual.(map[string]interface{}); ok {");
            out.println("                if len(m) != 0 {");
            out.println("                    return fmt.Errorf(\"%s should be empty object, but size: %d\", jsonPath, len(m))");
            out.println("                }");
            out.println("            } else if s, ok := actual.(string); ok {");
            out.println("                if s != \"\" {");
            out.println("                    return fmt.Errorf(\"%s should be empty string, but was: %s\", jsonPath, s)");
            out.println("                }");
            out.println("            }");
            out.println("        case \"isnotempty\":");
            out.println("            if actual == nil {");
            out.println("                return fmt.Errorf(\"%s should not be null\", jsonPath)");
            out.println("            }");
            out.println("            if arr, ok := actual.([]interface{}); ok {");
            out.println("                if len(arr) == 0 {");
            out.println("                    return fmt.Errorf(\"%s should not be empty array\", jsonPath)");
            out.println("                }");
            out.println("            } else if m, ok := actual.(map[string]interface{}); ok {");
            out.println("                if len(m) == 0 {");
            out.println("                    return fmt.Errorf(\"%s should not be empty object\", jsonPath)");
            out.println("                }");
            out.println("            } else if s, ok := actual.(string); ok {");
            out.println("                if s == \"\" {");
            out.println("                    return fmt.Errorf(\"%s should not be empty string\", jsonPath)");
            out.println("                }");
            out.println("            }");
            out.println("        case \"gtzero\":");
            out.println("            if actual == nil {");
            out.println("                return fmt.Errorf(\"%s should not be null\", jsonPath)");
            out.println("            }");
            out.println("            switch v := actual.(type) {");
            out.println("            case float64:");
            out.println("                if v <= 0 {");
            out.println("                    return fmt.Errorf(\"%s should be > 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            case int64:");
            out.println("                if v <= 0 {");
            out.println("                    return fmt.Errorf(\"%s should be > 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            case int:");
            out.println("                if v <= 0 {");
            out.println("                    return fmt.Errorf(\"%s should be > 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            default:");
            out.println("                return fmt.Errorf(\"%s should be a number, but was: %T\", jsonPath, actual)");
            out.println("            }");
            out.println("        case \"gezero\":");
            out.println("            if actual == nil {");
            out.println("                return fmt.Errorf(\"%s should not be null\", jsonPath)");
            out.println("            }");
            out.println("            switch v := actual.(type) {");
            out.println("            case float64:");
            out.println("                if v < 0 {");
            out.println("                    return fmt.Errorf(\"%s should be >= 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            case int64:");
            out.println("                if v < 0 {");
            out.println("                    return fmt.Errorf(\"%s should be >= 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            case int:");
            out.println("                if v < 0 {");
            out.println("                    return fmt.Errorf(\"%s should be >= 0, but was: %v\", jsonPath, v)");
            out.println("                }");
            out.println("            default:");
            out.println("                return fmt.Errorf(\"%s should be a number, but was: %T\", jsonPath, actual)");
            out.println("            }");
            out.println("        default:");
            out.println("            return fmt.Errorf(\"unknown operator: %s\", operator)");
            out.println("        }");
            out.println("    } else {");
            out.println("        if actual == nil {");
            out.println("            return fmt.Errorf(\"%s should be '%s', but was null\", jsonPath, expected)");
            out.println("        }");
            out.println("        if s, ok := actual.(string); ok {");
            out.println("            if s != expected {");
            out.println("                return fmt.Errorf(\"%s expected: '%s', but was: '%s'\", jsonPath, expected, s)");
            out.println("            }");
            out.println("        } else if v, ok := actual.(float64); ok {");
            out.println("            if fmt.Sprintf(\"%v\", v) != expected {");
            out.println("                return fmt.Errorf(\"%s expected: '%s', but was: '%v'\", jsonPath, expected, v)");
            out.println("            }");
            out.println("        } else {");
            out.println("            if fmt.Sprintf(\"%v\", actual) != expected {");
            out.println("                return fmt.Errorf(\"%s expected: '%s', but was: '%v'\", jsonPath, expected, actual)");
            out.println("            }");
            out.println("        }");
            out.println("    }");
            out.println("    return nil");
            out.println("}");
            out.println();

            out.println("func main() {");
            out.println("    key := os.Getenv(\"API_KEY\")");
            out.println("    secret := os.Getenv(\"API_SECRET\")");
            out.println("    passphrase := os.Getenv(\"API_PASSPHRASE\")");
            out.println();
            out.println("    if key == \"\" || secret == \"\" || passphrase == \"\" {");
            out.println("        fmt.Println(\"ERROR: Please set API_KEY, API_SECRET, API_PASSPHRASE environment variables\")");
            out.println("        os.Exit(1)");
            out.println("    }");
            out.println();
            out.println("    httpOption := types.NewTransportOptionBuilder().SetKeepAlive(true).SetMaxIdleConnsPerHost(10).Build()");
            out.println();
            out.println("    option := types.NewClientOptionBuilder().WithKey(key).WithSecret(secret).WithPassphrase(passphrase).WithSpotEndpoint(types.GlobalApiEndpoint).WithFuturesEndpoint(types.GlobalFuturesApiEndpoint).WithBrokerEndpoint(types.GlobalBrokerApiEndpoint).WithTransportOption(httpOption).Build()");
            out.println();
            out.println("    client := api.NewClient(option)");
            out.println("    autoCases := NewAutoCases(client)");
            out.println();

            for (ApiInfo api : apiList) {
                String methodName = methodNameMap.get(api);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();
                String displayPath = api.path + " (" + api.httpMethod.toUpperCase() + ")";

                out.println("    // ==================== " + displayPath + " ====================");
                out.println("    func() {");
                if (api.hasRequest) {
                    out.println("        request := autoCases." + methodName + "()");
                    out.println("        requestJSON, _ := json.MarshalIndent(request, \"\", \"  \")");
                    out.println("        fmt.Println(\"Request " + displayPath + ": \" + string(requestJSON))");
                    out.println("        response, err := autoCases.ExecuteWithAssert(\"" + routeKey + "\", request)");
                } else {
                    out.println("        response, err := autoCases.ExecuteWithAssert(\"" + routeKey + "\", nil)");
                }
                out.println("        if err != nil {");
                out.println("            fmt.Printf(\"FAILED " + displayPath + ": %v\\n\\n\", err)");
                out.println("        } else {");
                out.println("            responseJSON, _ := json.MarshalIndent(response, \"\", \"  \")");
                out.println("            fmt.Println(\"Response " + displayPath + ": \" + string(responseJSON))");
                out.println("        }");
                out.println("    }()");
                out.println();
            }

            out.println("}");
        }

        log.info("AutoCases.go generated successfully at: {}", outputPath);
    }

    static class ApiInfo {
        String path;
        String httpMethod;
        String service;
        String subService;
        String methodName;
        String requestClassName;
        String responseClassName;
        String packageName;
        boolean hasRequest;
        Map<String, String> expects = new LinkedHashMap<>();
        Map<String, Object> requestExample = new LinkedHashMap<>();
        Map<String, String> fieldTypes = new LinkedHashMap<>();
        Map<String, String> nestedTypes = new LinkedHashMap<>();
    }
}
