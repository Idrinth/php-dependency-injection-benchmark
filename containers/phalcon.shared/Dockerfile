FROM php:8.4-cli

WORKDIR /app
RUN mkdir /out
COPY containers/phalcon.shared/* ./
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
    && apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/* \
    && install-php-extensions psr phalcon \
    && docker-php-ext-enable psr \
    && docker-php-ext-enable phalcon \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-progress
COPY src/*.php ./
CMD ["php", "benchmark.php"]
