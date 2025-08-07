package com.kucoin.universal.sdk.internal.infra;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.databind.JavaType;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.internal.interfaces.PathVar;
import com.kucoin.universal.sdk.internal.interfaces.Request;
import com.kucoin.universal.sdk.internal.interfaces.Response;
import com.kucoin.universal.sdk.internal.interfaces.Transport;
import com.kucoin.universal.sdk.model.*;
import java.lang.reflect.Field;
import java.util.*;
import java.util.concurrent.TimeUnit;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;
import kotlin.Pair;
import lombok.NonNull;
import okhttp3.*;

/** OkHttp-based implementation of {@link Transport}. */
public final class DefaultTransport implements Transport {

  private static final MediaType JSON = MediaType.get("application/json; charset=utf-8");

  private final ClientOption clientOpt;
  private final TransportOption opt;
  private final String version;
  private final OkHttpClient http;
  private final KcSigner signer;
  private final ObjectMapper mapper = new ObjectMapper();

  public DefaultTransport(@NonNull ClientOption clientOpt, String version) {
    this.clientOpt = clientOpt;
    this.opt =
        Optional.ofNullable(clientOpt.getTransportOption())
            .orElseGet(() -> TransportOption.builder().build());
    this.version = version;
    this.http = buildOkHttp(opt);
    this.signer =
        new KcSigner(
            clientOpt.getKey(),
            clientOpt.getSecret(),
            clientOpt.getPassphrase(),
            clientOpt.getBrokerName(),
            clientOpt.getBrokerPartner(),
            clientOpt.getBrokerKey());
    mapper.setSerializationInclusion(JsonInclude.Include.NON_NULL);
  }

  private OkHttpClient buildOkHttp(TransportOption o) {

    // connection pool
    ConnectionPool pool =
        o.isKeepAlive()
            ? new ConnectionPool(
                o.getMaxIdleConnections(),
                o.getKeepAliveDuration().toMillis(),
                TimeUnit.MILLISECONDS)
            : new ConnectionPool(0, 1, TimeUnit.SECONDS); // disable keep-alive

    OkHttpClient.Builder b =
        new OkHttpClient.Builder()
            .connectionPool(pool)
            .connectTimeout(o.getConnectTimeout())
            .readTimeout(o.getReadTimeout())
            .writeTimeout(o.getWriteTimeout())
            .callTimeout(o.getCallTimeout())
            .pingInterval(o.getPingInterval())
            .retryOnConnectionFailure(o.isRetryOnConnectionFailure());

    // proxy
    o.proxy().ifPresent(b::proxy);

    // dispatcher limits
    Dispatcher d =
        o.dispatcherExecutor().isPresent()
            ? new Dispatcher(o.dispatcherExecutor().get())
            : new Dispatcher();
    d.setMaxRequests(o.getMaxRequests());
    d.setMaxRequestsPerHost(o.getMaxRequestsPerHost());
    b.dispatcher(d);

    // interceptors
    o.interceptors().forEach(b::addInterceptor);
    o.eventListener().ifPresent(b::eventListener);

    return b.build();
  }

  private static class PathRes {
    String path;
    Set<String> used = new HashSet<>();
  }

  /** Replace {var} placeholders with field values annotated by {@link PathVar}. */
  private PathRes processPathVar(String path, Request req) {
    PathRes pr = new PathRes();
    if (req == null) {
      pr.path = path;
      return pr;
    }

    Pattern p = Pattern.compile("\\{(.*?)}");
    Matcher m = p.matcher(path);
    StringBuffer sb = new StringBuffer();

    while (m.find()) {
      String token = m.group(1);
      String replacement = null;

      // find matching field annotated with @PathVar("token")
      for (Field f : req.getClass().getDeclaredFields()) {
        PathVar pv = f.getAnnotation(PathVar.class);
        if (pv == null || !pv.value().equals(token)) continue;

        f.setAccessible(true);
        Object v;
        try {
          v = f.get(req);
        } catch (IllegalAccessException e) {
          throw new RuntimeException(e);
        }

        if (v == null) throw new IllegalStateException("path var '" + token + "' is null");

        pr.used.add(f.getName());
        replacement = String.valueOf(v);
        break;
      }

      if (replacement == null)
        throw new IllegalArgumentException("no field bound for {" + token + '}');

      m.appendReplacement(sb, Matcher.quoteReplacement(replacement));
    }
    m.appendTail(sb);

    pr.path = sb.toString();
    return pr;
  }

