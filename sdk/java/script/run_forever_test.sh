#!/bin/bash
set -e


if [[ "${USE_LOCAL,,}" == "true" ]]; then
  cd /src
  mvn clean install -DskipTests -Dgpg.skip=true
  echo "Local jars installed."
else
  echo "USE_LOCAL is not true, skipping local jar installation."
fi


cd /src/example

echo "Compiling project..."
mvn compile
if [ $? -ne 0 ]; then
  echo "Build failed"
  exit 1
fi

mvn exec:java -Dexec.mainClass="com.kucoin.test.regression.RunForeverTest"
