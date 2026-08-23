FROM php:apache

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y libzip-dev zip vim git && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

RUN git config --global --add safe.directory /var/www/html

WORKDIR /var/www/html

COPY composer.json composer.lock* ./

RUN chown -R www-data:www-data /var/www/html
USER www-data
RUN composer install --no-dev --no-scripts --optimize-autoloader
# RUN composer update --no-dev --no-scripts --optimize-autoloader

USER root

EXPOSE 80