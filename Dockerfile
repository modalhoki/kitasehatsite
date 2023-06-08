FROM php:7.4.33-apache

WORKDIR /var/www/html/kitasehat/

COPY kitasehat.conf /etc/apache2/sites-available/000-default.conf

RUN apt update && apt upgrade -y && \
    apt install -y git && \
    apt install -y libzip-dev zip && \
    docker-php-ext-install zip && \
    a2enmod rewrite && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer update && \
    chown -R www-data:www-data /var/www/html/kitasehat && \
    chmod -R 755 /var/www/html/kitasehat