FROM php:7.4-cli-alpine

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

RUN pecl install xdebug \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable xdebug

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && composer global require hirak/prestissimo --no-plugins --no-scripts \
    && rm -rf /root/.composer/cache

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./common/php/conf.d /usr/local/etc/php/conf.d

WORKDIR /bridges