FROM php:8.4-cli

WORKDIR /app
COPY composer.json ./
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-progress
COPY benchmark.php ./
CMD ["php", "benchmark.php"]