  private String endpoint(String domain) {
    switch (domain) {
      case Constants.DOMAIN_TYPE_SPOT:
        return clientOpt.getSpotEndpoint();
      case Constants.DOMAIN_TYPE_FUTURES:
        return clientOpt.getFuturesEndpoint();
      case Constants.DOMAIN_TYPE_BROKER:
        return clientOpt.getBrokerEndpoint();
      default:
        throw new IllegalArgumentException("domain: " + domain);
    }
  }

  private static int headerInt(okhttp3.Response r, String k) {
    String v = r.header(k);
    return v != null ? Integer.parseInt(v) : -1;
  }

  private okhttp3.Request processRequest(
      Request reqObj,
      String path,
      Set<String> excludeField,
      String endpoint,
      String method,
      boolean broker,
      boolean requestAsJson)
      throws Exception {

    String rawUrl = path;
    List<Pair<String, String>> queryParam = new LinkedList<>();
    String body = "";

    HttpUrl.Builder urlBuilder =
        Objects.requireNonNull(HttpUrl.parse(endpoint + path)).newBuilder();

    // build body
    if (requestAsJson) {
      if (reqObj != null) body = mapper.writeValueAsString(reqObj);
    } else {
      switch (method) {
        case "GET":
        case "DELETE":
          if (reqObj != null) {
            Map<String, Object> map = mapper.convertValue(reqObj, Map.class);
            for (Map.Entry<String, Object> e : map.entrySet()) {
              if (excludeField.contains(e.getKey()) || e.getValue() == null) continue;
              String key = e.getKey();
              Object valObj = e.getValue();
              String val =
                  valObj instanceof Enum<?> ? ((Enum<?>) valObj).name() : String.valueOf(valObj);
              urlBuilder.addQueryParameter(key, val);
              queryParam.add(new Pair<>(key, val));
            }
          }
          break;

        case "POST":
          if (reqObj != null) body = mapper.writeValueAsString(reqObj);
          break;

        default:
          throw new IllegalArgumentException("invalid method " + method);
      }
    }

    if (!queryParam.isEmpty()) {
      rawUrl =
          rawUrl
              + "?"
              + queryParam.stream()
                  .map(p -> p.getFirst() + "=" + p.getSecond())
                  .collect(Collectors.joining("&"));
    }
    RequestBody rb = null;
    if (!body.isEmpty() || method.equalsIgnoreCase("POST")) {
      rb = RequestBody.create(body, JSON);
    }

    okhttp3.Request.Builder qb =
        new okhttp3.Request.Builder().url(urlBuilder.build()).method(method, rb);
    qb.header("Content-Type", "application/json");
    qb.header("User-Agent", "Kucoin-Universal-Java-SDK/" + version);

    // sign
    String payload = method + rawUrl + body;
    Map<String, String> sig = broker ? signer.brokerHeaders(payload) : signer.headers(payload);
    sig.forEach(qb::header);

    return qb.build();
  }

  private <T extends Response<T, RestResponse<T>>> T doRequest(
      okhttp3.Request request, Class<T> respClazz) throws Exception {
    okhttp3.Response resp = http.newCall(request).execute();

    if (!resp.isSuccessful()) {
      String msg = resp.body() != null ? resp.body().string() : "";
      throw new RuntimeException("HTTP " + resp.code() + " : " + msg);
    }

    String json = resp.body() != null ? resp.body().string() : "";

    JavaType type = mapper.getTypeFactory().constructParametricType(RestResponse.class, respClazz);

    RestResponse<T> common = mapper.readValue(json, type);
    common.setRateLimit(
        new RateLimit(
            headerInt(resp, "gw-ratelimit-limit"),
            headerInt(resp, "gw-ratelimit-remaining"),
            headerInt(resp, "gw-ratelimit-reset")));
    common.checkError();
    T response = common.getData();
    if (response == null) {
      response = respClazz.getDeclaredConstructor().newInstance();
    }

    response.setCommonResponse(common);
    return response;
  }

  @Override
  public <T extends Response<T, RestResponse<T>>> T call(
      String domain,
      boolean broker,
      String method,
      String path,
      Request reqObj,
      Class<T> respClazz,
      boolean requestAsJson) {

    method = method.toUpperCase();
    domain = domain.toLowerCase();

    try {

      String endpoint = endpoint(domain);
      PathRes pr = processPathVar(path, reqObj);

      okhttp3.Request request =
          processRequest(reqObj, pr.path, pr.used, endpoint, method, broker, requestAsJson);

      return doRequest(request, respClazz);
    } catch (Exception e) {
      RestError restError = null;
      if (e instanceof RestError) {
        restError = (RestError) e;
      } else {
        restError = new RestError(null, e);
      }
      throw restError;
    }
  }

  @Override
  public void close() {
    http.connectionPool().evictAll();
    http.dispatcher().executorService().shutdown();
  }
}
