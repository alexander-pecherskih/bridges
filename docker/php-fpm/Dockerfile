FROM php:7.4-fpm-alpine

RUN apk update && apk add \
    autoconf \
    g++ \
    make \
    icu-dev \
    gmp-dev \
    postgresql-dev \
    zlib-dev \
    zip \
    libzip-dev

RUN docker-php-ext-install gmp \
 && docker-php-ext-install zip \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install pdo_pgsql \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl

RUN pecl install -o -f redis \
 && rm -rf /tmp/pear \
 && docker-php-ext-enable redis

RUN pecl install xdebug \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable xdebug

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /bridges

COPY ./php-fpm/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint