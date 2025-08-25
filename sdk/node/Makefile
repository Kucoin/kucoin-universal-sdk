
.PHONY: build
build:
	docker build -t nodejs-sdk-image:latest .

.PHONY: auto-test
auto-test: build
	docker run --rm nodejs-sdk-image:latest bash /app/auto_test.sh

.PHONY: before-release-test
before-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
	  nodejs-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: after-release-test
after-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  nodejs-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: run-forever-test
run-forever-test: build
	docker rm -f nodejs-run-forever-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  --name nodejs-run-forever-test \
	  nodejs-sdk-image:latest \
	  bash /app/run_forever_test.sh

.PHONY: reconnect-test
reconnect-test: build
	docker rm -f nodejs-reconnect-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  --name nodejs-reconnect-test --network isolated_net \
	  nodejs-sdk-image:latest \
	  bash /app/reconnect_test.sh

.PHONY: format
format:
	@echo "pass"
