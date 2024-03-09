FROM php:8.1.18-fpm

RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
