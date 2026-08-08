FROM php:apache

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y libzip-dev zip vim git && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global --add safe.directory /var/www/html

WORKDIR /var/www/html

RUN a2enmod rewrite

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY composer.json composer.lock* ./

RUN composer install --no-dev --no-scripts --optimize-autoloader
# RUN composer update --no-dev --no-scripts --optimize-autoloader

EXPOSE 80