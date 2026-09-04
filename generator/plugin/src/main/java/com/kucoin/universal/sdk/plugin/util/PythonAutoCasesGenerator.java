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
public class PythonAutoCasesGenerator {

    private static final ObjectMapper mapper = new ObjectMapper();

    private static final String SDK_PACKAGE_PREFIX = "kucoin_universal_sdk.generate";

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
        info.packageName = SDK_PACKAGE_PREFIX + "." + service.toLowerCase() + "." + subService.toLowerCase();
        info.hasRequest = hasRequestParams(operation, httpMethod);

        info.expects = extractExpects(operation);
        info.requestExample = extractRequestExample(operation, httpMethod);
        info.fieldTypes = extractFieldTypes(operation, httpMethod);

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
                                        if (keyObj instanceof String && valueObj instanceof io.swagger.v3.oas.models.media.Schema) {
                                            String propName = (String) keyObj;
                                            io.swagger.v3.oas.models.media.Schema propSchema = (io.swagger.v3.oas.models.media.Schema) valueObj;
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

    private static String toSnakeCase(String str) {
        if (StringUtils.isEmpty(str)) {
            return str;
        }
        str = str.replaceAll("([A-Z]+)([A-Z][a-z])", "$1_$2");
        str = str.replaceAll("([a-z])([A-Z])", "$1_$2");
        return str.toLowerCase();
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
        return subService.substring(0, 1).toLowerCase() + subService.substring(1) + "_api";
    }

    private static String generateMethodName(String path, String httpMethod, String methodName, Map<String, Integer> nameCounter) {
        String prefix = httpMethod.toLowerCase();
        String baseName = prefix + "_create_" + toSnakeCase(methodName) + "_request";

        if (nameCounter.containsKey(baseName)) {
            int count = nameCounter.get(baseName) + 1;
            nameCounter.put(baseName, count);
            return baseName + "_" + count;
        } else {
            nameCounter.put(baseName, 1);
            return baseName;
        }
    }

    private static String pythonBool(boolean value) {
        return value ? "True" : "False";
    }

    private static void generateAutoCases(List<ApiInfo> apiList, String outputPath) throws Exception {

        try (PrintWriter out = new PrintWriter(new FileWriter(outputPath))) {

            out.println("# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.");
            out.println();
            out.println("import json");
            out.println("import logging");
            out.println("import os");
            out.println("from typing import Any, Dict, Optional");
            out.println();
            out.println("from kucoin_universal_sdk.api import DefaultClient");
            out.println("from kucoin_universal_sdk.model import ClientOptionBuilder, TransportOptionBuilder");
            out.println("from kucoin_universal_sdk.model import GLOBAL_API_ENDPOINT, GLOBAL_FUTURES_API_ENDPOINT, GLOBAL_BROKER_API_ENDPOINT");
            out.println();

            // 收集所有需要导入的包
            Set<String> packageImports = new TreeSet<>();
            for (ApiInfo api : apiList) {
                String pkg = api.packageName;
                // 提取最后一个.之前的包路径
                String importPath = pkg.substring(0, pkg.lastIndexOf("."));
                packageImports.add(importPath);
            }
            for (String pkg : packageImports) {
                out.println("from " + pkg + " import *");
            }

            out.println();
            out.println();

            Map<ApiInfo, String> methodNameMap = new LinkedHashMap<>();
            Map<String, Integer> nameCounter = new HashMap<>();
            for (ApiInfo api : apiList) {
                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, nameCounter);
                methodNameMap.put(api, methodName);
            }

            // AutoCases 类
            out.println("class AutoCases:");
            out.println("    def __init__(self, client: DefaultClient):");
            out.println("        self.route_map: Dict[str, callable] = {}");
            out.println("        self.expect_map: Dict[str, Dict[str, str]] = {}");
            out.println("        self.rest_service = client.rest_service()");
            out.println("        self._init_route_map()");
            out.println("        self._init_expect_map()");
            out.println();

            // _init_route_map
            out.println("    def _init_route_map(self):");

            Map<String, String> apiVariables = new LinkedHashMap<>();
            for (ApiInfo api : apiList) {
                String serviceName = api.service;
                String subServiceName = api.subService;
                String apiVarName = getApiVariableName(subServiceName);

                String serviceNameLower = serviceName.toLowerCase();
                String subServiceNameLower = subServiceName.toLowerCase();
                String serviceGetter = "get_" + serviceNameLower + "_service";
                String apiGetter = "get_" + subServiceNameLower + "_api";

                if (!apiVariables.containsKey(apiVarName)) {
                    out.println("        " + apiVarName + " = self.rest_service." + serviceGetter + "()." + apiGetter + "()");
                    apiVariables.put(apiVarName, apiVarName);
                }
            }

            out.println();

            for (ApiInfo api : apiList) {
                String apiVarName = getApiVariableName(api.subService);
                String methodCall = toSnakeCase(api.methodName);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                String packageName = api.packageName.substring(api.packageName.lastIndexOf(".") + 1);
                String requestClassName = api.requestClassName;

                out.println("        # " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        def _handler_" + toSnakeCase(api.methodName) + "(request):");

                if (api.hasRequest) {
                    out.println("            if not isinstance(request, " + packageName + "." + requestClassName + "):");
                    out.println("                raise TypeError(f\"invalid request type for " + routeKey + "\")");
                    out.println("            return " + apiVarName + "." + methodCall + "(request)");
                } else {
                    out.println("            return " + apiVarName + "." + methodCall + "()");
                }
                out.println("        self.route_map[\"" + routeKey + "\"] = _handler_" + toSnakeCase(api.methodName));
                out.println();
            }

            out.println();

            // _init_expect_map
            out.println("    def _init_expect_map(self):");

            int index = 0;
            for (ApiInfo api : apiList) {
                String varName = "expects" + (index == 0 ? "" : String.valueOf(index));
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        # " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        " + varName + " = {");
                for (Map.Entry<String, String> expect : api.expects.entrySet()) {
                    out.println("            \"" + expect.getKey() + "\": \"" + expect.getValue() + "\",");
                }
                out.println("        }");
                out.println("        self.expect_map[\"" + routeKey + "\"] = " + varName);
                out.println();
                index++;
            }

            out.println();

            // 预置请求方法
            out.println("    # ==================== 预置请求方法 ====================");
            out.println();

            for (ApiInfo api : apiList) {
                if (api.requestExample == null || api.requestExample.isEmpty()) {
                    continue;
                }

                String methodName = methodNameMap.get(api);
                String packageName = api.packageName.substring(api.packageName.lastIndexOf(".") + 1);
                String requestClassName = api.requestClassName;

                out.println("    def " + methodName + "(self):");
                out.println("        req = " + packageName + "." + requestClassName + "()");

                for (Map.Entry<String, Object> entry : api.requestExample.entrySet()) {
                    String key = entry.getKey();
                    Object value = entry.getValue();
                    String fieldName = toSnakeCase(key);
                    String fieldType = api.fieldTypes.get(key);

                    if ("boolean".equals(fieldType) || "bool".equals(fieldType)) {
                        boolean boolValue = false;
                        if (value instanceof Boolean) {
                            boolValue = (Boolean) value;
                        } else if (value instanceof String) {
                            boolValue = "true".equalsIgnoreCase((String) value);
                        }
                        out.println("        req." + fieldName + " = " + pythonBool(boolValue));
                    } else if ("integer".equals(fieldType) || "number".equals(fieldType)) {
                        out.println("        req." + fieldName + " = " + value);
                    } else if (value instanceof String) {
                        String strValue = (String) value;
                        if ((strValue.startsWith("[") && strValue.endsWith("]")) ||
                                (strValue.startsWith("{") && strValue.endsWith("}"))) {
                            out.println("        req." + fieldName + " = " + strValue);
                        } else {
                            out.println("        req." + fieldName + " = \"" + strValue + "\"");
                        }
                    } else if (value instanceof Number) {
                        out.println("        req." + fieldName + " = " + value);
                    } else if (value instanceof Boolean) {
                        out.println("        req." + fieldName + " = " + pythonBool((Boolean) value));
                    } else {
                        out.println("        req." + fieldName + " = \"" + value + "\"");
                    }
                }

                out.println("        return req");
                out.println();
            }

            // _safe_to_dict 方法 - 完整的递归转换
            out.println("    def _safe_to_dict(self, obj):");
            out.println("        \"\"\"安全地将对象转换为字典，递归处理所有嵌套对象\"\"\"");
            out.println("        if obj is None:");
            out.println("            return None");
            out.println("        if hasattr(obj, '__dict__'):");
            out.println("            result = {}");
            out.println("            for k, v in obj.__dict__.items():");
            out.println("                if not k.startswith('_') and not isinstance(v, type):");
            out.println("                    result[k] = self._safe_to_dict(v)");
            out.println("            return result");
            out.println("        elif isinstance(obj, (list, tuple)):");
            out.println("            return [self._safe_to_dict(item) for item in obj]");
            out.println("        elif isinstance(obj, dict):");
            out.println("            return {k: self._safe_to_dict(v) for k, v in obj.items()}");
            out.println("        else:");
            out.println("            return obj");
            out.println();

            // execute_with_assert
            out.println("    def execute_with_assert(self, route_key: str, request: Any = None):");
            out.println("        if route_key not in self.route_map:");
            out.println("            raise ValueError(f\"no route found for: {route_key}\")");
            out.println("        handler = self.route_map[route_key]");
            out.println("        response = handler(request)");
            out.println("        if route_key in self.expect_map:");
            out.println("            expects = self.expect_map[route_key]");
            out.println("            response_dict = self._safe_to_dict(response)");
            out.println("            for json_path, expected_value in expects.items():");
            out.println("                actual_value = self._extract_value_by_path(response_dict, json_path)");
            out.println("                self._assert_value(actual_value, expected_value, json_path)");
            out.println("        return response");
            out.println();

            // _to_snake_case 辅助方法
            out.println("    def _to_snake_case(self, name: str) -> str:");
            out.println("        \"\"\"将驼峰命名转换为蛇形命名\"\"\"");
            out.println("        if not name:");
            out.println("            return name");
            out.println("        result = []");
            out.println("        for i, char in enumerate(name):");
            out.println("            if char.isupper() and i > 0:");
            out.println("                result.append('_')");
            out.println("                result.append(char.lower())");
            out.println("            else:");
            out.println("                result.append(char.lower())");
            out.println("        return ''.join(result)");
            out.println();

            // _extract_value_by_path
            out.println("    def _extract_value_by_path(self, data: Dict, path: str) -> Any:");
            out.println("        if path == \"$\":");
            out.println("            return data");
            out.println("        if path == \"$.commonResponse.code\" or path == \"$.code\" or path == \"$.common_response.code\":");
            out.println("            # 尝试多种命名风格");
            out.println("            possible_keys = [\"commonResponse\", \"common_response\", \"CommonResponse\"]");
            out.println("            for key in possible_keys:");
            out.println("                if key in data and isinstance(data[key], dict):");
            out.println("                    if \"code\" in data[key]:");
            out.println("                        return data[key][\"code\"]");
            out.println("            if \"code\" in data:");
            out.println("                return data[\"code\"]");
            out.println("            return None");
            out.println("        parts = path[2:].split(\".\")");
            out.println("        current = data");
            out.println("        for part in parts:");
            out.println("            if current is None:");
            out.println("                return None");
            out.println("            if isinstance(current, dict):");
            out.println("                found = False");
            out.println("                if part in current:");
            out.println("                    current = current[part]");
            out.println("                    found = True");
            out.println("                else:");
            out.println("                    part_lower = part.lower()");
            out.println("                    for key, value in current.items():");
            out.println("                        if key.lower() == part_lower:");
            out.println("                            current = value");
            out.println("                            found = True");
            out.println("                            break");
            out.println("                    if not found:");
            out.println("                        snake_part = self._to_snake_case(part)");
            out.println("                        if snake_part in current:");
            out.println("                            current = current[snake_part]");
            out.println("                            found = True");
            out.println("                if not found:");
            out.println("                    return None");
            out.println("            else:");
            out.println("                return None");
            out.println("        return current");
            out.println();

            // _assert_value
            out.println("    def _assert_value(self, actual: Any, expected: str, json_path: str):");
            out.println("        if expected.startswith(\":\"):");
            out.println("            operator = expected[1:]");
            out.println("            if operator == \"notnull\":");
            out.println("                if actual is None:");
            out.println("                    raise AssertionError(f\"{json_path} should not be null, but was null\")");
            out.println("            elif operator == \"isnull\":");
            out.println("                if actual is not None:");
            out.println("                    raise AssertionError(f\"{json_path} should be null, but was: {actual}\")");
            out.println("            elif operator == \"isempty\":");
            out.println("                if actual is None:");
            out.println("                    return");
            out.println("                if isinstance(actual, list) and len(actual) != 0:");
            out.println("                    raise AssertionError(f\"{json_path} should be empty array, but size: {len(actual)}\")");
            out.println("                elif isinstance(actual, dict) and len(actual) != 0:");
            out.println("                    raise AssertionError(f\"{json_path} should be empty object, but size: {len(actual)}\")");
            out.println("                elif isinstance(actual, str) and actual != \"\":");
            out.println("                    raise AssertionError(f\"{json_path} should be empty string, but was: {actual}\")");
            out.println("            elif operator == \"isnotempty\":");
            out.println("                if actual is None:");
            out.println("                    raise AssertionError(f\"{json_path} should not be null\")");
            out.println("                if isinstance(actual, list) and len(actual) == 0:");
            out.println("                    raise AssertionError(f\"{json_path} should not be empty array\")");
            out.println("                elif isinstance(actual, dict) and len(actual) == 0:");
            out.println("                    raise AssertionError(f\"{json_path} should not be empty object\")");
            out.println("                elif isinstance(actual, str) and actual == \"\":");
            out.println("                    raise AssertionError(f\"{json_path} should not be empty string\")");
            out.println("            elif operator == \"gtzero\":");
            out.println("                if actual is None:");
            out.println("                    raise AssertionError(f\"{json_path} should not be null\")");
            out.println("                if isinstance(actual, (int, float)) and actual <= 0:");
            out.println("                    raise AssertionError(f\"{json_path} should be > 0, but was: {actual}\")");
            out.println("            elif operator == \"gezero\":");
            out.println("                if actual is None:");
            out.println("                    raise AssertionError(f\"{json_path} should not be null\")");
            out.println("                if isinstance(actual, (int, float)) and actual < 0:");
            out.println("                    raise AssertionError(f\"{json_path} should be >= 0, but was: {actual}\")");
            out.println("            else:");
            out.println("                raise ValueError(f\"unknown operator: {operator}\")");
            out.println("        else:");
            out.println("            if actual is None:");
            out.println("                raise AssertionError(f\"{json_path} should be '{expected}', but was null\")");
            out.println("            if str(actual) != expected:");
            out.println("                raise AssertionError(f\"{json_path} expected: '{expected}', but was: '{actual}'\")");
            out.println();

            // main 函数
            out.println("def main():");
            out.println("    logging.basicConfig(");
            out.println("        level=logging.INFO,");
            out.println("        format='%(asctime)s %(levelname)s - %(message)s',");
            out.println("        datefmt='%Y-%m-%d %H:%M:%S'");
            out.println("    )");
            out.println();
            out.println("    key = os.getenv(\"API_KEY\", \"\")");
            out.println("    secret = os.getenv(\"API_SECRET\", \"\")");
            out.println("    passphrase = os.getenv(\"API_PASSPHRASE\", \"\")");
            out.println();
            out.println("    if not key or not secret or not passphrase:");
            out.println("        logging.error(\"Please set API_KEY, API_SECRET, API_PASSPHRASE environment variables\")");
            out.println("        return");
            out.println();
            out.println("    http_transport_option = (");
            out.println("        TransportOptionBuilder()");
            out.println("        .set_keep_alive(True)");
            out.println("        .set_max_pool_size(10)");
            out.println("        .set_max_connection_per_pool(10)");
            out.println("        .build()");
            out.println("    )");
            out.println();
            out.println("    client_option = (");
            out.println("        ClientOptionBuilder()");
            out.println("        .set_key(key)");
            out.println("        .set_secret(secret)");
            out.println("        .set_passphrase(passphrase)");
            out.println("        .set_spot_endpoint(GLOBAL_API_ENDPOINT)");
            out.println("        .set_futures_endpoint(GLOBAL_FUTURES_API_ENDPOINT)");
            out.println("        .set_broker_endpoint(GLOBAL_BROKER_API_ENDPOINT)");
            out.println("        .set_transport_option(http_transport_option)");
            out.println("        .build()");
            out.println("    )");
            out.println("    client = DefaultClient(client_option)");
            out.println("    auto_cases = AutoCases(client)");
            out.println();

            // 生成所有接口的调用
            for (ApiInfo api : apiList) {
                String methodName = methodNameMap.get(api);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();
                String displayPath = api.path + " (" + api.httpMethod.toUpperCase() + ")";

                out.println("    # ==================== " + displayPath + " ====================");
                out.println("    try:");
                if (api.hasRequest) {
                    out.println("        request = auto_cases." + methodName + "()");
                    out.println("        logging.info(f\"Request " + displayPath + ": {json.dumps(request.__dict__, indent=2)}\")");
                    out.println("        response = auto_cases.execute_with_assert(\"" + routeKey + "\", request)");
                } else {
                    out.println("        response = auto_cases.execute_with_assert(\"" + routeKey + "\", None)");
                }
                out.println("        logging.info(f\"Response " + displayPath + ": {json.dumps(auto_cases._safe_to_dict(response), indent=2)}\")");
                out.println("    except Exception as e:");
                out.println("        logging.error(f\"FAILED " + displayPath + ": {e}\")");
                out.println();
            }

            out.println();
            out.println("if __name__ == \"__main__\":");
            out.println("    main()");
        }

        log.info("AutoCases.py generated successfully at: {}", outputPath);
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
    }
}
