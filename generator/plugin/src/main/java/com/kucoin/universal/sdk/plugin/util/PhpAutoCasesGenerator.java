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
import org.apache.commons.lang3.StringUtils;

import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.*;


public class PhpAutoCasesGenerator {

    private static final ObjectMapper mapper = new ObjectMapper();

    private static final String SDK_PACKAGE_PREFIX = "KuCoin\\UniversalSDK\\Generate";

    public static void generate(OpenAPI file, String outputPath) throws Exception {
        System.out.println("========== PhpAutoCasesGenerator.generate() START ==========");
        System.out.println("Output path: " + outputPath);

        List<ApiInfo> apiList = parseOpenAPI(file);

        System.out.println("========== Parsing Result ==========");
        System.out.println("Total APIs found: " + apiList.size());
        for (ApiInfo info : apiList) {
            System.out.println("  " + info.httpMethod.toUpperCase() + " " + info.path + " -> " + info.methodName + " (service: " + info.service + ", subService: " + info.subService + ")");
        }

        if (apiList.isEmpty()) {
            System.out.println("WARN: No APIs found! Check your OpenAPI file and tags.");
            System.out.println("WARN: Make sure interfaces have tags: [\"MAIN\", \"ALL\"] and x-sdk-* extensions");
        }

        generateAutoCases(apiList, outputPath);
        System.out.println("========== PhpAutoCasesGenerator.generate() END ==========");
    }

    private static List<ApiInfo> parseOpenAPI(OpenAPI openAPI) {
        List<ApiInfo> apiList = new ArrayList<>();

        System.out.println("parseOpenAPI: Starting to parse OpenAPI");

        Paths paths = openAPI.getPaths();
        if (paths == null) {
            System.out.println("parseOpenAPI: paths is null!");
            return apiList;
        }

        System.out.println("parseOpenAPI: Total paths: " + paths.size());

        for (Map.Entry<String, PathItem> pathEntry : paths.entrySet()) {
            String path = pathEntry.getKey();
            PathItem pathItem = pathEntry.getValue();

            if (pathItem.getGet() != null) {
                Operation operation = pathItem.getGet();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "get", operation);
                    if (info != null) {
                        apiList.add(info);
                        System.out.println("  GET " + path + " - ADDED");
                    }
                }
            }

