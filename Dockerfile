FROM php:7.4-apache

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html/

RUN a2enmod rewrite
COPY /server-config/app.conf /etc/apache2/sites-available/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY --chown=www-data:www-data . .

RUN composer install --quiet --optimize-autoloader --no-dev

COPY --chown=www-data:www-data .env.example .env

RUN chmod -R 777 /var/www/html/storage

RUN a2dissite 000-default.conf
RUN a2ensite app.conf
