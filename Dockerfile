# build plugin
FROM amazoncorretto:11-alpine AS generator-builder

ENV MAVEN_VERSION=3.8.8
ENV MAVEN_HOME=/usr/share/maven
ENV PATH=${MAVEN_HOME}/bin:${PATH}

RUN apk add --no-cache curl tar bash \
    && echo ${MAVEN_HOME} \
    && curl -fsSL https://downloads.apache.org/maven/maven-3/${MAVEN_VERSION}/binaries/apache-maven-${MAVEN_VERSION}-bin.tar.gz | tar -xzC /usr/share \
    && mv /usr/share/apache-maven-${MAVEN_VERSION} ${MAVEN_HOME} \
    && ln -s ${MAVEN_HOME}/bin/mvn /usr/bin/mvn \
    && apk del curl tar


WORKDIR /build

COPY ./generator/plugin /build

RUN --mount=type=cache,target=/root/.m2,sharing=locked mvn -U clean package -DskipTests

# build tools 
FROM openapitools/openapi-generator-cli:v7.7.0

RUN apt-get update && apt-get install python3 python3-pip python3.8-venv nodejs jq npm -y
RUN pip install yapf
ENV GOLANG_VERSION=1.22.2
RUN curl -OL https://golang.org/dl/go${GOLANG_VERSION}.linux-amd64.tar.gz && \
    tar -C /usr/local -xzf go${GOLANG_VERSION}.linux-amd64.tar.gz && \
    rm go${GOLANG_VERSION}.linux-amd64.tar.gz
WORKDIR /APP
COPY --from=generator-builder /build/target/sdk-openapi-generator-1.0.0.jar /opt/openapi-generator/modules/openapi-generator-cli/target/openapi-generator-cli.jar

# node & npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g prettier
RUN npm install -g @prettier/plugin-php
RUN echo '#!/bin/sh\n\
cd $(npm root -g) && prettier --plugin=@prettier/plugin-php --write "$@"' > /usr/local/bin/php-prettier && chmod +x /usr/local/bin/php-prettier


ENV CGO_ENABLED=0
ENV PATH="/usr/local/go/bin:$PATH"
ENV GOPATH="/go"
ENV PATH="$GOPATH/bin:$PATH"

ENV GO_POST_PROCESS_FILE="/usr/local/go/bin/gofmt -w"
ENV PYTHON_POST_PROCESS_FILE="/usr/local/bin/yapf -i"
ENV TS_POST_PROCESS_FILE="/usr/bin/prettier --write --semi --single-quote --tab-width 4 --trailing-comma all --bracket-spacing --arrow-parens always --end-of-line lf --print-width 100"
ENV PHP_POST_PROCESS_FILE="php-prettier --write"

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

CMD ["help"]