            if (pathItem.getPost() != null) {
                Operation operation = pathItem.getPost();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "post", operation);
                    if (info != null) {
                        apiList.add(info);
                        System.out.println("  POST " + path + " - ADDED");
                    }
                }
            }

            if (pathItem.getPut() != null) {
                Operation operation = pathItem.getPut();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "put", operation);
                    if (info != null) {
                        apiList.add(info);
                        System.out.println("  PUT " + path + " - ADDED");
                    }
                }
            }

            if (pathItem.getDelete() != null) {
                Operation operation = pathItem.getDelete();
                if (hasMainAndAllTags(operation)) {
                    ApiInfo info = extractApiInfo(path, "delete", operation);
                    if (info != null) {
                        apiList.add(info);
                        System.out.println("  DELETE " + path + " - ADDED");
                    }
                }
            }
        }

        System.out.println("parseOpenAPI: Final apiList size: " + apiList.size());
        return apiList;
    }

    private static boolean hasMainAndAllTags(Operation operation) {
        if (operation == null) {
            return false;
        }
        List<String> tags = operation.getTags();
        if (tags == null || tags.isEmpty()) {
            return false;
        }
        return tags.contains("MAIN") && tags.contains("ALL");
    }

    private static ApiInfo extractApiInfo(String path, String httpMethod, Operation operation) {
        Map<String, Object> extensions = operation.getExtensions();
        if (extensions == null) {
            System.out.println("extractApiInfo: extensions is null for path=" + path + ", method=" + httpMethod);
            return null;
        }

        String service = getExtensionString(extensions, "x-sdk-service");
        String subService = getExtensionString(extensions, "x-sdk-sub-service");
        String methodName = getExtensionString(extensions, "x-sdk-method-name");

        if (StringUtils.isEmpty(service) || StringUtils.isEmpty(subService) || StringUtils.isEmpty(methodName)) {
            System.out.println("extractApiInfo: Missing x-sdk-* extensions for path=" + path + ", method=" + httpMethod);
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
        info.packageName = SDK_PACKAGE_PREFIX + "\\" + service + "\\" + subService;
        info.hasRequest = hasRequestParams(operation, httpMethod);

        info.expects = extractExpects(operation);
        info.requestExample = extractRequestExample(operation, httpMethod);

        System.out.println("extractApiInfo: SUCCESS - path=" + path + ", method=" + httpMethod + ", requestClassName=" + info.requestClassName);

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
                                        System.out.println("Failed to parse example: " + e.getMessage());
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
                                    System.out.println("Failed to parse example: " + e.getMessage());
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
     * 提取断言
     * code + 响应体本身
     */
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
            System.out.println("Failed to extract example from response: " + e.getMessage());
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

    private static String getApiGetter(String service, String subService) {
        String serviceGetter = "get" + service + "Service";
        String apiGetter = "get" + subService + "Api";
        return serviceGetter + "()->" + apiGetter;
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

    private static void generateAutoCases(List<ApiInfo> apiList, String outputPath) throws Exception {

        System.out.println("generateAutoCases: Generating with " + apiList.size() + " APIs");

        try (PrintWriter out = new PrintWriter(new FileWriter(outputPath))) {

            out.println("<?php");
            out.println();
            out.println("namespace " + getNamespace(apiList) + ";");
            out.println();
            out.println("include __DIR__ . '/../../vendor/autoload.php';");
            out.println();

            // 收集所有 imports
            Set<String> imports = new TreeSet<>();
            for (ApiInfo api : apiList) {
                if (api.hasRequest) {
                    imports.add(api.packageName + "\\" + api.requestClassName);
                }
                imports.add(api.packageName + "\\" + api.responseClassName);
            }
            for (String imp : imports) {
                out.println("use " + imp + ";");
            }

            out.println();
            out.println("use KuCoin\\UniversalSDK\\Api\\Client;");
            out.println("use KuCoin\\UniversalSDK\\Api\\DefaultClient;");
            out.println("use KuCoin\\UniversalSDK\\Model\\ClientOptionBuilder;");
            out.println("use KuCoin\\UniversalSDK\\Model\\TransportOptionBuilder;");
            out.println("use KuCoin\\UniversalSDK\\Model\\Constants;");
            out.println();
            out.println("use ReflectionClass;");
            out.println("use ReflectionMethod;");
            out.println("use ReflectionProperty;");
            out.println();
            out.println("class AutoCases");
            out.println("{");
            out.println("    private $routeMap = [];");
            out.println("    private $expectMap = [];");
            out.println("    private $restService;");
            out.println();
            out.println("    public function __construct(Client $client)");
            out.println("    {");
            out.println("        $this->restService = $client->restService();");
            out.println("        $this->initRouteMap();");
            out.println("        $this->initExpectMap();");
            out.println("    }");
            out.println();

            Map<ApiInfo, String> methodNameMap = new LinkedHashMap<>();
            Map<String, Integer> nameCounter = new HashMap<>();
            for (ApiInfo api : apiList) {
                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, nameCounter);
                methodNameMap.put(api, methodName);
            }

            // ==================== initRouteMap ====================
            out.println("    private function initRouteMap(): void");
            out.println("    {");

            Map<String, String> apiVariables = new LinkedHashMap<>();
            for (ApiInfo api : apiList) {
                String serviceName = api.service;
                String subServiceName = api.subService;
                String apiVarName = getApiVariableName(subServiceName);
                String apiGetter = getApiGetter(serviceName, subServiceName);

                if (!apiVariables.containsKey(apiVarName)) {
                    out.println("        $" + apiVarName + " = $this->restService->" + apiGetter + "();");
                    apiVariables.put(apiVarName, apiVarName);
                }
            }

            out.println();

            for (ApiInfo api : apiList) {
                String apiVarName = getApiVariableName(api.subService);
                String methodCall = api.methodName;
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        $this->routeMap['" + routeKey + "'] = function($request) use ($" + apiVarName + ") {");

                if (api.hasRequest) {
                    out.println("            $req = $this->convertValue($request, " + api.requestClassName + "::class);");
                    out.println("            $resp = $" + apiVarName + "->" + methodCall + "($req);");
                } else {
                    out.println("            $resp = $" + apiVarName + "->" + methodCall + "();");
                }

                out.println("            return $resp;");
                out.println("        };");
                out.println();
            }

            out.println("    }");
            out.println();

            // ==================== initExpectMap ====================
            out.println("    private function initExpectMap(): void");
            out.println("    {");

            int index = 0;
            for (ApiInfo api : apiList) {
                String varName = "expects" + (index == 0 ? "" : index);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        $" + varName + " = [];");
                for (Map.Entry<String, String> expect : api.expects.entrySet()) {
                    out.println("        $" + varName + "['" + expect.getKey() + "'] = '" + expect.getValue() + "';");
                }
                out.println("        $this->expectMap['" + routeKey + "'] = $" + varName + ";");
                out.println();
                index++;
            }

            out.println("    }");
            out.println();

            // ==================== 预置请求方法 ====================
            out.println("    // ==================== 预置请求方法 ====================");
            out.println();

            for (ApiInfo api : apiList) {
                if (api.requestExample == null || api.requestExample.isEmpty()) {
                    continue;
                }

                String methodName = methodNameMap.get(api);

                out.println("    /**");
                out.println("     * 创建 " + api.path + " 的请求示例");
                out.println("     * " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("     */");
                out.println("    public function " + methodName + "(): array");
                out.println("    {");
                out.println("        $request = [];");

                for (Map.Entry<String, Object> entry : api.requestExample.entrySet()) {
                    String key = entry.getKey();
                    Object value = entry.getValue();
                    if (value instanceof String) {
                        String strValue = (String) value;
                        if ((strValue.startsWith("[") && strValue.endsWith("]")) ||
                                (strValue.startsWith("{") && strValue.endsWith("}"))) {
                            out.println("        $request['" + key + "'] = json_decode('" + strValue.replace("\"", "\\\"") + "', true);");
                        } else {
                            out.println("        $request['" + key + "'] = '" + strValue.replace("'", "\\'") + "';");
                        }
                    } else if (value instanceof Number) {
                        out.println("        $request['" + key + "'] = " + value + ";");
                    } else if (value instanceof Boolean) {
                        boolean boolValue = (Boolean) value;
                        out.println("        $request['" + key + "'] = " + (boolValue ? "true" : "false") + ";");
                    } else {
                        out.println("        $request['" + key + "'] = '" + value + "';");
                    }
                }

                out.println("        return $request;");
                out.println("    }");
                out.println();
            }

            // ==================== convertValue ====================
            out.println("    /**");
            out.println("     * 将数组转换为对象");
            out.println("     */");
            out.println("    private function convertValue(array $data, string $className): object");
            out.println("    {");
            out.println("        $reflection = new ReflectionClass($className);");
            out.println("        $instance = $reflection->newInstanceWithoutConstructor();");
            out.println("        ");
            out.println("        foreach ($data as $key => $value) {");
            out.println("            try {");
            out.println("                $property = $reflection->getProperty($key);");
            out.println("                $property->setAccessible(true);");
            out.println("                $property->setValue($instance, $value);");
            out.println("            } catch (\\ReflectionException $e) {");
            out.println("                // 忽略不存在的属性");
            out.println("            }");
            out.println("        }");
            out.println("        ");
            out.println("        return $instance;");
            out.println("    }");
            out.println();

            // ==================== executeWithAssert ====================
            out.println("    /**");
            out.println("     * 执行测试用例并自动断言");
            out.println("     * @param string $routeKey 请求路径，格式: path:HTTP_METHOD");
            out.println("     * @param array $requestJson 请求参数的数组");
            out.println("     * @return object 响应对象");
            out.println("     * @throws \\RuntimeException 断言失败时抛出");
            out.println("     */");
            out.println("    public function executeWithAssert(string $routeKey, array $requestJson): object");
            out.println("    {");
            out.println("        $response = $this->execute($routeKey, $requestJson);");
            out.println("        $expects = $this->expectMap[$routeKey] ?? null;");
            out.println("        ");
            out.println("        if ($expects !== null) {");
            out.println("            foreach ($expects as $jsonPath => $expectedValue) {");
            out.println("                $actualValue = $this->extractValueByPath($response, $jsonPath);");
            out.println("                $this->assertValue($actualValue, $expectedValue, $jsonPath);");
            out.println("            }");
            out.println("        }");
            out.println("        ");
            out.println("        return $response;");
            out.println("    }");
            out.println();

            // ==================== extractValueByPath ====================
            out.println("    /**");
            out.println("     * 通过路径从对象中提取值（使用反射）");
            out.println("     * 支持: $, $.code, $.commonResponse.code");
            out.println("     */");
            out.println("    private function extractValueByPath(object $obj, string $jsonPath)");
            out.println("    {");
            out.println("        if ($jsonPath === '$' || trim($jsonPath) === '$') {");
            out.println("            return $obj;");
            out.println("        }");
            out.println("        ");
            out.println("        $path = str_replace('$.', '', $jsonPath);");
            out.println("        if (str_starts_with($path, '.')) {");
            out.println("            $path = substr($path, 1);");
            out.println("        }");
            out.println("        $segments = explode('.', $path);");
            out.println("        ");
            out.println("        $current = $obj;");
            out.println("        foreach ($segments as $segment) {");
            out.println("            if ($current === null) {");
            out.println("                return null;");
            out.println("            }");
            out.println("            ");
            out.println("            $next = null;");
            out.println("            // 1. 尝试 getter 方法");
            out.println("            $getterName = 'get' . ucfirst($segment);");
            out.println("            try {");
            out.println("                $method = new ReflectionMethod($current, $getterName);");
            out.println("                $next = $method->invoke($current);");
            out.println("            } catch (\\ReflectionException $e1) {");
            out.println("                // 2. 尝试 is 方法 (boolean)");
            out.println("                $isName = 'is' . ucfirst($segment);");
            out.println("                try {");
            out.println("                    $method = new ReflectionMethod($current, $isName);");
            out.println("                    $next = $method->invoke($current);");
            out.println("                } catch (\\ReflectionException $e2) {");
            out.println("                    // 3. 尝试直接访问属性");
            out.println("                    try {");
            out.println("                        $property = new ReflectionProperty($current, $segment);");
            out.println("                        $property->setAccessible(true);");
            out.println("                        $next = $property->getValue($current);");
            out.println("                    } catch (\\ReflectionException $e3) {");
            out.println("                        return null;");
            out.println("                    }");
            out.println("                }");
            out.println("            }");
            out.println("            $current = $next;");
            out.println("        }");
            out.println("        return $current;");
            out.println("    }");
            out.println();

            // ==================== assertValue ====================
            out.println("    /**");
            out.println("     * 断言值 - 支持 :notnull :isnull :isempty :isnotempty :gtzero :gezero");
            out.println("     * @throws \\RuntimeException 断言失败时抛出");
            out.println("     */");
            out.println("    private function assertValue($actual, string $expected, string $jsonPath): void");
            out.println("    {");
            out.println("        if (str_starts_with($expected, ':')) {");
            out.println("            $operator = substr($expected, 1);");
            out.println("            switch ($operator) {");
            out.println("                case 'notnull':");
            out.println("                    if ($actual === null) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should not be null, but was null');");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isnull':");
            out.println("                    if ($actual !== null) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should be null, but was: ' . json_encode($actual));");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isempty':");
            out.println("                    if ($actual === null) {");
            out.println("                        // null is considered empty");
            out.println("                    } elseif (is_array($actual)) {");
            out.println("                        if (count($actual) !== 0) {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should be empty array, but size: ' . count($actual));");
            out.println("                        }");
            out.println("                    } elseif (is_object($actual)) {");
            out.println("                        if (count((array)$actual) !== 0) {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should be empty object, but size: ' . count((array)$actual));");
            out.println("                        }");
            out.println("                    } elseif (is_string($actual)) {");
            out.println("                        if ($actual !== '') {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should be empty string, but was: ' . $actual);");
            out.println("                        }");
            out.println("                    } else {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' is not a container or text, actual: ' . json_encode($actual));");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'isnotempty':");
            out.println("                    if ($actual === null) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should not be null');");
            out.println("                    } elseif (is_array($actual)) {");
            out.println("                        if (count($actual) === 0) {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should not be empty array');");
            out.println("                        }");
            out.println("                    } elseif (is_object($actual)) {");
            out.println("                        if (count((array)$actual) === 0) {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should not be empty object');");
            out.println("                        }");
            out.println("                    } elseif (is_string($actual)) {");
            out.println("                        if ($actual === '') {");
            out.println("                            throw new \\RuntimeException($jsonPath . ' should not be empty string');");
            out.println("                        }");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'gtzero':");
            out.println("                    if ($actual === null) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should not be null');");
            out.println("                    }");
            out.println("                    if (!is_numeric($actual)) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should be a number, but was: ' . json_encode($actual));");
            out.println("                    }");
            out.println("                    if ((float)$actual <= 0) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should be > 0, but was: ' . (float)$actual);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case 'gezero':");
            out.println("                    if ($actual === null) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should not be null');");
            out.println("                    }");
            out.println("                    if (!is_numeric($actual)) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should be a number, but was: ' . json_encode($actual));");
            out.println("                    }");
            out.println("                    if ((float)$actual < 0) {");
            out.println("                        throw new \\RuntimeException($jsonPath . ' should be >= 0, but was: ' . (float)$actual);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                default:");
            out.println("                    throw new \\RuntimeException('Unknown operator: ' . $operator);");
            out.println("            }");
            out.println("        } else {");
            out.println("            if ($actual === null) {");
            out.println("                throw new \\RuntimeException($jsonPath . ' should be \\'' . $expected . '\\', but was null');");
            out.println("            }");
            out.println("            if (!is_scalar($actual)) {");
            out.println("                throw new \\RuntimeException($jsonPath . ' is not a scalar value, actual: ' . json_encode($actual));");
            out.println("            }");
            out.println("            if ((string)$actual !== $expected) {");
            out.println("                throw new \\RuntimeException($jsonPath . ' expected: \\'' . $expected . '\\', but was: \\'' . (string)$actual . '\\'');");
            out.println("            }");
            out.println("        }");
            out.println("    }");
            out.println();

            // ==================== execute ====================
            out.println("    public function execute(string $routeKey, array $requestJson): object");
            out.println("    {");
            out.println("        $executor = $this->routeMap[$routeKey] ?? null;");
            out.println("        if ($executor === null) {");
            out.println("            throw new \\InvalidArgumentException('No route found for: ' . $routeKey);");
            out.println("        }");
            out.println("        return $executor($requestJson);");
            out.println("    }");
            out.println();

            out.println("    public function supports(string $routeKey): bool");
            out.println("    {");
            out.println("        return isset($this->routeMap[$routeKey]);");
            out.println("    }");

            // ==================== AutoCases 类结束 ====================
            out.println("}");

            // ==================== main 函数 ====================
            out.println();
            out.println("// ==================== 执行入口 ====================");
            out.println("if (PHP_SAPI === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {");
            out.println("    main();");
            out.println("}");
            out.println();
            out.println("function main(): void");
            out.println("{");
            out.println();
            out.println("    $key = getenv('API_KEY');");
            out.println("    $secret = getenv('API_SECRET');");
            out.println("    $passphrase = getenv('API_PASSPHRASE');");
            out.println();
            out.println("    if (empty($key) || empty($secret) || empty($passphrase)) {");
            out.println("        echo \"ERROR: Please set API_KEY, API_SECRET, API_PASSPHRASE environment variables\\n\";");
            out.println("        exit(1);");
            out.println("    }");
            out.println();
            out.println("    $httpTransportOption = (new TransportOptionBuilder())");
            out.println("        ->setKeepAlive(true)");
            out.println("        ->setMaxConnections(10)");
            out.println("        ->build();");
            out.println();
            out.println("    $clientOption = (new ClientOptionBuilder())");
            out.println("        ->setKey($key)");
            out.println("        ->setSecret($secret)");
            out.println("        ->setPassphrase($passphrase)");
            out.println("        ->setSpotEndpoint(Constants::GLOBAL_API_ENDPOINT)");
            out.println("        ->setFuturesEndpoint(Constants::GLOBAL_FUTURES_API_ENDPOINT)");
            out.println("        ->setBrokerEndpoint(Constants::GLOBAL_BROKER_API_ENDPOINT)");
            out.println("        ->setTransportOption($httpTransportOption)");
            out.println("        ->build();");
            out.println();
            out.println("    $client = new DefaultClient($clientOption);");
            out.println("    $autoCases = new AutoCases($client);");
            out.println();

            int testIndex = 0;
            for (ApiInfo api : apiList) {
                String methodName = methodNameMap.get(api);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();
                String displayPath = api.path + " (" + api.httpMethod.toUpperCase() + ")";

                out.println("    // ==================== " + displayPath + " ====================");
                out.println("    try {");
                if (api.hasRequest) {
                    out.println("        $request" + testIndex + " = $autoCases->" + methodName + "();");
                    out.println("        echo \"Request " + displayPath + ": \" . json_encode($request" + testIndex + ", JSON_PRETTY_PRINT) . \"\\n\";");
                    out.println("        $response" + testIndex + " = $autoCases->executeWithAssert(\"" + routeKey + "\", $request" + testIndex + ");");
                } else {
                    out.println("        $response" + testIndex + " = $autoCases->executeWithAssert(\"" + routeKey + "\", []);");
                }
                out.println("        echo \"Response " + displayPath + ": \" . json_encode($response" + testIndex + ", JSON_PRETTY_PRINT) . \"\\n\\n\";");
                out.println("    } catch (\\Exception $e) {");
                out.println("        echo \"FAILED " + displayPath + ": \" . $e->getMessage() . \"\\n\\n\";");
                out.println("    }");
                testIndex++;
            }

            out.println();
            out.println("}");
        }

        System.out.println("AutoCases.php generated successfully at: " + outputPath);
    }

    private static String getNamespace(List<ApiInfo> apiList) {
        if (apiList.isEmpty()) {
            return "KuCoin\\UniversalSDK\\Generate";
        }
        // 取第一个 API 的包名，去掉最后的类名部分
        String packageName = apiList.get(0).packageName;
        int lastBackslash = packageName.lastIndexOf("\\");
        if (lastBackslash > 0) {
            return packageName.substring(0, lastBackslash);
        }
        return "KuCoin\\UniversalSDK\\Generate";
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
    }
}
