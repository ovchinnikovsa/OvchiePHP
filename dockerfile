FROM php

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    docker-php-ext-install pdo mysqli pdo_mysql \
    docker-php-ext-enable mysqli pdo_mysql