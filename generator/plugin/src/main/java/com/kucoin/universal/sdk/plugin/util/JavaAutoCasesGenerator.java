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
public class JavaAutoCasesGenerator {

    private static final ObjectMapper mapper = new ObjectMapper();

    private static final String SDK_PACKAGE_PREFIX = "com.kucoin.universal.sdk.generate";

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

        return info;
    }

    private static Map<String, Object> extractRequestExample(Operation operation, String httpMethod) {
        Map<String, Object> example = new LinkedHashMap<>();

        if ("get".equalsIgnoreCase(httpMethod)|| "delete".equalsIgnoreCase(httpMethod)) {
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

    private static String getApiGetter(String service, String subService) {
        String serviceGetter = "get" + service + "Service";
        String apiGetter = "get" + subService + "Api";
        return serviceGetter + "()." + apiGetter;
    }

    private static String generateMethodName(String path, String httpMethod, String methodName, Map<String, Integer> nameCounter) {
        // 始终使用 methodName 作为基础
        String prefix = httpMethod.toLowerCase();
        String baseName = prefix + "Create" + capitalizeFirst(methodName) + "Request";

        // 如果已经存在同名方法，添加后缀
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

        try (PrintWriter out = new PrintWriter(new FileWriter(outputPath))) {

            out.println("package com.kucoin.universal.sdk.generate;");
            out.println();
            out.println("import com.fasterxml.jackson.databind.JsonNode;");
            out.println("import com.fasterxml.jackson.databind.ObjectMapper;");
            out.println("import com.fasterxml.jackson.databind.node.ObjectNode;");
            out.println("import com.kucoin.universal.sdk.api.DefaultKucoinClient;");
            out.println("import com.kucoin.universal.sdk.api.KucoinClient;");
            out.println("import com.kucoin.universal.sdk.api.KucoinRestService;");
            out.println("import com.kucoin.universal.sdk.model.ClientOption;");
            out.println("import com.kucoin.universal.sdk.model.Constants;");
            out.println("import com.kucoin.universal.sdk.model.TransportOption;");
            out.println();

            Set<String> imports = new TreeSet<>();
            for (ApiInfo api : apiList) {
                if (api.hasRequest) {
                    imports.add(api.packageName + "." + api.requestClassName);
                }
                imports.add(api.packageName + "." + api.responseClassName);
            }
            for (String imp : imports) {
                out.println("import " + imp + ";");
            }

            out.println();
            out.println("import java.lang.reflect.Field;");
            out.println("import java.lang.reflect.Method;");
            out.println("import java.util.HashMap;");
            out.println("import java.util.Map;");
            out.println("import java.util.function.Function;");
            out.println();
            out.println("public class AutoCases {");
            out.println();
            Map<ApiInfo, String> methodNameMap = new LinkedHashMap<>();
            Map<String, Integer> nameCounter = new HashMap<>();
            for (ApiInfo api : apiList) {
                String methodName = generateMethodName(api.path, api.httpMethod, api.methodName, nameCounter);
                methodNameMap.put(api, methodName);
            }

            out.println("    public static void main(String[] args) throws Exception {");
            out.println("        String key = System.getenv(\"API_KEY\");");
            out.println("        String secret = System.getenv(\"API_SECRET\");");
            out.println("        String passphrase = System.getenv(\"API_PASSPHRASE\");");
            out.println();
            out.println("        TransportOption httpTransportOption = TransportOption.builder().keepAlive(true).build();");
            out.println();
            out.println("        ClientOption clientOption =");
            out.println("                ClientOption.builder()");
            out.println("                        .key(key)");
            out.println("                        .secret(secret)");
            out.println("                        .passphrase(passphrase)");
            out.println("                        .spotEndpoint(Constants.GLOBAL_API_ENDPOINT)");
            out.println("                        .futuresEndpoint(Constants.GLOBAL_FUTURES_API_ENDPOINT)");
            out.println("                        .brokerEndpoint(Constants.GLOBAL_BROKER_API_ENDPOINT)");
            out.println("                        .transportOption(httpTransportOption)");
            out.println("                        .build();");
            out.println();
            out.println("        KucoinClient client = new DefaultKucoinClient(clientOption);");
            out.println("        AutoCases autoCases = new AutoCases(client);");
            out.println("        ObjectMapper mapper = new ObjectMapper();");
            out.println();

            // 生成所有接口的调用
            int testIndex = 0;
            for (ApiInfo api : apiList) {
                String methodName = methodNameMap.get(api);
                String responseVar = "response" + testIndex;
                String requestVar = "request" + testIndex;

                out.println("        // ==================== " + api.httpMethod.toUpperCase() + " " + api.path + " ====================");
                out.println("        try {");
                if (api.hasRequest) {
                    out.println("            ObjectNode " + requestVar + " = autoCases." + methodName + "();");
                    out.println("            System.out.println(\"Request: \" + mapper.writerWithDefaultPrettyPrinter().writeValueAsString(" + requestVar + "));");
                    out.println("            " + api.responseClassName + " " + responseVar + " = (" + api.responseClassName + ") autoCases.executeWithAssert(\"" + api.path + ":" + api.httpMethod.toUpperCase() + "\", " + requestVar + ");");
                } else {
                    out.println("            " + api.responseClassName + " " + responseVar + " = (" + api.responseClassName + ") autoCases.executeWithAssert(\"" + api.path + ":" + api.httpMethod.toUpperCase() + "\", mapper.createObjectNode());");
                }
                out.println("            System.out.println(\"Response: \" + mapper.writerWithDefaultPrettyPrinter().writeValueAsString(" + responseVar + "));");
                out.println("        } catch (Exception e) {");
                out.println("            System.err.println(\"Failed to execute " + api.httpMethod.toUpperCase() + " " + api.path + ": \" + e.getMessage());");
                out.println("            e.printStackTrace();");
                out.println("        }");
                out.println();
                testIndex++;
            }

            out.println("    }");
            out.println();

            // ==================== 类的成员变量 ====================
            out.println("    private static final ObjectMapper mapper = new ObjectMapper();");
            out.println("    ");
            out.println("    private final Map<String, Function<JsonNode, Object>> routeMap = new HashMap<>();");
            out.println("    private final Map<String, Map<String, String>> expectMap = new HashMap<>();");
            out.println("    ");
            out.println("    private final KucoinRestService restService;");
            out.println("    ");
            out.println("    public AutoCases(KucoinClient client) {");
            out.println("        this.restService = client.getRestService();");
            out.println("        initRouteMap();");
            out.println("        initExpectMap();");
            out.println("    }");
            out.println("    ");

            // ==================== initRouteMap ====================
            out.println("    private void initRouteMap() {");

            Map<String, String> apiVariables = new LinkedHashMap<>();
            for (ApiInfo api : apiList) {
                String serviceName = api.service;
                String subServiceName = api.subService;
                String apiVarName = getApiVariableName(subServiceName);
                String apiGetter = getApiGetter(serviceName, subServiceName);

                if (!apiVariables.containsKey(apiVarName)) {
                    out.println("        " + api.packageName + "." + subServiceName + "Api " + apiVarName +
                            " = restService." + apiGetter + "();");
                    apiVariables.put(apiVarName, apiVarName);
                }
            }

            out.println();

            for (ApiInfo api : apiList) {
                String apiVarName = getApiVariableName(api.subService);
                String methodCall = api.methodName;
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();

                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        routeMap.put(\"" + routeKey + "\", request -> {");

                if (api.hasRequest) {
                    out.println("            " + api.requestClassName + " req = mapper.convertValue(request, " + api.requestClassName + ".class);");
                    out.println("            " + api.responseClassName + " resp = " + apiVarName + "." + methodCall + "(req);");
                } else {
                    out.println("            " + api.responseClassName + " resp = " + apiVarName + "." + methodCall + "();");
                }

                out.println("            return resp;");
                out.println("        });");
                out.println();
            }

            out.println("    }");
            out.println("    ");

            // ==================== initExpectMap ====================
            out.println("    private void initExpectMap() {");

            int index = 0;
            for (ApiInfo api : apiList) {
                String varName = "expects" + (index == 0 ? "" : index);
                String routeKey = api.path + ":" + api.httpMethod.toUpperCase();
                out.println("        // " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("        Map<String, String> " + varName + " = new HashMap<>();");
                for (Map.Entry<String, String> expect : api.expects.entrySet()) {
                    out.println("        " + varName + ".put(\"" + expect.getKey() + "\", \"" + expect.getValue() + "\");");
                }
                out.println("        expectMap.put(\"" + routeKey + "\", " + varName + ");");
                out.println();
                index++;
            }

            out.println("    }");
            out.println("    ");

            // ==================== createRequest 方法 ====================
            out.println("    // ==================== 预置请求方法 ====================");
            out.println();

            for (ApiInfo api : apiList) {
                // main() invokes a request factory for every API that has request parameters.
                // Generate the factory even when the OpenAPI parameters do not provide examples;
                // in that case it intentionally returns an empty ObjectNode for users to fill in.
                if (!api.hasRequest) {
                    continue;
                }

                String methodName = methodNameMap.get(api);

                out.println("    /**");
                out.println("     * 创建 " + api.path + " 的请求示例");
                out.println("     * " + api.httpMethod.toUpperCase() + " " + api.path);
                out.println("     */");
                out.println("    public ObjectNode " + methodName + "() {");
                out.println("        ObjectNode request = mapper.createObjectNode();");

                for (Map.Entry<String, Object> entry : api.requestExample.entrySet()) {
                    String key = entry.getKey();
                    Object value = entry.getValue();
                    if (value instanceof String) {
                        String strValue = (String) value;
                        if ((strValue.startsWith("[") && strValue.endsWith("]")) ||
                                (strValue.startsWith("{") && strValue.endsWith("}"))) {
                            out.println("        try {");
                            out.println("            JsonNode jsonNode = mapper.readTree(\"" + strValue.replace("\"", "\\\"") + "\");");
                            out.println("            request.set(\"" + key + "\", jsonNode);");
                            out.println("        } catch (Exception e) {");
                            out.println("            throw new RuntimeException(\"Failed to parse JSON for field: " + key + "\", e);");
                            out.println("        }");
                        } else {
                            out.println("        request.put(\"" + key + "\", \"" + strValue + "\");");
                        }
                    } else if (value instanceof Number) {
                        Number num = (Number) value;
                        if (num instanceof Long || num.longValue() > Integer.MAX_VALUE || num.longValue() < Integer.MIN_VALUE) {
                            out.println("        request.put(\"" + key + "\", " + num + "L);");
                        } else {
                            out.println("        request.put(\"" + key + "\", " + num + ");");
                        }
                    } else if (value instanceof Boolean) {
                        out.println("        request.put(\"" + key + "\", " + value + ");");
                    } else {
                        out.println("        request.put(\"" + key + "\", \"" + value + "\");");
                    }
                }

                out.println("        return request;");
                out.println("    }");
                out.println();
            }

            // ==================== executeWithAssert ====================
            out.println("    /**");
            out.println("     * 执行测试用例并自动断言");
            out.println("     * @param routeKey 请求路径，格式: path:HTTP_METHOD (如 /api/ua/v1/account/mode:POST)");
            out.println("     * @param requestJson 请求参数的JSON");
            out.println("     * @return 响应对象");
            out.println("     * @throws AssertionError 断言失败时抛出");
            out.println("     */");
            out.println("    public Object executeWithAssert(String routeKey, JsonNode requestJson) {");
            out.println("        Object response = execute(routeKey, requestJson);");
            out.println("        Map<String, String> expects = expectMap.get(routeKey);");
            out.println("        ");
            out.println("        if (expects != null) {");
            out.println("            for (Map.Entry<String, String> expect : expects.entrySet()) {");
            out.println("                String jsonPath = expect.getKey();");
            out.println("                String expectedValue = expect.getValue();");
            out.println("                Object actualValue = extractValueByPath(response, jsonPath);");
            out.println("                JsonNode actualNode = mapper.valueToTree(actualValue);");
            out.println("                assertValue(actualNode, expectedValue, jsonPath);");
            out.println("            }");
            out.println("        }");
            out.println("        ");
            out.println("        return response;");
            out.println("    }");
            out.println("    ");
            out.println("    /**");
            out.println("     * 执行测试用例并自动断言 (从JSON字符串)");
            out.println("     * @param routeKey 请求路径，格式: path:HTTP_METHOD");
            out.println("     */");
            out.println("    public Object executeWithAssert(String routeKey, String requestJson) throws Exception {");
            out.println("        JsonNode node = mapper.readTree(requestJson);");
            out.println("        return executeWithAssert(routeKey, node);");
            out.println("    }");
            out.println("    ");

            // ==================== extractValueByPath ====================
            out.println("    /**");
            out.println("     * 通过路径从对象中提取值（使用反射，不受 @JsonIgnore 影响）");
            out.println("     * 支持: $, $.code, $.commonResponse.code");
            out.println("     */");
            out.println("    private Object extractValueByPath(Object obj, String jsonPath) {");
            out.println("        if (obj == null) {");
            out.println("            return null;");
            out.println("        }");
            out.println("        ");
            out.println("        if (\"$\".equals(jsonPath) || \"$\".equals(jsonPath.trim())) {");
            out.println("            return obj;");
            out.println("        }");
            out.println("        ");
            out.println("        String path = jsonPath.replace(\"$.\", \"\");");
            out.println("        if (path.startsWith(\".\")) {");
            out.println("            path = path.substring(1);");
            out.println("        }");
            out.println("        String[] segments = path.split(\"\\\\.\");");
            out.println("        ");
            out.println("        Object current = obj;");
            out.println("        for (String segment : segments) {");
            out.println("            if (current == null) {");
            out.println("                return null;");
            out.println("            }");
            out.println("            ");
            out.println("            Object next = null;");
            out.println("            String getterName = \"get\" + segment.substring(0, 1).toUpperCase() + segment.substring(1);");
            out.println("            try {");
            out.println("                Method method = current.getClass().getMethod(getterName);");
            out.println("                next = method.invoke(current);");
            out.println("            } catch (NoSuchMethodException e1) {");
            out.println("                String isName = \"is\" + segment.substring(0, 1).toUpperCase() + segment.substring(1);");
            out.println("                try {");
            out.println("                    Method method = current.getClass().getMethod(isName);");
            out.println("                    next = method.invoke(current);");
            out.println("                } catch (NoSuchMethodException e2) {");
            out.println("                    try {");
            out.println("                        Field field = getField(current.getClass(), segment);");
            out.println("                        if (field != null) {");
            out.println("                            field.setAccessible(true);");
            out.println("                            next = field.get(current);");
            out.println("                        }");
            out.println("                    } catch (Exception e3) {");
            out.println("                        return null;");
            out.println("                    }");
            out.println("                } catch (Exception e2) {");
            out.println("                    return null;");
            out.println("                }");
            out.println("            } catch (Exception e1) {");
            out.println("                return null;");
            out.println("            }");
            out.println("            current = next;");
            out.println("        }");
            out.println("        return current;");
            out.println("    }");
            out.println("    ");

            // ==================== getField ====================
            out.println("    /**");
            out.println("     * 递归查找字段（包括父类）");
            out.println("     */");
            out.println("    private Field getField(Class<?> clazz, String fieldName) {");
            out.println("        try {");
            out.println("            return clazz.getDeclaredField(fieldName);");
            out.println("        } catch (NoSuchFieldException e) {");
            out.println("            Class<?> superClass = clazz.getSuperclass();");
            out.println("            if (superClass != null && !superClass.equals(Object.class)) {");
            out.println("                return getField(superClass, fieldName);");
            out.println("            }");
            out.println("            return null;");
            out.println("        }");
            out.println("    }");
            out.println("    ");

            // ==================== assertValue ====================
            out.println("    /**");
            out.println("     * 断言值 - 支持 :notnull :isnull :isempty :isnotempty :gtzero :gezero");
            out.println("     * @throws AssertionError 断言失败时抛出");
            out.println("     */");
            out.println("    private void assertValue(JsonNode actual, String expected, String jsonPath) {");
            out.println("        if (expected.startsWith(\":\")) {");
            out.println("            String operator = expected.substring(1);");
            out.println("            switch (operator) {");
            out.println("                case \"notnull\":");
            out.println("                    if (actual == null || actual.isNull()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should not be null, but was null\");");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case \"isnull\":");
            out.println("                    if (actual != null && !actual.isNull()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should be null, but was: \" + actual);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case \"isempty\":");
            out.println("                    if (actual == null || actual.isNull()) {");
            out.println("                        // null is considered empty");
            out.println("                    } else if (actual.isArray()) {");
            out.println("                        if (actual.size() != 0) {");
            out.println("                            throw new AssertionError(jsonPath + \" should be empty array, but size: \" + actual.size());");
            out.println("                        }");
            out.println("                    } else if (actual.isObject()) {");
            out.println("                        if (actual.size() != 0) {");
            out.println("                            throw new AssertionError(jsonPath + \" should be empty object, but size: \" + actual.size());");
            out.println("                        }");
            out.println("                    } else if (actual.isTextual()) {");
            out.println("                        if (!actual.asText().isEmpty()) {");
            out.println("                            throw new AssertionError(jsonPath + \" should be empty string, but was: \" + actual.asText());");
            out.println("                        }");
            out.println("                    } else {");
            out.println("                        throw new AssertionError(jsonPath + \" is not a container or text, actual: \" + actual);");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case \"isnotempty\":");
            out.println("                    if (actual == null || actual.isNull()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should not be null\");");
            out.println("                    } else if (actual.isArray()) {");
            out.println("                        if (actual.size() == 0) {");
            out.println("                            throw new AssertionError(jsonPath + \" should not be empty array\");");
            out.println("                        }");
            out.println("                    } else if (actual.isObject()) {");
            out.println("                        if (actual.size() == 0) {");
            out.println("                            throw new AssertionError(jsonPath + \" should not be empty object\");");
            out.println("                        }");
            out.println("                    } else if (actual.isTextual()) {");
            out.println("                        if (actual.asText().isEmpty()) {");
            out.println("                            throw new AssertionError(jsonPath + \" should not be empty string\");");
            out.println("                        }");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case \"gtzero\":");
            out.println("                    if (actual == null || actual.isNull()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should not be null\");");
            out.println("                    }");
            out.println("                    if (!actual.isNumber()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should be a number, but was: \" + actual);");
            out.println("                    }");
            out.println("                    if (actual.asDouble() <= 0) {");
            out.println("                        throw new AssertionError(jsonPath + \" should be > 0, but was: \" + actual.asDouble());");
            out.println("                    }");
            out.println("                    break;");
            out.println("                case \"gezero\":");
            out.println("                    if (actual == null || actual.isNull()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should not be null\");");
            out.println("                    }");
            out.println("                    if (!actual.isNumber()) {");
            out.println("                        throw new AssertionError(jsonPath + \" should be a number, but was: \" + actual);");
            out.println("                    }");
            out.println("                    if (actual.asDouble() < 0) {");
            out.println("                        throw new AssertionError(jsonPath + \" should be >= 0, but was: \" + actual.asDouble());");
            out.println("                    }");
            out.println("                    break;");
            out.println("                default:");
            out.println("                    throw new AssertionError(\"Unknown operator: \" + operator);");
            out.println("            }");
            out.println("        } else {");
            out.println("            if (actual == null || actual.isNull()) {");
            out.println("                throw new AssertionError(jsonPath + \" should be '\" + expected + \"', but was null\");");
            out.println("            }");
            out.println("            if (!actual.isValueNode()) {");
            out.println("                throw new AssertionError(jsonPath + \" is not a value node, actual: \" + actual);");
            out.println("            }");
            out.println("            if (!expected.equals(actual.asText())) {");
            out.println("                throw new AssertionError(jsonPath + \" expected: '\" + expected + \"', but was: '\" + actual.asText() + \"'\");");
            out.println("            }");
            out.println("        }");
            out.println("    }");
            out.println("    ");

            // ==================== execute ====================
            out.println("    public Object execute(String routeKey, JsonNode requestJson) {");
            out.println("        Function<JsonNode, Object> executor = routeMap.get(routeKey);");
            out.println("        if (executor == null) {");
            out.println("            throw new IllegalArgumentException(\"No route found for: \" + routeKey);");
            out.println("        }");
            out.println("        return executor.apply(requestJson);");
            out.println("    }");
            out.println("    ");
            out.println("    public Object execute(String routeKey, String requestJson) throws Exception {");
            out.println("        JsonNode node = mapper.readTree(requestJson);");
            out.println("        return execute(routeKey, node);");
            out.println("    }");
            out.println("    ");
            out.println("    public boolean supports(String routeKey) {");
            out.println("        return routeMap.containsKey(routeKey);");
            out.println("    }");
            out.println("}");
        }

        log.info("AutoCases.java generated successfully at: {}", outputPath);
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
