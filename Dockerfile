FROM php:fpm
COPY config/php.ini /usr/local/etc/php/conf.d
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++ vim git
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-configure opcache
RUN docker-php-ext-install opcache
RUN docker-php-ext-configure pdo_mysql
RUN docker-php-ext-install pdo_mysql
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/conf.d/php.ini
RUN mkdir /var/lib/php 
RUN mkdir /var/lib/php/sessions
RUN chmod -R 777 /var/lib/php/sessions 
