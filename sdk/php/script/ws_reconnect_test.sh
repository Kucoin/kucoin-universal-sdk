#!/bin/bash
set -e

echo "USE_LOCAL = ${USE_LOCAL:-<unset>}"

echo '{
  "name": "test/test",
  "description": "Test project",
  "type": "project",
  "require": {},
  "minimum-stability": "alpha",
  "prefer-stable": true
}' > composer.json


if [[ "${USE_LOCAL,,}" == "true" ]]; then
    echo "Installing local package(s)…"
    ls /tmp/*.tar 1>/dev/null 2>&1
    mkdir -p ./local-packages
    cp /tmp/*.tar ./local-packages/
    composer config repositories.local artifact ./local-packages
    composer require kucoin/kucoin-universal-sdk
else
    echo "📦 Installing kucoin-universal-sdk from Packagist…"
    composer require kucoin/kucoin-universal-sdk
fi

cat composer.json

echo "Running scripts..."
cp /src/tests/regression/RunReconnectTest.php /app
php -d memory_limit=512M RunReconnectTest.php