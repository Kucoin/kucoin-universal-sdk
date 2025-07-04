
.PHONY: build
build:
	docker build -t python-sdk-image:latest .

.PHONY: auto-test
auto-test: build
	docker run --rm python-sdk-image:latest bash /app/auto_test.sh

.PHONY: before-release-test
before-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
	  python-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: after-release-test
after-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  python-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: run-forever-test
run-forever-test: build
	docker rm -f python-run-forever-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
	  --name python-run-forever-test \
	  python-sdk-image:latest \
	  bash /app/run_forever_test.sh

.PHONY: reconnect-test
reconnect-test: build
	docker rm -f python-reconnect-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
	  --name python-reconnect-test --network isolated_net \
	  python-sdk-image:latest \
	  bash /app/ws_reconnect_test.sh