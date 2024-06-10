FROM php:8-apache

ARG uid

RUN docker-php-ext-install pdo pdo_mysql

COPY ./src /var/www/html

RUN chmod -R 777 /tmp
