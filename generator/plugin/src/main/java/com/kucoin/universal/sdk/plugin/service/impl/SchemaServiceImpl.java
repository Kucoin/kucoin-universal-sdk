package com.kucoin.universal.sdk.plugin.service.impl;

import com.google.common.base.Strings;
import com.kucoin.universal.sdk.plugin.model.Meta;
import com.kucoin.universal.sdk.plugin.service.SchemaService;
import com.kucoin.universal.sdk.plugin.util.SpecificationUtil;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.Operation;
import io.swagger.v3.oas.models.PathItem;
import io.swagger.v3.oas.models.Paths;
import io.swagger.v3.oas.models.media.Content;
import io.swagger.v3.oas.models.media.MediaType;
import io.swagger.v3.oas.models.media.Schema;
import io.swagger.v3.oas.models.parameters.Parameter;
import io.swagger.v3.oas.models.parameters.RequestBody;
import lombok.extern.slf4j.Slf4j;
import org.openapitools.codegen.utils.ModelUtils;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

@Slf4j
public class SchemaServiceImpl implements SchemaService {

    private final OpenAPI openAPI;

    private static final String TARGET_RESPONSE_CODE = "200";
    private static final String TARGET_RESPONSE_CONTENT_MEDIA_TYPE = "application/json";


    private final Map<String, Meta> requestRootMeta = new HashMap<>();
    private final Map<String, Meta> responseRootMeta = new HashMap<>();

    private final Map<String, String> nameMappingCache = new HashMap<>();

    public SchemaServiceImpl(OpenAPI openAPI) {
        this.openAPI = openAPI;
    }


    public void parseSchema() {
        Paths paths = openAPI.getPaths();
        if (paths == null) {
            log.warn("no path found in openapi");
            return;
        }

        paths.forEach((path, pathItem) -> {
            pathItem.readOperationsMap().forEach((method, operation) -> {
                collectSchema(method, path, operation);
            });

        });
    }

    @Override
    public Meta getMeta(String modelName) {
        // 先处理泛型类型名称
        modelName = normalizeGenericTypeName(modelName);

        for (String key : requestRootMeta.keySet()) {
            if (modelName.contains(key)) {
                return requestRootMeta.get(key);
            }
        }

        for (String key : responseRootMeta.keySet()) {
            if (modelName.contains(key)) {
                return responseRootMeta.get(key);
            }
        }

        return null;
    }


    @Override
    public String getGeneratedModelName(String modelName) {
        // 先处理泛型类型名称
        modelName = normalizeGenericTypeName(modelName);

        if (nameMappingCache.containsKey(modelName)) {
            return nameMappingCache.get(modelName);
        }

        // for request
        {
            String rootModel = null;
            for (String key : requestRootMeta.keySet()) {
                if (modelName.contains(key)) {
                    rootModel = key;
                    break;
                }
            }

            if (!Strings.isNullOrEmpty(rootModel)) {
                Meta meta = requestRootMeta.get(rootModel);
                String toName = modelName.replace(rootModel, meta.getMethod());

                if (toName.contains("_inner")) {
                    toName = toName.replace("_inner", "");
                }

                if (modelName.equalsIgnoreCase(rootModel)) {
                    toName += "_req";
                }

                log.info("mapping model modelName from={}, to={}", modelName, toName);
                nameMappingCache.put(modelName, toName);
                return toName;
            }
        }

        // for response
        {
            String rootModel = null;
            for (String key : responseRootMeta.keySet()) {
                if (modelName.contains(key)) {
                    rootModel = key;
                    break;
                }
            }

            if (!Strings.isNullOrEmpty(rootModel)) {
                Meta meta = responseRootMeta.get(rootModel);
                String toName = modelName.replace(rootModel, meta.getMethod());


                if (meta.isWebSocket()) {
                    if (toName.contains("_inner")) {
                        toName = toName.replace("_inner", "");
                    }
                    if (modelName.equalsIgnoreCase(rootModel)) {
                        toName += "_event";
                    }
                } else {
                    if (toName.contains("_inner")) {
                        toName = toName.replace("_inner", "");
                    }
                    if (modelName.equalsIgnoreCase(rootModel)) {
                        toName += "_resp";
                    }
                }
                log.info("mapping model modelName from={}, to={}", modelName, toName);
                nameMappingCache.put(modelName, toName);
                return toName;
            }
        }

        return modelName;
    }

