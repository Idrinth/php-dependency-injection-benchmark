FROM php:8.4-cli

WORKDIR /app
RUN mkdir /out
COPY containers/laravel.cached/* ./
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-progress
COPY src/*.php ./
CMD ["php", "benchmark.php"]
