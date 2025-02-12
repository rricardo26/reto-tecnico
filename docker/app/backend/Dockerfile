FROM php:8.3-fpm-alpine

LABEL MAINTAINER="Ricardo Alama"

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    build-base zlib-dev freetype-dev libpng-dev \
    freetype-dev libpng-dev libjpeg-turbo-dev libzip-dev \    
    && pecl install redis

RUN docker-php-ext-enable redis.so \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install gd zip pcntl mysqli pdo pdo_mysql 

    
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer