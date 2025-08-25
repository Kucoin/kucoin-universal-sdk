IMAGE_NAME=sdk-tools
IMAGE_TAG=1.0
DATE := $(shell date +%Y-%m-%d)

FILE_VERSION := $(shell cat VERSION)
USER_VERSION ?= 
VERSION := $(if $(USER_VERSION),$(USER_VERSION),$(FILE_VERSION))

RED=\033[0;31m
GREEN=\033[0;32m
NC=\033[0m

define generate-postman-func
	docker run --rm -v "${PWD}:/local" -w /local/generator/postman -e SDK_VERSION=$(VERSION) python:3.9.20-alpine3.20 \
		python main.py

	@echo "$(GREEN)lang: postman, done!$(NC)"
endef

define generate-api
	@echo "$(GREEN)lang: $(2). generate api for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/rest/api/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=api,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-api.log 2>&1 || \
		 { echo "$(RED)API Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-api-test
	@echo "$(GREEN)lang: $(2), generate api-test for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/rest/api/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=test,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-api-test.log 2>&1 || \
		 { echo "$(RED)Api Test Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-api-test-template
	@echo "$(GREEN)lang: $(2), generate api-test-template for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/rest/api/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=test_template,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-api-test-template.log 2>&1 || \
		 { echo "$(RED)Api Test Template Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-entry
	@echo "$(GREEN)lang: $(2), generate entry for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/rest/entry/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=entry,API_VERSION=$(VERSION),API_DATE=$(DATE),CSV_PATH=/local/spec > logs/$(service)-$(lang)-entry.log 2>&1 || \
		 { echo "$(RED)Entry Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-ws
	@echo "$(GREEN)lang: $(2), generate websocket for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/ws/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=ws,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-ws.log 2>&1 || \
		 { echo "$(RED)WS Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-unified
	@echo "$(GREEN)lang: $(2), generate websocket unified for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/ws-unified/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=ws_unified,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-ws-unified.log 2>&1 || \
		 { echo "$(RED)WS Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef

define generate-ws-test
	@echo "$(GREEN)lang: $(2), generate websocket test for $(service)...$(NC)"
	docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) generate \
	     -i /local/spec/ws/$(service).json \
	     -g $(2)-sdk \
	     -o $(3) \
		 --skip-validate-spec \
	     --additional-properties=GEN_MODE=ws_test,API_VERSION=$(VERSION),API_DATE=$(DATE) > logs/$(service)-$(lang)-test-ws.log 2>&1 || \
		 { echo "$(RED)WS Test Task $(service) for $(lang) failed$(NC)"; exit 1; }
endef


REST_FILES := $(wildcard ./spec/rest/api/*.json)
ENTRY_FILES := $(wildcard ./spec/rest/entry/*.json)
WS_FILES := $(wildcard ./spec/ws/*.json)
WS_UNIFIED_FILES := $(wildcard ./spec/ws-unified/*.json)

.PHONY: generate $(REST_FILES) $(ENTRY_FILES) $(WS_FILES) $(WS_UNIFIED_FILES) generate-postman force

generate-postman:
	$(call generate-postman-func)

generate: $(patsubst ./spec/rest/api/%.json,generate-rest-%, $(REST_FILES)) $(patsubst ./spec/ws/%.json,generate-ws-%, $(WS_FILES)) $(patsubst ./spec/ws-unified/%.json,generate-ws-unified-%, $(WS_UNIFIED_FILES)) $(patsubst ./spec/rest/entry/%.json,generate-entry-%, $(ENTRY_FILES)) 

generate-rest-%: ./spec/rest/api/%.json | force
	$(eval service=$*)
	@echo "$(GREEN)Generating REST API for $(service)...$(NC)"
	$(call generate-api,$<,$(lang),/local/sdk/$(lang)$(subdir))
	$(call generate-api-test,$<,$(lang),/local/sdk/$(lang)$(subdir))
	$(call generate-api-test-template,$<,$(lang),/local/sdk/$(lang)$(subdir))

generate-entry-%: ./spec/rest/entry/%.json | force
	$(eval service=$*)
	@echo "$(GREEN)Generating REST entry for $(service)...$(NC)"
	$(call generate-entry,$<,$(lang),/local/sdk/$(lang)$(subdir))

generate-ws-%: ./spec/ws/%.json | force
	$(eval service=$*)
	@echo "$(GREEN)Generating WebSocket for $(service)...$(NC)"
	$(call generate-ws,$<,$(lang),/local/sdk/$(lang)$(subdir))
	$(call generate-ws-test,$<,$(lang),/local/sdk/$(lang)$(subdir))

generate-ws-unified-%: ./spec/ws-unified/%.json | force
	$(eval service=$*)
	@echo "$(GREEN)Generating WebSocket Unified for $(service)...$(NC)"
	$(call generate-unified,$<,$(lang),/local/sdk/$(lang)$(subdir))

force:
	@true
