FROM php:8.4-fpm

# Install pdo_sqlite extension
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite