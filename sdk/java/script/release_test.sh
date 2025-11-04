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

ls ./target

CLASSES=(
  "com.kucoin.example.ExampleAPI"
  "com.kucoin.example.ExampleGetStarted"
  "com.kucoin.example.ExampleSign"
  "com.kucoin.example.ExampleWs"
  "com.kucoin.test.regression.RunServiceTest"
)

for class in "${CLASSES[@]}"; do
  echo "Running $class..."
  mvn exec:java -Dexec.mainClass="$class"
  echo "Finished $class"
done

echo "All classes executed successfully."