    /**
     * 处理泛型类型名称
     * 将 GenericResult«AssetApiWithdrawApplyResponse» 转换为 GenericResultAssetApiWithdrawApplyResponse
     * 将 Pagination«SubUserListResponse» 转换为 PaginationSubUserListResponse
     */
    private String normalizeGenericTypeName(String name) {
        if (name == null) {
            return null;
        }
        // 替换 « 和 » 为空
        String result = name.replace("«", "").replace("»", "");
        // 如果包含 < 和 > 也替换
        result = result.replace("<", "").replace(">", "");
        return result;
    }


    private Schema generateEmptySchema(String modelName, Meta meta, Map<String, Meta> metaMap) {
        // 处理泛型类型名称
        modelName = normalizeGenericTypeName(modelName);

        Schema emptySchema = new Schema();
        emptySchema.setType("object");
        ModelUtils.getSchemas(openAPI).put(modelName, emptySchema);
        metaMap.put(modelName, meta);
        log.info("create empty schema, name: {}", modelName);
        return emptySchema;
    }

    private String inlineResponseModelName(String prefix) {
        return String.format("%s_%s", prefix.replace("/", "_"), "200_inline_content_response");
    }

    private void registerInlineResponseSchema(String modelName, Schema contentSchema, MediaType content) {
        modelName = normalizeGenericTypeName(modelName);

        ModelUtils.getSchemas(openAPI).put(modelName, contentSchema);

        Schema refSchema = new Schema();
        refSchema.set$ref("#/components/schemas/" + modelName);
        content.setSchema(refSchema);

        log.info("register inline response schema, name: {}", modelName);
    }

    private void processResponseModel(String responseSchemaName, Schema responseSchema, Meta meta) {
        responseSchemaName = normalizeGenericTypeName(responseSchemaName);

        Map<String, Schema> contentProperties = responseSchema.getProperties();

        // 如果没有 properties 或者没有 data 字段，说明响应本身就是数据
        if (contentProperties == null || !contentProperties.containsKey("data")) {
            // 没有 data 字段，直接使用整个响应作为模型
            responseRootMeta.put(responseSchemaName, meta);
            responseSchema.addExtension("x-original-response", true);
            responseSchema.addExtension("x-response-model", true);
            log.info("no data field found in response schema: {}, use whole schema as response model", responseSchemaName);
            return;
        }

        // 有 data 字段，使用 data 作为响应模型
        Schema dataSchema = contentProperties.get("data");

        if (dataSchema == null || "null".equalsIgnoreCase(dataSchema.getType())) {
            contentProperties.remove("data");
            log.info("data field type is null, removed from response schema: {}", responseSchemaName);
            responseRootMeta.put(responseSchemaName, meta);
            responseSchema.addExtension("x-original-response", true);
            responseSchema.addExtension("x-response-model", true);
            return;
        }

        // 保留 data 字段，清空其他字段
        contentProperties.clear();
        contentProperties.put("data", dataSchema);

        String dataRefName = dataSchema.get$ref();

        if (dataRefName != null) {
            // data 引用其他 schema
            responseSchema.addExtension("x-internal", true);

            String realDataModelName = ModelUtils.getSimpleRef(dataRefName);
            realDataModelName = normalizeGenericTypeName(realDataModelName);
            Schema realDataSchema = ModelUtils.getSchema(openAPI, realDataModelName);
            if (!"object".equalsIgnoreCase(realDataSchema.getType())) {
                throw new RuntimeException("not a object schema for reference data");
            }
            realDataSchema.addExtension("x-response-model", true);
            responseRootMeta.put(realDataModelName, meta);
        } else {
            responseRootMeta.put(responseSchemaName, meta);
            responseSchema.addExtension("x-original-response", true);
            responseSchema.addExtension("x-response-model", true);
        }
    }

