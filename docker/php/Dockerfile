FROM php:7.4.7-fpm

WORKDIR /var/www/application

RUN apt update && apt install -y \
            curl \
            wget \
            libicu-dev \
            libonig-dev \
            libxml2-dev \
            libpq-dev \
            libfreetype6-dev \
            libjpeg-dev \
            libpng-dev \
            libwebp-dev \
            zlib1g-dev \
            g++ \
            imagemagick \
            libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring zip xml pdo_pgsql \
    && pecl install xdebug-3.0.3 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd

COPY ./php.ini "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

