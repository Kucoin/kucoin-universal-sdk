
.PHONY: build
build:
	docker build -t java-sdk-image:latest .


.PHONY: format
format:
	docker run --rm -v ".:/local" -v m2-cache:/root/.m2 maven:3.9.10-amazoncorretto-17-debian-bookworm sh -c "cd /local && mvn spotless:apply -Dspotless.drop=true"

.PHONY: auto-test
auto-test: build
	docker run --rm -v m2-cache:/root/.m2 java-sdk-image:latest bash /app/auto_test.sh

.PHONY: before-release-test
before-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
	  -v m2-cache:/root/.m2 \
	  java-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: after-release-test
after-release-test: build
	docker run --rm \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  java-sdk-image:latest \
	  bash /app/release_test.sh

.PHONY: run-forever-test
run-forever-test: build
	docker rm -f java-run-forever-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
      -v m2-cache:/root/.m2 \
	  --name java-run-forever-test \
	  java-sdk-image:latest \
	  bash /app/run_forever_test.sh

.PHONY: reconnect-test
reconnect-test: build
	docker rm -f java-reconnect-test
	docker run -idt \
	  -e API_KEY="$$API_KEY" \
	  -e API_SECRET="$$API_SECRET" \
	  -e API_PASSPHRASE="$$API_PASSPHRASE" \
	  -e USE_LOCAL="true" \
      -v m2-cache:/root/.m2 \
	  --name java-reconnect-test --network isolated_net \
	  java-sdk-image:latest \
	  bash /app/ws_reconnect_test.sh