    private void collectSchema(PathItem.HttpMethod httpMethod, String path, Operation operation) {
        if (operation == null) {
            return;
        }
        String prefix = String.format("%s_%s", path, httpMethod.toString());
        Meta meta = SpecificationUtil.getMeta(operation);
        if (meta == null) {
            throw new RuntimeException("operation meta can not be null" + prefix);
        }

        processRequest(operation, meta, prefix);
        processResponse(operation, meta, prefix);

    }


    private void markRequestModel(Schema request) {
        // link to ref
        if (request.get$ref() != null) {
            String contentSchemaRefName = ModelUtils.getSimpleRef(request.get$ref());
            contentSchemaRefName = normalizeGenericTypeName(contentSchemaRefName);
            Schema contentSchema = ModelUtils.getSchema(openAPI, contentSchemaRefName);
            markRequestModel(contentSchema);
        }

        // object schema, iterate properties
        if (ModelUtils.isObjectSchema(request)) {
            request.addExtension("x-request-model", true);

            Map<String, Schema> schemaMap = request.getProperties();
            if (schemaMap != null) {
                schemaMap.forEach((__, v) -> {
                    markRequestModel(v);
                });
            }
        }

        // array schema, iterate subItem
        if (ModelUtils.isArraySchema(request)) {
            markRequestModel(request.getItems());
        }
    }

    private void processRequest(Operation operation, Meta meta, String prefix) {
        if (meta.isWebSocket()) {
            return;
        }

        String modelName = String.format("%s_%s", prefix.replace("/","_"), "200_parameter_request");
        modelName = normalizeGenericTypeName(modelName);

        boolean generated = false;
        String generatedSchemaName = "";

        RequestBody requestBody = operation.getRequestBody();
        if (requestBody != null) {
            Content content = requestBody.getContent();
            if (content != null) {
                for (Map.Entry<String, MediaType> stringMediaTypeEntry : content.entrySet()) {
                    Schema schema = stringMediaTypeEntry.getValue().getSchema();
                    if (schema == null) {
                        continue;
                    }
                    if (schema.get$ref() != null) {
                        String contentSchemaRefName = ModelUtils.getSimpleRef(schema.get$ref());
                        contentSchemaRefName = normalizeGenericTypeName(contentSchemaRefName);
                        requestRootMeta.put(contentSchemaRefName, meta);
                        generatedSchemaName = contentSchemaRefName;
                        generated = true;

                        Schema contentSchema = ModelUtils.getSchema(openAPI, contentSchemaRefName);
                        if (contentSchema == null) {
                            throw new RuntimeException("contentSchema should never null! " + contentSchemaRefName);
                        }
                        contentSchema.addExtension("x-request-model", true);
                        markRequestModel(contentSchema);
                        break;
                    } else {
                        String type = schema.getType();
                        if (type == null) {
                            // 如果 type 为 null，尝试判断是否是 object
                            if (schema.getProperties() != null && !schema.getProperties().isEmpty()) {
                                schema.addExtension("x-request-model", true);
                            } else {
                                log.warn("schema type is null and no properties found, skipping: {}", schema);
                            }
                        } else if (type.equalsIgnoreCase("array")) {
                            Schema itemSchema = schema.getItems();
                            if (itemSchema != null && itemSchema.get$ref() != null) {
                                String realItemSchemaRefName = ModelUtils.getSimpleRef(itemSchema.get$ref());
                                realItemSchemaRefName = normalizeGenericTypeName(realItemSchemaRefName);
                                Schema realItemSchema = ModelUtils.getSchema(openAPI, realItemSchemaRefName);
                                realItemSchema.addExtension("x-request-model", true);
                                ModelUtils.getSchemas(openAPI).remove(realItemSchemaRefName);
                                String newItemName = modelName + "_item";
                                ModelUtils.getSchemas(openAPI).put(newItemName, realItemSchema);
                                itemSchema.set$ref(itemSchema.get$ref().replace(realItemSchemaRefName, newItemName));
                            }

                            Schema s = generateEmptySchema(modelName, meta, requestRootMeta);
                            generatedSchemaName = modelName;
                            generated = true;
                            s.addProperty("items", schema);
                            s.addExtension("x-request-model", true);
                            s.addExtension("x-request-raw-array", true);
                        } else if (type.equalsIgnoreCase("object")) {
                            schema.addExtension("x-request-model", true);
                        } else {
                            throw new RuntimeException("unsupported schema type: " + type);
                        }

                    }
                }
            }
        }


        List<Parameter> parameters = operation.getParameters();
        if (parameters != null) {

            for (Parameter parameter : parameters) {
                if (parameter.getIn().equalsIgnoreCase("path")) {
                    Schema targetSchema;

                    if (generated) {
                        targetSchema = ModelUtils.getSchema(openAPI, generatedSchemaName);
                    } else {
                        targetSchema = generateEmptySchema(modelName, meta, requestRootMeta);
                        generated = true;
                        generatedSchemaName = modelName;
                    }

                    if (targetSchema == null) {
                        throw new RuntimeException("target schema can not be null");
                    }

                    // add path to schema as properties
                    Schema stringSchema = new Schema();
                    stringSchema.setType("string");
                    stringSchema.setDescription(parameter.getDescription());
                    stringSchema.addExtension("x-tag-path", parameter.getName());
                    targetSchema.addProperty(parameter.getName(), stringSchema);
                    targetSchema.addExtension("x-request-model", true);

                } else if (parameter.getIn().equalsIgnoreCase("query")) {
                    Schema targetSchema;

                    if (generated) {
                        targetSchema = ModelUtils.getSchema(openAPI, generatedSchemaName);
                    } else {
                        targetSchema = generateEmptySchema(modelName, meta, requestRootMeta);
                        generated = true;
                        generatedSchemaName = modelName;
                    }

                    if (targetSchema == null) {
                        throw new RuntimeException("target schema can not be null");
                    }

                    Schema pSchema = parameter.getSchema();
                    if (pSchema != null) {
                        pSchema.addExtension("x-tag-url", parameter.getName());
                        pSchema.setDescription(parameter.getDescription());
                        targetSchema.addProperty(parameter.getName(), pSchema);
                    }
                    targetSchema.addExtension("x-request-model", true);
                } else {
                    throw new UnsupportedOperationException("unsupported parameter type " + parameter.getIn());
                }
            }
        }
    }


