FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    g++ \
    libicu-dev \
    libgmp-dev \
    libpq-dev \
    libsodium-dev \
    zlib1g-dev \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    git

RUN docker-php-ext-install gmp \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install zip \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install pdo_pgsql
# && docker-php-ext-install opcache \

RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ \
 && docker-php-ext-install gd

RUN docker-php-ext-configure intl \
 && docker-php-ext-install intl

RUN pecl install -o -f redis \
 && rm -rf /tmp/pear \
 && docker-php-ext-enable redis

RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

RUN apt-get install -y libmagickwand-dev --no-install-recommends \
 && pecl install -o -f imagick \
 && docker-php-ext-enable imagick

COPY php.ini /usr/local/etc/php/

WORKDIR /bridges