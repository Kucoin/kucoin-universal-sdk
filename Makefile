IMAGE_NAME=sdk-tools
IMAGE_TAG=1.0
DOCKERFILE_PATH=./Dockerfile
BUILD_CONTEXT=.

RED=\033[0;31m
GREEN=\033[0;32m
NC=\033[0m

.PHONY: setup-logs

setup-logs:
	@if [ -d "logs" ]; then \
		echo "Directory 'logs' exists. Removing and recreating..."; \
		rm -rf logs; \
	else \
		echo "Directory 'logs' does not exist. Creating..."; \
	fi
	mkdir -p logs


.PHONY: build-tools
build-tools:
	docker build -t $(IMAGE_NAME):$(IMAGE_TAG) -f $(DOCKERFILE_PATH) $(BUILD_CONTEXT)


.PHONY: preprocessor
preprocessor:
	rm -f ./spec/rest/api/*
	rm -f ./spec/rest/entry/*
	rm -f ./spec/ws/*

	docker run --rm -v "${PWD}:/local" -w /local/generator/preprocessor python:3.9.20-alpine3.20 \
		python main.py
	
.PHONY: validate
validate:
	for file in $(wildcard ./spec/rest/entry/*.json); do \
		service=$$(basename $$file .json); \
		echo "check spec for $$service..."; \
		docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) validate \
		     -i /local/spec/rest/entry/$$service.json; \
	done

	for file in $(wildcard ./spec/ws/*.json); do \
		service=$$(basename $$file .json); \
		echo "check spec for $$service..."; \
		docker run --rm -v "$$PWD:/local" $(IMAGE_NAME):$(IMAGE_TAG) validate \
		     -i /local/spec/ws/$$service.json; \
	done


define generate-code
	$(eval lang=$(1))
	$(eval subdir=$(2))
	$(eval outdir=/local/sdk/$(lang)$(subdir))

	@if [ -z "$(subdir)" ]; then \
		echo "$(RED)Error: subdir is empty!$(NC)"; \
		exit 1; \
	fi

	@echo "$(GREEN)lang: $(lang), subdir: $(subdir), out: $(outdir)$(NC)"

	@echo "$(GREEN)lang: $(lang), clean...$(NC)"
	docker run --rm -v "${PWD}:/local" $(IMAGE_NAME):$(IMAGE_TAG) rm -rf $(outdir)
	
	@echo "$(GREEN)lang: ${lang}, copy changelog...$(NC)"
	docker run --rm -v "${PWD}:/local" $(IMAGE_NAME):$(IMAGE_TAG) cp /local/CHANGELOG.md /local/sdk/$(lang)

	@make -f generate.mk generate lang=$(1) subdir=$(2) USER_VERSION=$(3)

	@echo "$(GREEN)lang: $(lang), clean...$(NC)"
	docker run --rm -v "${PWD}:/local" $(IMAGE_NAME):$(IMAGE_TAG) rm -rf $(outdir)/.openapi-generator
	docker run --rm -v "${PWD}:/local" $(IMAGE_NAME):$(IMAGE_TAG) rm -rf $(outdir)/.openapi-generator-ignore

	@echo "$(GREEN)lang: $(lang), done!$(NC)"
endef

define generate-postman
	docker run --rm -v "${PWD}:/local" $(IMAGE_NAME):$(IMAGE_TAG) cp /local/CHANGELOG.md /local/sdk/postman
	@make -f generate.mk generate-postman
endef


SUBDIRS := $(shell find ./sdk -mindepth 1 -maxdepth 1 -type d)
.PHONY: test $(SUBDIRS)
test: $(SUBDIRS)
$(SUBDIRS):
	@echo "Running tests in $@"
	@docker run --rm \
		-v venv-test-cache:/app/.venv-test \
		-v go-mod-cache:/go/pkg/mod \
		-v go-build-cache:/root/.cache/go-build \
		-v ./$@:/app -w /app $(IMAGE_NAME):$(IMAGE_TAG) \
		bash run_test.sh
	@echo "Completed tests in $@"

.PHONY: generate
generate: setup-logs
#	$(call generate-postman)
#	$(call generate-code,golang,/pkg/generate)
#	$(call generate-code,python,/kucoin_universal_sdk/generate)
#	$(call generate-code,node,/src/generate)
	$(call generate-code,php,/src/Generate,0.1.0-alpha)

.PHONY: gen-postman
gen-postman: preprocessor
	$(call generate-postman)

.PHONY: fastgen
fastgen: build-tools preprocessor
	@make generate

.PHONY: all
all: build-tools preprocessor validate
	@make generate