FROM php:8-apache

ARG uid

RUN docker-php-ext-install pdo pdo_mysql

RUN chmod -R 777 /tmp

RUN usermod -u ${uid} www-data \
    && groupmod -g ${uid} www-data;