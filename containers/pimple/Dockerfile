FROM php:8.4-cli

WORKDIR /app
COPY containers/pimple/* ./
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && composer install --no-interaction --no-progress
COPY src/*.php ./
CMD ["php", "benchmark.php"]
