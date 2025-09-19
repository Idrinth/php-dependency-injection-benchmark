FROM php:8.4-cli

WORKDIR /app
RUN mkdir /out
COPY containers/dice.reflection.transient/* ./
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-progress --no-dev --prefer-dist --classmap-authoritative
COPY src/*.php ./
CMD ["php", "benchmark.php"]
