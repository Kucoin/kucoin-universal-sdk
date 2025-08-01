package com.kucoin.universal.sdk.generate.margin.debit;

import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.kucoin.universal.sdk.model.RestResponse;
import java.util.ArrayList;
import java.util.List;

class DebitApiAutoGeneratedTest {
  public static ObjectMapper mapper = new ObjectMapper();

  private static final List<String> failedTests = new ArrayList<>();

  private static int totalTest = 0;

  /** borrow Request Borrow /api/v3/margin/borrow */
  public static void testBorrowRequest() throws Exception {
    String data =
        "{\"currency\": \"USDT\", \"size\": 10, \"timeInForce\": \"FOK\", \"isIsolated\": false,"
            + " \"isHf\": false}";
    BorrowReq obj = mapper.readValue(data, BorrowReq.class);
  }

  /** borrow Response Borrow /api/v3/margin/borrow */
  public static void testBorrowResponse() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"orderNo\":\"67187162c0d6990007717b15\",\"actualSize\":\"10\"}}";
    RestResponse<BorrowResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<BorrowResp>>() {});
  }

  /** getBorrowHistory Request Get Borrow History /api/v3/margin/borrow */
  public static void testGetBorrowHistoryRequest() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"orderNo\":"
            + " \"example_string_default_value\", \"startTime\": 123456, \"endTime\": 123456,"
            + " \"currentPage\": 1, \"pageSize\": 50}";
    GetBorrowHistoryReq obj = mapper.readValue(data, GetBorrowHistoryReq.class);
  }

  /** getBorrowHistory Response Get Borrow History /api/v3/margin/borrow */
  public static void testGetBorrowHistoryResponse() throws Exception {
    String data =
        "{\n"
            + "    \"code\": \"200000\",\n"
            + "    \"data\": {\n"
            + "        \"timestamp\": 1729657580449,\n"
            + "        \"currentPage\": 1,\n"
            + "        \"pageSize\": 50,\n"
            + "        \"totalNum\": 2,\n"
            + "        \"totalPage\": 1,\n"
            + "        \"items\": [\n"
            + "            {\n"
            + "                \"orderNo\": \"67187162c0d6990007717b15\",\n"
            + "                \"symbol\": null,\n"
            + "                \"currency\": \"USDT\",\n"
            + "                \"size\": \"10\",\n"
            + "                \"actualSize\": \"10\",\n"
            + "                \"status\": \"SUCCESS\",\n"
            + "                \"createdTime\": 1729655138000\n"
            + "            },\n"
            + "            {\n"
            + "                \"orderNo\": \"67187155b088e70007149585\",\n"
            + "                \"symbol\": null,\n"
            + "                \"currency\": \"USDT\",\n"
            + "                \"size\": \"0.1\",\n"
            + "                \"actualSize\": \"0\",\n"
            + "                \"status\": \"FAILED\",\n"
            + "                \"createdTime\": 1729655125000\n"
            + "            }\n"
            + "        ]\n"
            + "    }\n"
            + "}";
    RestResponse<GetBorrowHistoryResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetBorrowHistoryResp>>() {});
  }

  /** repay Request Repay /api/v3/margin/repay */
  public static void testRepayRequest() throws Exception {
    String data = "{\"currency\": \"USDT\", \"size\": 10}";
    RepayReq obj = mapper.readValue(data, RepayReq.class);
  }

  /** repay Response Repay /api/v3/margin/repay */
  public static void testRepayResponse() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"timestamp\":1729655606816,\"orderNo\":\"671873361d5bd400075096ad\",\"actualSize\":\"10\"}}";
    RestResponse<RepayResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<RepayResp>>() {});
  }

  /** getRepayHistory Request Get Repay History /api/v3/margin/repay */
  public static void testGetRepayHistoryRequest() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"orderNo\":"
            + " \"example_string_default_value\", \"startTime\": 123456, \"endTime\": 123456,"
            + " \"currentPage\": 1, \"pageSize\": 50}";
    GetRepayHistoryReq obj = mapper.readValue(data, GetRepayHistoryReq.class);
  }

  /** getRepayHistory Response Get Repay History /api/v3/margin/repay */
  public static void testGetRepayHistoryResponse() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"timestamp\":1729663471891,\"currentPage\":1,\"pageSize\":50,\"totalNum\":1,\"totalPage\":1,\"items\":[{\"orderNo\":\"671873361d5bd400075096ad\",\"symbol\":null,\"currency\":\"USDT\",\"size\":\"10\",\"principal\":\"9.99986518\",\"interest\":\"0.00013482\",\"status\":\"SUCCESS\",\"createdTime\":1729655606000}]}}";
    RestResponse<GetRepayHistoryResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetRepayHistoryResp>>() {});
  }

  /** getInterestHistory Request Get Interest History. /api/v3/margin/interest */
  public static void testGetInterestHistoryRequest() throws Exception {
    String data =
        "{\"currency\": \"BTC\", \"isIsolated\": true, \"symbol\": \"BTC-USDT\", \"startTime\":"
            + " 123456, \"endTime\": 123456, \"currentPage\": 1, \"pageSize\": 50}";
    GetInterestHistoryReq obj = mapper.readValue(data, GetInterestHistoryReq.class);
  }

  /** getInterestHistory Response Get Interest History. /api/v3/margin/interest */
  public static void testGetInterestHistoryResponse() throws Exception {
    String data =
        "{\"code\":\"200000\",\"data\":{\"timestamp\":1729665170701,\"currentPage\":1,\"pageSize\":50,\"totalNum\":3,\"totalPage\":1,\"items\":[{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729663213375},{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729659618802},{\"currency\":\"USDT\",\"dayRatio\":\"0.000296\",\"interestAmount\":\"0.00000001\",\"createdTime\":1729656028077}]}}";
    RestResponse<GetInterestHistoryResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<GetInterestHistoryResp>>() {});
  }

  /** modifyLeverage Request Modify Leverage /api/v3/position/update-user-leverage */
  public static void testModifyLeverageRequest() throws Exception {
    String data = "{\"leverage\": \"5\"}";
    ModifyLeverageReq obj = mapper.readValue(data, ModifyLeverageReq.class);
  }

  /** modifyLeverage Response Modify Leverage /api/v3/position/update-user-leverage */
  public static void testModifyLeverageResponse() throws Exception {
    String data = "{\"code\":\"200000\",\"data\":null}";
    RestResponse<ModifyLeverageResp> resp =
        mapper.readValue(data, new TypeReference<RestResponse<ModifyLeverageResp>>() {});
  }

  public static void runAllTests() {
    run(DebitApiAutoGeneratedTest::testBorrowRequest, "testBorrowRequest");
    run(DebitApiAutoGeneratedTest::testBorrowResponse, "testBorrowResponse");
    run(DebitApiAutoGeneratedTest::testGetBorrowHistoryRequest, "testGetBorrowHistoryRequest");
    run(DebitApiAutoGeneratedTest::testGetBorrowHistoryResponse, "testGetBorrowHistoryResponse");
    run(DebitApiAutoGeneratedTest::testRepayRequest, "testRepayRequest");
    run(DebitApiAutoGeneratedTest::testRepayResponse, "testRepayResponse");
    run(DebitApiAutoGeneratedTest::testGetRepayHistoryRequest, "testGetRepayHistoryRequest");
    run(DebitApiAutoGeneratedTest::testGetRepayHistoryResponse, "testGetRepayHistoryResponse");
    run(DebitApiAutoGeneratedTest::testGetInterestHistoryRequest, "testGetInterestHistoryRequest");
    run(
        DebitApiAutoGeneratedTest::testGetInterestHistoryResponse,
        "testGetInterestHistoryResponse");
    run(DebitApiAutoGeneratedTest::testModifyLeverageRequest, "testModifyLeverageRequest");
    run(DebitApiAutoGeneratedTest::testModifyLeverageResponse, "testModifyLeverageResponse");
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
