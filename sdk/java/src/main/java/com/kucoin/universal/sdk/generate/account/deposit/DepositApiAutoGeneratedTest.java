package com.kucoin.universal.sdk.generate.account.deposit;

import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.model.RestResponse;
import java.util.ArrayList;
import java.util.List;

class DepositApiAutoGeneratedTest {
  public static ObjectMapper mapper = new ObjectMapper();

  private static final List<String> failedTests = new ArrayList<>();

  private static int totalTest = 0;

  /** addDepositAddressV3 Request Add Deposit Address (V3) /api/v3/deposit-address/create */
  public static void testAddDepositAddressV3Request() throws Exception {
    String data = "{\"currency\": \"TON\", \"chain\": \"ton\", \"to\": \"trade\"}";
    AddDepositAddressV3Req obj = mapper.readValue(data, AddDepositAddressV3Req.class);
  }

  /** addDepositAddressV3 Response Add Deposit Address (V3) /api/v3/deposit-address/create */
  public static void testAddDepositAddressV3Response() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"address\":\"EQCA1BI4QRZ8qYmskSRDzJmkucGodYRTZCf_b9hckjla6dZl\",\"memo\":\"2090821203\",\"chainId\":\"ton\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"TON\",\"chainName\":\"TON\"}}";
    RestResponse<AddDepositAddressV3Resp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<AddDepositAddressV3Resp>>() {});
  }

  /** getDepositAddressV3 Request Get Deposit Address (V3) /api/v3/deposit-addresses */
  public static void testGetDepositAddressV3Request() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"amount\": \"example_string_default_value\", \"chain\": \"eth\"}";
    GetDepositAddressV3Req obj = mapper.readValue(data, GetDepositAddressV3Req.class);
  }

  /** getDepositAddressV3 Response Get Deposit Address (V3) /api/v3/deposit-addresses */
  public static void testGetDepositAddressV3Response() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":[{\"address\":\"TSv3L1fS7yA3SxzKD8c1qdX4nLP6rqNxYz\",\"memo\":\"\",\"chainId\":\"trx\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t\",\"chainName\":\"TRC20\"},{\"address\":\"0x551e823a3b36865e8c5dc6e6ac6cc0b00d98533e\",\"memo\":\"\",\"chainId\":\"kcc\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"0x0039f574ee5cc39bdd162e9a88e3eb1f111baf48\",\"chainName\":\"KCC\"},{\"address\":\"EQCA1BI4QRZ8qYmskSRDzJmkucGodYRTZCf_b9hckjla6dZl\",\"memo\":\"2085202643\",\"chainId\":\"ton\",\"to\":\"TRADE\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"EQCxE6mUtQJKFnGfaROTKOt1lZbDiiX1kCixRv7Nw2Id_sDs\",\"chainName\":\"TON\"},{\"address\":\"0x0a2586d5a901c8e7e68f6b0dc83bfd8bd8600ff5\",\"memo\":\"\",\"chainId\":\"eth\",\"to\":\"MAIN\",\"expirationDate\":0,\"currency\":\"USDT\",\"contractAddress\":\"0xdac17f958d2ee523a2206206994597c13d831ec7\",\"chainName\":\"ERC20\"}]}";
    RestResponse<GetDepositAddressV3Resp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetDepositAddressV3Resp>>() {});
  }

  /** getDepositHistory Request Get Deposit History /api/v1/deposits */
  public static void testGetDepositHistoryRequest() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\":"
            + " 1728692138000, \"currentPage\": 1, \"pageSize\": 50}";
    GetDepositHistoryReq obj = mapper.readValue(data, GetDepositHistoryReq.class);
  }

  /** getDepositHistory Response Get Deposit History /api/v1/deposits */
  public static void testGetDepositHistoryResponse() throws Exception {
    String data =
        "{\n"
            + "    \"code\": \"200000\",\n"
            + "    \"data\": {\n"
            + "        \"currentPage\": 1,\n"
            + "        \"pageSize\": 50,\n"
            + "        \"totalNum\": 5,\n"
            + "        \"totalPage\": 1,\n"
            + "        \"items\": [\n"
            + "            {\n"
            + "                \"currency\": \"USDT\",\n"
            + "                \"chain\": \"\",\n"
            + "                \"status\": \"SUCCESS\",\n"
            + "                \"address\": \"a435*****@gmail.com\",\n"
            + "                \"memo\": \"\",\n"
            + "                \"isInner\": true,\n"
            + "                \"amount\": \"1.00000000\",\n"
            + "                \"fee\": \"0.00000000\",\n"
            + "                \"walletTxId\": null,\n"
            + "                \"createdAt\": 1728555875000,\n"
            + "                \"updatedAt\": 1728555875000,\n"
            + "                \"remark\": \"\",\n"
            + "                \"arrears\": false\n"
            + "            },\n"
            + "            {\n"
            + "                \"currency\": \"USDT\",\n"
            + "                \"chain\": \"trx\",\n"
            + "                \"status\": \"SUCCESS\",\n"
            + "                \"address\": \"TSv3L1fS7******X4nLP6rqNxYz\",\n"
            + "                \"memo\": \"\",\n"
            + "                \"isInner\": true,\n"
            + "                \"amount\": \"6.00000000\",\n"
            + "                \"fee\": \"0.00000000\",\n"
            + "                \"walletTxId\": null,\n"
            + "                \"createdAt\": 1721730920000,\n"
            + "                \"updatedAt\": 1721730920000,\n"
            + "                \"remark\": \"\",\n"
            + "                \"arrears\": false\n"
            + "            }\n"
            + "        ]\n"
            + "    }\n"
            + "}";
    RestResponse<GetDepositHistoryResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetDepositHistoryResp>>() {});
  }

  /** getDepositAddressV2 Request Get Deposit Addresses (V2) /api/v2/deposit-addresses */
  public static void testGetDepositAddressV2Request() throws Exception {
    String data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}";
    GetDepositAddressV2Req obj = mapper.readValue(data, GetDepositAddressV2Req.class);
  }

  /** getDepositAddressV2 Response Get Deposit Addresses (V2) /api/v2/deposit-addresses */
  public static void testGetDepositAddressV2Response() throws Exception {
    String data =
        "{\n"
            + "    \"code\": \"200000\",\n"
            + "    \"data\": [\n"
            + "        {\n"
            + "            \"address\": \"0x02028456*****87ede7a73d7c\",\n"
            + "            \"memo\": \"\",\n"
            + "            \"chain\": \"ERC20\",\n"
            + "            \"chainId\": \"eth\",\n"
            + "            \"to\": \"MAIN\",\n"
            + "            \"currency\": \"ETH\",\n"
            + "            \"contractAddress\": \"\"\n"
            + "        }\n"
            + "    ]\n"
            + "}";
    RestResponse<GetDepositAddressV2Resp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetDepositAddressV2Resp>>() {});
  }

  /** getDepositAddressV1 Request Get Deposit Addresses - V1 /api/v1/deposit-addresses */
  public static void testGetDepositAddressV1Request() throws Exception {
    String data = "{\"currency\": \"BTC\", \"chain\": \"eth\"}";
    GetDepositAddressV1Req obj = mapper.readValue(data, GetDepositAddressV1Req.class);
  }

  /** getDepositAddressV1 Response Get Deposit Addresses - V1 /api/v1/deposit-addresses */
  public static void testGetDepositAddressV1Response() throws Exception {
    String data =
        "{\n"
            + "    \"code\": \"200000\",\n"
            + "    \"data\": {\n"
            + "        \"address\": \"0xea220bf61c3c2b0adc2cfa29fec3d2677745a379\",\n"
            + "        \"memo\": \"\",\n"
            + "        \"chain\": \"ERC20\",\n"
            + "        \"chainId\": \"eth\",\n"
            + "        \"to\": \"MAIN\",\n"
            + "        \"currency\": \"USDT\"\n"
            + "    }\n"
            + "}";
    RestResponse<GetDepositAddressV1Resp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetDepositAddressV1Resp>>() {});
  }

  /** getDepositHistoryOld Request Get Deposit History - Old /api/v1/hist-deposits */
  public static void testGetDepositHistoryOldRequest() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"status\": \"SUCCESS\", \"startAt\": 1728663338000, \"endAt\":"
            + " 1728692138000}";
    GetDepositHistoryOldReq obj = mapper.readValue(data, GetDepositHistoryOldReq.class);
  }

  /** getDepositHistoryOld Response Get Deposit History - Old /api/v1/hist-deposits */
  public static void testGetDepositHistoryOldResponse() throws Exception {
    String data =
        "{\n"
            + "    \"code\": \"200000\",\n"
            + "    \"data\": {\n"
            + "        \"currentPage\": 1,\n"
            + "        \"pageSize\": 50,\n"
            + "        \"totalNum\": 0,\n"
            + "        \"totalPage\": 0,\n"
            + "        \"items\": [\n"
            + "            {\n"
            + "                \"currency\": \"BTC\",\n"
            + "                \"createAt\": 1528536998,\n"
            + "                \"amount\": \"0.03266638\",\n"
            + "                \"walletTxId\":"
            + " \"55c643bc2c68d6f17266383ac1be9e454038864b929ae7cee0bc408cc5c869e8@12ffGWmMMD1zA1WbFm7Ho3JZ1w6NYXjpFk@234\",\n"
            + "                \"isInner\": false,\n"
            + "                \"status\": \"SUCCESS\"\n"
            + "            }\n"
            + "        ]\n"
            + "    }\n"
            + "}";
    RestResponse<GetDepositHistoryOldResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetDepositHistoryOldResp>>() {});
  }

  /** addDepositAddressV1 Request Add Deposit Address - V1 /api/v1/deposit-addresses */
  public static void testAddDepositAddressV1Request() throws Exception {
    String data = "{\"currency\": \"ETH\", \"chain\": \"eth\", \"to\": \"MAIN\"}";
    AddDepositAddressV1Req obj = mapper.readValue(data, AddDepositAddressV1Req.class);
  }

  /** addDepositAddressV1 Response Add Deposit Address - V1 /api/v1/deposit-addresses */
  public static void testAddDepositAddressV1Response() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"address\":\"0x02028456f38e78609904e8a002c787ede7a73d7c\",\"memo\":null,\"chain\":\"ERC20\",\"chainId\":\"eth\",\"to\":\"MAIN\",\"currency\":\"ETH\"}}";
    RestResponse<AddDepositAddressV1Resp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<AddDepositAddressV1Resp>>() {});
  }

  public static void runAllTests() {
    run(
        DepositApiAutoGeneratedTest::testAddDepositAddressV3Request,
        "testAddDepositAddressV3Request");
    run(
        DepositApiAutoGeneratedTest::testAddDepositAddressV3Response,
        "testAddDepositAddressV3Response");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV3Request,
        "testGetDepositAddressV3Request");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV3Response,
        "testGetDepositAddressV3Response");
    run(DepositApiAutoGeneratedTest::testGetDepositHistoryRequest, "testGetDepositHistoryRequest");
    run(
        DepositApiAutoGeneratedTest::testGetDepositHistoryResponse,
        "testGetDepositHistoryResponse");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV2Request,
        "testGetDepositAddressV2Request");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV2Response,
        "testGetDepositAddressV2Response");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV1Request,
        "testGetDepositAddressV1Request");
    run(
        DepositApiAutoGeneratedTest::testGetDepositAddressV1Response,
        "testGetDepositAddressV1Response");
    run(
        DepositApiAutoGeneratedTest::testGetDepositHistoryOldRequest,
        "testGetDepositHistoryOldRequest");
    run(
        DepositApiAutoGeneratedTest::testGetDepositHistoryOldResponse,
        "testGetDepositHistoryOldResponse");
    run(
        DepositApiAutoGeneratedTest::testAddDepositAddressV1Request,
        "testAddDepositAddressV1Request");
    run(
        DepositApiAutoGeneratedTest::testAddDepositAddressV1Response,
        "testAddDepositAddressV1Response");
  }

  private static void run(TestCase test, String name) {
    System.out.println("Running test: " + name);
    totalTest++;
    try {
      test.execute();
      System.out.println("PASSED: " + name);
    } catch (Exception e) {
      System.err.println("FAILED: " + name + " - " + e.getMessage());
      e.printStackTrace(System.err);
      failedTests.add(name);
    }
  }

  @FunctionalInterface
  interface TestCase {
    void execute() throws Exception;
  }

  public static void main(String[] args) {
    runAllTests();
    finish();
  }

  public static void finish() {
    System.out.printf("Test total: %d, failed: %d\n", totalTest, failedTests.size());
    if (!failedTests.isEmpty()) {
      System.err.println("\n=== TEST SUMMARY ===");
      System.err.println("Failed tests:");
      for (String name : failedTests) {
        System.err.println(" - " + name);
      }
      System.exit(1);
    } else {
      System.out.println("\nAll tests passed.");
    }
  }
}
