FROM php:8.1-cli

RUN apt-get update && apt-get install -y unzip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY src ./src
COPY composer.json ./
COPY example ./example
RUN composer install

WORKDIR /app/example
#CMD ["php", "ExampleGetStarted.php"]
CMD ["php", "ExampleWs.php"]