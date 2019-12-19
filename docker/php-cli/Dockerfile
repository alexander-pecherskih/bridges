FROM php:7.3-cli

RUN apt-get update && apt-get install -y \
    libgmp-dev \
    libpq-dev \
    libsodium-dev \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    zip \
    git \
    && docker-php-ext-install gmp \
    && docker-php-ext-install sodium \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /bridges