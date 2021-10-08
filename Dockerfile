FROM php:7.4-fpm

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY --chown=www-data:www-data . .

RUN composer install --quiet --optimize-autoloader --no-dev

COPY .env.example .env

RUN php artisan key:generate