package com.kucoin.universal.sdk.internal.infra;

import java.nio.charset.StandardCharsets;
import java.time.Instant;
import java.util.HashMap;
import java.util.Map;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import lombok.extern.slf4j.Slf4j;

/** Generates KuCoin authentication headers for both normal user mode and broker mode. */
@Slf4j
public final class KcSigner {

  private static final String HMAC_SHA256 = "HmacSHA256";

  private final String apiKey;
  private final String apiSecret;
  private final String apiPassphrase;

  private final String brokerName;
  private final String brokerPartner;
  private final String brokerKey;

  public KcSigner(
      String apiKey,
      String apiSecret,
      String apiPassphrase,
      String brokerName,
      String brokerPartner,
      String brokerKey) {

    this.apiKey = nullSafe(apiKey);
    this.apiSecret = nullSafe(apiSecret);

    this.apiPassphrase =
        (!this.apiSecret.isEmpty() && !nullSafe(apiPassphrase).isEmpty())
            ? sign(apiPassphrase, this.apiSecret)
            : apiPassphrase;

    this.brokerName = nullSafe(brokerName);
    this.brokerPartner = nullSafe(brokerPartner);
    this.brokerKey = nullSafe(brokerKey);

    if (this.apiKey.isEmpty() || this.apiSecret.isEmpty() || this.apiPassphrase.isEmpty()) {
      log.warn(
          "[AUTH WARNING] API credentials incomplete. Access is restricted to public endpoints.");
    }
  }

  /** Base64-encoded HMAC-SHA256. */
  public static String sign(String plain, String key) {
    try {
      Mac mac = Mac.getInstance(HMAC_SHA256);
      mac.init(new SecretKeySpec(key.getBytes(StandardCharsets.UTF_8), HMAC_SHA256));
      byte[] raw = mac.doFinal(plain.getBytes(StandardCharsets.UTF_8));
      return java.util.Base64.getEncoder().encodeToString(raw);
    } catch (Exception e) {
      throw new IllegalStateException("HMAC-SHA256 failure", e);
    }
  }

  /** Milliseconds since epoch as String. */
  private static String ts() {
    return Long.toString(Instant.now().toEpochMilli());
  }

  /** Headers for normal signed request. */
  public Map<String, String> headers(String plain) {
    String timestamp = ts();

    String sig = "";
    if (!apiSecret.isEmpty()) {
      sig = sign(timestamp + plain, apiSecret);
    }

    Map<String, String> h = new HashMap<>();
    h.put("KC-API-KEY", apiKey);
    h.put("KC-API-PASSPHRASE", apiPassphrase);
    h.put("KC-API-TIMESTAMP", timestamp);
    h.put("KC-API-SIGN", sig);
    h.put("KC-API-KEY-VERSION", "3");
    return h;
  }

  /** Headers for broker request (includes partner signature). */
  public Map<String, String> brokerHeaders(String plain) {
    if (brokerPartner.isEmpty() || brokerName.isEmpty()) {
      log.error("[BROKER ERROR] Missing broker information");
      throw new IllegalStateException("Broker information cannot be empty");
    }

    String timestamp = ts();
    String sig = sign(timestamp + plain, apiSecret);
    String partnerSig = sign(timestamp + brokerPartner + apiKey, brokerKey);

    Map<String, String> h = new HashMap<>();
    h.put("KC-API-KEY", apiKey);
    h.put("KC-API-PASSPHRASE", apiPassphrase);
    h.put("KC-API-TIMESTAMP", timestamp);
    h.put("KC-API-SIGN", sig);
    h.put("KC-API-KEY-VERSION", "3");
    h.put("KC-API-PARTNER", brokerPartner);
    h.put("KC-BROKER-NAME", brokerName);
    h.put("KC-API-PARTNER-VERIFY", "true");
    h.put("KC-API-PARTNER-SIGN", partnerSig);
    return h;
  }

  private static String nullSafe(String s) {
    return s == null ? "" : s;
  }
}
