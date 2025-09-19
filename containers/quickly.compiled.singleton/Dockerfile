FROM php:8.4-cli

WORKDIR /app
RUN mkdir /out
COPY containers/quickly.compiled.singleton/* ./
COPY src/*.php ./
RUN mkdir .quickly
COPY containers/quickly.compiled.singleton/.quickly/entrypoints.php ./.quickly/entrypoints.php
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-dev --no-progress --prefer-dist --classmap-authoritative
RUN vendor/bin/quickly build
CMD ["php", "benchmark.php"]
