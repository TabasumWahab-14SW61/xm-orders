FROM php:7.4-apache

COPY database/ database/
COPY composer.json composer.json

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

ADD . usr/share/nginx/html

RUN apt-get update && apt-get install -y git

RUN composer install
RUN php artisan migrate