    private void processResponse(Operation operation, Meta meta, String prefix) {
        operation.getResponses().forEach((statusCode, apiResponse) -> {
            if (!statusCode.equalsIgnoreCase(TARGET_RESPONSE_CODE)) {
                return;
            }

            if (apiResponse.getContent() == null) {
                String modelName = String.format("%s_%s", prefix, "200_empty_content_response");
                generateEmptySchema(modelName, meta, responseRootMeta);
                return;
            }

            apiResponse.getContent().forEach((mediaType, content) -> {
                if (!mediaType.equalsIgnoreCase(TARGET_RESPONSE_CONTENT_MEDIA_TYPE)) {
                    return;
                }

                Schema contentSchema = content.getSchema();

                if (contentSchema == null) {
                    String modelName = String.format("%s_%s", prefix, "200_empty_content_response");
                    generateEmptySchema(modelName, meta, responseRootMeta);
                    return;
                }

                if (contentSchema.get$ref() != null) {

                    String responseSchemaRefName = ModelUtils.getSimpleRef(contentSchema.get$ref());
                    Schema responseSchema = ModelUtils.getSchema(openAPI, responseSchemaRefName);
                    if (responseSchema == null) {
                        throw new RuntimeException("can not find responseSchema " + responseSchemaRefName);
                    }

                    processResponseModel(responseSchemaRefName, responseSchema, meta);
                } else {
                    if (meta.isWebSocket()) {
                        throw new IllegalArgumentException("unexpected ref for websocket schema");
                    }

                    String responseSchemaName = inlineResponseModelName(prefix);
                    responseSchemaName = normalizeGenericTypeName(responseSchemaName);
                    registerInlineResponseSchema(responseSchemaName, contentSchema, content);
                    processResponseModel(responseSchemaName, contentSchema, meta);
                }
            });
        });
    }
}
